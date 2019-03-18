<?Php
header('content-type:text/html ; charset = utf-8');
date_default_timezone_set('Asia/Taipei');

try{
    //開啟 PDO 資料庫
    $db = new PDO('sqlite:../Ch10/Ch10Memo.sqlite');
}catch(PDOException $e){
    if($e->getCode() == '1045') die("連線失敗");
}
?>