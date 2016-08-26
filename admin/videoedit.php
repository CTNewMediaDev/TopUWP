<?php
/**
 * 编辑文章内容
 */
ini_set('display_errors', 1);
require_once '../../config.inc.php';

//check isAmdin
isAdmin();


//保存修改
if(isset($_POST['editvideo'])){

	//视频信息
	if(isset($_GET['formid'])&&$_GET['formid']=='videoform'){
		$id = intval(trim($_POST['videoid']));
		$remark = addslashes($_POST['remark']);
		$title = addslashes($_POST['title']);
		$listimage = preg_replace('/\?custom.*/i','',addslashes($_POST['listimage']));
		$sourceurl = base64_encode(trim($_POST['sourceurl']));
		
		$sql = "update tp_videos set title='".$title."',listimage='".$listimage."',remark='".$remark."',sourceurl='".$sourceurl."' where id=".$id;
		$db->query($sql);
		
		$msg = '视频信息已保存';
		$formnum=0;
		header("location:videoedit.php?formnum=".$formnum."&id=".$id."&msg=".$msg);
		exit;
	}

	//other参数
	if(isset($_GET['formid'])&&$_GET['formid']=='othersform'){
		$id = intval(trim($_POST['videoid']));
		$visitcount = intval(trim($_POST['visitcount']));
		$keywords = addslashes(trim($_POST['keywords']));
		if(!empty($keywords)){
			@deletekeywordconn($db,'video',$id);
			@handlekeywords($db,$keywords,'video',$id);
		}
		
		$sql = "update tp_videos set visitcount=".$visitcount.",keywords='".$keywords."' where id=".$id;
		$db->query($sql);
		
		$msg = '已保存';
		$formnum=1;
		header("location:videoedit.php?formnum=".$formnum."&id=".$id."&msg=".$msg);
		exit;
	}


	//apps
	if(isset($_GET['formid'])&&$_GET['formid']=='appsform'){
		$id = intval(trim($_POST['videoid']));
		$relatedapps = addslashes(trim($_POST['relatedapps']));
		$subtitle = addslashes(trim($_POST['subtitle']));
		
		$sql = "update tp_videos set relatedapps='".$relatedapps."',subtitle='".$subtitle."' where id=".$id;
		$db->query($sql);
		
		$msg = '已保存';
		$formnum=2;
		header("location:videoedit.php?formnum=".$formnum."&id=".$id."&msg=".$msg);
		exit;
	}

	//修改状态
	if(isset($_GET['formid'])&&$_GET['formid']=='statusform'){
		$id = intval(trim($_POST['videoid']));
		$status = intval($_POST['status']);
		$sql = "update tp_videos set status=".$status." where id=".$id;
		$db->query($sql);
		$msg = '状态已经修改';
		$formnum=3;
		header("location:videoedit.php?formnum=".$formnum."&id=".$id."&msg=".$msg);
		exit;
	}

}else{
	$id = intval($_GET['id']);
	$formnum = isset($_GET['formnum'])?$_GET['formnum']:0;	
}

if(empty($id)){
	$msg = 'ID can not be empty,Please Choose an video you want to edit';
}else{
	$sql = "select * from tp_videos where id=".$id;
	$data = $db->fetch_first($sql);
	if(empty($data)){
		$msg = "There is No video with this ID";
	}
}

if(isset($_GET['msg'])) $msg = $_GET['msg'];

//template
include 'template/videoedit.tpl.php';

