<?php include('template/header.php'); ?>
<!--content section start-->
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
            </div>
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-align-justify"></i>Collections列表</h2>
            </div>
            
            <div class="box-content row" style="padding:20px;">
                <table id="collectionList"
                       class="table table-striped table-bordered bootstrap-datatable  responsive order-column">
                    <thead>
                    <tr>
                        <th width="80">id</th>
                        <th width="180">title</th>
                        <th width="80">status</th>
                        <th width="80">addtime</th>
                        <th width="150">operations</th>
                    </tr>
                    </thead>
                </table>
                <tbody></tbody>
            </div>
        </div>
    </div>
</div>
<!--content section end-->
<script>
    $(document).ready(function() {
        $('#collectionList').dataTable( {
            "sDom": "<'row-fluid'<'col-md-6'l><'col-md-6'f>r>t<'row-fluid'<'span12'i><'span12 center'p>>",
            "sPaginationType": "bootstrap",
            "oLanguage": {
                "sLengthMenu": "_MENU_ records per page"
            },
            "bProcessing": true,
            "bServerSide": true,
            "bSort":false,
            "sAjaxSource": "collectionList.php"
        });
    });

    function deletearticle(id){
        if(confirm("确定删除？")){
            $.get("deleteCollection.php?id="+id,function(data){
                console.log(data);
                if(data=='success'){
                    $('#deleteitem'+id).parent().parent().remove();
                }
            })
        }
    }
</script>
<?php include('template/footer.php') ?>
