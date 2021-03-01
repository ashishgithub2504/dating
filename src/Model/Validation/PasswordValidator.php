<?php

namespace App\Model\Validation;

use Cake\Validation\Validator;

class PasswordValidator extends Validator {

    public $validations;

    public function __construct($isAllow = false) {
        parent::__construct();
        $validator = new Validator();
        $validator->requirePresence('password', true);
        if ($isAllow) {
            $validator->allowEmpty('password');
        } else {
            $validator->notEmpty('password', 'Password is required');
        }
        $validator
                ->add('password', [
                    'minLength' => ['rule' => ['minLength', 8], 'message' => 'Your password must be at least 8 characters long'],
                    'maxLength' => ['rule' => ['maxLength', 15], 'message' => 'Password is too long. The limit is 15 characters..'],
                    'custom' => ['rule' => [$this, 'pregMatch'], 'message' => 'Password must contain at least one small & one capital alphabet and numeric digit.']
        ]);
        
        $validator
                ->add('confirm_password', [
                    'custom' => [
                            'rule' => [$this, 'match'], 
                            'on' => function ($context) {
                                    return !empty($context['data']['password']);
                            }, 'message' => 'Your confirm password must match with your password'
                    ]
        ]);
        $this->validations = $validator;
    }

    public function password() {
        return $this->validations;
    }

    public function pregMatch($value, $context) {
        if (preg_match('/^(?=.*[a-zA-Z_@&+-])(?=.*\d)([0-9a-zA-Z_@&+-]+)$/', $context['data']['password']) && preg_match('/[A-Z]/', $context['data']['password']) && preg_match('/[a-z]/', $context['data']['password'])) {
            return true;
        } else {
            return false;
        }
    }

    public function match($value, $context) {
        if ($context['data']['password'] != "") {
            return ($value == $context['data']['password']);
        } else {
            return true;
        }
    }

    public function whenpassword($context) {
             return !empty($context['data']['password']);
    }

}
