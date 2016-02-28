<h1 align="center"> REGISTRO Tutoría</h1>
<?php 
	$days = array('lunes' => 'lunes', 'martes' => 'martes', 'miercoles' => 'miercoles','jueves' => 'jueves', 'viernes' => 'viernes');
	
	
	echo $this->Form->create('Tutorial', array('url' => array('controller' => 'tutorials', 'action' => 'add'))) ;
	echo $this->Form->Input('subject_id',array('label' => '', 'placeholder' => 'código de la asignatura', 'type' => 'text'));
	if(AuthComponent::user('type') == 'admin'){
		echo $this->Form->Input('user_id',array('label' => '', 'placeholder' => 'nombre usuario del profesor', 'type' => 'text'));
	}else{
		echo $this->Form->Input('user_id',array('type' =>'hidden','value' => AuthComponent::user('username')));
	}
	echo $this->Form->input('day', array('label' => '','options' => $days, 'default' => 'l'));
	echo $this->Form->hour('start_hour', 'true',  array('default' => '10'));
	echo $this->Form->minute('start_minute', array('interval' => 10, 'default' => '00'));
	?>
	</br>
	<?php
	echo $this->Form->hour('finish_hour','true', array('default' => '12'));
	echo $this->Form->minute('finish_minute', array('interval' => 10,'default' => '00'));
	echo $this->Form->Input('place',array('label' => '', 'placeholder' => 'número del despacho o lugar de la tutoría', 'type' => 'text'));
 	echo $this->Form->End('Crear nueva tutoría');
?>