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
                'path'        => $category 
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

    public function index() {
        $this->autoRender = false;
        // if ($this->request->is('Ajax')) {
            $json_folder = [];
            $folders     = $this->Location->find('all', ['order' => 'category_id']);

            foreach ($folders as $key => $folder) {
                $split_folder = explode("/", $folder['Location']['path']);
                // $test = [$folder['Location']['path'] => $name[count($name) - 1]];
                // array_push($json_folder, $this->__concate_array($test));
                if ($key == 0) {
                    $json_folder[$folder['Location']['path']] = [
                        'id' => $folder['Location']['path'],
                        'name' => $folder['Location']['path']
                    ];
                } else {
                    $json_folder[$folder['Location']['path']] = [
                        'id'   => implode('/', $split_folder),
                        'name' => $split_folder[count($split_folder) -1]
                    ];    
                }
                
                // $split_folder = explode('/', $folder['Location']['path']);
                // if (count($split_folder) == 1) {
                //     $json_folder[$folder['Location']['path']] = [
                //         'id'   => $folder['Location']['path'],
                //         'name' => $folder['Location']['path']
                //     ];
                // } else {
                //     $test = $this->__concate_array();
                    // pr($this->__concate_array() = [
                    //                         'id'   => implode('/', $split_folder),
                    //                         'name' => $split_folder[count($split_folder) -1]
                    //                     ]);
                    // $test = [
                    //     'id'   => implode('/', $split_folder),
                    //     'name' => $split_folder[count($split_folder) -1]
                    // ];
                    // pr($test);
                    // die();
                    // pr($split_folder);
                    // array_push($json_folder[$split_folder[0]], ['children' => ['id'   => implode('/', $split_folder),'name' => $split_folder[count($split_folder) -1]]]);
                // }
            }
            return json_encode($this->__concate_array($json_folder));
            pr($this->__concate_array($json_folder));
            die();
        // }
    }

    private function __concate_array($array) {
        $this->autoRender = false;
        // $result = [];
        // foreach($array as $path => $value) {
        //     $temp=&$result;

        //     foreach(explode('/', $path) as $key) {
        //         $temp=&$temp[$key];
        //     }
        //     $temp = $value;
        // }
        // return $result;
        // $array = [
            // "main;header;up" => ["id" =>  "main_header_up value"],
            // "main;header;bottom" => "main_header_bottom value",
            // "main;bottom" => "main_bottom value",
            // "main;footer;right;top" => "main_footer_right_top value"
        // ];

        $result = [];

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

}
