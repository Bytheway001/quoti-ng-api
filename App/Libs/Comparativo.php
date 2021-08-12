<?php
namespace App\Libs;

use App\Models\{PlanName,Benefit,BenefitCategory,BenefitName};
class Comparativo
{
    public $result = ['categories'=>[]];
    public function __construct($payload)
    {
        $this->payload = $payload;
        $this->result['categories']=BenefitCategory::list();
        $this->result['benefits']=BenefitName::list(['order'=>'category_id']);
        if ($payload) {
            $this->plans = PlanName::all(['select'=>'distinct(name)','conditions'=> ["name IN (?)",$payload]]);
        }
    }

    public function execute(){
        $result=[];
        foreach($this->plans as $plan){
          $this->result['plans'][]=[
            'name'=>$plan->name,
            'benefits'=>$plan->benefits
        ];
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
