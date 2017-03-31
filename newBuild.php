<?php
    //把传递过来的信息入库；
    session_start();
   
    //print_r($_POST);

    $svn_url=$_POST["svn_url"];
    $svn_ver=$_POST['svn_ver'];
    $release_ver=$_POST['release_ver'];
    $show_ver=$_POST['product_type'].substr($_POST['product_aera'], -1).'.'.$_POST['show_ver'];
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
    // $sql="select * from student_information where studentid = '$studentid'";
    // $query = mysqli_query($sql);
    // $rows = mysqli_num_rows($query);

	//验证填写信息是否合乎规范
    if (empty($svn_url)||empty($svn_ver)||empty($show_ver)||empty($bsp_ver)||empty($kernel_ver)||empty($meter_ver)) {
	    echo "<script>alert('信息不能为空！重新填写');window.location.href='newBuild.html'</script>";
    // }elseif ((strlen($svn_url) < 4)||(!preg_match('/^\w+$/i', $svn_url))) {
    //     echo "<script>alert('用户名至少4位且不含非法字符！重新填写');window.location.href='newBuild.html'</script>";
    // //判断用户名长度
    // }elseif  ((strlen($studentid)!=9)||(!(ctype_digit($studentid)))){
    //     echo "<script>alert('学号为9位纯数字！重新填写');window.location.href='newBuild.html'</script>";
    // //判断学号是否填写正确	
    // }elseif( $rows > 0){
    //     echo "<script>alert('此学号已经注册！重新填写');window.location.href='newBuild.html'</script>";
    // //学号不能重复
    // }elseif(strlen($password) < 6){
    //         echo "<script>alert('密码至少6位！重新填写');window.location.href='newBuild.html'</script>";
    //     //判断密码长度
    // }elseif($password!=$confirm){
    //     echo "<script>alert('两次密码不相同！重新填写');window.location.href='newBuild.html'</script>";
    //     //检测两次输入密码是否相同
    // }elseif (!preg_match('/^[\w\.]+@\w+\.\w+$/i', $emailaddress)) {
    //     echo "<script>alert('邮箱不合法！重新填写');window.location.href='newBuild.html'</script>";
    //     //判断邮箱格式是否合法
    // }//elseif($verification !=$_SESSION['$code']) {
    //     elseif(($_SESSION['rand'])!=($verification )){
    //     echo "<script>alert('验证码错误！重新填写');window.location.href='newBuild.html'</script>";
    //     //判断验证码是否填写正确
    } else{

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
            echo "<script>alert('申请成功！查看状况');window.location.href='index.php'</script>";
        }
        mysqli_close($con); 
    } 
?>
