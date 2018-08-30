<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 */
?>
<div class="products view large-9 medium-8 columns content contents">
    <h3><?= h($product->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <td><?= $this->Html->image($product->img) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('出品者') ?></th>
            <td><?= h($product->user->lastname . ' ' .$product->user->firstname) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('価格') ?></th>
            <td><?= $this->Number->format($product->price) . '円'?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('在庫') ?></th>
            <td><?= $this->Number->format($product->stock) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('発売日') ?></th>
            <td><?= h($product->saleDate) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('詳細') ?></h4>
        <?= $this->Text->autoParagraph(h($product->details)); ?>
    </div>
    <div class="row">
        <?= $this->Html->link(__('戻る'), ['action' => 'index']) ?>
        <!-- <?= $this->Form->postLink(__('削除'), ['action' => ''])?> -->
    </div>
</div>
