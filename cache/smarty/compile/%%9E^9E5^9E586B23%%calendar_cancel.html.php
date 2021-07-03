<?php /* Smarty version 2.6.20, created on 2014-02-10 07:40:16
         compiled from mailers/calendar_cancel.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'mailers/calendar_cancel.html', 24, false),)), $this); ?>
<html>
<head>
	<title>SayYes Custom Mailer</title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />	
	<?php echo '
	<style type="text/css">
	.list a {color: #cc0000; text-transform: uppercase; font-family: Verdana; font-size: 11px; text-decoration: none;}
	</style>
	'; ?>

</head>
<body marginheight="0" topmargin="0" marginwidth="0" bgcolor="#c5c5c5" leftmargin="0">

<table cellspacing="0" border="0" style="background-image: url(http://sayyes.willow-nettica.co.za/templates/comms/WNT-V8IK-R3/images/bg.gif); background-color: #c5c5c5;" cellpadding="0" width="100%">
	<tr>
		<td valign="top">

			<table cellspacing="0" border="0" align="center" style="background: #fff; border: 1px solid #ccc; margin-top: 30px; margin-bottom: 30px;" cellpadding="0" width="750">
				<tr>
					<td valign="top">
						<!-- header -->
						<table cellspacing="0" border="0"  cellpadding="0" width="750">
							<tr>
								<td class="header-text" height="50" valign="top" style="color: #999; font-family: Verdana; font-size: 10px; text-transform: uppercase; padding: 0 20px;" width="540" colspan="2">
									<br /><br /><webversion style="color: #990000; text-decoration: none;">Say-Yes Mailer - <?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%A, %B %e, %Y") : smarty_modifier_date_format($_tmp, "%A, %B %e, %Y")); ?>
</webversion>
								</td>
							</tr>
							<tr>							
								<td class="main-title" height="5" align="center" valign="top" style="padding: 0 20px; font-size: 25px; font-family: Georgia;" width="750" colspan="2">									
									<img src="http://sayes.willow-nettica.co.za/images/say-yes-logo.png" />
								</td>							
							</tr>
							<tr>
								<td class="main-title" height="5" valign="top" style="padding: 0 20px; font-size: 25px; font-family: Georgia;" width="750" colspan="2"><br /><?php echo $this->_tpl_vars['userData']['calendar_name']; ?>

								</td>							
							</tr>
							<tr>
								<td height="20" valign="top" width="750" colspan="2">
									<img src="http://sayes.willow-nettica.co.za/mailers/images/thin-breaker.jpg" height="20" alt="" style="border: 0;" width="750" />
								</td>
							</tr>
						</table>
						<!-- / header -->
					</td>
				</tr>
				<tr>
					<td>
						<!-- content -->
						<table cellspacing="0" border="0" cellpadding="0" width="750">
							<tr>
								<td class="content-copy" valign="top" style="padding: 0 20px; color: #000; font-size: 14px; font-family: Georgia; line-height: 20px;" colspan="2">
									<br />Dear <?php echo $this->_tpl_vars['userData']['calendarattend_fullname']; ?>
, <br /><br />
									The invitation for the meeting / event which was going to take place between <span style="font-weight: bold;"><?php echo ((is_array($_tmp=$this->_tpl_vars['userData']['calendar_startdate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%A, %B %e, %Y at %H:%M") : smarty_modifier_date_format($_tmp, "%A, %B %e, %Y at %H:%M")); ?>
</span> and <span style="font-weight: bold;"><?php echo ((is_array($_tmp=$this->_tpl_vars['userData']['calendar_enddate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%A, %B %e, %Y at %H:%M") : smarty_modifier_date_format($_tmp, "%A, %B %e, %Y at %H:%M")); ?>
</span> has been <span style="color: red;font-weight: bold">CANCELLED</span>. <br /><br />
									<span style="color: red;font-weight: bold">Please take note of this as it will no longer be taking place.</span><br /><br />
									
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
					<td height="20" valign="top" width="750" colspan="2">
						<img src="http://sayes.willow-nettica.co.za/mailers/images/thin-breaker.jpg" height="20" alt="" style="border: 0;" width="750" />
					</td>
				</tr>				
				<tr>
					<td valign="top" width="750">
						<!-- footer -->
						<table cellspacing="0" border="0" height="100" cellpadding="0" width="750">
							<tr>
								<td class="copyright" height="100" align="center" valign="top" style="padding: 0 20px; color: #999; font-family: Verdana; font-size: 10px; text-transform: uppercase; line-height: 20px;" width="750" colspan="2"><br />
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