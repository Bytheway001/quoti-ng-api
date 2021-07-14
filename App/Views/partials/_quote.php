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
		if($rider->config->selected==1){
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



</style>
<title>Cotizacion</title>

</head>
<body>
	<div id='page-wrapper'>
		<table>
			<thead>
				<tr>
					<td colspan="5" class='dark-blue-bg quote-title'>
						Cotizacion de seguro de salud internacional
					</td>
				</tr>
				<tr>
					<th>
						<p>Fecha: <?= date('d/m/Y') ?></p>
					</th>
					<?php foreach($plans as $plan): ?>
						<?php View::set('plan',$plan) ?>
						<?= View::render_partial('partials','header'); ?>
					<?php endforeach; ?>
					
				</tr>
				<tr class='deductibles-row dark-blue-bg'>
					
					<th>Deducible Seleccionado</th>
					<?php foreach($plans as $plan): ?>
						<th>$<?= number_format($plan->deductible) ?></th>
					<?php endforeach; ?>
				</tr>
				<tr class='deductibles-row light-blue-bg'>
					<th>Prima Titular</th>
					<?php foreach($plans as $plan): ?>
						<th>$<?= number_format($plan->rate->main_price->yearly) ?></th>

					<?php endforeach; ?>
				</tr>
				<?php if($plans[0]->rate->couple_price): ?>
					<tr class='deductibles-row  light-blue-bg'>
						<th>Prima Conyugue</th>
						<?php foreach($plans as $plan): ?>
							<th><?= number_format($plan->rate->couple_price->yearly) ?></th>
						<?php endforeach; ?>
					</tr>
				<?php endif ?>
				<?php if($plans[0]->rate->kids_price): ?>
					<tr class='deductibles-row  light-blue-bg'>
						<th>Prima Conyugue</th>
						<?php foreach($plans as $plan): ?>
							<th><?= number_format($plan->rate->kids_price->yearly) ?></th>
						<?php endforeach; ?>
					</tr>
				<?php endif ?>
				<tr>

					<td colspan="5" class='dark-blue-bg quote-title'>
						Endosos y Gastos Administrativos
					</td>
				</tr>
				<tr  class='deductibles-row  light-blue-bg'>
					
					<th>Costo Administrativo</th>
					<?php foreach($plans as $plan): ?>
						<?php $key = array_search('Costo Administrativo', array_column($plan->rate->riders, 'name')); ?>
						<?php if($plan->rate->riders[$key]->config->selected==1): ?>
							<th>$<?= number_format($plan->rate->riders[$key]->price) ?></th>
						<?php else: ?>
							<th>--</th>
						<?php endif ?>
					<?php endforeach; ?>
				</tr>
				<tr  class='deductibles-row  light-blue-bg'>
					
					<th>Complicaciones de Maternidad</th>
					<?php foreach($plans as $plan): ?>
						<?php $key = array_search('Complicaciones de Maternidad', array_column($plan->rate->riders, 'name')); ?>
						<?php if($plan->rate->riders[$key]->config->selected==1): ?>
							<th>$<?= number_format($plan->rate->riders[$key]->price) ?></th>
						<?php else: ?>
							<th>--</th>
						<?php endif ?>
					<?php endforeach; ?>
				</tr>
				<tr  class='deductibles-row  light-blue-bg'>
					
					<th>Transplante de Órganos</th>
					<?php foreach($plans as $plan): ?>
						<?php $key = array_search('Transplante de Órganos', array_column($plan->rate->riders, 'name')); ?>
						<?php if($plan->rate->riders[$key]->config->selected==1): ?>
							<th>$<?= number_format($plan->rate->riders[$key]->price) ?></th>
						<?php else: ?>
							<th>--</th>
						<?php endif ?>
					<?php endforeach; ?>
				</tr>
				<tr>

					<td  class='dark-blue-bg quote-title' colspan="5">
						Prima Total Anual
					</td>
				</tr>
				<tr  class='deductibles-row  light-blue-bg'>
					<th style="color:yellow;font-size:1.2em">Prima año Poliza</th>
					<?php foreach($plans as $plan): ?>
						<th style="color:yellow;font-size:1.2em" >$<?= number_format(totalize($plan)) ?></th>
					<?php endforeach; ?>
				</tr>
			</thead>

		</table>

	</div>

</body>

</html>