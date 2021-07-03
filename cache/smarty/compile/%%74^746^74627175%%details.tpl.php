<?php /* Smarty version 2.6.20, created on 2014-11-14 08:06:50
         compiled from mentor/meetings/details.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'mentor/meetings/details.tpl', 85, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-/W3C/DTD XHTML 1.0 Transitional/EN" "http:/www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http:/www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SA-YES | Meetings</title>
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
			<li><a href="/mentor/meetings/" title="">Meetings</a></li>
			<li>View / Add Meeting</li>
        </ul>
	</div><!--breadcrumb--> 
  
	<div class="inner"> 
      <h2>View/Add Meeting</h2>
    <div id="sidetabs">
        <ul > 
            <li class="active"><a href="#" title="Details">Details</a></li>
        </ul>
    </div><!--tabs-->
	<div class="detail_box" style="width: 1031px !important;">
      <form id="detailsForm" name="detailsForm" action="/mentor/meetings/details.php" method="post">
        <table width="1024" border="0" align="center" cellpadding="0" cellspacing="0" class="form">
           <?php if (isset ( $this->_tpl_vars['meetingData'] )): ?> 
		   <tr>
				<td colspan="4"><br /><span class="error">To update this meeting you will have to contact the administrators.</span></td>
			</td>
          </tr>           
		  <?php endif; ?>
           <tr>
			<td colspan="4"> 
				<h4 class="error">Did you meet?</h4><br />
				<select id="meeting_status" name="meeting_status" <?php if (! isset ( $this->_tpl_vars['meetingData'] )): ?>onchange="toggleMeeting();<?php else: ?>disabled readonly<?php endif; ?>">
					<option value="1" <?php if ($this->_tpl_vars['status'] == '1'): ?>selected<?php endif; ?>> Yes </option>
					<option value="0" <?php if ($this->_tpl_vars['status'] == '0'): ?>selected<?php endif; ?>> No </option>
				</select>				
			</td>						
          </tr>		
			<tr>
				<td colspan="4" class="notmet">
					<h4 class="error">if not, please give details?</h4><br />
					<textarea id="meeting_reason" name="meeting_reason" cols="50" rows="2" <?php if (isset ( $this->_tpl_vars['meetingData'] )): ?>disabled readonly<?php endif; ?>><?php echo $this->_tpl_vars['meetingData']['meeting_reason']; ?>
</textarea>
					<?php if (isset ( $this->_tpl_vars['errorArray']['meeting_reason'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['meeting_reason']; ?>
</span><?php endif; ?>		
				</td>	
			</tr>		  
			<tr>
            <td colspan="4">
				<h4 class="error">Date and time of Meeting (Or when you were suppose to meet)</h4><br />
				<input type="text" id="meeting_date" name="meeting_date" value="<?php echo $this->_tpl_vars['meetingData']['meeting_date']; ?>
 <?php echo $this->_tpl_vars['meetingData']['meeting_starttime']; ?>
"  readonly <?php if (isset ( $this->_tpl_vars['meetingData'] )): ?>disabled readonly<?php endif; ?> size="20" />
			<br /><?php if (isset ( $this->_tpl_vars['errorArray']['meeting_date'] )): ?><span class="error"><?php echo $this->_tpl_vars['errorArray']['meeting_date']; ?>
</span><?php endif; ?>
			</td>			
			</tr>
		   <tr class="met">
            <td class="error"><h4>Meeting length</h4></td>
            <td colspan="3">
				<input type="text" id="meeting_length" name="meeting_length" value="<?php echo $this->_tpl_vars['meetingData']['meeting_length']; ?>
"  <?php if (isset ( $this->_tpl_vars['meetingData'] )): ?>disabled readonly<?php endif; ?> size="10" />
				<br />In minutes please<?php if (isset ( $this->_tpl_vars['errorArray']['meeting_date'] )): ?> - <span class="error"><?php echo $this->_tpl_vars['errorArray']['meeting_length']; ?>
</span><?php endif; ?>
			</td>
          </tr>				
			<tr>
            <td><h4>Mentee</h4></td>
            <td colspan="3">
				<?php if (isset ( $this->_tpl_vars['matchData'] )): ?> 
					<span class="success"><?php echo $this->_tpl_vars['matchData']['menteename']; ?>
</span>				
				<?php else: ?>
					<span class="error"> You are not assigned to any mentee as yet. Please contact administrators. You are not allowed to save without a mentee assigned to you.</span>
				<?php endif; ?>
				<?php if (isset ( $this->_tpl_vars['errorArray']['mentee_code'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['mentee_code']; ?>
</span><?php endif; ?>
			</td>			
          </tr>
		  <tr class="met">
           <td class="error met" ><h4>Meeting Type</h4></td>
            <td>
				<select id="meetingtype_code" name="meetingtype_code" <?php if (isset ( $this->_tpl_vars['meetingData'] )): ?>disabled readonly<?php endif; ?>>
					<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['meetingtypeData']), $this);?>

				</select>
				<?php if (isset ( $this->_tpl_vars['errorArray']['meetingtype_code'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['meetingtype_code']; ?>
</span><?php endif; ?>
			</td>	
           <td class="error"><h4>With SA-YES staff?</h4></td>
            <td>
				<select id="meeting_staff" name="meeting_staff" <?php if (isset ( $this->_tpl_vars['meetingData'] )): ?>disabled readonly<?php endif; ?>>
					<option value="1"> With Staff </option>
					<option value="0"> Without Staff </option>
				</select>	
				<?php if (isset ( $this->_tpl_vars['errorArray']['meeting_staff'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['meeting_staff']; ?>
</span><?php endif; ?>				
			</td>			
		  </tr>
           <tr class="met">
            <td class="error"><h4>With partner staff?</h4></td>
			<td>
				<select id="meeting_partner" name="meeting_partner" <?php if (isset ( $this->_tpl_vars['meetingData'] )): ?>disabled readonly<?php endif; ?>>
					<option value="1"> Yes </option>
					<option value="0"> No </option>
				</select>	
				<?php if (isset ( $this->_tpl_vars['errorArray']['meeting_partner'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['meeting_partner']; ?>
</span><?php endif; ?>					
			</td>	
            <td colspan="2" class="error">
				<h4 <?php if (isset ( $this->_tpl_vars['errorArray']['meeting_address'] )): ?>class="error"<?php endif; ?>>Where did you meet?</h4><br />
				<textarea id="meeting_address" name="meeting_address" cols="50" rows="2" <?php if (isset ( $this->_tpl_vars['meetingData'] )): ?>disabled readonly<?php endif; ?>><?php echo $this->_tpl_vars['meetingData']['meeting_address']; ?>
</textarea>
				<?php if (isset ( $this->_tpl_vars['errorArray']['meeting_address'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['meeting_address']; ?>
</span><?php endif; ?>		
			</td>			
          </tr>		    
          <tr>
			<td colspan="4"><h4 class="error">Your notes:</h4><br /><textarea name="meeting_notes" id="meeting_notes"  cols="120" rows="7"><?php echo $this->_tpl_vars['meetingData']['meeting_notes']; ?>
</textarea></td>	
          </tr>	  
        </table>
      </form>
	<?php if (! isset ( $this->_tpl_vars['meetingData'] )): ?> 
        <div class="mrg_top_10">
          <a href="javascript:submitForm();" class="blue_button mrg_left_20 fl"><span>Save &amp; Complete</span></a>   
        </div>
		<?php endif; ?>	  
	</div>
    <div class="clearer"><!-- --></div>
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

	$("#meeting_date").datetimepicker({
		dateFormat: \'yy-mm-dd\', maxDate: \'0\'
	});
	
	new nicEditor({
		iconsPath	: \'/library/javascript/nicedit/nicEditorIcons.gif\',
		buttonList 	: [\'bold\',\'italic\',\'underline\',\'left\',\'center\', \'ol\', \'ul\', \'xhtml\', \'fontFormat\', \'fontFamily\', \'fontSize\', \'unlink\', \'link\', \'strikethrough\', \'superscript\', \'subscript\'],
		uploadURI : \'/library/javascript/nicedit/nicUpload.php\',
	}).panelInstance(\'meeting_notes\');
	
	toggleMeeting();
});

function toggleMeeting() {
	var met;
	
	met = $(\'#meeting_status\').val();
	
	if(met == \'0\') {
		/* Did not meet. */
		$(\'.met\').hide();
		$(\'.notmet\').show();
	} else {
		/* Met. */
		$(\'.met\').show();
		$(\'.notmet\').hide();
	}
}

function submitForm() {
	if(confirm(\'Are you sure you want to add this meeting? To edit it you will need to contact the administrators and they would edit it for you.\')) {
		nicEditors.findEditor(\'meeting_notes\').saveContent();
		document.forms.detailsForm.submit();					 
	}
}
</script>
'; ?>

<!-- End Main Container -->
</body>
</html>