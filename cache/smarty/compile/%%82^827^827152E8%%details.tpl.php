<?php /* Smarty version 2.6.20, created on 2014-01-09 18:53:15
         compiled from matches/view/details.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'matches/view/details.tpl', 44, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SA-YES | Matches</title>
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
			<li><a href="/matches/" title="">Matches</a></li>
			<li><a href="/matches/view/" title="">Types</a></li>
			<li><?php if (isset ( $this->_tpl_vars['matchData'] )): ?>Edit match<?php else: ?>Add a new match<?php endif; ?></li>
        </ul>
	</div><!--breadcrumb--> 
  
	<div class="inner"> 
      <h2><?php if (isset ( $this->_tpl_vars['matchData'] )): ?>Edit match<?php else: ?>Add a new match<?php endif; ?></h2>
    <div id="sidetabs">
        <ul > 
            <li class="active"><a href="#" title="Details">Details</a></li>
        </ul>
    </div><!--tabs-->

	<div class="detail_box">
      <form id="detailsForm" name="detailsForm" action="/matches/view/details.php<?php if (isset ( $this->_tpl_vars['matchData'] )): ?>?code=<?php echo $this->_tpl_vars['matchData']['match_code']; ?>
<?php endif; ?>" method="post">
        <table width="700" border="0" align="center" cellpadding="0" cellspacing="0" class="form">
          <?php if (isset ( $this->_tpl_vars['errorArray']['matchcheck'] )): ?>
			<tr><td class="left_col" style="color: red" colspan="2"><h4><?php echo $this->_tpl_vars['errorArray']['matchcheck']; ?>
</h4></td></tr>           
		  <?php endif; ?>
		  <tr>
            <td class="left_col" <?php if (isset ( $this->_tpl_vars['errorArray']['mentorship_code'] )): ?>style="color: red"<?php endif; ?>><h4>Mentorship Program:</h4></td>
			<td>
				<select id="mentorship_code" name="mentorship_code">
					<option value=""> ----- </option>
					<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['mentorshipData'],'selected' => $this->_tpl_vars['matchData']['mentorship_code']), $this);?>

				</select>
			</td>
          </tr>		
          <tr>
            <td class="left_col" <?php if (isset ( $this->_tpl_vars['errorArray']['mentor_code'] )): ?>style="color: red"<?php endif; ?>><h4>Mentor:</h4></td>
			<td colspan="3">			
				<input type="text" name="mentor_name" id="mentor_name" value="<?php echo $this->_tpl_vars['matchData']['mentorname']; ?>
" size="60" /><br />
				<input type="hidden" name="mentor_code" id="mentor_code" value="<?php echo $this->_tpl_vars['matchData']['mentor_code']; ?>
" />
				<span id="mentorname" name="mentorname"><?php echo $this->_tpl_vars['matchData']['mentorname']; ?>
</span>
			</td>				
          </tr> 	
          <tr>
            <td class="left_col" <?php if (isset ( $this->_tpl_vars['errorArray']['mentee_code'] )): ?>style="color: red"<?php endif; ?>><h4>Mentee:</h4></td>
			<td colspan="3">			
				<input type="text" name="mentee_name" id="mentee_name" value="<?php echo $this->_tpl_vars['matchData']['menteename']; ?>
" size="60" /><br />
				<input type="hidden" name="mentee_code" id="mentee_code" value="<?php echo $this->_tpl_vars['matchData']['mentee_code']; ?>
" />
				<span id="menteename" name="menteename"><?php echo $this->_tpl_vars['matchData']['menteename']; ?>
</span>
			</td>				
          </tr> 		  		
		<tr>
			<td class="left_col"><h4>Notes:</h4></td>
			<td><textarea name="match_notes" id="match_notes" rows="5" cols="50"><?php echo $this->_tpl_vars['matchData']['match_notes']; ?>
</textarea></td>
		</tr>			  				  
        </table>
      </form>
	</div>
    <div class="clearer"><!-- --></div>
        <div class="mrg_top_10">
		<a href="javascript:submitForm();" class="blue_button mrg_left_20 fl"><span>Save &amp; Complete</span></a>   
        </div>
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
	
	$( "#mentor_name" ).autocomplete({
		source: "/feeds/participants.php?type=2",
		minLength: 2,
		select: function( event, ui ) {
		
			if(ui.item.id == \'\') {
				$(\'#mentorname\').html(\'\');
				$(\'#mentor_code\').val(\'\');					
			} else {
				$(\'#mentorname\').html(\'<b>\' + ui.item.value + \'</b>\');
				$(\'#mentor_code\').val(ui.item.id);	
			}
			$(\'#mentor_name\').val(\'\');										
		}
	});
	
	$( "#mentee_name" ).autocomplete({
		source: "/feeds/participants.php?type=3",
		minLength: 2,
		select: function( event, ui ) {
		
			if(ui.item.id == \'\') {
				$(\'#menteename\').html(\'\');
				$(\'#mentee_code\').val(\'\');					
			} else {
				$(\'#menteename\').html(\'<b>\' + ui.item.value + \'</b>\');
				$(\'#mentee_code\').val(ui.item.id);	
			}
			$(\'#mentee_name\').val(\'\');										
		}
	});	
	
});
function submitForm() {
	document.forms.detailsForm.submit();					 
}
</script>
'; ?>

<!-- End Main Container -->
</body>
</html>