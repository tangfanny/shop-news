<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="__PUBLIC__/css/login.css" rel='stylesheet' type='text/css' />
<LINK rel="Bookmark" href="/favicon.ico" >
<LINK rel="Shortcut Icon" href="/favicon.ico" />
<script type="text/javascript" src="__PUBLIC__/js/jquery.min.js"></script>
</head>
<body>
<h1>登 录</h1>
<div class="login-form">
    <div class="clear"> </div>
    <div class="avtar"><img src="__PUBLIC__/images/avtar.png" /></div>
        <input type="text" class="text" id="username" name="username" required="required" autocomplete="off">
        <input type="password" id="password" name="password" required="required" autocomplete="off">
        <input type="text" required="required" pattern="^\d{5}$"  maxlength="5" id="verify" name="verify" />
        <img class="verify" onclick="this.src='<?php echo U('verify');?>#'+Math.random();" class="ns-identifying-code ns-touch" src="<?php echo U('verify');?>" title="点击更换验证码" />
        <div class="signin">
        	<div class="login" value="Login" onclick="sentPostCode(this)">Login</div>
    	</div>
</div>
<script type="text/javascript">
function sentPostCode(ev){
		
        var username = $("#username").val();
        var password = $("#password").val();
        var verify = $("#verify").val();
        if(username=="" || password=="" || verify==""){return;}
        $.post("<?php echo U('/Login/Dologin');?>",{
                'username':username,'password':password,'verify':verify
            }, function (data) {
                switch (data) {
                    case '0':
                        alert("用户已被锁定 :(");
                        break;
                    case '1':
                        alert("账号不存在 :(");
                        break;
                    case '2':
                        alert("密码错误 :(");
                        break;
                    case '3':
                        alert("密码错误次数过多，该账户已被注销！ :(");
                        break;
                    case '4':
                        alert("图片验证码错误 :(");
                        window.location.href = window.location.href;
                        break;
                    case '5':
                        alert("验证码错误 :(");
                        break;
                    case '10':
                        window.location.href= "<?php echo U('/Index');?>";
                        break;
                    default:
                        return false;
                        break;
                    }
    });
}
</script>
</body>
</html>