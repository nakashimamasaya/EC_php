<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 */
?>
<?= $this->element('managements_nav',['current_user' => $current_user]) ?>
<?= $this->element('products_form', ['product' => $product]) ?>
