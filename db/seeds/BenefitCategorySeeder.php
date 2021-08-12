<?php


use Phinx\Seed\AbstractSeed;

class BenefitCategorySeeder extends AbstractSeed
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
        $data = array(
            array(
                
                "category_name" => "Ambulatorios",
            ),
            array(
                "category_name" => "Dentales",
            ),
            array(
                "category_name" => "Evacuación Médica",
            ),
            array(
                "category_name" => "Generales",
            ),
            array(
                "category_name" => "Hospitalarios",
            ),
            array(
                "category_name" => "Maternidad",
            ),
            array(
                "category_name" => "Otros",
            ),
            array(
                "category_name" => "Preventivos",
            ),
            array(
                "category_name" => "Principales",
            ),
            array(
                "category_name" => "Únicos",
            ),
            array(
                "category_name" => "Vista/Oido",
            ),
            array(
                "category_name" => "Salud Mental"
            )
        );
        $table = $this->table('benefit_categories');
        $table->insert($data)->saveData();

    }
}