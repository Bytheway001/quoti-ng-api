<?php 
use Core\View;
$darkBlue = "#0747a6";
$lightBlue = "#5b86e5";
$plans = $local;

View::set('a','b');

function totalize($plan){
	$initialPrice = $plan->rate->main_price->yearly;
	if($plan->rate->couple_price){
		$initialPrice+= $plan->rate->couple_price->yearly;
	}
	if($plan->rate->kids_price){
		$initialPrice+= $plan->rate->kids->yearly;
	}
	foreach($plan->rate->riders as $rider){
		if($rider->selected==1){
			$initialPrice += $rider->price;
		}
	}
	return $initialPrice;
}

?>
<html>
<head>
	<meta charset="utf-8">
	<style>
	#page-wrapper{
		padding: 20px;
	}
	.dark-blue-bg{
		background: <?=$darkBlue; ?>;
	}
	.light-blue-bg{
		background: <?=$lightBlue; ?>;
	}
	p{
		margin: 0px;
	}
	body{

		font-family: arial;

	}
	table{
		
		width: 100%;
		border-collapse: collapse;
	}
	table td,table th{
		

	}
	.table-header{
		padding: 5px;
	}
	.table-header-inner{
		padding: 10px;
		color: white;
		border-radius: 10px;
	}
	.quote-title{
		padding: 10;
		color: white;
		text-transform: uppercase;
		font-size: 1.5em;
		text-align: center;

	}
	.deductibles-row th{
		color: white;
		padding: 10px;
	}
	.deductibles-row th:first-child{
		text-align: left;
	}
	td{
		padding: 8px;
		vertical-align: middle;
		text-align: center;
	}
	th{
		padding: 8px;
		text-align: left;
	}
	tr:nth-child(odd){
		background-color:  <?=$lightBlue; ?>;
	}



</style>
<title>Cotizacion</title>

</head>
<body>
	<div id='page-wrapper'>
		<table>
			<thead>
				<tr>
					<td colspan="5" class='dark-blue-bg quote-title'>
						Comparativo de Beneficios
					</td>
				</tr>
				<tr class='deductibles-row dark-blue-bg'>
					<th style="text-align:center">Beneficio</th>
					<?php foreach($plans as $plan): ?>
						<td style="color:white;text-align:center"><?= $plan ?></td>
					<?php endforeach; ?>
				</tr>
			</thead>
			<tbody>
				
				<?php foreach(\App\Models\BenefitName::all() as $bn): ?>
					<tr>
						<th><?= $bn->name ?></th>
						<?php foreach($plans as $plan): ?>
							<td><?= \App\Models\Benefit::find(['conditions'=>['plan_name = ? and name_id = ?',$plan,$bn->id]])->description ?></td>
						<?php endforeach; ?>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>

	</div>

</body>

</html>