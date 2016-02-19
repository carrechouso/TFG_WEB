<?php
	class Tutorial extends AppModel{
		public $validate = array(
			'subject_id' => array(
				'required' => array(
					'rule' => array('notBlank'),
					'message' => 'Introduzca el id de la asignatura'
				)
			),
			'user_id' => array(
				'required' => array(
					'rule' => array('notBlank'),
					'message' => 'Introduzca el id del profesor'
				)
			),
			'day' => array(
				'required' => array(
					'rule' => array('notBlank'),
					'message' => 'Selecciones el día'
				)
			),'star_hour' => array(
				'required' => array(
					'rule' => array('notBlank'),
					'message' => 'Introduzca la hora. Ej:09:50'
				)
			),'finish_hour' => array(
				'required' => array(
					'rule' => array('notBlank'),
					'message' => 'Introduzca la hora. Ej:09:50'
				)
			),'place' => array(
				'required' => array(
					'rule' => 'notBlank',
					'message' => 'Introduzca el numero del despacho'
				)
			),'start_minute' => array(
				'required' => array(
					'rule' => array('notBlank'),
					'message' => 'Introduzca la hora. Ej:09:50'
				)
			),'finish_finute' => array(
				'required' => array(
					'rule' => array('notBlank'),
					'message' => 'Introduzca la hora. Ej:09:50'
				)
			)
		);
		
		public $belongsTo = array(
        	'User' => array(
            	'className' => 'User',
            	'foreignKey' => 'user_id'
        	),
        	'Subject' => array(
            	'className' => 'Subject',
            	'foreignKey' => 'subject_id'
        	)
    	);
	}
?>