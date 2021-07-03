<!DOCTYPE html PUBLIC "-/W3C/DTD XHTML 1.0 Transitional/EN" "http:/www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http:/www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SA-YES | Meetings</title>
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
           {if isset($meetingData)} 
		   <tr>
				<td colspan="4"><br /><span class="error">To update this meeting you will have to contact the administrators.</span></td>
			</td>
          </tr>           
		  {/if}
           <tr>
			<td colspan="4"> 
				<h4 class="error">Did you meet?</h4><br />
				<select id="meeting_status" name="meeting_status" {if !isset($meetingData)}onchange="toggleMeeting();{else}disabled readonly{/if}">
					<option value="1" {if $status eq '1'}selected{/if}> Yes </option>
					<option value="0" {if $status eq '0'}selected{/if}> No </option>
				</select>				
			</td>						
          </tr>		
			<tr>
				<td colspan="4" class="notmet">
					<h4 class="error">if not, please give details?</h4><br />
					<textarea id="meeting_reason" name="meeting_reason" cols="50" rows="2" {if isset($meetingData)}disabled readonly{/if}>{$meetingData.meeting_reason}</textarea>
					{if isset($errorArray.meeting_reason)}<br /><span class="error">{$errorArray.meeting_reason}</span>{/if}		
				</td>	
			</tr>		  
			<tr>
            <td colspan="4">
				<h4 class="error">Date and time of Meeting (Or when you were suppose to meet)</h4><br />
				<input type="text" id="meeting_date" name="meeting_date" value="{$meetingData.meeting_date} {$meetingData.meeting_starttime}"  readonly {if isset($meetingData)}disabled readonly{/if} size="20" />
			<br />{if isset($errorArray.meeting_date)}<span class="error">{$errorArray.meeting_date}</span>{/if}
			</td>			
			</tr>
		   <tr class="met">
            <td class="error"><h4>Meeting length</h4></td>
            <td colspan="3">
				<input type="text" id="meeting_length" name="meeting_length" value="{$meetingData.meeting_length}"  {if isset($meetingData)}disabled readonly{/if} size="10" />
				<br />In minutes please{if isset($errorArray.meeting_date)} - <span class="error">{$errorArray.meeting_length}</span>{/if}
			</td>
          </tr>				
			<tr>
            <td><h4>Mentee</h4></td>
            <td colspan="3">
				{if isset($matchData)} 
					<span class="success">{$matchData.menteename}</span>				
				{else}
					<span class="error"> You are not assigned to any mentee as yet. Please contact administrators. You are not allowed to save without a mentee assigned to you.</span>
				{/if}
				{if isset($errorArray.mentee_code)}<br /><span class="error">{$errorArray.mentee_code}</span>{/if}
			</td>			
          </tr>
		  <tr class="met">
           <td class="error met" ><h4>Meeting Type</h4></td>
            <td>
				<select id="meetingtype_code" name="meetingtype_code" {if isset($meetingData)}disabled readonly{/if}>
					{html_options options=$meetingtypeData}
				</select>
				{if isset($errorArray.meetingtype_code)}<br /><span class="error">{$errorArray.meetingtype_code}</span>{/if}
			</td>	
           <td class="error"><h4>With SA-YES staff?</h4></td>
            <td>
				<select id="meeting_staff" name="meeting_staff" {if isset($meetingData)}disabled readonly{/if}>
					<option value="1"> With Staff </option>
					<option value="0"> Without Staff </option>
				</select>	
				{if isset($errorArray.meeting_staff)}<br /><span class="error">{$errorArray.meeting_staff}</span>{/if}				
			</td>			
		  </tr>
           <tr class="met">
            <td class="error"><h4>With partner staff?</h4></td>
			<td>
				<select id="meeting_partner" name="meeting_partner" {if isset($meetingData)}disabled readonly{/if}>
					<option value="1"> Yes </option>
					<option value="0"> No </option>
				</select>	
				{if isset($errorArray.meeting_partner)}<br /><span class="error">{$errorArray.meeting_partner}</span>{/if}					
			</td>	
            <td colspan="2" class="error">
				<h4 {if isset($errorArray.meeting_address)}class="error"{/if}>Where did you meet?</h4><br />
				<textarea id="meeting_address" name="meeting_address" cols="50" rows="2" {if isset($meetingData)}disabled readonly{/if}>{$meetingData.meeting_address}</textarea>
				{if isset($errorArray.meeting_address)}<br /><span class="error">{$errorArray.meeting_address}</span>{/if}		
			</td>			
          </tr>		    
          <tr>
			<td colspan="4"><h4 class="error">Your notes:</h4><br /><textarea name="meeting_notes" id="meeting_notes"  cols="120" rows="7">{$meetingData.meeting_notes}</textarea></td>	
          </tr>	  
        </table>
      </form>
	{if !isset($meetingData)} 
        <div class="mrg_top_10">
          <a href="javascript:submitForm();" class="blue_button mrg_left_20 fl"><span>Save &amp; Complete</span></a>   
        </div>
		{/if}	  
	</div>
    <div class="clearer"><!-- --></div>
    <div class="clearer"><!-- --></div>
    </div><!--inner-->
 </div> 	
<!-- End Content recruiter -->
 {include_php file='includes/footer.php'}
</div>
{literal}
<script type="text/javascript">
$(document).ready(function() {

	$("#meeting_date").datetimepicker({
		dateFormat: 'yy-mm-dd', maxDate: '0'
	});
	
	new nicEditor({
		iconsPath	: '/library/javascript/nicedit/nicEditorIcons.gif',
		buttonList 	: ['bold','italic','underline','left','center', 'ol', 'ul', 'xhtml', 'fontFormat', 'fontFamily', 'fontSize', 'unlink', 'link', 'strikethrough', 'superscript', 'subscript'],
		uploadURI : '/library/javascript/nicedit/nicUpload.php',
	}).panelInstance('meeting_notes');
	
	toggleMeeting();
});

function toggleMeeting() {
	var met;
	
	met = $('#meeting_status').val();
	
	if(met == '0') {
		/* Did not meet. */
		$('.met').hide();
		$('.notmet').show();
	} else {
		/* Met. */
		$('.met').show();
		$('.notmet').hide();
	}
}

function submitForm() {
	if(confirm('Are you sure you want to add this meeting? To edit it you will need to contact the administrators and they would edit it for you.')) {
		nicEditors.findEditor('meeting_notes').saveContent();
		document.forms.detailsForm.submit();					 
	}
}
</script>
{/literal}
<!-- End Main Container -->
</body>
</html>
