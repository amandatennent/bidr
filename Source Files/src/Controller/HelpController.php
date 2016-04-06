<?php
	namespace App\Controller;
	
	use App\Controller\AppController;
	use Cake\Event\Event;
	
	class HelpController extends AppController
	{
		public function beforeFilter(Event $event)
		{
			parent::beforeFilter($event);
			$this->Auth->allow();
		}
			
		public function index()
		{
			// Lists all help options
			
		}
		
		public function contact()
		{
			// Contact Us page
			
		}
		
		public function about()
		{
			// About us page
			
		}
		
		public function privacy()
		{
			// Privacy Policy
		}
	}
?>