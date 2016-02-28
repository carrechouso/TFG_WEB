<?php
	class ChangesController extends AppController {

		 public function index(){

			if($this->request->is('get') && ( AuthComponent::user('type') == 'admin' || AuthComponent::user('type') == 'profesor' )){
							
				$this->set('tutorials', $this->Change->getData());
				//$log = $this->Change->getDataSource()->getLog(false, false);
				//debug($log);			
			}else{
				$this->Flash->set('No estas autorizado a entrar en esta zona');
				return $this->redirect(array('controller' => 'users', 'action' => 'index'));
			}
		}
	
		 public function add(){//comprobar que non exista unha tutoria con eses mismos datos

		 	if( AuthComponent::user('type') == 'admin' || AuthComponent::user('type') == 'profesor' ){
			 	if($this->request->is('post')){
			 		print_r($this->request->data);	
			 		$fecha = explode("/",$this->request->data['Change']['newDate']);
					$diaNuevo = $fecha[2] . '/' . $fecha[0] . '/' . $fecha[1];
					$fecha = explode("/",$this->request->data['Change']['date']);
					$diaViejo = $fecha[2] . '/' . $fecha[0] . '/' . $fecha[1];
					$num = $this->Change->find('count', array('conditions' => array( 
						'Change.tutorial_id =' => $this->request->data['Change']['tutorial_id'],
						'Change.start_hour =' => $this->request->data['Change']['start_hour']['hour'],
						'Change.user_id =' => $this->request->data['Change']['user_id'],
						'Change.date =' => $diaViejo,
						'Change.newDate =' => $diaNuevo,
						'Change.place =' => $this->request->data['Change']['place'],
						'Change.finish_hour =' => $this->request->data['Change']['finish_hour']['hour'],
						'Change.start_minute =' => $this->request->data['Change']['start_minute']['min'],
						'Change.finish_minute =' => $this->request->data['Change']['finish_minute']['min'])));
					
					if($num == 0){
				 		if($this->Change->validates()){
							$save = array('tutorial_id' => $this->request->data['Change']['tutorial_id'], 
								'user_id' => $this->request->data['Change']['user_id'], 
								'newDate' => $diaNuevo, 
								'date' => $diaViejo, 
								'place' => $this->request->data['Change']['place'], 
								'start_hour' => $this->request->data['Change']['start_hour']['hour'], 
								'finish_hour' => $this->request->data['Change']['finish_hour']['hour'], 
								'start_minute' => $this->request->data['Change']['start_minute']['min'],
							    'finish_minute' => $this->request->data['Change']['finish_minute']['min']);
							$this->Change->save($save);
		 					$data = $this->Change->find('all');
							$this->set('tutorials', $data);
		 					$this->Flash->success('Cambio puntual registrado correctamente');
							return $this->redirect(array('controller' => 'Changes', 'action' => 'index'));
				 		}else{
				 			$this->Flash->set('datos incorrectos');
				 			return $this->redirect(array('controller' => 'Tutorials', 'action' => 'change'));	
				 		}
			 		}else{
			 			$this->Flash->set('Ya se ha registrado un cambio de tutoría con los mismos datos que los indicados');
			 			return $this->redirect(array('controller' => 'Changes', 'action' => 'index'));
			 		}
			 	}
			 }else{
			 	$this->Flash->set('No estas autorizado a entrar en esta zona');
				return $this->redirect(array('controller' => 'users', 'action' => 'index'));
			 }
		 }
		
		public function delete($id){
			if( AuthComponent::user('type') == 'admin' || AuthComponent::user('type') == 'profesor' ){
				if($this->request->is('post')){
					$this->Change->delete($id, false);
					$this->Flash->success('Cambio Puntual eliminado correctamente');
				 			return $this->redirect(array('controller' => 'Changes', 'action' => 'index'));
				}
			}else{
				$this->Flash->set('No estas autorizado a entrar en esta zona');
				return $this->redirect(array('controller' => 'users', 'action' => 'index'));
			}
		}
	}
?>