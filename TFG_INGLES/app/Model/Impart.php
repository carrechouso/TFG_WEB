<?php
	class Impart extends AppModel{
		
			public $validate = array(
			'subject_id' => array(
				'required' => array(
					'rule' => array('notBlank'),
					'message' => 'Introduzca el id de la asignatura'
				)
			),'user_id' => array(
				'required' => array(
					'rule' => array('notBlank'),
					'message' => 'Introduzca el id del profesor'
				)
			)
		);
		
		
		 function getDatos(){
			return $this->query("SELECT * FROM subjects a, users p, imparts i WHERE a.id = i.subject_id AND  p.id = i.user_id");
		}
	}
?>