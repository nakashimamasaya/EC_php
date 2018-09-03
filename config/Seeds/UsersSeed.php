<?php
use Migrations\AbstractSeed;
use Cake\Auth\DefaultPasswordHasher;

/**
 * Users seed.
 */
class UsersSeed extends AbstractSeed
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
            'firstname' => $faker->firstName,
            'lastname' => $faker->lastName,
            'email' => $faker->email,
            'postNumber' => $faker->postcode,
            'prececture' => $faker->prefecture,
            'address' => $faker->city . $faker->ward . $faker->streetAddress,
            'password' => $this->_setPassword(123456),
            'level' => $faker->numberBetween($min = 0, $max = 2)
          ];
        }

        $table = $this->table('users');
        $table->insert($data)->save();
    }

    protected function _setPassword($value)
    {
        $hasher = new DefaultPasswordHasher();
        return $hasher->hash($value);
    }
}
