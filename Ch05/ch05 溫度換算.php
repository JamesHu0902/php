<form action="<?Php echo $_SERVER['PHP_SELF']?>" method="post">
溫度: <input type="text" name="temp">
由  <select name="select1" id="">
        <option value="攝氏">攝氏</option>
        <option value="華氏">華氏</option>
    </select>
轉  <select name="select2" id="">
        <option value="攝氏">攝氏</option>
        <option value="華氏">華氏</option>
    </select>
    <input type="submit" value="轉換">
</form>

<?php
    if((isset($_POST['temp']))){
        $temp = $_POST['temp'];
        $from = $_POST['select1'];
        $to = $_POST['select2'];

        if($to == $from)
            echo "溫度".$temp."度";
        elseif( $to == "攝氏"){
            $temp = ($temp-32)*5/9;
            echo "溫度".$temp."度";
        }
        elseif( $to == "華氏"){
            $temp = $temp*(9/5)+32;
            echo "溫度".$temp."度";
        }
    }
?>