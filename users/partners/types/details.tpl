<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SA-YES| Users</title>
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
			<li><a href="/users/partners/types/" title="">Partners</a></li>
			<li><a href="/users/partners/types/" title="">Types</a></li>
			<li>{if isset($partnertypeData)}Edit partner type{else}Add a new partner type{/if}</li>
        </ul>
	</div><!--breadcrumb--> 
  
	<div class="inner"> 
      <h2>{if isset($partnertypeData)}Edit partner type{else}Add a new partner type{/if}</h2>
    <div id="sidetabs">
        <ul > 
            <li class="active"><a href="#" title="Details">Details</a></li>
        </ul>
    </div><!--tabs-->

	<div class="detail_box">
      <form id="detailsForm" name="detailsForm" action="/users/partners/types/details.php{if isset($partnertypeData)}?code={$partnertypeData.partnertype_code}{/if}" method="post">
        <table width="700" border="0" align="center" cellpadding="0" cellspacing="0" class="form">
		<tr>
			<td class="left_col {if isset($errorArray.partnertype_name)} error{/if}"><h4>Description:</h4></td>
			<td><input type="text" name="partnertype_name" id="partnertype_name" value="{$partnertypeData.partnertype_name}" size="60"/></td>
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
<script type="text/javascript">
$(document).ready(function() {	

	$("input").keypress(function(event) {
		if (event.which == 13) {
			event.preventDefault();
			document.forms.detailsForm.submit();		
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
