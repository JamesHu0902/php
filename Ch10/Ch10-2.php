<?Php
class Test{
    function __construct($name = 'no Name'){
        $this->name = $name;
        echo "...正在執行 $this->name 建構方法<br>";
    }
    function __destruct(){
        echo "...正在執行 $this->name 解構方法<br>";
    }
}
$obj = new Test('name');
$obj = new Test;
echo '程式結束<br>';
?>