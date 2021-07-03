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
			<li><a href="/users/admins/" title="">View</a></li>
			<li>{if isset($tempData.user_code)}Edit Admin{else}Add new admin{/if}</li>
        </ul>
	</div><!--breadcrumb--> 
  
	<div class="inner"> 
      <h2>View/Edit Admin</h2>
    <div id="sidetabs">
        <ul > 
            <li class="active"><a href="#" title="Details">Details</a></li>
        </ul>
    </div><!--tabs-->
	<div class="detail_box" style="width: 1020px;">
      <form id="detailsForm" name="detailsForm" action="/users/admins/details.php{if isset($tempData.user_code)}?code={$tempData.user_code}{/if}" method="post"  enctype="multipart/form-data">
        <table width="1003" border="0" align="center" cellpadding="0" cellspacing="0" class="form">		  
		 <tr>
            <td class="left_col" {if isset($errorArray.user_name)}style="color: red"{/if}><h4>Name:</h4></td>
			<td><input type="text" name="user_name" id="user_name" value="{$tempData.user_name}" size="25"/></td>
            <td class="left_col" {if isset($errorArray.user_surname)}style="color: red"{/if}><h4>Surname:</h4></td>
			<td><input type="text" name="user_surname" id="user_surname" value="{$tempData.user_surname}" size="25"/></td>			
          </tr>	
          <tr>
            <td class="left_col" {if isset($errorArray.user_idnumber)}style="color: red"{/if}><h4>ID Number:</h4></td>
			<td><input type="text" name="user_idnumber" id="user_idnumber" value="{$tempData.user_idnumber}" size="25"/><br />{if isset($errorArray.user_idnumber)} - <span style="color: red">{$errorArray.user_idnumber}</span>{/if}</td>
            <td class="left_col" {if isset($errorArray.user_dateofbirth)}style="color: red"{/if}><h4>Date of Birth:</h4></td>
			<td><input type="text" name="user_dateofbirth" id="user_dateofbirth" value="{$tempData.user_dateofbirth}" size="10"/></td>				
          </tr>	  
          <tr>
            <td class="left_col" {if isset($errorArray.user_race)}style="color: red"{/if}><h4>Race:</h4></td>
			<td>
				<select id="user_race" name="user_race">
					<option value=""> ----- </option>
					<option {if $tempData.user_race eq 'African'}selected{/if} value="African"> African </option>
					<option {if $tempData.user_race eq 'Caucasian'}selected{/if} value="Caucasian"> Caucasian </option>
					<option {if $tempData.user_race eq 'Coloured'}selected{/if} value="Coloured"> Coloured </option>
					<option {if $tempData.user_race eq 'Asian'}selected{/if} value="Asian"> Asian </option>
				</select>
			</td>
            <td class="left_col" {if isset($errorArray.area_code)}style="color: red"{/if}><h4>Area:</h4></td>
			<td>			
				<input type="text" name="area_name" id="area_name" value="{$tempData.area_path}" size="25" />
				<input type="hidden" name="area_code" id="area_code" value="{$tempData.area_code}" />
			</td>			
          </tr>		  
          <tr>
            <td class="left_col" {if isset($errorArray.user_email)}style="color: red"{/if}><h4>Email:</h4></td>
			<td><input type="text" name="user_email" id="user_email" value="{$tempData.user_email}" size="25"/> {if isset($errorArray.user_email)}<span style="color: red">{$errorArray.user_email}</span>{/if}</td>
            <td class="left_col" {if isset($errorArray.user_cell)}style="color: red"{/if}><h4>Cell:</h4></td>
			<td><input type="text" name="user_cell" id="user_cell" value="{$tempData.user_cell}" size="25"/><br />E.g. 0734897584 {if isset($errorArray.user_cell)} - <span style="color: red">{$errorArray.user_cell}</span>{/if}</td>			
          </tr>	
          <tr>
            <td class="left_col" {if isset($errorArray.user_telephone)}style="color: red"{/if}><h4>Telephone:</h4></td>
			<td><input type="text" name="user_telephone" id="user_telephone" value="{$tempData.user_telephone}" size="25"/><br />E.g. 0215874698 {if isset($errorArray.user_telephone)} - <span style="color: red">{$errorArray.user_telephone}</span>{/if}</td>
			<td class="left_col" {if isset($errorArray.user_image)}style="color: red"{/if}>
				<h4>Image:</h4>
				<input type="file" id="user_image" name="user_image" />
				{if isset($errorArray.user_image)}<br /><br /><span class="error">{$errorArray.user_image}</span>{/if}			
			</td>			
			<td valign="top">
				{if !isset($tempData)}
					<img src="/media/user/avatar.jpg" />
				{else}
					{if $tempData.user_image_path eq ''}
						<img src="/media/user/avatar.jpg" />
					{else}
						<img src="{$tempData.user_image_path}tmb_{$tempData.user_image_name}{$tempData.user_image_ext}" />
					{/if}
				{/if}
			</td>
          </tr>	
          <tr>            
			<td colspan="4">
				<h4 {if isset($errorArray.user_notes)}style="color: red"{/if}>Notes:</h4><br />
				<textarea name="user_notes" id="user_notes"  cols="70" rows="10">{$tempData.user_notes}</textarea>
			</td>
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
 </div><!-- End Content recruiter -->
 {include_php file='includes/footer.php'}
</div>
{literal}
<script type="text/javascript">
$(document).ready(function() {	
	
	$( "#user_dateofbirth" ).datepicker({ dateFormat: 'yy-mm-dd', changeYear: true});
	
	$( "#area_name" ).autocomplete({
		source: "/feeds/area.php",
		minLength: 2,
		select: function( event, ui ) {
		
			if(ui.item.id == '') {
				$('#area_name').html('');
				$('#area_code').val('');					
			} else {
				$('#area_name').html('<b>' + ui.item.value + '</b>');
				$('#area_code').val(ui.item.id);	
			}
			$('#area_name').val('');										
		}
	});
		
	new nicEditor({
		iconsPath	: '/library/javascript/nicedit/nicEditorIcons.gif',
		buttonList 	: ['bold','italic','underline','left','center', 'ol', 'ul', 'xhtml', 'fontFormat', 'fontFamily', 'fontSize', 'unlink', 'link', 'strikethrough', 'superscript', 'subscript'],
		uploadURI : '/library/javascript/nicedit/nicUpload.php',
	}).panelInstance('user_notes');		
	
});

function submitForm() {
	nicEditors.findEditor('user_notes').saveContent();
	document.forms.detailsForm.submit();					 
}
</script>
{/literal}
<!-- End Main Container -->
</body>
</html>
