<?php /* Smarty version 2.6.20, created on 2014-05-14 22:57:49
         compiled from calendar/display/default.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SA-YES | Home</title>
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/css.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/javascript.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>
 
<link rel="stylesheet" type="text/css" href="/library/javascript/fullcalendar-1.6.2/fullcalendar.css" media="screen" />
<link rel="stylesheet" type="text/css" href="/library/javascript/fullcalendar-1.6.2/fullcalendar.print.css" media="screen" />
<script type="text/javascript" language="javascript" src="/library/javascript/fullcalendar-1.6.2/fullcalendar.min.js"></script>
<script type="text/javascript" language="javascript" src="/feeds/calendar.php"></script>
</head>

<body>
<!-- Start Main Container -->
<div id="container">
    <!-- Start Content Section -->
  <div id="content">
    <?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/header.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

	<div id="breadcrumb">
        <ul>
            <li><a href="/" title="Home">Home</a></li>
			<li><a href="/calendar/" title="Calendar">Calendar</a></li>
			<li><a href="/calendar/display/" title="Display">Display</a></li>
        </ul>
	</div><!--breadcrumb--> 	
  <div class="inner">  
   <h2>Manage Calendar</h2>	<br />
<div class="clearer"><!-- --></div>
<div id='calendar'></div>	 
  <div class="clearer"><!-- --></div>
    </div><!--inner-->
  </div><!-- End Content Section -->
 <?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/footer.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

 <?php echo '
<script type="text/javascript" language="javascript">		
$(document).ready(function() {
	
	var calendar = $(\'#calendar\').fullCalendar({
		header: {
			left: \'prev,next today\',
			center: \'title\',
			right: \'month,agendaWeek,agendaDay\'
		},
		selectable: true,
		selectHelper: true,
		select: function(start, end, allDay) {
			
			var startdate	= $.fullCalendar.formatDate(start,\'yyyy-MM-dd HH:mm\');
			var enddate	= $.fullCalendar.formatDate(end,\'yyyy-MM-dd HH:mm\');
			var today 		= $.fullCalendar.formatDate(new Date(),\'yyyy-MM-dd HH:mm\');	
			
			if(startdate  < today) {
				alert(\'You cannot schedule past dates.\');
			} else {
				if(!confirm(\'Are you sure you want to book this day?\')) {			
					return false;				
				} else {
					window.location.href = \'/calendar/schedules/details.php?startdate=\'+startdate+\'&enddate=\'+enddate;	
				}				
			}
		},
		editable: true,
		events: bookings
	});
});
</script>
'; ?>

</div>
<!-- End Main Container -->
</body>
</html>