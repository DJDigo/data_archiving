<?php
App::uses('AppController', 'Controller');
/**
 * Logs Controller
 */
class LogsController extends AppController {

    public function index() {
        $logs = $this->Log->find('all');

        $this->set(compact('logs'));
    }

    public function delete($id)  {
        if (!$id) {
            return $this->redirect(['controller' => 'logs', 'action' => 'index']);
        }
        if ($this->Log->delete($id)) {
            $this->Flash->success(__('Logs has been successfully deleted.'));
            return $this->redirect(['controller' => 'logs', 'action' => '/index']);
        }
    }
}