<!DOCTYPE html PUBLIC "-/W3C/DTD XHTML 1.0 Transitional/EN" "http:/www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http:/www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sa-Yes | Account</title>
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
			<li><a href="/account/" title="">Account</a></li>
        </ul>
	</div><!--breadcrumb--> 
  
	<div class="inner"> 
      <h2>View/Edit User</h2>
    <div id="sidetabs">
        <ul > 
            <li class="active"><a href="#" title="Details">Details</a></li>
        </ul>
    </div><!--tabs-->
	<div class="detail_box">
      <form id="detailsForm" name="detailsForm" action="/account/" method="post">
        <table width="700" border="0" align="center" cellpadding="0" cellspacing="0" class="form">
          <tr>
            <td class="left_col{if isset($errorArray.usertype_code)} error{/if}"><h4>User Type:</h4></td>
			<td>{$userData.usertype_name}</td>
          </tr>	  
		 <tr>
            <td class="left_col{if isset($errorArray.user_name)} error{/if}"><h4>Name:</h4></td>
			<td><input type="text" name="user_name" id="user_name" value="{$userData.user_name}" size="60"/></td>
          </tr>	
          <tr>
            <td class="left_col{if isset($errorArray.user_surname)} error{/if}"><h4>Surname:</h4></td>
			<td><input type="text" name="user_surname" id="user_surname" value="{$userData.user_surname}" size="60"/></td>
          </tr>
          <tr>
            <td class="left_col{if isset($errorArray.user_idnumber)} error{/if}"><h4>ID Number:</h4></td>
			<td><input type="text" name="user_idnumber" id="user_idnumber" value="{$userData.user_idnumber}" size="60"/><br />E.g. 8610285815088 {if isset($errorArray.user_idnumber)} - <span style="color: red">{$errorArray.user_idnumber}</span>{/if}</td>
          </tr>
		  <tr>
            <td class="left_col{if isset($errorArray.user_dateofbirth)} error{/if}"><h4>Date of Birth:</h4></td>
			<td><input type="text" name="user_dateofbirth" id="user_dateofbirth" value="{$userData.user_dateofbirth}" size="10"/></td>	
          </tr>		  
          <tr>
            <td class="left_col{if isset($errorArray.user_race)} error{/if}"><h4>Race:</h4></td>
			<td>
				<select id="user_race" name="user_race">
					<option value=""> ----- </option>
					<option {if $userData.user_race eq 'African'}selected{/if} value="African"> African </option>
					<option {if $userData.user_race eq 'Caucasian'}selected{/if} value="Caucasian"> Caucasian </option>
					<option {if $userData.user_race eq 'Coloured'}selected{/if} value="Coloured"> Coloured </option>
					<option {if $userData.user_race eq 'Asian'}selected{/if} value="Asian"> Asian </option>
				</select>
			</td>
          </tr>
          <tr>
            <td class="left_col{if isset($errorArray.area_code)} error{/if}"><h4>Area:</h4></td>
			<td colspan="3">			
				<input type="text" name="area_name" id="area_name" value="{$userData.area_path}" size="60" />
				<input type="hidden" name="area_code" id="area_code" value="{$userData.area_code}" />
			</td>				
          </tr> 		  
          <tr>
            <td class="left_col{if isset($errorArray.user_email)} error{/if}"><h4>Email:</h4></td>
			<td><input type="text" name="user_email" id="user_email" value="{$userData.user_email}" size="60"/><br /> {if isset($errorArray.user_email)}<span style="color: red">{$errorArray.user_email}</span>{/if}</td>
          </tr>
          <tr>
            <td class="left_col{if isset($errorArray.user_password)} error{/if}"><h4>Password:</h4></td>
			<td><input type="password" name="user_password" id="user_password" value="{$userData.user_decoded}" size="60"/><br /> {if isset($errorArray.user_password)}<span style="color: red">{$errorArray.user_password}</span>{/if}</td>
          </tr>
          <tr>
            <td class="left_col{if isset($errorArray.user_password2)} error{/if}"><h4>Retype Password:</h4></td>
			<td><input type="password" name="user_password2" id="user_password2" value="{$userData.user_decoded}" size="60"/><br /> {if isset($errorArray.user_password2)}<span style="color: red">{$errorArray.user_password2}</span>{/if}</td>
          </tr>			  
          <tr>
            <td class="left_col{if isset($errorArray.user_cell)} error{/if}"><h4>Cell:</h4></td>
			<td><input type="text" name="user_cell" id="user_cell" value="{$userData.user_cell}" size="60"/><br />E.g. 0734897584 {if isset($errorArray.user_cell)} - <span style="color: red">{$errorArray.user_cell}</span>{/if}</td>
          </tr>		  
          <tr>
            <td class="left_col{if isset($errorArray.user_telephone)} error{/if}"><h4>Telephone:</h4></td>
			<td><input type="text" name="user_telephone" id="user_telephone" value="{$userData.user_telephone}" size="60"/><br />E.g. 0215874698 {if isset($errorArray.user_telephone)} - <span style="color: red">{$errorArray.user_telephone}</span>{/if}</td>
          </tr>
          <tr>
            <td class="left_col{if isset($errorArray.user_admin_colour)} error{/if}"><h4>My Colour:</h4></td>
			<td><input type="text" name="user_admin_colour" id="user_admin_colour" value="{$userData.user_admin_colour}" size="60"/><br />E.g. red {if isset($errorArray.user_admin_colour)} - <span style="color: red">{$errorArray.user_admin_colour}</span>{/if}</td>
          </tr>		  
          <tr>
            <td class="left_col{if isset($errorArray.user_notes)} error{/if}" valign="top"><h4>Notes:</h4></td>
			<td><textarea name="user_notes" id="user_notes"  cols="70" rows="20">{$userData.user_notes}</textarea></td>
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
