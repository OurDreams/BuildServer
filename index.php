<!DOCTYPE HTML>
<html>
<meta charset="UTF-8">
<title>编译服务器</title>
<link rel="bookmark" type="image/x-icon" href="favicon.ico" />
<link rel="shortcut icon" href="favicon.ico">
<link rel="icon" href="favicon.ico">

<link href="css/bootstrap.css" rel="stylesheet">
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>

<!--footable-->
<link href="css/footable.bootstrap.css" rel="stylesheet">
<script src="js/footable.js"></script>

<style>
    h1
    {
        font-size: 32px;
        text-align: center;
        font-family: 微软雅黑;
    }
</style>
<body>
    <h1>编译服务器信息
        <button type="button" class="btn btn-xs btn-danger btn-compile" onclick="location='newBuild.html'">申请编译</button>
    </h1>
    <div class="container">
<?php
require_once('config.php');
$link=mysqli_connect(HOST, USERNAME, PASSWORD);//连库
mysqli_set_charset($link, "utf8");
mysqli_select_db($link, 'buildserver');//选库
mysqli_query($link, 'set names utf8_bin');//字符集
$q = "SELECT build_id,svn_url,svn_ver,release_ver,
build_note,user_name,commit_time,status,
out_zip_url, err_log_url
FROM build_information ORDER BY build_id DESC";
$rs = mysqli_query($link, $q);

if ($rs)
{
    ?>
    <table class="table table-striped table-hover" data-show-toggle="true" data-expand-first="false">
        <thead>
            <tr>
                <th data-sortable="false"></th>
                <th data-type="number">ID</th>
                <th data-breakpoints="md">SVN地址</th>
                <th>SVN版本号</th>
                <th>归档版本号</th>
                <th>备注</th>
                <th>申请人</th>
                <th data-type="date">申请时间</th>
                <th data-breakpoints="all" data-title="当前状态">当前状态</th>
                <th>归档包</th>
                <th>errlog</th>
            </tr>
        </thead>

        <tbody>
        <?php
        while($row = mysqli_fetch_array($rs))
        {
        ?>
            <tr>
                <td> </td>
                <td><?php echo $row['build_id'];?></td>
                <td><?php echo $row['svn_url'];?></td>
                <td><?php echo $row['svn_ver'];?></td>
                <td><?php echo $row['release_ver'];?></td>
                <td><?php echo $row['build_note'];?></td>
                <td><?php echo $row['user_name'];?></td>
                <td><?php echo $row['commit_time'];?></td>
                <td><?php echo $row['status'];?></td>
                <td><?php if ($row[8]) echo "<a href=$row[8]>下载</a>";?></td>
                <td><?php if ($row[9]) echo "<a data-show-header=\"false\" data-height='400px' data-iframe=$row[9] data-toggle=\"modal\">查看</a>";?></td>
            </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
    <script>
    jQuery(function($){
        $('.table').footable({
            "filtering": {
                "enabled": true,
                "placeholder": "搜索",
                "delay": -1,
                "dropdownTitle": "搜索于：",
                "position": "right"
            },
            "paging": {
                "enabled": true,
                "size": 15
            },
            "sorting": {
                "enabled": true
            }
        });
    });
    </script>
<?php
}
else
{
    die("无记录");
}
mysqli_close($link);
?>
    </div>
</body>

</html>