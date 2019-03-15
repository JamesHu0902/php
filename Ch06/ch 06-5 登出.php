<?Php
    session_start();
    unset($_SESSION['name']);
    header('Location: ch 06-5-2 次數計算.php');
?>