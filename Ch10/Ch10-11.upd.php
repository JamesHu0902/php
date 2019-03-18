<?php
require('Ch10-11.inc.php');

function goback(){
    header('Location:http://'.$_SERVER['HTTP_HOST'].'/Ch10/Ch10-11.php');
    exit();
}

$msg = ''; //放訊息的變數
// 若無 OP & mdate 參數返回主畫面
if(empty($_GET['op']) || empty($_GET['mdate'])) goback();

// 設置 switch 依據 op 決定執行動作
switch ($_GET['op']) {
    // 刪除
    case 'del':
        if(empty($_GET['id']))goback();
        $st = $db->prepare('delete from mymemo where id = ?;');
        $st->bindValue(1,$_GET['id'],PDO::PARAM_INT);
        $result = $st->execute();

        if(!$result) goback();
        $msg = "刪除成功";
        break;
    // 新增
    case 'ins':
        if(empty($_GET['memo']))goback();
        $st = $db->prepare('insert into mymemo (memo,mdate) values(?,?) ; ');
        $st->bindValue(1,$_GET['memo'],PDO::PARAM_STR);
        $st->bindValue(2,$_GET['mdate'],PDO::PARAM_STR);
        $result = $st->execute();

        if(!$result) goback();
        $msg = "新增成功";
        break;
    // 更新
    case 'upd':
        if(empty($_GET['memo']))goback();
        $st = $db->prepare('update mymemo set memo = ? where id = ?;');
        $st->bindValue(1,$_GET['memo'],PDO::PARAM_STR);
        $st->bindValue(2,$_GET['id'],PDO::PARAM_INT);
        $result = $st->execute();

        if(!$result) goback();
        $msg = "更新成功";
        break;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <p><?php echo $msg ;?></p>
    <a href="Ch10-11.php <?php if(!empty($_GET['mdate']))echo "?goto={$_GET['mdate']}";?>">回首頁</a>
</body>
</html>