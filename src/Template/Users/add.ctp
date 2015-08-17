<div class="users form">
	<?= $this->Form->create($user) ?>
		<fieldset>
			<legend><?= __('Add User') ?></legend>
			<?= $this->Form->input('username') ?>
			<?= $this->Form->input('password') ?>
			<?= $this->Form->input('email') ?>
			<?= $this->Form->input('first_name') ?>
			<?= $this->Form->input('last_name') ?>
		</fieldset>
	<?= $this->Form->button(__('Submit')); ?>
	<?= $this->Form->end() ?>
</div>