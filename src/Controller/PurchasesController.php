<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Purchases Controller
 *
 * @property \App\Model\Table\PurchasesTable $Purchases
 *
 * @method \App\Model\Entity\Purchase[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PurchasesController extends AppController
{
    public function index()
    {
        $this->paginate = [
            'contain' => [
                'Users',
                'Carts' =>[
                    'Products'
                ]],
            'order' => [
                'id' => 'desc'
            ]
        ];
        $purchases = $this->paginate($this->Purchases->find()->where(['user_id' => $this->Auth->user()['id'], 'Purchases.level' => 1]));

        $this->set(compact('purchases'));
    }

     public function managements(){
        if($this->Auth->user()['level'] != 2){
                $this->Flash->error('権限がありません。');
                return $this->redirect(['controller' => 'Products', 'action' => 'index']);
        }
        $this->paginate = [
            'contain' => ['Users'],
            'order' => [
                'id' => 'desc'
            ]
        ];
        $purchases = $this->paginate($this->Purchases);

        $this->set(compact('purchases'));
     }

    public function view($id = null)
    {
        $purchase = $this->Purchases->get($id, [
            'contain' => [
                'Users',
                'Carts' =>[
                    'Products'
                ]]
        ]);

        $this->set('purchase', $purchase);
    }

    public function edit($id = null, $type = null)
    {
        $this->autoRender = false;
        $purchase = $this->Purchases->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            if($type == 1){
                $purchase->level = 1;
                $purchase->purchaseDate = date('Y-m-d H:i:s');
                if ($this->Purchases->save($purchase)) {
                    $this->Flash->success(__('購入が完了しました'));
                    $purchase = $this->Purchases->newEntity();
                    $purchase->user_id = $this->Auth->user()['id'];
                    $this->Purchases->save($purchase);
                }
                return $this->redirect(['controller' => 'Products', 'action' => 'index']);
            }
            if($type == 2){
                $purchase->level = 2;
                $purchase->purchaseDate = date('Y-m-d H:i:s');
                if ($this->Purchases->save($purchase)) {
                    $this->Flash->success(__('返金が完了しました'));
                    return $this->redirect(['action' => 'managements']);
                }
                return $this->redirect(['controller' => 'Products', 'action' => 'index']);
            }
            $this->Flash->error(__('The purchase could not be saved. Please, try again.'));
        }
        $users = $this->Purchases->Users->find('list', ['limit' => 200]);
        $this->set(compact('purchase', 'users'));
    }

}
