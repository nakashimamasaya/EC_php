<?php
use Migrations\AbstractMigration;

class CreatePurchases extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('purchases');
        $table->addColumn('purchaseDate', 'timestamp', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('level', 'integer', [
            'default' => 0,
            'limit' => 11,
            'null' => false,
        ]);
        $table->create();
    }
}
