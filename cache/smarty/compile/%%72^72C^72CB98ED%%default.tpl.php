<?php /* Smarty version 2.6.20, created on 2014-08-19 19:50:26
         compiled from program/view/default.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'program/view/default.tpl', 44, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SA-YES | Programme</title>
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
			<li><a href="/program/" title="">Programme</a></li>
			<li><a href="/program/view/" title="">View</a></li>
        </ul>
	</div><!--breadcrumb-->  
	<div class="inner">     
    <h2>Manage Programme</h2>		
	<a href="/program/view/details.php" title="Click to Add a new Item" class="blue_button fl mrg_bot_10"><span style="float:left;">Add a new Programme</span></a> <br />
    <div class="clearer"><!-- --></div>
    <div id="tableContent" align="center">
		<!-- Start Content Table -->
		<div class="content_table">			
			<table id="dataTable" border="0" cellspacing="0" cellpadding="0">
				<thead> 
					<tr>
						<th>Added</th>
						<th>Year</th>
						<th>Name</th>
						<th>Description</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
				  <?php $_from = $this->_tpl_vars['mentorshipData']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
				  <tr>
					<td align="left"><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['mentorship_added'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</td>		
					<td align="left"><?php echo $this->_tpl_vars['item']['mentorship_code']; ?>
</td>
					<td align="left"><a href="/program/view/details.php?code=<?php echo $this->_tpl_vars['item']['mentorship_code']; ?>
"><?php echo $this->_tpl_vars['item']['mentorship_name']; ?>
</a></td>	
					<td align="left"><?php echo $this->_tpl_vars['item']['mentorship_description']; ?>
</td>
					<td align="left"><?php if ($this->_tpl_vars['item']['mentorship_active'] == '1'): ?><span style="font-weight: bold; color: green;">Active</span><?php else: ?><span style="font-weight: bold; color: red;">In-Active</span><?php endif; ?></td>
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