<?php
App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
/**
 * User Model
 *
 */
class User extends AppModel {

    /**
    * Validation rules
    *
    * @var array
    */
    public $validate = [
        'username' => [
            'required' => [
                'rule'    => 'notBlank',
                'message' => 'Username is required.'
            ],
            'unique' => [
                'rule'    => ['username_unique'],
                'message' => 'Username is already exists'
            ]
        ],
        'position' => [
            'required' => [
                'rule'    => 'notBlank',
                'message' => 'Position is required.'
            ],
        ],
        'password' => [
            'required' => [
                'rule'    => 'notBlank',
                'message' => 'Password is required.'
            ],
            'maxLength' => [
                'rule'    => ['maxLength', 10],
                'message' => 'Password must not exceed 10 characters.'
            ],
        ],
        'password_confirm' => [
             'compare' => [
                'rule'    => ['validate_passwords'],
                'message' => 'Password did not match.'
             ]
        ]
    ];

    /**
     * Hash password before saved.
     */
    public function beforeSave($options = []) {
        if (isset($this->data['User']['password'])) {
            $passwordHasher = new BlowfishPasswordHasher();
            $this->data['User']['password'] = $passwordHasher->hash($this->data['User']['password']);
        }
        return true;
    }

    public function validate_passwords() {
        return $this->data[$this->alias]['password'] === $this->data[$this->alias]['password_confirm'];
    }

    public function username_unique() {
        if (isset($this->data['User']['username'])) {
            $username       = $this->data['User']['username'];
            $check_username = $this->findByUsername($username);
            if (!empty($check_username)) {
                return false;
            }

            return true;
        }
    }
}
