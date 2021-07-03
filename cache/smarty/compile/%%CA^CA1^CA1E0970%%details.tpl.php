<?php /* Smarty version 2.6.20, created on 2014-01-11 09:47:37
         compiled from mentor/details.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'mentor/details.tpl', 69, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-/W3C/DTD XHTML 1.0 Transitional/EN" "http:/www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http:/www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sa-Yes | Meetings</title>
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
			<li><a href="/meetings/" title="">Meetings</a></li>
			<li><a href="/meetings/view/" title="">View</a></li>
			<li>Add Meeting</li>
        </ul>
	</div><!--breadcrumb--> 
  
	<div class="inner"> 
      <h2>View/Edit Meeting</h2>
    <div id="sidetabs">
        <ul > 
            <li class="active"><a href="#" title="Details">Details</a></li>
        </ul>
    </div><!--tabs-->
	<div class="detail_box">
      <form id="detailsForm" name="detailsForm" action="/mentor/details.php<?php if (isset ( $this->_tpl_vars['meetingData'] )): ?>?code=<?php echo $this->_tpl_vars['meetingData']['meeting_code']; ?>
<?php endif; ?>" method="post">
        <table width="700" border="0" align="center" cellpadding="0" cellspacing="0" class="form">
           <?php if (isset ( $this->_tpl_vars['meetingData'] )): ?> 
		   <tr>
            <td colspan="2"><br /><span class="error">To update this meeting you will have to contact the administrators.</span></td>
			</td>
          </tr>           
		  <?php endif; ?>
		   <tr>
            <td class="left_col" <?php if (isset ( $this->_tpl_vars['errorArray']['meeting_date'] )): ?>class="error"<?php endif; ?>><h4>Date</h4></td>
            <td><input type="text" id="meeting_date" name="meeting_date" value="<?php echo $this->_tpl_vars['meetingData']['meeting_date']; ?>
"  size="20" />
			<br /><?php if (isset ( $this->_tpl_vars['errorArray']['meeting_date'] )): ?><span class="error"><?php echo $this->_tpl_vars['errorArray']['meeting_date']; ?>
</span><?php endif; ?>
			</td>
          </tr>
           <tr>
            <td class="left_col" <?php if (isset ( $this->_tpl_vars['errorArray']['meeting_length'] )): ?>class="error"<?php endif; ?>><h4>Meeting length</h4></td>
            <td>
				<input type="text" id="meeting_length" name="meeting_length" value="<?php echo $this->_tpl_vars['meetingData']['meeting_length']; ?>
"  size="10" />
				<br />In minutes please<?php if (isset ( $this->_tpl_vars['errorArray']['meeting_date'] )): ?> - <span class="error"><?php echo $this->_tpl_vars['errorArray']['meeting_length']; ?>
</span><?php endif; ?>
			</td>
          </tr>		  
           <tr>
            <td class="left_col"><h4>Mentee</h4></td>
            <td>
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
           <tr>
            <td class="left_col"><h4>Meeting Type</h4></td>
            <td>
				<select id="meetingtype_code" name="meetingtype_code">
					<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['meetingtypeData']), $this);?>

				</select>
			</td>
          </tr>
           <tr>
            <td class="left_col"><h4>Staff?</h4></td>
            <td>
				<select id="meeting_staff" name="meeting_staff">
					<option value="1"> With Staff </option>
					<option value="0"> Without Staff </option>
				</select>				
				</td>
          </tr>		  
           <tr>
            <td class="left_col"><h4>Did you meet?</h4></td>
			<td>
				<select id="meeting_status" name="meeting_status">
					<option value="1"> Yes </option>
					<option value="0"> No </option>
				</select>				
			</td>
          </tr>
           <tr>
            <td class="left_col" <?php if (isset ( $this->_tpl_vars['errorArray']['meeting_reason'] )): ?>style="color: red; font-weight: bold;"<?php endif; ?>><h4>If not, why did'nt you meet?</h4></td>
            <td><textarea id="meeting_reason" name="meeting_reason" cols="60" rows="2"><?php echo $this->_tpl_vars['meetingData']['meeting_reason']; ?>
</textarea></td>
          </tr>	  
           <tr>
            <td class="left_col" <?php if (isset ( $this->_tpl_vars['errorArray']['meeting_address'] )): ?>style="color: red; font-weight: bold;"<?php endif; ?>><h4>Where did you meet?</h4></td>
            <td><textarea id="meeting_address" name="meeting_address" cols="60" rows="2"><?php echo $this->_tpl_vars['meetingData']['meeting_address']; ?>
</textarea></td>
          </tr>	
          <tr>
			<td colspan="2"><h4>Your notes:</h4><br /><textarea name="meeting_notes" id="meeting_notes"  cols="100" rows="30"><?php echo $this->_tpl_vars['meetingData']['meeting_notes']; ?>
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
 </div><!-- End Content recruiter -->
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
});

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