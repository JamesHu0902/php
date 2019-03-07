<?Php
    session_start();

    $ds = DIRECTORY_SEPARATOR ; //分隔符號變數
    // 將網路的工作目錄設定為 WORK_ROOT 常數
    // 程式會限制目錄切換或檔案操作均不得超出工作目錄
    define('WORK_ROOT',$_SERVER['DOCUMENT_ROOT'].'/Ch07/upload');
    $msg = '';  //存放信息

    // 若目前目錄未設定，則設定為網站根目錄
    if(! isset($_SERVER['cwd'])) $_SERVER['cwd'] = WORK_ROOT;
    // 切換到目前目錄
    chdir($_SERVER['cwd']);

// 判斷使用者執行的操作開始
    // 判斷op是否存在
    if(!empty($_GET['op'])){
        $id  = $_GET['id'];
        switch($_GET['op']){
            // 切換目錄
            case 'cd':
                if($id=='root'){    //切換到根目錄
                    chdir(WORK_ROOT);
                }elseif($id=='up'){  //切換到上一層目錄
                    chdir($_SESSION['cwd'].'/..');
                }elseif(isset($_SESSION['dirs']['id'])){
                    // 切換到id參數指定路徑
                    chdir($_SESSION['cwd'].'/'.$_SESSION['dirs'][$id]);
                }
                // 重新讀取目前目錄 getcwd() 回傳
                $_SESSION['cwd'] = str_replace('\\','/',getcwd());
                if( substr($_SESSION['cwd'],0,strlen(WORK_ROOT)) != WORK_ROOT){
                    chdir(WORK_ROOT);
                    $_SESSION['cwd'] = getcwd();
                }
            break;
            // 刪除目錄或檔案
            case 'del':
                if($_GET['type']=='d') $type = 'dirs';
                else $type = 'files';

                if(isset($_SESSION[$type][$id])){
                    // 讀取要刪除的檔案或目錄
                    $delName = $_SESSION[$type][$id];
                    unlink($delName);
                    // 設定信息
                    $msg = "刪除".iconv('Big5','UTF-8',$delName);
                }
                break;
            // 複製檔案
            case 'cpy':
                // 使用迴圈複製
                for($i=1 ;$i<100 ;$i++){
                    $cpyFilename = "copy$i-".$_SESSION['files'][$id];
                    // 檢查此序號是否存在，如果在，就使用下一個
                    if(file_exists($cpyFilename)){
                        continue;
                    }else{
                        copy($_SESSION['files'][$id],$cpyFilename);
                        break;
                    }
                }
                // 設定相關信息
                $msg = iconv('Big5','UTF-8',$_SESSION['files'][$id])."複製為".iconv('Big5','UTF-8',$cpyFilename);
                break;
        }

        // 切換目錄，或者操作檔案後目錄列表已經改變
        // 所以刪除紀錄列表的 Session, 重新讀取
        unset($_SESSION['dir']);
        unset($_SESSION['files']);
    }
// 判斷使用者執行的操作結束

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>網站伺服器檔案總管</title>
</head>
<body>
    <p><?Php echo $msg; ?></p>
    <table border="3" cellspacing="3" cellpadding="3">
        <tr>
            <td colspan="2" rowspan="1" class="silver header">
                目前目錄 :<?Php echo iconv('Big5','UTF-8',$_SESSION['cwd']) ?>
            </td>
        </tr>
        <?Php echo showdir() ;?>
    </table>
</body>
</html>

<?Php include 'ch07-5 showdir自訂函數.php' ?>
<style>
    .silver{
        color : wite;
        background : silver;
    }
    .header{
        font-size : 36px;
    }
    p,table{
        text-align:center;
    }
</style>