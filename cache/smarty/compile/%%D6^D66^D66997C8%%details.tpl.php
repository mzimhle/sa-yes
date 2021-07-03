<?php /* Smarty version 2.6.20, created on 2014-06-11 12:35:35
         compiled from users/menteeapplications/details.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'upper', 'users/menteeapplications/details.tpl', 44, false),array('modifier', 'default', 'users/menteeapplications/details.tpl', 114, false),array('function', 'html_options', 'users/menteeapplications/details.tpl', 69, false),)), $this); ?>
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
			<li><a href="/users/menteeapplications/" title="">Mentee Application</a></li>
			<li><?php if (isset ( $this->_tpl_vars['menteeappData'] )): ?>Edit<?php else: ?>New<?php endif; ?> Mentee Application</li>
        </ul>
	</div><!--breadcrumb--> 
	<div class="inner"> 
      <h2><?php if (isset ( $this->_tpl_vars['menteeappData'] )): ?>Edit<?php else: ?>New<?php endif; ?> Mentee Application</h2>
    <div class="clearer"><!-- --></div>
        <div class="mrg_top_10 fr">
          <a href="#" class="button mrg_left_20 fl"><span>Mentee Details</span></a>   
		<?php if (isset ( $this->_tpl_vars['menteeappData'] )): ?>
		  <a href="/users/menteeapplications/application.php?code=<?php echo $this->_tpl_vars['menteeappData']['menteeapp_code']; ?>
" class="blue_button mrg_left_20 fl"><span>Mentee Application</span></a>   
		  <a href="/users/menteeapplications/documents.php?code=<?php echo $this->_tpl_vars['menteeappData']['menteeapp_code']; ?>
" class="blue_button mrg_left_20 fl"><span>Mentee Documents</span></a>   
		  <?php endif; ?>
        </div>		
    <div class="clearer"><!-- --></div>
	<br />
	<div class="detail_box" style="width: 1176px !important;">
      <form id="detailsForm" name="detailsForm" action="/users/menteeapplications/details.php<?php if (isset ( $this->_tpl_vars['menteeappData'] )): ?>?code=<?php echo $this->_tpl_vars['menteeappData']['menteeapp_code']; ?>
<?php endif; ?>" method="post"  enctype="multipart/form-data">
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="form">
		 <?php if (isset ( $this->_tpl_vars['menteeappData'] )): ?>
			 <tr>
				<td colspan="2">
					<h4>Link to user:</h4><br />
					<?php if ($this->_tpl_vars['menteeappData']['menteeapp_status'] == 'matched'): ?>
					<span id="menteename" class="success"><?php echo ((is_array($_tmp=$this->_tpl_vars['menteeappData']['menteeapp_status'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
: <?php echo $this->_tpl_vars['menteeappData']['user_code']; ?>
 - <?php echo $this->_tpl_vars['menteeappData']['user_name']; ?>
 <?php echo $this->_tpl_vars['menteeappData']['user_surname']; ?>
</span>
					<?php else: ?>
					<span id="menteename" class="error"><?php echo ((is_array($_tmp=$this->_tpl_vars['menteeappData']['menteeapp_status'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
: <?php echo $this->_tpl_vars['menteeappData']['user_code']; ?>
 - <?php echo $this->_tpl_vars['menteeappData']['user_name']; ?>
 <?php echo $this->_tpl_vars['menteeappData']['user_surname']; ?>
</span>
					<?php endif; ?>
				</td>
				<td>
					<h4 class="error">Programme:</h4>
					<input type="hidden" name="mentorship_code" id="mentorship_code" value="<?php echo $this->_tpl_vars['menteeappData']['mentorship_code']; ?>
" />
					<br /><span id="menteename" class="success"><?php echo $this->_tpl_vars['menteeappData']['mentorship_name']; ?>
</span>					
					<?php if (isset ( $this->_tpl_vars['errorArray']['mentorship_code'] )): ?><span class="error"><?php echo $this->_tpl_vars['errorArray']['mentorship_code']; ?>
</span><?php endif; ?>
				</td>				
			 </tr>
		<?php else: ?>
			 <tr>
				<td colspan="2">
					<h4>Link to mentee:</h4><br />
					<input type="text" name="menteesearch" id="menteesearch" value="" size="20" /> &nbsp;
					<input type="hidden" name="menteecode" id="menteecode" value="" />
					<button id="clearboxnominee" name="clearboxnominee" onclick="clearbox(); return false;">Clear box</button>
					<button id="clearnominee" name="clearnominee" onclick="clearall(); return false;">Clear all</button>
					<br /><span id="menteename" class="success"></span>
				</td>
				<td>					
					<h4 class="error">Programme:</h4><br />
					<select id="mentorship_code" name="mentorship_code">
						<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['mentoshipData'],'selected' => $this->_tpl_vars['menteeappData']['mentorship_code']), $this);?>

					</select>
					 <?php if (isset ( $this->_tpl_vars['errorArray']['mentorship_code'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['mentorship_code']; ?>
</span><?php endif; ?>
				</td>
			 </tr>		
		<?php endif; ?>
		 <tr>
			<td><h4 class="error">Name:</h4><br /><input type="text" name="menteeapp_name" id="menteeapp_name" value="<?php echo $this->_tpl_vars['menteeappData']['menteeapp_name']; ?>
" size="40"/><?php if (isset ( $this->_tpl_vars['errorArray']['menteeapp_name'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['menteeapp_name']; ?>
</span><?php endif; ?></td>
			<td><h4 class="error">Surname:</h4><br /><input type="text" name="menteeapp_surname" id="menteeapp_surname" value="<?php echo $this->_tpl_vars['menteeappData']['menteeapp_surname']; ?>
" size="40"/><?php if (isset ( $this->_tpl_vars['errorArray']['menteeapp_surname'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['menteeapp_surname']; ?>
</span><?php endif; ?></td>	
			<td><h4>Email:</h4><br /><input type="text" name="menteeapp_email" id="menteeapp_email" value="<?php echo $this->_tpl_vars['menteeappData']['menteeapp_email']; ?>
" size="40"/><br />E.g. myname@domain.co.za <?php if (isset ( $this->_tpl_vars['errorArray']['menteeapp_email'] )): ?> - <span class="error"><?php echo $this->_tpl_vars['errorArray']['menteeapp_email']; ?>
</span><?php endif; ?></td>				
          </tr>	         
		  <tr>
			<td><h4>Cell/Number:</h4><br /><input type="text" name="menteeapp_number" id="menteeapp_number" value="<?php echo $this->_tpl_vars['menteeappData']['menteeapp_number']; ?>
" size="40"/><br />E.g. 0734897584 <?php if (isset ( $this->_tpl_vars['errorArray']['menteeapp_number'] )): ?> - <span class="error"><?php echo $this->_tpl_vars['errorArray']['menteeapp_number']; ?>
</span><?php endif; ?></td>	
			<td><h4>ID Number:</h4><br /><input type="text" name="menteeapp_idnumber" id="menteeapp_idnumber" value="<?php echo $this->_tpl_vars['menteeappData']['menteeapp_idnumber']; ?>
" size="20"/><br />E.g. 8610285815088 <?php if (isset ( $this->_tpl_vars['errorArray']['menteeapp_idnumber'] )): ?> - <span class="error"><?php echo $this->_tpl_vars['errorArray']['menteeapp_idnumber']; ?>
</span><?php endif; ?></td>		
			<td>
				<h4>Date of Birth:</h4><br /><input type="text" name="menteeapp_dateofbirth" id="menteeapp_dateofbirth" value="<?php echo $this->_tpl_vars['menteeappData']['menteeapp_dateofbirth']; ?>
" size="10"/><br />E.g. YYYY-MM-DD <?php if (isset ( $this->_tpl_vars['errorArray']['menteeapp_dateofbirth'] )): ?> - <span class="error"><?php echo $this->_tpl_vars['errorArray']['menteeapp_dateofbirth']; ?>
</span><?php endif; ?></td>				
          </tr>		  	  
          <tr>
			<td><h4>Race:</h4><br />
				<select id="menteeapp_race" name="menteeapp_race">
					<option value=""> ----- </option>
					<option <?php if ($this->_tpl_vars['menteeappData']['menteeapp_race'] == 'African'): ?>selected<?php endif; ?> value="African"> African </option>
					<option <?php if ($this->_tpl_vars['menteeappData']['menteeapp_race'] == 'Caucasian'): ?>selected<?php endif; ?> value="Caucasian"> Caucasian </option>
					<option <?php if ($this->_tpl_vars['menteeappData']['menteeapp_race'] == 'Coloured'): ?>selected<?php endif; ?> value="Coloured"> Coloured </option>
					<option <?php if ($this->_tpl_vars['menteeappData']['menteeapp_race'] == 'Asian'): ?>selected<?php endif; ?> value="Asian"> Asian </option>
				</select>
			</td>	
			<td><h4 class="error">Gender:</h4><br />
				<select id="menteeapp_gender" name="menteeapp_gender"> 
					<option value=""> ----- </option>
					<option <?php if ($this->_tpl_vars['menteeappData']['menteeapp_gender'] == 'Male'): ?>selected<?php endif; ?> value="Male"> Male </option>
					<option <?php if ($this->_tpl_vars['menteeappData']['menteeapp_gender'] == 'Female'): ?>selected<?php endif; ?> value="Female"> Female </option>
				</select>
				<?php if (isset ( $this->_tpl_vars['errorArray']['menteeapp_gender'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['menteeapp_gender']; ?>
</span><?php endif; ?>
			</td>	
			<td>
				<h4 class="error">Address:</h4><br /><textarea name="menteeapp_address" id="menteeapp_address"  cols="40" rows="2"><?php echo $this->_tpl_vars['menteeappData']['menteeapp_address']; ?>
</textarea>
				<?php if (isset ( $this->_tpl_vars['errorArray']['menteeapp_address'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['menteeapp_address']; ?>
</span><?php endif; ?>
			</td>				
          </tr>
		  <tr>
			<td><h4 class="error">Accessible area:</h4><br />			
				<input type="text" name="area_name" id="area_name" value="<?php echo $this->_tpl_vars['menteeappData']['area_shortPath']; ?>
" size="40" />
				<input type="hidden" name="area_code" id="area_code" value="<?php echo $this->_tpl_vars['menteeappData']['area_code']; ?>
" />
				<?php if (isset ( $this->_tpl_vars['errorArray']['area_code'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['area_code']; ?>
</span><?php endif; ?>
				<br /><span class="success selectedarea"><?php echo ((is_array($_tmp=@$this->_tpl_vars['menteeappData']['area_shortPath'])) ? $this->_run_mod_handler('default', true, $_tmp, "N/A") : smarty_modifier_default($_tmp, "N/A")); ?>
</span>
			</td>	
			<td><h4 class="error">Partner:</h4><br />
				<select id="partner_code" name="partner_code">
					<option value=""> ----- </option>
					<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['partnerData'],'selected' => $this->_tpl_vars['menteeappData']['partner_code']), $this);?>

				</select>
				<?php if (isset ( $this->_tpl_vars['errorArray']['partner_code'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['partner_code']; ?>
</span><?php endif; ?>
				<?php if (! isset ( $this->_tpl_vars['partnerData'] )): ?><br /><a href="/users/partners/view/details.php">Click here to add a partner</a><?php endif; ?>
			</td>			
			<td>
				<h4>Expected Exit Date:</h4>
				<br /><input type="text" name="menteeapp_exitDate" id="menteeapp_exitDate" value="<?php echo $this->_tpl_vars['menteeappData']['menteeapp_exitDate']; ?>
" size="10"/>
				<?php if (isset ( $this->_tpl_vars['errorArray']['menteeapp_exitDate'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['menteeapp_exitDate']; ?>
</span><?php endif; ?>
			</td>						
		  </tr>
          <tr>
			<td valign="top">
				<h4>User Image:</h4> Images to upload: gif, png, jpg and jpeg<br /><br />
				<input type="file" id="user_image" name="user_image" />
				<?php if (isset ( $this->_tpl_vars['errorArray']['user_image'] )): ?><br /><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['user_image']; ?>
</span><?php endif; ?>
			</td>
			<td valign="top">
				<?php if (! isset ( $this->_tpl_vars['menteeappData'] )): ?>
					<img src="/media/user/avatar.jpg" />
				<?php else: ?>
					<?php if ($this->_tpl_vars['menteeappData']['user_image_path'] == ''): ?>
						<img src="/media/user/avatar.jpg" />
					<?php else: ?>
						<img src="<?php echo $this->_tpl_vars['menteeappData']['user_image_path']; ?>
tmb_<?php echo $this->_tpl_vars['menteeappData']['user_image_name']; ?>
<?php echo $this->_tpl_vars['menteeappData']['user_image_ext']; ?>
" />
					<?php endif; ?>
				<?php endif; ?>
			</td>
			<td valign="top"><h4>Where did you hear about SA-YES:</h4><br /><textarea name="menteeapp_heardofus" id="menteeapp_heardofus"  cols="40" rows="2"><?php echo $this->_tpl_vars['menteeappData']['menteeapp_heardofus']; ?>
</textarea></td>	
          </tr>	
          <tr>
			<td colspan="2"><h4>Notes:</h4><br /><textarea name="menteeapp_notes" id="menteeapp_notes"  cols="100" rows="20"><?php echo $this->_tpl_vars['menteeappData']['menteeapp_notes']; ?>
</textarea></td>
			<td valign="top"><h4>Mentee has kids?:</h4><br /><input type="checkbox" name="menteeapp_children" id="menteeapp_children" value="1"  <?php if ($this->_tpl_vars['menteeappData']['menteeapp_children'] == '1'): ?>checked<?php endif; ?> /><br /></td>		
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
	
	$( "#menteeapp_dateofbirth" ).datepicker({ dateFormat: \'yy-mm-dd\', changeYear: true});
	
	$( "#menteeapp_exitDate" ).datepicker({ dateFormat: \'yy-mm-dd\', changeYear: true});
	
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
	
	/* Search for mentees. */
	$( "#menteesearch").autocomplete({
		source: "/feeds/mentees.php",
		minLength: 2,
		select: function( event, ui ) {
		
			if(ui.item.id == \'\') {
				$(\'#menteename\').html(\'\');
				$(\'#menteecode\').val(\'\');					
			} else { 
				$(\'#menteename\').html(\'<b>\' + ui.item.value + \'</b>\');
				$(\'#menteecode\').val(ui.item.id);	
				populatementee(ui.item.id);
			}				
			$(\'#menteesearch\').val(\'\');										
		}
	});	
	
	new nicEditor({
		iconsPath	: \'/library/javascript/nicedit/nicEditorIcons.gif\',
		buttonList 	: [\'bold\',\'italic\',\'underline\',\'left\',\'center\', \'ol\', \'ul\', \'xhtml\', \'fontFormat\', \'fontFamily\', \'fontSize\', \'unlink\', \'link\', \'strikethrough\', \'superscript\', \'subscript\'],
		uploadURI : \'/library/javascript/nicedit/nicUpload.php\',
	}).panelInstance(\'menteeapp_notes\');		
	
	$("input").keypress(function(event) {
		if (event.which == 13) {
			event.preventDefault();
			document.forms.detailsForm.submit();			
		}
	});	
	
});

function clearbox() {

	$(\'#menteename\').html(\'\');
	$(\'#menteecode\').val(\'\');
	$(\'#menteesearch\').val(\'\');

	return false;
}


function clearall() {

	$(\'#menteename\').html(\'\');
	$(\'#menteecode\').val(\'\');
	$(\'#menteesearch\').val(\'\');
	$(\'#menteeapp_name\').val(\'\');
	$(\'#menteeapp_surname\').val(\'\');
	$(\'#menteeapp_email\').val(\'\');
	$(\'#menteeapp_number\').val(\'\');
	$(\'#menteeapp_idnumber\').val(\'\');
	$(\'#menteeapp_dateofbirth\').val(\'\');
	$(\'[name=menteeapp_race]\').val(\'\');	
	$(\'#menteeapp_gender\').val(\'\');
	$(\'#area_code\').val(\'\');
	$(\'#area_name\').val(\'\');
	$(\'[name=partner_code]\').val(\'\');	
	$(\'#menteeapp_notes\').val(\'\');
	$(\'#menteeapp_heardofus\').val(\'\');
	$(\'#menteeapp_address\').val(\'\');
	$(\'#menteeapp_exitDate\').val(\'\');
	
	return false;
}


function populatementee(id) {
	$.post("?action=getmentee", {
			usercode		: id
		},
		function(data) {
			if(data.result) {
			
				var item = data.records;
				'; ?>
<?php if (! isset ( $this->_tpl_vars['menteeappData'] )): ?><?php echo '
				$(\'#menteeapp_name\').val(item.user_name);
				$(\'#menteeapp_surname\').val(item.user_surname);
				$(\'#menteeapp_email\').val(item.user_email);
				$(\'#menteeapp_number\').val(item.user_cell);
				$(\'#menteeapp_idnumber\').val(item.user_idnumber);
				$(\'#menteeapp_dateofbirth\').val(item.user_dateofbirth);
				$(\'[name=menteeapp_race]\').val(item.user_race);	
				$(\'#menteeapp_gender\').val(item.user_race);
				$(\'#area_code\').val(item.area_code);
				$(\'#area_name\').val(item.area_shortPath);
				$(\'[name=partner_code]\').val(item.partner_code);
				'; ?>
<?php endif; ?><?php echo '
			} else {
			
				clear();		
				return false;
			}
		},
		\'json\'
	);
}

function submitForm() {
	nicEditors.findEditor(\'menteeapp_notes\').saveContent();
	document.forms.detailsForm.submit();					 
}
</script>
'; ?>

<!-- End Main Container -->
</body>
</html>