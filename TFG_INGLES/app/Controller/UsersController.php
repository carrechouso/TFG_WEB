<?php
	App::uses('AppController', 'Controller');
	class UsersController extends AppController {

		public function beforeFilter() {
		    parent::beforeFilter();
		    $this->Auth->allow('add', 'logout','login', 'recover');
		}

	
	public function login(){
			if ($this->request->is('post')) {
				if ($this->Auth->login()) {
					$userData = $this->User->find('all', array('conditions'=> array('User.username =' => $this->request->data['User']['username'])));
				   //usar auth
				    $this->Session->write('userType', $userData[0]['User']['type']);
					$this->Session->write('userData', $userData);
					print_r($userData);
					return $this->redirect($this->Auth->redirect());
				}else{
					$this->Flash->set('usuario o contraseña incorrecta');
					return $this->redirect(array('controller' => 'pages', 'action' => 'home'));
				}
			}
		}
		public function index(){}

		 public function add(){

		 	if($this->request->is('post')){
		 		$num = $this->User->find('count', array('conditions' => array('User.username =' => $this->request->data['User']['username'])));
		 		
		 		if($num == 1){
		 			$this->Flash->set('Ese nombre de usuario ya existe');
		 		}else{
		 			if($this->request->data['User']['password'] != $this->request->data['User']['password_2']){
		 			  $this->Flash->set('las contraseñas no son iguales');
		 			}else{
		 				$this->User->set($this->request->data);
		 				if($this->User->validates()){
			 				$this->User->save($this->request->data);
						    $this->Flash->success('Alumno registrado correctamente');
							return $this->redirect(array('controller' => 'pages', 'action' => 'home'));	
						}else{
							 $this->Flash->set('Alguno de los datos es incorrecto');
						}	
		 			}
		 		}
		 	}
		}
		

		public function logout(){
			$this->Session->destroy();
			 return $this->redirect($this->Auth->logout());	
		}
	
	public function proffesorsList(){
			
			if ($this->request->is('get')){
				$this->set('proffesors', $this->User->find('all',array('conditions' => array('User.type' => 'profesor'))));
			}
		}

		
	public function allProffesorsData(){

			if($this->request->is('get')){
				$this->set('data', $this->User->find('all',array('conditions' => array('User.type' => 'profesor'))));
			}
		}
	

		public function addProffesor(){

		 	if($this->request->is('post')){
		 		$num = $this->User->find('count', array('conditions' => array('User.username =' => $this->request->data['User']['username'])));
		 		
		 		if($num == 1){
		 			$this->Flash->set('Ese nombre de usuario ya existe');
		 		}else{
		 			if($this->request->data['User']['password'] != $this->request->data['User']['password_2']){
		 			  $this->Flash->set('las contraseñas no son iguales');
		 			}else{
		 				$this->User->set($this->request->data);
		 				if($this->User->validates()){
			 				$this->User->save($this->request->data);
						    $this->Flash->success('Profesor registrado correctamente');
							return $this->redirect(array('controller' => 'users', 'action' => 'index'));	
						}else{
							 $this->Flash->set('Alguno de los datos es incorrecto');
						}		
		 			}
		 		}
		 	}
		}


		public function proffesorData(){

			if($this->request->is('get')){
				//echo $this->params['url']['profesor_id'];
				$this->set('name', $this->params['url']['name']);
				$this->set('surname', $this->params['url']['surname']);
				$this->set('data', $this->User->getProffesorData($this->params['url']['proffesor_id']));
			}
		}

			public function authList(){

			if($this->request->is('get')){
				$this->set('validateUsers', $this->User->find('all', array("conditions" => array('User.authenticated' => 1))));
				$this->set('NonvalidateUsers', $this->User->find('all', array("conditions" => array('User.authenticated' => 0))));
			}
		}

		 public function removeAuth(){
		 	if($this->request->is('post')){
		 		$this->User->updateAll(array('authenticated'=>False), array('User.id'=> $this->request->data['User']['id']));
		 		$this->Flash->success (('Email ' . $this->request->data['User']['email']) . ' deshabilitado');
		 		return $this->redirect (array('controller' => 'Users', 'action' => 'authList'));
		 	}
		}

		 public function addAuth(){
		 	if($this->request->is ('post')){
		 		$this->User->updateAll(array('authenticated'=>True), array('User.id'=> $this->request->data['User']['id']));
		 		$this->Flash->success (('Email ' . $this->request->data['User']['email']) . ' habilitado');
		 		return $this->redirect (array('controller' => 'Users', 'action' => 'authList'));
		 	}
		}

		public function removeProffesor($id){
			if($this->request->is('post')){
				$this->loadModel('Impart');
				$this->loadModel('Tutorial');
				$this->loadModel('Change');
				$this->loadModel('Message');
				$subjects = $this->Impart->find('all', array('conditions' => array('Impart.user_id' => $id)));

				foreach($subjects as $subject){
					$tutorials = $this->Tutorial->find('all', array('conditions', array('Tutorial.subject_id' => $subject['Impart']['subject_id'], 'Tutorial.user_id' => $id)));
					
					foreach($tutorials as $tutorial){
						$this->Change->deleteAll(array('Change.tutorial_id' => $tutorial['Tutorial']['id'], 'Change.user_id' => $id), false);
					}
					$this->Tutorial->delete($tutorial['Tutorial']['id'] ,True);
				}
				
				$this->Message->deleteAll(array('Message.receiver_id' =>$id), false);
				$this->Message->deleteAll(array('Message.transmitter_id' =>$id), false);
				$this->User->delete($id, True);
				$this->Flash->success ('Profesor eliminado correctamente');
				return $this->redirect (array('controller' => 'Users', 'action' => 'allProffesorsData'));
			}
		}

	public function recover(){

	}
}
?>