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
			<li>{if isset($partnerData)}Edit partner{else}Add a new partner{/if}</li>
        </ul>
	</div><!--breadcrumb--> 
  
	<div class="inner"> 
      <h2>{if isset($partnerData)}Edit partner{else}Add a new partner{/if}</h2>
    <div id="sidetabs">
        <ul > 
            <li class="active"><a href="#" title="Details">Details</a></li>
			<li><a href="{if isset($partnerData)}/users/partners/view/contact.php?code={$partnerData.partner_code}{else}#{/if}" title="Contact">Contact</a></li>
        </ul>
    </div><!--tabs-->

	<div class="detail_box">
      <form id="detailsForm" name="detailsForm" action="/users/partners/view/details.php{if isset($partnerData)}?code={$partnerData.partner_code}{/if}" method="post">
        <table width="700" border="0" align="center" cellpadding="0" cellspacing="0" class="form">
          <tr>
            <td class="left_col error" ><h4>Partner Type:</h4></td>
			<td>
				<select id="partnertype_code" name="partnertype_code">
					<option value=""> ----- </option>
					{html_options options=$partnertypeData selected=$partnerData.partnertype_code}
				</select>
				{if isset($errorArray.partnertype_code)}<br /><span class="error">{$errorArray.partnertype_code}</span>{/if}
			</td>
          </tr>		
		<tr>
			<td class="left_col error"><h4>Name:</h4></td>
			<td>
				<input type="text" name="partner_name" id="partner_name" value="{$partnerData.partner_name}" size="60"/>
				{if isset($errorArray.partnertype_code)}<br /><span class="error">{$errorArray.partnertype_code}</span>{/if}
			</td>
		</tr>
          <tr>
            <td class="left_col error"><h4>Area:</h4></td>
			<td colspan="3">			
				<input type="text" name="area_name" id="area_name" value="{$partnerData.area_path}" size="60" />
				<input type="hidden" name="area_code" id="area_code" value="{$partnerData.area_code}" />
				{if isset($errorArray.partnertype_code)}<br /><span class="error">{$errorArray.partnertype_code}</span>{/if}
			</td>				
          </tr> 		
		<tr>
			<td class="left_col"><h4>Website:</h4></td>
			<td><input type="text" name="partner_website" id="partner_website" value="{$partnerData.partner_website}" size="60"/></td>
		</tr>
		<tr>
			<td class="left_col error"><h4>Address:</h4></td>
			<td>
				<textarea name="partner_address" id="partner_address" rows="3" cols="50">{$partnerData.partner_address}</textarea>
				{if isset($errorArray.partnertype_code)}<br /><span class="error">{$errorArray.partnertype_code}</span>{/if}
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
 {include_php file='includes/footer.php'}
</div>
{literal}
<script type="text/javascript">
$(document).ready(function() {	
	
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
	

	$("input").keypress(function(event) {
		if (event.which == 13) {
			event.preventDefault();
			$("detailsForm").submit();
		}
	});

});
function submitForm() {
	document.forms.detailsForm.submit();					 
}
</script>
{/literal}
<!-- End Main Container -->
</body>
</html>
