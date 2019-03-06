<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" >
    <input type="text" placeholder="請輸入5個不同數字" name="number"> 
    <input class="btn btn-primary" type="submit" value="確認">
</form>

<?php
    $str = $_POST['number'];
    // 收到的數字拆開轉換成陣列
    $strarr = preg_split('//', $str, -1, PREG_SPLIT_NO_EMPTY);
    $Max = 0;
    $Min = $strarr[0];
    sort($strarr);
    $fillterstr = '';
    for($i=0 ;$i<5 ;$i++){
        if($strarr[$i] > $Max){
            $Max = $strarr[$i];
        };
        if($strarr[$i] < $Min){
            $Min = $strarr[$i];
        };
        $fillterstr .= $strarr[$i];
    };
    if(isset($_POST['number'])){
    
        echo "輸入: ".$str."<br>";
        echo "Max: ".$Max."<br>";
        echo "Min: ".$Min."<br>";
        echo "排序: ".$fillterstr;
            
    };
    
?>