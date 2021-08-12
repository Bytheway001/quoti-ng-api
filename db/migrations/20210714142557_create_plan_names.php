<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreatePlanNames extends AbstractMigration
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
        $table = $this->table('plan_names',['collation'=>'utf8_spanish2_ci']);
        $table->addColumn('name','string',['limit'=>50,'collation'=>'utf8_spanish2_ci'])
        ->addIndex(['name'])
        ->create();
    }
}
