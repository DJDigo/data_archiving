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

    public function index() {
        $this->Archive->recursive = -1;
        $archives = $this->Archive->find('all', [
            'order' => ['Archive.id' => 'desc']
        ]);

        $this->set(compact('archives'));
    }

    public function delete($id) {
        if (empty($id)) {
            return $this->redirect('/users/');
        } else {
            // $this->Archive->delete(['Archive.id' => $id]);
            $this->Flash->success('Your file has been successfully deleted.');
            return $this->redirect(['controller' => 'archives', 'action' => '']);
        }
    }

    public function add() {
        $this->Category = ClassRegistry::init('Category');
        $this->Location = ClassRegistry::init('Location');
        $categories = $this->Category->find('all');

        if ($this->request->is('post')) {
            $data     = $this->request->data;
            $validate = $this->Archive->validates();
            if (empty($data['image']['upload']['type'])) {
                $this->Archive->validationErrors['image'][0] = __("Image is required");
                $validate = false;
            }

            if (empty($data['Archive']['name'])) {
                $this->Archive->validationErrors['name'][0] = __("Filename is required");
                $validate = false;
            }

            if (empty($data['Archive']['category'])) {
                $this->Archive->validationErrors['category'][0] = __("Category is required");
                $validate = false;
            }

            if ($validate) {
                $location = $this->Location->findById($data['Archive']['location_id']);
                $this->Upload->upload($data['image']['upload']);
                if($this->Upload->uploaded) {
                    $image_name = $data['Archive']['name'];
                    $this->Upload->file_new_name_body = str_replace(" ", "_", preg_replace('/\\.[^.\\s]{3,4}$/', '', $image_name));
                    $this->Upload->process(APP . "webroot/files/".$location['Location']['path'].'/');
                    $this->Upload->process();
                    $ext = pathinfo($data['image']['upload']['name'], PATHINFO_EXTENSION);
                    $data['Archive']['image'] = str_replace(" ", "_", preg_replace('/\\.[^.\\s]{3,4}$/', '', $image_name)).".".$ext;
                    unset($data['Archive']['name']);
                    unset($data['Archive']['category']);
                    if ($this->Archive->save($data)) {
                        $this->Flash->success('Your file has been successfully saved.');
                        return $this->redirect(['controller' => 'archives', 'action' => 'add']);
                    }
                }
            } else {
                $this->Flash->error('Your file has been failed to saved.'); 
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
                    'Location.category_id' => $data
                ],
                'order' => ['Location.id']
            ]);

            return json_encode($locations);
        }
    }

    public function search() {
        if (!empty($this->request->query['location_id'])) {
            $location_id = $this->request->query['location_id'];
            $archives = $this->Archive->find('all', [
                'conditions' => [
                    'Archive.location_id' => $location_id
                ],
                'recursive' => 2
            ]);
            $path = APP . "webroot/files";
            $this->set(compact('archives', 'path'));
        } else {
            return $this->redirect(['controller' => 'archives', 'action' => 'add']);
        }
    }
}
