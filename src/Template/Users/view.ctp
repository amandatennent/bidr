<div id="container">

<?php if($user->id == $loggedInUser) : ?>
<?= $this->Html->div('edit-link', $this->Html->link('Edit User Account', ['controller' => 'Users', 'action' => 'edit', $user->id])) ?>
<?php endif ?>

<h1><?= $user->username ?></h1>
<h2>Member since <?= date_parse($user->join_date)["year"] ?></h2>

<?php if($user->id == $loggedInUser) : ?>
<?= $this->Html->link("<p>You are bidding on $noActiveBids active items</p>", ['controller' => 'Users', 'action' => 'bidding', $user->id], ['escape' => false]) ?>
<?= $this->Html->link("<p>You have bid on $noCompleteBids completed items</p>", ['controller' => 'Users', 'action' => 'ended_bid', $user->id], ['escape' => false]) ?>
<?= $this->Html->link("<p>You are selling $noActiveSelling items</p>", ['controller' => 'Users', 'action' => 'selling', $user->id], ['escape' => false]) ?>
<?= $this->Html->link("<p>You have $noSold items that you were selling</p>", ['controller' => 'Users', 'action' => 'sold', $user->id], ['escape' => false]) ?>

<?php else : ?>
<?= $this->Html->link("<p>This user is selling $noActiveSelling items</p>", ['controller' => 'Users', 'action' => 'selling', $user->id], ['escape' => false]) ?>
<?= $this->Html->link("<p>This user has sold $noSold items</p>", ['controller' => 'Users', 'action' => 'sold', $user->id], ['escape' => false]) ?>

<?php endif ?>

</div>