<?php
use Migrations\AbstractMigration;

class CreateProducts extends AbstractMigration
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
        $table = $this->table('products');
        $table->addColumn('title', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('img', 'string', [
            'default' => env('DEFAULT_IMAGE_PATH'),
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('details', 'text', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('price', 'decimal', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('stock', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('saleDate', 'date', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('user_id', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->create();
    }
}
