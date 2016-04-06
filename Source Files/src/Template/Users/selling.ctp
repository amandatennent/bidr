<?php
	function isLessThan1Day($seconds)
	{
		// This function will return true if the number of seconds passed is less than 1 day
		if (($seconds / 86400) > 1)
		{
			return false;
		}
		else
		{
			return true;
		}
	}
?>

<div id="container">
<h1><?= $this->Html->link($user->username, ['controller' => 'Users', 'action' => 'view', $user->id]) ?></h1>
<?php if($user->id != $loggedInUser) : ?>
<h2>Active items that '<?=$user->username?>' is selling - <?=$count_items?> items</h2>
<?php else : ?>
<h2>Active items that you are selling - <?=$count_items?> items</h2>
<?php endif ?>

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
			if (isLessThan1Day($item[3]))
			{
				echo "<p class='red'>$item[6]</p>";
			}
			else
			{
				echo "<p class='green'>$item[6]</p>";
			}
			
			// Amount
			$amount = 0;
          	if ($item[4] == null)
          	{
          		$amount = (float)$item[5];
          		echo $this->Html->para('green', $this->Number->currency($amount, 'USD'));
          	}
          	else
          	{
          		$amount = (float)$item[4];
          		echo $this->Html->para('red', $this->Number->currency($amount, 'USD'));
          	}
          	
          	
		echo '</td>';
		
		echo '</tr></table>';
		echo '<hr />';
	}
?>
</div>