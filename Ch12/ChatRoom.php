<?php
require_once('chat.inc.php');
session_start();
// session 為 true 表示是新進使用者，建立歡迎訊息
if(!empty($_SESSION['newuser']) && $_SESSION['newuser'] == true){
    // 建立一筆使用者剛進入聊天室的訊息
    $welcomeMsg = '<span style="color:gray">'.$_SESSION['username'].
                '進入聊天室</span><br>';
    // $_SESSION['lastRead'] 紀錄最後一次讀到的訊息索引
    // addMsg() 會傳回加入的新訊息所在的索引
    // 以下設定新使用者從歡迎自己的訊息開始讀取
    $_SESSION['lastRead'] = addMsg($welcomeMsg);
    unset($_SESSION['newuser']); //取消新使用者狀態
}elseif(!isset($_SESSION['lastRead'])){
    // 若沒有 $_SESSION['lastRead'] 
    // newuser也不是 true 那麼就是非法進入頁面
    // 轉至登入頁面
    header('Location: EnterRoom.php');
}
// 註冊 xajax 回應函數
$xajax->register(XAJAX_FUNCTION,'send');
$xajax->register(XAJAX_FUNCTION,'read');
$xajax->register(XAJAX_FUNCTION,'bye');
$xajax->processRequest();

// 新增訊息至聊天檔的函數，傳回值存於陣列的索引值
function addMsg($msg){
    // 檢查是否有聊天檔
    if(is_file(CHAT_FILE)){
        $msgEntry = unserialize(file_get_contents(CHAT_FILE));
    }else{
        $msgEntry[0] = ENTRY_MAX; //代表最後一筆資料的位置的變數
    }

    $indexLast = $msgEntry[0]; //保留最後一筆數值，以便稍後傳回
    
    if(++$msgEntry[0] > ENTRY_MAX){
        $msgEntry[0] = 1;  //代表最後一筆資料位置變數 +1
        // 若超過訊息上限則設為 1
    }

    $msgEntry[$msgEntry[0]] = $msg;
    file_put_contents(CHAT_FILE,serialize($msgEntry),LOCK_EX);
    return $indexLast; //傳回新訊息所在的索引
    //只有新進入 會用到此傳回值
}

// 接收用戶端送出新訊息的回應函數
function send($aFormValues){
    // 由表單陣列取得使用者輸入的訊息以及樣式
    $usermsg = htmlspecialchars($aFormValues['usermsg']);
    $colorselect = $aFormValues('colorselect');
    // 組合訊息字串，在字串最後加上<br>
    $str = sprintf('[%s]<span class="nick">%s</span>
                    :&nbsp<span class="usr_msg" style="color:%s"> %s</span><br>'
                    ,date('H:i')                // 1.時間
                    ,$_SESSION['username']      // 2.暱稱
                    ,$colorselect               // 3.訊息顏色
                    ,changface($usermsg));      // 4.替換表情字串的訊息
    addMsg($str); //將訊息存檔
    $response = new xajaxResponse();
    return $response; //傳回空的訊息內容
}

// 將表情符號換成對應資料的回應函數
function changface($str){
    // 表情符號陣列
    $symbols = [':)',':(',":D",":cry"];
    // 表情圖檔陣列
    $tags = ['<i class="far fa-smile"></i>',
            '<i class="far fa-frown"></i>',
            '<i class="far fa-grin-squint"></i>',
            '<i class="far fa-sad-cry"></i>'];
    // 將 $str 中出現的 symbols 陣列元素換成對應的 tag
    return str_replace($symbols,$tags,$str);
}

// 由用戶端定時呼叫，以便讀取新的聊天訊息的回應函數
function read(){
    $response = new xajaxResponse;
    if(!is_file(CHAT_FILE) || !is_file(USER_LIST)){
        $response->append('allmsg','innerHTML',
        '<span style="color:red">系統錯誤</span>');
        $response->call('scrollDiv',null);
        return $response;
    }
    $users = unserialize(file_get_contents(USER_LIST)); //讀取名單
    $msgEntry = unserialize(file_get_contents(CHAT_FILE)); //讀取訊息
    
    $indexLast = $msgEntry[0];

    // 比較用戶端上次讀到的訊息索引，與目前檔案紀錄最後一筆訊息的索引
    // 兩者相同表示沒有新訊息要傳送給用戶端  不同才需要傳新訊息給用戶端\
    if($_SESSION['lastRead'] != $indexLast){
        // 初始化字串
        $str = '';
        // 由最近一筆開始往前讀，讀到上次讀到的為止
        for($i=$indexLast;$i != $_SESSION['lastRead'];){
            $str = $msgEntry[$i].$str; //以舊訊息在前的方式串接
            ($i == 1) ? $i = ENTRY_MAX: //若 $i = 1 將 $i 設為索引最大值
            $i--;   //否則 $i -1
        }
        $_SESSION['lastRead'] = $indexLast;  //更新 $_SESSION
        $response->append('allmsg','innerHTML',$str); //回應訊息
        // 呼叫捲動訊息區的 JS
        $response->call('scrollDiv');
    }

    // 將目前使用者名單送至 $nameList 字串
    $nameList = '';
    foreach($users as $k=>$username){
        // 自己的暱稱加粗
        if($username == $_SESSION['username']) 
            $nameList .= '<b>'.$username.'</b><br>';
        else
            $nameList .= $username.'<br>';
    }
    $response->assign('userlist','innerHTML',$nameList); // 傳回名單
    return $response;
}

// 用戶離線的回應函數
function bye(){
    $users = unserialize(file_get_contents(USER_LIST)); //取得名單陣列
    // 將使用者移除
    unset($users[strtolower($_SESSION['username'])]);
    if(count($users) == 0){  //若聊天室沒人了
        unlink(USER_LIST);  //刪除名單檔案
        unlink(CHAT_FILE);  //刪除對話紀錄檔案
    }elseif(isset($_SESSION['username'])){
        // 如果聊天室還有別人
        // 將減少一人的名單傳回名單檔案
        file_put_contents(USER_LIST,serialize($users),LOCK_EX);
        // 建立離開訊息
        $byeMsg = '<span style="color:gary">'.$_SESSION['username'].'離開聊天室</span><br>';
        addMsg($byeMsg);
    }
    session_destroy(); //清除 session 變數
    $response = new xajaxResponse;
    $response->redirect('EnterRoom.php'); //導回登入頁
    return $response;

}

?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <script type="text/javascript" src="chatscript.js"></script>
        <link rel="stylesheet" type="text/css" href="chatstyle.css">
        <!-- fontawesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <!-- 導入xajax -->
        <?php $xajax->printJavascript(); ?>
        <title>PHP聊天室</title>
    </head>
    <body onload="starRead();check_input_color();" onunload="xajax_bye();">
        <p class="logo">PHP 聊天室</p>
        <div id='box'>
            <div id="allmsg" class="windows"></div>
            <div id="userlist" class="windows"></div>
        </div>
        <br>
        <hr>
        <form id="bottom" onsubmit="check();return false;">
            <input type="text" id="usermsg" name="usermsg" clos="75">
            <select name="colorselect" id="colorselect">
                <option value="black" style="color:black;">黑</option>
                <option value="red" style="color:red;">紅</option>
                <option value="green" style="color:green;">綠</option>
                <option value="blue" style="color:;blue">藍</option>
                <option value="fuchsia" style="color:fuchsia;">粉紅</option>
                <option value="yellow" style="color:yellow;">黃</option>
            </select>
            <input type="submit" value="送出">
        </form>
        <br>
        <button type="button" onclick="xajax_bye();">離開</button><br>
        <input type="checkbox" name="noscroll" id="noscroll">暫停捲動
            <span id="bgcolor">&nbsp ;更換背景顏色 :
                <input type="color" id="bgcolorselect">
            </span> 

    </body>
    </html>