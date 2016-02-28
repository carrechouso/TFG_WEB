<?php
	class SubjectsController extends AppController {

		public function index(){
			if($this->request->is('get')){
				
				$this->set('subjects', $this->Subject->find('all'));
			}
		}

		 public function add(){

		 	if(AuthComponent::user('type') == 'admin'){
			 	if($this->request->is('post')){
			 		$num = $this->Subject->find('count', array('conditions' => array('Subject.code =' => $this->request->data['Subject']['code'])));
			 		
			 		if($num == 1){
			 			$this->Flash->set('Ya existe una asignatura con el código indicado');
			 		}else{
			 			$this->Subject->set($this->request->data);
			 			if($this->Subject->validates()){
				 			$this->Subject->save($this->request->data);
							 $this->Flash->success('Asignatura registrada correctamente');
							return $this->redirect(array('controller' => 'users', 'action' => 'index'));		
				 			}
				 		}
				}
			}else{
				$this->Flash->set('No estas autorizado a entrar en esta zona');
				return $this->redirect(array('controller' => 'users', 'action' => 'index'));
			}
		 }
		
		
		public function delete($id){

			if (AuthComponent::user('type') == 'admin'){
				
				if($this->request->is('post')){
					 
					 $this->loadModel('Change');
					 $this->loadModel('Tutorial');
					 $tutorials = $this->Tutorial->find('all', array('conditions' => array('Tutorial.subject_id' => $id)));
					 foreach( $tutorials as $row){
					 	$this->Change->deleteAll(array('Change.tutorial_id' =>$row['Tutorial']['id']), false);
					 }

					 $this->Tutorial->deleteAll(array('Tutorial.subject_id' => $id), false);
					 $this->loadModel('Impart');
					 $this->Impart->deleteAll(array('Impart.subject_id' => $id), false);
					 $this->Subject->delete($id, True);
					 $this->Flash->success('Asignatura eliminada correctamente');
					 return $this->redirect(array('controller' => 'subjects', 'action' => 'index'));
				}
			}else{
				$this->Flash->set('No estas autorizado a entrar en esta zona');
				return $this->redirect(array('controller' => 'users', 'action' => 'index'));
			}
		}
	}
?>