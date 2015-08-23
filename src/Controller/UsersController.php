<?php
	namespace App\Controller;
	
	use App\Controller\AppController;
	use Cake\Event\Event;
	use Cake\Network\Exception\NotFoundException;
	use Cake\Datasource\ConnectionManager;
	
	class UsersController extends AppController
	{
		public function beforeFilter(Event $event)
		{
			parent::beforeFilter($event);
			$this->Auth->allow(['add', 'logout']);
		}
		
		public function index()
		{
			// This page to redirect to site home page
			$this->set('users', $this->Users->find('all'));
		}
		
		public function view($id = null)
		{			
			// View user profile
			if (!$id) // If the id hasn't been passed
			{
				// Redirect back to home page 
				return $this->redirect(['controller' => 'Pages', 'action' => 'display', 'home']);
			}
			
			$user = $this->Users->get($id);
			$this->set(compact('user'));
			$this->set('loggedInUser', $this->Auth->user('id'));
			
			$conn = ConnectionManager::get('default');
			
			// Get active selling items
			$statement = $conn->execute("Call getUserActiveSelling($id)");
			$data = $statement->fetchAll();
			$statement->closeCursor();
			$this->set('noActiveSelling', count($data));
			
			// Get sold items
			$statement = $conn->execute("Call getUserSold($id)");
			$data = $statement->fetchAll();
			$statement->closeCursor();
			$this->set('noSold', count($data));
			
			// Get active items being bid on
			$statement = $conn->execute("Call getBidOnItems($id)");
			$data = $statement->fetchAll();
			$statement->closeCursor();
			$this->set('noActiveBids', count($data));
			
			// Get completed items that were bid on
			$statement = $conn->execute("Call getCompleteBidOnItems($id)");
			$data = $statement->fetchAll();
			$statement->closeCursor();
			$this->set('noCompleteBids', count($data));
		}
		
		public function bidding($id = null)
		{
			// Shows the user's active items that they have bid on
			// The user must be the account owner
			
			if (!$id || $this->Auth->user('id') != $id) // If the id hasn't been passed
			{
				// Redirect back to user's account page
				return $this->redirect(['controller' => 'Users', 'action' => 'view', $id]);
			}
			
			$user = $this->Users->get($id);
			$this->set(compact('user'));
			
			// Get active items being bid on
			$conn = ConnectionManager::get('default');
			$statement = $conn->execute("Call getBidOnItems($id)");
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
		
		public function ended_bid($id = null)
		{
			// Shows the user's active items that they have bid on
			// The user must be the account owner
			
			if (!$id || $this->Auth->user('id') != $id) // If the id hasn't been passed
			{
				// Redirect back to user's account page
				return $this->redirect(['controller' => 'Users', 'action' => 'view', $id]);
			}
			
			$user = $this->Users->get($id);
			$this->set(compact('user'));
			
			// Get active items being bid on
			$conn = ConnectionManager::get('default');
			$statement = $conn->execute("Call getCompleteBidOnItems($id)");
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
		
		public function selling($id = null)
		{
			// Shows the user's active items that they have bid on			
			if (!$id) // If the id hasn't been passed
			{
				// Redirect back to user's account page
				return $this->redirect(['controller' => 'Users', 'action' => 'view', $id]);
			}
			
			$user = $this->Users->get($id);
			$this->set(compact('user'));
			$this->set('loggedInUser', $this->Auth->user('id'));
			
			// Get active items being bid on
			$conn = ConnectionManager::get('default');
			$statement = $conn->execute("Call getUserActiveSelling($id)");
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
		
		public function sold($id = null)
		{
			// Shows the user's active items that they have bid on			
			if (!$id) // If the id hasn't been passed
			{
				// Redirect back to user's account page
				return $this->redirect(['controller' => 'Users', 'action' => 'view', $id]);
			}
			
			$user = $this->Users->get($id);
			$this->set(compact('user'));
			
			$this->set('loggedInUser', $this->Auth->user('id'));
			
			// Get active items being bid on
			$conn = ConnectionManager::get('default');
			$statement = $conn->execute("Call getUserSold($id)");
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
			$user = $this->Users->newEntity();
			
			if ($this->request->is('post'))
			{
				$user = $this->Users->patchEntity($user, $this->request->data);
				
				if ($this->Users->save($user))
				{
					$this->Flash->success(__('The user has been saved.'));
					return $this->redirect(['action' => 'add']);
				}
				
				$this->Flash->error(__('Unable to add the user'));
			}
			
			$this->set('user', $user);
		}
		
		public function login()
		{
			if ($this->request->is('post'))
			{
				$user = $this->Auth->identify();
				
				if ($user)
				{
					$this->Auth->setUser($user);
					return $this->redirect($this->Auth->redirectUrl());
				}
				$this->Flash->error(__('Invalid username or password, try again'));
			}
		}
		
		public function logout()
		{
			return $this->redirect($this->Auth->logout());
		}
		
		public function edit($id = null)
		{
			// Shows the user's active items that they have bid on
			// The user must be the account owner
			
			if (!$id || $this->Auth->user('id') != $id) // If the id hasn't been passed
			{
				// Redirect back to user's account page
				return $this->redirect(['controller' => 'Users', 'action' => 'view', $id]);
			}
			
			$user = $this->Users->get($id);
			$this->set('user', $user);
			
			if ($this->request->is(['post', 'put']))
			{
				$user->username = $this->request->data('username');
				$user->email = $this->request->data('email');
				$user->first_name = $this->request->data('first_name');
				$user->last_name = $this->request->data('last_name');
				
				// Check if the user updated their password
				if(strlen($this->request->data('new_password')) > 0)
				{
					$user->password = $this->request->data('new_password');
				}
				
				if ($this->Users->save($user))
				{
					$this->Flash->success(__('The user has been saved.'));
					return $this->redirect(['controller' => 'Users', 'action' => 'view', $id]);
				}
				else
				{				
					$this->Flash->error(__('Unable to add the user'));
				}
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