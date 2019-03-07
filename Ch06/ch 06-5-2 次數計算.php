<?Php
    session_start();

    $counter = 1;
    // 確認COOKIE存在
    if(isset($_COOKIE['myCounter'])){
        // COOKIE 存在取出登入次數
        $counter = $_COOKIE['myCounter'];
        // 次數+1 & 加入COOKIE
        if($_SESSION['setCounter'] == TRUE){
            setcookie("myCounter",++$counter,time()+20*60);
        };
    }else{
        // COOKIE不存在 設定第一次到站
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