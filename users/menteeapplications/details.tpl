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
			<li>{if isset($menteeappData)}Edit{else}New{/if} Mentee Application</li>
        </ul>
	</div><!--breadcrumb--> 
	<div class="inner"> 
      <h2>{if isset($menteeappData)}Edit{else}New{/if} Mentee Application</h2>
    <div class="clearer"><!-- --></div>
        <div class="mrg_top_10 fr">
          <a href="#" class="button mrg_left_20 fl"><span>Mentee Details</span></a>   
		{if isset($menteeappData)}
		  <a href="/users/menteeapplications/application.php?code={$menteeappData.menteeapp_code}" class="blue_button mrg_left_20 fl"><span>Mentee Application</span></a>   
		  <a href="/users/menteeapplications/documents.php?code={$menteeappData.menteeapp_code}" class="blue_button mrg_left_20 fl"><span>Mentee Documents</span></a>   
		  {/if}
        </div>		
    <div class="clearer"><!-- --></div>
	<br />
	<div class="detail_box" style="width: 1176px !important;">
      <form id="detailsForm" name="detailsForm" action="/users/menteeapplications/details.php{if isset($menteeappData)}?code={$menteeappData.menteeapp_code}{/if}" method="post"  enctype="multipart/form-data">
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="form">
		 {if isset($menteeappData)}
			 <tr>
				<td colspan="2">
					<h4>Link to user:</h4><br />
					{if $menteeappData.menteeapp_status eq 'matched'}
					<span id="menteename" class="success">{$menteeappData.menteeapp_status|upper}: {$menteeappData.user_code} - {$menteeappData.user_name} {$menteeappData.user_surname}</span>
					{else}
					<span id="menteename" class="error">{$menteeappData.menteeapp_status|upper}: {$menteeappData.user_code} - {$menteeappData.user_name} {$menteeappData.user_surname}</span>
					{/if}
				</td>
				<td>
					<h4 class="error">Programme:</h4>
					<input type="hidden" name="mentorship_code" id="mentorship_code" value="{$menteeappData.mentorship_code}" />
					<br /><span id="menteename" class="success">{$menteeappData.mentorship_name}</span>					
					{if isset($errorArray.mentorship_code)}<span class="error">{$errorArray.mentorship_code}</span>{/if}
				</td>				
			 </tr>
		{else}
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
						{html_options options=$mentoshipData selected=$menteeappData.mentorship_code}
					</select>
					 {if isset($errorArray.mentorship_code)}<br /><span class="error">{$errorArray.mentorship_code}</span>{/if}
				</td>
			 </tr>		
		{/if}
		 <tr>
			<td><h4 class="error">Name:</h4><br /><input type="text" name="menteeapp_name" id="menteeapp_name" value="{$menteeappData.menteeapp_name}" size="40"/>{if isset($errorArray.menteeapp_name)}<br /><span class="error">{$errorArray.menteeapp_name}</span>{/if}</td>
			<td><h4 class="error">Surname:</h4><br /><input type="text" name="menteeapp_surname" id="menteeapp_surname" value="{$menteeappData.menteeapp_surname}" size="40"/>{if isset($errorArray.menteeapp_surname)}<br /><span class="error">{$errorArray.menteeapp_surname}</span>{/if}</td>	
			<td><h4>Email:</h4><br /><input type="text" name="menteeapp_email" id="menteeapp_email" value="{$menteeappData.menteeapp_email}" size="40"/><br />E.g. myname@domain.co.za {if isset($errorArray.menteeapp_email)} - <span class="error">{$errorArray.menteeapp_email}</span>{/if}</td>				
          </tr>	         
		  <tr>
			<td><h4>Cell/Number:</h4><br /><input type="text" name="menteeapp_number" id="menteeapp_number" value="{$menteeappData.menteeapp_number}" size="40"/><br />E.g. 0734897584 {if isset($errorArray.menteeapp_number)} - <span class="error">{$errorArray.menteeapp_number}</span>{/if}</td>	
			<td><h4>ID Number:</h4><br /><input type="text" name="menteeapp_idnumber" id="menteeapp_idnumber" value="{$menteeappData.menteeapp_idnumber}" size="20"/><br />E.g. 8610285815088 {if isset($errorArray.menteeapp_idnumber)} - <span class="error">{$errorArray.menteeapp_idnumber}</span>{/if}</td>		
			<td>
				<h4>Date of Birth:</h4><br /><input type="text" name="menteeapp_dateofbirth" id="menteeapp_dateofbirth" value="{$menteeappData.menteeapp_dateofbirth}" size="10"/><br />E.g. YYYY-MM-DD {if isset($errorArray.menteeapp_dateofbirth)} - <span class="error">{$errorArray.menteeapp_dateofbirth}</span>{/if}</td>				
          </tr>		  	  
          <tr>
			<td><h4>Race:</h4><br />
				<select id="menteeapp_race" name="menteeapp_race">
					<option value=""> ----- </option>
					<option {if $menteeappData.menteeapp_race eq 'African'}selected{/if} value="African"> African </option>
					<option {if $menteeappData.menteeapp_race eq 'Caucasian'}selected{/if} value="Caucasian"> Caucasian </option>
					<option {if $menteeappData.menteeapp_race eq 'Coloured'}selected{/if} value="Coloured"> Coloured </option>
					<option {if $menteeappData.menteeapp_race eq 'Asian'}selected{/if} value="Asian"> Asian </option>
				</select>
			</td>	
			<td><h4 class="error">Gender:</h4><br />
				<select id="menteeapp_gender" name="menteeapp_gender"> 
					<option value=""> ----- </option>
					<option {if $menteeappData.menteeapp_gender eq 'Male'}selected{/if} value="Male"> Male </option>
					<option {if $menteeappData.menteeapp_gender eq 'Female'}selected{/if} value="Female"> Female </option>
				</select>
				{if isset($errorArray.menteeapp_gender)}<br /><span class="error">{$errorArray.menteeapp_gender}</span>{/if}
			</td>	
			<td>
				<h4 class="error">Address:</h4><br /><textarea name="menteeapp_address" id="menteeapp_address"  cols="40" rows="2">{$menteeappData.menteeapp_address}</textarea>
				{if isset($errorArray.menteeapp_address)}<br /><span class="error">{$errorArray.menteeapp_address}</span>{/if}
			</td>				
          </tr>
		  <tr>
			<td><h4 class="error">Accessible area:</h4><br />			
				<input type="text" name="area_name" id="area_name" value="{$menteeappData.area_shortPath}" size="40" />
				<input type="hidden" name="area_code" id="area_code" value="{$menteeappData.area_code}" />
				{if isset($errorArray.area_code)}<br /><span class="error">{$errorArray.area_code}</span>{/if}
				<br /><span class="success selectedarea">{$menteeappData.area_shortPath|default:"N/A"}</span>
			</td>	
			<td><h4 class="error">Partner:</h4><br />
				<select id="partner_code" name="partner_code">
					<option value=""> ----- </option>
					{html_options options=$partnerData selected=$menteeappData.partner_code}
				</select>
				{if isset($errorArray.partner_code)}<br /><span class="error">{$errorArray.partner_code}</span>{/if}
				{if !isset($partnerData)}<br /><a href="/users/partners/view/details.php">Click here to add a partner</a>{/if}
			</td>			
			<td>
				<h4>Expected Exit Date:</h4>
				<br /><input type="text" name="menteeapp_exitDate" id="menteeapp_exitDate" value="{$menteeappData.menteeapp_exitDate}" size="10"/>
				{if isset($errorArray.menteeapp_exitDate)}<br /><span class="error">{$errorArray.menteeapp_exitDate}</span>{/if}
			</td>						
		  </tr>
          <tr>
			<td valign="top">
				<h4>User Image:</h4> Images to upload: gif, png, jpg and jpeg<br /><br />
				<input type="file" id="user_image" name="user_image" />
				{if isset($errorArray.user_image)}<br /><br /><span class="error">{$errorArray.user_image}</span>{/if}
			</td>
			<td valign="top">
				{if !isset($menteeappData)}
					<img src="/media/user/avatar.jpg" />
				{else}
					{if $menteeappData.user_image_path eq ''}
						<img src="/media/user/avatar.jpg" />
					{else}
						<img src="{$menteeappData.user_image_path}tmb_{$menteeappData.user_image_name}{$menteeappData.user_image_ext}" />
					{/if}
				{/if}
			</td>
			<td valign="top"><h4>Where did you hear about SA-YES:</h4><br /><textarea name="menteeapp_heardofus" id="menteeapp_heardofus"  cols="40" rows="2">{$menteeappData.menteeapp_heardofus}</textarea></td>	
          </tr>	
          <tr>
			<td colspan="2"><h4>Notes:</h4><br /><textarea name="menteeapp_notes" id="menteeapp_notes"  cols="100" rows="20">{$menteeappData.menteeapp_notes}</textarea></td>
			<td valign="top"><h4>Mentee has kids?:</h4><br /><input type="checkbox" name="menteeapp_children" id="menteeapp_children" value="1"  {if $menteeappData.menteeapp_children eq '1'}checked{/if} /><br /></td>		
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
	
	$( "#menteeapp_dateofbirth" ).datepicker({ dateFormat: 'yy-mm-dd', changeYear: true});
	
	$( "#menteeapp_exitDate" ).datepicker({ dateFormat: 'yy-mm-dd', changeYear: true});
	
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
	
	/* Search for mentees. */
	$( "#menteesearch").autocomplete({
		source: "/feeds/mentees.php",
		minLength: 2,
		select: function( event, ui ) {
		
			if(ui.item.id == '') {
				$('#menteename').html('');
				$('#menteecode').val('');					
			} else { 
				$('#menteename').html('<b>' + ui.item.value + '</b>');
				$('#menteecode').val(ui.item.id);	
				populatementee(ui.item.id);
			}				
			$('#menteesearch').val('');										
		}
	});	
	
	new nicEditor({
		iconsPath	: '/library/javascript/nicedit/nicEditorIcons.gif',
		buttonList 	: ['bold','italic','underline','left','center', 'ol', 'ul', 'xhtml', 'fontFormat', 'fontFamily', 'fontSize', 'unlink', 'link', 'strikethrough', 'superscript', 'subscript'],
		uploadURI : '/library/javascript/nicedit/nicUpload.php',
	}).panelInstance('menteeapp_notes');		
	
	$("input").keypress(function(event) {
		if (event.which == 13) {
			event.preventDefault();
			document.forms.detailsForm.submit();			
		}
	});	
	
});

function clearbox() {

	$('#menteename').html('');
	$('#menteecode').val('');
	$('#menteesearch').val('');

	return false;
}


function clearall() {

	$('#menteename').html('');
	$('#menteecode').val('');
	$('#menteesearch').val('');
	$('#menteeapp_name').val('');
	$('#menteeapp_surname').val('');
	$('#menteeapp_email').val('');
	$('#menteeapp_number').val('');
	$('#menteeapp_idnumber').val('');
	$('#menteeapp_dateofbirth').val('');
	$('[name=menteeapp_race]').val('');	
	$('#menteeapp_gender').val('');
	$('#area_code').val('');
	$('#area_name').val('');
	$('[name=partner_code]').val('');	
	$('#menteeapp_notes').val('');
	$('#menteeapp_heardofus').val('');
	$('#menteeapp_address').val('');
	$('#menteeapp_exitDate').val('');
	
	return false;
}


function populatementee(id) {
	$.post("?action=getmentee", {
			usercode		: id
		},
		function(data) {
			if(data.result) {
			
				var item = data.records;
				{/literal}{if !isset($menteeappData)}{literal}
				$('#menteeapp_name').val(item.user_name);
				$('#menteeapp_surname').val(item.user_surname);
				$('#menteeapp_email').val(item.user_email);
				$('#menteeapp_number').val(item.user_cell);
				$('#menteeapp_idnumber').val(item.user_idnumber);
				$('#menteeapp_dateofbirth').val(item.user_dateofbirth);
				$('[name=menteeapp_race]').val(item.user_race);	
				$('#menteeapp_gender').val(item.user_race);
				$('#area_code').val(item.area_code);
				$('#area_name').val(item.area_shortPath);
				$('[name=partner_code]').val(item.partner_code);
				{/literal}{/if}{literal}
			} else {
			
				clear();		
				return false;
			}
		},
		'json'
	);
}

function submitForm() {
	nicEditors.findEditor('menteeapp_notes').saveContent();
	document.forms.detailsForm.submit();					 
}
</script>
{/literal}
<!-- End Main Container -->
</body>
</html>
