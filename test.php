<!DOCTYPE HTML>
<html>
<meta charset="UTF-8">
<title>编译服务器</title>
<link rel="stylesheet" href="zui/dist/css/zui.css" type="text/css">

<script type="text/javascript" src="zui/assets/jquery.js"></script>
<script type="text/javascript" src="zui/dist/js/zui.js"></script>


<body>
  <!--对话框触发按钮 -->
  <button type="button" class="btn btn-lg btn-primary" data-moveable="true" data-position="0px" 
    data-title="申请编译" data-toggle="modal" data-remote="./newBuild.html">启动对话框</button>

  <!-- 对话框HTML -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">关闭</span></button>
          <h4 class="modal-title">标题</h4>
        </div>
        <div class="modal-body">
          <p>主题内容...</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
          <button type="button" class="btn btn-primary">保存</button>
        </div>
      </div>
    </div>
  </div>

  <body/>