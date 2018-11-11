<?php
App::uses('AppController', 'Controller');
/**
 * Locations Controller
 *
 * @property Location $Location
 * @property PaginatorComponent $Paginator
 */
class LocationsController extends AppController {

/**
 * Components
 *
 * @var array
 */
    public $components = array('Paginator');


    /**
     * Adding folder
     * AJAX
     */
    public function add () {
        $this->autoRender = false;
        if ($this->request->is('ajax')) {
            $this->Category = ClassRegistry::init('Category');
            $data           = $this->request->data;
            $category       = $data['name'];
            $split_category = explode('/', $category); 
            $path           = APP . "webroot/files/". $category;

            if (!file_exists($path . '/')) {
                mkdir($path, 0777, true);
            }

            $category_id = '';
            //check category if already exists
            $exist = $this->Category->find('first', [
                'conditions' => ['name' => $split_category[0]]
            ]);
            if (!$exist) {
                if ($this->Category->save(['name' => $category])) {
                    $category_id = $this->Category->id;
                }
            }
            $location_data = [
                'category_id' => !empty($category_id) ? $category_id : $exist['Category']['id'],
                'path'        => $path 
            ];
            if ($this->Location->save($location_data)) {
                return json_encode(['success' => 'successfully created folder']);
            }
        }
    }

    /**
     * Edit folder
     * AJAX
     */
    public function edit() {
        $this->autoRender = false;
        if ($this->request->is('ajax')) {
            $this->Category = ClassRegistry::init('Category');
            $data           = $this->request->data;
            $split_data     = explode('/', $data['before']);
            $root           = APP . "webroot/files/";
            $old_path       = APP . "webroot/files/".$data['before'];
            $new_path       = APP . "webroot/files/".$data['new_name'];

            if (count($split_data) > 1) {

            } else {
                rename($root.$data['before'], $root.$data['new_name']);
                $category = $this->Category->find('first', [
                    'conditions' => ['name' => $split_data[0]]
                ]);
                $location = $this->Location->find('first', [
                    'conditions' => ['path' => $old_path]
                ]);

                if ($category) {
                    $this->Category->id = $category['Category']['id'];
                    $this->Category->saveField('name', $data['new_name']);
                }

                if ($location) {
                    $this->Location->id = $location['Location']['id'];
                    $this->Location->saveField('path', $new_path);
                }
            }
        }
    }
}
