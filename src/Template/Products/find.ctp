<?php
 echo $this->Html->css('product.css');
 echo $this->Html->script('products.js');
?>
<div class='clearfix content'>
    <?= $this->Form->create(false, ['url' => 'products/find']) ?>
    <?= $this->Form->control('find',['label' => '商品を検索', 'type' => 'text']); ?>
    <?= $this->Form->button('検索') ?>
    <?= $this->Form->end() ?>
</div>

<?php if(!empty($results)): ?>
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
        <?php foreach ($results as $product): ?>
        <tr class="product">
            <td><?= $this->Html->image($product->img,['width' => '100', 'height' => '100']) ?></td>
            <td><h1><?= h($product->title) ?></h1></td>
            <td><h3><?= $this->Number->format($product->price) ?>円</h3></td>
            <td>
                <ul>
                    <li><button class="show_button product_<?= $product->id ?> button">もっとみる</button></li>
                    <?php if(strtotime($today) >= strtotime($product->saleDate)): ?>
                        <li><?= $this->Form->postLink(__('カートに入れる'), ['controller' => 'carts', 'action' => 'add', $product->id], ["class" => "button"]) ?></li>
                    <?php endif ?>
                </ul>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php foreach ($results as $product): ?>
    <?= $this->element('product_details',['product' => $product]) ?>
<?php endforeach ?>
<?php endif ?>
<?php if(!empty($find) && !empty($results)): ?>
    <h1>該当する商品はありません。</h1>
<?php endif ?>
