<?php /* Smarty version 2.6.20, created on 2014-05-10 11:21:33
         compiled from calendar/schedules/details.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'calendar/schedules/details.tpl', 39, false),array('modifier', 'default', 'calendar/schedules/details.tpl', 47, false),array('modifier', 'date_format', 'calendar/schedules/details.tpl', 47, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-/W3C/DTD XHTML 1.0 Transitional/EN" "http:/www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http:/www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SA-YES | Calendar</title>
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/css.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/javascript.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

</head>
<body>
<!-- Start Main Container -->
<div id="container">
    <!-- Start Content recruiter -->
  <div id="content">
    <?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/header.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

  	<br />
	<div id="breadcrumb">
        <ul>
            <li><a href="/" title="Home">Home</a></li>
			<li><a href="/calendar/" title="">Calendar</a></li>
			<li><a href="/calendar/schedules/" title="">View</a></li>
			<li>Edit Calendar</li>
        </ul>
	</div><!--breadcrumb--> 
  
	<div class="inner"> 
      <h2>Add/Update Calendar Event</h2>
	<div class="detail_box" style="width: 850px; !important;">
      <form id="detailsForm" name="detailsForm" action="/calendar/schedules/details.php<?php if (isset ( $this->_tpl_vars['calendarData'] )): ?>?code=<?php echo $this->_tpl_vars['calendarData']['calendar_code']; ?>
<?php endif; ?>" method="post">
        <table width="850" border="0" align="center" cellpadding="0" cellspacing="0" class="form" style="float: left;">
          <tr>
            <td class="left_col<?php if (isset ( $this->_tpl_vars['errorArray']['calendar_name'] )): ?> error<?php endif; ?>"><h4>Name:</h4></td>
			<td colspan="3"><input type="text" name="calendar_name" id="calendar_name" value="<?php echo $this->_tpl_vars['calendarData']['calendar_name']; ?>
" size="80"/></td>				
          </tr>           
		   <tr>
            <td class="left_col<?php if (isset ( $this->_tpl_vars['errorArray']['calendartype_code'] )): ?> error<?php endif; ?>"><h4>Type:</h4></td>
			<td>
				<select id="calendartype_code" name="calendartype_code">
					<option value=""> ---- </option>
					<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['calendartypeData'],'selected' => $this->_tpl_vars['calendarData']['calendartype_code']), $this);?>

				</select>
			</td>
            <td class="left_col<?php if (isset ( $this->_tpl_vars['errorArray']['calendar_address'] )): ?> error<?php endif; ?>"><h4>Address/Area:</h4></td>
			<td><textarea id="calendar_address" name="calendar_address" rows="2" cols="40"><?php echo $this->_tpl_vars['calendarData']['calendar_address']; ?>
</textarea></td>					
          </tr>	  	
          <tr>
            <td class="left_col<?php if (isset ( $this->_tpl_vars['errorArray']['calendar_startdate'] )): ?> error<?php endif; ?>"><h4>Start Date:</h4></td>
			<td><input type="text" name="calendar_startdate" id="calendar_startdate" value="<?php echo ((is_array($_tmp=((is_array($_tmp=@$this->_tpl_vars['calendarData']['calendar_startdate'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['startdate']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['startdate'])))) ? $this->_run_mod_handler('date_format', true, $_tmp, '%Y-%m-%d %H:%M') : smarty_modifier_date_format($_tmp, '%Y-%m-%d %H:%M')); ?>
" size="20" readonly /></td>	
            <td class="left_col<?php if (isset ( $this->_tpl_vars['errorArray']['calendar_enddate'] )): ?> error<?php endif; ?>"><h4>End Date:</h4></td>
			<td><input type="text" name="calendar_enddate" id="calendar_enddate" value="<?php echo ((is_array($_tmp=((is_array($_tmp=@$this->_tpl_vars['calendarData']['calendar_enddate'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['enddate']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['enddate'])))) ? $this->_run_mod_handler('date_format', true, $_tmp, '%Y-%m-%d %H:%M') : smarty_modifier_date_format($_tmp, '%Y-%m-%d %H:%M')); ?>
" size="20" readonly /></td>
          </tr>		  
          <tr>
            <td colspan="4">
				<h4 class="<?php if (isset ( $this->_tpl_vars['errorArray']['calendar_description'] )): ?>error<?php endif; ?>">Description:</h4><br />
				<textarea id="calendar_description" name="calendar_description" rows="25" cols="100"><?php echo $this->_tpl_vars['calendarData']['calendar_description']; ?>
</textarea>
			</td>			
          </tr>			  
        </table>
		<div class="clearer"><!-- --></div>
        <div class="mrg_top_10">
          <a href="javascript:submitForm();" class="blue_button mrg_left_20 fl"><span>Save &amp; Complete</span></a>   
        </div>		
      </form>
	</div>
    <div class="clearer"><!-- --></div>
	<?php if (isset ( $this->_tpl_vars['calendarData'] )): ?>
	<br /><br />
	 <h2>Add Attendees</h2>
	<div class="detail_box" style="width: 1076px; !important;">
      <form id="detailsForm" name="detailsForm" action="#" method="post">
        <table width="1076" border="0" align="center" cellpadding="0" cellspacing="0" class="form" style="float: left;">		  
          <tr>
            <td colspan="4" class="left_col<?php if (isset ( $this->_tpl_vars['errorArray']['usersearch'] )): ?> error<?php endif; ?>">Option 1:&nbsp; &nbsp; &nbsp; Search for attendees:&nbsp; &nbsp; &nbsp;<input type="text" name="usersearch" id="usersearch" value="" size="80"/></td>			
          </tr>		  
          <tr>
            <td>Option 2:&nbsp; &nbsp; &nbsp;Name <input type="text" name="attendeename" id="attendeename" value="" size="30"/></td>
			<td>Email <input type="text" name="attendeeemail" id="attendeeemail" value="" size="30"/></td>
			<td>Cell <input type="text" name="attendeecell" id="attendeecell" value="" size="15"/></td>
			<td><button onclick="formAddAttendee(); return false;">Add Attendee</button></td>			
          </tr>				  
          <tr>
            <td colspan="4">
				<h4 class="<?php if (isset ( $this->_tpl_vars['errorArray']['user'] )): ?>error<?php endif; ?>">Attendees:</h4><br />
				<ul id="attendees" name="attendees" style="list-style: none; padding: 0; margin: 0;">
				<?php $_from = $this->_tpl_vars['attendeeData']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
				<li id="attendee_<?php echo $this->_tpl_vars['item']['calendarattend_user']; ?>
" class="<?php if ($this->_tpl_vars['item']['calendarattend_response'] == 'accepted'): ?>success<?php else: ?>error<?php endif; ?>"><button onclick="emailattendee('<?php echo $this->_tpl_vars['item']['calendarattend_user']; ?>
'); return false;">Email</button>&nbsp; &nbsp; &nbsp;<button onclick="deleteattendee('<?php echo $this->_tpl_vars['item']['calendarattend_user']; ?>
'); return false;">remove</button>&nbsp; &nbsp; &nbsp;<?php echo $this->_tpl_vars['item']['calendarattend_fullname']; ?>
 - <?php echo $this->_tpl_vars['item']['calendarattend_email']; ?>
 -  <?php echo $this->_tpl_vars['item']['calendarattend_cell']; ?>
</li>
				<?php endforeach; endif; unset($_from); ?>
				</ul>
			</td>			
          </tr>			  
        </table>
		<?php if (! empty ( $this->_tpl_vars['attendeeData'] )): ?>
		<div class="clearer"><!-- --></div>
        <div class="mrg_top_10">
          <a href="javascript:void(0);" onclick="emailAll(); return false;" class="blue_button mrg_left_20 fl"><span>Send email to all attendees</span></a>   
        </div>
		<?php endif; ?>		
      </form>
	</div>	
	<?php endif; ?>
	<div class="clearer"><!-- --></div>
    </div><!--inner-->
 </div> 	
<!-- End Content recruiter -->
 </div><!-- End Content recruiter -->
 <?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/footer.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

</div>
<?php echo '
<script type="text/javascript">
$(document).ready(function() {	

	new nicEditor({
		iconsPath	: \'/library/javascript/nicedit/nicEditorIcons.gif\',
		buttonList 	: [\'bold\',\'italic\',\'underline\',\'left\',\'center\', \'ol\', \'ul\', \'xhtml\', \'fontFormat\', \'fontFamily\', \'fontSize\', \'unlink\', \'link\', \'strikethrough\', \'superscript\', \'subscript\'],
		uploadURI : \'/library/javascript/nicedit/nicUpload.php\',
	}).panelInstance(\'calendar_description\');

	/* Search for mentors. */
	$( "#usersearch").autocomplete({
		source: "/feeds/attendees.php",
		minLength: 1,
		select: function( event, ui ) {
		
			if(ui.item.id == \'\') {
				
				$("#usersearch").val(\'\');
			} else {
				
				if($(\'#attendee_\'+ui.item.code).length == 0) {
					addAttendee(ui.item);
				}
				
				$("#usersearch").val(\'\');
			}
			
			$(\'#usersearch\').val(\'\');										
		}
	});
	
	$("#calendar_startdate").datetimepicker({
		dateFormat: \'yy-mm-dd\'
	});
	
	$( "#calendar_enddate" ).datetimepicker({
		dateFormat: \'yy-mm-dd\'
	});
	
});

function emailAll(code) {
		
	if(confirm(\'Are you sure you want to email all attendees? This may take a while...\')) {
		$.post("?action=emailall&code='; ?>
<?php echo $this->_tpl_vars['calendarData']['calendar_code']; ?>
<?php echo '", {
				attendeecode	: code
			},
			function(data) {
				if(data.result) {
					alert(\'Email has been sent to all attendees\');
				} else {
					alert(data.error);
				}
			},
			\'json\'
		);	
	}
	return false;
}

function emailattendee(code) {
		
	if(confirm(\'Are you sure you want to send this email?\')) {
		$.post("?action=emailattendee&code='; ?>
<?php echo $this->_tpl_vars['calendarData']['calendar_code']; ?>
<?php echo '", {
				attendeecode	: code
			},
			function(data) {
				if(data.result) {
					alert(\'Email has been sent\');
				} else {
					alert(data.error);
				}
			},
			\'json\'
		);	
	}
	return false;
}

function deleteattendee(code) {
	
	if(confirm(\'Are you sure you want to delete this attendee?\')) {
		$.post("?action=deleteattendee&code='; ?>
<?php echo $this->_tpl_vars['calendarData']['calendar_code']; ?>
<?php echo '", {
				attendeecode	: code
			},
			function(data) {
				if(data.result) {
					$(\'#attendee_\'+code).remove();
				} else {
					alert(data.error);
				}
			},
			\'json\'
		);	
	}
	return false;
}

function formAddAttendee() {
	
	var name		= $(\'#attendeename\').val();
	var email 	= $(\'#attendeeemail\').val();
	var cell 		= $(\'#attendeecell\').val();
	
	if(name != \'\' && email != \'\' && cell != \'\') {
		
		var item = new Object;
		
		item.code 	= \'-1\';
		item.type 	= \'custom\';
		item.name 	= name;
		item.email 	= email;
		item.cell 		= cell;
		
		var result = addAttendee(item);
		
		$(\'#attendeename\').val(\'\');
		$(\'#attendeeemail\').val(\'\');
		$(\'#attendeecell\').val(\'\');		
			
	} else {
		alert(\'Please add name, email and cell for the new attendee.\');
	}
}

function addAttendee(item) {
	
	var success = false;
	
	$.post("?action=addattendee&code='; ?>
<?php echo $this->_tpl_vars['calendarData']['calendar_code']; ?>
<?php echo '", {
			attendeecode	: item.code,
			attendetype	: item.type,
			attendename	: item.name,
			attendeemail	: item.email,
			attendeecell	: item.cell
		},
		function(data) {
			if(data.result) {
		
				var html = \'<li id="attendee_\'+data.attendee+\'"><button onclick="emailattendee(\\\'\'+data.attendee+\'\\\'); return false;">Email</button>&nbsp; &nbsp; &nbsp;<button onclick="deleteattendee(\\\'\'+data.attendee+\'\\\')">remove</button>&nbsp; &nbsp; &nbsp; \'+item.name+\' - \'+item.email+ \' - \' + item.cell+\'</li>\'
				
				$(\'#attendees\').append(html);
			
			} else {
				success = false;
				alert(data.error);
			}
		},
		\'json\'
	);	
	
	return success;
}
				
function submitForm() {
	nicEditors.findEditor(\'calendar_description\').saveContent();
	document.forms.detailsForm.submit();					 
}
</script>
'; ?>

<!-- End Main Container -->
</body>
</html>