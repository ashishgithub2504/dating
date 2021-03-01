<?php
use Migrations\AbstractMigration;

class CreateRelatedProducts extends AbstractMigration
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
        $table = $this->table('related_products');
        $table->addColumn('product_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('related_id', 'integer', [
            'default' => null,
            'limit' => 11,
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
                            ['constraint'=>'fk_product_related_products','delete'=> 'CASCADE', 'update'=> 'RESTRICT',]);
        $table->addForeignKey('related_id', 'products', ['id'],
                            ['constraint'=>'fk_releted_related_products','delete'=> 'CASCADE', 'update'=> 'RESTRICT',]);
        $table->create();
    }
}
