<?php include 'template/header.php';?>
<!--content section start-->
<div>
    <ul class="breadcrumb">
        <li>
            <a href="index.php">Home</a>
        </li>
        <li>
            <a href="#">修改文章</a>
        </li>
    </ul>
</div>
<div class="row">
    <div class="box col-md-12">
        <div style="width:100%;padding-bottom:10px;font-weight:Bold;">
                <a href="add.php" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-plus icon-white"></i>添加文章</a>
                &nbsp;&nbsp;
                <a href="index.php" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-list icon-white"></i>返回列表</a>
            </div>
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-edit"></i> 编辑文章内容</h2>
            </div>
            
            <div class="box-content row" style="padding:20px;">
                <?php if(!empty($msg)):?>
                    <p style="color:green;padding-left:40px;font-size:16px;font-family:inherit;font-weight:bold;">
                        <i class="glyphicon glyphicon-info-sign"></i>&nbsp;&nbsp;<?php echo $msg;?>
                    </p>
                <?php endif;?>    
                <form role="form" action="edit.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="title">标题</label>
                        <input type="hidden" name="articleid" value="<?php echo $data['articleid']?>">
                        <input type="text" class="form-control" id="title" name="title" value="<?php echo $data['title'];?>">
                    </div>
                    <div class="form-group">
                        <label for="remark">摘要</label>
                        <textarea id="remark" rows="4" cols="120" style="width:100%;" name="remark">
                            <?php echo $data['remark'];?>
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="remark">状态</label>
                        <select name="status">
                            <option value="0" <?php if($data['status']==0):?>selected<?php endif;?>>未发布</option>
                            <option value="1" <?php if($data['status']==1):?>selected<?php endif;?>>发布</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tags">TAG(逗号分隔)</label>
                        <input type="text" class="form-control" id="tags" name="tags" value="<?php echo $data['tags'];?>">
                    </div>

                    <div class="form-group">
                        <label for="tags">Subtitle(显示关联app的时候的title)</label>
                        <input type="text" class="form-control" id="subtitle" name="subtitle" value="<?php echo $data['subtitle'];?>">
                    </div>

                    <div class="form-group">
                        <label for="appids">关联app(id,逗号分隔)</label>
                        <input type="text" class="form-control" id="appids" name="appids" value="<?php echo $data['relatedapps'];?>">
                    </div>

                    <div class="form-group">
                        <label for="remark">内容</label>
                        <script id="container" name="content" type="text/plain">
                        <?php echo $data['content'];?>
                        </script>
                        <!-- 配置文件 -->
                        <script type="text/javascript" src="ueditor/ueditor.config.js"></script>
                        <!-- 编辑器源码文件 -->
                        <script type="text/javascript" src="ueditor/ueditor.all.js"></script>
                        <!-- 实例化编辑器 -->
                        <script type="text/javascript">
                            var ue = UE.getEditor('container',{
                                initialFrameHeight:280,
                                initialFrameWidth:900,
                                
                            });
                        </script>
                    </div>
                    <!--
                    <div class="form-group">
                        <label for="remark">上传缩略图</label>
                        <input type="file" name="slpic">
                        <p style="font-size:12px;color:grey;">如果没上传，则以文章内第一张图为缩略图</p>
                    </div>
                    -->
                    <button type="submit" class="btn btn-primary btn-sm" name="savepost">Click to Save</button>
                </form>   
            </div>
        </div>
    </div>
</div>

<?php include 'template/footer.php';?>