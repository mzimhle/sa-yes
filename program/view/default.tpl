<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SA-YES | Programme</title>
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
			<li><a href="/program/" title="">Programme</a></li>
			<li><a href="/program/view/" title="">View</a></li>
        </ul>
	</div><!--breadcrumb-->  
	<div class="inner">     
    <h2>Manage Programme</h2>		
	<a href="/program/view/details.php" title="Click to Add a new Item" class="blue_button fl mrg_bot_10"><span style="float:left;">Add a new Programme</span></a> <br />
    <div class="clearer"><!-- --></div>
    <div id="tableContent" align="center">
		<!-- Start Content Table -->
		<div class="content_table">			
			<table id="dataTable" border="0" cellspacing="0" cellpadding="0">
				<thead> 
					<tr>
						<th>Added</th>
						<th>Year</th>
						<th>Name</th>
						<th>Description</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
				  {foreach from=$mentorshipData item=item}
				  <tr>
					<td align="left">{$item.mentorship_added|date_format}</td>		
					<td align="left">{$item.mentorship_code}</td>
					<td align="left"><a href="/program/view/details.php?code={$item.mentorship_code}">{$item.mentorship_name}</a></td>	
					<td align="left">{$item.mentorship_description}</td>
					<td align="left">{if $item.mentorship_active eq '1'}<span style="font-weight: bold; color: green;">Active</span>{else}<span style="font-weight: bold; color: red;">In-Active</span>{/if}</td>
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
