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
    <?php
        $banner_arr = [1,2,3];
        $index = mt_rand(1,count($banner_arr));
        $imgurl = "http://students.geego.com/2018_0422/james780902/bs/images/menu/menu-";
        // echo "<img src='$imgurl'>"; 
    ?>
    <div class="container bg-light">
        <h3>PHP輪播測試</h3>
        <div class="row  justify-content-center">
            <div id="carouselExampleIndicators" class="carousel slide col-6" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                    <img class="d-block w-100" src="<?php echo $imgurl.$index.'.jpg';?>" alt="First slide">
                    </div>
                    <div class="carousel-item">
                    <img class="d-block w-100" src="<?php $GLOBALS['index']++; if($GLOBALS['index']>3)$GLOBALS['index']=1; echo $imgurl.$index.'.jpg';?>" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                    <img class="d-block w-100" src="<?php $GLOBALS['index']++; if($GLOBALS['index']>3)$GLOBALS['index']=1; echo $imgurl.$index.'.jpg';?>" alt="Third slide">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>  
        </div>
            <h3>網頁聯絡表單測試</h3>
            <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputName">name</label>
                    <input type="name" name="name" class="form-control" id="exampleInputName" placeholder="name">
                </div>
                <div class="form-group">
                    <label for="exampleInputnumber">phone number</label>
                    <input type="text" name="number" class="form-control" id="exampleInputnumber" placeholder="number">
                </div>
                
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    <?php 
    // echo $_POST['email'];echo $_POST['name'];echo $_POST['number'];
        if((isset($_POST['email']) && isset($_POST['name']) && isset($_POST['number']))){
            $to = "james780902@gmail.com";
            $subject = "Test mail";
            $message = "name:{$_POST['name']},number:{$_POST['number']}";
            $from = htmlspecialchars($_POST['email']);
            $headers = "From: $from";
            $para = "Content-Type:text/html;charset=utf-8;";

            if(mail("james780902@gmail.com", $_REQUEST['name'], $_REQUEST['number'], $headers ,$para))
                echo "信件已經發送成功。";//寄信成功就會顯示的提示訊息
                else
                echo "信件發送失敗！";//寄信失敗顯示的錯誤訊息
            
        };
    ?>
</body>
</html>