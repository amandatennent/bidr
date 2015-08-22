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
<?php
	if ($item->user_id == $current_user)
	{
		echo $this->Html->div('edit-link', $this->Html->link('Edit Item', ['controller' => 'Items', 'action' => 'edit', $item->id]));
	}
?>
<h1><?= $item->name ?></h1>
<h2><?= $category_name ?></h2>
<table id="item-view">
	<tr>
		<!-- Display image -->
		<td id="item-image" rowspan="2">
			<?php
	          	if ($item->image == NULL)
	          	{
					echo "<img src='/webroot/img/auction_images/placeholder.png'/>";
	          	}
	          	else
	          	{
	           		echo "<img src='/webroot/img/auction_images/" . $item->image . "'/>";
	          	}
			?>
		</td>
		<!-- Display seller, bids and time remaining -->
		<td>
			<table id="seller-info">
				<tr>
					<td>Seller:</td>
					<td>
						<?= $this->Html->link(
							$username,
							['controller' => 'Users', 'action' => 'view', $item->user_id]);
						?>				
					</td>
				</tr>
				<tr>
					<td>Bids:</td>
					<td>
						<?php
							if ($bidCount == 0)
							{
								echo '0';
							}
							else
							{
								echo $bidCount;
							}
						?>
					</td>
				</tr>
				<tr>
					<td>Time Remaining:</td>
					<td>
						<?php
							if ($seconds_remaining <= 0)
							{
								echo "<p class='red'>Item has ended</p>";
							}
							else
							{
								if (isLessThan1Day($seconds_remaining))
				            	{
				            		echo "<p class='red'>$time_remaining</p>";
				            	}
				            	else
				            	{
				            		echo "<p class='green'>$time_remaining</p>";
				            	}
							}
						?>
					</td>
				</tr>
			</table>
		
		</td>
	</tr>
	<tr>
		<!-- Display current bid, bid input box and button -->
		<td class="bottom">
			<div class="current-bid">
				<table id="place-bid">
					<tr>
						<!-- Current Bid -->
						<td>
							<?php
								$wording = "";
								if ($seconds_remaining <= 0 && $bidCount > 0)
								{
									$wording = "Selling Price";
								}
								elseif ($seconds_remaining <= 0 && $bidCount == 0)
								{
									$wording = "This item didn't sell. Starting price was";
								}
								else
								{
									$wording = "Current Price";
								}

								if($current_bid == 0) // No bids have been placed yet
								{
									echo "<p>$wording:&nbsp;&nbsp;&nbsp;&nbsp;<b>" . $this->Number->currency($item->start_price, 'USD') . '</b></p>';
								}
								else
								{
									echo "<p>$wording:&nbsp;&nbsp;&nbsp;&nbsp;<b>" . $this->Number->currency($current_bid, 'USD') . '</b></p>';
								}
							?>
						</td>
						<!-- If the current user logged in is the seller of the item, the can't bid -->
						<!-- If there is no user logged in, they can't bid -->
						<!-- If the item has ended, no one can bid -->
						<!-- Place bid button -->
						<?= $this->Form->create() ?>
						<?php if($current_user == $item->user_id || !(isset($current_user)) || $seconds_remaining <= 0) : ?>
							<td rowspan='2'><?= $this->Form->button('Place Bid', ['class' => 'btn', 'disabled' => true])?></td>
						<?php else : ?>
							<td rowspan='2'><?= $this->Form->button('Place Bid', ['class' => 'btn', 'disabled' => false])?></td>
						<?php endif; ?>
					</tr>
					<tr>
						<!-- Place bid text box -->
						<?php if($current_user == $item->user_id || !(isset($current_user)) || $seconds_remaining <= 0) : ?>
							<td><?= $this->Form->input('amount', ['type' => 'text', 'label' => false, 'disabled' => true]) ?></td>
						<?php else : ?>
							<td><?= $this->Form->input('amount', ['type' => 'text', 'label' => false, 'disabled' => false]) ?></td>
						<?php endif; ?>

						<?= $this->Form->end() ?>
					</tr>
				</table>
			</div>
		</td>
	</tr>
</table>
<!-- Show item description -->
<h2>Description</h2>
<?= $item->description ?>
</div>