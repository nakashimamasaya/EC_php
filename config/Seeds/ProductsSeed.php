<?php
use Migrations\AbstractSeed;

/**
 * Products seed.
 */
class ProductsSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = [];

        $faker = Faker\Factory::create('ja_JP');
        for ($i = 0; $i < 100; $i++) {
        $data[] = [
            'title' => $faker->userName,
            'img' => $faker->imageUrl($width = 200, $height = 200),
            'details' => $faker->realText,
            'price' => $faker->numberBetween($min = 0, $max = 1000000),
            'stock' => $faker->numberBetween($min = 0, $max = 1000000),
            'saleDate' => $faker->date('Y-m-d H:i:s'),
            'user_id' => $faker->numberBetween($min = 1, $max = 100),
          ];
        }

        $table = $this->table('products');
        $table->insert($data)->save();
    }
}
