<?Php
// HTML輸入欄位<input>的類別
class Input
{
    static private $count = 0; //靜態成員:物件總數
    static function getCount(){ //靜態方法:傳回物件總數
        return Input::$count;
    }

    // 儲存網站標題的成員
    private $lable; //輸入欄位的標籤文字
    private $type; //輸入欄位的類型
    private $name; //輸入名稱
    private $value; //輸入欄位預設值
    // 建構式
    function __construct($l,$t,$n,$v){
        Input::$count++ ;//每建構一個物件總數+1
        if(empty($l)) $this->lable = '欄位'.Input::$count.':';
        else $this->lable = $l;
        if(empty($t)) $this->type = "text";
        else $this->type = $t;
        if(empty($n)) $this->name = "input".Input::$count;
        else $this->name = $n;
        if(empty($v)) $this->value = "";
        else $this->value = $v;
    }
    // 解構式
    function __destruct(){
        Input::$count--; //釋放物件總數-1
    }

    // 傳回HTML的函數
    function getHtml(){
        $html = "<span>$this->lable</span>";
        $html .= "<input type=\"$this->type\" name=\"$this->name\" ";
        $html .= "value=\"$this->value\"><br>";
        return $html;
    }

}

$in1 = new Input('帳號 : ','text','id','admin');
$in2 = new Input('密碼 : ','password','pass','');
$in3 = new Input('','','','');
$in4 = new Input('','','','');

echo "已建立".Input::getCount()."個欄位如下 : <br>";
echo $in1->getHtml();
echo $in2->getHtml();
echo $in3->getHtml();
echo $in4->getHtml();

$in1 = NULL; 
echo "<br>現在還有".Input::getCount().'個'.get_class($in3).'類別的物件';
?>