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

<!--footable-->
<link href="css/footable.bootstrap.css" rel="stylesheet">
<script src="js/footable.js"></script>

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

<body>
    <div class="container">
        <header>
            <h1>
                编译服务器信息
                <button type="button" class="btn btn-xs btn-danger btn-compile" onclick="location='newbuild.php'">申请编译</button>
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
        $count = mysqli_query($link, "SELECT COUNT(*) AS count FROM build_information");
        $row_sum = mysqli_fetch_array($count)['count'];
        $page_sum = ceil($row_sum / $items_per_page);

        $row_start = $items_per_page * ($page_num-1);
        $row_list = mysqli_query($link, "SELECT * FROM build_information ORDER BY build_id DESC LIMIT $row_start,$items_per_page");

        if ($row_list)
        {
        ?>
        
    <table class="table table-striped table-hover" data-show-toggle="true" data-expand-first="false">
        <thead>
            <tr>
                <th data-sortable="false"></th>
                <th data-type="number">ID</th>
                <th data-breakpoints="all">SVN地址</th>
                <th data-breakpoints="all">SVN版本号</th>
                <th>归档版本号</th>
                <th data-breakpoints="all">显示版本</th>
                <th data-breakpoints="all">BSP版本</th>
                <th data-breakpoints="all">内核版本</th>
                <th data-breakpoints="all">计量版本</th>
                <th data-breakpoints="all">oem信息</th>
                <th data-breakpoints="all" data-sortable="false">备注</th>
                <th>申请人</th>
                <th data-type="date">申请时间</th>
                <th data-sortable="false" data-title="当前状态">当前状态</th>
                <th data-sortable="false">归档包</th>
                <th data-sortable="false">errlog</th>
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
                <td><?php echo $row['svn_url'];?></td>
                <td><?php echo $row['svn_ver'];?></td>
                <td><?php echo $row['release_ver'];?></td>
                <td><?php echo $row['show_ver'];?></td>
                <td><?php echo $row['bsp_ver'];?></td>
                <td><?php echo $row['kernel_ver'];?></td>
                <td><?php echo $row['meter_ver'];?></td>
                <td><?php echo $row['oem_ver'];?></td>
                <td><?php echo $row['build_note'];?></td>
                <td><?php echo $row['user_name'];?></td>
                <td><?php echo $row['commit_time'];?></td>
                <td><?php echo $row['status'];?></td>
                <td><?php if (is_file(iconv('UTF-8','GB2312', OUTFILEPATH . '/' . sprintf('%06s', $row['build_id']) . '/' . $row['release_ver'] . '.zip')))
                    {
                        echo "<a href='outfiles/". sprintf('%06s', $row['build_id']) . '/' . $row['release_ver'] . '.zip'."'>下载</a>";
                    }
                    else
                    {
                        echo "-";
                    }
                    ?>
                </td>
                <td><?php if (is_file(OUTFILEPATH . '/' . sprintf('%06s', $row['build_id']) . '/errlog.log'))
                    {
                        echo "<a  data-toggle='modal' data-target='#errlog{$row['build_id']}'>查看</a>";
                    }
                    else
                    {
                        echo "-";
                    }?>
                </td>
            </tr>
            <div class="modal fade" id="errlog<?php echo $row['build_id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">错误信息</h4>
                        </div>
                        <div class="modal-body">
                            <iframe frameborder="0" width="100%" src="<?php echo 'outfiles/' . sprintf('%06s', $row['build_id']) . '/errlog.log';?>" charset='gbk'></iframe>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
        </tbody>
    </table>
    <script>
    jQuery(function($){
        $('.table').footable({
            "filtering": {
                "enabled": false,
                "placeholder": "搜索",
                "delay": -1,
                "dropdownTitle": "搜索于：",
                "position": "right"
            },
            "paging": {
                "enabled": false,
                "size": 10
            },
            "sorting": {
                "enabled": false
            }
        });
    });
    </script>

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