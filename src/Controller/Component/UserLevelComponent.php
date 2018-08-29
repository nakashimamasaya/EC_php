<?php

namespace App\Controller\Component;
use Cake\Controller\Component;

class UserLevelComponent extends Component {
     public function checkUser($user)
    {
        if($user['level'] > 0) return true;
        else return false;
    }

    public function checkEditUser($user, $product){
      if($user['level'] == 2 || $product->user_id == $user['id']) return true;
      else return false;
    }
}
