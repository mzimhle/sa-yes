<?php /* Smarty version 2.6.20, created on 2014-01-05 09:45:22
         compiled from administration/includes/header.tpl */ ?>
<div id="header">
    <!-- Start Heading -->
        
    <div id="heading">
        <div id="ct_logo">

        </div>
       
    </div><!-- End Heading -->
	 <?php if (isset ( $this->_tpl_vars['admin'] )): ?>
    <!-- Start Top Nav -->
    <div id="topnav"> 
            <ul>
                <li><a href="/administration/" title="Home" <?php if ($this->_tpl_vars['page'] == 'default.php' || $this->_tpl_vars['page'] == ''): ?> class="active"<?php endif; ?>>Home</a></li>
				<li><a href="/administration/campaign/" title="Campaign" <?php if ($this->_tpl_vars['page'] == 'campaign'): ?> class="active"<?php endif; ?>>Campaign</a></li>
				<li><a href="/administration/clients/" title="Clients" <?php if ($this->_tpl_vars['page'] == 'clients'): ?> class="active"<?php endif; ?>>Clients</a></li>
				<li><a href="/administration/products/" title="Products" <?php if ($this->_tpl_vars['page'] == 'products'): ?> class="active"<?php endif; ?>>Products</a></li>
				<li><a href="/administration/internal/" title="Resources" <?php if ($this->_tpl_vars['page'] == 'internal'): ?> class="active"<?php endif; ?>>Internal</a></li>
            </ul>
    </div><!-- End Top Nav -->
  <div class="clearer"><!-- --></div>
  <?php endif; ?>
</div><!--header-->
<?php if (isset ( $this->_tpl_vars['admin'] )): ?>
    <div class="logged_in">
        <ul>
            <li><a href="/administration/logout.php" title="Logout">Logout</a></li>
        </ul>
    </div><!--logged_in-->
	<?php endif; ?>
  	<br />