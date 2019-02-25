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
        'position' => [
            'type'    => 'string', 
            'null'    => false, 
            'default' => null, 
            'collate' => 'utf8_general_ci', 
            'charset' => 'utf8', 
            'comment' =>'Position'
        ],
        'deleted' => [
            'type'    => 'integer',
            'null'    => false,
            'default' => 0
        ],
        'deleted_date' => [
            'type'    => 'datetime', 
            'null'    => true, 
            'default' => null
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
        ],
        'indexes' => [
            'PRIMARY' => ['column' => 'id', 'unique' => 1],
        ],
        'tableParameters' => ['charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB']
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
        'deleted' => [
            'type'    => 'integer',
            'null'    => false,
            'default' => 0
        ],
        'deleted_date' => [
            'type'    => 'datetime', 
            'null'    => true, 
            'default' => null
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
        ],
        'indexes' => [
            'PRIMARY' => ['column' => 'id', 'unique' => 1],
        ],
        'tableParameters' => ['charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB']
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
        'deleted' => [
            'type'    => 'integer',
            'null'    => false,
            'default' => 0
        ],
        'deleted_date' => [
            'type'    => 'datetime', 
            'null'    => true, 
            'default' => null
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
        ],
        'indexes' => [
            'PRIMARY' => ['column' => 'id', 'unique' => 1],
        ],
        'tableParameters' => ['charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB']
    ];

    public $archives = [
        'id' => [
            'type'           => 'integer', 
            'null'           => false, 
            'default'        => null, 
            'unsigned'       => false, 
            'key'            => 'primary'
        ],
        'location_id' => [
            'type'     => 'integer', 
            'null'     => false, 
            'default'  => null, 
            'unsigned' => false
        ],
        'control_number' => [
            'type'     => 'integer', 
            'null'     => false, 
            'default'  => null, 
            'unsigned' => false
        ],
        'image' => [
            'type'     => 'string', 
            'null'     => true, 
            'default'  => null, 
            'length'   => 255, 
            'collate'  => 'utf8_general_ci', 
            'unsigned' => false,
            'charset'  => 'utf8',
            'comment'  =>'image name'
        ],
        'description' => [
            'type'    => 'string', 
            'null'    => true, 
            'default' => null, 
            'length'  => 255, 
            'collate' => 'utf8_general_ci', 
            'charset' => 'utf8',
            'comment' =>'file description'
        ],
        'deleted' => [
            'type'    => 'integer',
            'null'    => false,
            'default' => 0
        ],
        'deleted_date' => [
            'type'    => 'datetime', 
            'null'    => true, 
            'default' => null
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
        ],
        'indexes' => [
            'PRIMARY' => ['column' => 'id', 'unique' => 1],
        ],
        'tableParameters' => ['charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB']
    ];

    public $logs = [
        'id' => [
            'type'     => 'integer', 
            'null'     => false, 
            'default'  => null, 
            'unsigned' => false, 
            'key'      => 'primary'
        ],
        'description' => [
            'type'    => 'string', 
            'null'    => true, 
            'default' => null, 
            'length'  => 255, 
            'collate' => 'utf8_general_ci', 
            'charset' => 'utf8'
        ],
        'deleted' => [
            'type'    => 'integer',
            'null'    => false,
            'default' => 0
        ],
        'deleted_date' => [
            'type'    => 'datetime', 
            'null'    => true, 
            'default' => null
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
        ],
        'indexes' => [
            'PRIMARY' => ['column' => 'id', 'unique' => 1],
        ],
        'tableParameters' => ['charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB']
    ];
}
