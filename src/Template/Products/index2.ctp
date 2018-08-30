<?php
 echo $this->Html->css('product.css');
 echo $this->Html->script('products.js');
?>
<div class="products index large-9 medium-8 columns contents">
    <h3><?= __('商品一覧') ?></h3>
    <ul class="list_button">
        <li><i class="fa fa-list fa-lg list"></i></li>
        <li><i class="fa fa-th-large fa-lg thumbnail my-orange"></i></li>
    </ul>
    <ul class="thumbnail_contents content clearfix">
        <?php foreach ($products as $product): ?>
        <li class="show_button product_<?= $product->id ?>">
            <?= $this->Html->image($product->img,['width' => '200', 'height' => '200']) ?>
            <br>
            <?=  h($product->title) ?>
        </li>
        <?php endforeach; ?>
    </ul>
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


