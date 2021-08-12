<?php 
namespace App\Controllers;
use Core\{Request,Response};
use App\Libs\{QuotePDF,ComparePDF};

class exportsController extends Controller{

	public function getFakeData(){

		return json_decode('[
		{
			"coverage": "US$7,000,000",
			"company": "Best Doctors Insurance",
			"name": "Premier Plus",
			"deductible": 1250,
			"rate": {
				"deductible": 1250,
				"deductible_out": 500,
				"main_price": {
					"yearly": 8847,
					"biyearly": 4689
					},
					"couple_price": null,
					"kids_price": null,
					"riders": [
					{
						"name": "Transplante de Órganos",
						"price": 400,
						"config": {
							"selected": 0,
							"available": 1
						}
						},
						{
							"name": "Complicaciones de Maternidad",
							"price": 300,
							"config": {
								"selected": 0,
								"available": 1
							}
							},
							{
								"name": "Costo Administrativo",
								"price": 75,
								"config": {
									"selected": 1,
									"available": 1
								}
							}
							]
						}
						},
						{
							"coverage": "US$7,000,000",
							"company": "Best Doctors Insurance",
							"name": "Premier Plus",
							"deductible": 1250,
							"rate": {
								"deductible": 1250,
								"deductible_out": 500,
								"main_price": {
									"yearly": 8847,
									"biyearly": 4689
									},
									"couple_price": null,
									"kids_price": null,
									"riders": [
									{
										"name": "Transplante de Órganos",
										"price": 400,
										"config": {
											"selected": 0,
											"available": 1
										}
										},
										{
											"name": "Complicaciones de Maternidad",
											"price": 300,
											"config": {
												"selected": 0,
												"available": 1
											}
											},
											{
												"name": "Costo Administrativo",
												"price": 75,
												"config": {
													"selected": 1,
													"available": 1
												}
											}
											]
										}
										},
										{
											"coverage": "US$7,000,000",
											"company": "Best Doctors Insurance",
											"name": "Premier Plus",
											"deductible": 1250,
											"rate": {
												"deductible": 1250,
												"deductible_out": 500,
												"main_price": {
													"yearly": 8847,
													"biyearly": 4689
													},
													"couple_price": null,
													"kids_price": null,
													"riders": [
													{
														"name": "Transplante de Órganos",
														"price": 400,
														"config": {
															"selected": 0,
															"available": 1
														}
														},
														{
															"name": "Complicaciones de Maternidad",
															"price": 300,
															"config": {
																"selected": 0,
																"available": 1
															}
															},
															{
																"name": "Costo Administrativo",
																"price": 75,
																"config": {
																	"selected": 1,
																	"available": 1
																}
															}
															]
														}
														},
														{
															"coverage": "US$7,000,000",
															"company": "Best Doctors Insurance",
															"name": "Premier Plus",
															"deductible": 1250,
															"rate": {
																"deductible": 1250,
																"deductible_out": 500,
																"main_price": {
																	"yearly": 8847,
																	"biyearly": 4689
																	},
																	"couple_price": null,
																	"kids_price": null,
																	"riders": [
																	{
																		"name": "Transplante de Órganos",
																		"price": 400,
																		"config": {
																			"selected": 0,
																			"available": 1
																		}
																		},
																		{
																			"name": "Complicaciones de Maternidad",
																			"price": 300,
																			"config": {
																				"selected": 0,
																				"available": 1
																			}
																			},
																			{
																				"name": "Costo Administrativo",
																				"price": 75,
																				"config": {
																					"selected": 1,
																					"available": 1
																				}
																			}
																			]
																		}
																	}
																]');

}
public function exportQuote(){
	try{
		$compare =json_decode(json_encode(Request::instance()->payload));


		$pdf = new QuotePDF($compare);

		$content = $pdf->toString();

		Response::send(200,base64_encode($content));
	}
	catch(\Exception $e){
		print_r($e->getMessage());
		die();
	}

}

public function exportCompare(){
	
	try{
		$compare =json_decode(json_encode(Request::instance()->payload));
		$pdf = new ComparePDF($compare);
		$content = $pdf->toString();

		Response::send(200,base64_encode($content));
	}
	catch(\Exception $e){
		print_r($e->getMessage());
		die();
	}
	
}


}
?>