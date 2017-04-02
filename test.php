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
<!-- HTML 代码 -->
<table class="table datatable">
  <thead>
    <tr>
      <!-- 以下两列左侧固定 -->
      <th>#</th>
      <th>时间</th>

      <!-- 以下三列中间可滚动 -->
      <th class="flex-col">名称</th> 

      <!-- 以下列右侧固定 -->
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>1</td>
      <td>2016-01-18 11:05:15</td>
      <td>名称示例1</td>
    </tr>
    <tr>
      <td>1</td>
      <td>2016-01-20 12:06:16</td>
      <td>名称示例2</td>
    </tr>
  </tbody>
</table>
<script>$('table.datatable').datatable({checkable: true, sortable: true});</script>

  <body/>