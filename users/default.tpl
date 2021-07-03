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

    <!-- Start Content Section -->
  <div id="content">
    {include_php file='includes/header.php'}
	<div id="breadcrumb">
        <ul>
            <li><a href="/" title="Home">Home</a></li>
			<li><a href="/users/" title="Users">Users</a></li>
        </ul>
	</div><!--breadcrumb--> 	
  <div class="inner">  
   <h2>Manage Users</h2>	

  <div class="section">
  	<a href="/users/status/" title="Manage Application Status"><img src="/images/users.gif" alt="Manage Application Status" height="50" width="50" /></a>
  	<a href="/users/status/" title="Manage Application Status" class="title">Manage  Application Status</a>
  </div>
  <div class="section mrg_left_50">
  	<a href="/users/partners/" title="Manage Partners"><img src="/images/projects.gif" alt="Manage Partners" height="50" width="50" /></a>
  	<a href="/users/partners/" title="Manage Partners" class="title">Manage Partners</a>
  </div>  
  <div class="section mrg_left_50">
  	<a href="/users/menteeapplications/" title="Manage Mentee Applications"><img src="/images/users.gif" alt="Manage Users" height="50" width="50" /></a>
  	<a href="/users/menteeapplications/" title="Manage Mentee Applications" class="title">Manage Mentee Applications</a>
  </div>
<div class="clearer"><!-- --></div>  
  <div class="section">
  	<a href="/users/mentorapplications/" title="Manage Mentor Applications"><img src="/images/projects.gif" alt="Manage Mentor Applications" height="50" width="50" /></a>
  	<a href="/users/mentorapplications/" title="Manage Mentor Applications" class="title">Manage Mentor Applications</a>
  </div>
  <div class="section mrg_left_50">
  	<a href="/users/matchdetails/" title="Match Details reports"><img src="/images/users.gif" alt="Match Details reports" height="50" width="50" /></a>
  	<a href="/users/matchdetails/" title="Match Details reports" class="title">Match Details reports</a>
  </div>    
  {if $userData.user_id eq '1'}
  <div class="section mrg_left_50">
	<a href="/users/admins/" title="Manage Administrators"><img src="/images/projects.gif" alt="Manage Administrators" height="50" width="50" /></a>
	<a href="/users/admins/" title="Manage Administrators" class="title">Manage Administrators</a>
  </div>
	{/if}  
  <div class="clearer"><!-- --></div>
    </div><!--inner-->
  </div><!-- End Content Section -->
 {include_php file='includes/footer.php'}
</div>
<!-- End Main Container -->
</body>
</html>
