<?php

namespace App\Controller\Component;
use Cake\Controller\Component;

class ImageCheckComponent extends Component {
     public function checkImage($image, $error)
    {
        $permitted_image_type = ['image/gif', 'image/jpeg', 'image/png'];
        if($error == 0 && in_array(mime_content_type($image['tmp_name']), $permitted_image_type, true)) return 0;
        else if($error < 4)return 1;
        else return 2;
        // return 0 -> OK   return 1 ->  not image or large image  retun 2 -> empty
    }
}
