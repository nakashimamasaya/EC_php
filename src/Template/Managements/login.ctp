<div class="login__form">
  <div class="users form">
    <?= $this->Flash->render('auth') ?>
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('管理ページログイン') ?></legend>
        <?= $this->Form->control('email', ['label' => 'メールアドレス', 'required' => true]) ?>
        <?= $this->Form->control('password', ['label' => 'パスワード', 'required' => true]) ?>
    </fieldset>
    <?= $this->Form->button(__('ログイン')); ?>
    <?= $this->Form->end() ?>
  </div>
  <div class="signup">
    <h5>ユーザー登録(無料)</h5>
    <?php
        echo $this->Html->link('ユーザー登録',['controller' => 'Users' , 'action' => 'signup'])
    ?>
  </div>
</div>
