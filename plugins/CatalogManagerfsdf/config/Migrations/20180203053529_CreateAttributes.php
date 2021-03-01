<?php
use Migrations\AbstractMigration;

class CreateAttributes extends AbstractMigration
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
        $table = $this->table('attributes');
        $table->addColumn('attribute_group_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('title', 'string', [
            'default' => null,
            'limit' => 100,
            'null' => false,
        ]);
        $table->addColumn('sort_order', 'integer', [
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
            'attribute_group_id',
        ], [
            'name' => 'BY_ATTRIBUTE_GROUP_ID',
            'unique' => false,
        ]);
       
        $table->addForeignKey('attribute_group_id', 'attribute_groups', ['id'],
                            ['constraint'=>'fk_attribute_group_id','delete'=> 'CASCADE', 'update'=> 'RESTRICT',]);
        
        $table->create();
    }
}
