<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 */
class UsersController extends AppController {
    
    public function beforeFilter() {
        parent::beforeFilter();
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
                if ($this->User->save($data)) {
                    $this->Flash->success(__('User has been successfully added.'));
                    return $this->redirect('/users/add');
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
                echo "HELLO WORLD";
                die();
            } else {
                $this->Flash->error('Invalid username or password.');
            }
        }
    }

    /**
     * User's Logout
     */
    public function logout() {
        $this->autoRender = false;
        if ($this->Auth->logout()) {
            return $this->redirect('/users/login');
        }
    }
}
