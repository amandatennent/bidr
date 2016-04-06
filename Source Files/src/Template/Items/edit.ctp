<div id="container">
<?= $this->Html->div('edit-link', $this->Html->link('Go Back', ['controller' => 'Items', 'action' => 'view', $item->id])) ?>
<h1>Update Your Item</h1>
<?php
	echo $this->Form->create($item, ['type' => 'file']);
	
	// Item name
	echo $this->Html->div('group', $this->Form->input('name'));

	// Populate categories drop down box
	echo "<div class='group'>";
	echo "<label for='category_id'>Category</label><select name='category_id' id='category_id'>";
	foreach ($categories as $category)
	{
		if ($item->category_id == $category[0])
		{
			echo "<option value='$category[0]' selected>$category[1]</option>";
		}
		else
		{
			echo "<option value='$category[0]'>$category[1]</option>";
		}
	}
	echo "</select>";
	echo "</div>";

	// Populate durations drop down box
	echo "<div class='group'>";
	echo "<label for='duration_id'>Duration</label><select name='duration_id' id='duration_id'>";
	foreach ($durations as $duration)
	{
		if ($item->duration_id == $duration[0])
		{
			echo "<option value='$duration[0]' selected>$duration[1]</option>";
		}
		else
		{
			echo "<option value='$duration[0]'>$duration[1]</option>";
		}
	}
	echo "</select>";
	echo "</div>";
	
	// Description
	echo $this->Html->div('group', $this->Form->input('description', ['rows' => '5']));
	
	echo $this->Html->div('center', $this->Form->button('Save Changes', ['class' => 'btn']));
	echo $this->Form->end();
?>
</div>