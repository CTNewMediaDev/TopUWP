<?php include 'template/header.php';?>
<!--content section start-->
<div>
    <ul class="breadcrumb">
        <li>
            <a href="index.php">Home</a>
        </li>
        <li>
            <a href="#">编辑视频信息</a>
        </li>
    </ul>
</div>
<div class="row">
    <div class="box col-md-12">
        <div style="width:100%;font-weight:Bold;padding-bottom:10px;">
                <a href="videoadd.php" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-plus icon-white"></i>添加视频</a>&nbsp;&nbsp; <a href="video.php" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-list icon-white"></i>返回列表</a>
            </div>
        <div class="box-inner">
            
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-edit"></i> 编辑视频信息</h2>
            </div>
            <div class="box-content">
                <?php if(!empty($msg)):?>
                    <div style="width:100%;height:30px;font-size:12px;color:green;">
                        <?php echo $msg;?>
                    </div>
                <?php endif;?>
                <ul class="nav nav-tabs" id="myTab">
                    <li><a href="#video">视频信息</a></li>
                    <li><a href="#others">其它参数</a></li>
                    <li><a href="#apps">关联Apps设置</a></li>
                    <li><a href="#status">状态设置</a></li>
                </ul>
                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane active" id="video">
                            <form role="form" id="videoform" action="videoedit.php?formid=videoform" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="videoid" value="<?php echo $data['id']?>">
                                <br>
                                <div class="form-group">
                                    <label for="title">视频标题</label>
                                    <input type="text" class="form-control" id="title" name="title" value="<?php echo $data['title'];?>">
                                </div>

                                <div class="form-group">
                                    <label for="listimage">视频封面图</label>
                                    <input type="text" class="form-control" id="listimage" name="listimage" value="<?php echo $data['listimage'];?>">
                                </div>

                                <div class="form-group">
                                    <label for="sourceurl">Copy embed Code</label><br>
                                    <textarea name="sourceurl" rows="2" cols="120" id="sourceurl"><?php echo base64_decode($data['sourceurl']);?></textarea>
                                </div>
                                
                                
                                <div class="form-group">
                                    <label for="remark">内容概述</label>
                                    <script id="container" name="remark" type="text/plain">
                                     <?php echo $data['remark'];?>
                                    </script>
                                    
                                    <script type="text/javascript" src="ueditor/ueditor.config.js"></script>
                                    
                                    <script type="text/javascript" src="ueditor/ueditor.all.js"></script>
                                    
                                    <script type="text/javascript">
                                        var ue = UE.getEditor('container',{
                                            initialFrameHeight:320,
                                            initialFrameWidth:1000,
                                            
                                        });
                                    </script>
                                </div>
                                <input type="hidden" name="editvideo">
                                <button type="button" onclick="submitform('videoform')" class="btn btn-primary btn-sm" name="addpost">保  存</button>
                            </form>
                    </div>

                    <div class="tab-pane" id="others">
                        <form role="form" id="othersform" action="videoedit.php?formid=othersform" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="videoid" value="<?php echo $data['id']?>">
                            <br>
                            <div class="form-group">
                                    <label for="keywords">keywords</label>
                                    <input type="text" class="form-control" id="keywords" name="keywords" value="<?php echo $data['keywords'];?>">
                            </div>
                            <div class="form-group">
                                    <label for="visitcount">visit counts</label>
                                    <input type="text" class="form-control" id="visitcount" name="visitcount" value="<?php echo $data['visitcount'];?>">
                            </div>
                            <input type="hidden" name="editvideo">
                            <button type="button" onclick="submitform('othersform')" class="btn btn-primary btn-sm" name="addpost">保  存</button>
                        </form>
                    </div>
                    <div class="tab-pane" id="apps">
                        <form role="form" id="appsform" action="videoedit.php?formid=appsform" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="videoid" value="<?php echo $data['id']?>">
                            <br>
                            <div class="form-group">
                                    <label for="subtitle">Subtitle</label>
                                    <input type="text" class="form-control" id="subtitle" name="subtitle" value="<?php echo $data['subtitle'];?>">
                            </div>
                            <div class="form-group">
                                    <label for="relatedapps">Apps ids (','分隔)</label>
                                    <input type="text" class="form-control" id="relatedapps" name="relatedapps" value="<?php echo $data['relatedapps'];?>">
                            </div>
                            <input type="hidden" name="editvideo">
                            <button type="button" onclick="submitform('appsform')" class="btn btn-primary btn-sm" name="addpost">保  存</button>
                        </form>
                    </div>
                    
                    <div class="tab-pane" id="status">
                        <form role="form" id="statusform" action="videoedit.php?formid=statusform" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="videoid" value="<?php echo $data['id']?>">
                            <br>
                            <div class="form-group">
                                <label for="remark">状态</label>
                                <select name="status">
                                    <option value="0" <?php if($data['status']==0):?>selected<?php endif;?>>未发布</option>
                                    <option value="1" <?php if($data['status']==1):?>selected<?php endif;?>>发布</option>
                                </select>
                            </div>
                            <input type="hidden" name="editvideo">
                            <button type="button" onclick="submitform('statusform')" class="btn btn-primary btn-sm" name="addpost">保  存</button>
                        </form>
                    </div>

                </div>  
            </div>
        </div>
    </div>
</div>

<script>
$(function(){
    $('#myTab li:eq(<?php echo $formnum;?>) a').tab('show');
});

function submitform(formid){
    document.getElementById(formid).submit();
}
</script>
<?php include 'template/footer.php';?>