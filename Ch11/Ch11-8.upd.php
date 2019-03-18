<?php
function editor($op,$id,$mdate){
    global $db;
    $response = new xajaxResponse();

    if(empty($op)) return $response; //沒資料就返回
    if($op == 'edt') {
        if(empty($id)) return $response;
        $sql = "select * from mymemo where id = ?;";
        $st = $db->prepare($sql);
        $st->bindValue(1,$id,PDO::PARAM_INT);
        $st->execute();
        $row = $st->fetch();
        if(empty($row))return $response;
        // 設定資料至表單中的欄位
            $response->assign('op','value','upd')
                    ->assign('id','value',$id)
                    ->assign('memo','value',$row['memo'])
                    ->assign('mdate','value',$row['mdate'])
                    ->assign('submit','innerHTML','儲存');
    }else{
        // 新增資料不需查詢
        if(empty($mdate)) return $response;
        // 設定資料表中欄位
            $response->assign('op','value','ins')
                    ->assign('id','value','')
                    ->assign('memo','value','')
                    ->assign('mdate','value',$mdate)
                    ->assign('submit','innerHTML','新增');
    }
    return $response->assign('inputform','style.visibility','visible');
}
?>