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
		 			$fechaInicio = explode("/",$this->request->data['Subject']['startDate']);
		 			$fechaFin = explode("/",$this->request->data['Subject']['finishDate']);
		 			$now = strtotime($fechaInicio[2] . '-' . $fechaInicio[0] . '-' .$fechaInicio[1]); // or your date as well
     				$your_date = strtotime($fechaFin[2] . '-' . $fechaFin[0] . '-' .$fechaFin[1]); 
     				$datediff = $your_date - $now;
     				$numDias = floor($datediff/(60*60*24));//o mellor facer absoluto 
     			

     				$fecha = new DateTime($fechaInicio[2] . '-' . $fechaInicio[0] . '-' .$fechaInicio[1]);
     				
				 	$load = "BEGIN:VCALENDAR" . $eol .
						 	"VERSION:2.0" . $eol .
						 	"PRODID:-//project/author//NONSGML v1.0//EN" . $eol .
						 	"CALSCALE:GREGORIAN" . $eol;
					
					for($i=1; $i <= $this->request->data['Subject']['numRows']; $i++){
		 				if(isset($this->request->data['Subject'][$i])){
		 					$fechaIn = $fecha;
		 					$datos = $this->Tutorial->find('all', 
		 													array('conditions' => 
		 													array('Tutorial.subject_id ' =>  $this->request->data['Subject'][$i])));
		 					$this->loadModel('Change');
		 					foreach($datos as $row){
			 					$fechaIn = $fecha;
			 					for($j = 0; $j < $numDias; $j++){
			 						
			 						$fechaIn->add(new DateInterval('P1D'));
									$fechaString = $fechaIn->format('Y-m-d');
									$result = date('w', strtotime($fechaString));
								 
								  
								    if( $this->getDay($result) == $row['Tutorial']['day']){
									  	$numCambios = $this->Change->find('count', 
									  				  array('conditions' => array('Change.newDate =' => $fechaString, 
									  				  							  'Change.tutorial_id' => $row['Tutorial']['id'],
									  				  							  'Change.user_id =' => $row['User']['id'])));
									 
										if($numCambios == 0){
										   $hora_ini = $row['Tutorial']['start_hour'];
										   $hora_fin = $row['Tutorial']['finish_hour'];
										   $minuto_ini = $row['Tutorial']['start_minute'];
										   $minuto_fin = $row['Tutorial']['finish_minute'];	
										   
										  if($hora_fin < 10){
										   		$hora_fin = '0' . $hora_fin; 
										   	}
										   	if($hora_ini < 10){
										   		$hora_ini = '0' . $hora_ini; 
										   	}
										   	if($minuto_ini < 10){
										   		$minuto_ini = '0' . $minuto_ini; 
										   	}
										   	if($minuto_fin < 10){
										   		$minuto_fin = '0' . $minuto_fin; 
										   	}
										   	$fechaArray = explode( "-",$fechaString); 
					 						$vend = $fechaArray[0] . $fechaArray[1] . $fechaArray[2] . 'T' . $hora_fin . $minuto_fin . '00' . 'Z';
					 						$vstart = $fechaArray[0] . $fechaArray[1] . $fechaArray[2] . 'T' . $hora_ini . $minuto_ini . '00' . 'Z';
				 							
				 							$load = $load ."BEGIN:VEVENT" . $eol .
		    									   "DTEND;TZID=Europe/Madrid:" . $vend . $eol .
												   "UID:" . $row['Subject']['name'] . $row['User']['id'] . $row['Tutorial']['day'] .$hora_ini . $eol .
												   "DTSTAMP:" . $this->dateToCal(time()) . $eol .
												   "DESCRIPTION: Asignatura: " . htmlspecialchars($row['Subject']['name'] . ' :' .$row['User']['name'] . ' ' . $row['User']['surname']) . $eol .
												   "URL;VALUE=URI:" . htmlspecialchars(('http://gestiontutorias.com')) . $eol .
												   "SUMMARY:" . htmlspecialchars($row['Subject']['name']) . $eol .
												   "DTSTART;TZID=Europe/Madrid:" . $vstart . $eol .
												   "END:VEVENT" . $eol;	
												 
				 						}else{
				 							
				 							$cambios = $this->Change->find('all', 
									  				  array('conditions' => array('Change.newDate =' => $fechaString, 'Change.tutorial_id' => $row['Tutorial']['id'],'Change.user_id =' => $row['User']['id'])));
					 						foreach($cambios as $cambio){
					 							 $hora_ini = $cambio['Change']['start_hour'];
										  		 $hora_fin = $cambio['Change']['finish_hour'];
										   		 $minuto_ini = $cambio['Change']['start_minute'];
										   		 $minuto_fin = $cambio['Change']['finish_minute'];	
										   
										  if($hora_fin < 10){
										   		$hora_fin = '0' . $hora_fin; 
										   	}
										   	if($hora_ini < 10){
										   		$hora_ini = '0' . $hora_ini; 
										   	}
										   	if($minuto_ini < 10){
										   		$minuto_ini = '0' . $minuto_ini; 
										   	}
										   	if($minuto_fin < 10){
										   		$minuto_fin = '0' . $minuto_fin; 
										   	}
										   	$fechaArray = explode( "-",$cambio['Change']['newDate']); 
					 						$vend = $fechaArray[0] . $fechaArray[1] . $fechaArray[2] . 'T' . $hora_fin . $minuto_fin . '00' . 'Z';
					 						$vstart = $fechaArray[0] . $fechaArray[1] . $fechaArray[2] . 'T' . $hora_ini . $minuto_ini . '00' . 'Z';


					 							$load = $load ."BEGIN:VEVENT" . $eol .
		    									   "DTEND;TZID=Europe/Madrid:" . $vend . $eol .
												   "UID:" . $row['Subject']['name'] . $row['User']['id'] . $row['Tutorial']['day'] .$hora_ini . $eol .
												   "DTSTAMP:" . $this->dateToCal(time()) . $eol .
												   "DESCRIPTION: Asignatura: " . htmlspecialchars($row['Subject']['name'] . ' :' .$row['User']['name'] . ' ' . $row['User']['surname']) . $eol .
												   "URL;VALUE=URI:" . htmlspecialchars(('http://gestiontutorias.com')) . $eol .
												   "SUMMARY:" . htmlspecialchars($row['Subject']['name']) . $eol .
												   "DTSTART;TZID=Europe/Madrid:" . $vstart . $eol .
												   "END:VEVENT" . $eol;	
					 						}

				 						}
				 						//comprobar cambio puntual e coller dia da semana e meter datos
				 						
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
	}
?>