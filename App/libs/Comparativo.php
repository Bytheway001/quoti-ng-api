<?php
namespace App\Libs;

use App\Models\Plan;
use App\Models\Benefit;

class Comparativo
{
    public $result = ['categories'=>[]];
    public function __construct($payload)
    {
        $this->payload = $payload;
        if ($payload) {
            $this->plans = Plan::all(['select'=>'distinct(name)','conditions'=> ["name IN (?)",(array)$payload]]);
        }
    }

    public function execute()
    {
        $benefits = Benefit::list(['select'=>'es,type_id']);
        foreach ($benefits as $benefit) {
            $this->result['benefits'][]=['name'=>$benefit['es'],'category'=>$benefit['type_id']];
            if (!in_array($benefit['type_id'], $this->result['categories'])) {
                $this->result['categories'][]=$benefit['type_id'];
            }
        }
        foreach ($this->plans as $plan) {
            $this->result['plans'][]=['name'=>$plan->name,'benefits'=>$plan->getBenefits()];
        }
    }

    public function isValid()
    {
        if (empty($this->payload)) {
            return false;
        }
        return true;
    }
}
