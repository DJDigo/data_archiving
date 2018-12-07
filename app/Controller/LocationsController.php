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

    public function index() {
        $this->autoRender = false;
        if ($this->request->is('ajax')) {
            return json_encode($this->__concate_array($this->__get_folders()));
        }
    }

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
                'path'        => $category 
            ];
            if ($this->Location->save($location_data)) {
                return json_encode($this->__concate_array($this->__get_folders()));
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
            $new_data       = [];
            $json_folder    = [];

            if (count($split_data) > 1) {
                rename($root.$data['before'], $root.$data['new_name']);
                $location = $this->Location->find('all', [
                    'conditions' => [
                        'path LIKE' => '%'.$data['before'].'%'
                    ]
                ]);

                foreach ($location as $key => $new_location) {
                    $new_data[]['Location'] = [
                        'id' => $new_location['Location']['id'],
                        'path' => str_replace($data['before'], $data['new_name'], $new_location['Location']['path'])
                    ];
                }
            } else {
                rename($root.$data['before'], $root.$data['new_name']);
                $category = $this->Category->find('first', [
                    'conditions' => ['name' => $split_data[0]]
                ]);
                $location = $this->Location->find('all', [
                    'conditions' => ['category_id' => $category['Category']['id']]
                ]);

                foreach ($location as $key => $new_location) {
                    $new_data[]['Location'] = [
                        'id' => $new_location['Location']['id'],
                        'path' => str_replace($data['before'], $data['new_name'], $new_location['Location']['path'])
                    ];
                }
                if ($category) {
                    $this->Category->id = $category['Category']['id'];
                    $this->Category->saveField('name', $data['new_name']);
                }
            }
            if ($location) {
                $this->Location->saveMany($new_data);
            }
            return json_encode($this->__concate_array($this->__get_folders()));
        }
    }

    public function delete() {
        $this->autoRender = false;
        if ($this->request->is('ajax')) {
            $this->Category = ClassRegistry::init('Category');
            $this->Archive  = ClassRegistry::init('Archive');
            $path           = $this->request->data['name'];
            $locations      = $this->Location->find('all', [
                'conditions' => ['path LIKE' => '%'.$path],
                'order' =>  ['Location.id' => 'DESC']
            ]);
            $categories = $this->Category->find('list', [
                'conditions' => ['name' => $path],
                'fields'     => ['id']
            ]);

            if ($locations) {
                $location_id = [];
                foreach ($locations as $key => $value) {
                    $location_id[] = $value['Location']['id'];
                    $this->__delete_directory(APP . "webroot/files/". $value['Location']['path']);
                }
                $this->Location->deleteAll(['Location.id' => $location_id], true);
                $this->Archive->deleteAll(['Archive.location_id' => $location_id], true);
            }

            if ($categories) {
                $this->Category->deleteAll(['Category.id' => $categories], true);
            }
        }
    }

    private function __concate_array($array) {
        $this->autoRender = false;
        $result = [];
        $i = 0;
        foreach ($array as $implodedKeys => $value) {
            $keys = array_reverse(explode('/', $implodedKeys));
            $tmp = $value;
            foreach ($keys as $key) {
                $tmp = [$key => $tmp];
            }
            $result = array_merge_recursive($result, $tmp);
        }
        return $result;
    }

    private function __get_folders() {
        $json_folder = [];
        $folders     = $this->Location->find('all', ['order' => ['Location.category_id', 'Location.id']]);
        foreach ($folders as $key => $folder) {
            $split_folder = explode("/", $folder['Location']['path']);
            if ($key == 0) {
                $json_folder[$folder['Location']['path']] = [
                    'id'          => $folder['Location']['path'],
                    'location_id' => $folder['Location']['id'],
                    'name'        => $folder['Location']['path']
                ];
            } else {
                $json_folder[$folder['Location']['path']] = [
                    'id'          => implode('/', $split_folder),
                    'location_id' => $folder['Location']['id'],
                    'name'        => $split_folder[count($split_folder) -1]
                ];    
            }
        }
        return $json_folder;
    }

    private function __delete_directory($dirname) {
        if (is_dir($dirname)) {
           $dir_handle = opendir($dirname);
        }
        if (!isset($dir_handle)) {
            return false;
        }
        while($file = readdir($dir_handle)) {
            if ($file != "." && $file != "..") {
                if (!is_dir($dirname."/".$file)) {
                    unlink($dirname."/".$file);
                } else {
                    $this->__delete_directory($dirname.'/'.$file);
                }
            }
        }
        closedir($dir_handle);
        rmdir($dirname);
        return true;
    }
}
