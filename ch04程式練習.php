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
    
    <title><?Php if(isset($_POST['name2'])) 
                    echo 'Hello&nbsp&nbsp'.$_POST['name2'].'!!';?></title>
</head>
<body>
    <h1>程式練習</h1>
    <div class="row">
        <div class="col-2">
            <div class="list-group" id="list-tab" role="tablist">
                <a class="list-group-item list-group-item-action active" id="list-1-list" data-toggle="list" href="#list-1" role="tab" aria-controls="1">1</a>
                <a class="list-group-item list-group-item-action" id="list-2-list" data-toggle="list" href="#list-2" role="tab" aria-controls="2">2</a>
                <a class="list-group-item list-group-item-action" id="list-3-list" data-toggle="list" href="#list-3" role="tab" aria-controls="3">3</a>
                <a class="list-group-item list-group-item-action" id="list-4-list" data-toggle="list" href="#list-4" role="tab" aria-controls="4">4</a>
                <a class="list-group-item list-group-item-action" id="list-5-list" data-toggle="list" href="#list-5" role="tab" aria-controls="5">5</a>
            </div>
        </div>
        <div class="col-10">
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="list-1" role="tabpanel" aria-labelledby="list-1-list">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">使用者姓名</span>
                        </div>
                        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" >
                           <input type="text" placeholder="請輸入使用者姓名" name="name"> 
                           <input class="btn btn-primary" type="submit" value="確認">
                        </form>
                    </div> 
                    <?Php
                        if(isset($_POST['name'])) 
                        echo 'Hello&nbsp&nbsp'.$_POST['name'].'!!';

                    ?>   
                </div>
                <div class="tab-pane fade" id="list-2" role="tabpanel" aria-labelledby="list-2-list">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">使用者姓名</span>
                        </div>
                        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" >
                           <input type="text" placeholder="請輸入使用者姓名" name="name2"> 
                           <input class="btn btn-primary" type="submit" value="確認">
                        </form>
                    </div>
                    <?Php echo 'title修改完成'?>
                </div>
                <div class="tab-pane fade" id="list-3" role="tabpanel" aria-labelledby="list-3-list">
                    <h3>請設計一PHP程式計算定義常數 log 2的值，並用此常數算出 log 8,log 64,log 512的值。</h3>
                    <?Php
                        echo 'log 2 = '.(log(2) . "<br>");
                        echo 'log 8 = '.(log(8) . "<br>");
                        echo 'log 64 = '.(log(64) . "<br>");
                        echo 'log 512 = '.(log(512) . "<br>");
                    ?>
                </div>
                <div class="tab-pane fade" id="list-4" role="tabpanel" aria-labelledby="list-4-list">
                    <h3>計算BMI</h3>
                    <div class="input-group mb-3">
                        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" >
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">身高</span>
                            </div>
                            <input type="text" placeholder="請輸入身高" name="hight">公分
                            <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">體重</span>
                            </div>
                            <input type="text" placeholder="請輸入體重" name="width">KG  
                            <input class="btn btn-primary" type="submit" value="確認">
                        </form>
                    </div>
                    
                    <?Php
                        if((isset($_POST['hight']) && isset($_POST['width']))&&
                            ($_POST['hight']>0 && $_POST['width']>0)){

                            $h = $_POST['hight'] / 100 ;
                            $w = $_POST['width'];
                            $BMI = $w / ($h*$h);
                            $status = '';
                            if($BMI>23) $status = '體重過重';
                            else if($BMI<18.5) $status = '體重過輕' ;
                            echo "您的BMI ".$BMI."<b>$status</b>";
                        }
                    ?>
                </div>
                <div class="tab-pane fade" id="list-5" role="tabpanel" aria-labelledby="list-5-list">
                    <h3>阿拉伯數字轉換成中文數字</h3>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">阿拉伯數字</span>
                        </div>
                        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" >
                           <input type="text" placeholder="請輸入3位阿拉伯數字" name="number"> 
                           <input class="btn btn-primary" type="submit" value="確認">
                        </form>
                    </div>

                    <?php
                        $str = $_POST['number'];
                        
                        $strarr = preg_split('//', $str, -1, PREG_SPLIT_NO_EMPTY);

                        if(isset($_POST['number']) && ($_POST['number'] > 0)){
                            $chnumber = ['零','一','二','三','四','五','六','七','八','九'];
                            echo '中文數字:';
                            echo $chnumber[$strarr[0]].'百'.$chnumber[$strarr[1]].'十'.$chnumber[$strarr[2]];
                        } 
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>