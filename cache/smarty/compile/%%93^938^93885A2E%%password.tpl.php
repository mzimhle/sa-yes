<?php /* Smarty version 2.6.20, created on 2015-07-25 19:04:43
         compiled from password.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SA-YES | Forgot Password</title>

<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/css.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/javascript.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>


</head>

<body>
<!-- Start Main Container -->
<div id="container">

    <!-- Start Content Section -->
  <div id="content">
  
  <div class="inner">
  <?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/header.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

    <!-- Start Login Area -->
  	<div id="login_area">
    	<form id="loginForm" name="loginForm" method="post" target="" action="/password.php">
  		<div style="height:100px; width:200px; text-align:left;">
				<div class="frm-group">
					<div>Your email address:</div>
					<span class="formfield">
						<input name="email" type="text" id="email" size="35" maxlength="100" class="required frm-input email" value="" />
					</span>
				</div>
				<div class="frm-group">
					<div class="frm-input">
						<a href="#" class="button" onclick="document.forms.loginForm.submit(); "><span>Send me my password</span></a>
					</div>
				</div>			
            </div>
        </form>
        <div class="<?php echo $this->_tpl_vars['result']; ?>
"><?php echo $this->_tpl_vars['message']; ?>
</div>
        <br /><p><a href="/login.php">Back to login.</a></p>
    </div><!-- End Login area -->
    
    <div class="clearer"><!-- --></div>
    </div><!--inner-->
  	
    
  </div><!-- End Content Section -->
	
 <?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/footer.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>



</div>
<!-- End Main Container -->
</body>
</html>