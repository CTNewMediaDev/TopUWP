<?php
/**
 * delete collection
 */

ini_set('display_errors', 1);
require_once '../../config.inc.php';

//check isAmdin
isAdmin();

$id = intval($_GET['id']);
if(empty($id)){
    echo 'no this article';
    exit();
}
$sql = "select id from collections where id=".$id;
$data = $db->fetch_first($sql);
if(empty($data)){
    $msg = "There is No Collection with this ID";
    echo $msg;
    exit();
}

$sql = "delete from collections where id=".$id;
$db->query($sql);

echo 'success';