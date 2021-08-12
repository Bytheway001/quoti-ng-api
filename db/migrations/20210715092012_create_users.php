<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateUsers extends AbstractMigration
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
        $table= $this->table('users',['collation'=>'utf8_spanish2_ci']);
        $table->addColumn('first_name','string',['limit'=>60])
        ->addColumn('last_name','string',['limit'=>60])
        ->addColumn('email','string',['limit'=>100])
        ->addColumn('country_code','string',['limit'=>4])
        ->addColumn('phone_number','string',['limit'=>12])
        ->addColumn('password','string',['limit'=>255])
        ->addColumn('confirmation_token','text')
        ->addColumn('access_token','string',['limit'=>255])
        ->addColumn('banned','integer',['limit'=>1])
        ->addColumN('last_sign_in','datetime')->create();
    }
}
