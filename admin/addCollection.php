<?php
/**
 * 添加app分类
 */
require('../../config.inc.php');
isAdmin();
if (isset($_POST['addpost'])) {

    $title = addslashes($_POST['title']);
    $content = addslashes($_POST['content']);
    
    $sql = "insert into collections(`title`,addtime,description) values('" . $title . "'," . time() . ",'" . $content . "')";
    $db->query($sql);
    $collectionId = $db->insert_id();
    if ($collectionId) {
        $urlalias = prepareUrlText($title) . '-' . $collectionId;
        $sql = "update collections set alias='" . $urlalias . "' where id=" . $collectionId;
        $db->query($sql);
        header("location:editCollection.php?formnum=0&id=".$collectionId."&msg=".$msg);
        exit;
    }
} else {
    //template
    include 'template/addCollection.tpl.php';
}
