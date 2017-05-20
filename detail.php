<!DOCTYPE HTML>
<html>
<meta name="renderer" content="webkit"> 
<meta charset="UTF-8">
<title>编译服务器</title>
<link rel="bookmark" type="image/x-icon" href="img/logo.ico" />
<link rel="shortcut icon" href="img/logo.ico">
<link rel="icon" href="img/logo.ico">

<link href="css/bootstrap.css" rel="stylesheet">
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>

<body>
<div class="container">
<?php
    $build_id=isset($_GET['id']) ? $_GET['id'] : '';
    require_once('config.php');
    $link=mysqli_connect(HOST, USERNAME, PASSWORD);
    mysqli_set_charset($link, "utf8");
    mysqli_select_db($link, 'buildserver');
    mysqli_query($link, 'set names utf8_bin');
    $row_list = mysqli_query($link, "SELECT * FROM build_information WHERE build_id=$build_id");

    if ($row_list)
    {
        $row = mysqli_fetch_array($row_list);
        ?>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="detail-id">ID <?php echo $build_id;?> 详细信息</h4>
                </div>
                <div id="detail-content" class="modal-body">
                    <div class="row">
                        <div class="col-xs-9">
                            <div class="panel panel-default">
                                <div class="panel-heading"><h3 class="panel-title">SVN地址</h3></div>
                                <div class="panel-body"><?php echo $row['svn_url'];?></div>
                            </div>
                        </div>
                        <div class="col-xs-3">
                            <div class="panel panel-default">
                                <div class="panel-heading"><h3 class="panel-title">版本号</h3></div>
                                <div class="panel-body"><?php echo $row['svn_ver'];?></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-9">
                            <div class="panel panel-default">
                                <div class="panel-heading"><h3 class="panel-title">归档版本号</h3></div>
                                <div class="panel-body"><?php echo $row['release_ver'];?></div>
                            </div>
                        </div>
                        <div class="col-xs-3">
                            <div class="panel panel-default">
                                <div class="panel-heading"><h3 class="panel-title">显示版本</h3></div>
                                <div class="panel-body"><?php echo $row['show_ver'];?></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-3">
                            <div class="panel panel-default">
                                <div class="panel-heading"><h3 class="panel-title">BSP版本</h3></div>
                                <div class="panel-body"><?php echo $row['bsp_ver'];?></div>
                            </div>
                        </div>
                        <div class="col-xs-3">
                            <div class="panel panel-default">
                                <div class="panel-heading"><h3 class="panel-title">内核版本</h3></div>
                                <div class="panel-body"><?php echo $row['kernel_ver'];?></div>
                            </div>
                        </div>
                        <div class="col-xs-3">
                            <div class="panel panel-default">
                                <div class="panel-heading"><h3 class="panel-title">计量版本</h3></div>
                                <div class="panel-body"><?php echo $row['meter_ver'];?></div>
                            </div>
                        </div>
                        <div class="col-xs-3">
                            <div class="panel panel-default">
                                <div class="panel-heading"><h3 class="panel-title">OEM信息</h3></div>
                                <div class="panel-body"><?php echo $row['oem_ver'] ? $row['oem_ver'] : '无';?></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-3">
                            <div class="panel panel-default">
                                <div class="panel-heading"><h3 class="panel-title">提交人</h3></div>
                                <div class="panel-body"><?php echo $row['user_name'];?></div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="panel panel-default">
                                <div class="panel-heading"><h3 class="panel-title">提交时间</h3></div>
                                <div class="panel-body"><?php echo $row['commit_time'];?></div>
                            </div>
                        </div>
                        <div class="col-xs-3">
                            <div class="panel panel-default">
                                <div class="panel-heading"><h3 class="panel-title">状态</h3></div>
                                <div class="panel-body"><?php echo $row['status'];?></div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading"><h3 class="panel-title">备注</h3></div>
                        <div class="panel-body"><?php echo $row['build_note'];?></div>
                    </div>
                </div>
            </div>
        </div>

<?php
    }
    else
    {
        echo "未找到相关信息！";
    }
?>
</div>
</body>
</html>
