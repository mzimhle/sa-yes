<?php /* Smarty version 2.6.20, created on 2014-10-01 09:45:13
         compiled from users/mentorapplications/details.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'upper', 'users/mentorapplications/details.tpl', 44, false),array('modifier', 'default', 'users/mentorapplications/details.tpl', 44, false),array('function', 'html_options', 'users/mentorapplications/details.tpl', 69, false),)), $this); ?>
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
			<li><a href="/users/mentorapplications/" title="">Mentor Application</a></li>
			<li><?php if (isset ( $this->_tpl_vars['mentorappData'] )): ?>Edit<?php else: ?>New<?php endif; ?> Mentor Application</li>
        </ul>
	</div><!--breadcrumb--> 
	<div class="inner"> 
      <h2><?php if (isset ( $this->_tpl_vars['mentorappData'] )): ?>Edit<?php else: ?>New<?php endif; ?> Mentor Application</h2>
    <div class="clearer"><!-- --></div>
        <div class="mrg_top_10 fr">
			<a href="#" class="button mrg_left_20 fl"><span>Mentor Details</span></a>   
			<?php if (isset ( $this->_tpl_vars['mentorappData'] )): ?>
			<a href="/users/mentorapplications/application.php?code=<?php echo $this->_tpl_vars['mentorappData']['mentorapp_code']; ?>
" class="blue_button mrg_left_20 fl"><span>Mentor Application</span></a>
			<a href="/users/mentorapplications/documents.php?code=<?php echo $this->_tpl_vars['mentorappData']['mentorapp_code']; ?>
" class="blue_button mrg_left_20 fl"><span>Mentor Documents</span></a>   
			<?php endif; ?>
        </div>		
    <div class="clearer"><!-- --></div>
	<br />
	<div class="detail_box" style="width: 1176px !important;">
      <form id="detailsForm" name="detailsForm" action="/users/mentorapplications/details.php<?php if (isset ( $this->_tpl_vars['mentorappData'] )): ?>?code=<?php echo $this->_tpl_vars['mentorappData']['mentorapp_code']; ?>
<?php endif; ?>" method="post" enctype="multipart/form-data">
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="form">
		 <?php if (isset ( $this->_tpl_vars['mentorappData'] )): ?>
			 <tr>
				<td colspan="2">
					<h4>Link to user:</h4><br />
					<?php if ($this->_tpl_vars['mentorappData']['mentorapp_status'] == 'matched'): ?>
					<span id="mentorname" class="success"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['mentorappData']['mentorapp_status'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)))) ? $this->_run_mod_handler('default', true, $_tmp, "N/A") : smarty_modifier_default($_tmp, "N/A")); ?>
: <?php echo $this->_tpl_vars['mentorappData']['user_code']; ?>
 - <?php echo $this->_tpl_vars['mentorappData']['user_name']; ?>
 <?php echo $this->_tpl_vars['mentorappData']['user_surname']; ?>
</span>
					<?php else: ?>
					<span id="mentorname" class="error"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['mentorappData']['mentorapp_status'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)))) ? $this->_run_mod_handler('default', true, $_tmp, "N/A") : smarty_modifier_default($_tmp, "N/A")); ?>
: <?php echo $this->_tpl_vars['mentorappData']['user_code']; ?>
 - <?php echo $this->_tpl_vars['mentorappData']['user_name']; ?>
 <?php echo $this->_tpl_vars['mentorappData']['user_surname']; ?>
</span>
					<?php endif; ?>
				</td>
				<td>
					<h4 class="error">Programme:</h4>
					<input type="hidden" name="mentorship_code" id="mentorship_code" value="<?php echo $this->_tpl_vars['mentorappData']['mentorship_code']; ?>
" />
					<br /><span id="mentorname" class="success"><?php echo $this->_tpl_vars['mentorappData']['mentorship_name']; ?>
</span>	
					<?php if (isset ( $this->_tpl_vars['errorArray']['mentorship_code'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['mentorship_code']; ?>
</span><?php endif; ?>					
				</td>				
			 </tr>
		<?php else: ?>
			 <tr>
				<td colspan="2">
					<h4>Link to mentor:</h4><br />
					<input type="text" name="mentorsearch" id="mentorsearch" value="" size="20" /> &nbsp;
					<input type="hidden" name="mentorcode" id="mentorcode" value="" />
					<button id="clearboxnominee" name="clearboxnominee" onclick="clearbox(); return false;">Clear box</button>													
					<button id="clearnominee" name="clearnominee" onclick="clearall(); return false;">Clear All</button>					
					<br /><span id="mentorname" class="success"></span>
				</td>
				<td>					
					<h4 class="error">Programme:</h4><br />
					<select id="mentorship_code" name="mentorship_code">
						<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['mentoshipData'],'selected' => $this->_tpl_vars['mentorappData']['mentorship_code']), $this);?>

					</select><br />
					 <?php if (isset ( $this->_tpl_vars['errorArray']['mentorship_code'] )): ?><span class="error"><?php echo $this->_tpl_vars['errorArray']['mentorship_code']; ?>
</span><?php endif; ?>
				</td>
			 </tr>		
		<?php endif; ?>
		 <tr>
			<td><h4 class="error">Name:</h4><br /><input type="text" name="mentorapp_name" id="mentorapp_name" value="<?php echo $this->_tpl_vars['mentorappData']['mentorapp_name']; ?>
" size="40"/><?php if (isset ( $this->_tpl_vars['errorArray']['mentorapp_name'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['mentorapp_name']; ?>
</span><?php endif; ?></td>
			<td><h4 class="error">Surname:</h4><br /><input type="text" name="mentorapp_surname" id="mentorapp_surname" value="<?php echo $this->_tpl_vars['mentorappData']['mentorapp_surname']; ?>
" size="40"/><?php if (isset ( $this->_tpl_vars['errorArray']['mentorapp_surname'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['mentorapp_surname']; ?>
</span><?php endif; ?></td>	
			<td><h4 class="error">Email:</h4><br /><input type="text" name="mentorapp_email" id="mentorapp_email" value="<?php echo $this->_tpl_vars['mentorappData']['mentorapp_email']; ?>
" size="40"/><br />E.g. myname@domain.co.za <?php if (isset ( $this->_tpl_vars['errorArray']['mentorapp_email'] )): ?> - <span class="error"><?php echo $this->_tpl_vars['errorArray']['mentorapp_email']; ?>
</span><?php endif; ?></td>				
          </tr>	         
		  <tr>
			<td><h4>Cell:</h4><br /><input type="text" name="mentorapp_cell" id="mentorapp_cell" value="<?php echo $this->_tpl_vars['mentorappData']['mentorapp_cell']; ?>
" size="40"/><br />E.g. 0734897584 <?php if (isset ( $this->_tpl_vars['errorArray']['mentorapp_cell'] )): ?> - <span class="error"><?php echo $this->_tpl_vars['errorArray']['mentorapp_cell']; ?>
</span><?php endif; ?></td>	
			<td><h4>Telephone:</h4><br /><input type="text" name="mentorapp_telephone" id="mentorapp_telephone" value="<?php echo $this->_tpl_vars['mentorappData']['mentorapp_telephone']; ?>
" size="40"/><br />E.g. 0214897584 <?php if (isset ( $this->_tpl_vars['errorArray']['mentorapp_telephone'] )): ?> - <span class="error"><?php echo $this->_tpl_vars['errorArray']['mentorapp_telephone']; ?>
</span><?php endif; ?></td>				
			<td><h4>ID Number:</h4><br /><input type="text" name="mentorapp_idnumber" id="mentorapp_idnumber" value="<?php echo $this->_tpl_vars['mentorappData']['mentorapp_idnumber']; ?>
" size="20"/><?php if (isset ( $this->_tpl_vars['errorArray']['mentorapp_idnumber'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['mentorapp_idnumber']; ?>
</span><?php endif; ?></td>					
          </tr>		  	  
          <tr>
			<td><h4>Race:</h4><br />
				<select id="mentorapp_race" name="mentorapp_race">
					<option value=""> ----- </option>
					<option <?php if ($this->_tpl_vars['mentorappData']['mentorapp_race'] == 'African'): ?>selected<?php endif; ?> value="African"> African </option>
					<option <?php if ($this->_tpl_vars['mentorappData']['mentorapp_race'] == 'Caucasian'): ?>selected<?php endif; ?> value="Caucasian"> Caucasian </option>
					<option <?php if ($this->_tpl_vars['mentorappData']['mentorapp_race'] == 'Coloured'): ?>selected<?php endif; ?> value="Coloured"> Coloured </option>
					<option <?php if ($this->_tpl_vars['mentorappData']['mentorapp_race'] == 'Asian'): ?>selected<?php endif; ?> value="Asian"> Asian </option>
				</select>
			</td>	
			<td><h4>Gender:</h4><br />
				<select id="mentorapp_gender" name="mentorapp_gender">
					<option value=""> ----- </option>
					<option <?php if ($this->_tpl_vars['mentorappData']['mentorapp_gender'] == 'Male'): ?>selected<?php endif; ?> value="Male"> Male </option>
					<option <?php if ($this->_tpl_vars['mentorappData']['mentorapp_gender'] == 'Female'): ?>selected<?php endif; ?> value="Female"> Female </option>
				</select>
				<?php if (isset ( $this->_tpl_vars['errorArray']['mentorapp_gender'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['mentorapp_gender']; ?>
</span><?php endif; ?>
			</td>	
			<td>
				<h4>Passport</h4>
				<br /><input type="text" name="mentorapp_passport" id="mentorapp_passport" value="<?php echo $this->_tpl_vars['mentorappData']['mentorapp_passport']; ?>
" size="20"/>
			</td>				
          </tr>
		  <tr>
			<td><h4>Nationality:</h4><br /><input type="text" name="mentorapp_nationality" id="mentorapp_nationality" value="<?php echo $this->_tpl_vars['mentorappData']['mentorapp_nationality']; ?>
" size="40"/></td>	
			<td><h4>Citizenship:</h4><br /><input type="text" name="mentorapp_citizenship" id="mentorapp_citizenship" value="<?php echo $this->_tpl_vars['mentorappData']['mentorapp_citizenship']; ?>
" size="40"/></td>				
			<td></td>					
          </tr>		  
		  <tr>
			<td><h4>Accessible area:</h4><br />			
				<input type="text" name="area_name" id="area_name" value="<?php echo $this->_tpl_vars['mentorappData']['area_shortPath']; ?>
" size="40" />
				<input type="hidden" name="area_code" id="area_code" value="<?php echo $this->_tpl_vars['mentorappData']['area_code']; ?>
" />
				<?php if (isset ( $this->_tpl_vars['errorArray']['area_code'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['area_code']; ?>
</span><?php endif; ?>
				<br /><span class="success selectedarea"><?php echo ((is_array($_tmp=@$this->_tpl_vars['mentorappData']['area_shortPath'])) ? $this->_run_mod_handler('default', true, $_tmp, "N/A") : smarty_modifier_default($_tmp, "N/A")); ?>
</span>
			</td>				
			<td><h4>Date of Birth:</h4><br /><input type="text" name="mentorapp_dateofbirth" id="mentorapp_dateofbirth" value="<?php echo $this->_tpl_vars['mentorappData']['mentorapp_dateofbirth']; ?>
" size="10"/><br />E.g. YYYY-MM-DD <?php if (isset ( $this->_tpl_vars['errorArray']['mentorapp_dateofbirth'] )): ?> - <span class="error"><?php echo $this->_tpl_vars['errorArray']['mentorapp_dateofbirth']; ?>
</span><?php endif; ?></td>										
			<td>
				<h4>Address:</h4><br /><textarea name="mentorapp_address" id="mentorapp_address"  cols="40" rows="2"><?php echo $this->_tpl_vars['mentorappData']['mentorapp_address']; ?>
</textarea>
				<?php if (isset ( $this->_tpl_vars['errorArray']['mentorapp_address'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['mentorapp_address']; ?>
</span><?php endif; ?>
			</td>												
		  </tr>
          <tr>
			<td valign="top">
				<h4 <?php if (isset ( $this->_tpl_vars['errorArray']['user_image'] )): ?>class="error"<?php endif; ?> >User Image:</h4> Images to upload: gif, png, jpg and jpeg<br /><br />
				<input type="file" id="user_image" name="user_image" />
				<?php if (isset ( $this->_tpl_vars['errorArray']['user_image'] )): ?><br /><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['user_image']; ?>
</span><?php endif; ?>
			</td>
			<td valign="top" >
				<?php if (! isset ( $this->_tpl_vars['mentorappData'] )): ?>
					<img src="/media/user/avatar.jpg" />
				<?php else: ?>
					<?php if ($this->_tpl_vars['mentorappData']['user_image_path'] == ''): ?>
						<img src="/media/user/avatar.jpg" />
					<?php else: ?>
						<img src="<?php echo $this->_tpl_vars['mentorappData']['user_image_path']; ?>
tmb_<?php echo $this->_tpl_vars['mentorappData']['user_image_name']; ?>
<?php echo $this->_tpl_vars['mentorappData']['user_image_ext']; ?>
" />
					<?php endif; ?>
				<?php endif; ?>
			</td>
			<td><h4>Where did you hear about SA-YES:</h4><br /><textarea name="mentorapp_heardofus" id="mentorapp_heardofus"  cols="40" rows="2"><?php echo $this->_tpl_vars['mentorappData']['mentorapp_heardofus']; ?>
</textarea></td>	
          </tr>	          
		  <tr>
			<td colspan="3"><h4>Notes:</h4><br /><textarea name="mentorapp_notes" id="mentorapp_notes"  cols="100" rows="20"><?php echo $this->_tpl_vars['mentorappData']['mentorapp_notes']; ?>
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
	
	$("input").keypress(function(event) {
		if (event.which == 13) {
			event.preventDefault();
			document.forms.detailsForm.submit();	
		}
	});	
	
	$( "#mentorapp_dateofbirth" ).datepicker({ dateFormat: \'yy-mm-dd\', changeYear: true});
	
	$( "#mentorapp_exitDate" ).datepicker({ dateFormat: \'yy-mm-dd\', changeYear: true});
	
	$( "#area_name" ).autocomplete({
		source: "/feeds/area.php",
		minLength: 2,
		select: function( event, ui ) {
		
			if(ui.item.id == \'\') {
				$(\'#area_name\').html(\'\');
				$(\'#area_code\').val(\'\');			
				$(\'.selectedarea\').html(\'N/A\');				
			} else {
				$(\'#area_name\').html(\'<b>\' + ui.item.value + \'</b>\');
				$(\'.selectedarea\').html(\'<b>\' + ui.item.value + \'</b>\');
				$(\'#area_code\').val(ui.item.id);	
			}
			$(\'#area_name\').val(\'\');										
		}
	});
	
	/* Search for mentors. */
	$( "#mentorsearch").autocomplete({
		source: "/feeds/mentors.php",
		minLength: 2,
		select: function( event, ui ) {
		
			if(ui.item.id == \'\') {
				$(\'#mentorname\').html(\'\');
				$(\'#mentorcode\').val(\'\');					
			} else { 
				$(\'#mentorname\').html(\'<b>\' + ui.item.value + \'</b>\');
				$(\'#mentorcode\').val(ui.item.id);	
				populatementor(ui.item.id);
			}				
			$(\'#mentorsearch\').val(\'\');										
		}
	});	
	
	new nicEditor({
		iconsPath	: \'/library/javascript/nicedit/nicEditorIcons.gif\',
		buttonList 	: [\'bold\',\'italic\',\'underline\',\'left\',\'center\', \'ol\', \'ul\', \'xhtml\', \'fontFormat\', \'fontFamily\', \'fontSize\', \'unlink\', \'link\', \'strikethrough\', \'superscript\', \'subscript\'],
		uploadURI : \'/library/javascript/nicedit/nicUpload.php\',
	}).panelInstance(\'mentorapp_notes\');		
	
});

function clearbox() {

	$(\'#mentorname\').html(\'\');
	$(\'#mentorcode\').val(\'\');
	$(\'#mentorsearch\').val(\'\');
	
	return false;
}

function clearall() {

	$(\'#mentorname\').html(\'\');
	$(\'#mentorcode\').val(\'\');
	$(\'#mentorsearch\').val(\'\');
	$(\'#mentorapp_name\').val(\'\');
	$(\'#mentorapp_surname\').val(\'\');
	$(\'#mentorapp_email\').val(\'\');
	$(\'#mentorapp_cell\').val(\'\');
	$(\'#mentorapp_telephone\').val(\'\');
	$(\'#mentorapp_idnumber\').val(\'\');
	$(\'#mentorapp_dateofbirth\').val(\'\');
	$(\'#area_code\').val(\'\');
	$(\'#area_name\').val(\'\');	
	$(\'#mentorapp_notes\').val(\'\');
	$(\'#mentorapp_heardofus\').val(\'\');
	$(\'#mentorapp_address\').val(\'\');
	$(\'#mentorapp_address\').val(\'\');
	$(\'[name=mentorapp_gender]\').val(\'\');
	$(\'[name=partner_code]\').val(\'\');
	$(\'[name=mentorapp_race]\').val(\'\');	
	
	return false;
}


function populatementor(id) {
	$.post("?action=getmentor", {
			usercode		: id
		},
		function(data) {
			if(data.result) {
			
				var item = data.records;
				'; ?>
<?php if (! isset ( $this->_tpl_vars['mentorappData'] )): ?><?php echo '
				$(\'#mentorapp_name\').val(item.user_name);
				$(\'#mentorapp_surname\').val(item.user_surname);
				$(\'#mentorapp_email\').val(item.user_email);
				$(\'#mentorapp_cell\').val(item.user_cell);
				$(\'#mentorapp_telephone\').val(item.user_telephone);
				$(\'#mentorapp_idnumber\').val(item.user_idnumber);
				$(\'#mentorapp_dateofbirth\').val(item.user_dateofbirth);				
				$(\'#area_code\').val(item.area_code);
				$(\'#area_name\').val(item.area_shortPath);
				$(\'#mentorapp_address\').val(item.user_address);
				$(\'#mentorapp_notes\').val(item.user_notes);
				$(\'[name=mentorapp_gender]\').val(item.user_gender);
				$(\'[name=partner_code]\').val(item.partner_code);
				$(\'[name=mentorapp_race]\').val(item.user_race);
				'; ?>
<?php endif; ?><?php echo '
			} else {
			
				clearall();		
				return false;
			}
		},
		\'json\'
	);
}

function submitForm() {
	nicEditors.findEditor(\'mentorapp_notes\').saveContent();
	document.forms.detailsForm.submit();					 
}
</script>
'; ?>

<!-- End Main Container -->
</body>
</html>