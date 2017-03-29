

<!DOCTYPE HTML>
<html> 
<head>
    <meta charset="UTF-8">
    <title>编译服务器</title>
    <link rel="stylesheet" type="css/css" href="css/myStyle.css">
</head>

<body> 
    <div class="container">  

        <body bgcolor="#d0d0d0">

        <div id="header">
            <h1>编 译 服 务 器 信 息</h1>
            <a href="./newBuild.html">申请编译</a>
        </div>

        <div id="main">
        <?php  

            require_once('config.php');
            //连库
            $link=mysql_connect(HOST, USERNAME, PASSWORD);

            if ($link) {

                //选库
                mysql_select_db('buildserver', $link);

                //字符集
                mysql_query('set names utf8_bin');

                $q = "SELECT buildid,svn_url,svn_version,release_version,brief,who,commit_time,status,file_url FROM build_information";                  
                // mysql_query("SET NAMES GB2312");          
                $rs = mysql_query($q, $link); 

                if ($rs){
                    echo "<table id=\"info\" border=\"1\">"; 
                    echo "<tr><th>序号</th><th>SVN地址</th><th>SVN版本号</th><th>归档版本号</th><th>信息</th><th>申请人</th><th>申请时间</th><th class=\"yellow\">当前状态</th><th class=\"yellow\">下载链接</th></tr>"; 
                    while($row = mysql_fetch_row($rs)) 
                    {
                        echo "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td><td>$row[5]</td><td>$row[6]</td><td>$row[7]</td><td>$row[8]</td></tr>"; 
                    }
                    echo "</table>"; 
                } else {
                    die("Valid result!");
                }
                mysql_close($link); 
            } else {
                echo('connect database faild!');
            }
        ?> 

        </div>
    </div>

</body>
</html>
