<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Flash');
        $this->loadComponent('Auth', [
        	'loginRedirect' => [
        		'controller' => 'Items',
        		'action' => 'index'
       		],
       		'logoutRedirect' => [
       			'controller' => 'Pages',
       			'action' => 'display',
       				'home'
 			]
		]);
		
		// Load Categories
        $data = TableRegistry::get('Categories');
        $categories = $data->find();
 
        $items = array();
        
        foreach($categories as $category)
        {
        	$items[$category->get('name')] = $category->get('name');
        }
        
        $this->set('category_names', $items);
        
        // Check if user is logged in. Save the username.
        $loggedIn = false;
        $username = NULL;
        $user_id = NULL;
        
        if ($this->Auth->user())
        {
        	$loggedIn = true;
        	$username = $this->Auth->user('username');
        	$user_id = $this->Auth->user('id');
        }
        
        $this->set('loggedIn', $loggedIn);
        $this->set('logged_in_username', $username);
        $this->set('logged_in_userid', $user_id);
    }
    
    public function beforeFilter(Event $event)
    {
    	$this->Auth->deny();
    }
}
