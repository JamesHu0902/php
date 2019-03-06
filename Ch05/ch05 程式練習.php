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
    
    <title>ch05程式練習</title>
</head>
<body>
    <h1>ch05程式練習</h1>
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
                <h3>溫度換算</h3>
                <?Php include 'ch05 溫度換算.php' ?>
                </div>
                <div class="tab-pane fade" id="list-2" role="tabpanel" aria-labelledby="list-2-list">
                <h3>Max & Min</h3>
                <?Php include 'ch05 Max & Min.php' ?>
                </div>
                <div class="tab-pane fade" id="list-3" role="tabpanel" aria-labelledby="list-3-list">
                <h3>計算天數差</h3>
                <?Php include 'ch05 計算日期差.php' ?>
                </div>
                <div class="tab-pane fade" id="list-4" role="tabpanel" aria-labelledby="list-4-list">
                <h3>ch4-8 登入程式處理</h3>
                <?Php include 'ch05 登入預處理.php' ?>
                </div>
                <div class="tab-pane fade" id="list-5" role="tabpanel" aria-labelledby="list-5-list">
                <h3>網頁聯絡表單</h3>
                <?Php include 'ch05-15 mail.php' ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>