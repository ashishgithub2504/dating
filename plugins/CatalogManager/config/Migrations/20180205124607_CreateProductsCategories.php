<?php
use Migrations\AbstractMigration;

class CreateProductsCategories extends AbstractMigration
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
        $table = $this->table('products_categories');
        $table->addColumn('product_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('category_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addForeignKey('product_id', 'products', ['id'],
                            ['constraint'=>'fk_product_products_categories','delete'=> 'CASCADE', 'update'=> 'RESTRICT',]);
        $table->addForeignKey('category_id', 'categories', ['id'],
                            ['constraint'=>'fk_category_products_categories','delete'=> 'CASCADE', 'update'=> 'RESTRICT',]);
        $table->create();
    }
}
