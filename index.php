<!DOCTYPE HTML>
<html> 
<meta charset="UTF-8">
<title>编译服务器</title>
<link href="zui/dist/css/zui.css" rel="stylesheet">
<link href="zui/dist/lib/datatable/zui.datatable.css" rel="stylesheet">
<script type="text/javascript" src="zui/assets/jquery.js"></script>
<script type="text/javascript" src="zui/dist/js/zui.js"></script>
<script type="text/javascript" src="zui/src/js/datatable.js"></script>

<body> 
<div>  
    <body>
    <div class="row", style="text-align: center">
        <label style="font-size: 26px">编译服务器信息</label>
        <button type="button" class="btn btn-mini btn-danger" style="margin-left: 10px; margin-bottom: 5px" 
            data-moveable="true" data-position="" data-title="请填写相关信息，服务器会自动从svn下载源码进行编译" 
            data-toggle="modal" data-remote="./newBuild.html">申请编译</button>
    </div>

    <div id="main">
    <?php
        require_once('config.php');
        $link=mysqli_connect(HOST, USERNAME, PASSWORD);//连库
        mysqli_set_charset($link, "utf8");
        if ($link)
        {
            mysqli_select_db($link, 'buildserver');//选库
            mysqli_query($link, 'set names utf8_bin');//字符集
            $q = "SELECT build_id,svn_url,svn_ver,release_ver,
                         build_note,user_name,commit_time,status,
                         out_zip_url, err_log_url
                  FROM build_information";
            $rs = mysqli_query($link, $q); 

            if ($rs)
            {
    ?>
            <table class="table datatable table-striped table-condensed">
            <thead>
                <tr>
                <th data-width='4%' data-type='number'>ID</th>
                <th data-width='25%' data-sort='false'>SVN地址</th>
                <th data-width='4%' data-sort='false'>SVN版本号</th>
                <th data-width='17%' data-sort='true'>归档版本号</th>
                <th data-sort='false'>信息</th>
                <th data-width='6%' data-sort='true'>申请人</th>
                <th data-width='13%' data-type='date'>申请时间</th>
                <th data-width='5%'>当前状态</th>
                <th data-width='4%' data-sort='false'>归档包</th>
                <th data-width='4%' data-sort='false'>errlog</th>
                </tr>
            </thead>

            <tbody>
            <?php
                while($row = mysqli_fetch_row($rs)) 
                {
                    if ($row[7] == "waiting") $row_class = "";
                    elseif ($row[7] == "ok") $row_class = "class=\"success\"";
                    elseif (strstr($row[7],"err")) $row_class = "class=\"danger\"";
                    else $row_class = "class=\"active\"";
                    echo "<tr>
                            <td>$row[0]</td><td>$row[1]</td><td>$row[2]</td>
                            <td>$row[3]</td><td>$row[4]</td><td>$row[5]</td>
                            <td>$row[6]</td><td>$row[7]</td>";
                    echo $row[8] ? "<td><a href=$row[8]>下载</a></td>" : "<td></td>";
                    echo $row[9] ? "<td><a data-show-header=\"false\" data-height='400px' data-iframe=$row[9] data-toggle=\"modal\">查看</a></td>" : "<td></td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
                echo "<script>$('table.datatable').datatable({sortable: true, fixedHeader: true, colHover: true});</script>";
            }
            else
            {
                die("Valid result!");
            }
            mysqli_close($link); 
        } 
        else 
        {
            echo('connect database faild!');
        }
    ?> 
    </div>
</div>
</body>
</html>
