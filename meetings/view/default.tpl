<!DOCTYPE html PUBLIC "-/W3C/DTD XHTML 1.0 Transitional/EN" "http:/www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http:/www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SA-YES | Meetings</title>
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
			<li><a href="/meetings/" title="">Meetings</a></li>
			<li><a href="/meetings/view/" title="">View</a></li>
        </ul>
	</div><!--breadcrumb-->  
	<div class="inner">     
    <h2>Manage meetings</h2>	<br />
    <div class="clearer"><!-- --></div>    
     <!-- Start Search Form -->
    <div class="filter_double">

		<div id="searchBar" class="left">    				  
				<strong class="line fl">From Date:</strong>
				<input type="text" class="small_field"  id="from" name="from" size="10" value="{$from}" />		                      
				 <strong class="line fl mrg_left_20">To Date:</strong>
				<input type="text" id="to" name="to" size="10"  value="{$to}" />
				 <strong class="line fl mrg_left_20">Mentor:</strong>
				<input type="text" name="mentorsearch" id="mentorsearch" value="" size="20" /> &nbsp;
				<input type="hidden" name="smentorid" id="smentorid" value="" />
				<strong class="line fl mrg_left_20">Mentee:</strong>			
				<input type="text" name="menteesearch" id="menteesearch" value="" size="20" /> &nbsp;
				<input type="hidden" name="smenteeid" id="smenteeid" value="" />		
		 </div>
		 <div class="clearer"><!-- --></div>	
		<div id="searchBar" class="right;"> 
				<strong class="line fl">Type:</strong>		
				<select id="type" name="type">
					<option value=""> All </option>
					{html_options options=$meetingtypeData}
				</select>
				<strong class="line fl">Status:</strong>		
				<select id="meetingstatus" name="meetingstatus">
					<option value=""> All </option>
					<option value="1"> Met </option>
					<option value="0"> Did not meet </option>
				</select>	
				<strong class="line fl">With Staff:</strong>		
				<select id="withstaff" name="withstaff">
					<option value=""> All </option>
					<option value="1"> With Staff </option>
					<option value="0"> Without Staff </option>
				</select>
				<a  href="javascript:void(0);" onClick="clearsearch();" class="button next fr"><span>Clear</span></a>			
				<a  href="javascript:void(0);" onClick="searchForm();" class="button next fr"><span>Search</span></a>						 
		</div>		

    </div>
    <div class="clearer"><!-- --></div>	
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
