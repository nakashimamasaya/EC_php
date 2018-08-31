<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Cart[]|\Cake\Collection\CollectionInterface $carts
 */
?>
<div class="carts index large-9 medium-8 columns content">
    <h3><?= __('カートの中身') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">商品名</th>
                <th scope="col">金額</th>
                <th scope="col">個数</th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <?php $sum = 0 ?>
        <tbody>
            <?php foreach ($carts as $cart): ?>
            <tr>
                <td><?= $this->Html->image($cart->product->img) ?></td>
                <td><h2><?= $cart->has('product') ? $this->Html->link($cart->product->title, ['controller' => 'Products', 'action' => 'details', $cart->product->id]) : '' ?></h2></td>
                <td><h2><?= $this->Number->format($cart->product->price) ?>円</h2></td>
                <?= $this->Form->create($cart, ['action' => 'edit',$cart->id]) ?>
                <td><?= $this->Form->control('count', ['label' => '', 'required' => false, 'min' => 1]) ?></td>
                <td class="actions">
                    <ul style="list-style: none;">
                        <li><?= $this->Form->button(__('個数の適用')) ?><?= $this->Form->end() ?></li>
                        <li><?= $this->Form->postLink(__('カートから削除'), ['action' => 'delete', $cart->id], ['confirm' => __('カートから削除しますか？'), 'class' => 'button']) ?></li>
                    </ul>
                    
                </td>
            </tr>
            <?php $sum += $cart->product->price * $cart->count ?>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
    </div>
    <h1>合計<?= $sum ?>円</h1>
    <button>会計に進む</button>
</div>
