<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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
			<li><a href="/users/partners/" title="">Partners</a></li>
			<li><a href="/users/partners/view/" title="">View</a></li>
			<li><a href="/users/partners/view/details.php?code={$partnerData.partner_code}" title="">{$partnerData.partner_name}</a></li>
			<li>Contact details</li>
        </ul>
	</div><!--breadcrumb-->   
	<div class="inner">     
	{foreach from=$contactData item=item name=contactData}
	<div class="clearer"><!-- --></div><br />
	<h2>{$smarty.foreach.contactData.iteration}. Update/Delete {$item.area_name} contact</h2>
	<div class="detail_box" style="width: 907px !important;">	
	<form id="updateForm" name="updateForm" action="/users/partners/view/contact.php?code={$partnerData.partner_code}" method="post"  enctype="multipart/form-data">		        
		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="form"> 
          <tr>
            <td class="left_col">Contact Full Name:</td>
			<td><input type="text" name="partnercontact_fullname_{$item.partnercontact_code}" id="partnercontact_fullname_{$item.partnercontact_code}" value="{$item.partnercontact_fullname}" size="40" /></td>	
            <td class="left_col">Position:</td>
			<td><input type="text" name="partnercontact_position_{$item.partnercontact_code}" id="partnercontact_position_{$item.partnercontact_code}" value="{$item.partnercontact_position}" size="40" /></td>				
          </tr>
          <tr>
            <td class="left_col">Email:</td>
			<td><input type="text" name="partnercontact_email_{$item.partnercontact_code}" id="partnercontact_email_{$item.partnercontact_code}" value="{$item.partnercontact_email}" size="40" /></td>	
            <td class="left_col">Cell:</td>
			<td><input type="text" name="partnercontact_cell_{$item.partnercontact_code}" id="partnercontact_cell_{$item.partnercontact_code}" value="{$item.partnercontact_cell}" size="40" /></td>				
          </tr> 
          <tr>
            <td class="left_col">Telephone:</td>
			<td><input type="text" name="partnercontact_telephone_{$item.partnercontact_code}" id="partnercontact_telephone_{$item.partnercontact_code}" value="{$item.partnercontact_telephone}" size="40" /></td>	
            <td class="left_col">Address:</td>
			<td><textarea name="partnercontact_address_{$item.partnercontact_code}" id="partnercontact_address_{$item.partnercontact_code}" cols="30" rows="3">{$item.partnercontact_address}</textarea></td>				
          </tr> 		  
        </table>		
	</form>
	<div class="clearer"><!-- --></div>
		<div class="mrg_top_10">
			<a href="javascript:deleteForm('{$item.partnercontact_code}');void(0);" class="button blue_button mrg_left_147 fl"><span>Delete</span></a>
			<a href="javascript:updateForm('{$item.partnercontact_code}');void(0);" class="blue_button mrg_left_20 fl"><span>Update</span></a>   
		</div>
	<div class="clearer"><!-- --></div>	
	</div>	
	{/foreach}
	<div class="clearer"><!-- --></div>
	<br /><br /><br /><br />
		<br /><h2>Add New Contact</h2>
	<div class="detail_box" style="width: 907px !important;">
      <form id="detailsForm" name="detailsForm" action="/users/partners/view/contact.php?code={$partnerData.partner_code}" method="post"  enctype="multipart/form-data">				
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="form"> 
          <tr>
            <td class="left_col" style="color: red">Contact Full Name:</td>
			<td><input type="text" name="partnercontact_fullname" id="partnercontact_fullname" value="" size="40" />
			{if isset($errorArray.partnercontact_fullname)}<span style="color: red">{$errorArray.partnercontact_fullname}</span>{/if}</td>	
            <td class="left_col" style="color: red">Position:</td>
			<td><input type="text" name="partnercontact_position" id="partnercontact_position" value="" size="40" />
			{if isset($errorArray.partnercontact_position)}<span style="color: red">{$errorArray.partnercontact_position}</span>{/if}
			</td>				
          </tr>
          <tr>
            <td class="left_col" style="color: red">Email:</td>
			<td><input type="text" name="partnercontact_email" id="partnercontact_email" value="" size="40" />
			{if isset($errorArray.partnercontact_email)}<span style="color: red">{$errorArray.partnercontact_email}</span>{/if}
			</td>	
            <td class="left_col" {if isset($errorArray.partnercontact_cell)}style="color: red"{/if}>Cell:</td>
			<td><input type="text" name="partnercontact_cell" id="partnercontact_cell" value="" size="40" /></td>				
          </tr> 
          <tr>
            <td class="left_col" {if isset($errorArray.partnercontact_telephone)}style="color: red"{/if}>Telephone:</td>
			<td><input type="text" name="partnercontact_telephone" id="partnercontact_telephone" value="" size="40" /></td>	
            <td class="left_col" {if isset($errorArray.partnercontact_address)}style="color: red"{/if}>Address:</td>
			<td><textarea name="partnercontact_address" id="partnercontact_address" cols="30" rows="3"></textarea></td>				
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
<!-- End Content recruiter -->
 </div><!-- End Content recruiter -->
 {include_php file='includes/footer.php'}
</div>
{literal}
<script type="text/javascript" language="javascript">
function submitForm() {
	document.forms.detailsForm.submit();					 
}

function updateForm(id) {					
	if(confirm('Are you sure you want to update this item ?')) {
		$.ajax({ 
				type: "GET",
				url: "contact.php",
				data: "code={/literal}{$partnerData.partner_code}{literal}&code_update="+id+"&partnercontact_fullname="+$('#partnercontact_fullname_'+id).val()+"&partnercontact_position="+$('#partnercontact_position_'+id).val()+"&partnercontact_email="+$('#partnercontact_email_'+id).val()+"&partnercontact_cell="+$('#partnercontact_cell_'+id).val()+"&partnercontact_telephone="+$('#partnercontact_telephone_'+id).val()+"&partnercontact_address="+$('#partnercontact_address_'+id).val(),
				dataType: "json",
				success: function(data){
						if(data.result == 1) {
							alert('Updated');
							window.location.href = window.location.href;
						} else {
							alert(data.error);
						}
				}
		});							
	}
	
	return false;
	
}	

function deleteForm(id) {	
	if(confirm('Are you sure you want to delete this item?')) {

			$.ajax({ 
					type: "GET",
					url: "contact.php",
					data: "code={/literal}{$partnerData.partner_code}{literal}&code_delete="+id,
					dataType: "json",
					success: function(data){
							if(data.result == 1) {
								alert('Deleted');
								window.location.href = window.location.href;
							} else {
								alert(data.error);
							}
					}
			});								
		}
		return false;
}		
</script>
{/literal}
<!-- End Main Container -->
</body>
</html>
