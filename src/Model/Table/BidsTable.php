<?php
	namespace App\Model\Table;
	
	use Cake\ORM\Table;
	use Cake\Validation\Validator;
	
	class BidsTable extends Table
	{
		public function validationDefault(Validator $validator)
		{
			return $validator
				->notEmpty('amount', 'An amount must be entered')
				->add('amount', 'checkAmount', [
					'rule' => [$this, 'checkAmount'],
					'message' => 'Bid amount must be a number greater than zero']);
		}
		
		public function checkAmount($amount)
		{
			// Check if it's a number
			if (is_numeric($amount))
			{
				// Check if it's greater than zero
				if ($amount <= 0)
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
	}
?>