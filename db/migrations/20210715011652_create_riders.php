<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateRiders extends AbstractMigration
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
        $table = $this->table('riders',['collation'=>'utf8_spanish2_ci']);

        $table->addColumn('plan_id','integer',['limit'=>11])
        ->addColumn('name_id','integer',['limit'=>11])
        ->addColumn('deductible','integer',['limit'=>11])
        ->addColumn('price','integer',['limit'=>11])
        ->addColumn('available','boolean')
        ->addColumn('selected','boolean')
        ->addForeignKey('plan_id','plans','id',['delete'=>"RESTRICT",'update'=>"RESTRICT"])
        ->create();
    }
}
