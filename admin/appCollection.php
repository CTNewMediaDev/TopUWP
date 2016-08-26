<?php
/**
 * collection相关APP
 */

include("../../config.inc.php");
if (empty($_GET['id'])) {
    echo 'No Collection Selected';
    exit();
}
$id = $_GET['id'];
if (!empty($_GET['action'])) {
    if (($_GET['action'] == 'add')) {
        if (!empty($_POST['appId']) && !empty($_POST['description'])) {
            $sql = "insert into collectionapp(appId,collectionId,addtime,description) VALUES ('" . $_POST['appId'] . "','" . $id . "','" . time() . "','" . $_POST['description'] . "')";
            if($db->query($sql)){
                header("location:appCollection.php?id=".$id);
            }
        }
    }
    else if($_GET['action']=='delete'){
        $sql="delete from collectionapp where id=".$id;
        if($db->query($sql)){
            echo 1;
            exit();
        }else{
            echo 0;
            exit();
        }
    }
    elseif($_GET['action']=='edit'){
        $appId = intval($_POST['appId']);
        $description = addslashes($_POST['description']);
        $appCollectionId= intval($_GET['appCollectionId']);
        $sql="update collectionapp set appId=$appId,description='".$description."' where id=$appCollectionId";
        if($db->query($sql)){
            header("location:appCollection.php?id=$id");
        }
    }
}
$title=$db->fetch_first("select title from collections where id=".$id);
include('template/appCollection.tpl.php');