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
                <img alt="bidr Logo" src="../img/bidr_logo_full.png" id="logo" />
            </div>
            <div id="header-search">
            	<?= $this->Form->create() ?>
                <div id="header-search-helper">
                    <div id="header-search-box">
                        <?= $this->Form->input('', ['type' => 'text']); ?>
                    </div>
                    <div id="header-search-cat-menu">
                        <select>
                            
                        </select>
                    </div>
                    <div id="header-search-button">
                        <input type="button" value="Search" />
                    </div>
                    <?= $this->Form->end() ?>                              
                </div>
            </div>
            <div id="header-links">
                <p><a href="">Sign In / Register</a></p>
                <p><a href="">Advanced Search</a></p>
            </div>
        </header>
        <div class="push"></div>
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