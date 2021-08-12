<?php


use Phinx\Seed\AbstractSeed;

class RiderNameSeeder extends AbstractSeed
{
	/**
	 * Run Method.
	 *
	 * Write your database seeder using this method.
	 *
	 * More information on writing seeders is available here:
	 * https://book.cakephp.org/phinx/0/en/seeding.html
	 */
	public function run()
	{
		$riderNames = [     
			[
				'name'=>'Complicaciones de Maternidad'

			],
			[
				'name'=>'Transplante de Organos'

			],
			[
				'name'=>'Costo Administrativo'
			],
		];

		$table = $this->table('rider_names');
		$table->insert($riderNames)->saveData();

	}
}
