<!DOCTYPE HTML>
<html>
<meta charset="UTF-8">
<title>申请编译</title>
<link rel="bookmark" type="image/x-icon" href="img/logo.ico" />
<link rel="shortcut icon" href="img/logo.ico">
<link rel="icon" href="img/logo.ico">

<link href="css/bootstrap.css" rel="stylesheet">
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>

<!--select2-->
<link href="css/select2.css" rel="stylesheet">
<script src="js/select2.js"></script>

<!--notify-->
<link rel="stylesheet" href="css/animate.css">
<script src="js/bootstrap-notify.js"></script>

<script>
var add1 = Math.random()*8 + 1;
add1 = parseInt(add1, 10);
var add2 = Math.random()*8 + 1;
add2 = parseInt(add2, 10);
$(document).ready(function(){
    $(function() {
        $('.chosen-select').select2({
            placeholder: '请选择地区'
        });
    });

    $("#chklabel").html("请填写"+add1+"+"+add2+"=");
});

function chk_form()
{
    var reg = /^[0-9]{2}$/;
    if(!reg.test(document.buildfrom.show_ver.value))
    {
        document.buildfrom.show_ver.focus();
        $.notify({message: '当前版本格式错误，请重新填写'}, {type: 'danger'});
        return false;
    }

    var reg = /^[0-9]{1,2}\.[0-9]{1,2}\.[0-9]{1,2}$/;
    if(!reg.test(document.buildfrom.kernel_ver.value))
    {
        document.buildfrom.kernel_ver.focus();
        $.notify({message: '内核版本格式错误，请重新填写'}, {type: 'danger'});
        return false;
    }

    reg = /^[0-9a-f]{4}$/;
    if(!reg.test(document.buildfrom.meter_ver.value))
    {
        document.buildfrom.meter_ver.focus();
        $.notify({message: '计量版本格式错误，请重新填写'}, {type: 'danger'});
        return false;
    }

    reg = /^[A-Z]{4}$/;
    if(!reg.test(document.buildfrom.oem_ver.value))
    {
        document.buildfrom.oem_ver.focus();
        $.notify({message: 'oem信息格式错误，请重新填写'}, {type: 'danger'});
        return false;
    }

    if(add1 + add2 != document.buildfrom.sumchk.value)
    {
        document.buildfrom.sumchk.focus();
        $.notify({message: '验证码错误，请重新填写'}, {type: 'danger'});
        return false;  
    }
    $.notify({message: 'pass'}, {type: 'success'});
}
</script>

<style>
h1
{
    font-family: 黑体;
    font-size: 32px;
}
h1 small
{
    font-size: 50%;
}
</style>

<body>
  <div class="container">
    <header>
        <h1>
            申请编译<small> 请填写相关信息，服务器会自动从svn下载源码进行编译！</small>
        </h1>
    </header>
    <hr>

    <form class="form-group" name="buildfrom" method="post" action="newbuild_action.php" onsubmit="return chk_form();">
        <div class="col-xs-7">
            <div class="row">
                <div class="col-xs-9">  
                    <div class="form-group">
                        <label>SVN地址</label>
                        <input type="url" class="form-control" name="svn_url" value="http://100.100.10.225/svn/ZD-sp5s/trunk/DJGZ23_SX4622TC_SP5" required/>
                    </div>
                </div>
                <div class="col-xs-3"> 
                    <div class="form-group">
                        <label>SVN版本号</label>
                        <input class="form-control" name="svn_ver" value="528" required/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12"> 
                    <div class="form-group">
                        <label>归档版本号</label>
                        <input class="form-control" name="release_ver" value="C.SX4622T.HN.1518.9211.β4" required placeholder="（例如:C.SX4622T.HN.1518.9211.β4）"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-4"> 
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
                <div class="col-xs-4"> 
                    <div class="form-group">
                        <label>当前版本</label>
                        <input type="text" class="form-control" name="show_ver" value="01" required placeholder="两位数字" />
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-4">
                    <div class="form-group">
                        <label>bsp类型</label>
                        </select>
                        <select name="bsp_type" class="form-control">
                            <option value="1">I型集中器</option>
                            <option value="2">II型集中器</option>
                            <option value="3" selected>III型专变</option>
                        </select>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="form-group">
                        <label>平台类型</label>
                        <select name="platform" class="form-control">
                            <option value="4">SP41</option>
                        </select>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="form-group">
                        <label>bsp版本</label>
                        <select name="bsp_ver" class="form-control">
                            <option value="0.3">0.3</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-4">
                    <div class="form-group">
                        <label>boot类型</label>
                        <select name="boot_type" class="form-control">
                            <option value="boot(DJGL_4_0_3).bin">DJGL_4_0_3</option>
                            <option value="boot(DJGL_4_1_3).bin">DJGL_4_1_3</option>
                            <option value="boot(FKGA23_4_0_3).bin" selected>FKGA23_4_0_3</option>
                        </select>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="form-group">
                        <label>boot空间</label>
                        <select name="boot_size" class="form-control">
                            <option value="0x8000" selected>32K</option>
                            <option value="0x10000">64K</option>
                        </select>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="form-group">
                        <label>app空间</label>
                        <select name="app_size" class="form-control">
                            <option value="0xf8000">992K</option>
                            <option value="0xb8000" selected>736K</option>
                            <option value="0x7f800">510K</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xs-5"> 
            <div class="row">
                <div class="col-xs-12"> 
                    <div class="form-group">
                        <label>内核版本</label>
                        <input type="text" class="form-control" name="kernel_ver" value="1.0.9" required placeholder="（ASCII码，5字符，例如1.0.9）"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12"> 
                    <div class="form-group">
                        <label>计量版本</label>
                        <input type="text" class="form-control" name="meter_ver" value="010d" required placeholder="（通过终端vm命令查看，例如010d，小写）"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12"> 
                    <div class="form-group">
                        <label>oem信息</label>
                        <input type="text" class="form-control" name="oem_ver" value="SHLN" placeholder="（4字节，如上海联能SHLN，大写）"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="form-group">
                        <label>申请人</label>
                        <input type="text" class="form-control" name="user_name" value="王珂" required/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="form-group">
                        <label id="chklabel">请填写</label>
                        <input type="text" class="form-control" name="sumchk" maxlength="3" value="0" placeholder="" required>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xs-12">
            <div class="row">
                <div class="col-xs-12">
                    <div class="form-group">
                        <label>备注</label>
                        <input type="text" class="form-control" name="build_note"/>
                    </div>
                </div>
            </div>
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
                        $("#submitbtn").removeAttr("disabled");
                    } else {
                        $("#submitbtn").attr("disabled", "disabled");
                    }
                })
                </script>
                <div class="row">
                    <div class="col-xs-10">
                        <button id="submitbtn" type="submit" class="btn btn-primary btn-block" disabled="disabled">提交申请</button>
                    </div>
                    <div class="col-xs-2">
                        <a class="btn btn-warning btn-block" href="index.php">取消</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
  </div>
</body>

</html>