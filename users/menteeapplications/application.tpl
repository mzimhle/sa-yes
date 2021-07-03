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
			<li><a href="/users/menteeapplications/" title="">Mentee Application</a></li>
			<li>Edti Application - {$menteeappData.menteeapp_name} {$menteeappData.menteeapp_surname}</li>
        </ul>
	</div><!--breadcrumb--> 
  
	<div class="inner"> 
      <h2>Edti Application - {$menteeappData.menteeapp_name} {$menteeappData.menteeapp_surname}</h2>
    <div class="clearer"><!-- --></div>
        <div class="mrg_top_10 fr">
          <a href="/users/menteeapplications/details.php?code={$menteeappData.menteeapp_code}" class="blue_button mrg_left_20 fl"><span>Mentee Details</span></a>   
		  <a href="#" class="button mrg_left_20 fl"><span>Mentee Application</span></a>   
		  <a href="/users/menteeapplications/documents.php?code={$menteeappData.menteeapp_code}" class="blue_button mrg_left_20 fl"><span>Mentee Documents</span></a>   
        </div>		
    <div class="clearer"><!-- --></div>
	<br />
	<div class="detail_box">
      <form id="detailsForm" name="detailsForm" action="/users/menteeapplications/application.php?code={$menteeappData.menteeapp_code}" method="post"  enctype="multipart/form-data">
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="form">	         		  	  
          <tr>
			<td>
				<h4 {if isset($errorArray.menteeapp_file)}class="error"{/if}>Application File:</h4><br />
				<input type="file" name="menteeapp_file" id="menteeapp_file" /><br />
				Only upload pdf, docx, doc, txt files only
				{if isset($errorArray.menteeapp_file)}<br /><span class="error">{$errorArray.menteeapp_file}</span>{/if}
				{if $menteeappData.menteeapp_file neq ''}
				<br /><br />
				<a href="{$menteeappData.menteeapp_file}" target="_blank" class="success">Click here to download the application file.</a>
				{/if}
			</td>					
			<td>
				<h4 {if isset($errorArray.applicationstatus_code)}class="error"{/if}>Status:</h4><br />
				<select id="applicationstatus_code" name="applicationstatus_code">
					<option value=""> --- </option>
					{html_options options=$applicationstatusData selected=$menteeappData.applicationstatus_code}
				</select>
			</td>					
          </tr>
		  <tr>
			<td><h4 {if isset($errorArray.menteeapp_presentation)}class="error"{/if}>Attended Presentation:</h4><br /><input type="checkbox" name="menteeapp_presentation" id="menteeapp_presentation" value="1" {if $menteeappData.menteeapp_presentation eq '1'}checked{/if} /></td>				
			<td><h4 {if isset($errorArray.menteeapp_presentationAcc)}class="error"{/if}>Presentation - Provisionally Accepted:</h4><br /><input type="checkbox" name="menteeapp_presentationAcc" id="menteeapp_presentationAcc" value="1" {if $menteeappData.menteeapp_presentationAcc eq '1'}checked{/if} /></td>							
		  </tr>	
		  <tr>
			<td><h4 {if isset($errorArray.menteeapp_application)}class="error"{/if}>Application:</h4><br /><input type="text" name="menteeapp_application" id="menteeapp_application" size="10" value="{$menteeappData.menteeapp_application}" /></td>				
			<td><h4 {if isset($errorArray.menteeapp_applicationAcc)}class="error"{/if}>Application - Provisionally Accepted:</h4><br /><input type="checkbox" name="menteeapp_applicationAcc" id="menteeapp_applicationAcc" value="1" {if $menteeappData.menteeapp_applicationAcc eq '1'}checked{/if} /></td>							
		  </tr>
		  <tr>
			<td><h4 {if isset($errorArray.menteeapp_interview)}class="error"{/if}>Attended Interview:</h4><br /><input type="text" name="menteeapp_interview" id="menteeapp_interview" size="10" value="{$menteeappData.menteeapp_interview}" /></td>				
			<td><h4 {if isset($errorArray.menteeapp_interviewAcc)}class="error"{/if}>Interview - Provisionally Accepted:</h4><br /><input type="checkbox" name="menteeapp_interviewAcc" id="menteeapp_interviewAcc" value="1" {if $menteeappData.menteeapp_interviewAcc eq '1'}checked{/if} /></td>							
		  </tr>	
		  <tr>
			<td><h4 {if isset($errorArray.menteeapp_training)}class="error"{/if}>Attended Training:</h4><br /><input type="text" name="menteeapp_training" id="menteeapp_training" size="10" value="{$menteeappData.menteeapp_training}" /></td>				
			<td><h4 {if isset($errorArray.menteeapp_trainingAcc)}class="error"{/if}>Training - Provisionally Accepted:</h4><br /><input type="checkbox" name="menteeapp_trainingAcc" id="menteeapp_trainingAcc" value="1" {if $menteeappData.menteeapp_trainingAcc eq '1'}checked{/if} /></td>							
		  </tr>
		  <tr>
			<td><h4 {if isset($errorArray.menteeapp_matchingSession)}class="error"{/if}>Attended Matching Session:</h4><br /><input type="checkbox" name="menteeapp_matchingSession" id="menteeapp_matchingSession" value="1" {if $menteeappData.menteeapp_matchingSession eq '1'}checked{/if} /></td>					
			<td><h4 {if isset($errorArray.menteeapp_matchDate)}class="error"{/if}>Match Date (1st compulsory teambuilding):</h4><br /><input type="text" name="menteeapp_matchDate" id="menteeapp_matchDate" size="10" value="{$menteeappData.menteeapp_matchDate}" /></td>									
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
	
	$( "#menteeapp_application" ).datepicker({ dateFormat: 'yy-mm-dd', changeYear: true});
	$( "#menteeapp_interview" ).datepicker({ dateFormat: 'yy-mm-dd', changeYear: true});
	$( "#menteeapp_training" ).datepicker({ dateFormat: 'yy-mm-dd', changeYear: true});
	$( "#menteeapp_matchDate" ).datepicker({ dateFormat: 'yy-mm-dd', changeYear: true});

});

function submitForm() {
	document.forms.detailsForm.submit();					 
}
</script>
{/literal}
<!-- End Main Container -->
</body>
</html>
