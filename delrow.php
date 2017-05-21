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

<!--notify-->
<link rel="stylesheet" href="css/animate.css">
<script src="js/bootstrap-notify.js"></script>

<body>
<div class="container">
<?php
    $build_id=isset($_GET['id']) ? $_GET['id'] : '';
    $password=isset($_GET['pw']) ? $_GET['pw'] : '';
    require_once('config.php');
    $link=mysqli_connect(HOST, USERNAME, PASSWORD);
    mysqli_set_charset($link, "utf8");
    mysqli_select_db($link, 'buildserver');
    mysqli_query($link, 'set names utf8_bin');
    mysqli_query($link, "UPDATE build_information SET status='del' WHERE build_id='$build_id'");
    if (mysqli_affected_rows($link))
    {
        echo ("<script>$.notify({message: '删除成功'}, {type: 'success'});</script>");
        header("Refresh: 1; url=index.php");
    }
    else
    {
        echo ("<script>$.notify({message: '删除失败'}, {type: 'danger'});</script>");
        header("Refresh: 1; url=index.php");
    }
?>
</div>
</body>
</html>
