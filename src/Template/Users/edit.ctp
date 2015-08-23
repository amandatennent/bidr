<div id="container">
<?= $this->Html->div('edit-link', $this->Html->link('Go Back', ['controller' => 'Users', 'action' => 'view', $user->id])) ?>
<div class="users form">
<h1>Register</h1>
	<?= $this->Form->create($user) ?>
		<?= $this->Html->div('group', $this->Form->input('username')) ?>
		<?= $this->Html->div('group', $this->Form->input('new_password', ['type' => 'password', 'default' => false, 'label' => "Password (Leave blank if you don't want to change your password)"])) ?>
		<?= $this->Html->div('group', $this->Form->input('email')) ?>
		<?= $this->Html->div('group', $this->Form->input('first_name')) ?>
		<?= $this->Html->div('group', $this->Form->input('last_name')) ?>
	<?= $this->Html->div('center-login', $this->Form->button('Update Account', ['class' => 'btn'])) ?>
	<?= $this->Form->end() ?>
</div>
</div>