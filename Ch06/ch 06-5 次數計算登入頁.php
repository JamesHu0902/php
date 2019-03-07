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
<body>
    
    <form class="w-25 mx-auto mt-5" action="<?Php echo $_SERVER['PHP_SELF']?>" method="post">
        <div class="form-group">
            <label for="exampleInputEmail1">Username</label>
            <input type="text" class="form-control" id="exampleInputEmail1" 
            aria-describedby="emailHelp" placeholder="Username" name="Uname" required>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" 
            placeholder="Password" name="Password" required>
        </div>
        <button type="submit" class="btn btn-primary">送出</button>
    </form>
    
    <?Php
        session_start();

        $user = ['admin'=>'12345','james'=>'780902'];
        
        $errmsg = "帳號密碼錯誤";
        if( isset($_POST['Uname']) && isset($_POST['Password'])){
            $name = $_POST['Uname'];
            $password = $_POST['Password'];
            if( $user[$name] == $password ){
                $_SESSION['name'] = $name;
                $_SESSION['setCounter'] = TRUE;
                header('Location: ch 06-5-2 次數計算.php');
                exit();
            }else echo $errmsg;
            
            
        }
    ?>
</body>
</html>
