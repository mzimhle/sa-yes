<?php /* Smarty version 2.6.20, created on 2014-06-17 14:09:21
         compiled from users/admins/details.tpl */ ?>
<!DOCTYPE html PUBLIC "-/W3C/DTD XHTML 1.0 Transitional/EN" "http:/www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http:/www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SA-YES | Users</title>
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/css.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/javascript.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

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
			<li><a href="/users/admins/" title="">View</a></li>
			<li><?php if (isset ( $this->_tpl_vars['tempData']['user_code'] )): ?>Edit Admin<?php else: ?>Add new admin<?php endif; ?></li>
        </ul>
	</div><!--breadcrumb--> 
  
	<div class="inner"> 
      <h2>View/Edit Admin</h2>
    <div id="sidetabs">
        <ul > 
            <li class="active"><a href="#" title="Details">Details</a></li>
        </ul>
    </div><!--tabs-->
	<div class="detail_box" style="width: 1020px;">
      <form id="detailsForm" name="detailsForm" action="/users/admins/details.php<?php if (isset ( $this->_tpl_vars['tempData']['user_code'] )): ?>?code=<?php echo $this->_tpl_vars['tempData']['user_code']; ?>
<?php endif; ?>" method="post"  enctype="multipart/form-data">
        <table width="1003" border="0" align="center" cellpadding="0" cellspacing="0" class="form">		  
		 <tr>
            <td class="left_col" <?php if (isset ( $this->_tpl_vars['errorArray']['user_name'] )): ?>style="color: red"<?php endif; ?>><h4>Name:</h4></td>
			<td><input type="text" name="user_name" id="user_name" value="<?php echo $this->_tpl_vars['tempData']['user_name']; ?>
" size="25"/></td>
            <td class="left_col" <?php if (isset ( $this->_tpl_vars['errorArray']['user_surname'] )): ?>style="color: red"<?php endif; ?>><h4>Surname:</h4></td>
			<td><input type="text" name="user_surname" id="user_surname" value="<?php echo $this->_tpl_vars['tempData']['user_surname']; ?>
" size="25"/></td>			
          </tr>	
          <tr>
            <td class="left_col" <?php if (isset ( $this->_tpl_vars['errorArray']['user_idnumber'] )): ?>style="color: red"<?php endif; ?>><h4>ID Number:</h4></td>
			<td><input type="text" name="user_idnumber" id="user_idnumber" value="<?php echo $this->_tpl_vars['tempData']['user_idnumber']; ?>
" size="25"/><br /><?php if (isset ( $this->_tpl_vars['errorArray']['user_idnumber'] )): ?> - <span style="color: red"><?php echo $this->_tpl_vars['errorArray']['user_idnumber']; ?>
</span><?php endif; ?></td>
            <td class="left_col" <?php if (isset ( $this->_tpl_vars['errorArray']['user_dateofbirth'] )): ?>style="color: red"<?php endif; ?>><h4>Date of Birth:</h4></td>
			<td><input type="text" name="user_dateofbirth" id="user_dateofbirth" value="<?php echo $this->_tpl_vars['tempData']['user_dateofbirth']; ?>
" size="10"/></td>				
          </tr>	  
          <tr>
            <td class="left_col" <?php if (isset ( $this->_tpl_vars['errorArray']['user_race'] )): ?>style="color: red"<?php endif; ?>><h4>Race:</h4></td>
			<td>
				<select id="user_race" name="user_race">
					<option value=""> ----- </option>
					<option <?php if ($this->_tpl_vars['tempData']['user_race'] == 'African'): ?>selected<?php endif; ?> value="African"> African </option>
					<option <?php if ($this->_tpl_vars['tempData']['user_race'] == 'Caucasian'): ?>selected<?php endif; ?> value="Caucasian"> Caucasian </option>
					<option <?php if ($this->_tpl_vars['tempData']['user_race'] == 'Coloured'): ?>selected<?php endif; ?> value="Coloured"> Coloured </option>
					<option <?php if ($this->_tpl_vars['tempData']['user_race'] == 'Asian'): ?>selected<?php endif; ?> value="Asian"> Asian </option>
				</select>
			</td>
            <td class="left_col" <?php if (isset ( $this->_tpl_vars['errorArray']['area_code'] )): ?>style="color: red"<?php endif; ?>><h4>Area:</h4></td>
			<td>			
				<input type="text" name="area_name" id="area_name" value="<?php echo $this->_tpl_vars['tempData']['area_path']; ?>
" size="25" />
				<input type="hidden" name="area_code" id="area_code" value="<?php echo $this->_tpl_vars['tempData']['area_code']; ?>
" />
			</td>			
          </tr>		  
          <tr>
            <td class="left_col" <?php if (isset ( $this->_tpl_vars['errorArray']['user_email'] )): ?>style="color: red"<?php endif; ?>><h4>Email:</h4></td>
			<td><input type="text" name="user_email" id="user_email" value="<?php echo $this->_tpl_vars['tempData']['user_email']; ?>
" size="25"/> <?php if (isset ( $this->_tpl_vars['errorArray']['user_email'] )): ?><span style="color: red"><?php echo $this->_tpl_vars['errorArray']['user_email']; ?>
</span><?php endif; ?></td>
            <td class="left_col" <?php if (isset ( $this->_tpl_vars['errorArray']['user_cell'] )): ?>style="color: red"<?php endif; ?>><h4>Cell:</h4></td>
			<td><input type="text" name="user_cell" id="user_cell" value="<?php echo $this->_tpl_vars['tempData']['user_cell']; ?>
" size="25"/><br />E.g. 0734897584 <?php if (isset ( $this->_tpl_vars['errorArray']['user_cell'] )): ?> - <span style="color: red"><?php echo $this->_tpl_vars['errorArray']['user_cell']; ?>
</span><?php endif; ?></td>			
          </tr>	
          <tr>
            <td class="left_col" <?php if (isset ( $this->_tpl_vars['errorArray']['user_telephone'] )): ?>style="color: red"<?php endif; ?>><h4>Telephone:</h4></td>
			<td><input type="text" name="user_telephone" id="user_telephone" value="<?php echo $this->_tpl_vars['tempData']['user_telephone']; ?>
" size="25"/><br />E.g. 0215874698 <?php if (isset ( $this->_tpl_vars['errorArray']['user_telephone'] )): ?> - <span style="color: red"><?php echo $this->_tpl_vars['errorArray']['user_telephone']; ?>
</span><?php endif; ?></td>
			<td class="left_col" <?php if (isset ( $this->_tpl_vars['errorArray']['user_image'] )): ?>style="color: red"<?php endif; ?>>
				<h4>Image:</h4>
				<input type="file" id="user_image" name="user_image" />
				<?php if (isset ( $this->_tpl_vars['errorArray']['user_image'] )): ?><br /><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['user_image']; ?>
</span><?php endif; ?>			
			</td>			
			<td valign="top">
				<?php if (! isset ( $this->_tpl_vars['tempData'] )): ?>
					<img src="/media/user/avatar.jpg" />
				<?php else: ?>
					<?php if ($this->_tpl_vars['tempData']['user_image_path'] == ''): ?>
						<img src="/media/user/avatar.jpg" />
					<?php else: ?>
						<img src="<?php echo $this->_tpl_vars['tempData']['user_image_path']; ?>
tmb_<?php echo $this->_tpl_vars['tempData']['user_image_name']; ?>
<?php echo $this->_tpl_vars['tempData']['user_image_ext']; ?>
" />
					<?php endif; ?>
				<?php endif; ?>
			</td>
          </tr>	
          <tr>            
			<td colspan="4">
				<h4 <?php if (isset ( $this->_tpl_vars['errorArray']['user_notes'] )): ?>style="color: red"<?php endif; ?>>Notes:</h4><br />
				<textarea name="user_notes" id="user_notes"  cols="70" rows="10"><?php echo $this->_tpl_vars['tempData']['user_notes']; ?>
</textarea>
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
    </div><!--inner-->
 </div> 	
<!-- End Content recruiter -->
 </div><!-- End Content recruiter -->
 <?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/footer.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

</div>
<?php echo '
<script type="text/javascript">
$(document).ready(function() {	
	
	$( "#user_dateofbirth" ).datepicker({ dateFormat: \'yy-mm-dd\', changeYear: true});
	
	$( "#area_name" ).autocomplete({
		source: "/feeds/area.php",
		minLength: 2,
		select: function( event, ui ) {
		
			if(ui.item.id == \'\') {
				$(\'#area_name\').html(\'\');
				$(\'#area_code\').val(\'\');					
			} else {
				$(\'#area_name\').html(\'<b>\' + ui.item.value + \'</b>\');
				$(\'#area_code\').val(ui.item.id);	
			}
			$(\'#area_name\').val(\'\');										
		}
	});
		
	new nicEditor({
		iconsPath	: \'/library/javascript/nicedit/nicEditorIcons.gif\',
		buttonList 	: [\'bold\',\'italic\',\'underline\',\'left\',\'center\', \'ol\', \'ul\', \'xhtml\', \'fontFormat\', \'fontFamily\', \'fontSize\', \'unlink\', \'link\', \'strikethrough\', \'superscript\', \'subscript\'],
		uploadURI : \'/library/javascript/nicedit/nicUpload.php\',
	}).panelInstance(\'user_notes\');		
	
});

function submitForm() {
	nicEditors.findEditor(\'user_notes\').saveContent();
	document.forms.detailsForm.submit();					 
}
</script>
'; ?>

<!-- End Main Container -->
</body>
</html>