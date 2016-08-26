<?php
/**
 * 写新文章
 */
ini_set('display_errors', 1);
require_once '../../config.inc.php';
//check isAmdin
isAdmin();



if(isset($_POST['addpost'])){
	// if(!$_FILES['slpic']['error']){
		// #/upload/blog/image/{yyyy}{mm}{dd}/{time}{rand:6}
		// $daydir = date('Ymd',time());
		// $filename = time();
		// $filename .= rand(111111,999999);
		// $filename .= '.'.substr($_FILES['slpic']['type'],6);
		// $returnfilename = '/upload/blog/image/'.$daydir.'/'.$filename;

		// $uploaddir = $_SERVER['DOCUMENT_ROOT'].'/upload/blog/image/'.$daydir;
		// if(!is_dir($uploaddir)){
			// mkdir($uploaddir,0777);
		// }

		// if(move_uploaded_file($_FILES['slpic']['tmp_name'],$uploaddir.'/'.$filename)){
			// $listimage = $returnfilename;
		// }
	// }

	$title = addslashes($_POST['title']);
	$subtitle = addslashes($_POST['subtitle']);
	$remark = addslashes(trim($_POST['remark']));
	$author = $_SESSION['admin'];
	$tags = addslashes($_POST['tags']);
	$content = addslashes($_POST['content']);
	$status = $_POST['status'];
	$relatedapps = $_POST['appids'];
	if(empty($listimage)){
		if(preg_match('/<img(.*?)src="(.*?)(?=")/',$_POST['content'],$temp)){
			$listimage = $temp[2];
		}
	}
	if(!empty($listimage))
		$sql = "insert into articles(`title`,`listimage`,`remark`,`tags`,`author`,`status`,`relatedapps`,`subtitle`) values('".$title."','".$listimage."','".$remark."','".$tags."','".$author."',".$status.",'".$relatedapps."','".$subtitle."')";
	else
		$sql = "insert into articles(`title`,`remark`,`tags`,`author`,`status`,`relatedapps`,`subtitle`) values('".$title."','".$remark."','".$tags."','".$author."',".$status.",'".$relatedapps."','".$subtitle."')";
	
	$db->query($sql);
	$articleId = $db->insert_id();
	if($articleId){
		$urlalias = prepareUrlText($title).'-'.$articleId;
		$sql = "update articles set urlalias='".$urlalias."' where id=".$articleId;
		$db->query($sql);

		//content表
		$sql = "insert into cmscontent(`articleid`,`content`) values(".$articleId.",'".$content."')";
		$db->query($sql);

		echo '成功,3秒之后跳转回写文章的页面<script>setTimeout(function(){window.location.href=window.location.href;},3000)</script>';
		
	}
}else{
	//template
	include 'template/add.tpl.php';
}

