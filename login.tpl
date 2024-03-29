<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SA-YES | Login</title>

{include_php file='includes/css.php'}
{include_php file='includes/javascript.php'}

</head>

<body>
<!-- Start Main Container -->
<div id="container">

    <!-- Start Content Section -->
  <div id="content">
  
  <div class="inner">
  {include_php file='includes/header.php'}
  	
    <!-- Start Login Area -->
  	<div id="login_area">
    	<form id="loginForm" name="loginForm" method="post" target="" action="login.php">
  		<div style="height:100px; width:200px; text-align:left;">
            <div class="frm-group">
                <div>Email:</div>
                <span class="formfield">
                <input name="email" type="text" id="email" size="35" maxlength="100" class="required frm-input email" value="" />
                </span>
            </div>
            <div class="frm-group">
                <div>Password:</div>
                <span class="formfield">
                <input name="password" type="password" id="password" size="35" maxlength="100"  class="frm-input required" value="" />
                </span>
                </div>
            </div>
            <div class="frm-group">
                <div class="frm-input">
					<a href="#" class="button" onclick="document.forms.loginForm.submit(); "><span>Login</span></a>
				</div>
			</div>
        </form>
		<br />
        <div class="error">{$message}</div>
        <br /><p><a href="/password.php">Forgot your password? Click here.</a></p>
    </div><!-- End Login area -->
    
    <div class="clearer"><!-- --></div>
    </div><!--inner-->
  	
    
  </div><!-- End Content Section -->
	
 {include_php file='includes/footer.php'}

{literal}
<script type="text/javascript">
$(document).ready(function() {	
    $(this).keydown(function(e) {
        if (e.keyCode == '13') {
            $("#loginForm").submit();
        }
    });
});

</script>
{/literal}
</div>
<!-- End Main Container -->
</body>
</html>
