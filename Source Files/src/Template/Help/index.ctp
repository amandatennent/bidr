<div id="container">
<h1>Help Pages</h1>
<?= $this->Html->para(null, $this->Html->link("About Us", (['controller' => 'Help', 'action' => 'about']))) ?>
<?= $this->Html->para(null, $this->Html->link("Contact Us", (['controller' => 'Help', 'action' => 'contact']))) ?>
<?= $this->Html->para(null, $this->Html->link("Privacy", (['controller' => 'Help', 'action' => 'privacy']))) ?>
</div>