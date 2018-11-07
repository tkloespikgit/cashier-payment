<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/metisMenu/metisMenu.min.js')}}"></script>
<script src="{{asset('js/raphael/raphael.min.js')}}"></script>
<script src="{{asset('js/morrisjs/morris.min.js')}}"></script>
<script src="{{asset('js/sb-admin-2.min.js')}}"></script>
<script src="{{asset('js/layer/layer.js')}}"></script>
<script>
    $(document).ready(function(){
        if(window.console || "console" in window) {
            console.log("%c WARNING!!!", "color:#FF8F1C; font-size:40px;");
            console.log("%c This browser feature is for developers only. Please do not copy-paste any code or run any scripts here. It may cause your account to be compromised.", "color:#003087; font-size:12px;");
            console.log("%c For more information, http://en.wikipedia.org/wiki/Self-XSS", "color:#003087; font-size:12px;");
        }
    });

    var SystemFunc = {
        ReloadCaptcha : function () {
            $("#captcha").attr('src','{{captcha_src('flat')}}'+'?'+Math.random())
        },
        OpenFrame : function ($_url,$width = 800,$height = 900) {
            layer.open({
                type: 2,
                area: [$width+'px', $height+'px'],
                fixed: false,
                maxmin: true,
                content: $_url
            });
        }
    }
</script>