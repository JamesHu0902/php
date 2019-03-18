<?php
//導入 XAJAX
require('ch11-xajax.php');
require('Ch11-4.test.php');
// 註冊函數並取得傳回值
$request = $xajax->register(XAJAX_FUNCTION, "adding");
$request->useSingleQuote(); //使用單引號輸出程式碼
$request->addParameter(XAJAX_INPUT_VALUE,'num1'); //加入參數1
$request->addParameter(XAJAX_INPUT_VALUE,'num2'); //加入參數2
// 處理非同步要求
$xajax->processRequest();
// function adding($num1,$num2){
//     $objResponse = new xajaxResponse();
//     $objResponse->assign(
//         'answer',  //指定 id = 'answer' 的元素
//         'innerHTML', //設定 innerHTML 的屬性
//         $num1+$num2  //回應為 兩參數的和
//     );
//     return $objResponse;
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php $xajax->printJavascript();?>
    <title>Document</title>
</head>
<body>
    <p>使用 xajaxRequest</p>
    <input type="text" size="3" name="num1" id="num1">+
    <input type="text" size="3" name="num2" id="num2">
    <button onclick="<?php $request->printscript(); ?>">=</button>
    <span id="answer">?</span>
</body>
</html>