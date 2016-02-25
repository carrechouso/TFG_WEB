<?php
	class TutorialsController extends AppController {

		 public function index(){

			if($this->request->is('get')){
				$data = $this->Tutorial->find('all');
				$this->set('tutorials', $data);
			}
		}
	
		 public function add(){

		 	if($this->request->is('post')){
		 		
		 		$userType = $this->Session->read('userType');
				$this->loadModel('User');
				$prof = $this->User->find('count', array('conditions'=> array('User.username =' => $this->request->data['Tutorial']['user_id'])));					
					if($prof != 0){
					
						$id_P = $this->User->find('all', array('conditions'=> array('User.username =' => $this->request->data['Tutorial']['user_id'])));		
						$id_proffesor = $id_P[0]['User']['id']; 
					}
				
				$this->loadModel('Subject');
				$subj = $this->Subject->find('count', array('conditions'=> array('Subject.code =' => $this->request->data['Tutorial']['subject_id'])));

				if($prof == 1 && $subj == 1){
			 		$id_S = $this->Subject->find('all', array('conditions'=> array('Subject.code =' => $this->request->data['Tutorial']['subject_id'])));
			 		$this->loadModel('Impart');
			 		$num = $this->Impart->find('count', array('conditions' => array('subject_id' => $id_S[0]['Subject']['id'], 'user_id' => $id_proffesor)));
			 		if($num == 0){
			 			$this->Flash->set('El profesor no esta dado de alto en la asignatura como docente');
			 		}else{
			 			if($this->Tutorial->validates()){
				 			
				 			$save = array('subject_id' => $id_S[0]['Subject']['id'], 'user_id' => $id_proffesor, 'day' => $this->request->data['Tutorial']['day'], 'place' => $this->request->data['Tutorial']['place'], 'start_hour' => $this->request->data['Tutorial']['start_hour']['hour'], 'finish_hour' => $this->request->data['Tutorial']['finish_hour']['hour'], 'start_minute' => $this->request->data['Tutorial']['start_minute']['min'], 'finish_minute' => $this->request->data['Tutorial']['finish_minute']['min']);
				 			
				 			$this->Tutorial->save($save);
		 					$data = $this->Tutorial->find('all');
							$this->set('tutorials', $data);
		 					$this->Flash->success('Tutoria registrada correctamente');
							return $this->redirect(array('controller' => 'Tutorials', 'action' => 'index'));
				 		}
			 		}
		 		}else{
		 			$this->Flash->set($prof .' Id de profesor y/o asignatura incorrecta ' . $subj);
		 		}
		 	}
		 }

		 public function change(){
		 	if($this->request->is('post')){
		 		$this->set('id_tutorial',$this->request->data['Tutorial']['tutorial']);
		 		$this->set('id_user',$this->request->data['Tutorial']['proffesor']);
		 	}
		 }


		 public function getCalendar(){

	 		$this->loadModel('Subject');
	 		if($this->request->is('get')){
	 			$this->set('subjects', $this->Subject->find('all'));
	 		}

	 		if($this->request->is('post')){
			
				$num =  $this->Subject->find('count');
				$this->set('subjects', $this->Subject->find('all'));
	 			
	 			$eol = "\r\n";//fin de linea do arquivo .ics
	 			$dateStart = explode("/",$this->request->data['Subject']['startDate']);
	 			$finishDate = explode("/",$this->request->data['Subject']['finishDate']);
	 			$start = strtotime($dateStart[2] . '-' . $dateStart[0] . '-' .$dateStart[1]); 
 				$finish = strtotime($finishDate[2] . '-' . $finishDate[0] . '-' .$finishDate[1]); 
 				$datediff = $finish - $start;
 				$numDays = floor($datediff/(60*60*24));//o mellor facer absoluto 
 			

 				$date = new DateTime($dateStart[2] . '-' . $dateStart[0] . '-' .$dateStart[1]);
 				
			 	$load = "BEGIN:VCALENDAR" . $eol .
					 	"VERSION:2.0" . $eol .
					 	"PRODID:-//project/author//NONSGML v1.0//EN" . $eol .
					 	"CALSCALE:GREGORIAN" . $eol;
				
				for($i=1; $i <= $this->request->data['Subject']['numRows']; $i++){
	 			
	 				if(isset($this->request->data['Subject'][$i])){
	 			
	 					$stDate = $date;
	 					
	 					$datos = $this->Tutorial->find('all', 
	 													array('conditions' => 
	 													array('Tutorial.subject_id ' =>  $this->request->data['Subject'][$i])));
	 					
	 					$this->loadModel('Change');

	 					foreach($datos as $row){
		 					$stDate = $date;
		 					for($j = 0; $j < $numDays; $j++){
		 						
		 						$stDate->add(new DateInterval('P1D'));
								$dateString = $stDate->format('Y-m-d');
								$result = date('w', strtotime($dateString));
							    $dateString  = substr($dateString,0,strlen($dateString));
							  
							    if( $this->getDay($result) == $row['Tutorial']['day']){
								  	
								  	$numChanges = $this->Change->find('count', 
								  				  array('conditions' => array('Change.date =' => $dateString, 
								  				  							  'Change.tutorial_id' => $row['Tutorial']['id'],
								  				  							  'Change.user_id =' => $row['User']['id'])));
								 	
									if($numChanges == 0){
									   $startHour = $row['Tutorial']['start_hour'];
									   $finishHour = $row['Tutorial']['finish_hour'];
									   $startMinute = $row['Tutorial']['start_minute'];
									   $finishMinute = $row['Tutorial']['finish_minute'];	
									   
									  if($finishHour < 10){
									   		$finishHour = '0' . $finishHour; 
									   	}
									   	if($startHour < 10){
									   		$startHour = '0' . $startHour; 
									   	}
									   	if($startMinute < 10){
									   		$startMinute = '0' . $startMinute; 
									   	}
									   	if($finishMinute < 10){
									   		$finishMinute = '0' . $finishMinute; 
									   	}
									   	$dateArray = explode( "-",$dateString); 
				 						$vend = $dateArray[0] . $dateArray[1] . $dateArray[2] . 'T' . $finishHour . $finishMinute . '00' . 'Z';
				 						$vstart = $dateArray[0] . $dateArray[1] . $dateArray[2] . 'T' . $startHour . $startMinute . '00' . 'Z';
			 							
			 							$load = $load ."BEGIN:VEVENT" . $eol .
	    									   "DTEND;TZID=Europe/Madrid:" . $vend . $eol .
											   "UID:" . $row['Subject']['name'] . $row['User']['id'] . $row['Tutorial']['day'] .$startHour . $eol .
											   "DTSTAMP:" . $this->dateToCal(time()) . $eol .
											   "DESCRIPTION: Asignatura: " . htmlspecialchars($row['Subject']['name'] . ' :' .$row['User']['name'] . ' ' . $row['User']['surname']) . $eol .
											   "URL;VALUE=URI:" . htmlspecialchars(('http://gestiontutorias.com')) . $eol .
											   "SUMMARY:" . htmlspecialchars($row['Subject']['name'] .': '. $row['Tutorial']['place']) . $eol .
											   "DTSTART;TZID=Europe/Madrid:" . $vstart . $eol .
											   "END:VEVENT" . $eol;	
											 
			 						}else{
			 							
			 							$changes = $this->Change->find('all', array('conditions' => array('Change.date =' => $dateString, 'Change.tutorial_id' => $row['Tutorial']['id'],'Change.user_id =' => $row['User']['id'])));
				 						foreach($changes as $change){
				 							 $startHour = $change['Change']['start_hour'];
									  		 $finishHour = $change['Change']['finish_hour'];
									   		 $startMinute = $change['Change']['start_minute'];
									   		 $finishMinute = $change['Change']['finish_minute'];	
									   
									  if($finishHour < 10){
									   		$finishHour = '0' . $finishHour; 
									   	}
									   	if($startHour < 10){
									   		$startHour = '0' . $startHour; 
									   	}
									   	if($startMinute < 10){
									   		$startMinute = '0' . $startMinute; 
									   	}
									   	if($finishMinute < 10){
									   		$finishMinute = '0' . $finishMinute; 
									   	}
									   	$dateArray = explode( "-",$change['Change']['newDate']); 
				 						$vend = $dateArray[0] . $dateArray[1] . $dateArray[2] . 'T' . $finishHour . $finishMinute . '00' . 'Z';
				 						$vstart = $dateArray[0] . $dateArray[1] . $dateArray[2] . 'T' . $startHour . $startMinute . '00' . 'Z';


				 							$load = $load ."BEGIN:VEVENT" . $eol .
	    									   "DTEND;TZID=Europe/Madrid:" . $vend . $eol .
											   "UID:" . $row['Subject']['name'] . $row['User']['id'] . $row['Tutorial']['day'] .$startHour . $eol .
											   "DTSTAMP:" . $this->dateToCal(time()) . $eol .
											   "DESCRIPTION: Asignatura: " . htmlspecialchars($row['Subject']['name'] . ' :' .$row['User']['name'] . ' ' . $row['User']['surname']) . $eol .
											   "URL;VALUE=URI:" . htmlspecialchars(('http://gestiontutorias.com')) . $eol .
											   "SUMMARY:" . htmlspecialchars($row['Subject']['name'] .': '. $change['Change']['place']) . $eol .
											   "DTSTART;TZID=Europe/Madrid:" . $vstart . $eol .
											   "END:VEVENT" . $eol;	
				 						}


			 						}
			 						
			 					}
							}
						}
	 				}
	 			}
	 			$load = $load . "END:VCALENDAR";
	 			$filename="Event-Tutorias.ics";
				// Set the headers
			   	header( "Content-Type: text/calendar; charset=UTF-8");
			   	header('Content-Disposition: attachment; filename=' . $filename);
			   	header('Content-Length: ' . strlen($load));
			  	header('Connection: close');
			    // Dump load
			    // $load = preg_replace('/[\s]/', ' ', $load);

			   echo $load;exit;
	 			
	 			// duracion cuatrimestre controlar?
	 		}
					 	
	 	}


		 function getDay($numDay){

			switch ($numDay) {
				case 1:
					return 'lunes';
					break;
				case 2:
					return 'martes';
					break;
				case 3:
					return 'miercoles';
					break;
				case 4:
					return 'jueves';
					break;
				case 5:
					return 'viernes';
					break;
				default:
					return 'domingo';
			}
		}

		function dateToCal($timestamp) {
 		 return date('Ymd\Tgis\Z', $timestamp);
		}
	

		public function delete($id){

			if($this->request->is('post')){
					 
				 $this->loadModel('Change');
				 $this->Change->deleteAll(array('Change.tutorial_id' => $id), false);
				 $this->Tutorial->delete($id, True);
				 $this->Flash->success('Tutoría eliminada correctamente');
				 return $this->redirect(array('controller' => 'tutorials', 'action' => 'index'));
			}
		}
	}
?>