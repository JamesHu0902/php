<!DOCTYPE html>
<html lang="en">
<head>
    <?Php session_start();?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?Php 
        if(!empty($_FILES['UpFile'])){
            // 定義存放檔案目錄
            $upload_dir = $_SESSION['cwd'];
            // 使用 foreach 逐筆讀取 $_FILES['UpFile']['error] 陣列
            // 在迴圈中，索引存在 $key變數 錯誤代碼存在 $err變數

            foreach($_FILES['UpFile']['error'] as $key=>$err){
                $fname = iconv('Big5','UTF-8',$_FILES['UpFile']['name'][$key]);
                // 如果上傳成功 把檔案移至目前目錄下
                if($err == UPLOAD_ERR_OK){
                    move_uploaded_file($_FILES["UpFile"]["tmp_name"][$key],"$upload_dir/".$fname);
                    echo $_FILES['UpFile']['name'][$key]."上傳成功<br>";
                    // 上傳後 讓程式重新讀取目錄列表
                    // 所以刪除 session 列表紀錄
                    unset($_SESSION['files']);
                    unset($_SESSION['dirs']);
                }elseif($err != UPLOAD_ERR_NO_FILE){
                    echo $_FILES['UpFile']['name'][$key]."上傳失敗<br>";
                }
            }
        }
    ?>
    <p>將檔案上傳到 : </p>
    <form action="<?Php echo $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
        請輸入要上傳的檔案名稱 : <br>
        <input type="file" name = "UpFile[]"><br>
        <input type="file" name = "UpFile[]"><br>
        <input type="file" name = "UpFile[]"><br>
        <input type="submit" value = "送出">
    </form>
    <p><a href="ch07-5 主程式.php">回檔案總管</a></p>
</body>
</html>