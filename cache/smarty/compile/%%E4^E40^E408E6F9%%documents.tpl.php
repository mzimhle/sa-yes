<?php /* Smarty version 2.6.20, created on 2014-09-14 09:04:47
         compiled from users/mentorapplications/documents.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'users/mentorapplications/documents.tpl', 93, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-/W3C/DTD XHTML 1.0 Transitional/EN" "http:/www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http:/www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SA-YES | Users</title>
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/css.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/javascript.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<?php echo '
<script type="text/javascript" language="javascript">
$(document).ready(function(){
	odataTable = $(\'#dataTable\').dataTable({					
		"bJQueryUI": true,
		"sPaginationType": "full_numbers",							
		"bSort": true,
		"bFilter": true,
		"bInfo": false,
		"iDisplayLength": 20,
		"bLengthChange": false							
	});		

	odataTable.fnFilter(\'\');	
});
</script>
'; ?>

</head>
<body>
<!-- Start Main Container -->
<div id="container">
    <!-- Start Content recruiter -->
  <div id="content">
    <?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/header.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

  	<br />
	<div id="breadcrumb">
        <ul>
            <li><a href="/" title="Home">Home</a></li>
			<li><a href="/users/" title="">Users</a></li>
			<li><a href="/users/mentorapplications/" title="">Mentor Application</a></li>
			<li>Mentor Application - <?php echo $this->_tpl_vars['mentorappData']['mentorapp_name']; ?>
 <?php echo $this->_tpl_vars['mentorappData']['mentorapp_surname']; ?>
</li>
			<li>Documents</li>
        </ul>
	</div><!--breadcrumb-->  
	<div class="inner"> 
		<div class="clearer"><!-- --></div>
		<br /><h2>Documents</h2>
		<div class="mrg_top_10 fr">
		  <a href="/users/mentorapplications/details.php?code=<?php echo $this->_tpl_vars['mentorappData']['mentorapp_code']; ?>
" class="button mrg_left_20 fl"><span>Mentor Details</span></a>   
		  <a href="/users/mentorapplications/application.php?code=<?php echo $this->_tpl_vars['mentorappData']['mentorapp_code']; ?>
" class="button mrg_left_20 fl"><span>Mentor Application</span></a>   
		  <a href="#" class="blue_button mrg_left_20 fl"><span>Mentor Documents</span></a>   
		</div>		
		<div class="clearer"><!-- --></div>
		<br />
		<div class="detail_box">
		  <form id="detailsForm" name="detailsForm" action="/users/mentorapplications/documents.php?code=<?php echo $this->_tpl_vars['mentorappData']['mentorapp_code']; ?>
" method="post" enctype="multipart/form-data">
			<table border="0" cellspacing="0" cellpadding="5">
			  <tr>
				<td>
					<h4 <?php if (isset ( $this->_tpl_vars['errorArray']['document_name'] )): ?>class="error"<?php endif; ?>>Description:</h4><br />
					<input type="text" name="document_name" id="document_name" size="60"/>
					<?php if (isset ( $this->_tpl_vars['errorArray']['document_name'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['document_name']; ?>
</span><?php endif; ?>
				</td>
				</tr>
				<tr>
				<td>
					<h4 <?php if (isset ( $this->_tpl_vars['errorArray']['app_file'] )): ?>class="error"<?php endif; ?>>Upload File:</h4><br />
					<input type="file" name="app_file" id="app_file" /><br />
					Only upload pdf, docx, doc, txt, jpg, jpeg, png files only
					<?php if (isset ( $this->_tpl_vars['errorArray']['app_file'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['app_file']; ?>
</span><?php endif; ?>
				</td>				
			  </tr>
			</table>
		  </form>
		</div>	
		<div class="clearer"><!-- --></div>
			<div class="mrg_top_10">
			  <a href="javascript:submitForm();" class="blue_button mrg_left_20 fl"><span>Save &amp; Complete</span></a>   
			</div>
		<div class="clearer"><!-- --></div>		
		<br /><br />			
		<div class="detail_box">
		  <form id="listForm" name="listForm" action="#">
			<table id="dataTable" border="0" cellspacing="0" cellpadding="0" width="100%">
				<thead> 
					<tr>
						<th>Added</th>
						<th>Name</th>
						<th>Download</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
				  <?php $_from = $this->_tpl_vars['documentData']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
				  <tr>
					<td align="left"><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['documents_added'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</td>		
					<td align="left"><?php echo $this->_tpl_vars['item']['documents_name']; ?>
</td>
					<td align="left"><a href="<?php echo $this->_tpl_vars['item']['documents_path']; ?>
" target="_blank">Download</a></td>	
					<td align="left"><button onclick="javascript:deleteitem('<?php echo $this->_tpl_vars['item']['documents_code']; ?>
'); return false;">delete</button></td>
				  </tr>
				  <?php endforeach; endif; unset($_from); ?>     
				</tbody>
			</table>
		  </form>
		</div>
		<div class="clearer"><!-- --></div>
    </div><!--inner-->
 </div> 	
<!-- End Content recruiter -->
 <?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/footer.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

</div>
<?php echo '
<script type="text/javascript">

function deleteitem(id) {
	if(confirm(\'Are you sure you want to delete this item?\')) {
		$.post("?code='; ?>
<?php echo $this->_tpl_vars['mentorappData']['mentorapp_code']; ?>
<?php echo '", {
				deleteitem	: id
			},
			function(data) {
				if(data.result) {			
					alert(\'Deleted!\');
					window.location.href = window.location.href;
				} else {
					alert(data.message);
				}
			},
			\'json\'
		);
	}
	return false;
}

function submitForm() {
	document.forms.detailsForm.submit();					 
}
</script>
'; ?>

<!-- End Main Container -->
</body>
</html>