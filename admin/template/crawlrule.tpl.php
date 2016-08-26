<?php include 'template/header.php';?>
<!--content section start-->
<div>
    <ul class="breadcrumb">
        <li>
            <a href="index.php">Home</a>
        </li>
        <li>
            <a href="#">采集规则管理</a>
        </li>
    </ul>
</div>
<div class="row">
	<div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-edit"></i> 添加规则</h2>
            </div>
            <div class="box-content row" style="padding:20px;"> 
                <form role="form" action="addrule.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="title">字段名</label>
                        <input type="text" class="form-control" id="title" name="title">
                    </div>
                    <div class="form-group">
                        <label for="title">规则</label>
                        <input type="text" class="form-control" id="rule" name="rule">
                    </div>
                    <div class="form-group">
                        <label for="remark">状态</label>
                        <select name="status">
                            <option value="1" >启用</option>
                            <option value="0" >禁止</option>
                        </select>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-sm" name="savepost">Click to Add</button>
                </form>   
            </div>
        </div>
    </div>
</div>

<?php include 'template/footer.php';?>