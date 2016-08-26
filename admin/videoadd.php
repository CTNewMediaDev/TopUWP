<?php
/**
 * 添加视频
 */
ini_set('display_errors', 1);
require_once '../../config.inc.php';
//check isAmdin
isAdmin();



if(isset($_POST['addvideo'])){
	$title = addslashes($_POST['title']);
	$listimage = preg_replace('/\?custom.*/i','',addslashes($_POST['listimage']));
	$sourceurl = base64_encode(trim($_POST['sourceurl']));
	$remark = addslashes($_POST['remark']);

	$sql = "insert into tp_videos(`title`,`sourceurl`,`remark`,`listimage`) values('".$title."','".$sourceurl."','".$remark."','".$listimage."')";
	$db->query($sql);
	$videoid = $db->insert_id();
	$urlalias = prepareUrlText($title);
	$urlalias .= '-'.$videoid;
	$db->query("update tp_videos set urlalias='".$urlalias."' where id=".$videoid);
	header("location:videoedit.php?id=".$videoid);
	exit();
}else{
	//template
	include 'template/videoadd.tpl.php';
}