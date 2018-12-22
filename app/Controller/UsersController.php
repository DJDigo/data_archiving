<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 */
class UsersController extends AppController {
    
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login','logout','add','index','list');
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
                    return $this->redirect(['controller' => 'users', 'action' => '']);
                }
                return $this->redirect(['controller' => 'users', 'action' => 'add']);
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
        if ($this->Auth->logout()) {
            return $this->redirect(['controller' => 'users', 'action' => 'login']);
        }
    }

    public function index() {
        $this->Archive  = ClassRegistry::init('Archive');
        $this->Location = ClassRegistry::init('Location');

        $user_count = $this->User->find('count', [
            'conditions' => ['User.role' => 1]
        ]);
        $file_count   = $this->Archive->find('count');
        $folder_count = $this->Location->find('count');

        $this->set(compact('user_count', 'file_count', 'folder_count'));
    }

    public function list() { 

    }
}
