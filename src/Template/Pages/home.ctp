<div id="home-menu">
	<div id="table-helper">
		<?php
			function convertToTime($seconds)
			{
				// This function converts the seconds pass to a date string				
				// Calculate number of days
				$days = intval($seconds / 86400);
				$seconds = $seconds % 86400;
				
				// Calculate number of hours
				$hours = intval($seconds / 3600);
				$seconds = $seconds % 3600;
				
				// Calculate number of minutes
				$minutes = intval($seconds / 60);
				
				// Calculate number of seconds
				$seconds = $seconds % 60;
				
				$string = "$days days, $hours hours, $minutes minutes and $seconds seconds";
				return $string;
				
			}
			
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
			
			foreach($category_names1 as $category)
			{
				echo $this->Html->link(
					$this->Html->div(
						'row-helper',
						$this->Html->div(
							'home-menu-div',
							$category[1]
						)
					),
					array('controller' => 'categories', 'action' => 'view', $category[0]),
					array('escape' => false)
				);
			}
		?>
	</div>
</div>
<div id="home-content">
    <div id="home-heading">
    	<h1>Check out our recently listed items...</h1>
    </div>
    <div id="auction-display"> <!-- Box -->
    	<!-- Check if there were enough items returned from stored procedure to show items on the home page -->
    	<?php if (count($items) != 4): ?>
    		<!-- Show message to user -->
    		<?php
    			echo "<div class='no-items'>";
    			echo "<img class='sad-face' src='/webroot/img/sad_face.png' />";
    			echo $this->Html->para(null, "It doesn't look like we have enough items to show you...");
    			echo $this->Html->link(
    				$this->Html->para(null, 'Would you like to sell something?'),
    				array('controller' => 'items', 'action' => 'add'),
    				array('escape' => false)
   				);
   				echo "</div>";
    		?>
    	<?php else: ?>
    		<!-- Show content to user -->
			<table>
	        	<tr>
		            <!-- Auction image -->
		            <?php
		            	// Auction image
		            	if ($items[0][3] == NULL)
		            	{
							echo "<td id='item0_image' class='show-item display-image' rowspan='2' colspan='3'><img src='/webroot/img/auction_images/placeholder.png'/></td>";
		            	}
		            	else
		            	{
			            	echo "<td id='item0_image' class='show-item display-image' rowspan='2' colspan='3'><img src='/webroot/img/auction_images/" . $items[0][3] . "'/></td>";
		            	}
			            
		            	for($i = 1; $i < count($items); $i++)
		            	{
		            		if ($items[$i][3] == NULL)
		            		{
		            			echo "<td id='item" . $i . "_image' class='hide-item display-image' rowspan='2' colspan='3'><img src='/webroot/img/auction_images/placeholder.png'/></td>";
		            		}
		            		else
		            		{
			            		echo "<td id='item" . $i . "_image' class='hide-item display-image' rowspan='2' colspan='3'><img src='/webroot/img/auction_images/" . $items[$i][3] . 
	"'/></td>";
		            		}
		            	}
		            	
		            	// Auction title
		            	echo "<td id='item0_title' colspan='2' class='show-item display-title'>" . $items[0][1] . "</td>";
		            	
		            	for($i = 1; $i < count($items); $i++)
		            	{
		            		echo "<td id='item" . $i . "_title' colspan='2' class='hide-item display-title'>" . $items[$i][1] . "</td>";
		            	}
		            ?>
	            </tr>
	            <tr>
		            <!--Auction time left, price and place bid button -->
		            <?php
		            	// Calculate time left
		            	echo "<td id='item0_controls' colspan='2' class='show-item display-controls'>";
		            	
		            	if (isLessThan1Day($items[0][4]))
		            	{
		            		echo "<p class='red'>" . convertToTime($items[0][4]) . "</p>";
		            	}
		            	else
		            	{
		            		echo "<p class='green'>" . convertToTime($items[0][4]) . "</p>";
		            	}
		            	
		            	$amount = 0;
		            	if ($items[0][5] == null)
		            	{
		            		$amount = (float)$items[0][6];
		            	}
		            	else
		            	{
		            		$amount = (float)$items[0][5];
		            	}
		            	
		            	echo $this->Html->para(null, $this->Number->currency($amount, 'USD'));
	      	       		echo $this->Html->para(null, 
	      	       			$this->Html->link(
		            		'Place Bid',
		            		array('controller' => 'items', 'action' => 'view', $items[0][0]),
		            		array('class' => 'btn', 'role' => 'button', 'escape' => false))
	      	       		);             	
		            	
		            	echo "</td>";
		            	
		            	for($i = 1; $i < count($items); $i++)
		            	{
		            		echo "<td id='item" . $i . "_controls' colspan='2' class='hide-item display-controls'>";
		            		
		            		if (isLessThan1Day($items[0][4]))
		            		{
		            			echo "<p class='red'>" . convertToTime($items[0][4]) . "</p>";
		            		}
		            		else
		            		{
		            			echo "<p class='green'>" . convertToTime($items[0][4]) . "</p>";
		            		}
	
			            	
			            	$amount = 0;
			            	if ($items[$i][5] == null)
			            	{
			            		$amount = (float)$items[$i][6];
			            	}
			            	else
			            	{
			            		$amount = (float)$items[$i][5];
			            	}
			            	
			            	echo $this->Html->para(null, $this->Number->currency($amount, 'USD'));
   		      	       		echo $this->Html->para(null, 
		      	       			$this->Html->link(
			            		'Place Bid',
			            		array('controller' => 'items', 'action' => 'view', $items[$i][0]),
			            		array('class' => 'btn', 'role' => 'button', 'escape' => false))
	      	       			);  
			            	
			            	echo "</td>";
		            	}
		            ?>
	            
	            <tr class="small-items">
		            <td class="hack"></td>
		            
		            <?php
			            echo "<td class='selected-item'>";
		            	echo $this->Html->link(
		            		$this->Html->div(
		            			null,
		            			$this->Html->para(null, $items[0][1]) . $this->Html->para('bold', $items[0][2]),
		            			array('escape' => false)
		            		), 
		            		array('controller' => 'items', 'action' => 'view', $items[0][0]),
		            		array('escape' => false)
	            		);
	            		echo "</td>";
	            		
	            		for($i = 1; $i < count($items); $i++)
	            		{
	            			echo "<td class='not-selected-item'>";
	            			echo $this->Html->link(
			            		$this->Html->div(
			            			null,
			            			$this->Html->para(null, $items[$i][1]) . $this->Html->para('bold', $items[$i][2]),
			            			array('escape' => false)
		            			), 
			            		array('controller' => 'items', 'action' => 'view', $items[$i][0]),
			            		array('escape' => false)
		    	        	);
		            		echo "</td>";
	            		}
		            ?>
	            </tr>
	        </table>
        <?php endif ?>
    </div>
</div>