<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <!-- 導入bs4 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    
    <title>Document</title>
</head>
<body class="m-5">
    <div class="mt-5">
        <p>1.輸入姓名，儲存於Cookie中。</p>
        <b><?Php if(isset($_COOKIE['name']))echo $_COOKIE['name']."你好!!";?></b>
        <form action="<?Php echo $_SERVER['PHP_SELF'] ?>" method="post">
            <div class="form-group w-25">
                <input type="text" class="form-control" 
                id="" placeholder="輸入姓名" name = "Uname" required>
                <button type="submit" class="btn btn-primary">送出</button>   
            </div>
        </form>
        <?Php
            if(isset($_POST['Uname'])){
                $name = $_POST['Uname'];
                setcookie("name" , $name , time()+20*60,'./cookie');
            };
        ?>
    </div>
    <div class="mt-5">
        <p>2.將 1 的程式放入 2 個子資料夾在setcookie()加入存取路徑參數</p>
        <?Php
        include './cookie/function1.php';
        include './cookie/function2.php';
        ?>
    </div>
    <div class="mt-5">
        <p>3.修改 1 的程式，增加該使用者上次到訪時間，且重新整理頁面不受影響</p>
        <?Php
        session_start();
        date_default_timezone_set('Asia/Taipei');
        $last = date('n')."月".date('j')."日".date("G")."點".date('i')."分".date('s')."秒";
        if(isset($_SESSION['last']))echo "您上次到訪的時間是:".$_SESSION['last'];
        else {
            $_SESSION['last'] = $last;
        }
        ?>
    </div>
    <div class="mt-5">
        <p>4.撰寫依網頁可使用上一頁下一頁的步驟，至少3頁</p>
        <div class="col">
            <a href="ch 06-5 登入.php" 
            class="btn btn-primary btn-lg active" role="button" aria-pressed="true">前往頁面</a>
        </div>
    </div>
    <div class="mt-5">
        <p>5.改善 ch06-5的程式，讓使用者無法在為登入情況下進入其他頁面。</p>
        <div class="col">
            <a href="ch 06-5 登入.php" 
            class="btn btn-primary btn-lg active" role="button" aria-pressed="true">前往頁面</a>
        </div>
    </div>
</body>
</html>