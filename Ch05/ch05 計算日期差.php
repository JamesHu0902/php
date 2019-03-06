<form action="<?Php echo $_SERVER['PHP_SELF']?>" method="post">
    日期1 <input type="date" name="date1" id=""><br>
    日期2 <input type="date" name="date2" id=""><br>
    <input type="submit" value="送出">
</form>

<?Php
    // 設定時區
    date_default_timezone_set("Asia/Shanghai");
    $date1 = strtotime($_POST['date1']);
    $date2 = strtotime($_POST['date2']);

    if ($date2 > $date1) $d = ceil(($date2 - $date1)/60/60/24);
    elseif($date1 > $date2) $d = ceil(($date1 - $date2)/60/60/24);

    echo "相差: ".$d."天" ;
?>