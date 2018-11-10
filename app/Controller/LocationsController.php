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
    public function edit($id) {
        if ($this->request->is('ajax')) {

        }
    }
}
