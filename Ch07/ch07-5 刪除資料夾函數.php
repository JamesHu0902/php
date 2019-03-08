<?Php
    $Path = $delName;
    function deldir($Path){
        // 如果是目錄
        if(is_dir($Path)){
            // 掃描一個資料夾內所有資料夾&檔案 並返回陣列
            $p = scandir($Path);
            // 使用 foreach 處理資料夾內
            foreach($p as $val){
                // 排除目錄中 . 和 ..
                if($val !="." && $val !=".."){
                    // 如果是目錄 以子目錄先進行一次此函數
                    // 清空子目錄接著執行刪除子目綠
                    if(is_dir($Path.'/'.$val)){
                        deldir($Path.'/'.$val);
                        // 子目錄清空後刪除子資料夾
                        // rmdir($Path.'/'.$val);
                    }else{
                        // 如果是檔案直接刪除
                        unlink($Path.'/'.$val);
                    }
                }
            }
        }
        rmdir($Path);
        $msg = "刪除".iconv('Big5','UTF-8',$Path)."資料夾";
    }

    deldir($Path);
?>