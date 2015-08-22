<?= $this->Flash->render('auth') ?>
<div id="container">
<div class="users form">
<h1>Login</h1>	
	<?= $this->Form->create() ?>
			<?= $this->Html->div('group', $this->Form->input('username')) ?>
			<?= $this->Html->div('group', $this->Form->input('password')) ?>
			<?= $this->Html->div('group', $this->Html->div('center-login', $this->Html->link('Register?', ['controller' => 'Users', 'action' => 'add']))) ?>
		<?= $this->Html->div('center-login', $this->Form->button('Login', ['class' => 'btn'])) ?>
	<?= $this->Form->end() ?>
</div>
</div>