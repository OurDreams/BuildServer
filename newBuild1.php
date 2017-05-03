<!DOCTYPE HTML>
<html>
<meta charset="UTF-8">
<title>申请编译</title>
<link rel="bookmark" type="image/x-icon" href="favicon.ico" />
<link rel="shortcut icon" href="favicon.ico">
<link rel="icon" href="favicon.ico">

<link href="css/bootstrap.css" rel="stylesheet">
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>

<!--select2-->
<link href="css/select2.css" rel="stylesheet">
<script src="js/select2.js"></script>

<script>
  $(function() {
    $('.chosen-select').select2({
        placeholder: '请选择地区'
    });
  })
</script>

<style>
  h1, h4
  {
    font-family: 黑体;
    text-align: center;
  }
</style>

<body>
  <div class="container">
    <h1 style="text-align: center">申请编译</h1>
    <h4 style="text-align: center">请填写相关信息，服务器会自动从svn下载源码进行编译！</h4>

    <form class="form-group" name="form1" method="post" action="newBuild.php">
        <div class="col-xs-7">
            <div class="row">
                <div class="col-xs-9">  
                    <div class="form-group">
                        <label>SVN地址</label>
                        <input type="url" class="form-control" name="svn_url" required/>
                    </div>
                </div>
                <div class="col-xs-3"> 
                    <div class="form-group">
                        <label>SVN版本号</label>
                        <input class="form-control" name="svn_ver" required/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12"> 
                    <div class="form-group">
                        <label>归档版本号</label>
                        <input class="form-control" name="release_ver" required placeholder="（例如:C.SX4622T.HN.1518.9211.β4）"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-5"> 
                    <div class="form-group">
                        <label>产品类型</label>
                        <select name="product_type" class="form-control">
                            <optgroup label="专变">
                                <option value="A">国网I型专变</option>
                                <option value="B">国网Ⅱ型专变</option>
                                <option value="C" selected>国网Ⅲ型专变</option>
                                <option value="D">南网专变</option> 
                            </optgroup>
                            <optgroup label="集中器">
                                <option value="E">南网配变</option>
                                <option value="H">国网I型集中器</option>
                                <option value="I">国网II型集中器</option>
                                <option value="J">南网I型交采集中器</option>
                                <option value="K">南网I型非交采集中器</option>
                                <option value="L">南网II型集中器</option>
                            </optgroup>
                                <optgroup label="模块">
                                <option value="O">国网G表模块</option>
                                <option value="P">南网G表模块</option>
                            </optgroup>
                            <optgroup label="其他">
                                <option value="U">农网终端</option>
                                <option value="V">浙江公变</option>
                            </optgroup>
                        </select>
                    </div>
                </div>
                <div class="col-xs-4"> 
                    <div class="form-group">
                        <label>地区</label>
                        <select name="product_aera" class="form-control chosen-select">
                            <option value=""></option>
                            <option value="A"> B北京-A </option>
                            <option value="B"> S上海-B </option>
                            <option value="C"> T天津-C </option>
                            <option value="D"> C重庆-D </option>
                            <option value="E"> L辽宁-E </option>
                            <option value="F"> H河北-F </option>
                            <option value="G"> S山西-G </option>
                            <option value="H"> S陕西-H </option>
                            <option value="I"> G甘肃-I </option>
                            <option value="J"> Q青海-J </option>
                            <option value="K"> S山东-K </option>
                            <option value="L"> A安徽-L </option>
                            <option value="M"> J江苏-M </option>
                            <option value="N"> Z浙江-N </option>
                            <option value="O"> H河南-O </option>
                            <option value="P"> H湖北-P </option>
                            <option value="Q"> H湖南-Q </option>
                            <option value="R"> J江西-R </option>
                            <option value="S"> F福建-S </option>
                            <option value="T"> S四川-T </option>
                            <option value="U"> J吉林-U </option>
                            <option value="V"> J冀北-V </option>
                            <option value="W"> X新疆-W </option>
                            <option value="X"> X西藏-X </option>
                            <option value="Y"> N宁夏-Y </option>
                            <option value="Z"> H黑龙江-Z</option>
                            <option value="a"> H海南-a </option>
                            <option value="b"> Y云南-b </option>
                            <option value="c"> G广西-c </option>
                            <option value="d"> G贵州-d </option>
                            <option value="e"> G广东-e </option>
                            <option value="f"> G广州-f </option>
                            <option value="g"> S深圳-g </option>
                            <option value="h"> G广西水电-h </option>
                            <option value="i"> N内蒙古-i </option>
                            <option value="j"> S陕西地电-j </option>
                            <option value="z"> T通用-z </option>
                        </select>
                    </div>
                </div>
                <div class="col-xs-3"> 
                    <div class="form-group">
                        <label>当前版本</label>
                        <input type="text" class="form-control" name="show_ver" required placeholder="两位数字" />
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>bsp类型</label>
                </select>
                <select name="bsp_type" class="form-control">
                    <option value="1">I型集中器</option>
                    <option value="2">II型集中器</option>
                    <option value="3" selected>III型专变</option>
                </select>
            </div>
            <div class="form-group">
                <label>平台类型</label>
                <select name="platform" class="form-control">
                    <option value="4">SP41</option>
                </select>
            </div>
            <div class="form-group">
                <label>bsp版本</label>
                <select name="bsp_ver" class="form-control">
                    <option value="0.3">0.3</option>
                </select>
            </div>
        </div>

        <div class="col-xs-5"> 
            <div class="row">
                <div class="col-xs-12"> 
                    <div class="form-group">
                        <label>内核版本</label>
                        <input type="text" class="form-control" name="kernel_ver" required placeholder="（ASCII码，5字符，例如1.0.9）" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12"> 
                    <div class="form-group">
                        <label>计量版本</label>
                        <input type="text" class="form-control" name="meter_ver" required placeholder="（2字节,十六进制,通过shell->vm命令查看）" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12"> 
                    <div class="form-group">
                        <label>oem信息</label>
                        <input type="text" class="form-control" name="oem_ver" placeholder="（4字节，首字母表示,如上海联能SHLN）" />
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>boot类型</label>
                <select name="boot_type" class="form-control">
                    <option value="boot(DJGL_4_0_3).bin">DJGL_4_0_3</option>
                    <option value="boot(DJGL_4_1_3).bin">DJGL_4_1_3</option>
                    <option value="boot(FKGA23_4_0_3).bin" selected>FKGA23_4_0_3</option>
                </select>
            </div>
            <div class="form-group">
                <label>boot空间</label>
                <select name="boot_size" class="form-control">
                    <option value="0x8000" selected>32K</option>
                    <option value="0x10000">64K</option>
                </select>
            </div>
            <div class="form-group">
                <label>app空间</label>
                <select name="app_size" class="form-control">
                    <option value="0xf8000">992K</option>
                    <option value="0xb8000" selected>736K</option>
                    <option value="0x7f800">510K</option>
                </select>
            </div>
        </div>

        <div class="col-xs-12">
            <div class="form-group">
                <label>备注</label>
                <input type="text" class="form-control" name="build_note" required/>
            </div>
        </div>

        <div class="col-xs-12">
            <div display=block style="background-color:#eeeeee; line-height: 80%; padding: 10px;">
                <p style="font-weight:bold;">请确认：</p>
                <p>在源文件prdcfg.h中包含INCLUDE_FLASH_TEST， 并且有如下代码：</p>
                <br />
                <p>#ifdef INCLUDE_FLASH_TEST</p>
                <p>#define RTU_FLASH_TESTING 1 /*是否支持flash测试*/</p>
                <p>#else</p>
                <p>#define RTU_FLASH_TESTING 0 /*是否支持flash测试*/</p>
                <p>#endif</p>
                <br />
                <p style="font-size: 15px; color: red; font-weight:bold;">否则"Flash寿命测试的U盘升级文件"中的升级文件无Flash寿命测试功能。</p>
                <div class="input-group" style="width: 30%">
                <span>
                        <input type="checkbox" id="readcheckbox">
                    </span>
                <label style="width: 90%">我已确认以上内容。</label>
                </div>
                <script>
                $("#readcheckbox").change(function() {
                    if ($("#readcheckbox").is(':checked')) {
                    $("#submitbtn").attr("class", "btn btn-primary");
                    } else {
                    $("#submitbtn").attr("class", "btn btn-primary disabled");
                    }
                })
                </script>

                <button id="submitbtn" type="submit" class="btn btn-primary disabled" style="width: 100%">提交申请</button>
            </div>
        </div>
    </form>
  </div>
</body>

</html>