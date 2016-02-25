<?php
	App::uses('AppModel', 'Model');
    App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
	class User extends AppModel{

		public $validate = array(
			'username' => array(
				'required' => array(
					'rule' => array('notBlank'),
					'message' => 'Introduzca el nombre de usuario'
				)
			),
			'password' => array(
				'required' => array(
					'rule' => array('notBlank'),
					'message' => 'Introduzca la contraseña'
				)
			),
			'name' => array(
				'required' => array(
					'rule' => array('notBlank'),
					'message' => 'Introduzca el nombre'
				)
			),'surname' => array(
				'required' => array(
					'rule' => array('notBlank'),
					'message' => 'Introduzca los apellidos'
				)
			),'password_2' => array(
				'required' => array(
					'rule' => array('notBlank'),
					'message' => 'Introduzca la contraseña'
				)
			),'email' => array(
				'required' => array(
					'rule' => array('email',false),
					'message' => 'Introduzca un correo electrónico Ex:ejemplo@correo.com'
				)
			)
		);
	

		public function beforeSave($options = array()) {
			if (isset($this->data[$this->alias]['password'])) {
				$passwordHasher = new BlowfishPasswordHasher();
				$this->data[$this->alias]['password'] = $passwordHasher->hash(
					$this->data[$this->alias]['password']
				);
			}
			return true;
		}
	
		function getProffesorData ($id){
			return $this->query("SELECT t.place, p.name, p.id, p.surname, a.name, t.day, t.start_hour, t.finish_hour, t.start_minute,t.finish_minute FROM tutorials t, users p, subjects a WHERE p.id = t.user_id AND t.subject_id=a.id AND p.id='".$id."'");
		}	
	}
?>