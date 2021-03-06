<?php
	namespace App\Model\Table;
	
	use Cake\ORM\Table;
	use Cake\Validation\Validator;
	
	class UsersTable extends Table
	{
		public function validationDefault(Validator $validator)
		{
			return $validator
				->notEmpty('username', 'A username is required')
				->notEmpty('password', 'A password is required')
				->notEmpty('email', 'An email address is required')
				->add('email', 'validFormat', [
					'rule' => 'email',
					'message' => 'Please enter a valid email address'])
				->notEmpty('first_name', 'A first name is required')
				->notEmpty('last_name', 'A last_name is required');
		}
	}
?>