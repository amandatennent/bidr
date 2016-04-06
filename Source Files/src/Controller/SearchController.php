<?php
	namespace App\Controller;
	
	use App\Controller\AppController;
	use Cake\Datasource\ConnectionManager;
	use Cake\Event\Event;
	
	class SearchController extends AppController
	{
		public function beforeFilter(Event $event)
		{
			parent::beforeFilter($event);
			$this->Auth->allow();
		}
		public function index()
		{
			// Redirect to home page
			return $this->redirect(['controller' => 'Pages', 'action' => 'display', 'home']);
		}
		
		public function results()
		{
			// Shows restults. Unsure if results will be passes as a parameter at this point.
			if($this->request->is('post'))
			{
				// Search string -> must be 50 characters or less
				$searchString = $this->request->data('search_string');
				if(strlen($this->request->data('search_string')) > 50)
				{
					$this->Flash->error(__('Your search string was too long.'));
					return $this->redirect($this->request->referer());
				}
				
				// Category -> must be 50 characters or less
				$catString = $this->request->data('search_cat');
				if(strlen($this->request->data('search_cat')) > 50)
				{
					$this->Flash->error(__('Your category was too long.'));
					return $this->redirect($this->request->referer());
				}				
								
				// Get all items that match search criteria
				$conn = ConnectionManager::get('default');
				$statement = $conn->execute("Call runBasicSearch('$searchString', '$catString')");
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
			else
			{
				// If a search hasn't been posted, redirect user to advanced search page
				return $this->redirect(['controller' => 'Search', 'action' => 'index']);
			}
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