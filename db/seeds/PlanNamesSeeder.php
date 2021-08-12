<?php


use Phinx\Seed\AbstractSeed;

class PlannamesSeeder extends AbstractSeed
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
        $plan_names = [
            [
                "name" => "Absolute VIP",
            ],
            [
                "name" => "Access VIP",
            ],
            [
                "name" => "Advance Care",
            ],
            [
                "name" => "Advantage Care",
            ],
            [
                "name" => "Azure Guarantee",
            ],
            [
                "name" => "Complete Care",
            ],
            [
                "name" => "Critical Care",
            ],
            [
                "name" => "Diamond Care",
            ],
            [
                "name" => "Essential Care",
            ],
            [
                "name" => "Flex 1",
            ],
            [
                "name" => "Flex 2",
            ],
            [
                "name" => "Global Care",
            ],
            [
                "name" => "Global Elite",
            ],
            [
                "name" => "Global Elite (R)",
            ],
            [
                "name" => "Global Major Medical",
            ],
            [
                "name" => "Global Major Medical (R)",
            ],
            [
                "name" => "Global Pass Connect Latam",
            ],
            [
                "name" => "Global Pass Connect Latam (Sin Dental)",
            ],
            [
                "name" => "Global Pass Connect Mundial",
            ],
            [
                "name" => "Global Pass Connect Mundial (Sin Dental)",
            ],
            [
                "name" => "Global Pass Choice I Latam",
            ],
            [
                "name" => "Global Pass Choice I Latam (Sin Dental)",
            ],
            [
                "name" => "Global Pass Choice I Mundial",
            ],
            [
                "name" => "Global Pass Choice I Mundial (Sin Dental)",
            ],
            [
                "name" => "Global Pass Choice II Latam",
            ],
            [
                "name" => "Global Pass Choice II Mundial",
            ],
            [
                "name" => "Global Premier",
            ],
            [
                "name" => "Global Premier (R)",
            ],
            [
                "name" => "Global Select",
            ],
            [
                "name" => "Global Select (R)",
            ],
            [
                "name" => "Global Ultimate",
            ],
            [
                "name" => "Global Ultimate (R)",
            ],
            [
                "name" => "Ideal 500",
            ],
            [
                "name" => "Medical Care Global",
            ],
            [
                "name" => "Medical Care Latam",
            ],
            [
                "name" => "Medical Elite",
            ],
            [
                "name" => "Medical Select",
            ],
            [
                "name" => "Meridian II Guarantee",
            ],
            [
                "name" => "Optimum VIP",
            ],
            [
                "name" => "Premier Care",
            ],
            [
                "name" => "Premier Plus",
            ],
            [
                "name" => "Prime Care",
            ],
            [
                "name" => "Secure Care",
            ],
            [
                "name" => "Senior VIP",
            ],
            [
                "name" => "Special VIP",
            ],
            [
                "name" => "Ultimate Care",
            ],
            [
                "name" => "Universal VIP",
            ],
        ];

        $table = $this->table('plan_names');
        $table->insert($plan_names)->saveData();

    }
}
