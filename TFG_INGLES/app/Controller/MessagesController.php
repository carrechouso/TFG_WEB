<?php
	
	class MessagesController extends AppController {

		 public function index(){
		 	if($this->request->is('get')){
		 		$this->set('messages', $this->Message->getMessages (AuthComponent::user('id')));
	 		}
		}
	
		 public function add(){
		 	
		 	if($this->request->is('get')){
		 		$this->set('name', $this->request->query['name']);
		 		$this->set('surname', $this->request->query['surname']);
		 		$this->set('receiver_id', $this->request->query['receiver_id']);
		 		$this->set('transmitter_id', $this->request->query['transmitter_id']);
		 	}
		 	if($this->request->is('post')){
		 		$this->loadModel('User');
		 		
		 		
		 		$trans_auth = $this->User->find('count', array('conditions' => array('User.id = ' => AuthComponent::user('id'), 'User.authenticated' => True)));
	 			$rec_auth = $this->User->find('count', array('conditions' => array('User.id = ' => $this->request->data['Message']['receiver_id'], 'User.authenticated' => True)));
	 			if($trans_auth == 0){
	 				$this->Flash->set('Tu Email aún no ha sido validado. No podrás mandar mensajes hasta que haya sido validado');
	 			}else if ($rec_auth == 0){
	 				$this->Flash->set('El Email del receptor aún no ha sido validado. No podrás mandarle mensajes hasta que haya sido validado');
	 			}else{
	 				$this->Message->save($this->request->data);
	 				$this->Flash->success('mensaje enviado');
	 			}
		 		$this->redirect(array('controller' => 'messages', 'action' => 'index'));
		 	}
		 }
	}
?>