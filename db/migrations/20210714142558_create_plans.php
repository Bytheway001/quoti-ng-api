<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreatePlans extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        $table = $this->table('plans',['collation'=>'utf8_spanish2_ci']);
        $table->addColumn('region_id','integer',['limit'=>11])
        ->addColumn('name','string',['limit'=>50,'collation'=>'utf8_spanish2_ci'])
        ->addColumn('joint','boolean')
        ->addColumn('enabled','boolean')
        ->addColumn('quote_type','string',['limit'=>11])
        ->addForeignKey('name','plan_names','name',['delete'=>'RESTRICT','update'=>'RESTRICT'])
        ->create();
    }
}
