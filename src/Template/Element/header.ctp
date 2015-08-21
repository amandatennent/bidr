<header>
    <div id="header-logo">
        <span id="helper"></span>
        <a href='/'><img alt="bidr Logo" src="/img/bidr_logo_full.png" id="logo" /></a>
    </div>
    <div id="header-search">
    	<?= $this->Form->create(null, [
    		'url' => ['controller' => 'Search', 'action' => 'results']
    	]); ?>
        <div id="table-helper">
            <div id="header-search-box">
                <?= $this->Form->input('', ['type' => 'text']); ?>
            </div>
            <div id="header-search-cat-menu">
                    <?= $this->Form->select(
                    	'field',
                    	$category_names,
                    	['empty' => '(choose a category)']
                    ); ?>
            </div>
            <div id="header-search-button">
            	<?= $this->Form->button(__('Search')); ?>
            </div>
            <?= $this->Form->end() ?>                              
        </div>
    </div>
    <div id="header-links">
    	<!-- If the user is logged in, show them their username -->
    	<?php
    		if ($loggedIn == true)
    		{
    			echo "<p>Hi, <a href=''>$username!</a>&nbsp;&nbsp;";
    			echo "<a href='/users/logout/'>Logout?</a></p>";
    			
    		}
    		else
    		{
    			echo "<p><a href='/users/login/'>Sign In</a> ";
    			echo " | <a href='/users/add/'>Register</a></p>";
    		}
    	?>
        
        <p><a href="">Advanced Search</a></p>
    </div>
</header>