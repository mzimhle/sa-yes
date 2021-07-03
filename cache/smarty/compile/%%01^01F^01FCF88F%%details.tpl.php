<?php /* Smarty version 2.6.20, created on 2014-11-03 11:01:18
         compiled from comms/comms/details.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View Comm Sent</title>
</head>
<body>
	<a href="/comms/comms/"><h3>Go Back</h3></a>
	<?php echo $this->_tpl_vars['commsData']['_comms_name']; ?>
 - <?php echo $this->_tpl_vars['commsData']['_comms_email']; ?>
<br />
	Output: <?php echo $this->_tpl_vars['commsData']['_comms_output']; ?>
<br /><br />
	Mailer Sent: <br /><br />
	<?php echo $this->_tpl_vars['commsData']['_comms_html']; ?>

</body>
</html>