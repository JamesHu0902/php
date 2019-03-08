<?Php
    // 函數顯示目前目錄列表
    function showdir(){
        $myUri = $_SERVER['PHP_SELF'];

        // 取得目前目錄網址
        $cwdUri = str_replace(WORK_ROOT,'/Ch07/upload',$_SESSION['cwd']);
        // 設定檔案更名&上傳的程式
        $renphp = 'ch07-5 檔案更名.php';
        $uploadphp = 'ch07-5 上傳.php';

        // 如果 Session 紀錄目錄列表為空，重新讀取
        if(empty($_SESSION['dirs']) || empty($_SESSION['files'])){
            // 用陣列 $arrDirFile 儲存 scandir() 的傳回值
            $arrDirFile = scandir($_SESSION['cwd']);
            // 將 . 與 .. 這兩個目錄名稱刪除
            unset($arrDirFile[0]);unset($arrDirFile[1]);
            // 刪除 session 陣列內容
            unset($_SESSION['dirs']);unset($arrDirFile['files']);
            
            // 將 $arrDirFile 內容依照目錄與檔案分類
            foreach($arrDirFile as $name){
                if(is_dir($name)){
                    $_SESSION['dirs'][] = $name;
                }else{
                    $_SESSION['files'][] = $name;
                }
            }
            unset($arrDirFile);
        }
        // 輸出目錄列表 HTML 碼
        $html = '<tr><td colspan="2" rowspan="1" class="silver">';
        
        if($_SESSION['cwd'] != WORK_ROOT){
            $html .= <<< END_of_HTML
                <a href="$myUri?id=up&op=cd">回上層目錄</a>
                <a href="$myUri?id=root&op=cd">回網站根目錄</a>
END_of_HTML;
        }

        $html .= '<br><a href="'.$uploadphp.'">上傳檔案</a></td></tr>';
        // 輸出子目錄列表
        if(!empty($_SESSION['dirs'])){
            foreach($_SESSION['dirs'] as $key=>$dir){
                $dir = iconv("BIG5","UTF-8",$dir);
                $html .=<<<  END_of_HTML
                    <tr>
                        <td class="silver">
                            <a href="$myUri?id=$key&op=cd">$dir</a>
                        </td>
                        <td class="silver">
                            <a href="$myUri?type=d&id=$key&op=del">刪除</a>
                            <a href="$renphp?type=d&id=$key">更名</a>
                        </td>
                    </tr>
END_of_HTML;
            }
        }
        // 輸出檔案列表
        if(!empty($_SESSION['files'])){
            foreach($_SESSION['files'] as $key=>$file){
                $fname = iconv("big5","UTF-8",$file);
                $file = urlencode($file);  //中文 URL 需編碼處理
                $html .= <<< END_of_HTML
                    <tr>
                        <td>
                            <a href="$cwdUri/$file">$fname</a>
                        </td>
                        <td>
                            <a href="$myUri?type=f&id=$key&op=del">刪除</a>
                            <a href="$myUri?type=f&id=$key&op=cpy">複製</a>
                            <a href="$renphp?type=f&id=$key">更名</a>
                        </td>
                    </tr>
END_of_HTML;
            }
        }
        return $html;
    }
?>