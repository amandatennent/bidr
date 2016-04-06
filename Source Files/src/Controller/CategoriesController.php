<?php
	namespace App\Controller;
	
	use App\Controller\AppController;
	use Cake\Datasource\ConnectionManager;
	use Cake\Event\Event;
	
	class CategoriesController extends AppController
	{
		public function beforeFilter(Event $event)
		{
			parent::beforeFilter($event);
			$this->Auth->allow();
		}
		
		public function index()
		{
			// Lists all categories
			$categories = $this->Categories->find('all');
			$this->set(compact('categories'));
		}
		
		public function view($id = null)
		{
			// Lists all items within a category
			if (!$id) // If the id hasn't been passed
			{
				$this->Flash->error(__('A category must be selected first'));
				return $this->redirect(['controller' => 'Categories', 'action' => 'index']);		
			}
			
			// Save the category
			$category = $this->Categories->get($id);
			$this->set('category', $category);
			
			// Get all items in category
			$conn = ConnectionManager::get('default');
			$statement = $conn->execute("Call getCatItems($id)");
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
	}
?>