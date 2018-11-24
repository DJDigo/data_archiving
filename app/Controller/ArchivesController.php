<?php
App::uses('AppController', 'Controller');
/**
 * Archives Controller
 *
 * @property Archive $Archive
 * @property PaginatorComponent $Paginator
 */
class ArchivesController extends AppController {

/**
 * Components
 *
 * @var array
 */
    public $components = array('Paginator', 'Upload');

    public function add() {
        $this->Category = ClassRegistry::init('Category');
        $this->Location = ClassRegistry::init('Location');
        $categories = $this->Category->find('all');

        if ($this->request->is('post')) {
            $data     = $this->request->data;
            $location = $this->Location->findById($data['Archive']['location_id']);
            $this->Upload->upload($data['image']['upload']);
            if($this->Upload->uploaded) {
                $image_name = $data['Archive']['name'];
                $this->Upload->file_new_name_body = $image_name;
                $this->Upload->process(APP . "webroot/files/".$location['Location']['path'].'/');
                $this->Upload->process();
                $ext = pathinfo($data['image']['upload']['name'], PATHINFO_EXTENSION);
                $data['Archive']['image'] = str_replace(" ", "_", preg_replace('/\\.[^.\\s]{3,4}$/', '', $image_name)).".".$ext;
                unset($data['Archive']['name']);
                if ($this->Archive->save($data)) {
                    $this->Flash->success('Your file has been successfully saved.');
                    return $this->redirect(['controller' => 'archives', 'action' => 'add']);
                }
            }
        }
        $this->set(compact('categories'));
    }

    public function get_locations() {
        $this->autoRender = false;
        if ($this->request->is('Ajax')) {
            $this->Location = ClassRegistry::init('Location');
            $data = $this->request->data;
            $locations = $this->Location->find('all', [
                'conditions' => [
                    'category_id' => $data
                ],
                'order' => ['id']
            ]);

            return json_encode($locations);
        }
    }

}
