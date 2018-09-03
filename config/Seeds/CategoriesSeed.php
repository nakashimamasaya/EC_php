<?php
use Migrations\AbstractSeed;

/**
 * Categories seed.
 */
class CategoriesSeed extends AbstractSeed
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
                'name' => $faker->userName
              ];
        }

        $table = $this->table('categories');
        $table->insert($data)->save();
    }
}
