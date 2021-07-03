<?php /* Smarty version 2.6.20, created on 2014-05-02 11:20:05
         compiled from mailers/email_response.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'mailers/email_response.html', 24, false),)), $this); ?>
<html>
<head>
	<title>SA-YES Custom Mailer</title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />	
	<?php echo '
	<style type="text/css">
	.list a {color: #cc0000; text-transform: uppercase; font-family: Verdana; font-size: 11px; text-decoration: none;}
	</style>
	'; ?>

</head>
<body marginheight="0" topmargin="0" marginwidth="0" bgcolor="#c5c5c5" leftmargin="0">

<table cellspacing="0" border="0" style="background-image: url(http://meetings.sa-yes.com/mailers/images/bg.gif); background-color: #c5c5c5;" cellpadding="0" width="100%">
	<tr>
		<td valign="top">

			<table cellspacing="0" border="0" align="center" style="background: #fff; border: 1px solid #ccc; margin-top: 30px; margin-bottom: 30px;" cellpadding="0" width="600">
				<tr>
					<td valign="top">
						<!-- header -->
						<table cellspacing="0" border="0"  cellpadding="0" width="600">
							<tr>
								<td class="header-text" height="50" valign="top" style="color: #999; font-family: Verdana; font-size: 10px; text-transform: uppercase; padding: 0 20px;" width="540" colspan="2">
									<br /><br /><webversion style="color: #990000; text-decoration: none;">Say-Yes Response - <?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%A, %B %e, %Y") : smarty_modifier_date_format($_tmp, "%A, %B %e, %Y")); ?>
</webversion>
								</td>
							</tr>
							<tr>							
								<td class="main-title" height="5" align="center" valign="top" style="padding: 0 20px; font-size: 25px; font-family: Georgia;" width="600" colspan="2">									
									<img src="http://meetings.sa-yes.com/images/say-yes-logo.png" />
								</td>							
							</tr>
							<tr>
								<td class="main-title" height="5" valign="top" style="padding: 0 20px; font-size: 25px; font-family: Georgia;" width="600" colspan="2"									
									<br />Thank you for your response
								</td>							
							</tr>
							<tr>
								<td height="20" valign="top" width="600" colspan="2">
									<img src="http://meetings.sa-yes.com/mailers/images/thin-breaker.jpg" height="20" alt="" style="border: 0;" width="600" />
								</td>
							</tr>
						</table>
						<!-- / header -->
					</td>
				</tr>
				<tr>
					<td>
						<!-- content -->
						<table cellspacing="0" border="0" cellpadding="0" width="600">
							<tr>
								<td class="content-copy" valign="top" style="padding: 0 20px; color: #000; font-size: 14px; font-family: Georgia; line-height: 20px;" colspan="2">
									<br />Thank you for responding to the email question we posted.<br /><br />
									<?php echo $this->_tpl_vars['message']; ?>

									<br /><br />
									<a style="text-decoration: none; color: black;" href="http://<?php echo $this->_tpl_vars['host']; ?>
/email/view.php?depo=<?php echo $this->_tpl_vars['mailercode']; ?>
">If you cannot see this email properly, please click here to view it on a browser</a>									
								</td>
							</tr>
						</table>
						<!--  / content -->
					</td>
				</tr>
				<tr>
					<td height="20" valign="top" width="600" colspan="2">
						<img src="http://meetings.sa-yes.com/mailers/images/thin-breaker.jpg" height="20" alt="" style="border: 0;" width="600" />
					</td>
				</tr>				
				<tr>
					<td valign="top" width="600">
						<!-- footer -->
						<table cellspacing="0" border="0" height="100" cellpadding="0" width="600">
							<tr>
								<td class="copyright" height="100" align="center" valign="top" style="padding: 0 20px; color: #999; font-family: Verdana; font-size: 10px; text-transform: uppercase; line-height: 20px;" width="600" colspan="2"><br />
									C/o Brickfield Call Centre, 35 Brickfield Road, Woodstock, Cape Town 7925, South Africa<br />
									<?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%A, %B %e, %Y") : smarty_modifier_date_format($_tmp, "%A, %B %e, %Y")); ?>
<br />
									<a style="color: #cc0000; text-decoration: none;" href="http://sa-yes.com/" target="_blank">South African Youth Education for Sustainability</a><br /><br />
								</td>
							</tr>
						</table>
						<!-- / end footer -->
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</body>
</html>