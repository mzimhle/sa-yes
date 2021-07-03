<?php /* Smarty version 2.6.20, created on 2014-08-21 07:52:16
         compiled from users/partners/view/details.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'users/partners/view/details.tpl', 43, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SA-YES | Users</title>
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
			<li><a href="/users/" title="">Users</a></li>
			<li><a href="/users/partners/" title="">Partners</a></li>
			<li><a href="/users/partners/view/" title="">View</a></li>
			<li><?php if (isset ( $this->_tpl_vars['partnerData'] )): ?>Edit partner<?php else: ?>Add a new partner<?php endif; ?></li>
        </ul>
	</div><!--breadcrumb--> 
  
	<div class="inner"> 
      <h2><?php if (isset ( $this->_tpl_vars['partnerData'] )): ?>Edit partner<?php else: ?>Add a new partner<?php endif; ?></h2>
    <div id="sidetabs">
        <ul > 
            <li class="active"><a href="#" title="Details">Details</a></li>
			<li><a href="<?php if (isset ( $this->_tpl_vars['partnerData'] )): ?>/users/partners/view/contact.php?code=<?php echo $this->_tpl_vars['partnerData']['partner_code']; ?>
<?php else: ?>#<?php endif; ?>" title="Contact">Contact</a></li>
        </ul>
    </div><!--tabs-->

	<div class="detail_box">
      <form id="detailsForm" name="detailsForm" action="/users/partners/view/details.php<?php if (isset ( $this->_tpl_vars['partnerData'] )): ?>?code=<?php echo $this->_tpl_vars['partnerData']['partner_code']; ?>
<?php endif; ?>" method="post">
        <table width="700" border="0" align="center" cellpadding="0" cellspacing="0" class="form">
          <tr>
            <td class="left_col error" ><h4>Partner Type:</h4></td>
			<td>
				<select id="partnertype_code" name="partnertype_code">
					<option value=""> ----- </option>
					<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['partnertypeData'],'selected' => $this->_tpl_vars['partnerData']['partnertype_code']), $this);?>

				</select>
				<?php if (isset ( $this->_tpl_vars['errorArray']['partnertype_code'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['partnertype_code']; ?>
</span><?php endif; ?>
			</td>
          </tr>		
		<tr>
			<td class="left_col error"><h4>Name:</h4></td>
			<td>
				<input type="text" name="partner_name" id="partner_name" value="<?php echo $this->_tpl_vars['partnerData']['partner_name']; ?>
" size="60"/>
				<?php if (isset ( $this->_tpl_vars['errorArray']['partnertype_code'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['partnertype_code']; ?>
</span><?php endif; ?>
			</td>
		</tr>
          <tr>
            <td class="left_col error"><h4>Area:</h4></td>
			<td colspan="3">			
				<input type="text" name="area_name" id="area_name" value="<?php echo $this->_tpl_vars['partnerData']['area_path']; ?>
" size="60" />
				<input type="hidden" name="area_code" id="area_code" value="<?php echo $this->_tpl_vars['partnerData']['area_code']; ?>
" />
				<?php if (isset ( $this->_tpl_vars['errorArray']['partnertype_code'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['partnertype_code']; ?>
</span><?php endif; ?>
			</td>				
          </tr> 		
		<tr>
			<td class="left_col"><h4>Website:</h4></td>
			<td><input type="text" name="partner_website" id="partner_website" value="<?php echo $this->_tpl_vars['partnerData']['partner_website']; ?>
" size="60"/></td>
		</tr>
		<tr>
			<td class="left_col error"><h4>Address:</h4></td>
			<td>
				<textarea name="partner_address" id="partner_address" rows="3" cols="50"><?php echo $this->_tpl_vars['partnerData']['partner_address']; ?>
</textarea>
				<?php if (isset ( $this->_tpl_vars['errorArray']['partnertype_code'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['partnertype_code']; ?>
</span><?php endif; ?>
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
    </div><!--inner-->
 </div> 	
 <?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/footer.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

</div>
<?php echo '
<script type="text/javascript">
$(document).ready(function() {	
	
	$( "#area_name" ).autocomplete({
		source: "/feeds/area.php",
		minLength: 2,
		select: function( event, ui ) {
		
			if(ui.item.id == \'\') {
				$(\'#area_name\').html(\'\');
				$(\'#area_code\').val(\'\');					
			} else {
				$(\'#area_name\').html(\'<b>\' + ui.item.value + \'</b>\');
				$(\'#area_code\').val(ui.item.id);	
			}
			$(\'#area_name\').val(\'\');										
		}
	});
	

	$("input").keypress(function(event) {
		if (event.which == 13) {
			event.preventDefault();
			$("detailsForm").submit();
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