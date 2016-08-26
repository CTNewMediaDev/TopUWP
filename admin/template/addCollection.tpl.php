<?php include('template/header.php');?>
<div>
    <ul class="breadcrumb">
        <li>
            <a href="index.php">Home</a>
        </li>
        <li>
            <a href="#">添加Collection</a>
        </li>
    </ul>
</div>
<div class="row">
    <div class="box col-md-12">
        <div style="width:100%;padding-bottom:10px;font-weight:Bold;">
                <a href="collections.php" class="btn btn-primary btn-sm">返回Collections列表</a> 
            </div>
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-edit"></i> 添加Collection</h2>
            </div>
            
            <div class="box-content row" style="padding:20px;">
                <form role="form" action="addCollection.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="title">标题</label>
                        <input type="text" class="form-control" id="title" name="title">
                    </div>
                    
                    <div class="form-group">
                        <label for="remark">概要描述</label>
                        <br>
                        <textarea name="content" rows="4" cols="120" class="form-control"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm" name="addpost">Click to Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include('template/footer.php');?>

