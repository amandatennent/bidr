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

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
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
	<div class="wrapper">
		<header>
			<div class="header-logo">
			    <span class="helper"></span>
			    <img alt="bidr Logo" src="../img/bidr_logo_full.png" id="logo" />
			</div>
			<div class="header-search">
			    <div class="header-search-helper">
			        <div class="header-search-box">
			            <input class="header-search-input-text" type="search" />
			        </div>
			        <div class="header-search-cat-menu">
			            <select>
			                
			            </select>
			        </div>
			        <div class="header-search-button">
			            <input class="header-search-input-button" type="button" value="Search" />
			        </div>                                 
			    </div>
			</div>
			<div class="header-links">
			    <p><a href="">Sign In / Register</a></p>
			    <p><a href="">Advanced Search</a></p>
			</div>
		</header>
		
		
			<?= $this->fetch('title') ?>
			<?= $this->Flash->render() ?>		
			<?= $this->fetch('content') ?>
	</div>
	<footer>
    	<div class="left">
        	<p>Copyright &copy; Amanda Tennent. All Rights Reserved.</p>
        </div>
        <div class="right">
        	<p>
                <a href="">Contact Us</a>
                <a href="">About Us</a>
                <a href="">Privacy Information</a>
            </p>
        </div>
	</footer>
</body>
</html>
