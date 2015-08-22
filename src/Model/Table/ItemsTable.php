<?php
	namespace App\Model\Table;
	
	use Cake\ORM\Table;
	use Cake\Validation\Validator;
	
	class ItemsTable extends Table
	{
		public function validationDefault(Validator $validator)
		{
			return $validator
				->notEmpty('name', 'A name must be entered.')
				->notEmpty('description', 'A description must be entered.')
				->allowEmpty('image')
				->notEmpty('start_price', 'A start price must be entered.')
				->add('start_price', 'numeric', [
					'rule' => 'numeric',
					'message' => 'Start price must be a number.']);
		}
	}
?>