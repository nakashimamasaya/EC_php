<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Purchase[]|\Cake\Collection\CollectionInterface $purchases
 */
?>
<div class="purchases index large-9 medium-8 columns content">
    <h3><?= __('購入履歴') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">商品名</th>
                <th scope="col">金額</th>
                <th scope="col">個数</th>
                <th scope="col">購入日</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($purchases as $purchase): ?>
                <?php foreach($purchase->carts as $cart): ?>
            <tr>
                <td><?= $this->Html->image($cart->product->img) ?></td>
                <td><?= h($cart->product->title) ?></td>
                <td><?= $this->Number->format($cart->product->price) ?></td>
                <td><?= $this->Number->format($cart->count) ?></td>
                <td><?= h($purchase->purchaseDate) ?></td>
            </tr>
                <?php endforeach ?>
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
</div>
