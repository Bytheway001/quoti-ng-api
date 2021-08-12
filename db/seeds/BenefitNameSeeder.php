<?php


use Phinx\Seed\AbstractSeed;

class BenefitNameSeeder extends AbstractSeed
{
	public function getDependencies(){
		return['BenefitCategorySeeder'];
	}
	public function run()	{
		$data= [
			[
				"benefit_name" => "Cobertura máxima",
				"category_id" => 4,
			],
			[
				"benefit_name" => "Cobertura geográfica",
				"category_id" => 4,
			],
			[
				"benefit_name" => "Opciones de deducible",
				"category_id" => 4,
			],
			[
				"benefit_name" => "Coaseguro",
				"category_id" => 4,
			],
			[
				"benefit_name" => "Período general de espera",
				"category_id" => 4,
			],
			[
				"benefit_name" => "Red de proveedores (LATAM)",
				"category_id" => 4,
			],
			[
				"benefit_name" => "Red de proveedores (USA)",
				"category_id" => 4,
			],
			[
				"benefit_name" => "Red de proveedores (Resto del mundo)",
				"category_id" => 4,
			],
			[
				"benefit_name" => "Cobertura provisional para dependientes elegibles",
				"category_id" => 4,
			],
			[
				"benefit_name" => "Cobertura provisional para accidentes mientras se procesa la solicitud",
				"category_id" => 4,
			],
			[
				"benefit_name" => "Internación en el hospital y alimentos",
				"category_id" => 5,
			],
			[
				"benefit_name" => "Gastos de alojamiento para acompañantes en caso de hospitalización",
				"category_id" => 5,
			],
			[
				"benefit_name" => "Cama extra en el hospital para acompañante (una persona)",
				"category_id" => 5,
			],
			[
				"benefit_name" => "Derecho a sala, insumos, materiales clínicos y medicamentos",
				"category_id" => 5,
			],
			[
				"benefit_name" => "Cuidados intensivos",
				"category_id" => 5,
			],
			[
				"benefit_name" => "Cirugía, incluyendo honorarios de equipo médico quirúrgico",
				"category_id" => 5,
			],
			[
				"benefit_name" => "Exámenes de patología, radiología y diagnóstico",
				"category_id" => 5,
			],
			[
				"benefit_name" => "Fisioterapeutas, terapeutas ocupacionales, quinesiólogos, fonoaudiólogos y nutricionistas",
				"category_id" => 5,
			],
			[
				"benefit_name" => "Cirugía por obesidad\n(período de espera de 24 meses)",
				"category_id" => 5,
			],
			[
				"benefit_name" => "Cirugía preventiva",
				"category_id" => 5,
			],
			[
				"benefit_name" => "Prótesis",
				"category_id" => 5,
			],
			[
				"benefit_name" => "Implantes prostéticos y órtesis",
				"category_id" => 5,
			],
			[
				"benefit_name" => "Cirugía reconstructiva en caso de enfermedad o accidente",
				"category_id" => 5,
			],
			[
				"benefit_name" => "Imagenología avanzada",
				"category_id" => 1,
			],
			[
				"benefit_name" => "Condiciones congénitas y hereditarias (Diagnosticadas antes de los 18 años)",
				"category_id" => 1,
			],
			[
				"benefit_name" => "Condiciones congénitas y hereditarias (Diagnosticadas después de los 18 años)",
				"category_id" => 1,
			],
			[
				"benefit_name" => "Tratamiento contra el cáncer",
				"category_id" => 1,
			],
			[
				"benefit_name" => "Servicio de trasplantes \n(por diagnóstico de por vida)",
				"category_id" => 1,
			],
			[
				"benefit_name" => "Beneficio para el donante vivo (Diagnóstico para obtención, extracción, transporte de órganos, células o tejidos y costes médicos del donante vivo)",
				"category_id" => 1,
			],
			[
				"benefit_name" => "Diálisis renal",
				"category_id" => 1,
			],
			[
				"benefit_name" => "Síndrome de inmunodeficiencia adquirida (SIDA) ",
				"category_id" => 1,
			],
			[
				"benefit_name" => "Cobertura para actividades y deportes peligrosos (Sólo amateur)",
				"category_id" => 1,
			],
			[
				"benefit_name" => "Cobertura para actividades y deportes peligrosos (Profesionales)",
				"category_id" => 1,
			],
			[
				"benefit_name" => "Autismo",
				"category_id" => 1,
			],
			[
				"benefit_name" => "Enfermedad de Alzheimer",
				"category_id" => 1,
			],
			[
				"benefit_name" => "Tratamiento de alergias",
				"category_id" => 1,
			],
			[
				"benefit_name" => "Cirugía ambulatoria",
				"category_id" => 1,
			],
			[
				"benefit_name" => "Honorarios médicos",
				"category_id" => 1,
			],
			[
				"benefit_name" => "Enfermeros profesionales",
				"category_id" => 1,
			],
			[
				"benefit_name" => "Fisioterapeutas, osteópatas y quiroprácticos",
				"category_id" => 1,
			],
			[
				"benefit_name" => "Terapeuta ocupacional y ortóptico",
				"category_id" => 1,
			],
			[
				"benefit_name" => "Podología",
				"category_id" => 1,
			],
			[
				"benefit_name" => "Terapias complementarias",
				"category_id" => 1,
			],
			[
				"benefit_name" => "Consultas medicina alternativa",
				"category_id" => 1,
			],
			[
				"benefit_name" => "Medicamentos y materiales de curación con receta médica",
				"category_id" => 1,
			],
			[
				"benefit_name" => "Equipo médico durable",
				"category_id" => 1,
			],
			[
				"benefit_name" => "Asesoría nutricional",
				"category_id" => 1,
			],
			[
				"benefit_name" => "Salud mental durante la hospitalización",
				"category_id" => 12,
			],
			[
				"benefit_name" => "Salud mental en ambulatorio",
				"category_id" => 12,
			],
			[
				"benefit_name" => "Parto normal y cesárea electiva en el hospital\no clínica",
				"category_id" => 6,
			],
			[
				"benefit_name" => "Cesárea médicamente necesaria",
				"category_id" => 6,
			],
			[
				"benefit_name" => "Extracción y almacenamiento de células madres",
				"category_id" => 6,
			],
			[
				"benefit_name" => "Tratamiento pre y post natal",
				"category_id" => 6,
			],
			[
				"benefit_name" => "Complicaciones de la maternidad",
				"category_id" => 6,
			],
			[
				"benefit_name" => "Inclusión del recién nacido",
				"category_id" => 6,
			],
			[
				"benefit_name" => "Evacuación no-médica en casos de conflictos y desastres naturales",
				"category_id" => 3,
			],
			[
				"benefit_name" => "Costos de viaje de traslado para un acompañante",
				"category_id" => 3,
			],
			[
				"benefit_name" => "Costos de alimentación y transporte para acompañante",
				"category_id" => 3,
			],
			[
				"benefit_name" => "Costos de viaje de traslado de niños",
				"category_id" => 3,
			],
			[
				"benefit_name" => "Costos de viaje para visita compasiva\n",
				"category_id" => 3,
			],
			[
				"benefit_name" => "Costos de repatriación compasiva de emergencia",
				"category_id" => 3,
			],
			[
				"benefit_name" => "Ambulancia aérea",
				"category_id" => 3,
			],
			[
				"benefit_name" => "Ambulancia terrestre ",
				"category_id" => 3,
			],
			[
				"benefit_name" => "Repatriación de restos mortales",
				"category_id" => 3,
			],
			[
				"benefit_name" => "Tratamiento dental relacionado con accidentes",
				"category_id" => 2,
			],
			[
				"benefit_name" => "Tratamiento dental no estético (período de espera de 6 meses)",
				"category_id" => 2,
			],
			[
				"benefit_name" => "Restauración mayor no estética (período de espera de 6 meses)",
				"category_id" => 2,
			],
			[
				"benefit_name" => "Ortodoncia no estética \n(período de espera de 12 meses)",
				"category_id" => 2,
			],
			[
				"benefit_name" => "Examen de salud general\n(período de espera de 10 meses, no aplica deducible)",
				"category_id" => 8,
			],
			[
				"benefit_name" => "Vacunas",
				"category_id" => 8,
			],
			[
				"benefit_name" => "Examen de la vista (no aplica deducible)",
				"category_id" => 8,
			],
			[
				"benefit_name" => "Examen dental preventivo (período de espera de 6 meses, no aplica deducible)",
				"category_id" => 8,
			],
			[
				"benefit_name" => "Prueba genética de cáncer",
				"category_id" => 8,
			],
			[
				"benefit_name" => "Aparatos auditivos",
				"category_id" => 11,
			],
			[
				"benefit_name" => "Anteojos y lentes de contacto",
				"category_id" => 11,
			],
			[
				"benefit_name" => "Cirugía refractiva (1 por ojo, de por vida)",
				"category_id" => 11,
			],
			[
				"benefit_name" => "Enfermería en casa",
				"category_id" => 4,
			],
			[
				"benefit_name" => "Centro para pacientes terminales y cuidados paliativos",
				"category_id" => 4,
			],
			[
				"benefit_name" => "Beneficios Adicionales",
				"category_id" => 10,
			],
		];



		$table = $this->table('benefit_names');
		$table->insert($data)->saveData();

	}
}
