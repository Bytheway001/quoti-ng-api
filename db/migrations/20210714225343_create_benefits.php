<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateBenefits extends AbstractMigration
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
        $table = $this->table('benefits',['collation'=>'utf8_spanish2_ci']);
        $table->addColumn('name_id','integer',['limit'=>11])
        ->addColumn('description','text')
        ->addColumn('plan_name','string',['limit'=>50,'collation'=>'utf8_spanish2_ci'])
        ->addForeignKey('name_id','benefit_names','id',['delete'=>"RESTRICT",'update'=>"RESTRICT"])
        ->addForeignKey('plan_name','plan_names','name',['delete'=>"RESTRICT",'update'=>'RESTRICT'])
        ->create();
    }
}
