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
			// lists all items
			
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
				//$item[0] = $duration->get('id');
				//$item[1] = $duration->get('name');
				$item[0] = $duration[0];
				$item[1] = $duration[1];
				$items[$counter] = $item;
				$counter++;
			}
			
			$this->set('durations', $items);
			
		}
		
		public function edit($id)
		{
			// edit item (make sure the user editing is the owner of the item)
			if (!$id) // If the id hasn't been passed
			{
				// Do something...
				
			}			
		}
		
		public function view($id)
		{
			// view individual item
			
			if (!$id) // If the id hasn't been passed
			{
				// Do something...
				
			}
			
			$item = $this->Items->get($id);
			$this->set(compact('item'));
			
		}
		
		public function delete($id)
		{
			// delete item
		}
	}
?>