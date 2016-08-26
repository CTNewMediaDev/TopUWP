<?php include('template/header.php');?>
<link href="css/style.css" rel="stylesheet">
<div>
    <ul class="breadcrumb">
        <li>
            <a href="index.php">Home</a>
        </li>
        <li>
            <a href="collections.php">Collections</a>
        </li>
        <li>
            <a href="#"><?php echo $title['title'];?></a>
        </li>
        <li>
            <a href="#">AppList</a>
        </li>
    </ul>
</div>
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-align-justify"></i>App列表</h2>
            </div>
            <div style="width:100%;padding:10px 20px;font-weight:Bold;">
                <a href="collections.php">返回Collections列表</a> &nbsp;&nbsp;<a href="collections.php">返回当前Collection</a>
            </div>
            <div class="box-content row" style="padding:20px;">
                <table id="appList"
                       class="table table-striped table-bordered bootstrap-datatable  responsive order-column">
                    <thead>
                    <tr>
                        <th width="20">id</th>
                        <th width="20">appId</th>
                        <th width="20">addtime</th>
                        <th width="40">operations</th>
                    </tr>
                    </thead>
                </table>
                <tbody></tbody>
            </div>
        </div>
    </div>
</div>
<!--content section end-->
<div id="editApp" class="logout-table" style="border-radius: 5px;">
    <h2><span class="close">✖</span></h2>
    <div style="margin: 0 50px;">
<!--        <div id="error_message" style="color: red"></div>-->
        <form action="appcollection.php?action=edit" name="editApp" method="post" id="edit_data" style="font-family: Segoe, 'Microsoft Yahei'">
            appId:<input type="text" id='editAppId' name="appId" style="width: 100%;line-height: 30px;font-size: 14px;margin-bottom: 20px" placeholder="appId"/>
            描述:<br>
            <textarea id='editAppDescription' style="width: 100%;height: 40%" rows="5" placeholder="输入app描述" name="description"></textarea>
        </form>
        <button style="width: 190px; border: solid #ccc 1px; float: right; line-height: 30px;font-size: 14px;font-family: Segoe, 'Microsoft Yahei';" onclick="javascript:$('#edit_data').submit()">确认修改</button>
    </div>
</div>
<div id="addApp" class="logout-table" style="border-radius: 5px;">
    <h2><span class="close">✖</span></h2>
    <div style="margin: 0 50px;">
<!--        <div id="error_message" style="color: red"></div>-->
        <form action="appCollection.php?action=add&id=<?php echo $id;?>" name="addApp" method="post" id="add_data" style="font-family: Segoe, 'Microsoft Yahei'">
            appId:<input type="text" name="appId" style="width: 100%;line-height: 30px;font-size: 14px;margin-bottom: 20px" placeholder="appId"/>
            描述:<br>
            <textarea style="width: 100%;height: 40%" rows="5" placeholder="输入app描述" name="description"></textarea>
        </form>
        <button style="width: 190px; border: solid #ccc 1px; float: right; line-height: 30px;font-size: 14px;font-family: Segoe, 'Microsoft Yahei';" onclick="javascript:$('#add_data').submit()">添加</button>
    </div>
</div>
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

    function deletearticle(id){
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
<?php include('template/footer.php') ?>
