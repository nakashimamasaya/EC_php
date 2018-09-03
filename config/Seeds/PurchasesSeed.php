<?php
use Migrations\AbstractSeed;

/**
 * Purchases seed.
 */
class PurchasesSeed extends AbstractSeed
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
                'user_id' => $faker->numberBetween($min = 1, $max = 100),
                'purchaseDate' => $faker->date('Y-m-d H:i:s'),
                'level' => $faker->numberBetween($min = 0, $max = 2)
              ];
        }

        $table = $this->table('purchases');
        $table->insert($data)->save();
    }
}
