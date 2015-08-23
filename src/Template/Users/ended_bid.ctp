<div id="container">
<h1><?= $this->Html->link($user->username, ['controller' => 'Users', 'action' => 'view', $user->id]) ?></h1>
<h2>Completed items that you have bid on - <?=$count_items?> items</h2>

<?php
	$img_dir = 'auction_images/';
	foreach($items as $item)
	{
		// Image
		echo "<table class='item-index'><tr><td rowspan='2'>";
		if ($item[2] == null)
		{
			echo $this->Html->image($img_dir . 'placeholder.png');
		}
		else
		{
			echo $this->Html->image($img_dir . $item[2]);
		}
		
		echo '</td>';
		
		// Title
		echo "<td>" . $this->Html->link($item[1], ['controller' => 'Items', 'action' => 'view', $item[0]]) . "</td>";
		echo "</tr><tr>";
		echo '<td>';
			// Time remaining
			echo "<p class='red'>Item Ended</p>";

			
			// Amount
			$amount = 0;
          	if ($item[4] == null)
          	{
          		$amount = (float)$item[5];
          	}
          	else
          	{
          		$amount = (float)$item[4];
          	}
          	
          	echo $this->Html->para(null, $this->Number->currency($amount, 'USD'));
		echo '</td>';
		
		echo '</tr></table>';
		echo '<hr />';
	}
?>
</div>