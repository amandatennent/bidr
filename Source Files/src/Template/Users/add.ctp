<div id="container">
<div class="users form">
<h1>Register</h1>
	<?= $this->Form->create($user) ?>
		<?= $this->Html->div('group', $this->Form->input('username')) ?>
		<?= $this->Html->div('group', $this->Form->input('password')) ?>
		<?= $this->Html->div('group', $this->Form->input('email')) ?>
		<?= $this->Html->div('group', $this->Form->input('first_name')) ?>
		<?= $this->Html->div('group', $this->Form->input('last_name')) ?>
	<?= $this->Html->div('center-login', $this->Form->button('Register', ['class' => 'btn'])) ?>
	<?= $this->Form->end() ?>
</div>
</div>