<?php
	namespace App\Controller;
	
	use App\Controller\AppController;
	use Cake\ORM\TableRegistry;
	use Cake\Datasource\ConnectionManager;
	use App\Controller\DateTime;
	
	class ItemsController extends AppController
	{			
		public function index()
		{
			// Save all items in an array
			$conn = ConnectionManager::get('default');
			$statement = $conn->execute('Call populateItemIndex()');
	   		$data = $statement->fetchAll();
	   		$statement->closeCursor();
	   		
	   		$items = array();
						
			// Add the time remaining string to each item and save all in an array
			$counter = 0;
			foreach ($data as $object)
			{
				$temp = array();
				for ($i = 0; $i < 6; $i++)
				{
					$temp[$i] = $object[$i];
				}
				
				$temp[6] = $this->convertToTime($object[3]);
				$items[$counter] = $temp;
				$counter++;
			}
			
			$this->set(compact('items'));
			$this->set('count_items', count($items));
			
		}
		
		public function add()
		{
			// add a new item
			$item = $this->Items->newEntity();
			$conn = ConnectionManager::get('default');
			
			if($this->request->is('post'))
			{
				$item = $this->Items->patchEntity($item, $this->request->data);
				$item->user_id = $this->Auth->user('id');
								
				// Check if an image was uploaded
				if ($this->request->data['image']['size'] == 0)
				{
					$item->image = null;
				}
				else
				{
					// Get the next number to add to the end of the image file
			   		$statement = $conn->execute('Call getImageNumber()');
			   		$items = $statement->fetchAll();
			   		$statement->closeCursor();
			   		$number = $items[0][0];
			   		
			   		// Get file info and upload file
					$upload_dir = '/var/www/html/webroot/img/auction_images/';
					$file_name = $this->request->data['image']['name'];
					$filepart = explode(".", $file_name);
					$ext = end($filepart);
					$new_file_name = "image" . $number . "." . $ext;
					$origin = $this->request->data['image']['tmp_name'];
					$uploadfile = $upload_dir . $new_file_name;
					move_uploaded_file($this->request->data['image']['tmp_name'], $uploadfile);
					$item->image = $new_file_name;
				}	   		
				
				if($this->Items->save($item))
				{
					// Insert the end date
					$statement = $conn->execute("Call updateEndTime($item->id)");
					$statement->closeCursor();
					
					$this->Flash->success(__("Your item has been listed."));
					return $this->redirect(['controller' => 'Pages', 'action' => 'display', 'home']);
				}
				
				$this->Flash->error(__('Unable to list your item'));
			}
			
			$this->set('item', $item);
			
			// Get a list of available categories
			$data = TableRegistry::get('Categories');
			$categories = $data->find();
			
			$items = array();
			$counter = 0;
			
			foreach($categories as $category)
			{
				$item = array();
				$item[0] = $category->get('id');
				$item[1] = $category->get('name');
				$items[$counter] = $item;
				$counter++;
			}
			
			$this->set('categories', $items);
			
			
			// Get a list of available durations
			//$data = TableRegistry::get('Durations');
			//$durations = $data->find();
			
	   		$statement = $conn->execute('Call getDurations()');
	   		$durations = $statement->fetchAll();
	   		$statement->closeCursor();
			
			$items = array();
			$counter = 0;
			
			foreach($durations as $duration)
			{
				$item = array();
				$item[0] = $duration[0];
				$item[1] = $duration[1];
				$items[$counter] = $item;
				$counter++;
			}
			
			$this->set('durations', $items);
			
		}
		
		public function edit($item_id = null)
		{
			if (!$item_id) // If the id hasn't been passed
			{
				$this->Flash->error(__('A item must be selected to edit.'));
				return $this->redirect(['controller' => 'Pages', 'action' => 'display', 'home']);		
			}
			
			$item = $this->Items->get($item_id);
			
			$this->set('item', $item);
			
			// Make sure the user editing the item is the owner of the item
			$logged_in_user = $this->Auth->user('id');
			if ($logged_in_user != $item->user_id)
			{
				$this->Flash->error(__('You are only able to edit your own items.'));
				return $this->redirect(['controller' => 'Pages', 'action' => 'display', 'home']);
			}
			
			$conn = ConnectionManager::get('default');
			
			// Get a list of available categories
			$data = TableRegistry::get('Categories');
			$categories = $data->find();
			
			$items = array();
			$counter = 0;
			
			foreach($categories as $category)
			{
				$data = array();
				$data[0] = $category->get('id');
				$data[1] = $category->get('name');
				$items[$counter] = $data;
				$counter++;
			}
			
			$this->set('categories', $items);
			
			
			// Get a list of available durations			
	   		$statement = $conn->execute('Call getDurations()');
	   		$durations = $statement->fetchAll();
	   		$statement->closeCursor();
			
			$items = array();
			$counter = 0;
			
			foreach($durations as $duration)
			{
				$data = array();
				$data[0] = $duration[0];
				$data[1] = $duration[1];
				$items[$counter] = $data;
				$counter++;
			}
			
			$this->set('durations', $items);	
						
			// When 'Save Changes' is clicked
			if($this->request->is(['post', 'put']))
			{
				$this->Items->patchEntity($item, $this->request->data);
				$item->user_id = $this->Auth->user('id');
				
				// Images and start prices can't be edited.
				
				if($this->Items->save($item))
				{
					// Insert the end date
					$statement = $conn->execute("Call updateEndTime($item->id)");
					$statement->closeCursor();
					
					$this->Flash->success(__("Your item has been updated."));
					return $this->redirect(['controller' => 'Items', 'action' => 'view', $item_id]);
				}
				
				$this->Flash->error(__('Unable to list your item'));
			}
					
		}
		
		public function view($id = null)
		{
			// view individual item
			
			if (!$id) // If the id hasn't been passed
			{
				// Redirect back to items index 
				return $this->redirect(['controller' => 'Items', 'action' => 'index']);				
			}
			
			$item = $this->Items->get($id);
			$this->set(compact('item'));

			// Get extra data required for page			
			$conn = ConnectionManager::get('default');
	   		$statement = $conn->execute("Call getItemViewInfo($id)");
	   		$items = $statement->fetchAll();
	   		$statement->closeCursor();
	   		
	   		$current_bid = $items[0][2];
	   		$this->set('username', $items[0][0]);
	   		$this->set('bidCount', $items[0][3]);
	   		$this->set('seconds_remaining', $items[0][1]);
	   		$this->set('current_bid', $current_bid);
	   		$this->set('category_name', $items[0][4]);
	   		
	   		// Get string version of remaining time
	   		$string = $this->convertToTime($items[0][1]);
	   		$this->set('time_remaining', $string);
	   		
	   		// Get current logged in user
	   		$current_user = $this->Auth->user('id');
	   		$this->set('current_user', $current_user);
	   		
	   		// Create a bid entity
			$bid = TableRegistry::get('Bids')->newEntity();
			
			if($this->request->is('post'))
			{
				$bid->user_id = $current_user;
				$bid->item_id = $item->id;
				$bid->amount = $this->request->data['amount'];
				
				// Check entered bid amount is valid
				if ($this->checkValidBid($bid->amount, $item->start_price, $current_bid))
				{
					if(TableRegistry::get('Bids')->save($bid))
					{					
						$this->Flash->success(__("Your bid has been placed."));
						return $this->redirect(['controller' => 'Items', 'action' => 'view', $id]);
					}
					else
					{
						$this->Flash->error(__('Unable to place your bid.'));
					}
				}
				else
				{
					$this->Flash->error(__('You have entered an invalid bid amount.'));
				}
			}
		}
		
		public function delete($id)
		{
			// delete item
		}
		
		private function convertToTime($seconds)
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
		
		private function checkValidBid($bid_amount, $start_price, $current_bid)
		{
			// Bid must be numeric, and greater than the current price
			if (is_numeric($bid_amount))
			{
				if ($current_bid == 0)
				{
					if ($bid_amount <= $start_price)
					{
						return false;
					}
					else
					{
						return true;
					}
				}
				else
				{
					if ($bid_amount <= $current_bid)
					{
						return false;
					}
					else
					{
						return true;
					}
				}
			}
			else
			{
				return false;
			}
		}
	}
?>