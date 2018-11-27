<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use App\Model\Utility\S3Manager;

class ProductsController extends AppController
{
    public $components = ['UserLevel', 'ImageCheck'];


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

    public function details($id = null){
        $product = $this->Products->get($id, [
            'contain' => ['CategoriesProduct' => ['Categories'],
                        'Users']
        ]);

        $this->set('product', $product);
    }

    public function find($find = null){
        if($this->request->is('post')){
            $find = $this->request->getData('find');
            $find = urlencode($find);
            $this->redirect(['action' => 'find', $find]);
        }else if(isset($find)){
            $this->paginate = [
            'limit' => 10,
            'contain' => ['Users'],
            'order' => [
                'saleDate' => 'desc'
            ]];
            $results = $this->Products->find('all')->where(["OR" => [["title like " => "%" . $find . "%"],["details like " => "%" . $find . "%"]]]);
            $results = $this->paginate($results);
            $find = urldecode($find);
            $flag = true;
            $this->set(compact('find', 'results', 'flag'));
            $this->set('today', date("Y/m/d"));
        }else{
            $results = '';
            $flag = false;
            $this->set(compact('find', 'results', 'flag'));
        }

    }

}
