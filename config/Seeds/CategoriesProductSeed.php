<?php
use Migrations\AbstractSeed;

/**
 * CategoriesProduct seed.
 */
class CategoriesProductSeed extends AbstractSeed
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
                'product_id' => $faker->numberBetween($min = 1, $max = 100),
                'category_id' => $faker->numberBetween($min = 1, $max = 100)
              ];
        }

        $table = $this->table('categories_product');
        $table->insert($data)->save();
    }
}
