<?php
use Migrations\AbstractMigration;

class CreateProductSpecials extends AbstractMigration
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
        $table = $this->table('product_specials');
        $table->addColumn('product_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('priority', 'integer', [
            'default' => null,
            'limit' => 5,
            'null' => false,
        ]);
        $table->addColumn('price', 'decimal', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('sort_order', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('date_start', 'date', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('date_end', 'date', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addIndex([
            'product_id',
        ], [
            'name' => 'BY_PRODUCT_ID',
            'unique' => false,
        ]);
        $table->addForeignKey('product_id', 'products', ['id'],
                            ['constraint'=>'fk_product_product_specials','delete'=> 'CASCADE', 'update'=> 'RESTRICT',]);
        $table->create();
    }
}
