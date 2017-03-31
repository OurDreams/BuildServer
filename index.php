<!DOCTYPE HTML>
<html> 
<meta charset="UTF-8">
<title>编译服务器</title>
<link rel="stylesheet" href="css/zui.css" type="text/css">

<body> 
<div>  
    <body>
    <div id="header">
        <h1 style="text-align: center">编译服务器信息</h1>
        <a href="./newBuild.html">申请编译</a>
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
            <table class="table table-hover table-condensed">
            <thead>
                <tr>
                <th>序号</th> <th>SVN地址</th> <th>SVN版本号</th> <th>归档版本号</th>
                <th>信息</th> <th>申请人</th> <th>申请时间</th> <th>当前状态</th>
                <th>归档包</th> <th>errlog</th>
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
                    echo "<tr $row_class>
                            <td>$row[0]</td><td>$row[1]</td><td>$row[2]</td>
                            <td>$row[3]</td><td>$row[4]</td><td>$row[5]</td>
                            <td>$row[6]</td><td>$row[7]</td>";
                    echo $row[8] ? "<td><a href=$row[8]>下载</a></td>" : "<td></td>";
                    echo $row[9] ? "<td><a href=$row[9]>查看</a></td>" : "<td></td>";
                    echo "</tr>";
                }
                echo "</table>";
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
