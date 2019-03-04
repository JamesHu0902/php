<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>車票試算系統</title>
</head>
<body>
    <!-- 選擇區 -->
    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
        <select name="departure" >
            <?Php
                $staion = array("台北","板橋","桃園","新竹","台中","嘉義","台南","左營");
                
                for($i=0 ;$i<count($staion) ;$i++){
                    if($i==0)
                        echo '<option value="'.$i.'" selected>';
                    else
                        echo '<option value="'.$i.'">';
                    echo $staion[$i]."</option>";
                }
            ?>
        </select>
        到
        <select name="destination" >
            <?Php
                $staion = array("台北","板橋","桃園","新竹","台中","嘉義","台南","左營");
                
                for($i=count($staion)-1 ;$i>=0 ;$i--){
                    if($i==count($staion)-1)
                        echo '<option value="'.$i.'" selected>';
                    else
                        echo '<option value="'.$i.'">';
                    echo $staion[$i]."</option>";
                }
            ?>
        </select><br>
        車廂:  
            <input type="radio" name="class" value="標準" checked>標準
            <input type="radio" name="class" value="商務">商務
        <br>
        票種:
            <input type="radio" name="type" value="普通票" checked>普通票
            <input type="radio" name="type" value="優待票">優待票
        <br>
        張數:
            <input type="number" name="number" value="1">張 &nbsp&nbsp&nbsp
            <input type="submit" value="確定">
        <br>
        
    </form>

    <!-- 輸出結果 -->
    <div>
    <?Php
        $price = array(
            [0,225,380,560,1095,1595,1955,2140],
            [45,0,345,515,1060,1560,1910,2095],
            [175,140,0,345,880,1380,1740,1925],
            [315,280,140,0,715,1215,1565,1750],
            [765,730,590,450,0,670,1030,1215],
            [1180,1145,1005,860,410,0,540,715],
            [1480,1445,1305,1160,710,295,0,355],
            [1630,1595,1455,1310,860,450,150,0]);
        $form = $_POST['departure'];
        $to = $_POST['destination'];
        
        if(($_POST['class']=='商務' && $to > $from ) || ($_POST['class']=='標準' && $to < $from ))
            $totle = $price[$form][$to]*$_POST['number'];
        else
            $totle = $price[$to][$form]*$_POST['number'];

        if($_POST['type']=='優待票')$totle=$totle*0.5;

        echo "從 <b>{$staion[$form]}</b>站 到 <b>{$staion[$to]}</b> 站 <br>

        <b>{$_POST['class']}</b>車廂<b>{$_POST['type']}</b> <b>{$_POST['number']}</b> 張<br>

        小記 <b>$totle</b> 元";
    ?>
    </div>
    
</body>
</html>

<style>
form,div{
    width: 240px;
    background-color: gold;
    padding: 10px;
}
input {
    width:3em;
}
div{
    margin-top:10px;
}
</style>