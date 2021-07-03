<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SAY-YES | View Comms</title>
{include_php file='includes/css.php'}
{include_php file='includes/javascript.php'}
<script type="text/javascript" language="javascript" src="default.js"></script>
</head>

<body>
<!-- Start Main Container -->
<div id="container">
    <!-- Start Content Section -->
  <div id="content">
    {include_php file='includes/header.php'}
	<div id="breadcrumb">
        <ul>
            <li><a href="/" title="Home">Home</a></li>
			<li><a href="/comms/" title="Mailers">Mailers</a></li>
			<li><a href="/comms/comms/" title="Comms">Comms</a></li>
        </ul>
	</div><!--breadcrumb-->  
	<div class="inner">     
    <h2>Comms</h2><br /><br />
    <div class="clearer"><!-- --></div>
    <div id="tableContent" align="center">
		<!-- Start Content Table -->
		<div class="content_table">			
			<table id="dataTable" border="0" cellspacing="0" cellpadding="0">
				<thead>
					<tr>
						<th>Added</th>
						<th>Code</th>
						<th>Full name</th>
						<th>Email</th>
						<th>Output</th>
					</tr>
			   </thead>
			   <tbody> 
			  {foreach from=$commsData item=item}
			  <tr>
				<td align="left">{$item._comms_added}</td>
				<td align="left">
					{if $item._comms_sent eq '1'}
						<a style="color: green !important;"href="/comms/comms/details.php?code={$item._comms_code}">{$item._comms_code}</a>
					{else}
						<a style="color: red !important;"href="/comms/comms/details.php?code={$item._comms_code}">{$item._comms_code}</a>
					{/if}
				</td>	
				<td align="left">{$item.user_name} {$item.user_surname}</td>
				<td align="left">{$item._comms_email}</td>				
				<td align="left">{$item._comms_output}</td>	
			  </tr>
			  {/foreach}     
			  </tbody>
			</table>
		 </div>
		 <!-- End Content Table -->	
	</div>
    <div class="clearer"><!-- --></div>
    </div><!--inner-->
  </div><!-- End Content Section -->
 {include_php file='includes/footer.php'}
</div>
<!-- End Main Container -->
</body>
</html>
