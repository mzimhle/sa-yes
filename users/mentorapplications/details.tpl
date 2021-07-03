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
			<li>{if isset($mentorappData)}Edit{else}New{/if} Mentor Application</li>
        </ul>
	</div><!--breadcrumb--> 
	<div class="inner"> 
      <h2>{if isset($mentorappData)}Edit{else}New{/if} Mentor Application</h2>
    <div class="clearer"><!-- --></div>
        <div class="mrg_top_10 fr">
			<a href="#" class="button mrg_left_20 fl"><span>Mentor Details</span></a>   
			{if isset($mentorappData)}
			<a href="/users/mentorapplications/application.php?code={$mentorappData.mentorapp_code}" class="blue_button mrg_left_20 fl"><span>Mentor Application</span></a>
			<a href="/users/mentorapplications/documents.php?code={$mentorappData.mentorapp_code}" class="blue_button mrg_left_20 fl"><span>Mentor Documents</span></a>   
			{/if}
        </div>		
    <div class="clearer"><!-- --></div>
	<br />
	<div class="detail_box" style="width: 1176px !important;">
      <form id="detailsForm" name="detailsForm" action="/users/mentorapplications/details.php{if isset($mentorappData)}?code={$mentorappData.mentorapp_code}{/if}" method="post" enctype="multipart/form-data">
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="form">
		 {if isset($mentorappData)}
			 <tr>
				<td colspan="2">
					<h4>Link to user:</h4><br />
					{if $mentorappData.mentorapp_status eq 'matched'}
					<span id="mentorname" class="success">{$mentorappData.mentorapp_status|upper|default:"N/A"}: {$mentorappData.user_code} - {$mentorappData.user_name} {$mentorappData.user_surname}</span>
					{else}
					<span id="mentorname" class="error">{$mentorappData.mentorapp_status|upper|default:"N/A"}: {$mentorappData.user_code} - {$mentorappData.user_name} {$mentorappData.user_surname}</span>
					{/if}
				</td>
				<td>
					<h4 class="error">Programme:</h4>
					<input type="hidden" name="mentorship_code" id="mentorship_code" value="{$mentorappData.mentorship_code}" />
					<br /><span id="mentorname" class="success">{$mentorappData.mentorship_name}</span>	
					{if isset($errorArray.mentorship_code)}<br /><span class="error">{$errorArray.mentorship_code}</span>{/if}					
				</td>				
			 </tr>
		{else}
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
						{html_options options=$mentoshipData selected=$mentorappData.mentorship_code}
					</select><br />
					 {if isset($errorArray.mentorship_code)}<span class="error">{$errorArray.mentorship_code}</span>{/if}
				</td>
			 </tr>		
		{/if}
		 <tr>
			<td><h4 class="error">Name:</h4><br /><input type="text" name="mentorapp_name" id="mentorapp_name" value="{$mentorappData.mentorapp_name}" size="40"/>{if isset($errorArray.mentorapp_name)}<br /><span class="error">{$errorArray.mentorapp_name}</span>{/if}</td>
			<td><h4 class="error">Surname:</h4><br /><input type="text" name="mentorapp_surname" id="mentorapp_surname" value="{$mentorappData.mentorapp_surname}" size="40"/>{if isset($errorArray.mentorapp_surname)}<br /><span class="error">{$errorArray.mentorapp_surname}</span>{/if}</td>	
			<td><h4 class="error">Email:</h4><br /><input type="text" name="mentorapp_email" id="mentorapp_email" value="{$mentorappData.mentorapp_email}" size="40"/><br />E.g. myname@domain.co.za {if isset($errorArray.mentorapp_email)} - <span class="error">{$errorArray.mentorapp_email}</span>{/if}</td>				
          </tr>	         
		  <tr>
			<td><h4>Cell:</h4><br /><input type="text" name="mentorapp_cell" id="mentorapp_cell" value="{$mentorappData.mentorapp_cell}" size="40"/><br />E.g. 0734897584 {if isset($errorArray.mentorapp_cell)} - <span class="error">{$errorArray.mentorapp_cell}</span>{/if}</td>	
			<td><h4>Telephone:</h4><br /><input type="text" name="mentorapp_telephone" id="mentorapp_telephone" value="{$mentorappData.mentorapp_telephone}" size="40"/><br />E.g. 0214897584 {if isset($errorArray.mentorapp_telephone)} - <span class="error">{$errorArray.mentorapp_telephone}</span>{/if}</td>				
			<td><h4>ID Number:</h4><br /><input type="text" name="mentorapp_idnumber" id="mentorapp_idnumber" value="{$mentorappData.mentorapp_idnumber}" size="20"/>{if isset($errorArray.mentorapp_idnumber)}<br /><span class="error">{$errorArray.mentorapp_idnumber}</span>{/if}</td>					
          </tr>		  	  
          <tr>
			<td><h4>Race:</h4><br />
				<select id="mentorapp_race" name="mentorapp_race">
					<option value=""> ----- </option>
					<option {if $mentorappData.mentorapp_race eq 'African'}selected{/if} value="African"> African </option>
					<option {if $mentorappData.mentorapp_race eq 'Caucasian'}selected{/if} value="Caucasian"> Caucasian </option>
					<option {if $mentorappData.mentorapp_race eq 'Coloured'}selected{/if} value="Coloured"> Coloured </option>
					<option {if $mentorappData.mentorapp_race eq 'Asian'}selected{/if} value="Asian"> Asian </option>
				</select>
			</td>	
			<td><h4>Gender:</h4><br />
				<select id="mentorapp_gender" name="mentorapp_gender">
					<option value=""> ----- </option>
					<option {if $mentorappData.mentorapp_gender eq 'Male'}selected{/if} value="Male"> Male </option>
					<option {if $mentorappData.mentorapp_gender eq 'Female'}selected{/if} value="Female"> Female </option>
				</select>
				{if isset($errorArray.mentorapp_gender)}<br /><span class="error">{$errorArray.mentorapp_gender}</span>{/if}
			</td>	
			<td>
				<h4>Passport</h4>
				<br /><input type="text" name="mentorapp_passport" id="mentorapp_passport" value="{$mentorappData.mentorapp_passport}" size="20"/>
			</td>				
          </tr>
		  <tr>
			<td><h4>Nationality:</h4><br /><input type="text" name="mentorapp_nationality" id="mentorapp_nationality" value="{$mentorappData.mentorapp_nationality}" size="40"/></td>	
			<td><h4>Citizenship:</h4><br /><input type="text" name="mentorapp_citizenship" id="mentorapp_citizenship" value="{$mentorappData.mentorapp_citizenship}" size="40"/></td>				
			<td></td>					
          </tr>		  
		  <tr>
			<td><h4>Accessible area:</h4><br />			
				<input type="text" name="area_name" id="area_name" value="{$mentorappData.area_shortPath}" size="40" />
				<input type="hidden" name="area_code" id="area_code" value="{$mentorappData.area_code}" />
				{if isset($errorArray.area_code)}<br /><span class="error">{$errorArray.area_code}</span>{/if}
				<br /><span class="success selectedarea">{$mentorappData.area_shortPath|default:"N/A"}</span>
			</td>				
			<td><h4>Date of Birth:</h4><br /><input type="text" name="mentorapp_dateofbirth" id="mentorapp_dateofbirth" value="{$mentorappData.mentorapp_dateofbirth}" size="10"/><br />E.g. YYYY-MM-DD {if isset($errorArray.mentorapp_dateofbirth)} - <span class="error">{$errorArray.mentorapp_dateofbirth}</span>{/if}</td>										
			<td>
				<h4>Address:</h4><br /><textarea name="mentorapp_address" id="mentorapp_address"  cols="40" rows="2">{$mentorappData.mentorapp_address}</textarea>
				{if isset($errorArray.mentorapp_address)}<br /><span class="error">{$errorArray.mentorapp_address}</span>{/if}
			</td>												
		  </tr>
          <tr>
			<td valign="top">
				<h4 {if isset($errorArray.user_image)}class="error"{/if} >User Image:</h4> Images to upload: gif, png, jpg and jpeg<br /><br />
				<input type="file" id="user_image" name="user_image" />
				{if isset($errorArray.user_image)}<br /><br /><span class="error">{$errorArray.user_image}</span>{/if}
			</td>
			<td valign="top" >
				{if !isset($mentorappData)}
					<img src="/media/user/avatar.jpg" />
				{else}
					{if $mentorappData.user_image_path eq ''}
						<img src="/media/user/avatar.jpg" />
					{else}
						<img src="{$mentorappData.user_image_path}tmb_{$mentorappData.user_image_name}{$mentorappData.user_image_ext}" />
					{/if}
				{/if}
			</td>
			<td><h4>Where did you hear about SA-YES:</h4><br /><textarea name="mentorapp_heardofus" id="mentorapp_heardofus"  cols="40" rows="2">{$mentorappData.mentorapp_heardofus}</textarea></td>	
          </tr>	          
		  <tr>
			<td colspan="3"><h4>Notes:</h4><br /><textarea name="mentorapp_notes" id="mentorapp_notes"  cols="100" rows="20">{$mentorappData.mentorapp_notes}</textarea></td>			
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
	
	$("input").keypress(function(event) {
		if (event.which == 13) {
			event.preventDefault();
			document.forms.detailsForm.submit();	
		}
	});	
	
	$( "#mentorapp_dateofbirth" ).datepicker({ dateFormat: 'yy-mm-dd', changeYear: true});
	
	$( "#mentorapp_exitDate" ).datepicker({ dateFormat: 'yy-mm-dd', changeYear: true});
	
	$( "#area_name" ).autocomplete({
		source: "/feeds/area.php",
		minLength: 2,
		select: function( event, ui ) {
		
			if(ui.item.id == '') {
				$('#area_name').html('');
				$('#area_code').val('');			
				$('.selectedarea').html('N/A');				
			} else {
				$('#area_name').html('<b>' + ui.item.value + '</b>');
				$('.selectedarea').html('<b>' + ui.item.value + '</b>');
				$('#area_code').val(ui.item.id);	
			}
			$('#area_name').val('');										
		}
	});
	
	/* Search for mentors. */
	$( "#mentorsearch").autocomplete({
		source: "/feeds/mentors.php",
		minLength: 2,
		select: function( event, ui ) {
		
			if(ui.item.id == '') {
				$('#mentorname').html('');
				$('#mentorcode').val('');					
			} else { 
				$('#mentorname').html('<b>' + ui.item.value + '</b>');
				$('#mentorcode').val(ui.item.id);	
				populatementor(ui.item.id);
			}				
			$('#mentorsearch').val('');										
		}
	});	
	
	new nicEditor({
		iconsPath	: '/library/javascript/nicedit/nicEditorIcons.gif',
		buttonList 	: ['bold','italic','underline','left','center', 'ol', 'ul', 'xhtml', 'fontFormat', 'fontFamily', 'fontSize', 'unlink', 'link', 'strikethrough', 'superscript', 'subscript'],
		uploadURI : '/library/javascript/nicedit/nicUpload.php',
	}).panelInstance('mentorapp_notes');		
	
});

function clearbox() {

	$('#mentorname').html('');
	$('#mentorcode').val('');
	$('#mentorsearch').val('');
	
	return false;
}

function clearall() {

	$('#mentorname').html('');
	$('#mentorcode').val('');
	$('#mentorsearch').val('');
	$('#mentorapp_name').val('');
	$('#mentorapp_surname').val('');
	$('#mentorapp_email').val('');
	$('#mentorapp_cell').val('');
	$('#mentorapp_telephone').val('');
	$('#mentorapp_idnumber').val('');
	$('#mentorapp_dateofbirth').val('');
	$('#area_code').val('');
	$('#area_name').val('');	
	$('#mentorapp_notes').val('');
	$('#mentorapp_heardofus').val('');
	$('#mentorapp_address').val('');
	$('#mentorapp_address').val('');
	$('[name=mentorapp_gender]').val('');
	$('[name=partner_code]').val('');
	$('[name=mentorapp_race]').val('');	
	
	return false;
}


function populatementor(id) {
	$.post("?action=getmentor", {
			usercode		: id
		},
		function(data) {
			if(data.result) {
			
				var item = data.records;
				{/literal}{if !isset($mentorappData)}{literal}
				$('#mentorapp_name').val(item.user_name);
				$('#mentorapp_surname').val(item.user_surname);
				$('#mentorapp_email').val(item.user_email);
				$('#mentorapp_cell').val(item.user_cell);
				$('#mentorapp_telephone').val(item.user_telephone);
				$('#mentorapp_idnumber').val(item.user_idnumber);
				$('#mentorapp_dateofbirth').val(item.user_dateofbirth);				
				$('#area_code').val(item.area_code);
				$('#area_name').val(item.area_shortPath);
				$('#mentorapp_address').val(item.user_address);
				$('#mentorapp_notes').val(item.user_notes);
				$('[name=mentorapp_gender]').val(item.user_gender);
				$('[name=partner_code]').val(item.partner_code);
				$('[name=mentorapp_race]').val(item.user_race);
				{/literal}{/if}{literal}
			} else {
			
				clearall();		
				return false;
			}
		},
		'json'
	);
}

function submitForm() {
	nicEditors.findEditor('mentorapp_notes').saveContent();
	document.forms.detailsForm.submit();					 
}
</script>
{/literal}
<!-- End Main Container -->
</body>
</html>
