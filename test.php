<!DOCTYPE HTML>
<html>
<meta name="renderer" content="webkit"> 
<meta charset="UTF-8">
<title>编译服务器</title>
<link rel="bookmark" type="image/x-icon" href="img/logo.ico" />
<link rel="shortcut icon" href="img/logo.ico">
<link rel="icon" href="img/logo.ico">

<!--<link href="css/bootstrap.css" rel="stylesheet">-->
<script src="js/jquery.js"></script>
<!--<script src="js/bootstrap.js"></script>-->

<script>
var showDetailModal = function (build_id) {
    $.ajax({
        scriptCharset : 'gbk',
        contentType: "application/x-www-form-urlencoded; charset=gb2312",
        type : "post",
        url : "detail.php",
        data : {'id':build_id},
        success:function(datas){
            alert(datas);
        },
    });
}
</script>

<body>
<button class='btn' onclick='showDetailModal(1037)'>详情</a>
</body>
</html>
