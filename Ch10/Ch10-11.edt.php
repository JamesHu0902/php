<?php
require('Ch10-11.inc.php');

function goback(){
    header('Location:http://'.$_SERVER['HTTP_HOST'].'/Ch10/Ch10-11.php');
    exit();
}

// 檢查是否有 $_GET['op'] 的參數
// 新增時需要日期資料，編輯需要id
if(empty($_GET['op'])||
    ( ($_GET['op'] == 'add') && empty($_GET['mdate']) ) ||
    ( ($_GET['op'] == 'edt') && empty($_GET['id']) ) ){
        goback();
}

// 編輯
if($_GET['op'] == 'edt'){
    // 取得 id 指定的資料
    $id = $_GET['id'];
    $sql = 'select * from mymemo where id = ?;';
    $st = $db->prepare($sql);
    $st->bindvalue(1,$id,PDO::PARAM_INT);
    $st->execute();
    $row = $st->fetch();
    if(empty($row)) goback(); //若沒有資料則返回
    // 設定表單使用的參數
    $op = "upd";
    $memo = $row['memo'];
    $mdate = $row['mdate'];
    $submit = "儲存";
}else{
    // 新增資料 不須查詢直接設定表單使用參數
    $op = "ins";
    $id = "";
    $memo = "";
    $mdate = $_GET['mdate'];
    $submit = "新增";
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
    <form action="Ch10-11.upd.php" method="get">
        <!-- 利用隱藏單位設定送出的表單參數 -->
        <input type="text" hidden name="op" value="<?php echo $op ;?>">
        <input type="text" hidden name="id" value="<?php echo $id ;?>">
        待辦日期 : <input type="text" readonly name="mdate" value="<?php echo $mdate; ?>"><br>
        待辦事項 : <input type="text"  name="memo" value="<?php echo $memo; ?>" required><br>
        <input type="submit" name="submit" value="<?php echo $submit;?>">
    </form>
</body>
</html>
