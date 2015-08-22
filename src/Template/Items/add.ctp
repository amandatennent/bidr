<h1>What are you selling?</h1>
<?php
	echo $this->Form->create($item, ['type' => 'file']);
	
	// Item name
	echo $this->Html->div('group', $this->Form->input('name'));

	// Populate categories drop down box
	echo "<div class='group'>";
	echo "<label for='category_id'>Category</label><select name='category_id' id='category_id'>";
	foreach ($categories as $category)
	{
		echo "<option value='$category[0]'>$category[1]</option>";
	}
	echo "</select>";
	echo "</div>";
	
	// Upload picture
	echo $this->Form->hidden('MAX_FILE_SIZE', ['value' => 5000000]);
	echo $this->Html->div('group', $this->Form->label('image', 'Picture') . $this->Form->file('image'));

	// Populate durations drop down box
	echo "<div class='group'>";
	echo "<label for='duration_id'>Duration</label><select name='duration_id' id='duration_id'>";
	foreach ($durations as $duration)
	{
		echo "<option value='$duration[0]'>$duration[1]</option>";
	}
	echo "</select>";
	echo "</div>";
	
	// Start price
	echo $this->Html->div('group', $this->Form->input('start_price', ['type' => 'text']));
	
	// Description
	echo $this->Html->div('group', $this->Form->input('description', ['rows' => '5']));
	
	echo $this->Html->div('center', $this->Form->button('Sell Item', ['class' => 'btn']));
	echo $this->Form->end();
?>