<?Php
    header("conten-type:text/html;charset=utf-8");

    // 開啟檔案
    if ( ! @$fh=fopen("ch07 text.txt","a+")) {
        die('無法開啟檔案');
    } ;

    $logdata = '';
    foreach($_SERVER as $k => $v){
        $logdata .= '$_SERVER['. $k .'] = '. $v . "\r\n";
        $logdata .= "-------------------------\r\n";
    }

    //改以fopen fputs fclose 操作
    if (@$bytes = @fputs($fh,$logdata) ) {
        echo "共寫入 $bytes 個位元組，本次寫入內容為 : ";
        echo "<pre>".$logdata."</pre>";
    } else {
        echo "無法寫入檔案";
    }
    fclose($fh);
?>