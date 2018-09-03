<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 */
?>

<div class="products view large-9 medium-8 columns content">
    <h3><?= h($product->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('画像') ?></th>
            <td><?= $this->Html->image($product->img) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ユーザーid') ?></th>
            <td><?= $this->Html->link($product->user_id, ['controller' => 'Users', 'action' => 'view', $product->user_id]) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('価格') ?></th>
            <td><?= $this->Number->format($product->price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('在庫') ?></th>
            <td><?= $this->Number->format($product->stock) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('発売日') ?></th>
            <td><?= h($product->saleDate) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('カテゴリー') ?></th>
            <td>
            <?php if(isset($product->categories_product)): ?>
                <ul style="list-style: none;">
                    <?php foreach($product->categories_product as $category_id): ?>
                    <li><?= h($category_id->category->name)?></li>
                    <?php endforeach ?>
                </ul>
            <?php endif ?>
            </td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('詳細') ?></h4>
        <?= $this->Text->autoParagraph(h($product->details)); ?>
    </div>
    <div class="row">
        <?= $this->Html->link(__('編集'), ['action' => 'edit', $product->id]) ?>
        <?= $this->Form->postLink(__('削除'), ['action' => 'delete', $product->id], ['confirm' => __('削除しますか？')]) ?>
    </div>
</div>


