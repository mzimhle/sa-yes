<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SA-YES | Programme</title>
{include_php file='includes/css.php'}
{include_php file='includes/javascript.php'} 
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
			<li><a href="/program/" title="Programme">Programme</a></li>
        </ul>
	</div><!--breadcrumb--> 
  <div class="inner">  
   <h2>Manage Programme</h2>	

  <div class="section">
  	<a href="/program/view/" title="Add / Update Programmes"><img src="/images/users.gif" alt="Add / Update Programmes" height="50" width="50" /></a>
  	<a href="/program/view/" title="Add / Update Programmes" class="title">Add / Update Programmes</a>
  </div>
  <div class="section mrg_left_50">
  	<a href="/program/allmentor/" title="All Mentors"><img src="/images/users.gif" alt="All Mentors" height="50" width="50" /></a>
  	<a href="/program/allmentor/" title="All Mentors" class="title">All Mentors</a>
  </div> 
  <div class="section mrg_left_50">
  	<a href="/program/allmentee/" title="All Mentees"><img src="/images/users.gif" alt="All Mentees" height="50" width="50" /></a>
  	<a href="/program/allmentee/" title="All Mentees" class="title">All Mentees</a>
  </div>   
  <div class="clearer"><!-- --></div>
    </div><!--inner-->
  </div><!-- End Content Section -->
 {include_php file='includes/footer.php'}
</div>
<!-- End Main Container -->
</body>
</html>
