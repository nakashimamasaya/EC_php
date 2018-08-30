<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use App\Model\Utility\S3Manager;

class ProductsController extends AppController
{
    public $components = array('UserLevel');


    public function beforeFilter(Event $event){
        parent::beforeFilter($event);
        $this->Auth->allow([]);
    }

    public function index()
    {

        $this->paginate = [
            'limit' => 10,
            'contain' => ['Users'],
            'order' => [
                'saleDate' => 'desc'
            ]
        ];
        $products = $this->paginate($this->Products);
        $this->set(compact('products'));
        $this->set('today', date("Y/m/d"));
    }

    public function index2(){
        $this->paginate = [
            'limit' => 12,
            'contain' => ['Users'],
            'order' => [
                'saleDate' => 'desc'
            ]
        ];
        $products = $this->paginate($this->Products);
        $this->set(compact('products'));
        $this->set('today', date("Y/m/d"));
    }

    public function managements(){
        $current_user = $this->Auth->user();
        if($this->UserLevel->checkUser($current_user)){
            $products = $this->paginate($this->Products->find()->where(['user_id' => $this->Auth->user()['id']]));
            if($current_user['level'] == 2){
                $products = $this->paginate($this->Products);
            }
            $this->set(compact('products'));
        }
        else{
            $this->redirect(['action' => 'index']);
        }
    }

    public function view($id = null)
    {
        $product = $this->Products->get($id, [
            'contain' => []
        ]);

        $this->set('product', $product);
    }

    public function details($id = null){
        $product = $this->Products->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('product', $product);
    }

    public function add()
    {
        if($this->UserLevel->checkUser($this->Auth->user())){
            $product = $this->Products->newEntity();
            if ($this->request->is('post')) {
                $product = $this->Products->patchEntity($product, $this->request->getData());
                $fileName = $this->request->getData('image');
                // if(isset($fileName)){
                if(false){
                    $s3 = new S3Manager();
                    $file = $fileName['name'];
                    $result = $s3->putObject($fileName['tmp_name'], $file, $file);
                    $product->img = $result;
                }else{
                    $product->img = env('DEFAULT_IMAGE_PATH');
                }
                if ($this->Products->save($product)) {
                    $this->Flash->success(__('商品が作成されました。'));

                    return $this->redirect(['action' => 'managements']);
                }
                $this->Flash->error(__('作成できませんでした。'));
            }
            $this->set(compact('product'));
            $this->set('users', $this->Auth->user());
        }
        else{
            $this->Flash->error('アクセス権限がありません。');
            return $this->redirect(['action' => 'index']);
        }
    }

    public function edit($id = null)
    {
        $current_user = $this->Auth->user();
        $product = $this->Products->get($id);
        if($this->UserLevel->checkEditUser($current_user, $product)){
            if ($this->request->is(['patch', 'post', 'put'])) {
                $product = $this->Products->patchEntity($product, $this->request->getData());
                $fileName = $this->request->getData('image');
                // if(isset($fileName)){
                if(false){
                    $s3 = new S3Manager();
                    $file = $fileName['name'];
                    $result = $s3->putObject($fileName['tmp_name'], $file, $file);
                    $product->img = $result;
                }else{
                    $product->img = env('DEFAULT_IMAGE_PATH');
                }
                if ($this->Products->save($product)) {
                    $this->Flash->success(__('保存されました。'));

                    return $this->redirect(['action' => 'managements']);
                }
                $this->Flash->error(__('保存されませんでした。'));
            }
            $this->set(compact('product'));
            $this->set('users', $this->Auth->user());
        }
        else{
            $this->Flash->error('アクセス権限がありません。');
            return $this->redirect(['action' => 'managements']);
        }
    }

    public function delete($id = null)
    {
        $current_user = $this->Auth->user();
        $product = $this->Products->get($id);
        if($current_user['level'] == 2 || $product->user_id == $current_user['id']){
            $this->request->allowMethod(['post', 'delete']);
            if ($this->Products->delete($product)) {
                $this->Flash->success(__('削除されました。'));
            } else {
                $this->Flash->error(__('削除されませんでした。'));
            }
        }
        else{
            $this->Flash->error('アクセス権限がありません。');
        }

        return $this->redirect(['action' => 'managements']);
    }

}
