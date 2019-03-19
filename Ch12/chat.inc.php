<!-- XAjax 引用 -->
<?php
require('../Xajax-master/xajax_core/xajax.inc.php'); //引用xajax

$xajax = new xajax();  //建立物件
$xajax->configure('javascript URI','../Xajax-master');
$xajax->configure('waitCursor',false);
// $xajax->configure('debug',true);  //DEBUG
?>
<!-- PDO 連線 -->
<?Php
header('content-type:text/html ; charset = utf-8');
date_default_timezone_set('Asia/Taipei');

try{
    //開啟 PDO 資料庫
    $db = new PDO('sqlite:Chat.sqlite');
}catch(PDOException $e){
    if($e->getCode() == '1045') die("連線失敗");
}
?>


<?php
const USER_LIST = './user_list';
const MAX_USER = 10;
const CHAT_FILE = './chat_file';
const ENTRY_MAX = 10;
?>