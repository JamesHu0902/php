<?php
require_once('chat.inc.php');
session_start();

$users = [];

if(is_file(USER_LIST)){ //檢查聊天名單檔是否存在
    // 由檔案讀入聊天名單並存於陣列之中
    $users = unserialize(file_get_contents(USER_LIST));
}
$msg_users = "沒有人";
if(count($users) > 0) $msg_users = "有".count($users)."人";

$xajax->configure('javascript URI','../Xajax-master');

$request = $xajax->register(XAJAX_FUNCTION,'checkname'); //註冊回應函數
$request->addParameter(XAJAX_FORM_VALUES,'form1'); //定義參數
$xajax->processRequest(); //處理非同步

// 檢查使用者暱稱函數
function checkname($form1){
    global $users;
    $response = new xajaxResponse();
    $username = $form1['username'];

    $username = trim($username); //去除空白字元
    // 檢查是否為空白
    if($username == ''){  
        $response>assign('msg','innHTML','您的暱稱不合法');
        return $response;
    }

    $username = htmlspecialchars($username);  //轉成 HTML 格式
    // 檢查人數是否超過上限
    if(count($users) >= MAX_USER){  
        $response->assign('msg','innerHTML','聊天室人數已達上限，請稍後再試! ');
        return $response;
    }elseif(array_key_exists(strtolower($username),$users)){
        $response->assign('msg','innerHTML','已有人使用相同暱稱，請更換暱稱! ');
    }

    $users[strtolower($username)] = $username;  //以小寫名稱當作索引
    file_put_contents(USER_LIST,serialize($users),LOCK_EX);
    // 利用 session 變數儲存必要資訊
    // 讓使用者進入 ChatRoom.php 
    $_SESSION['newuser'] = true;  //記錄此為新加入使用者
    $_SESSION['username'] = $username; //記錄使用者暱稱
    $response->redirect('ChatRoom.php');  //轉至聊天室
    return $response;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- 記得輸出 JS 到 HTML -->
    <?php $xajax->printJavascript() ;?>   
    <link rel="stylesheet" type="text/css" href="chatstyle.css">
    <title>Document</title>
</head>
<body>
    <p class="logo">Welcom ! <br>歡迎來到 PHP 聊天室</p>
    <p>目前<?php echo $msg_users ?>上線</p>
    <form id="form1" name="form1" action="<?php $request->pritscript()?>;return false">
        請輸入暱稱 : <input type="text" name="username" id="username">
        <input type="submit" value="進入聊天室">
    </form>
    <span id='msg' class="sys_msg"></span>
</body>
</html>