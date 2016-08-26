<?php include 'template/header.php';?>
<link rel="stylesheet" href="css/jquery-ui.css">
<!--content section start-->
<div>
    <ul class="breadcrumb">
        <li>
            <a href="index.php">Home</a>
        </li>
        <li>
            <a href="#">添加视频</a>
        </li>
    </ul>
</div>
<div class="row">
    <div class="box col-md-12">
        <div style="width:100%;padding-bottom:10px;font-weight:Bold;">
                <a href="video.php" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-list icon-white"></i>返回列表</a>
            </div>
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-edit"></i> 添加视频</h2>
            </div>
            
            <div class="box-content">
                <ul class="nav nav-tabs" id="myTab">
                    <li class="active"><a href="#video">视频信息</a></li>
                </ul>
                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane active" id="video">
                            <form role="form" id="videoform" action="videoadd.php" method="post" enctype="multipart/form-data">
                                
                                <div class="form-group">
                                    <label for="title">视频标题</label>
                                    <input type="text" class="form-control" id="title" name="title" >
                                </div>
                                <div class="form-group">
                                    <label for="title">视频封面图</label>
                                    <input type="text" class="form-control" id="listimage" name="listimage" >
                                </div>

                                <div class="form-group">
                                    <label for="sourceurl">Copy embed Code</label><br>
                                    <textarea name="sourceurl" rows="2" cols="120" id="sourceurl"></textarea>
                                </div>
                                
                                <div class="form-group">
                                    <label for="remark">内容概述</label>
                                    <script id="container" name="remark" type="text/plain">
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
                                <input type="hidden" name="addvideo">
                                <button type="button" onclick="submitform('videoform')" class="btn btn-primary btn-sm" name="addpost">保  存</button>
                            </form>
                    </div>

                   
                </div>  
            </div>
        </div>
    </div>
</div>

<script>
function submitform(formid){
    document.getElementById(formid).submit();
}
</script>
<?php include 'template/footer.php';?>