<?php /* Smarty version 2.6.20, created on 2014-09-22 16:53:55
         compiled from users/mentorapplications/application.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'users/mentorapplications/application.tpl', 44, false),array('function', 'html_options', 'users/mentorapplications/application.tpl', 86, false),)), $this); ?>
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
			<li>Mentor Application - <?php echo $this->_tpl_vars['mentorappData']['mentorapp_name']; ?>
 <?php echo $this->_tpl_vars['mentorappData']['mentorapp_surname']; ?>
</li>
        </ul>
	</div><!--breadcrumb--> 
  
	<div class="inner"> 
	<?php if ($this->_tpl_vars['mentorappData']['applicationstatus_code'] == 'matched'): ?>
      <h2>Match Details</h2>
    <div class="clearer"><!-- --></div>
	<br />
	<div class="detail_box">
      <form id="matchForm" name="matchForm" action="#" method="post">
		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="form">	         		  	  
          <tr>
            <td class="left_col">
				<h4>Mentee name:</h4><br />
				<input type="text" name="menteeapp_name" id="menteeapp_name" size="60" <?php if ($this->_tpl_vars['matchData']['menteename'] != ''): ?>disabled value="<?php echo $this->_tpl_vars['matchData']['menteename']; ?>
"<?php else: ?>value=""<?php endif; ?>/><br />
				<input type="hidden" name="menteeapp_code" id="menteeapp_code" value="" />
				<br />
				<span id="menteename" name="menteename"></span>
				<br />
				Match date<br />
				<input type="text" name="match_date" id="match_date" size="10" <?php if ($this->_tpl_vars['matchData']['match_date'] != ''): ?>disabled value="<?php echo $this->_tpl_vars['matchData']['match_date']; ?>
"<?php else: ?>value=""<?php endif; ?>/><br />				
				<br />
				<span class="<?php if ($this->_tpl_vars['matchData']['menteename'] != ''): ?>success<?php else: ?>error<?php endif; ?>">Mentor is currently matched with <?php echo ((is_array($_tmp=@$this->_tpl_vars['matchData']['menteename'])) ? $this->_run_mod_handler('default', true, $_tmp, 'no one') : smarty_modifier_default($_tmp, 'no one')); ?>
 for the <?php echo $this->_tpl_vars['mentorappData']['mentorship_code']; ?>
 programme</span>
				<br /><br />
				<?php if ($this->_tpl_vars['matchData']['menteename'] == ''): ?>
				<button id="mentormatch" name="mentormatch" onclick="javascript:void(0); return false;">Match with mentor</button>
				<?php else: ?>
				<button id="updatematch" name="updatematch" onclick="javascript:void(0); return false;">Update Match Date</button>
				<button id="deletematch" name="deletematch" onclick="javascript:void(0); return false;">Remove match</button>
				<?php endif; ?>
				
			</td>				
          </tr> 
		</table>
		</form>
	</div>	
	<?php endif; ?>
	<div class="clearer"><!-- --></div>
	<br /><h2>Edit Application - <?php echo $this->_tpl_vars['mentorappData']['mentorapp_name']; ?>
 <?php echo $this->_tpl_vars['mentorappData']['mentorapp_surname']; ?>
</h2>
	<div class="mrg_top_10 fr">
	  <a href="/users/mentorapplications/details.php?code=<?php echo $this->_tpl_vars['mentorappData']['mentorapp_code']; ?>
" class="blue_button mrg_left_20 fl"><span>Mentor Details</span></a>   
	  <a href="#" class="button mrg_left_20 fl"><span>Mentor Application</span></a>   
	  <a href="/users/mentorapplications/documents.php?code=<?php echo $this->_tpl_vars['mentorappData']['mentorapp_code']; ?>
" class="blue_button mrg_left_20 fl"><span>Mentor Documents</span></a>   
	</div>		
    <div class="clearer"><!-- --></div>
	<br />
	<div class="detail_box">
      <form id="detailsForm" name="detailsForm" action="/users/mentorapplications/application.php?code=<?php echo $this->_tpl_vars['mentorappData']['mentorapp_code']; ?>
" method="post" enctype="multipart/form-data">
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="form">	         		  	  
          <tr>
			<td>
				<h4 <?php if (isset ( $this->_tpl_vars['errorArray']['mentorapp_file'] )): ?>class="error"<?php endif; ?>>Application File:</h4><br />
				<input type="file" name="mentorapp_file" id="mentorapp_file" /><br />
				Only upload pdf, docx, doc, txt, jpg, jpeg, png files only
				<?php if (isset ( $this->_tpl_vars['errorArray']['mentorapp_file'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['mentorapp_file']; ?>
</span><?php endif; ?>
				<?php if ($this->_tpl_vars['mentorappData']['mentorapp_file'] != ''): ?>
				<br /><br />
				<a href="<?php echo $this->_tpl_vars['mentorappData']['mentorapp_file']; ?>
" target="_blank" class="success">Click here to download the application file.</a>
				<?php endif; ?>
			</td>					
			<td>
				<h4 <?php if (isset ( $this->_tpl_vars['errorArray']['applicationstatus_code'] )): ?>class="error"<?php endif; ?>>Status:</h4><br />
				<select id="applicationstatus_code" name="applicationstatus_code">
					<option value=""> --- </option>
					<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['applicationstatusData'],'selected' => $this->_tpl_vars['mentorappData']['applicationstatus_code']), $this);?>

				</select>
			</td>					
          </tr>
		  <tr>
			<td><h4 <?php if (isset ( $this->_tpl_vars['errorArray']['mentorapp_presentation'] )): ?>class="error"<?php endif; ?>>Attended Presentation:</h4><br /><input type="text" name="mentorapp_presentation" id="mentorapp_presentation" size="10" value="<?php echo $this->_tpl_vars['mentorappData']['mentorapp_presentation']; ?>
" /></td>				
			<td><h4 <?php if (isset ( $this->_tpl_vars['errorArray']['mentorapp_presentationAcc'] )): ?>class="error"<?php endif; ?>>Presentation - Provisionally Accepted:</h4><br /><input type="checkbox" name="mentorapp_presentationAcc" id="mentorapp_presentationAcc" value="1" <?php if ($this->_tpl_vars['mentorappData']['mentorapp_presentationAcc'] == '1'): ?>checked<?php endif; ?> /></td>							
		  </tr>	
		  <tr>
			<td><h4 <?php if (isset ( $this->_tpl_vars['errorArray']['mentorapp_application'] )): ?>class="error"<?php endif; ?>>Application (Date Received):</h4><br /><input type="text" name="mentorapp_application" id="mentorapp_application" size="10" value="<?php echo $this->_tpl_vars['mentorappData']['mentorapp_application']; ?>
" /></td>				
			<td><h4 <?php if (isset ( $this->_tpl_vars['errorArray']['mentorapp_applicationAcc'] )): ?>class="error"<?php endif; ?>>Application - Provisionally Accepted:</h4><br /><input type="checkbox" name="mentorapp_applicationAcc" id="mentorapp_applicationAcc" value="1" <?php if ($this->_tpl_vars['mentorappData']['mentorapp_applicationAcc'] == '1'): ?>checked<?php endif; ?> /></td>							
		  </tr>
		  <tr>
			<td><h4 <?php if (isset ( $this->_tpl_vars['errorArray']['mentorapp_cv'] )): ?>class="error"<?php endif; ?>>CV (Date Received):</h4><br /><input type="text" name="mentorapp_cv" id="mentorapp_cv" size="10" value="<?php echo $this->_tpl_vars['mentorappData']['mentorapp_cv']; ?>
" /></td>				
			<td><h4 <?php if (isset ( $this->_tpl_vars['errorArray']['mentorapp_imageWaiver'] )): ?>class="error"<?php endif; ?>>Completed photo/media release waiver? See notes for details:</h4><br /><input type="checkbox" name="mentorapp_imageWaiver" id="mentorapp_imageWaiver" value="1" <?php if ($this->_tpl_vars['mentorappData']['mentorapp_imageWaiver'] == '1'): ?>checked<?php endif; ?> /></td>							
		  </tr>	
		  <tr>
			<td><h4 <?php if (isset ( $this->_tpl_vars['errorArray']['mentorapp_form29Id'] )): ?>class="error"<?php endif; ?>>Certified ID for form 29 (Date Received):</h4><br /><input type="text" name="mentorapp_form29Id" id="mentorapp_form29Id" size="10" value="<?php echo $this->_tpl_vars['mentorappData']['mentorapp_form29Id']; ?>
" /></td>				
			<td><h4 <?php if (isset ( $this->_tpl_vars['errorArray']['mentorapp_form29sent'] )): ?>class="error"<?php endif; ?>>Form 29 letter (Date Sent):</h4><br /><input type="text" name="mentorapp_form29sent" id="mentorapp_form29sent" size="10" value="<?php echo $this->_tpl_vars['mentorappData']['mentorapp_form29sent']; ?>
" /></td>									
		  </tr>		  
		  <tr>
			<td colspan="2"><h4 <?php if (isset ( $this->_tpl_vars['errorArray']['mentorapp_form29clearance'] )): ?>class="error"<?php endif; ?>>Confirmation of form 29 clearance (Date Received):</h4><br /><input type="text" name="mentorapp_form29clearance" id="mentorapp_form29clearance" size="10" value="<?php echo $this->_tpl_vars['mentorappData']['mentorapp_form29clearance']; ?>
" /></td>				
		  </tr>	
		  <tr>
			<td><h4 <?php if (isset ( $this->_tpl_vars['errorArray']['mentorapp_sapsClRefund'] )): ?>class="error"<?php endif; ?>>Refund for SAPS police clearance given (Date):</h4><br /><input type="text" name="mentorapp_sapsClRefund" id="mentorapp_sapsClRefund" size="10" value="<?php echo $this->_tpl_vars['mentorappData']['mentorapp_sapsClRefund']; ?>
" /></td>				
			<td><h4 <?php if (isset ( $this->_tpl_vars['errorArray']['mentorapp_sapsClAmount'] )): ?>class="error"<?php endif; ?>>Refund for SAPS police clearance given (Amount in Rands):</h4><br /><input type="text" name="mentorapp_sapsClAmount" id="mentorapp_sapsClAmount" size="10" value="<?php echo $this->_tpl_vars['mentorappData']['mentorapp_sapsClAmount']; ?>
" /></td>									
		  </tr>	
		  <tr>
			<td colspan="2"><h4 <?php if (isset ( $this->_tpl_vars['errorArray']['mentorapp_sapsClProof'] )): ?>class="error"<?php endif; ?>>Proof of SAPS clearance made at police station (Date Received):</h4><br /><input type="text" name="mentorapp_sapsClProof" id="mentorapp_sapsClProof" size="10" value="<?php echo $this->_tpl_vars['mentorappData']['mentorapp_sapsClProof']; ?>
" /></td>									
		  </tr>
		  <tr>
			<td><h4 <?php if (isset ( $this->_tpl_vars['errorArray']['mentorapp_sapsCertAppSent'] )): ?>class="error"<?php endif; ?>>SAPS Clearance Certificate Application (Date Sent):</h4><br /><input type="text" name="mentorapp_sapsCertAppSent" id="mentorapp_sapsCertAppSent" size="10" value="<?php echo $this->_tpl_vars['mentorappData']['mentorapp_sapsCertAppSent']; ?>
" /></td>				
			<td><h4 <?php if (isset ( $this->_tpl_vars['errorArray']['mentorapp_sapsCertAppRecieved'] )): ?>class="error"<?php endif; ?>>SAPS Clearance Certificate (Date Received):</h4><br /><input type="text" name="mentorapp_sapsCertAppRecieved" id="mentorapp_sapsCertAppRecieved" size="10" value="<?php echo $this->_tpl_vars['mentorappData']['mentorapp_sapsCertAppRecieved']; ?>
" /></td>									
		  </tr>		
		  <tr>
			<td><h4 <?php if (isset ( $this->_tpl_vars['errorArray']['mentorapp_oversCertAppSent'] )): ?>class="error"<?php endif; ?>>Overseas Police Clearance Certificate Application (Date Sent):</h4><br /><input type="text" name="mentorapp_oversCertAppSent" id="mentorapp_oversCertAppSent" size="10" value="<?php echo $this->_tpl_vars['mentorappData']['mentorapp_oversCertAppSent']; ?>
" /></td>				
			<td><h4 <?php if (isset ( $this->_tpl_vars['errorArray']['mentorapp_oversCertAppReceived'] )): ?>class="error"<?php endif; ?>>Overseas Police Clearance Certificate (Date Received):</h4><br /><input type="text" name="mentorapp_oversCertAppReceived" id="mentorapp_oversCertAppReceived" size="10" value="<?php echo $this->_tpl_vars['mentorappData']['mentorapp_oversCertAppReceived']; ?>
" /></td>									
		  </tr>	
		  <tr>
			<td><h4 <?php if (isset ( $this->_tpl_vars['errorArray']['mentorapp_oversCertAppRefund'] )): ?>class="error"<?php endif; ?>>Refund for Overseas Police Clearance Given (Date):</h4><br /><input type="text" name="mentorapp_oversCertAppRefund" id="mentorapp_oversCertAppRefund" size="10" value="<?php echo $this->_tpl_vars['mentorappData']['mentorapp_oversCertAppRefund']; ?>
" /></td>				
			<td><h4 <?php if (isset ( $this->_tpl_vars['errorArray']['mentorapp_oversCertAppAmount'] )): ?>class="error"<?php endif; ?>>Refund for Overseas Police Clearance Given (Amount in Rands):</h4><br /><input type="text" name="mentorapp_oversCertAppAmount" id="mentorapp_oversCertAppAmount" size="10" value="<?php echo $this->_tpl_vars['mentorappData']['mentorapp_oversCertAppAmount']; ?>
" /></td>									
		  </tr>		
		  <tr>
			<td><h4 <?php if (isset ( $this->_tpl_vars['errorArray']['mentorapp_referenceOne'] )): ?>class="error"<?php endif; ?>>Received Reference (1):</h4><br /><input type="text" name="mentorapp_referenceOne" id="mentorapp_referenceOne" size="10" value="<?php echo $this->_tpl_vars['mentorappData']['mentorapp_referenceOne']; ?>
" /></td>				
			<td><h4 <?php if (isset ( $this->_tpl_vars['errorArray']['mentorapp_referenceTwo'] )): ?>class="error"<?php endif; ?>>Received Reference (2):</h4><br /><input type="text" name="mentorapp_referenceTwo" id="mentorapp_referenceTwo" size="10" value="<?php echo $this->_tpl_vars['mentorappData']['mentorapp_referenceTwo']; ?>
" /></td>				
		  </tr>	
		  <tr>
			<td colspan="2"><h4 <?php if (isset ( $this->_tpl_vars['errorArray']['mentorapp_referenceThee'] )): ?>class="error"<?php endif; ?>>Received Reference (3):</h4><br /><input type="text" name="mentorapp_referenceThee" id="mentorapp_referenceThee" size="10" value="<?php echo $this->_tpl_vars['mentorappData']['mentorapp_referenceThee']; ?>
" /></td>
		  </tr>
		  <tr>
			<td><h4 <?php if (isset ( $this->_tpl_vars['errorArray']['mentorapp_interview'] )): ?>class="error"<?php endif; ?>>Attended Interview:</h4><br /><input type="text" name="mentorapp_interview" id="mentorapp_interview" size="10" value="<?php echo $this->_tpl_vars['mentorappData']['mentorapp_interview']; ?>
" /></td>				
			<td><h4 <?php if (isset ( $this->_tpl_vars['errorArray']['mentorapp_interviewAcc'] )): ?>class="error"<?php endif; ?>>Interview - Provisionally Accepted:</h4><br /><input type="checkbox" name="mentorapp_interviewAcc" id="mentorapp_interviewAcc" value="1" <?php if ($this->_tpl_vars['mentorappData']['mentorapp_interviewAcc'] == '1'): ?>checked<?php endif; ?> /></td>							
		  </tr>	
		  <tr>
			<td><h4 <?php if (isset ( $this->_tpl_vars['errorArray']['mentorapp_training'] )): ?>class="error"<?php endif; ?>>Attended Training:</h4><br /><input type="text" name="mentorapp_training" id="mentorapp_training" size="10" value="<?php echo $this->_tpl_vars['mentorappData']['mentorapp_training']; ?>
" /></td>				
			<td><h4 <?php if (isset ( $this->_tpl_vars['errorArray']['mentorapp_trainingAcc'] )): ?>class="error"<?php endif; ?>>Training - Provisionally Accepted:</h4><br /><input type="checkbox" name="mentorapp_trainingAcc" id="mentorapp_trainingAcc" value="1" <?php if ($this->_tpl_vars['mentorappData']['mentorapp_trainingAcc'] == '1'): ?>checked<?php endif; ?> /></td>							
		  </tr>		
		  <tr>
			<td><h4 <?php if (isset ( $this->_tpl_vars['errorArray']['mentorapp_matchingDate'] )): ?>class="error"<?php endif; ?>>Match Date (1st compulsory teambuilding):</h4><br /><input type="text" name="mentorapp_matchingDate" id="mentorapp_matchingDate" size="10" value="<?php echo $this->_tpl_vars['mentorappData']['mentorapp_matchingDate']; ?>
" /></td>				
			<td><h4 <?php if (isset ( $this->_tpl_vars['errorArray']['mentorapp_matchingSession'] )): ?>class="error"<?php endif; ?>>Attended Match Day:</h4><br /><input type="checkbox" name="mentorapp_matchingSession" id="mentorapp_matchingSession" value="1" <?php if ($this->_tpl_vars['mentorappData']['mentorapp_matchingSession'] == '1'): ?>checked<?php endif; ?> /></td>							
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
	
	$( "#match_date" ).datepicker({ dateFormat: \'yy-mm-dd\', changeYear: true});

	$( "#mentorapp_presentation" ).datepicker({ dateFormat: \'yy-mm-dd\', changeYear: true});
	$( "#mentorapp_application" ).datepicker({ dateFormat: \'yy-mm-dd\', changeYear: true});
	$( "#mentorapp_cv" ).datepicker({ dateFormat: \'yy-mm-dd\', changeYear: true});
	$( "#mentorapp_form29Id" ).datepicker({ dateFormat: \'yy-mm-dd\', changeYear: true});
	$( "#mentorapp_form29sent" ).datepicker({ dateFormat: \'yy-mm-dd\', changeYear: true});
	$( "#mentorapp_form29clearance" ).datepicker({ dateFormat: \'yy-mm-dd\', changeYear: true});
	$( "#mentorapp_sapsClProof" ).datepicker({ dateFormat: \'yy-mm-dd\', changeYear: true});
	$( "#mentorapp_sapsClRefund" ).datepicker({ dateFormat: \'yy-mm-dd\', changeYear: true});
	$( "#mentorapp_sapsCertAppSent" ).datepicker({ dateFormat: \'yy-mm-dd\', changeYear: true});
	$( "#mentorapp_sapsCertAppRecieved" ).datepicker({ dateFormat: \'yy-mm-dd\', changeYear: true});
	$( "#mentorapp_oversCertAppSent" ).datepicker({ dateFormat: \'yy-mm-dd\', changeYear: true});
	$( "#mentorapp_oversCertAppReceived" ).datepicker({ dateFormat: \'yy-mm-dd\', changeYear: true});
	$( "#mentorapp_oversCertAppRefund" ).datepicker({ dateFormat: \'yy-mm-dd\', changeYear: true});
	$( "#mentorapp_interview" ).datepicker({ dateFormat: \'yy-mm-dd\', changeYear: true});
	$( "#mentorapp_training" ).datepicker({ dateFormat: \'yy-mm-dd\', changeYear: true});
	$( "#mentorapp_matchingDate" ).datepicker({ dateFormat: \'yy-mm-dd\', changeYear: true});

	/* Search for mentees. */
	$( "#menteeapp_name").autocomplete({
		source: "/feeds/menteeapp.php?mentorship='; ?>
<?php echo $this->_tpl_vars['mentorappData']['mentorship_code']; ?>
<?php echo '",
		minLength: 2,
		select: function( event, ui ) {
		
			if(ui.item.id == \'\') {
				$(\'#menteeappname\').html(\'\');
				$(\'#menteeapp_code\').val(\'\');					
			} else {					
				getmentee(ui.item.id);					
			}				
			$(\'#menteeapp_name\').val(\'\');										
		}
	});
	
	$(\'#deletematch\').click(function() {
	
		if(confirm(\'Are you sure you want to delete this match?\')) {
			$.post("?action=deletematch&code='; ?>
<?php echo $this->_tpl_vars['mentorappData']['mentorapp_code']; ?>
<?php echo '", { },
				function(data) {
					if(data.result) {										
						alert(\'Match was deleted\');
						window.location = window.location;
					} else {
						alert(data.message);
					}
				},
				\'json\'
			);			
		}
		return false;
	});
	
	$(\'#updatematch\').click(function() {
	
		if(confirm(\'Are you sure you want to update the notes?\')) {
			$.post("?action=updatematch&code='; ?>
<?php echo $this->_tpl_vars['mentorappData']['mentorapp_code']; ?>
<?php echo '", {
					match_date	: $(\'#match_date\').val()
				},
				function(data) {
					if(data.result) {										
						alert(\'Match was updated\');
						window.location = window.location;
					} else {
						alert(data.message);
					}
				},
				\'json\'
			);			
		}
		return false;
	});
	
	$(\'#mentormatch\').click(function() {
	
		if($(\'#menteeapp_code\').val() != \'\') {
			if(confirm(\'Are you sure you want to match this mentee with this mentor?\')) {
				$.post("?action=match&code='; ?>
<?php echo $this->_tpl_vars['mentorappData']['mentorapp_code']; ?>
<?php echo '", {
						menteecode	: $(\'#menteeapp_code\').val(),
						match_date	: $(\'#match_date\').val()
					},
					function(data) {
						if(data.result) {										
							alert(\'Match was successful\');
							window.location = window.location;
						} else {
							alert(data.message);
						}
					},
					\'json\'
				);			
			}
		} else {
			alert(\'Please select mentee first.\');
		}
		return false;
	});
});

function getmentee(id) {
	$.post("?action=getmentee&code='; ?>
<?php echo $this->_tpl_vars['mentorappData']['mentorapp_code']; ?>
<?php echo '", {
			menteecode	: id
		},
		function(data) {
			if(data.result) {			
				$(\'#menteeapp_code\').val(data.records.menteeapp_code);		
				$(\'#menteename\').html(\'<b class="success">\' + data.records.menteeapp_name + \' \' + data.records.menteeapp_surname + \'</b>\');		
			} else {
				alert(data.message);
				$(\'#menteeapp_code\').val(\'\');		
				$(\'#menteename\').html(\'\');						
			}
		},
		\'json\'
	);
}

function submitForm() {
	document.forms.detailsForm.submit();					 
}
</script>
'; ?>

<!-- End Main Container -->
</body>
</html>