<?php
use Migrations\AbstractMigration;

class CreateProductOptionValues extends AbstractMigration
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
        $table = $this->table('product_option_values');
        $table->addColumn('product_option_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('option_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('options_value_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('quantity', 'integer', [
            'default' => null,
            'limit' => 4,
            'null' => false,
        ]);
        $table->addColumn('subtract', 'boolean', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('price', 'decimal', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('price_prefix', 'char', [
            'default' => null,
            'limit' => 1,
            'null' => false,
        ]);
        $table->addColumn('weight', 'decimal', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('weight_prefix', 'char', [
            'default' => null,
            'limit' => 1,
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
            'product_option_id',
        ], [
            'name' => 'BY_PRODUCT_OPTION_ID',
            'unique' => false,
        ]);
        $table->create();
    }
}
