<?php
	class Subject extends AppModel{
		
		public $validate = array(
			'name' => array(
				'required' => array(
					'rule' => array('notBlank'),
					'message' => 'Introduzca el nombre de la asignatura'
				)
			),
			'quarter' => array(
				'required' => array(
					'rule' => '(1|2)',
					'message' => 'selecione 1 o 2'
				)
			),
			'credits' => array(
				'required' => array(
					'rule' => 'numeric',
					'message' => 'Introduzca el número de creditos'
				)
			),'code' => array(
				'required' => array(
					'rule' => array('notBlank'),
					'message' => 'Introduzca un código de asignatura'
				)
			),'fechaInicio' => array(//ahora mismo non se usan
				'required' => array(
					'rule' => array('notBlank'),
					'message' => 'Introduzca la fecha de inicio'
				)
			),'fechaFin' => array(//ahora mismo non se usan
				'required' => array(
					'rule' => array('notBlank'),
					'message' => 'Introduzca la fecha de fin'
				)
			)
		);
	}
?>