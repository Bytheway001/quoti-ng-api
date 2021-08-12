<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateOauthTables extends AbstractMigration
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
        $table = $this->table('oauth_clients',['id'=>false,'primary_key'=>'client_id']);
        $table->addColumn('client_id','string',['limit'=>80])
        ->addColumn('client_secret','string',['limit'=>80])
        ->addColumn('redirect_uri','string',['limit'=>2000])
        ->addColumn('grant_types','string',['limit'=>80])
        ->addColumn('scope','string',['limit'=>4000])
        ->addColumn('user_id','string',['limit'=>80])
        ->create();

        $table = $this->table('oauth_access_tokens',['id'=>false,'primary_key'=>'access_token']);
        $table->addColumn('access_token','string',['limit'=>40])
        ->addColumn('client_id','string',['limit'=>80])
        ->addColumn('user_id','string',['limit'=>80])
        ->addColumn('expires','timestamp')
        ->addColumn('scope','string',['limit'=>4000])
        ->create();

        $table = $this->table('oauth_authorization_codes',['id'=>false,'primary_key'=>'authorization_code']);
        $table->addColumn('authorization_code','string',['limit'=>40])
        ->addColumn('client_id','string',['limit'=>80])
        ->addColumn('user_id','string',['limit'=>80])
        ->addColumn('redirect_uri','string',['limit'=>2000])
        ->addColumn('expires','timestamp')
        ->addColumn('scope','string',['limit'=>4000])
        ->addColumn('id_token','string',['limit'=>1000])
        ->create();

        $table = $this->table('oauth_refresh_tokens',['id'=>false,'primary_key'=>'refresh_token']);
        $table->addColumn('refresh_token','string',['limit'=>40])
        ->addColumn('client_id','string',['limit'=>80])
        ->addColumn('user_id','string',['limit'=>80])
        ->addColumn('expires','timestamp')
        ->addColumn('scope','string',['limit'=>4000])
        ->create();

        $table = $this->table('oauth_users',['id'=>false,'primary_key'=>'username']);
        $table->addColumn('username','string',['limit'=>80])
        ->addColumn('password','string',['limit'=>80])
        ->addColumn('first_name','string',['limit'=>80])
        ->addColumn('last_name','string',['limit'=>80])
        ->addColumn('email','string',['limit'=>80])
        ->addColumn('email_verified','boolean')
        ->addColumn('scrope','string',['limit'=>4000])
        ->create();

        $table = $this->table('oauth_scopes',['id'=>false,'primary_key'=>'scope']);
        $table->addColumn('scope','string',['limit'=>80])
        ->addColumn('is_default','boolean')
        ->create();

        $table = $this->table('oauth_jwt',['id'=>false]);
        $table->addColumn('client_id','string',['limit'=>80])
        ->addColumn('subject','string',['limit'=>80])
        ->addColumn('public_key','string',['limit'=>2000])
        ->create();

    }
}
