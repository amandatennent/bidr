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
				->add('name', 'checkNameLength', [
						'rule' => [$this, 'checkNameLength'],
						'message' => 'Name must not be over 100 characters in length.'])
				->notEmpty('description', 'A description must be entered.')
				->add('description', 'checkDescLength', [
						'rule' => [$this, 'checkDescLength'],
						'message' => 'Descriptions must not be over 20,000 characters in length.'])
				->allowEmpty('image')
				->notEmpty('start_price', 'A start price must be entered.')
				->add('start_price', 'checkStartPrice', [
					'rule' => [$this, 'checkStartPrice'],
					'message' => 'Start price must be a number greater than zero.']);
		}
		
		public function checkStartPrice($check)
		{
			// Check if it's a number
			if (is_numeric($check))
			{
				// Check if it's greater than zero
				if ($check <= 0)
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
				return false;
			}
		}
		
		public function checkNameLength($string)
		{
			// Make sure the name length is 100 characters or less
			if (strlen($string) > 100)
			{
				return false;
			}
			else
			{
				return true;
			}
		}
		
		public function checkDescLength($string)
		{
			// Make sure the description length is 20,000 or less
			if (strlen($string) > 20000)
			{
				return false;
			}
			else
			{
				return true;
			}
		}
	}
?>