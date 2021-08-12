<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AddKidRates extends AbstractMigration
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
        $table = $this->table('kid_rates',['collation'=>'utf8_spanish2_ci']);
        $table->addColumn('plan_id','integer',['limit'=>11])
        ->addColumn('num_kids','integer',['limit'=>1])
        ->addColumn('deductible','integer',['limit'=>11])
        ->addColumn('yearly_price','integer',['limit'=>11])
        ->addColumn('biyearly_price','integer',['limit'=>11])
        ->addColumn('year','integer',['limit'=>4])
        ->addForeignKey('plan_id','plans','id',['delete'=>"RESTRICT",'update'=>"RESTRICT"])
        ->create();
    }
}
