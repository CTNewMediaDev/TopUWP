<?php
/**
 * delete app
 */

ini_set('display_errors', 1);
require_once '../../config.inc.php';

//check isAmdin
isAdmin();

$id = intval($_GET['id']);
if(empty($id)){
	echo 'no this video';
	exit();
}	
$sql = "select id from tp_videos where id=".$id;
$data = $db->fetch_first($sql);
if(empty($data)){
	$msg = "There is No video with this ID";
	echo $msg;
	exit();
}

$sql = "delete from tp_videos where id=".$id;
$db->query($sql);

$db->query("delete from tp_keywords_conn where conntype='video' and itemid=".$id);

echo 'success';