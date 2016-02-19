<?php
	class Change extends AppModel{
		
		public $validate = array(
			
			'date' => array(
				'required' => array(
					'rule' => array('notBlank'),
					'message' => 'Selecciones el día'
				)
			),'newDate' => array(
				'required' => array(
					'rule' => array('notBlank'),
					'message' => 'Selecciones el día'
				)
			),
			'start_hour' => array(
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
			),'finish_minute' => array(
				'required' => array(
					'rule' => array('notBlank'),
					'message' => 'Introduzca la hora. Ej:09:50'
				)
			)
		);
		
		public function getData(){
			return $this->query("SELECT c.id, a.name, c.newDate, c.place, c.date, c.user_id, c.start_hour, c.finish_hour, c.start_minute, c.finish_minute, p.name, p.surname FROM changes c, tutorials t, users p, subjects a WHERE  c.tutorial_id = t.id and p.id = c.user_id and t.user_id = p.id and t.subject_id = a.id");
		}

		 public $belongsTo = array(
        	'Tutorial' => array(
            	'className' => 'Tutorial',
            	'foreignKey' => 'tutorial_id'
        	),
        	'User' => array(
            	'className' => 'User',
            	'foreignKey' => 'user_id'
            )
    	);
	}
?>