<?php 
require_once('Ch11-8.inc.php');
require_once('Ch11-8.upd.php');
require_once('Ch11-8.alert.php');
require('Ch11-xajax.php');

// 註冊新增&編輯表單的回應函數
$editor = $xajax->register(XAJAX_FUNCTION,"editor");
$editor->useSingleQuote();
$editor->addParameter(XAJAX_QUOTED_VALUE,''); //設置參數
$editor->addParameter(XAJAX_JS_VALUE, 1);      //數值為任意值
$editor->addParameter(XAJAX_QUOTED_VALUE,'');

// 註冊 刪除/新增/編輯紀錄 的回應函數
$submit = $xajax->register(XAJAX_FUNCTION,"submit");
$submit->useSingleQuote();
$submit->addParameter(XAJAX_FORM_VALUES,'forml'); //以表單為參數

// 註冊載入備忘錄的回應函數
$load = $xajax->register(XAJAX_FUNCTION,"load");
$load->useSingleQuote();
$load->addParameter(XAJAX_QUOTED_VALUE,1);

$xajax->processRequest(); //處理非同步

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="Ch11-8.css" >
    <title>Document</title>
</head>
<body>
<!-- 計算日期php -->
<?Php
    require('Ch11-8.inc.php');
    $db->exec("CREATE TABLE IF NOT EXISTS mymemo 
                (id INTEGER PRIMARY KEY AUTOINCREMENT, memo TEXT,mdate TEXT)");
    // 顯示一周的週曆,先決定顯示哪一週
    // 1. 若傳送 $_GET['goto'] 參數則使用該參數日期
    // 若無參數則使用目前日期
    // 2.接著取得當周的"周日"日期

    // 若GET參數有傳來日期 則以參數日期為準
    if(!empty($_GET['goto'])){
        $dayDiff = date("w",strtotime($_GET['goto']));
        // 取得週日日期
        $sunday = strtotime($_GET['goto'])-$dayDiff*86400;
    }else {
        $dayDiff = date("w");
        $sunday = time()-$dayDiff*86400;
    }
?>
<!-- 行事曆內文開始 -->
<table>
    <!-- 上方年份以及切換週月 -->
    <tr>
        <td colspan = "2">
            <div class="left">
                <a href="Ch11-8.index.php?goto=<?Php echo date("Y-m-d",$sunday-86400*28)?>">前月</a>
                <a href="Ch11-8.index.php?goto=<?Php echo date("Y-m-d",$sunday-86400*7)?>">前週</a>
            </div>
            <div class="right">
                <a href="Ch11-8.index.php?goto=<?Php echo date("Y-m-d",$sunday+86400*7)?>">次週</a>
                <a href="Ch11-8.index.php?goto=<?Php echo date("Y-m-d",$sunday+86400*28)?>">次月</a>
            </div>
            <div class="year"><?Php echo date("Y",$sunday)   ?></div>
        </td>
    </tr>
    <!-- 從資料庫導出資料渲染下方行事曆 -->
<?Php
    $week = ['日','一','二','三','四','五','六'];
    // 用迴圈查詢及輸出 7 天的備忘錄
    for($i=0;$i<7;$i++){
        echo "<tr><td class='day' id='d".$i."'>";
        $day = $sunday + $i*86400;
        $day_str = date("Y-m-d",$day);
        echo date("m-d",$day)."({$week[$i]})</td><td id= \"{$day_str}\">"; //以日期字串當作ID
        echo getMemoHtml($day_str);
        echo '</td></tr>';
    }
    // 動態載入某日備忘事項回應函數
    function load($day){
        $response = new xajaxResponse();
        if(empty($day))return $response;
        // 呼叫 getMemoHtml() 取得要顯示的資料
        return $response->assign($day,'innHTML',getMemoHtml($day));
    }
    // 傳回某日備忘錄的 HTML 相關內容的函數
    function getMemoHtml($day){
        global $db,$editor,$submit;
        $html = '';
        $sql = "select * from mymemo where mdate = ?;";
        $st = $db->prepare($sql);
        $st->execute([$day]);
        $result = $st->fetchAll();
        foreach($result as $row){
            // 輸出備忘錄內容
            $html .= htmlspecialchars($row['memo'])."\n&nbsp;";
            // 輸出刪除連結
            // $html .= '<a href="#" onclick="
            //         $(\'#op\').value=\'del\';
            //         $(\'#id\').value='.$row['id'].';'.
            //         $submit->getscript().
            //         ';return false;">刪除</a>';
            $html .= '<a href="#" onclick="
                    document.getElementById(\'op\').value=\'del\';
                    document.getElementById(\'id\').value='.$row['id'].';'.
                    $submit->getscript().';return false;">刪除</a>';
            // 輸出編輯連結
            $editor->setParameter(0,XAJAX_QUOTED_VALUE,'edt');
            $editor->setParameter(1,XAJAX_JS_VALUE,$row['id']);
            $editor->setParameter(2,XAJAX_JS_VALUE,$row['mdate']);
            $html .= "\n&nbsp;".
                '<a href="#" onclick="'. $editor->getscript().
                '; return false;">編輯</a><br>'."\n";
        }
        // 輸出新增備忘錄的連結
        $editor->setParameter(0,XAJAX_QUOTED_VALUE,'new');
        $editor->setParameter(2,XAJAX_QUOTED_VALUE,$day);
        $html .= '<div class="right"><a href="#" onclick="'.
                $editor->getscript().'">新增</a></div>';
        $html .= "</td></tr>";
        return $html;
    }
?>
</table>

<div class="left" id="inputform" style="visibility:hidden;margin:0 20px;">
    <form id="forml">
        <input type="hidden" readonly name="op" id="op">
        <input type="hidden" readonly name="id" id="id">
        待辦日期 : <input type="text" readonly name="mdate" id="mdate"><br>
        待辦事項 : <input type="text"  name="memo" id="memo" required><br>
        <button type="button" id="submit" onclick="<?php $submit->printscript(); ?>">
        </button>
    </form>
</div>
</body>
</html>


