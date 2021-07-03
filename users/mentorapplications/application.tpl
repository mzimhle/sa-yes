<!DOCTYPE html PUBLIC "-/W3C/DTD XHTML 1.0 Transitional/EN" "http:/www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http:/www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SA-YES | Users</title>
{include_php file='includes/css.php'}
{include_php file='includes/javascript.php'}
</head>
<body>
<!-- Start Main Container -->
<div id="container">
    <!-- Start Content recruiter -->
  <div id="content">
    {include_php file='includes/header.php'}
  	<br />
	<div id="breadcrumb">
        <ul>
            <li><a href="/" title="Home">Home</a></li>
			<li><a href="/users/" title="">Users</a></li>
			<li><a href="/users/mentorapplications/" title="">Mentor Application</a></li>
			<li>Mentor Application - {$mentorappData.mentorapp_name} {$mentorappData.mentorapp_surname}</li>
        </ul>
	</div><!--breadcrumb--> 
  
	<div class="inner"> 
	{if $mentorappData.applicationstatus_code eq 'matched'}
      <h2>Match Details</h2>
    <div class="clearer"><!-- --></div>
	<br />
	<div class="detail_box">
      <form id="matchForm" name="matchForm" action="#" method="post">
		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="form">	         		  	  
          <tr>
            <td class="left_col">
				<h4>Mentee name:</h4><br />
				<input type="text" name="menteeapp_name" id="menteeapp_name" size="60" {if $matchData.menteename neq ''}disabled value="{$matchData.menteename}"{else}value=""{/if}/><br />
				<input type="hidden" name="menteeapp_code" id="menteeapp_code" value="" />
				<br />
				<span id="menteename" name="menteename"></span>
				<br />
				Match date<br />
				<input type="text" name="match_date" id="match_date" size="10" {if $matchData.match_date neq ''}disabled value="{$matchData.match_date}"{else}value=""{/if}/><br />				
				<br />
				<span class="{if $matchData.menteename neq ''}success{else}error{/if}">Mentor is currently matched with {$matchData.menteename|default:"no one"} for the {$mentorappData.mentorship_code} programme</span>
				<br /><br />
				{if $matchData.menteename eq ''}
				<button id="mentormatch" name="mentormatch" onclick="javascript:void(0); return false;">Match with mentor</button>
				{else}
				<button id="updatematch" name="updatematch" onclick="javascript:void(0); return false;">Update Match Date</button>
				<button id="deletematch" name="deletematch" onclick="javascript:void(0); return false;">Remove match</button>
				{/if}
				
			</td>				
          </tr> 
		</table>
		</form>
	</div>	
	{/if}
	<div class="clearer"><!-- --></div>
	<br /><h2>Edit Application - {$mentorappData.mentorapp_name} {$mentorappData.mentorapp_surname}</h2>
	<div class="mrg_top_10 fr">
	  <a href="/users/mentorapplications/details.php?code={$mentorappData.mentorapp_code}" class="blue_button mrg_left_20 fl"><span>Mentor Details</span></a>   
	  <a href="#" class="button mrg_left_20 fl"><span>Mentor Application</span></a>   
	  <a href="/users/mentorapplications/documents.php?code={$mentorappData.mentorapp_code}" class="blue_button mrg_left_20 fl"><span>Mentor Documents</span></a>   
	</div>		
    <div class="clearer"><!-- --></div>
	<br />
	<div class="detail_box">
      <form id="detailsForm" name="detailsForm" action="/users/mentorapplications/application.php?code={$mentorappData.mentorapp_code}" method="post" enctype="multipart/form-data">
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="form">	         		  	  
          <tr>
			<td>
				<h4 {if isset($errorArray.mentorapp_file)}class="error"{/if}>Application File:</h4><br />
				<input type="file" name="mentorapp_file" id="mentorapp_file" /><br />
				Only upload pdf, docx, doc, txt, jpg, jpeg, png files only
				{if isset($errorArray.mentorapp_file)}<br /><span class="error">{$errorArray.mentorapp_file}</span>{/if}
				{if $mentorappData.mentorapp_file neq ''}
				<br /><br />
				<a href="{$mentorappData.mentorapp_file}" target="_blank" class="success">Click here to download the application file.</a>
				{/if}
			</td>					
			<td>
				<h4 {if isset($errorArray.applicationstatus_code)}class="error"{/if}>Status:</h4><br />
				<select id="applicationstatus_code" name="applicationstatus_code">
					<option value=""> --- </option>
					{html_options options=$applicationstatusData selected=$mentorappData.applicationstatus_code}
				</select>
			</td>					
          </tr>
		  <tr>
			<td><h4 {if isset($errorArray.mentorapp_presentation)}class="error"{/if}>Attended Presentation:</h4><br /><input type="text" name="mentorapp_presentation" id="mentorapp_presentation" size="10" value="{$mentorappData.mentorapp_presentation}" /></td>				
			<td><h4 {if isset($errorArray.mentorapp_presentationAcc)}class="error"{/if}>Presentation - Provisionally Accepted:</h4><br /><input type="checkbox" name="mentorapp_presentationAcc" id="mentorapp_presentationAcc" value="1" {if $mentorappData.mentorapp_presentationAcc eq '1'}checked{/if} /></td>							
		  </tr>	
		  <tr>
			<td><h4 {if isset($errorArray.mentorapp_application)}class="error"{/if}>Application (Date Received):</h4><br /><input type="text" name="mentorapp_application" id="mentorapp_application" size="10" value="{$mentorappData.mentorapp_application}" /></td>				
			<td><h4 {if isset($errorArray.mentorapp_applicationAcc)}class="error"{/if}>Application - Provisionally Accepted:</h4><br /><input type="checkbox" name="mentorapp_applicationAcc" id="mentorapp_applicationAcc" value="1" {if $mentorappData.mentorapp_applicationAcc eq '1'}checked{/if} /></td>							
		  </tr>
		  <tr>
			<td><h4 {if isset($errorArray.mentorapp_cv)}class="error"{/if}>CV (Date Received):</h4><br /><input type="text" name="mentorapp_cv" id="mentorapp_cv" size="10" value="{$mentorappData.mentorapp_cv}" /></td>				
			<td><h4 {if isset($errorArray.mentorapp_imageWaiver)}class="error"{/if}>Completed photo/media release waiver? See notes for details:</h4><br /><input type="checkbox" name="mentorapp_imageWaiver" id="mentorapp_imageWaiver" value="1" {if $mentorappData.mentorapp_imageWaiver eq '1'}checked{/if} /></td>							
		  </tr>	
		  <tr>
			<td><h4 {if isset($errorArray.mentorapp_form29Id)}class="error"{/if}>Certified ID for form 29 (Date Received):</h4><br /><input type="text" name="mentorapp_form29Id" id="mentorapp_form29Id" size="10" value="{$mentorappData.mentorapp_form29Id}" /></td>				
			<td><h4 {if isset($errorArray.mentorapp_form29sent)}class="error"{/if}>Form 29 letter (Date Sent):</h4><br /><input type="text" name="mentorapp_form29sent" id="mentorapp_form29sent" size="10" value="{$mentorappData.mentorapp_form29sent}" /></td>									
		  </tr>		  
		  <tr>
			<td colspan="2"><h4 {if isset($errorArray.mentorapp_form29clearance)}class="error"{/if}>Confirmation of form 29 clearance (Date Received):</h4><br /><input type="text" name="mentorapp_form29clearance" id="mentorapp_form29clearance" size="10" value="{$mentorappData.mentorapp_form29clearance}" /></td>				
		  </tr>	
		  <tr>
			<td><h4 {if isset($errorArray.mentorapp_sapsClRefund)}class="error"{/if}>Refund for SAPS police clearance given (Date):</h4><br /><input type="text" name="mentorapp_sapsClRefund" id="mentorapp_sapsClRefund" size="10" value="{$mentorappData.mentorapp_sapsClRefund}" /></td>				
			<td><h4 {if isset($errorArray.mentorapp_sapsClAmount)}class="error"{/if}>Refund for SAPS police clearance given (Amount in Rands):</h4><br /><input type="text" name="mentorapp_sapsClAmount" id="mentorapp_sapsClAmount" size="10" value="{$mentorappData.mentorapp_sapsClAmount}" /></td>									
		  </tr>	
		  <tr>
			<td colspan="2"><h4 {if isset($errorArray.mentorapp_sapsClProof)}class="error"{/if}>Proof of SAPS clearance made at police station (Date Received):</h4><br /><input type="text" name="mentorapp_sapsClProof" id="mentorapp_sapsClProof" size="10" value="{$mentorappData.mentorapp_sapsClProof}" /></td>									
		  </tr>
		  <tr>
			<td><h4 {if isset($errorArray.mentorapp_sapsCertAppSent)}class="error"{/if}>SAPS Clearance Certificate Application (Date Sent):</h4><br /><input type="text" name="mentorapp_sapsCertAppSent" id="mentorapp_sapsCertAppSent" size="10" value="{$mentorappData.mentorapp_sapsCertAppSent}" /></td>				
			<td><h4 {if isset($errorArray.mentorapp_sapsCertAppRecieved)}class="error"{/if}>SAPS Clearance Certificate (Date Received):</h4><br /><input type="text" name="mentorapp_sapsCertAppRecieved" id="mentorapp_sapsCertAppRecieved" size="10" value="{$mentorappData.mentorapp_sapsCertAppRecieved}" /></td>									
		  </tr>		
		  <tr>
			<td><h4 {if isset($errorArray.mentorapp_oversCertAppSent)}class="error"{/if}>Overseas Police Clearance Certificate Application (Date Sent):</h4><br /><input type="text" name="mentorapp_oversCertAppSent" id="mentorapp_oversCertAppSent" size="10" value="{$mentorappData.mentorapp_oversCertAppSent}" /></td>				
			<td><h4 {if isset($errorArray.mentorapp_oversCertAppReceived)}class="error"{/if}>Overseas Police Clearance Certificate (Date Received):</h4><br /><input type="text" name="mentorapp_oversCertAppReceived" id="mentorapp_oversCertAppReceived" size="10" value="{$mentorappData.mentorapp_oversCertAppReceived}" /></td>									
		  </tr>	
		  <tr>
			<td><h4 {if isset($errorArray.mentorapp_oversCertAppRefund)}class="error"{/if}>Refund for Overseas Police Clearance Given (Date):</h4><br /><input type="text" name="mentorapp_oversCertAppRefund" id="mentorapp_oversCertAppRefund" size="10" value="{$mentorappData.mentorapp_oversCertAppRefund}" /></td>				
			<td><h4 {if isset($errorArray.mentorapp_oversCertAppAmount)}class="error"{/if}>Refund for Overseas Police Clearance Given (Amount in Rands):</h4><br /><input type="text" name="mentorapp_oversCertAppAmount" id="mentorapp_oversCertAppAmount" size="10" value="{$mentorappData.mentorapp_oversCertAppAmount}" /></td>									
		  </tr>		
		  <tr>
			<td><h4 {if isset($errorArray.mentorapp_referenceOne)}class="error"{/if}>Received Reference (1):</h4><br /><input type="text" name="mentorapp_referenceOne" id="mentorapp_referenceOne" size="10" value="{$mentorappData.mentorapp_referenceOne}" /></td>				
			<td><h4 {if isset($errorArray.mentorapp_referenceTwo)}class="error"{/if}>Received Reference (2):</h4><br /><input type="text" name="mentorapp_referenceTwo" id="mentorapp_referenceTwo" size="10" value="{$mentorappData.mentorapp_referenceTwo}" /></td>				
		  </tr>	
		  <tr>
			<td colspan="2"><h4 {if isset($errorArray.mentorapp_referenceThee)}class="error"{/if}>Received Reference (3):</h4><br /><input type="text" name="mentorapp_referenceThee" id="mentorapp_referenceThee" size="10" value="{$mentorappData.mentorapp_referenceThee}" /></td>
		  </tr>
		  <tr>
			<td><h4 {if isset($errorArray.mentorapp_interview)}class="error"{/if}>Attended Interview:</h4><br /><input type="text" name="mentorapp_interview" id="mentorapp_interview" size="10" value="{$mentorappData.mentorapp_interview}" /></td>				
			<td><h4 {if isset($errorArray.mentorapp_interviewAcc)}class="error"{/if}>Interview - Provisionally Accepted:</h4><br /><input type="checkbox" name="mentorapp_interviewAcc" id="mentorapp_interviewAcc" value="1" {if $mentorappData.mentorapp_interviewAcc eq '1'}checked{/if} /></td>							
		  </tr>	
		  <tr>
			<td><h4 {if isset($errorArray.mentorapp_training)}class="error"{/if}>Attended Training:</h4><br /><input type="text" name="mentorapp_training" id="mentorapp_training" size="10" value="{$mentorappData.mentorapp_training}" /></td>				
			<td><h4 {if isset($errorArray.mentorapp_trainingAcc)}class="error"{/if}>Training - Provisionally Accepted:</h4><br /><input type="checkbox" name="mentorapp_trainingAcc" id="mentorapp_trainingAcc" value="1" {if $mentorappData.mentorapp_trainingAcc eq '1'}checked{/if} /></td>							
		  </tr>		
		  <tr>
			<td><h4 {if isset($errorArray.mentorapp_matchingDate)}class="error"{/if}>Match Date (1st compulsory teambuilding):</h4><br /><input type="text" name="mentorapp_matchingDate" id="mentorapp_matchingDate" size="10" value="{$mentorappData.mentorapp_matchingDate}" /></td>				
			<td><h4 {if isset($errorArray.mentorapp_matchingSession)}class="error"{/if}>Attended Match Day:</h4><br /><input type="checkbox" name="mentorapp_matchingSession" id="mentorapp_matchingSession" value="1" {if $mentorappData.mentorapp_matchingSession eq '1'}checked{/if} /></td>							
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
 {include_php file='includes/footer.php'}
</div>
{literal}
<script type="text/javascript">
$(document).ready(function() {	
	
	$( "#match_date" ).datepicker({ dateFormat: 'yy-mm-dd', changeYear: true});

	$( "#mentorapp_presentation" ).datepicker({ dateFormat: 'yy-mm-dd', changeYear: true});
	$( "#mentorapp_application" ).datepicker({ dateFormat: 'yy-mm-dd', changeYear: true});
	$( "#mentorapp_cv" ).datepicker({ dateFormat: 'yy-mm-dd', changeYear: true});
	$( "#mentorapp_form29Id" ).datepicker({ dateFormat: 'yy-mm-dd', changeYear: true});
	$( "#mentorapp_form29sent" ).datepicker({ dateFormat: 'yy-mm-dd', changeYear: true});
	$( "#mentorapp_form29clearance" ).datepicker({ dateFormat: 'yy-mm-dd', changeYear: true});
	$( "#mentorapp_sapsClProof" ).datepicker({ dateFormat: 'yy-mm-dd', changeYear: true});
	$( "#mentorapp_sapsClRefund" ).datepicker({ dateFormat: 'yy-mm-dd', changeYear: true});
	$( "#mentorapp_sapsCertAppSent" ).datepicker({ dateFormat: 'yy-mm-dd', changeYear: true});
	$( "#mentorapp_sapsCertAppRecieved" ).datepicker({ dateFormat: 'yy-mm-dd', changeYear: true});
	$( "#mentorapp_oversCertAppSent" ).datepicker({ dateFormat: 'yy-mm-dd', changeYear: true});
	$( "#mentorapp_oversCertAppReceived" ).datepicker({ dateFormat: 'yy-mm-dd', changeYear: true});
	$( "#mentorapp_oversCertAppRefund" ).datepicker({ dateFormat: 'yy-mm-dd', changeYear: true});
	$( "#mentorapp_interview" ).datepicker({ dateFormat: 'yy-mm-dd', changeYear: true});
	$( "#mentorapp_training" ).datepicker({ dateFormat: 'yy-mm-dd', changeYear: true});
	$( "#mentorapp_matchingDate" ).datepicker({ dateFormat: 'yy-mm-dd', changeYear: true});

	/* Search for mentees. */
	$( "#menteeapp_name").autocomplete({
		source: "/feeds/menteeapp.php?mentorship={/literal}{$mentorappData.mentorship_code}{literal}",
		minLength: 2,
		select: function( event, ui ) {
		
			if(ui.item.id == '') {
				$('#menteeappname').html('');
				$('#menteeapp_code').val('');					
			} else {					
				getmentee(ui.item.id);					
			}				
			$('#menteeapp_name').val('');										
		}
	});
	
	$('#deletematch').click(function() {
	
		if(confirm('Are you sure you want to delete this match?')) {
			$.post("?action=deletematch&code={/literal}{$mentorappData.mentorapp_code}{literal}", { },
				function(data) {
					if(data.result) {										
						alert('Match was deleted');
						window.location = window.location;
					} else {
						alert(data.message);
					}
				},
				'json'
			);			
		}
		return false;
	});
	
	$('#updatematch').click(function() {
	
		if(confirm('Are you sure you want to update the notes?')) {
			$.post("?action=updatematch&code={/literal}{$mentorappData.mentorapp_code}{literal}", {
					match_date	: $('#match_date').val()
				},
				function(data) {
					if(data.result) {										
						alert('Match was updated');
						window.location = window.location;
					} else {
						alert(data.message);
					}
				},
				'json'
			);			
		}
		return false;
	});
	
	$('#mentormatch').click(function() {
	
		if($('#menteeapp_code').val() != '') {
			if(confirm('Are you sure you want to match this mentee with this mentor?')) {
				$.post("?action=match&code={/literal}{$mentorappData.mentorapp_code}{literal}", {
						menteecode	: $('#menteeapp_code').val(),
						match_date	: $('#match_date').val()
					},
					function(data) {
						if(data.result) {										
							alert('Match was successful');
							window.location = window.location;
						} else {
							alert(data.message);
						}
					},
					'json'
				);			
			}
		} else {
			alert('Please select mentee first.');
		}
		return false;
	});
});

function getmentee(id) {
	$.post("?action=getmentee&code={/literal}{$mentorappData.mentorapp_code}{literal}", {
			menteecode	: id
		},
		function(data) {
			if(data.result) {			
				$('#menteeapp_code').val(data.records.menteeapp_code);		
				$('#menteename').html('<b class="success">' + data.records.menteeapp_name + ' ' + data.records.menteeapp_surname + '</b>');		
			} else {
				alert(data.message);
				$('#menteeapp_code').val('');		
				$('#menteename').html('');						
			}
		},
		'json'
	);
}

function submitForm() {
	document.forms.detailsForm.submit();					 
}
</script>
{/literal}
<!-- End Main Container -->
</body>
</html>
