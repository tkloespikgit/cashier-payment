<div class="form-group">
    <input class="form-control" placeholder="图形验证码" name="captcha" type="text" value="" required>
</div>
<div class="form-group" style="text-align: right;vertical-align: bottom">
    <img src="{{captcha_src('flat')}}" id="captcha" style="height: 32px;border-radius: 5px" onclick="SystemFunc.ReloadCaptcha()">&nbsp;&nbsp;&nbsp;
    <a href="javascript:void (0)" onclick="SystemFunc.ReloadCaptcha()" style="vertical-align: bottom"><i class="fa fa-refresh">换一张</i></a>
</div>