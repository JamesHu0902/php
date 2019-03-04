<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
<form method="post" action=<?php echo $_SERVER['PHP_SELF']?>>
    貸款金額:<input type="number" name="loan" value="5" required>萬元 <br>
    年利率:<input type="decimal" name="rate" value="1.8" requited>%<br>
    還款年數:<input type="number" name="year" value="1" requited>年 <br>
    <input type="submit" value="確定">
</form>

<p>
    <?php
        if( (isset($_POST['loan']) && $_POST['loan']>0) &&
            (isset($_POST['rate']) && $_POST['rate']>0) &&
            (isset($_POST['year']) && $_POST['year']>0)){
                $month = $_POST['year']*12;
                $rate = $_POST['rate']/100/12;
            
                $power_term = 1;
                for($i=1 ;$i<=$month ;$i++)
                    $power_term = $power_term * (1+$rate);
                
                    $payment = $_POST['loan'] * 10000 * ($power_term*$rate)/($power_term-1);    
                    echo "每月應還 <b>" .ceil($payment) . "</b>元";
        }else{
            echo "無法計算";
        }
    ?>
</p>
</body>


</html>
<style>
form {
    width: 240px;
    background-color: gold;
    padding: 10px;
}
input {
    width:3em;
}
</style>