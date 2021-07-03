<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SA-YES | Matches</title>
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
			<li><a href="/matches/" title="">Matches</a></li>
			<li><a href="/matches/view/" title="">Types</a></li>
			<li>{if isset($matchData)}Edit match{else}Add a new match{/if}</li>
        </ul>
	</div><!--breadcrumb--> 
  
	<div class="inner"> 
      <h2>{if isset($matchData)}Edit match{else}Add a new match{/if}</h2>
    <div id="sidetabs">
        <ul > 
            <li class="active"><a href="#" title="Details">Details</a></li>
        </ul>
    </div><!--tabs-->

	<div class="detail_box">
      <form id="detailsForm" name="detailsForm" action="/matches/view/details.php{if isset($matchData)}?code={$matchData.match_code}{/if}" method="post">
        <table width="700" border="0" align="center" cellpadding="0" cellspacing="0" class="form">
          {if isset($errorArray.matchcheck)}
			<tr><td class="left_col" style="color: red" colspan="2"><h4>{$errorArray.matchcheck}</h4></td></tr>           
		  {/if}
		  <tr>
            <td class="left_col" {if isset($errorArray.mentorship_code)}style="color: red"{/if}><h4>Mentorship Program:</h4></td>
			<td>
				<select id="mentorship_code" name="mentorship_code">
					<option value=""> ----- </option>
					{html_options options=$mentorshipData selected=$matchData.mentorship_code}
				</select>
			</td>
          </tr>		
          <tr>
            <td class="left_col" {if isset($errorArray.mentor_code)}style="color: red"{/if}><h4>Mentor:</h4></td>
			<td colspan="3">			
				<input type="text" name="mentor_name" id="mentor_name" value="{$matchData.mentorname}" size="60" /><br />
				<input type="hidden" name="mentor_code" id="mentor_code" value="{$matchData.mentor_code}" />
				<span id="mentorname" name="mentorname">{$matchData.mentorname}</span>
			</td>				
          </tr> 	
          <tr>
            <td class="left_col" {if isset($errorArray.mentee_code)}style="color: red"{/if}><h4>Mentee:</h4></td>
			<td colspan="3">			
				<input type="text" name="mentee_name" id="mentee_name" value="{$matchData.menteename}" size="60" /><br />
				<input type="hidden" name="mentee_code" id="mentee_code" value="{$matchData.mentee_code}" />
				<span id="menteename" name="menteename">{$matchData.menteename}</span>
			</td>				
          </tr> 		  		
		<tr>
			<td class="left_col"><h4>Notes:</h4></td>
			<td><textarea name="match_notes" id="match_notes" rows="5" cols="50">{$matchData.match_notes}</textarea></td>
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
	
	$( "#mentor_name" ).autocomplete({
		source: "/feeds/participants.php?type=2",
		minLength: 2,
		select: function( event, ui ) {
		
			if(ui.item.id == '') {
				$('#mentorname').html('');
				$('#mentor_code').val('');					
			} else {
				$('#mentorname').html('<b>' + ui.item.value + '</b>');
				$('#mentor_code').val(ui.item.id);	
			}
			$('#mentor_name').val('');										
		}
	});
	
	$( "#mentee_name" ).autocomplete({
		source: "/feeds/participants.php?type=3",
		minLength: 2,
		select: function( event, ui ) {
		
			if(ui.item.id == '') {
				$('#menteename').html('');
				$('#mentee_code').val('');					
			} else {
				$('#menteename').html('<b>' + ui.item.value + '</b>');
				$('#mentee_code').val(ui.item.id);	
			}
			$('#mentee_name').val('');										
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
