<div id="container">

<h1>Categories</h1>
<ul>

<?php
	foreach($categories as $category)
	{
		echo '<li>' . $this->Html->link($category->name, ['controller' => 'Categories', 'action' => 'view', $category->id]) . '</li>';
	}
?>

</ul>
</div>