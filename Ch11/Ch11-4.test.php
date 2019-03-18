<?php
function adding($num1,$num2){
    $objResponse = new xajaxResponse();
    $objResponse->assign(
        'answer',  //指定 id = 'answer' 的元素
        'innerHTML', //設定 innerHTML 的屬性
        $num1+$num2  //回應為 兩參數的和
    );
    return $objResponse;
}
?>