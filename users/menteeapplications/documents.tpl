<!DOCTYPE html PUBLIC "-/W3C/DTD XHTML 1.0 Transitional/EN" "http:/www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http:/www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SA-YES | Users</title>
{include_php file='includes/css.php'}
{include_php file='includes/javascript.php'}
{literal}
<script type="text/javascript" language="javascript">
$(document).ready(function(){
	odataTable = $('#dataTable').dataTable({					
		"bJQueryUI": true,
		"sPaginationType": "full_numbers",							
		"bSort": true,
		"bFilter": true,
		"bInfo": false,
		"iDisplayLength": 20,
		"bLengthChange": false							
	});		

	odataTable.fnFilter('');	
});
</script>
{/literal}
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
			<li>Mentee Application - {$menteeappData.menteeapp_name} {$menteeappData.menteeapp_surname}</li>
			<li>Documents</li>
        </ul>
	</div><!--breadcrumb-->  
	<div class="inner"> 
		<div class="clearer"><!-- --></div>
		<br /><h2>Documents</h2>
		<div class="mrg_top_10 fr">
		  <a href="/users/menteeapplications/details.php?code={$menteeappData.menteeapp_code}" class="button mrg_left_20 fl"><span>Mentee Details</span></a>   
		  <a href="/users/menteeapplications/application.php?code={$menteeappData.menteeapp_code}" class="button mrg_left_20 fl"><span>Mentee Application</span></a>   
		  <a href="#" class="blue_button mrg_left_20 fl"><span>Mentee Documents</span></a>   
		</div>		
		<div class="clearer"><!-- --></div>
		<br />
		<div class="detail_box">
		  <form id="detailsForm" name="detailsForm" action="/users/menteeapplications/documents.php?code={$menteeappData.menteeapp_code}" method="post" enctype="multipart/form-data">
			<table border="0" cellspacing="0" cellpadding="5">
			  <tr>
				<td>
					<h4 {if isset($errorArray.document_name)}class="error"{/if}>Description:</h4><br />
					<input type="text" name="document_name" id="document_name" size="60"/>
					{if isset($errorArray.document_name)}<br /><span class="error">{$errorArray.document_name}</span>{/if}
				</td>
				</tr>
				<tr>
				<td>
					<h4 {if isset($errorArray.app_file)}class="error"{/if}>Upload File:</h4><br />
					<input type="file" name="app_file" id="app_file" /><br />
					Only upload pdf, docx, doc, txt, jpg, jpeg, png files only
					{if isset($errorArray.app_file)}<br /><span class="error">{$errorArray.app_file}</span>{/if}
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
		<br /><br />			
		<div class="detail_box">
		  <form id="listForm" name="listForm" action="#">
			<table id="dataTable" border="0" cellspacing="0" cellpadding="0" width="100%">
				<thead> 
					<tr>
						<th>Added</th>
						<th>Name</th>
						<th>Download</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
				  {foreach from=$documentData item=item}
				  <tr>
					<td align="left">{$item.documents_added|date_format}</td>		
					<td align="left">{$item.documents_name}</td>
					<td align="left"><a href="{$item.documents_path}" target="_blank">Download</a></td>	
					<td align="left"><button onclick="javascript:deleteitem('{$item.documents_code}'); return false;">delete</button></td>
				  </tr>
				  {/foreach}     
				</tbody>
			</table>
		  </form>
		</div>
		<div class="clearer"><!-- --></div>
    </div><!--inner-->
 </div> 	
<!-- End Content recruiter -->
 {include_php file='includes/footer.php'}
</div>
{literal}
<script type="text/javascript">

function deleteitem(id) {
	if(confirm('Are you sure you want to delete this item?')) {
		$.post("?code={/literal}{$menteeappData.menteeapp_code}{literal}", {
				deleteitem	: id
			},
			function(data) {
				if(data.result) {			
					alert('Deleted!');
					window.location.href = window.location.href;
				} else {
					alert(data.message);
				}
			},
			'json'
		);
	}
	return false;
}

function submitForm() {
	document.forms.detailsForm.submit();					 
}
</script>
{/literal}
<!-- End Main Container -->
</body>
</html>
