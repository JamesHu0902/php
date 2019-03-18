<?php
function submit($form){
    global $db;
    $response = new xajaxResponse();

    if(empty($form['op'])) return $response;
    
    switch($form['op']){
    // 刪除
    case 'del':
        if(empty($form['id']))$response;
        $st = $db->prepare('delete from mymemo where id = ?;');
        $st->bindValue(1,$form['id'],PDO::PARAM_INT);
        $result = $st->execute();

        if(!$result) $response;
        $msg = "刪除成功";
        break;
    // 新增
    case 'ins':
        if(empty($form['memo']))$response;
        $st = $db->prepare('insert into mymemo (memo,mdate) values(?,?) ; ');
        $st->bindValue(1,$form['memo'],PDO::PARAM_STR);
        $st->bindValue(2,$form['mdate'],PDO::PARAM_STR);
        $result = $st->execute();

        if(!$result) $response;
        $msg = "新增成功";
        break;
    // 更新
    case 'upd':
        if(empty($form['memo']))$response;
        $st = $db->prepare('update mymemo set memo = ? where id = ?;');
        $st->bindValue(1,$form['memo'],PDO::PARAM_STR);
        $st->bindValue(2,$form['id'],PDO::PARAM_INT);
        $result = $st->execute();

        if(!$result) $response;
        $msg = "更新成功";
        break;
    }

    $response->call('xajax_load', $form['mdate']);
    $response->alert($msg);
    return $response->assign('inputform',
    'style.visibility','hidden');
}
?>