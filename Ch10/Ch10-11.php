<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<!-- 計算日期php -->
<?Php
    require('Ch10-11.inc.php');

    $db->exec("CREATE TABLE IF NOT EXISTS mymemo 
                (id INTEGER PRIMARY KEY AUTOINCREMENT, memo TEXT,mdate TEXT)");
    // 顯示一周的週曆,先決定顯示哪一週
    // 1. 若傳送 $_GET['goto'] 參數則使用該參數日期
    // 若無參數則使用目前日期
    // 2.接著取得當周的"周日"日期

    // 若GET參數有傳來日期 則以參數日期為準
    if(!empty($_GET['goto'])){
        $dayDiff = date("w",strtotime($_GET['goto']));
        // 取得週日日期
        $sunday = strtotime($_GET['goto'])-$dayDiff*86400;
    }else {
        $dayDiff = date("w");
        $sunday = time()-$dayDiff*86400;
    }
?>
<!-- 行事曆內文開始 -->
<table>
    <!-- 上方年份以及切換週月 -->
    <tr>
        <td colspan = "2">
            <div class="left">
                <a href="Ch10-11.php?goto=<?Php echo date("Y-m-d",$sunday-86400*28)?>">前月</a>
                <a href="Ch10-11.php?goto=<?Php echo date("Y-m-d",$sunday-86400*7)?>">前週</a>
            </div>
            <div class="right">
                <a href="Ch10-11.php?goto=<?Php echo date("Y-m-d",$sunday+86400*7)?>">次週</a>
                <a href="Ch10-11.php?goto=<?Php echo date("Y-m-d",$sunday+86400*28)?>">次月</a>
            </div>
            <div class="year"><?Php echo date("Y",$sunday)   ?></div>
        </td>
    </tr>
    <!-- 從資料庫導出資料渲染下方行事曆 -->
<?Php
    $sql = "select * from mymemo where mdate = ?;";
    $st = $db->prepare($sql);
    $week = ['日','一','二','三','四','五','六'];
    // 用迴圈查詢及輸出 7 天的備忘錄
    for($i=0;$i<7;$i++){
        echo "<tr><td class='day' id='d".$i."'>";
        $day = $sunday + $i*86400;
        echo date("m-d",$day)."({$week[$i]})</td><td>";
        // 用日期當參數進行查詢
        $st->execute( [date("Y-m-d",$day)] );
        $result = $st->fetchAll(); //取得查詢結果
        foreach ($result as $row) {
            // 輸出備忘錄
            echo $row['memo']."\n&nbsp";
            // 製作刪除、編輯連結
            echo "<a href='Ch10-11.upd.php?op=del&id=".$row['id']."&mdate=".date("Y-m-d",$day)."'>刪除</a>";
            echo "\n&nbsp;"."<a href='Ch10-11.edt.php?op=edt&id=".$row['id']."'>編輯</a><br>"."\n";
        }
        // 輸出新增備忘錄連結
        echo "<div class='right'><a href='Ch10-11.edt.php?op=add&mdate=".date("Y-m-d",$day)."'>新增</a></div>";
        echo "</td></tr>";
    }
?>
</table>
</body>
</html>

<style>
    table{
        border:1px solid black;
        width:600px;
    }
    td{
        border:1px solid black;
        padding:2px;
    }
    a{
        font-size:small;
    }
    .left{
        float:left;
    }
    .right{
        float:right;
    }
    .year{
        text-align:center;
        font-size:x-large;
    }
    .day{
        width:30%;
        text-align:center;
        font-size:xx-large;
    }
    #d0{
        color:red;
        background-color:Lavender;
    }
    #d1,#d3,#d5{
        color:green;
        background-color:silver;
    }
    #d2,#d4,#d6{
        color:blue;
        background-color:bisque;
    }
</style>