<form action="./welcome.php" method="post">
帳號：<input type="text" name="name"><br>
密碼：<input type="text" name="email"><br>
<input type="submit">
</form>
<form action="" method="get">
日期: <input type="date" name="user_date" />
<input type="submit" />
</form>

<?php
    $sum = 0;
    for($i=1 ;$i<=10 ;$i++){
        $sum += $i;
        echo $sum .'</br>';
    }    
    echo $sum;
?>

<style>
body{
    color:red;
    font-size:2em;
    font-weight:bold;

}
</style>