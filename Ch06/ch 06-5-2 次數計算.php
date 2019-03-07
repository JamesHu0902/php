<?Php
    session_start();

    $counter = 1;

    if(isset($_COOKIE['myCounter'])){
        $counter = $_COOKIE['myCounter'];
        // 次數+1 & 加入COOKIE
        if($_SESSION['setCounter'] == TRUE){
            setcookie("myCounter",++$counter,time()+20*60);
        };
    }else{
        setcookie("myCounter",$counter,time()+20*60);
    }
    // 避免重新整理刷次數
    $_SESSION['setCounter'] = FALSE ;
?>

<div>
    <b>歡迎<?Php echo $_SESSION['name']?>!!</b>
    <p>這是你第<?Php echo $counter?>次登入</p>
    <a href="ch 06-5 問答過關.php">問答過關</a>
</div>