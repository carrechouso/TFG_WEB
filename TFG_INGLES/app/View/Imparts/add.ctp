<h1 align = "center"> Lista de asignaturas </h1>
<?php 
	$userData = $this->Session->read('userData');
	$userType = $this->Session->read('userType');
	//print_r($userData);
	//echo $userType;
	
	foreach($data as $row){
		?><p>
			<?php 
				echo 'Nombre: ' . $row['Subject']['name'] . ' Numero de creditos:' . $row['Subject']['credits'] . ' cuatrimestre:' . $row['Subject']['quarter'] . ' código asignatura:' . $row['Subject']['code'];   
				
				if($userType == 'admin'){
					echo $this->Form->create('Impart', array('url' => array('controller' => 'imparts','action' => 'add')));
					echo $this->Form->Input('subject_id', array('type' => 'hidden', 'value' => $row['Subject']['id'])); 
					echo $this->Form->Input('user_id', array('type' => 'hidden', 'value' => $userData[0]['User']['id']));
					echo $this->Form->End('Darse de alta como docente');

				}else if($userType == 'profesor'){
					echo $this->Form->create('Impart', array('url' => array('controller' => 'imparts','action' => 'add')));
					echo $this->Form->Input('subject_id', array('type' => 'hidden', 'value' => $row['Subject']['id'])); 
					echo $this->Form->Input('user_id', array('type' => 'hidden', 'value' => $userData[0]['User']['id']));
					echo $this->Form->End('Darse de alta como docente');
				}
				
			?>	
			
		</p>
		<?php
	}
?>