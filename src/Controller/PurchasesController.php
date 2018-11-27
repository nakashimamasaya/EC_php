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
}
