<?php /* Smarty version 2.6.20, created on 2014-11-03 11:02:23
         compiled from comms/comms/default.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SAY-YES | View Comms</title>
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/css.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/javascript.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<script type="text/javascript" language="javascript" src="default.js"></script>
</head>

<body>
<!-- Start Main Container -->
<div id="container">
    <!-- Start Content Section -->
  <div id="content">
    <?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/header.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

	<div id="breadcrumb">
        <ul>
            <li><a href="/" title="Home">Home</a></li>
			<li><a href="/comms/" title="Mailers">Mailers</a></li>
			<li><a href="/comms/comms/" title="Comms">Comms</a></li>
        </ul>
	</div><!--breadcrumb-->  
	<div class="inner">     
    <h2>Comms</h2><br /><br />
    <div class="clearer"><!-- --></div>
    <div id="tableContent" align="center">
		<!-- Start Content Table -->
		<div class="content_table">			
			<table id="dataTable" border="0" cellspacing="0" cellpadding="0">
				<thead>
					<tr>
						<th>Added</th>
						<th>Code</th>
						<th>Full name</th>
						<th>Email</th>
						<th>Output</th>
					</tr>
			   </thead>
			   <tbody> 
			  <?php $_from = $this->_tpl_vars['commsData']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
			  <tr>
				<td align="left"><?php echo $this->_tpl_vars['item']['_comms_added']; ?>
</td>
				<td align="left">
					<?php if ($this->_tpl_vars['item']['_comms_sent'] == '1'): ?>
						<a style="color: green !important;"href="/comms/comms/details.php?code=<?php echo $this->_tpl_vars['item']['_comms_code']; ?>
"><?php echo $this->_tpl_vars['item']['_comms_code']; ?>
</a>
					<?php else: ?>
						<a style="color: red !important;"href="/comms/comms/details.php?code=<?php echo $this->_tpl_vars['item']['_comms_code']; ?>
"><?php echo $this->_tpl_vars['item']['_comms_code']; ?>
</a>
					<?php endif; ?>
				</td>	
				<td align="left"><?php echo $this->_tpl_vars['item']['user_name']; ?>
 <?php echo $this->_tpl_vars['item']['user_surname']; ?>
</td>
				<td align="left"><?php echo $this->_tpl_vars['item']['_comms_email']; ?>
</td>				
				<td align="left"><?php echo $this->_tpl_vars['item']['_comms_output']; ?>
</td>	
			  </tr>
			  <?php endforeach; endif; unset($_from); ?>     
			  </tbody>
			</table>
		 </div>
		 <!-- End Content Table -->	
	</div>
    <div class="clearer"><!-- --></div>
    </div><!--inner-->
  </div><!-- End Content Section -->
 <?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/footer.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

</div>
<!-- End Main Container -->
</body>
</html>