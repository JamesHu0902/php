<?Php
    session_start();
    chdir($_SESSION['cwd']); //切換至目前目錄

    // 取得 GET 傳來的各項參數
    $id = $_GET['id'];
    $type = $_GET['type'];

    // 使用 id 取得原始目錄或檔案名稱
    if($type == 'd'){
        $oldname = $_SESSION['dirs'][$id];

    }else{
        $oldname = $_SESSION['files'][$id];
    }

    if(isset($_GET['newname'])){
        $newname = iconv('Big5','UTF-8',$_GET['newname']);
        // 檢查是否輸入新名稱
        echo "進入修改";
        if(!empty($newname) && !empty($oldname)){
            // 檢查是否包含違法字元
            if(preg_match('*[\\/]*',$newname)) die("名稱中不允許 \ 或 / 符號");

            rename($oldname,$newname);
            // 更名後讓 showdir() 重新讀取目錄列表
            // 所以要刪除 sessin 中的列表紀錄
            unset($_SESSION['files']);
            unset($_SESSION['dirs']);
            //轉回目錄列表
            header("Location: ch07-5 主程式.php");
            
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>更改名稱</title>
</head>
<body>
    <form action="<?Php echo $_SERVER['PHP_SELF']; ?>" method="get">
        將 <?Php echo iconv('Big5','UTF-8',$oldname) ?> 改名為 : 
        <input type="text" name = "newname">
        <input type="hidden" name = "id" value ="<?Php echo $id;?>" >
        <input type="hidden" name = "type" value = "<?Php  echo $_GET['type'] ?>">
        <input type="submit" value = "確認">
    </form>
</body>
</html>