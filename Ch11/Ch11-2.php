<?php
// 若表單送回 num1 & num2 的內容
if (!empty($_POST['num1']) && !empty($_POST['num2'])) {
    echo $_POST['num1'] + $_POST['num2']; //計算相加
    exit(); //完成後退出 不再重刷頁面
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <title>Document</title>
</head>

<body>
    <input type="text" name="num1" id="num1" size="3" required>+
    <input type="text" name="num2" id="num2" size="3" required>
    <button type="button" id="botton">=</button>
    <span id="answer">?</span>
    <hr>
    <p><i>
            <?php 
            date_default_timezone_set('Asia/Taipei'); //設定時區
            echo "伺服器時間 :" . date('m-d H:i:s');
            ?>
        </i></p>
</body>

</html>

<script>
    $(function() {
        $('button').click(function() {
            // 呼叫 jQuery 的 post() 函數 
            // 參數1 : 被要求的網頁 URL , 參數2 : POST 要求中要送出的參數 , 參數3 : 收到回應,所呼叫的處理的函數
            if ($('#num1').val() != '' && $('#num2').val() != ''){
                $.post("<?php echo $_SERVER['PHP_SELF']; ?>",
                    "num1=" + $('#num1').val() + "&num2=" + $('#num2').val(), //範例輸出結果 num1=1&num2=3
                    function(result) {
                        $('#answer').html(result);
                    } //找到 id = "answer 的 HTML"   
                ); //並將收到回應資料改為標籤內容
            };
        });
    });
</script> 