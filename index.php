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

<script>
var showErrlogModal = function (build_id) {
    id_str = '00000' + build_id;
    $.ajax({
        type : "get",
        url : "/BuildServer/outfiles/" + id_str.substr(id_str.length - 6) + "/errlog.log",
        timeout:1000,
        contentType: "application/x-www-form-urlencoded; charset=utf-8",
        success:function(datas){
            $('#errlog-content').html('');
            $('#errlog-content').append(datas);
        },
    });
    $("#errlogmodal").modal('show');
}
var showDetailModal = function (build_id) {
    $.ajax({
        type : "get",
        url : "detail.php",
        data : {'id':build_id},
        timeout:1000,
        success:function(datas){
            $('#detailmodal').html('');
            $('#detailmodal').append(datas);
        },
    });
    $("#detailmodal").modal('show');
}
var showDelModal = function (build_id) {
    document.getElementById("delid").setAttribute("value", build_id);
    $('#del-title').html('');
    $('#del-title').append('请输入删除ID ' + build_id + '的密码：');
    $("#delmodal").modal('show');
}
var delsubmit = function () {
    var delid = document.getElementById("delid").value;
    var password = document.getElementById("password").value;
    window.location.href="delrow.php?id=" + delid + "&pw=" + password; 
}
</script>

<style>
h1
{
    font-family: 黑体;
    font-size: 32px;
}
h1 small
{
    font-size: 50%;
}
</style>

<?php
    if (strpos($_SERVER['HTTP_USER_AGENT'],'MSIE'))
    {?>
       <script>alert("系统检测到您正在使用IE浏览器(IE内核)，我们强烈建议您使用Chrome或Firefox浏览器浏览本网站！");</script>
<?php }?>

<body>
    <!-- errlog Modal -->
    <div class="modal fade" id="errlogmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">错误信息</h4>
                </div>
                <div class="modal-body">
                    <pre id="errlog-content" style="white-space: pre-wrap; word-wrap: break-word;">
                    </pre>
                </div>
            </div>
        </div>
    </div>

    <!-- del Modal -->
    <div class="modal fade" id="delmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="del-title"></h4>
                </div>
                <from class="form-group" method="post" name="del-from" action="delrow.php">
                <div class="modal-body">
                        <input type="hidden" id="delid" name="id" class="form-control">
                        <input type="text" id="password" name="password" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" onclick="delsubmit()">删除</button>
                    <button type="button" name="submit" class="btn btn-default" data-dismiss="modal">取消</button>
                </div>
                </from>
            </div>
        </div>
    </div>

    <!-- detail Modal -->
    <div class="modal fade" id="detailmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    </div>

    <div class="container">
        <header>
            <h1>
                编译服务器信息<small>请使用Chrome或Firefox浏览器！<span style="color: red">请勿使用IE！</span></small>
                <button type="button" class="btn btn-primary btn-compile pull-right" onclick="location='newbuild.php'">申请编译</button>
            </h1>
        </header>
        <hr style="margin-bottom:0">

        <?php
        $page_num=(int)(isset($_GET['p']) ? $_GET['p'] : '1');
        if ($page_num < 1){$page_num = 1;}
        $items_per_page=(int)(isset($_GET['i']) ? $_GET['i'] : '20');
        if ($items_per_page < 1){$items_per_page = 20;}
        $search=(isset($_GET['s']) ? $_GET['s'] : '');

        require_once('config.php');
        $link=mysqli_connect(HOST, USERNAME, PASSWORD);
        mysqli_set_charset($link, "utf8");
        mysqli_select_db($link, 'buildserver');
        mysqli_query($link, 'set names utf8_bin');
        $count = mysqli_query($link, "SELECT COUNT(*) AS count FROM build_information WHERE status!='del'");
        $row_sum = mysqli_fetch_array($count)['count'];
        $page_sum = ceil($row_sum / $items_per_page);

        $row_start = $items_per_page * ($page_num-1);
        $row_list = mysqli_query($link, "SELECT * FROM build_information WHERE status!='del' ORDER BY build_id DESC LIMIT $row_start,$items_per_page");

        if ($row_list)
        {
        ?>
        
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th></th>
                <th>ID</th>
                <th>归档版本号</th>
                <th>申请人</th>
                <th>申请时间</th>
                <th>备注</th>
                <th>当前状态</th>
                <th>输出</th>
                <th>详情</th>
                <th>操作</th>
            </tr>
        </thead>

        <tbody>
        <?php
        while($row = mysqli_fetch_array($row_list))
        {
        ?>
            <tr>
                <td> </td>
                <td><?php echo $row['build_id'];?></td>
                <td><?php echo $row['release_ver'];?></td>
                <td><?php echo $row['user_name'];?></td>
                <td><?php echo substr($row['commit_time'], 0, 10);?></td>
                <td><?php if (strlen($row['build_note'])>10) echo mb_substr($row['build_note'], 0, 10, 'gb2312').'...';?></td>
                <td><?php echo $row['status'];?></td>
                <td><?php if (is_file(iconv('UTF-8','GB2312', OUTFILEPATH . '/' . sprintf('%06s', $row['build_id']) . '/' . $row['release_ver'] . '.zip')))
                    {
                        echo "<a class='btn btn-success btn-xs' href='/BuildServer/outfiles/". sprintf('%06s', $row['build_id']) . '/' . $row['release_ver'] . '.zip'."'>归档包</a>";
                    }
                    elseif (is_file(OUTFILEPATH . '/' . sprintf('%06s', $row['build_id']) . '/errlog.log'))
                    {
                        echo "<button class='btn btn-danger btn-xs' onclick='showErrlogModal({$row['build_id']})'>errlog</a>";
                    }
                    else
                    {
                        echo "-";
                    }
                    ?>
                </td>
                <td><button class='btn btn-default btn-xs' onclick='showDetailModal(<?php echo $row['build_id'];?>)'>详情</button></td>
                <!--<td><button class='btn btn-default btn-xs' onclick="window.open('detail.php?id=<?php echo  $row['build_id'];?>')">详情</button></td>-->
                <td><button class='btn btn-danger btn-xs' onclick="showDelModal(<?php echo $row['build_id'];?>)">删除</button></td>
            </tr>
        <?php
        }
        ?>
        </tbody>
    </table>

    <nav aria-label="Page navigation" style="margin-left: 15px">
        <ul class="pagination">
        <?php if($page_num == 1){?>
            <li class="disabled"><span aria-hidden="true">上一页</span></li>
        <?php }else{?>
            <li class="previous"><a href="index.php?p=<?php echo ($page_num-1);?>"><span aria-hidden="true">上一页</span></a></li>
        <?php }
        for ($page_count=0; $page_count < $page_sum; $page_count++)
        {
        ?>
            <li <?php if($page_num == $page_count+1)echo "class='active'";?>><a href="index.php?p=<?php echo ($page_count+1);?>"><?php echo ($page_count+1)?></a></li>
        <?php 
        }
        if($page_num >= $page_sum){?>
            <li class="disabled"><span aria-hidden="true">下一页</span></li>
        <?php }else{?>
            <li class="next"><a href="index.php?p=<?php echo ($page_num + 1)?>"><span aria-hidden="true">下一页</span></a></li>
        <?php }?>
        </ul>
    </nav>

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