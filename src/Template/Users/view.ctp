<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $user
 */
?>
<div class="users view large-9 medium-8 columns content">
    <h3><?= h($user->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Firstname') ?></th>
            <td><?= h($user->firstname) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Lastname') ?></th>
            <td><?= h($user->lastname) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($user->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('PostNumber') ?></th>
            <td><?= h($user->postNumber) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Prececture') ?></th>
            <td><?= h($user->prececture) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Address') ?></th>
            <td><?= h($user->address) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Level') ?></th>
            <td><?= $this->Number->format($user->level) ?></td>
        </tr>
        
    </table>
    <?php if($user->id == $current_user['id'] || $current_user['level'] == 2): ?>
        <div class="row">
            <?= $this->Html->link(__('編集'), ['action' => 'edit', $user->id]) ?>
            <?= $this->Form->postLink(__('削除'), ['action' => 'delete', $user->id], ['confirm' => __('削除しますか？')]) ?>
        </div>
    <?php endif ?>
</div>
