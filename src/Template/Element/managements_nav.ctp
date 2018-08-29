<nav class="large-2 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('商品リスト'), ['controller' => 'Products', 'action' => 'managements']) ?></li>
        <li><?= $this->Html->link(__('商品作成'), ['controller' => 'Products', 'action' => 'add']) ?></li>
        <?php if($current_user['level'] == 2): ?>
            <li><?= $this->Html->link(__('ユーザーリスト'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <?php endif ?>
    </ul>
</nav>
