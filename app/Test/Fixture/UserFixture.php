<?php
/**
 * User Fixture
 */
class UserFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'username' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'Username', 'charset' => 'utf8'),
		'password' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 40, 'collate' => 'utf8_general_ci', 'comment' => 'Hash Password', 'charset' => 'utf8'),
		'role' => array('type' => 'integer', 'null' => false, 'default' => '2', 'unsigned' => false, 'comment' => '1:Admin, 2:Normal User'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => 'Created Date'),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => 'Modified Date'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'username' => 'Lorem ipsum dolor sit amet',
			'password' => 'Lorem ipsum dolor sit amet',
			'role' => 1,
			'created' => '2018-09-01 05:09:54',
			'modified' => '2018-09-01 05:09:54'
		),
	);

}
