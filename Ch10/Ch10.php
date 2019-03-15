<?Php
class WebPage{
    // 儲存網站標題
    var $title;

    // 顯示網頁
    function show() {
        echo <<<HTML_TEXT
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta http-equiv="X-UA-Compatible" content="ie=edge">
                <title>$this->title</title>
            </head>
            <body>
                <p>$this->body</p>
            </body>
            </html>
HTML_TEXT;            
    }
}

$obj = new WebPage;
$obj->title ="測試類別與物件";
$obj->body ="這是body";
$obj->show();
?>
