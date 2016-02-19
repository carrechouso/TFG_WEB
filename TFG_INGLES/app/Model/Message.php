<?php
	class Message extends AppModel{
		
		public $validate = array(
			
			'message' => array(
				'required' => array(
					'rule' => array('notBlank'),
					'message' => 'Escribe el mensaje'
				)
			)
		);

		public function getMessages($id){

			return $this->query("SELECT m.id , m.date, m.receiver_id, m.message, m.transmitter_id, p.name, p.surname, a.name, a.surname 
								 FROM messages m, users a, users p 
								 WHERE 
								 		 
								 		 (a.id = m.receiver_id and p.id = m.transmitter_id) or (p.id = m.receiver_id and a.id = m.transmitter_id) and ( m.transmitter_id = '".$id."'
								 		 or(
								 		 		m.transmitter_id IN (
								 		 			select receiver_id from messages where transmitter_id='".$id."'
								 	     	    union 
								 		 	    	select transmitter_id from messages where receiver_id='".$id."')))
								 		 	    group by m.id order by m.date desc");
								 		
								 		
		}
	}
?>
<!--
SELECT u.username, a.solicitado_id FROM amigos a, usuarios u 
WHERE a.solicitante_id = '" . $id . "' 
AND u.id = a.solicitado_id 
UNION SELECT u.username, a.solicitante_id FROM amigos a, usuarios u 
WHERE a.solicitado_id = '" . $id . "' AND u.id = a.solicitante_id-->