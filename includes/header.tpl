<div id="header">
    <!-- Start Heading -->
        
    <div id="heading">
	<h1 style="float: left;">SA-YES Online Meeting Tracker</h1>
        <div id="ct_logo">

        </div>
       
    </div><!-- End Heading -->
	{if isset($userData)}
	 {if $userData.usertype_code eq 1}
    <!-- Start Top Nav -->
    <div id="topnav"> 
            <ul>
				<li><a href="/reports/" title="reports" {if $page eq 'reports'} class="active"{/if}>reports</a></li>
				<li><a href="/users/" title="users" {if $page eq 'users'} class="active"{/if}>users</a></li>
				<!-- <li><a href="/matches/" title="matches" {if $page eq 'matches'} class="active"{/if}>matches</a></li>	-->			
				<li><a href="/meetings/" title="meetings" {if $page eq 'meetings'} class="active"{/if}>Programme Meetings</a></li>												
				<li><a href="/program/" title="program" {if $page eq 'program'} class="active"{/if}>programme</a></li>
				<li><a href="/comms/" title="Comms" {if $page eq 'comms'} class="active"{/if}>Mailers</a></li>
				<li><a href="/calendar/" title="Calendar" {if $page eq 'calendar'} class="active"{/if}>Calendar</a></li>				
            </ul>
    </div><!-- End Top Nav -->
  <div class="clearer"><!-- --></div>
  {elseif $userData.usertype_code eq 2}
    <!-- Start Top Nav -->
    <div id="topnav"> 
            <ul>
                <li><a href="/mentor/" title="Home" {if $page eq 'default.php' or $page eq ''} class="active"{/if}>Home</a></li>
				<li><a href="/mentor/meetings/" title="users" {if $page eq 'users'} class="active"{/if}>Meetings</a></li>
				<li><a href="/mentor/account/" title="users" {if $page eq 'users'} class="active"{/if}>Account</a></li>
            </ul>
    </div><!-- End Top Nav -->
  <div class="clearer"><!-- --></div>	
  {/if}
  {/if}
</div><!--header-->
 {if isset($userData)}
    <div class="logged_in">
        <ul>
            {if $userData.usertype_code eq 1}<li><a href="/account/" title="Account">My Account</a></li>{/if}
			{if $userData.usertype_code eq 2}
			<li><a href="/mentor/logout.php" title="Logout">Logout</a></li>
			{else}
			<li><a href="/logout.php" title="Logout">Logout</a></li>
			{/if}
        </ul>
    </div><!--logged_in-->
	{/if}
  	<br />