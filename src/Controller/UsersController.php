<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

class UsersController extends AppController
{

    public function beforeFilter(Event $event){
        parent::beforeFilter($event);
        $this->Auth->allow(['login','signup']);
    }

    public function index()
    {
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }

    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);

        $this->set('user', $user);
    }

    public function login(){
        $user = $this->Auth->user();
        if(isset($user)){
            $this->redirect(['controller'=>'Users','action'=>'index']);
        }
        else{
            if ($this->request->is('post')){
                $user = $this->Auth->identify();
                if ($user) {
                    $this->Auth->setUser($user);
                    $this->Flash->success(__('ログインしました'));
                    return $this->redirect($this->Auth->redirectUrl());
                }
                $this->Flash->error(__('ユーザ名もしくはパスワードが間違っています'));
            }
        }
    }

    public function logout(){
        $this->Flash->success('ログアウトしました');
        return $this->redirect($this->Auth->logout());
    }

    public function signup()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('ユーザーが作成されました。'));

                return $this->redirect(['action' => 'login']);
            }
            $this->Flash->error(__('ユーザーの作成に失敗しました。'));
        }
        $this->set(compact('user'));
    }

    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
