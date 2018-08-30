<div class="show clearfix disable product_<?= $product->id ?>">
    <p><i class="fa fa-times-circle fa-lg my-gray close" ></i></p>
    <div class="show_img clearfix">
        <?= $this->Html->image($product->img,['width' => '200', 'height' => '200']) ?>
    </div>
    <div class="detail">
        <h5><?= h($product->user->firstname . ' ' . $product->user->lastname) ?></h5>
        <h2><?= h($product->title) ?></h1>
        <p><?= $this->Number->format($product->price) ?> 円</p>
        <?= $this->Html->link('商品詳細' ,['action' => 'details', $product->id]) ?>
    </div>
</div>
