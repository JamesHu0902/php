<?php
    //開啟session功能
    session_start();

    $counter = 1;
    //如果counter變數存在代表登入過

    if(isset($_COOKIE['counter'])){
        // 如果seesion的變數存在，代表尚未關閉網頁，不重新計算次數
        if(isset($_SESSION['entered'])) $counter = $_COOKIE['counter'];
        // 離開網頁後回訪 次數+1
        else $counter = $_COOKIE['counter'] + 1;
    }

    setcookie("counter",$counter,time()+20*60);

    echo "這是您第 $counter 次造訪本站";

    $_SESSION['entered'] = TRUE;
?>