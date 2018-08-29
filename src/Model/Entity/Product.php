<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Product Entity
 *
 * @property int $id
 * @property string $title
 * @property string $img
 * @property string $details
 * @property float $price
 * @property int $stock
 * @property \Cake\I18n\FrozenDate $saleDate
 * @property string $user_id
 *
 * @property \App\Model\Entity\User $user
 */
class Product extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'title' => true,
        'img' => true,
        'details' => true,
        'price' => true,
        'stock' => true,
        'saleDate' => true,
        'user_id' => true,
        'user' => true
    ];
}
