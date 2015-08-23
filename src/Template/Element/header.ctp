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
                <?= $this->Form->input('search_string', ['type' => 'text', 'label' => false]); ?>
            </div>
            <div id="header-search-cat-menu">
                    <?= $this->Form->select(
                    	'search_cat',
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
    	<?php if ($loggedIn == true) : ?>
    		<p>
    			Hi, <?= $this->Html->link($logged_in_username . '!', ['controller' => 'Users', 'action' => 'view', $logged_in_userid]) ?>
	    		&nbsp;
    			<?= $this->Html->link('Logout?', ['controller' => 'Users', 'action' => 'logout']) ?>
   			</p>
		<?php else : ?>
    		else
    			<p>
    				<?= $this->Html->link('Sign In', ['controller' => 'Users', 'action' => 'login']) ?> | <?= $this->Html->link('Register', ['controller' => 'Users', 'action' => 'add']) ?>
   				</p>
    	<?php endif; ?>
        
        <p><a href="">Advanced Search</a></p>
    </div>
</header>