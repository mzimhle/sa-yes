<!DOCTYPE html PUBLIC "-/W3C/DTD XHTML 1.0 Transitional/EN" "http:/www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http:/www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Say-Yes | Users</title>
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
			<li><a href="/users/" title="">Users</a></li>
			<li><a href="/users/mentorship/" title="">Mentorship</a></li>
        </ul>
	</div><!--breadcrumb-->  
	<div class="inner">     
    <h2>Assign Users to mentorship program</h2>	<br />
    <div class="clearer"><!-- --></div>         
	 <!-- Start Search Form -->
    <div class="filter">
		<div id="searchBar" class="left">    				  
				 <strong class="line fl mrg_left_20">Person:</strong>
				<input type="text" name="usersearch" id="usersearch" value="" size="20" /> &nbsp;
				<input type="hidden" name="usercode" id="usercode" value="" />
				<strong class="line fl">Type:</strong>		
				<select id="type" name="type">
					<option value=""> All </option>
					{html_options options=$usertypeData}
				</select>				
				<strong class="line fl">Mentorship:</strong>		
				<select id="mentorship" name="mentorship">
					<option value=""> All </option>
					{html_options options=$mentorshipData}
				</select>					
				<a  href="javascript:void(0);" onClick="clearsearch();" class="button next fr"><span>Clear</span></a>			
				<a  href="javascript:void(0);" onClick="searchForm();" class="button next fr"><span>Search</span></a>					
		 </div>
    </div>
    <div class="clearer"><!-- --></div>
	<select id="assignmentorship" name="assignmentorship">
		<option value=""> ------ </option>
		{html_options options=$mentorshipData}
	</select>	
	<button value="Assign Users" onclick="assigntomentorship()">Assign Users</button>
	<br /><br />
    <div id="tableContent" align="center">
		<!-- Start Content Table -->
		<div class="content_table">
				<img src="/images/ajax-loader-2.gif" />			
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
