<?php
	class ImpartsController extends AppController {

		public function index(){

			if($this->request->is('get') && ( AuthComponent::user('type') == 'admin' || AuthComponent::user('type') == 'profesor' )){
				
				$this->set('data', $this->Impart->getDatos());
			}else{
				$this->Flash->set('No estas autorizado a entrar en esta zona');
				return $this->redirect(array('controller' => 'users', 'action' => 'index'));
			}
		}

		public function delete($id){
			
			if( AuthComponent::user('type') == 'admin' || AuthComponent::user('type') == 'profesor' ){
				if($this->request->is('post')){
					$data = $this->Impart->find('all', array('conditions' => array('Impart.id' => $id)));
					
					$this->loadModel('Change');
					$this->loadModel('Tutorial');
					$tutorials = $this->Tutorial->find('all', array('conditions' => array('Tutorial.subject_id' => $data[0]['Impart']['subject_id'], 'Tutorial.user_id' => $data[0]['Impart']['user_id'])));
					
					foreach( $tutorials as $row){
					 	$this->Change->deleteAll(array('Change.tutorial_id' =>$row['Tutorial']['id']), false);
					}
					
					$this->Tutorial->deleteAll(array('Tutorial.subject_id' => $data[0]['Impart']['subject_id'], 'Tutorial.user_id' => $data[0]['Impart']['user_id']), false);
					$this->Impart->delete($id, false);
					 $this->Flash->success('Profesor dado de baja en la asignatura correctamente');
					return $this->redirect(array('controller' => 'imparts', 'action' => 'index'));
				}
			}else{
				$this->Flash->set('No estas autorizado a entrar en esta zona');
				return $this->redirect(array('controller' => 'users', 'action' => 'index'));
			}
		}

		 public function add(){
		 	
		 	if( AuthComponent::user('type') == 'admin' || AuthComponent::user('type') == 'profesor' ){
			 	if($this->request->is('get')){
			 		$this->loadModel('Subject');
			 		$data = $this->Subject->find('all');
			 		$this->set('data', $data);
			 	}
			 	
			 	if($this->request->is('post')){
			 		$this->loadModel('Subject');
			 		$data = $this->Subject->find('all');
			 		$this->set('data', $data);
			 		
			 		$num = $this->Impart->find('count', array('conditions' => array('Impart.user_id =' => $this->request->data['Impart']['user_id'], 'Impart.subject_id =' => $this->request->data['Impart']['subject_id'])));
			 		
			 		if($num == 1){
			 			$this->Flash->set('Ya estas dado de alta en esa asignatura');
			 		}else{
			 			$this->Impart->save($this->request->data);
						$this->Flash->success('Dado de alta correctamente en la asignatura');
						//$log = $this->Imparte->getDataSource()->getLog(false, false);
						//debug($log);
						return $this->redirect(array('controller' => 'Imparts', 'action' => 'index'));		
			 			
			 		}
			 	}
			}else{
				$this->Flash->set('No estas autorizado a entrar en esta zona');
				return $this->redirect(array('controller' => 'users', 'action' => 'index'));
			} 
		}
	}
?>