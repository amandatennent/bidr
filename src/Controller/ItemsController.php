<?php
	namespace App\Controller;
	
	use App\Controller\AppController;
	
	class ItemsController extends AppController
	{
		public function index()
		{
			// lists all items
			
		}
		
		public function add()
		{
			// add a new item
			
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