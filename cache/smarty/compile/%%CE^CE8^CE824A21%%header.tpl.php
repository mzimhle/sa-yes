<?php /* Smarty version 2.6.20, created on 2015-07-26 01:39:55
         compiled from includes/header.tpl */ ?>
<div id="header">
    <!-- Start Heading -->
        
    <div id="heading">
	<h1 style="float: left;">SA-YES Online Meeting Tracker</h1>
        <div id="ct_logo">

        </div>
       
    </div><!-- End Heading -->
	<?php if (isset ( $this->_tpl_vars['userData'] )): ?>
	 <?php if ($this->_tpl_vars['userData']['usertype_code'] == 1): ?>
    <!-- Start Top Nav -->
    <div id="topnav"> 
            <ul>
				<li><a href="/reports/" title="reports" <?php if ($this->_tpl_vars['page'] == 'reports'): ?> class="active"<?php endif; ?>>reports</a></li>
				<li><a href="/users/" title="users" <?php if ($this->_tpl_vars['page'] == 'users'): ?> class="active"<?php endif; ?>>users</a></li>
				<!-- <li><a href="/matches/" title="matches" <?php if ($this->_tpl_vars['page'] == 'matches'): ?> class="active"<?php endif; ?>>matches</a></li>	-->			
				<li><a href="/meetings/" title="meetings" <?php if ($this->_tpl_vars['page'] == 'meetings'): ?> class="active"<?php endif; ?>>Programme Meetings</a></li>												
				<li><a href="/program/" title="program" <?php if ($this->_tpl_vars['page'] == 'program'): ?> class="active"<?php endif; ?>>programme</a></li>
				<li><a href="/comms/" title="Comms" <?php if ($this->_tpl_vars['page'] == 'comms'): ?> class="active"<?php endif; ?>>Mailers</a></li>
				<li><a href="/calendar/" title="Calendar" <?php if ($this->_tpl_vars['page'] == 'calendar'): ?> class="active"<?php endif; ?>>Calendar</a></li>				
            </ul>
    </div><!-- End Top Nav -->
  <div class="clearer"><!-- --></div>
  <?php elseif ($this->_tpl_vars['userData']['usertype_code'] == 2): ?>
    <!-- Start Top Nav -->
    <div id="topnav"> 
            <ul>
                <li><a href="/mentor/" title="Home" <?php if ($this->_tpl_vars['page'] == 'default.php' || $this->_tpl_vars['page'] == ''): ?> class="active"<?php endif; ?>>Home</a></li>
				<li><a href="/mentor/meetings/" title="users" <?php if ($this->_tpl_vars['page'] == 'users'): ?> class="active"<?php endif; ?>>Meetings</a></li>
				<li><a href="/mentor/account/" title="users" <?php if ($this->_tpl_vars['page'] == 'users'): ?> class="active"<?php endif; ?>>Account</a></li>
            </ul>
    </div><!-- End Top Nav -->
  <div class="clearer"><!-- --></div>	
  <?php endif; ?>
  <?php endif; ?>
</div><!--header-->
 <?php if (isset ( $this->_tpl_vars['userData'] )): ?>
    <div class="logged_in">
        <ul>
            <?php if ($this->_tpl_vars['userData']['usertype_code'] == 1): ?><li><a href="/account/" title="Account">My Account</a></li><?php endif; ?>
			<?php if ($this->_tpl_vars['userData']['usertype_code'] == 2): ?>
			<li><a href="/mentor/logout.php" title="Logout">Logout</a></li>
			<?php else: ?>
			<li><a href="/logout.php" title="Logout">Logout</a></li>
			<?php endif; ?>
        </ul>
    </div><!--logged_in-->
	<?php endif; ?>
  	<br />