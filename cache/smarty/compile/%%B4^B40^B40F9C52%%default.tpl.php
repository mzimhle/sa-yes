<?php /* Smarty version 2.6.20, created on 2014-11-24 14:32:49
         compiled from mentor/account/default.tpl */ ?>
<!DOCTYPE html PUBLIC "-/W3C/DTD XHTML 1.0 Transitional/EN" "http:/www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http:/www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SA-YES | Account</title>
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
            <li><a href="/mentor/" title="Home">Home</a></li>
			<li><a href="/mentor/account/" title="">Account</a></li>
        </ul>
	</div><!--breadcrumb--> 
  
	<div class="inner"> 
      <h2>View/Edit User</h2>
    <div id="sidetabs">
        <ul > 
            <li class="active"><a href="#" title="Details">Details</a></li>
        </ul>
    </div><!--tabs-->
	<div class="detail_box" style="width: 1010px !important;">
      <form id="detailsForm" name="detailsForm" action="/mentor/account/" method="post">
        <table width="1000" border="0" align="center" cellpadding="0" cellspacing="0" class="form">  
		 <tr>
            <td class="left_col<?php if (isset ( $this->_tpl_vars['errorArray']['user_name'] )): ?> error<?php endif; ?>"><h4>Name:</h4></td>
			<td><input type="text" name="user_name" id="user_name" value="<?php echo $this->_tpl_vars['userData']['user_name']; ?>
" size="30"/></td>
            <td class="left_col<?php if (isset ( $this->_tpl_vars['errorArray']['user_surname'] )): ?> error<?php endif; ?>"><h4>Surname:</h4></td>
			<td><input type="text" name="user_surname" id="user_surname" value="<?php echo $this->_tpl_vars['userData']['user_surname']; ?>
" size="30"/></td>			
          </tr>	
          <tr>
            <td class="left_col<?php if (isset ( $this->_tpl_vars['errorArray']['user_idnumber'] )): ?> error<?php endif; ?>"><h4>ID Number:</h4></td>
			<td><input type="text" name="user_idnumber" id="user_idnumber" value="<?php echo $this->_tpl_vars['userData']['user_idnumber']; ?>
" size="30"/><br /><?php if (isset ( $this->_tpl_vars['errorArray']['user_idnumber'] )): ?> - <span style="color: red"><?php echo $this->_tpl_vars['errorArray']['user_idnumber']; ?>
</span><?php endif; ?></td>
            <td class="left_col<?php if (isset ( $this->_tpl_vars['errorArray']['user_dateofbirth'] )): ?> error<?php endif; ?>"><h4>Date of Birth:</h4></td>
			<td><input type="text" name="user_dateofbirth" id="user_dateofbirth" value="<?php echo $this->_tpl_vars['userData']['user_dateofbirth']; ?>
" size="10"/></td>				
          </tr>	  
          <tr>
            <td colspan="4" class="left_col<?php if (isset ( $this->_tpl_vars['errorArray']['area_code'] )): ?> error<?php endif; ?>"><h4>Area:</h4><br />
				<input type="text" name="area_name" id="area_name" value="<?php echo $this->_tpl_vars['userData']['area_shortPath']; ?>
" size="80" />
				<input type="hidden" name="area_code" id="area_code" value="<?php echo $this->_tpl_vars['userData']['area_code']; ?>
" />
			</td>				
          </tr>		  
          <tr>
            <td class="left_col<?php if (isset ( $this->_tpl_vars['errorArray']['user_email'] )): ?> error<?php endif; ?>"><h4>Email:</h4></td>
			<td><input type="text" name="user_email" id="user_email" value="<?php echo $this->_tpl_vars['userData']['user_email']; ?>
" size="30"/><br /> <?php if (isset ( $this->_tpl_vars['errorArray']['user_email'] )): ?><span style="color: red"><?php echo $this->_tpl_vars['errorArray']['user_email']; ?>
</span><?php endif; ?></td>
            <td class="left_col<?php if (isset ( $this->_tpl_vars['errorArray']['user_race'] )): ?> error<?php endif; ?>"><h4>Race:</h4></td>
			<td>
				<select id="user_race" name="user_race">
					<option value=""> ----- </option>
					<option <?php if ($this->_tpl_vars['userData']['user_race'] == 'African'): ?>selected<?php endif; ?> value="African"> African </option>
					<option <?php if ($this->_tpl_vars['userData']['user_race'] == 'Caucasian'): ?>selected<?php endif; ?> value="Caucasian"> Caucasian </option>
					<option <?php if ($this->_tpl_vars['userData']['user_race'] == 'Coloured'): ?>selected<?php endif; ?> value="Coloured"> Coloured </option>
					<option <?php if ($this->_tpl_vars['userData']['user_race'] == 'Asian'): ?>selected<?php endif; ?> value="Asian"> Asian </option>
				</select>
			</td>			
          </tr>
          <tr>
            <td class="left_col<?php if (isset ( $this->_tpl_vars['errorArray']['user_password'] )): ?> error<?php endif; ?>"><h4>Password:</h4></td>
			<td><input type="password" name="user_password" id="user_password" value="<?php echo $this->_tpl_vars['userData']['user_decoded']; ?>
" size="30"/><br /> <?php if (isset ( $this->_tpl_vars['errorArray']['user_password'] )): ?><span style="color: red"><?php echo $this->_tpl_vars['errorArray']['user_password']; ?>
</span><?php endif; ?></td>
            <td class="left_col<?php if (isset ( $this->_tpl_vars['errorArray']['user_password2'] )): ?> error<?php endif; ?>"><h4>Retype Password:</h4></td>
			<td><input type="password" name="user_password2" id="user_password2" value="<?php echo $this->_tpl_vars['userData']['user_decoded']; ?>
" size="30"/><br /> <?php if (isset ( $this->_tpl_vars['errorArray']['user_password2'] )): ?><span style="color: red"><?php echo $this->_tpl_vars['errorArray']['user_password2']; ?>
</span><?php endif; ?></td>			
          </tr>		  
          <tr>
            <td class="left_col<?php if (isset ( $this->_tpl_vars['errorArray']['user_cell'] )): ?> error<?php endif; ?>"><h4>Cell:</h4></td>
			<td><input type="text" name="user_cell" id="user_cell" value="<?php echo $this->_tpl_vars['userData']['user_cell']; ?>
" size="30"/><br />E.g. 0734897584 <?php if (isset ( $this->_tpl_vars['errorArray']['user_cell'] )): ?> - <span style="color: red"><?php echo $this->_tpl_vars['errorArray']['user_cell']; ?>
</span><?php endif; ?></td>
            <td class="left_col<?php if (isset ( $this->_tpl_vars['errorArray']['user_telephone'] )): ?> error<?php endif; ?>"><h4>Telephone:</h4></td>
			<td><input type="text" name="user_telephone" id="user_telephone" value="<?php echo $this->_tpl_vars['userData']['user_telephone']; ?>
" size="30"/><br />E.g. 0215874698 <?php if (isset ( $this->_tpl_vars['errorArray']['user_telephone'] )): ?> - <span style="color: red"><?php echo $this->_tpl_vars['errorArray']['user_telephone']; ?>
</span><?php endif; ?></td>			
          </tr>
          <tr>
            <td colspan="4" class="left_col<?php if (isset ( $this->_tpl_vars['errorArray']['user_notes'] )): ?> error<?php endif; ?>" valign="top"><h4>Notes:</h4><br />
			<textarea name="user_notes" id="user_notes"  cols="150" rows="20"><?php echo $this->_tpl_vars['userData']['user_notes']; ?>
</textarea></td>
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