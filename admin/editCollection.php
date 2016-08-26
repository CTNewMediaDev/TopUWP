<?php
/**
 * collection edit
 */
ini_set('display_errors', 1);
require_once '../../config.inc.php';

//check isAmdin
isAdmin();


//保存修改
if(isset($_POST['savepost'])){

    //视频信息
    if(isset($_GET['formid'])&&$_GET['formid']=='collectionform'){
        $id = intval(trim($_POST['id']));
        $content = addslashes($_POST['content']);
        $title = addslashes($_POST['title']);
        
        $sql = "update collections set title='".$title."',description='".$content."' where id=".$id;
        $db->query($sql);
        
        $msg = 'Collection信息已保存';
        $formnum=0;
        header("location:editCollection.php?formnum=".$formnum."&id=".$id."&msg=".$msg);
        exit;
    }

    //other参数
    if(isset($_GET['formid'])&&$_GET['formid']=='othersform'){
        $id = intval(trim($_POST['id']));
        $tags = addslashes(trim($_POST['tags']));
        
        if (!$_FILES['slpic']['error']) {
            #/upload/blog/image/{yyyy}{mm}{dd}/{time}{rand:6}
            $daydir = date('Ymd', time());
            $filename = time();
            $filename .= rand(111111, 999999);
            $filename .= '.' . substr($_FILES['slpic']['type'], 6);
            $returnfilename = '/upload/blog/image/' . $daydir . '/' . $filename;

            $uploaddir = $_SERVER['DOCUMENT_ROOT'] . '/upload/blog/image/' . $daydir;
            if (!is_dir($uploaddir)) {
                mkdir($uploaddir, 0777);
            }

            if (move_uploaded_file($_FILES['slpic']['tmp_name'], $uploaddir . '/' . $filename)) {
                $listimage = $returnfilename;
            }
        }
        
        
        if(!empty($tags)){
            deletekeywordconn($db,'collection',$id);
            handlekeywords($db,$tags,'collection',$id);
        }
        
        $sql = "update collections set tags='".$tags."' where id=".$id;
        $db->query($sql);
        if(!empty($listimage)){
            $sql = "update collections set listimage='".$listimage."' where id=".$id;
            $db->query($sql);
        }
        
        
        $msg = '参数已保存';
        $formnum=1;
        header("location:editCollection.php?formnum=".$formnum."&id=".$id."&msg=".$msg);
        exit;
    }


    //apps
    if(isset($_GET['formid'])&&$_GET['formid']=='appsform'){
        $id = intval(trim($_POST['id']));
        if($_POST['action']=='addapp'){
            $collectionId = $id;
            $appId = intval($_POST['appid']);
            $ordernum = intval($_POST['ordernum']);
            $description = addslashes($_POST['appdescription']);
            $tmpconnid = checkAppCollection($db,$appId,$collectionId);
            if(!$tmpconnid){
                $sql = "insert into collectionapp(`appId`,`collectionId`,`ordernum`,`description`,`addtime`) values(".$appId.",".$collectionId.",".$ordernum.",'".$description."',".time().")";
                $db->query($sql);
                $connid = $db->insert_id();
            }else{
                $connid = $tmpconnid;
                $msg = '这个app之前已经添加过了';
            }
            
        }elseif($_POST['action']=='editapp'){
            $collectionId = $id;
            $connid = intval($_POST['connid']);
            $appId = intval($_POST['appid']);
            $ordernum = intval($_POST['ordernum']);
            $description = addslashes($_POST['appdescription']);
            $sql = "update collectionapp set appId=".$appId.",collectionId=".$collectionId.",ordernum=".$ordernum.",description='".$description."' where id=".$connid;
            $db->query($sql);
        }
       
        
        $msg = !isset($msg)?'App信息已保存':$msg;
        $formnum=2;
        header("location:editCollection.php?formnum=".$formnum."&id=".$id."&msg=".$msg);
        exit;
    }

    //修改状态
    if(isset($_GET['formid'])&&$_GET['formid']=='statusform'){
        $id = intval(trim($_POST['id']));
        $status = intval($_POST['status']);
        $sql = "update collections set status=".$status." where id=".$id;
        $db->query($sql);
        $msg = '状态已修改';
        $formnum=3;
        header("location:editCollection.php?formnum=".$formnum."&id=".$id."&msg=".$msg);
        exit;
    }

}else{
    $id = intval($_GET['id']);
    $formnum = isset($_GET['formnum'])?$_GET['formnum']:0; 
    if(isset($_GET['action'])&&$_GET['action']=='editapp'&&!empty($_GET['connid'])){
        $conninfo = $db->fetch_first("select * from collectionapp where id=".intval($_GET['connid']));
        $formnum = 2;
    } 
}

if (empty($id)) {
    $msg = 'ID can not be empty,Please Choose a collection you want to edit';
} else {
    $sql = "select * from collections where id=" . $id;
    $data = $db->fetch_first($sql);
    if (empty($data)) {
        $msg = "There is No collection with this ID";
    }
}

if(isset($_GET['msg'])) $msg = $_GET['msg'];

//template
include 'template/editCollection.tpl.php';
