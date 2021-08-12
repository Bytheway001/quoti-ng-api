<?php


use Phinx\Seed\AbstractSeed;

class RegionsSeeder extends AbstractSeed
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
        $regions = [
            [
                "id" => 1,
                "company_id" => 1,
                "name" => "Allianz Sudamérica",
                "codename" => "AL-Sudamerica",
            ],
            [
                "id" => 2,
                "company_id" => 1,
                "name" => "Allianz Costa Rica",
                "codename" => "AL-Costa Rica",
            ],
            [
                "id" => 3,
                "company_id" => 1,
                "name" => "Allianz México",
                "codename" => "AL-Mexico",
            ],
            [
                "id" => 4,
                "company_id" => 2,
                "name" => "Vumi Chile",
                "codename" => "VU-Chile",
            ],
            [
                "id" => 5,
                "company_id" => 2,
                "name" => "Vumi Brasil",
                "codename" => "VU-Brasil",
            ],
            [
                "id" => 6,
                "company_id" => 2,
                "name" => "Vumi México",
                "codename" => "VU-Mexico",
            ],
            [
                "id" => 7,
                "company_id" => 2,
                "name" => "Vumi Bolivia",
                "codename" => "VU-Bolivia",
            ],
            [
                "id" => 8,
                "company_id" => 3,
                "name" => "Best Doctors Chile",
                "codename" => "BD-Chile",
            ],
            [
                "id" => 9,
                "company_id" => 3,
                "name" => "Best Doctors Brasil",
                "codename" => "BD-Brasil",
            ],
            [
                "id" => 10,
                "company_id" => 3,
                "name" => "Best Doctors Caribe",
                "codename" => "BD-Caribe",
            ],
            [
                "id" => 11,
                "company_id" => 3,
                "name" => "Best Doctors México",
                "codename" => "BD-Mexico",
            ],
            [
                "id" => 12,
                "company_id" => 3,
                "name" => "Best Doctors Bolivia",
                "codename" => "BD-Bolivia",
            ],
            [
                "id" => 13,
                "company_id" => 3,
                "name" => "Best Doctors Sudamérica",
                "codename" => "BD-Sudamerica",
            ],
            [
                "id" => 14,
                "company_id" => 5,
                "name" => "Bupa Miami",
                "codename" => "BU-Miami",
            ],
            [
                "id" => 15,
                "company_id" => 5,
                "name" => "Bupa Bolivia",
                "codename" => "BU-Bolivia",
            ],
            [
                "id" => 16,
                "company_id" => 3,
                "name" => "Best Doctors Ecuador",
                "codename" => "BD-Ecuador",
            ],
            [
                "id" => 17,
                "company_id" => 2,
                "name" => "Vumi Ecuador",
                "codename" => "VU-Ecuador",
            ],
            [
                "id" => 18,
                "company_id" => 2,
                "name" => "Vumi Sudamerica",
                "codename" => "VU-Sudamerica",
            ],
            [
                "id" => 19,
                "company_id" => 2,
                "name" => "Vumi Sudamerica II",
                "codename" => "VU-Sudamerica II",
            ],
            [
                "id" => 20,
                "company_id" => 2,
                "name" => "Vumi Peru",
                "codename" => "VU-Peru",
            ],
            [
                "id" => 21,
                "company_id" => 3,
                "name" => "Best Doctors Venezuela",
                "codename" => "BD-Venezuela",
            ],
            [
                "id" => 22,
                "company_id" => 3,
                "name" => "Best Doctors Centroamerica",
                "codename" => "BD-Centroamerica",
            ],
            [
                "id" => 23,
                "company_id" => 2,
                "name" => "Vumi Venezuela",
                "codename" => "VU-Venezuela",
            ],
            [
                "id" => 24,
                "company_id" => 2,
                "name" => "Vumi Centoamerica",
                "codename" => "VU-Centroamerica",
            ],
            [
                "id" => 25,
                "company_id" => 6,
                "name" => "BMI Sudamerica",
                "codename" => "BM-Sudamerica",
            ],
            [
                "id" => 26,
                "company_id" => 3,
                "name" => "Best Doctors Costa Rica",
                "codename" => "BD-Costa Rica",
            ],
        ];

        $table = $this->table('regions');
        $table->insert($regions)->saveData();


    }

    public function getDependencies(){
        return [
            'CompaniesSeeder'
        ];
    }
}
