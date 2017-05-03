<!DOCTYPE HTML>
<html>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/bootstrap.css">
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>

<!--notify-->
<link rel="stylesheet" href="css/animate.css">
<script src="js/bootstrap-notify.js"></script>
<?php
    $svn_url=$_POST["svn_url"];
    $svn_ver=$_POST['svn_ver'];
    $release_ver=$_POST['release_ver'];
    $show_ver=$_POST['product_type'].$_POST['product_aera'].'.'.$_POST['show_ver'];
    $bsp_ver=$_POST['bsp_type'].'.'.$_POST['platform'].'.'.$_POST['bsp_ver'];
    $kernel_ver=$_POST["kernel_ver"];
    $meter_ver=$_POST['meter_ver'];
    $oem_ver=$_POST["oem_ver"];
    $boot_type = $_POST['boot_type'];
    $boot_size = $_POST['boot_size'];
    $app_size = $_POST['app_size'];
    $build_note=$_POST["build_note"];
    $remote_ip = $_SERVER["REMOTE_ADDR"];
    $timenow = date('Y-m-d H:i:s');//获取时间作为申请时间

    //todo: 先查询数据库是否有重复记录

    require_once('config.php');
    
    $con=mysqli_connect(HOST, USERNAME, PASSWORD);//连库
    mysqli_set_charset($con, "utf8");
    mysqli_select_db($con, 'buildserver');//选库
    $insertsql= "INSERT INTO build_information(svn_url, svn_ver, release_ver, show_ver, 
                                                bsp_ver, kernel_ver, meter_ver, oem_ver, 
                                                boot_type, boot_size, app_size, build_note, 
                                                user_ip, commit_time, status)
                    VALUES('$svn_url', '$svn_ver', '$release_ver', '$show_ver', 
                        '$bsp_ver', '$kernel_ver', '$meter_ver', '$oem_ver', 
                        '$boot_type', '$boot_size','$app_size','$build_note',
                        '$remote_ip', '$timenow', 'waiting')";
    //插入数据库
    if(!(mysqli_query($con, $insertsql)))
    {
        echo mysqli_error($con);
    }
    else
    {
        echo ("<script>$.notify({message: '申请成功'}, {type: 'success'});</script>");
        header("Refresh: 1; url=index.php");
    }
    mysqli_close($con); 
?>
