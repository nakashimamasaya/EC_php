<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Carts Controller
 *
 * @property \App\Model\Table\CartsTable $Carts
 *
 * @method \App\Model\Entity\Cart[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CartsController extends AppController
{

    public function index()
    {
        $this->loadModel('Purchases');
        $this->paginate = [
            'contain' => ['Users', 'Products', 'Purchases']
        ];
        $current_user = $this->Auth->user();
        $purchases = $purchase = $this->Purchases->find('all')->where(['user_id' => $current_user['id']])->last();
        $carts = $this->paginate($this->Carts->find()->where(['purchase_id' => $purchases['id']]));

        $this->set(compact('carts'));
    }

    public function add($id = null)
    {
        $this->loadModel("Purchases");
        $this->loadModel("Products");
        $this->autoRender = false;
        $cart = $this->Carts->newEntity();
        if($this->request->is('post')){
            $purchases = $this->Purchases->find('all')->where(['user_id' => $this->Auth->user()['id']])->last();
            $cart->set([
                'user_id' => $this->Auth->user()['id'],
                'product_id' => $id,
                'purchase_id' => $purchases['id'],
                'count' => 1
                ]);
            $carts = $this->Carts->find('all')->where(['user_id' => $cart->user_id, 'product_id' => $id, 'purchase_id' => $cart->purchase_id])->first();
            $product = $this->Products->get($id);
            if(isset($carts)){
                $this->Flash->error('カートに追加済みです');
            }
            else if($product->stock == 0){
                $this->Flash->error('在庫がありません');
            }
            else if ($this->Carts->save($cart)) {
                $this->Flash->success('カートに追加されました。');
            }
            else{
                $this->Flash->error('カートに追加できません。');
            }
            return $this->redirect(['action' => 'index']);
        }
    }

    public function edit($id = null)
    {
        $this->autoRender = false;
        $cart = $this->Carts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cart = $this->Carts->patchEntity($cart, $this->request->getData());
            if($cart->count < 0){
                $this->Flash->error('負の数が入力されています。');
            }
            if ($this->Carts->save($cart)) {
                $this->Flash->success(__('変更が保存されました。'));
                if($cart->count == 0)$this->Carts->delete($cart);

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('変更が保存されませんでした。'));
        }
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $cart = $this->Carts->get($id);
        if ($this->Carts->delete($cart)) {
            $this->Flash->success(__('カートから削除されました。'));
        } else {
            $this->Flash->error(__('カートから削除されませんでした。'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
