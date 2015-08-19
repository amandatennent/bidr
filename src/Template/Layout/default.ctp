<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$description = 'bidr';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $description ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('bidr.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <div id="wrapper">
        <header>
            <div id="header-logo">
                <span id="helper"></span>
                <img alt="bidr Logo" src="/img/bidr_logo_full.png" id="logo" />
            </div>
            <div id="header-search">
            	<?= $this->Form->create(null, [
            		'url' => ['controller' => 'Search', 'action' => 'results']
            	]); ?>
                <div id="header-search-helper">
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
        
        
    <div id="container">

        <div id="content">
            <?= $this->Flash->render() ?>
			<!-- title: <?= $this->fetch('title') ?> -->
            <div class="row">
                <?= $this->fetch('content') ?>
            </div>
        </div>
    </div>
        
        
        
        
    </div>
    <footer>	
    	<div class="left">
        	<p>Copyright &copy; Amanda Tennent. All Rights Reserved.</p>
        </div>
        <div class="right">
        	<p>
                <a href='/help/contact/'>Contact Us</a>
                <a href='/help/about/'>About Us</a>
                <a href='/help/privacy'>Privacy Information</a>
            </p>
        </div>
    </footer>
</body>
</html>