<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

class ManagementsController extends AppController
{
    public function beforeFilter(Event $event){
        parent::beforeFilter($event);
        $this->Auth->allow(['login']);
    }

    public function index()
    {

    }

    public function login(){
        $user = $this->Auth->user();
        if(isset($user)){
            $this->redirect(['controller'=>'Managements','action'=>'index']);
        }
        else{
            if ($this->request->is('post')){
                $user = $this->Auth->identify();
                if ($user && $user['level'] > 0) {
                    $this->Auth->setUser($user);
                    $this->Flash->success(__('ログインしました'));
                    return $this->redirect(['controller'=>'Managements','action'=>'index']);
                }
                $this->Flash->error(__('ログインできませんでした'));
            }
        }
    }

}
