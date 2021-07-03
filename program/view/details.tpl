<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SA-YES | {if isset($mentorshipData)}Edit Programme{else}Add a Programme{/if}</title>
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
			<li><a href="/program/" title="">Programme</a></li>
			<li><a href="/program/view/" title="">View</a></li>
			<li>{if isset($mentorshipData)}Edit Programme{else}Add a new Programme{/if}</li>
        </ul>
	</div><!--breadcrumb--> 
  
	<div class="inner"> 
      <h2>{if isset($mentorshipData)}Edit Programme{else}Add a new Programme{/if}</h2>
    <div id="sidetabs">
        <ul > 
            <li class="active"><a href="#" title="Details">Details</a></li>
        </ul>
    </div><!--tabs-->
	<div class="detail_box">
      <form id="detailsForm" name="detailsForm" action="/program/view/details.php{if isset($mentorshipData)}?code={$mentorshipData.mentorship_code}{/if}" method="post">
        <table width="700" border="0" align="center" cellpadding="0" cellspacing="0" class="form">
		{if isset($errorArray.mentorship)}
		<tr>
			<td colspan="2" style="color: red; font-weight: bold;">{$errorArray.mentorship}</td>
		</tr>
		{/if}
		{if isset($mentorshipData)}
		<tr>
			<td class="left_col"><h4>Year:</h4></td>
			<td>{$mentorshipData.mentorship_code}</td>
		</tr>
		<tr>
			<td class="left_col"><h4>From:</h4></td>
			<td>{$mentorshipData.mentorship_startdate}</td>
		</tr>		
		<tr>
			<td class="left_col"><h4>To:</h4></td>
			<td>{$mentorshipData.mentorship_enddate}</td>
		</tr>				
		{else}
		<tr>
			<td class="left_col" {if isset($errorArray.mentorship_code)}style="color: red; font-weight: bold;"{/if}><h4>Year:</h4></td>
			<td>
				<select id="mentorship_code" name="mentorship_code">
					<option value=""> ---- </option>
					<option value="2009" {if $mentorshipData.mentorship_code eq '2009'}selected{/if}> 2009 </option>
					<option value="2010" {if $mentorshipData.mentorship_code eq '2010'}selected{/if}> 2010 </option>
					<option value="2011" {if $mentorshipData.mentorship_code eq '2011'}selected{/if}> 2011 </option>
					<option value="2012" {if $mentorshipData.mentorship_code eq '2012'}selected{/if}> 2012 </option>
					<option value="2013" {if $mentorshipData.mentorship_code eq '2013'}selected{/if}> 2013 </option>
					<option value="2014" {if $mentorshipData.mentorship_code eq '2014'}selected{/if}> 2014 </option>
					<option value="2015" {if $mentorshipData.mentorship_code eq '2015'}selected{/if}> 2015 </option>
					<option value="2016" {if $mentorshipData.mentorship_code eq '2016'}selected{/if}> 2016 </option>
					<option value="2017" {if $mentorshipData.mentorship_code eq '2017'}selected{/if}> 2017 </option>
					<option value="2018" {if $mentorshipData.mentorship_code eq '2009'}selected{/if}> 2018 </option>
					<option value="2019" {if $mentorshipData.mentorship_code eq '2009'}selected{/if}> 2019 </option>
					<option value="2020" {if $mentorshipData.mentorship_code eq '2009'}selected{/if}> 2020 </option>
				</select>
			</td>
		</tr>
		{/if}		
		<tr>
			<td class="left_col" {if isset($errorArray.mentorship_name)}style="color: red; font-weight: bold;"{/if}><h4>Name:</h4></td>
			<td><input type="text" name="mentorship_name" id="mentorship_name" value="{$mentorshipData.mentorship_name}" size="60"/></td>
		</tr>			  
		<tr>
			<td class="left_col" {if isset($errorArray.mentorship_description)}style="color: red; font-weight: bold;"{/if}><h4>Description:</h4></td>
			<td><textarea name="mentorship_description" id="mentorship_description" rows="3" cols="50">{$mentorshipData.mentorship_description}</textarea></td>
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
function submitForm() {
	document.forms.detailsForm.submit();					 
}
</script>
{/literal}
<!-- End Main Container -->
</body>
</html>
