<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <?php
        // 設定時區
        date_default_timezone_set("Asia/Shanghai");
        echo "今天是".date("Y")."年".date("m")."月".date("d")."日"."<br>";
        echo "現在時間是" . date("h:i:sa")."<br>";
    ?>
    <footer>
        © 2010-<?php echo date("Y")?>
    </footer>
</body>
</html>