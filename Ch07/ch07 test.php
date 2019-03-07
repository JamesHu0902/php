<?Php
    header("conten-type:text/html;charset=utf-8");

    $logdata = '';
    foreach($_SERVER as $k => $v){
        $logdata .= '$_SERVER['. $k .'] = '. $v . "\r\n";
        $logdata .= "-------------------------\r\n";
    }
    //file_put_contents(路徑,寫入內容,參數)  下面參數為貼在原有文字後方 無參數則會直接覆蓋所有內容
    if (@$num = file_put_contents("ch07 test.txt",$logdata,FILE_APPEND) ) {
        echo "共寫入 $num 個位元組，本次寫入內容為 : <pre>";
        echo htmlspecialchars($logdata)."</pre>";
    } else {
        echo "無法寫入檔案";
    }
    
?>