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
        $banner_arr = [1,2,3];
        $index = mt_rand(1,count($banner_arr));
        $imgurl = "http://students.geego.com/2018_0422/james780902/bs/images/menu/menu-$index.jpg";
        echo "<img src='$imgurl'>"; 
    ?>
</body>

</html>