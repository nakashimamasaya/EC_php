<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Purchase $purchase
 */
?>
<div class="purchases view large-9 medium-8 columns content">
    <h3><?= h($purchase->id) ?></h3>
    <table class="vertical-table">
        <?php foreach($purchase->carts as $cart): ?>
            <tr>
                <th scope="row">購入品</th>
                <td><?= $this->Html->image($cart->product->img) ?><?= h($cart->product->title) ?></td>
                <td><h5><?= $this->Number->format($cart->product->price) ?>円</h5></td>
                <td><h5><?= $this->Number->format($cart->count) ?>個</h5></td>
            </tr>
        <?php endforeach ?>
        <tr>
            <th scope="row"><?= __('購入日') ?></th>
            <td><?= h($purchase->purchaseDate) ?></td>
        </tr>
    </table>
</div>
