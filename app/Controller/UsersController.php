<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 */
class UsersController extends AppController {
    
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login','logout','add','list');
    }

    /**
     * User's registration
     * Only admin can login in this page
     * Role: 1
     */
    public function add() {
        if ($this->request->is('POST')) {
            $data = $this->request->data;

            $this->User->set($data);
            if ($this->User->validates($data)) {
                $data['User']['role'] = 2;
                if ($this->User->save($data)) {
                    $this->Flash->success(__('User has been successfully added.'));
                    return $this->redirect(['controller' => 'users', 'action' => 'add']);
                }
            } else {
                $this->Flash->error(__("User has been failed to save."));
            }
        } 
    }
    /**
     * User's Login
     */
    public function login() {
        if ($this->request->is('POST')) {
            if ($this->Auth->login()) {
                if ($this->Session->read('Auth.User.role') == 2) {
                    if ($this->Session->read('Auth.User.deleted') == 1) {
                        $this->Auth->logout();
                        return $this->redirect(['controller' => 'users', 'action' => 'index']);
                    }
                    $this->Log = ClassRegistry::init('Log');
                    $user = $this->Session->read('Auth');
                    $descriptions = ucfirst($user['User']['username']).' has been logged in.';
                    $logs['Log'] = [
                        'description' => $descriptions
                    ];
                    $this->Log->save($logs);
                    return $this->redirect(['controller' => 'users', 'action' => '']);
                }
                return $this->redirect(['controller' => 'users', 'action' => 'index']);
            } else {
                $this->Flash->error('Invalid Username or Password entered, please try again.');
            }
        }
    }

    /**
     * User's Logout
     */
    public function logout() {
        $this->autoRender = false;
        $this->Log = ClassRegistry::init('Log');
        $user = $this->Session->read('Auth');
        $descriptions = ucfirst($user['User']['username']).' has been logged out.';
        $logs['Log'] = [
            'description' => $descriptions
        ];
        $this->Log->save($logs);
        if ($this->Auth->logout()) {
            return $this->redirect(['controller' => 'users', 'action' => 'login']);
        }
    }

    public function index() {
        $this->Archive  = ClassRegistry::init('Archive');
        $this->Location = ClassRegistry::init('Location');

        $user_count = $this->User->find('count', [
            'conditions' => ['User.role' => 2, 'User.deleted' => 0]
        ]);
        $file_count   = $this->Archive->find('count', ['conditions' => ['Archive.deleted' => 0]]);
        $folder_count = $this->Location->find('count', ['conditions' => ['Location.deleted' => 0]]);

        $this->set(compact('user_count', 'file_count', 'folder_count'));
    }

    public function lists() { 
        $users = $this->User->find('all', [
            'conditions' => [
                'User.role' => 2,
                'User.deleted' => 0
            ]
        ]);

        $this->set(compact('users'));
    }

    public function delete($id) {
        if (!$id) {
            return $this->redirect(['controller' => 'users', 'action' => 'lists']);
        }
        if ($this->User->delete($id)) {
            $this->Flash->success(__('User has been successfully deleted.'));
            return $this->redirect(['controller' => 'users', 'action' => 'lists']);
        }
    }
}
