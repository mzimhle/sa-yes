<?php /* Smarty version 2.6.20, created on 2015-05-30 13:35:19
         compiled from users/status/default.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'users/status/default.tpl', 42, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SA-YES | Users</title>
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
			<li><a href="/users/" title="">Users</a></li>
			<li><a href="/users/status/" title=""> Application Status</a></li>
        </ul>
	</div><!--breadcrumb-->  
	<div class="inner">     
    <h2>Manage Application Status</h2>		
	<a href="/users/status/details.php" title="Click to Add a new Item" class="blue_button fl mrg_bot_10"><span style="float:left;">Add a new  Application Status</span></a> <br />
    <div class="clearer"><!-- --></div>
    <div id="tableContent" align="center">
		<!-- Start Content Table -->
		<div class="content_table">			
			<table id="dataTable" border="0" cellspacing="0" cellpadding="0">
				<thead> 
					<tr>
						<th>Added</th>
						<th>Name</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
				  <?php $_from = $this->_tpl_vars['applicationstatusData']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
				  <tr>
					<td align="left"><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['applicationstatus_added'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</td>		
					<td align="left"><a href="/users/status/details.php?code=<?php echo $this->_tpl_vars['item']['applicationstatus_code']; ?>
"><?php echo $this->_tpl_vars['item']['applicationstatus_name']; ?>
</a></td>	
					<td align="left"><button onclick="javascript:deleteForm('<?php echo $this->_tpl_vars['item']['applicationstatus_code']; ?>
');">delete</button></td>
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

<?php echo '
<script type="text/javascript">
function deleteForm(id) {
	if(confirm(\'Are you sure you want to delete this item?\')) {
		$.ajax({
				type: "GET",
				url: "default.php",
				data: "code_delete="+id,
				dataType: "json",
				success: function(data){
						if(data.result == 1) {
							alert(\'Deleted\');
							window.location.href = window.location.href;
						} else {
							alert(data.error);
						}
				}
		});								
	}
}					
</script>
'; ?>
 
</div>
<!-- End Main Container -->
</body>
</html>