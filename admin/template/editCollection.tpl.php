<?php include("template/header.php");?>
<div>
    <ul class="breadcrumb">
        <li>
            <a href="index.php">Home</a>
        </li>
        <li>
            <a href="#">Collections列表</a>
        </li>
    </ul>
</div>
<div class="row">
    <div class="box col-md-12">
        <div style="width:100%;padding-bottom:10px;font-weight:Bold;">
                <a href="addCollection.php" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-plus icon-white"></i>添加Collection</a>
                &nbsp;&nbsp;
                <a href="collections.php" class="btn btn-primary btn-sm">返回Collections列表</a> 
            </div>
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-edit"></i> 编辑Collections</h2>
            </div>
            <div class="box-content">
                <?php if(!empty($msg)):?>
                    <p style="color:green;font-size:14px;font-weight:bold;">
                        <?php echo $msg;?>
                    </p>
                <?php endif;?>
                <ul class="nav nav-tabs" id="myTab">
                    <li><a href="#collection">Collection基础信息</a></li>
                    <li><a href="#others">其它参数</a></li>
                    <li><a href="#apps">添加关联App</a></li>
                    <li><a href="#appslist">关联App列表</a></li>
                    <li><a href="#status">状态设置</a></li>
                </ul>
                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane active" id="collection">
                        <form role="form" id="collectionform" action="editCollection.php?formid=collectionform" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?php echo $data['id']?>">
                                <br>
                                <div class="form-group">
                                    <label for="title">标题</label>
                                    <input type="text" class="form-control" id="title" name="title" value="<?php echo $data['title'];?>">
                                </div>

                                
                                <div class="form-group">
                                    <label for="remark">概要描述</label>
                                    <textarea name="content" rows="4" cols="120" class="form-control"><?php echo $data['description'];?></textarea>
                                </div>
                               
                                <input type="hidden" name="savepost">
                                <button type="button" onclick="submitform('collectionform')" class="btn btn-primary btn-sm" name="addpost">保  存</button>
                        </form>
                    </div>

                    <div class="tab-pane" id="others">
                        <form role="form" id="othersform" action="editCollection.php?formid=othersform" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?php echo $data['id']?>">
                            <br>
                            <div class="form-group">
                                    <label for="keywords">keywords</label>
                                    <input type="text" class="form-control" id="keywords" name="tags" value="<?php echo $data['tags'];?>">
                            </div>
                            <div>
                                <label>缩略图</label>
                                <div><img src="<?php echo 'http://'.$_SERVER['HTTP_HOST'].$data['listimage'];?>"></div>
                            </div>
                            <div class="form-group">
                                <label for="slpic">上传缩略图</label>
                                <input type="file" name="slpic">
                                <p style="font-size:12px;color:grey;">上传的图片将替换已存在的图片</p>
                            </div>
                            <input type="hidden" name="savepost">
                            <button type="button" onclick="submitform('othersform')" class="btn btn-primary btn-sm" name="addpost">保  存</button>
                        </form>
                    </div>

                    <div class="tab-pane" id="apps">
                        <form role="form" id="appsform" action="editCollection.php?formid=appsform" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?php echo $data['id']?>">
                                <?php if(!empty($conninfo)):?>
                                    <input type="hidden" name="connid" value="<?php echo $conninfo['id']?>">
                                    <input type="hidden" name="action" value="editapp">
                                <?php else:?>
                                    <input type="hidden" name="action" value="addapp">
                                <?php endif;?>
                                <br>
                                <div class="form-group">
                                    <label for="title">APP ID</label>
                                    <input type="text" class="form-control" id="title" name="appid" <?php if(!empty($conninfo)){echo 'value="'.$conninfo['appId'].'"';}?>>
                                </div>
                                <div class="form-group">
                                    <label for="title">Order Num</label>
                                    <input type="text" class="form-control" id="title" name="ordernum" <?php if(!empty($conninfo)){echo 'value="'.$conninfo['ordernum'].'"';}?>>
                                </div>

                                <div class="form-group">
                                    <label for="remark">APP Description</label>
                                    <script id="appcontainer" name="appdescription" type="text/plain">
                                        <?php if(!empty($conninfo)){echo $conninfo['description'];}?>
                                    </script>
                                    <!-- 配置文件 -->
                                    <script type="text/javascript" src="ueditor/ueditor.config.js"></script>
                                    <!-- 编辑器源码文件 -->
                                    <script type="text/javascript" src="ueditor/ueditor.all.js"></script>
                                    <!-- 实例化编辑器 -->
                                    <script type="text/javascript">
                                        var ue = UE.getEditor('appcontainer',{
                                            initialFrameHeight:280,
                                            initialFrameWidth:900,

                                        });
                                    </script>
                                </div>
                               
                                <input type="hidden" name="savepost">
                                <button type="button" onclick="submitform('appsform')" class="btn btn-primary btn-sm" name="addpost">保  存</button>
                        </form>
                    </div>

                    <div class="tab-pane" id="appslist">
                        <div class="box-content row" style="padding:20px;">
                            <table id="appList"
                                   class="table table-striped table-bordered bootstrap-datatable  responsive order-column">
                                <thead>
                                <tr>
                                    <th width="20">id</th>
                                    <th width="20">ordernum</th>
                                    <th width="20">appId</th>
                                    <th width="20">addtime</th>
                                    <th width="40">operations</th>
                                </tr>
                                </thead>
                            </table>
                            <tbody></tbody>
                        </div>
                    </div>

                    
                    <div class="tab-pane" id="status">
                        <form role="form" id="statusform" action="editCollection.php?formid=statusform" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?php echo $data['id']?>">
                            <br>
                            <div class="form-group">
                                <label for="remark">状态</label>
                                <select name="status">
                                    <option value="0" <?php if($data['status']==0):?>selected<?php endif;?>>未发布</option>
                                    <option value="1" <?php if($data['status']==1):?>selected<?php endif;?>>发布</option>
                                </select>
                            </div>
                            <input type="hidden" name="savepost">
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
<script>
    $(document).ready(function() {
        $('#appList').dataTable( {
            "sDom": "<'row-fluid'<'col-md-6'l><'col-md-6'f>r>t<'row-fluid'<'span12'i><'span12 center'p>>",
            "sPaginationType": "bootstrap",
            "oLanguage": {
                "sLengthMenu": "_MENU_ records per page"
            },
            "bProcessing": true,
            "bServerSide": true,
            "bSort":false,
            "sAjaxSource": "appCollectionList.php?id=<?php echo $id;?>"
        });
    });

    function deleteapp(id){
        if(confirm("确定删除？")){
            $.get("appCollection.php?action=delete&id="+id,function(data){
                console.log(data);
                if(data==1){
                    $('#deleteitem'+id).parent().parent().remove();
                }
            })
        }
    }
</script>   
<?php include 'template/footer.php';?>