<?php
 echo $this->Html->css('product.css');
 echo $this->Html->script('products.js');
?>
<div class="products index large-9 medium-8 columns contents">
    <h3><?= __('商品一覧') ?></h3>
    <ul class="list_button">
        <li><i class="fa fa-list fa-lg list my-orange"></i></li>
        <li><i class="fa fa-th-large fa-lg thumbnail"></i></li>
    </ul>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col">
                </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
            <tr class="product">
                <td><?= $this->Html->image($product->img,['width' => '100', 'height' => '100']) ?></td>
                <td><h1><?= h($product->title) ?></h1></td>
                <td><h3><?= $this->Number->format($product->price) ?>円</h3></td>
                <td>
                    <ul>
                        <li><button class="show_button product_<?= $product->id ?> button">もっとみる</button></li>
                        <?php if(strtotime($today) >= strtotime($product->saleDate)): ?>
                        <li><button class="cart_button button" id="<?= $product->id ?>">カートに入れる</button></li>
                        <?php endif ?>
                    </ul>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php foreach ($products as $product): ?>
        <?= $this->element('product_details',['product' => $product]) ?>
    <?php endforeach ?>
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


