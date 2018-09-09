<?php 
class AppSchema extends CakeSchema {

    public function before($event = array()) {
        return true;
    }

    public function after($event = array()) {
    }

    public $users = [
        'id' => [
            'type'     => 'integer', 
            'null'     => false, 
            'default'  => null, 
            'unsigned' => false, 
            'key'      => 'primary'
        ],
        'username' => [
            'type'    => 'string', 
            'null'    => false, 
            'default' => null, 
            'collate' => 'utf8_general_ci', 
            'charset' => 'utf8', 
            'comment' =>'Username'
        ],
        'password' => [
            'type'    => 'string', 
            'null'    => true, 
            'default' => null, 
            'length'  => 255, 
            'collate' => 'utf8_general_ci', 
            'charset' => 'utf8',
            'comment' =>'Hash Password'
        ],
        'role' => [
            'type'     => 'integer', 
            'null'     => false, 
            'default'  => 2, 
            'unsigned' => false,
            'comment'  => "1:Admin, 2:Normal User"
        ],
        'created' => [
            'type'    => 'datetime', 
            'null'    => true, 
            'default' => null,
            'comment' =>'Created Date'
        ],
        'modified' => [
            'type'    => 'datetime', 
            'null'    => true, 
            'default' => null,
            'comment' =>'Modified Date'
        ]
    ];

    public $categories = [
        'id' => [
            'type'     => 'integer', 
            'null'     => false, 
            'default'  => null, 
            'unsigned' => false, 
            'key'      => 'primary'
        ],
        'name' => [
            'type'    => 'string', 
            'null'    => true, 
            'default' => null, 
            'length'  => 255, 
            'collate' => 'utf8_general_ci', 
            'charset' => 'utf8',
            'comment' =>'Folder name'
        ],
        'created' => [
            'type'    => 'datetime', 
            'null'    => true, 
            'default' => null,
            'comment' =>'Created Date'
        ],
        'modified' => [
            'type'    => 'datetime', 
            'null'    => true, 
            'default' => null,
            'comment' =>'Modified Date'
        ]
    ];

    public $locations = [
        'id' => [
            'type'     => 'integer', 
            'null'     => false, 
            'default'  => null, 
            'unsigned' => false, 
            'key'      => 'primary'
        ],
        'category_id' => [
            'type'     => 'integer', 
            'null'     => false, 
            'default'  => null, 
            'unsigned' => false, 
        ],
        'path' => [
            'type'    => 'string', 
            'null'    => true, 
            'default' => null, 
            'length'  => 255, 
            'collate' => 'utf8_general_ci', 
            'charset' => 'utf8',
            'comment' =>'Folder location'
        ],
        'created' => [
            'type'    => 'datetime', 
            'null'    => true, 
            'default' => null,
            'comment' =>'Created Date'
        ],
        'modified' => [
            'type'    => 'datetime', 
            'null'    => true, 
            'default' => null,
            'comment' =>'Modified Date'
        ]
    ];
}
