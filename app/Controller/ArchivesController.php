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
        if ($this->Session->read('Auth.User.role') == 2) {
            $conditions['Archive.is_private'] = 0;
        }
        $conditions['Archive.deleted'] = 0;
        $archives = $this->Archive->find('all', [
            'conditions' => $conditions,
            'order' => ['Archive.id' => 'desc']
        ]);

        $this->set(compact('archives'));
    }

    public function delete($id) {
        if (empty($id)) {
            return $this->redirect('/users/');
        } else {
            $data['Archive'] = [
                'id'           => $id,
                'deleted'      => 1,
                'deleted_date' => date('Y-m-d H:i:s'),
                'modified'     => date('Y-m-d H:i:s')
            ];
            $archive = $this->Archive->find('first', [
                'conditions' => ['Archive.id' => $id]
            ]);
            //saved logs
            $this->Log = ClassRegistry::init('Log');
            $user = $this->Session->read('Auth');
            $descriptions = ucfirst($user['User']['username']).' deleted '.$archive['Archive']['image'];
            $logs['Log'] = [
                'description' => $descriptions
            ];
            $this->Log->save($logs);
            $this->Archive->save($data);
            $this->Flash->success('Your file has been successfully deleted.');
            return $this->redirect(['controller' => 'archives', 'action' => '']);
        }
    }

    public function add() {
        $this->Category = ClassRegistry::init('Category');
        $this->Location = ClassRegistry::init('Location');
        $categories = $this->Category->find('all', [
            'conditions' => ['Category.deleted' => 0]
        ]);

        if ($this->request->is('post')) {
            $data     = $this->request->data;
            $this->Archive->set($data);
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
                        //saved logs
                        $this->Log = ClassRegistry::init('Log');
                        $user = $this->Session->read('Auth');
                        $descriptions = $user['User']['username'].' Added '.$data['Archive']['image'];
                        $logs['Log'] = [
                            'description' => $descriptions
                        ];
                        $this->Log->save($logs);
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
                    'Location.category_id' => $data,
                    'Location.deleted' => 0
                ],
                'order' => ['Location.id']
            ]);

            return json_encode($locations);
        }
    }

    public function search() {
        $this->Category = ClassRegistry::init('Category');
        $conditions = [];
        if (!empty($this->request->query['location_id'])) {
            $conditions['Archive.location_id'] = $this->request->query['location_id'];
        }

        if (!empty($this->request->query['option'])) {
            if ($this->request->query['option'] == 1) {
                $category_id = $this->Category->find('list', [
                    'conditions' => [
                        'Category.name LIKE' => '%'.$this->request->query['name'].'%',
                        'Category.deleted' => 0
                    ],
                    'fields' => ['id']
                ]);
                $conditions['Location.category_id'] = $category_id;
            } else if ($this->request->query['option'] == 2) {
                $conditions['Archive.image LIKE'] = '%'.$this->request->query['name'].'%';
            }
        }
        if ($this->Session->read('Auth.User.role') == 2) {
            $conditions['Archive.is_private'] = 0;
        }
        $conditions['Archive.deleted'] = 0;
        $archives = $this->Archive->find('all', [
            'conditions' => $conditions,
            'recursive' => 2
        ]);
        $path = APP . "webroot/files";
        $this->set(compact('archives', 'path'));
    }

    public function deleted() {
        $archives = $this->Archive->find('all', [
            'conditions' => [
                'Archive.deleted' => 1
            ]
        ]);

        $this->set(compact('archives'));
    }

    public function restore($id) {
        if ($id) {
            $archive = $this->Archive->find('first', [
                'conditions' => ['Archive.id' => $id]
            ]);
            $data['Archive'] = [
                'id'           => $id,
                'deleted_date' => NULL,
                'deleted'      => 0
            ];

            if ($this->Archive->save($data)) {
                $this->Location = ClassRegistry::init('Location');
                $location['Location'] = [
                    'id'           => $archive['Archive']['location_id'],
                    'deleted_date' => NULL,
                    'deleted'      => 0
                ];
                $this->Location->save($location);

                $location = $this->Location->find('first', [
                    'conditions' => ['Location.id' => $archive['Archive']['location_id']]
                ]);
                $this->Category = ClassRegistry::init('Category');
                $category['Category'] = [
                    'id'           => $location['Location']['category_id'],
                    'deleted_date' => NULL,
                    'deleted'      => 0
                ];

                $this->Category->save($category);
            }
            $this->Log = ClassRegistry::init('Log');
            $user = $this->Session->read('Auth');
            $descriptions = ucfirst($user['User']['username']).' restored '.$archive['Archive']['image'];
            $logs['Log'] = [
                'description' => $descriptions
            ];
            $this->Log->save($logs);
            $this->Flash->success('Your file has been successfully restore.');
            return $this->redirect(['controller' => 'archives', 'action' => 'deleted']);
        }
        return $this->redirect(['controller' => 'archives', 'action' => 'deleted']);
    }

    public function hard_delete($id) {
        $archive = $this->Archive->find('first', [
            'conditions' => [
                'Archive.deleted' => 1,
                'Archive.id' => $id
            ]
        ]);

        if (!empty($archive)) {
            $path = APP . "webroot/files/".$archive['Location']['path']."/";
            //saved logs
            $this->Log = ClassRegistry::init('Log');
            $user = $this->Session->read('Auth');
            $descriptions = ucfirst($user['User']['username']).' deleted '.$archive['Archive']['image'];
            $logs['Log'] = [
                'description' => $descriptions
            ];
            $this->Log->save($logs);
            unlink($path, $archive['Archive']['image']);
            $this->Archive->delete($id);
            $this->Flash->success('Your file has been deleted.');
        } else {
            $this->Flash->error('Your file has been failed to deleted.');
        }
        return $this->redirect(['controller' => 'archives', 'action' => 'deleted']);
    }

    public function is_private() {
        $data['Archive'] = $this->request->query;
        if (isset($data['Archive']['is_private']) && !empty($data['Archive']['id'])) {
            $private = $data['Archive']['is_private'] == 0 ? 'public' : 'private';
            if ($this->Archive->save($data)) {
                $this->Flash->success('Your file has been sucessfully updated.');
                $archive = $this->Archive->find('first', [
                    'conditions' => ['Archive.id' => $data['Archive']['id']]
                ]);
                //saved logs
                $this->Log = ClassRegistry::init('Log');
                $user = $this->Session->read('Auth');
                $descriptions = ucfirst($user['User']['username']).' set to '.$private.' '.$archive['Archive']['image'];
                $logs['Log'] = [
                    'description' => $descriptions
                ];
                $this->Log->save($logs);
            } else {
                $this->Flash->error('Your file has been failed to update.');
            }


            return $this->redirect(['controller' => 'archives', 'action' => '/index']);
        }
        return $this->redirect(['controller' => 'archives', 'action' => '/index']);
    }
}
