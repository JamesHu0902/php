var readTimer; //定時器

function starRead(){
    xajax_read();
    readTimer = setTimeout('starRead()',3000);
}

// 檢查 是否支援HTML 5 input color 屬性
function check_input_color(){
    var i = document.getElementById('bgcolorselect');
    // 有支援 HTML5
    if(i.type == "color"){
        i.onchange = function(){ //當更換顏色開關改變時
            document.body.style.background = i.Value;  //改變背景色
        }
    }else{
    // 不支援 HTML5
        var span = document.getElementById('bgcolorselect');
        span.parentNode.removeChild(span); //移除 span
    }
}

// 檢查是否輸入空白訊息
function check(){
    // 取得代表訊息的物件
    msg = document.getElementById('usermsg');
    if(msg.value == ""){
        alert("未輸入訊息");
    }else{
        // 以 XAJAX 送出
        xajax_send(xajax.getFormValues('bottom'));
        clearTimeout(readTimer);
        starRead(); //重新設定定時讀取
        msg.value = ""; //將輸入訊息區清空
        msg.focus();    //將游標移置輸入訊息區

    }
}

// 將訊息捲動至最下方
function scrollDiv(){
    var objDiv = document.getElementById('allmsg');
    if(!document.getElementById('noscroll').checked)
    objDiv.scrollTop = objDiv.scrollHeight;
}