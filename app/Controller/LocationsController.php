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
            } else {
                $undo['Category'] = [
                    'id'           => $exist['Category']['id'],
                    'deleted'      => 0,
                    'deleted_date' => NULL
                ];
                $this->Category->save($undo);
            }

            $location_exist = $this->Location->find('first', [
                'conditions' => [
                    'Location.category_id' => !empty($category_id) ? $category_id : $exist['Category']['id'],
                    'Location.path'        => $category 
                ]
            ]);

            if (!empty($location_exist)) {
                $location_data['Location'] = [
                    'id'           => $location_exist['Location']['id'],
                    'deleted'      => 0 ,
                    'deleted_date' => NULL
                ];
            } else {
                $location_data['Location'] = [
                    'category_id' => !empty($category_id) ? $category_id : $exist['Category']['id'],
                    'path'        => $category 
                ];
            }
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
                        'Location.path LIKE' => '%'.$data['before'].'%',
                        'Location.deleted' => 0
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
                    'conditions' => ['Category.name' => $split_data[0], 'Category.deleted' => 0]
                ]);
                $location = $this->Location->find('all', [
                    'conditions' => ['Location.category_id' => $category['Category']['id'], 'Location.deleted' => 0]
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
            $categories = $this->Category->find('all', [
                'conditions' => ['Category.name' => $path, 'Category.deleted' => 0]
            ]);
            $conditions['Location.path LIKE'] = '%'.$path.'%';
            $conditions['Location.deleted'] = 0;
            if (!empty($categories)) {
                $conditions['Location.category_id'] = $categories[0]['Category']['id'];
            }
            $locations      = $this->Location->find('all', [
                'conditions' => $conditions,
                'order' =>  ['Location.id' => 'DESC']
            ]);
            if ($locations) {
                $location    = [];
                $location_id = [];
                foreach ($locations as $key => $value) {
                    $location[]['Location'] = [
                        'id'           => $value['Location']['id'],
                        'deleted'      => 1,
                        'deleted_date' => date('Y-m-d H:i:s'),
                        'modified'     => date('Y-m-d H:i:s')
                    ];
                    $location_id[] = $value['Location']['id'];
                }
                $this->Location->saveMany($location);

                $archives = $this->Archive->find('all', [
                    'conditions' => [
                        'Archive.location_id' => $location_id,
                        'Archive.deleted'     => 0
                    ]
                ]);

                if (!empty($archives)) {
                    $arc = [];
                    foreach ($archives as $archive) {
                        $arc[]['Archive'] = [
                            'id'           => $archive['Archive']['id'],
                            'deleted'      => 1,
                            'deleted_date' => date('Y-m-d H:i:s'),
                            'modified'     => date('Y-m-d H:i:s')          
                        ];
                    }
                    $this->Archive->saveMany($arc);
                }
            }

            if ($categories) {
                $cat = [];
                foreach ($categories as $category) {
                    $cat[]['Category'] = [
                        'id'           => $category['Category']['id'],
                        'deleted'      => 1,
                        'deleted_date' => date('Y-m-d H:i:s'),
                        'modified'     => date('Y-m-d H:i:s')
                    ];
                }
                $this->Category->saveMany($cat);
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
        $folders     = $this->Location->find('all', [
            'conditions' => ['Location.deleted' => 0],
            'order' => ['Location.category_id', 'Location.id']
        ]);
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
