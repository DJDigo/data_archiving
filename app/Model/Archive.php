<?php
App::uses('AppModel', 'Model');
/**
 * Archive Model
 *
 * @property Location $Location
 */
class Archive extends AppModel {


    // The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
    public $belongsTo = array(
        'Location' => array(
            'className' => 'Location',
            'foreignKey' => 'location_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

    public $validate = [
        'control_number' => [
            'required' => [
                'rule' => 'notBlank',
                'message' => 'Control Number is required.'
            ],
            'unique_number' => [
                'rule' => 'unique_control_number',
                'message' => 'Control number already exists.'
            ]
        ],
        'image' => [
            'unique_filename' => [
                'rule' => 'unique_filename',
                'message' => 'Image filename already exists'
            ]
        ]
    ];

    public function unique_control_number() {
        $data = $this->data['Archive'];
        $check = $this->find('first', [
            'conditions' => [
                'Archive.control_number' => $data['control_number'],
                'Archive.deleted' => 0 
            ]
        ]);

        if ($check) {
            return false;
        }
        return true;
    }

    public function unique_filename() {
        $data = $this->data['Archive'];
        $check = $this->find('first', [
            'conditions' => [
                'Archive.image' => $data['image'],
                'Archive.deleted' => 0 
            ]
        ]);

        if ($check) {
            return false;
        }
        return true;
    }
    
}
