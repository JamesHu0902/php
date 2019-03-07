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
    
    <title>Ch06 問答過關</title>
</head>
<body>
    <?Php session_start(); 
        $level = 1;
        // 用$_GET判斷是否選擇重玩一次如果有 重設等級
        if(isset($_GET['replay']) && $_GET['replay']==1){
            $_SESSION['level'] = 1;
            // 變更COOKIE紀錄
            setcookie("level",1,time()+30*60);
        };

        // 如果session 裡存在level標示登入過 繼續上次關卡
        if(isset($_SESSION['level'])){
            $level = $_SESSION['level'];
        }
        // 檢查COOKIE裡的 level 如果沒有表示第一次玩或者已經過關
        else if(isset($_COOKIE['level'])){
            // 如果COOKIE存在 把關卡數帶入SESSION&變數LEVEL
            $level = $_SESSION['level'] = $_COOKIE['level'];
        }else{
            $level = $_SESSION['level'] = 1;
            setcookie("level" , 1 , time()+30*60);
        };

        // 關卡判斷
        $x = rand(1,10);
        $y = rand(1,10);
        $answer = $x + $y;
        $err = '';
        setcookie("answer",$answer,time()+10*60);
        
        if(isset($_POST['answer'])){
            if($_POST['answer'] == $_COOKIE['answer']){
                // 答對進入下一關
                $_SESSION['level'] += 1;
                $level = $_SESSION['level'];
                setcookie("level",$level,time()+30*60);
                // 如果過關刪除Session & cookie
                if($level > 6){
                    unset($_SESSION['level']);
                    setcookie("level",1,time()-10);
                    $err = "";
                }
            }else{
                $err = "答錯了!!再來一次!!";
            }
        }
    ?>
    <form action="<?Php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <div class="container text-center">
            <!-- 使用者名稱顯示 -->
            <div class="row">
                <b>親愛的<?Php echo $_SESSION['name'];
                        echo $err;?></b>
            </div>
            <!-- 互動對話框 -->
            <div class="row">
                <b><?Php
                    if($level==1)echo "歡迎接受挑戰".$_SESSION['name']."!!"; 
                    elseif($level<6) echo "加油!!現在第".$level."關";
                    elseif($level==6) echo "加油!!現在是最後一關了!!";
                    elseif($level >6) echo "恭喜你成功闖關了勇士!!".$_SESSION['name']."!!";

                ?></b>
            </div>
            <!-- 關卡內容 -->
            <div class="row">
                <div>
                    <?Php if($level<=6){
                        echo $x."+".$y."= ?";
                    }   ?>
                </div>
            </div>
            <!-- 填答區 -->
            <div class="row">
                <form>
                    <div class="form-group">
                        <input type="text" class="form-control" 
                        id="" placeholder="輸入答案" name = "answer" required>
                        <button type="submit" class="btn btn-primary">送出</button>   
                    </div>
                </form>
            </div>
            <!-- 重新開始&回會員專區 -->
            <div class="row">
                <div class="col">
                <a href="ch 06-5 問答過關.php?replay=1" 
                class="btn btn-primary btn-lg active" role="button" aria-pressed="true">重頭開始</a>
                </div>
                <div class="col">
                <a href="ch 06-5-2 次數計算.php" 
                class="btn btn-primary btn-lg active" role="button" aria-pressed="true">回會員專區</a>
                </div>
            </div>
        </div>
    </form>
</body>
</html>