<?php


use Phinx\Seed\AbstractSeed;

class CompaniesSeeder extends AbstractSeed
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
        $companies = [
            [
                "id" => 1,
                "name" => "Allianz Care",
                "slug" => "allianz",
                "short_name" => "Allianz",
            ],
            [
                "id" => 2,
                "name" => "Vumi Group",
                "slug" => "vumi",
                "short_name" => "Vumi",
            ],
            [
                "id" => 3,
                "name" => "Best Doctors Insurance",
                "slug" => "bestdoctors",
                "short_name" => "Best Doctors",
            ],
            [
                "id" => 4,
                "name" => "Megabrokers Latam",
                "slug" => "mblatam",
                "short_name" => "Megabrokers Latam",
            ],
            [
                "id" => 5,
                "name" => "Bupa Salud",
                "slug" => "bupa",
                "short_name" => "Bupa",
            ],
            [
                "id" => 6,
                "name" => "BMI Seguros",
                "slug" => "bmi",
                "short_name" => "BMI",
            ],
            [
                "id" => 7,
                "name" => "AmFirst",
                "slug" => "amfirst",
                "short_name" => "AmFirst",
            ],
            [
                "id" => 8,
                "name" => "American Fidelity",
                "slug" => "american",
                "short_name" => "American",
            ],
        ];

        $table = $this->table('companies');
        $table->insert($companies)->saveData();


    }
}
