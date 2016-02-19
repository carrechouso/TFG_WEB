<h1 align="center"> REGISTRO ASIGNATURA</h1>
<?php echo $this->Form->create('Subject', array('url' => array('controller' => 'subjects', 'action' => 'add'))) ;
	 echo $this->Form->Input('name',array('label' => '', 'placeholder' => 'Nombre de la asignatura', 'type' => 'text'));
	 echo $this->Form->Input('credits',array('label' => '', 'placeholder' => 'Número de creditos', 'type' => 'text'));
	 echo $this->Form->Input('quarter',array('label' => '', 'placeholder' => 'Cuatrimeste (1-2)', 'type' => 'text'));
	 echo $this->Form->Input('code',array('label' => '', 'placeholder' => 'código asignado a la asignatura', 'type' => 'text'));
	  echo $this->Form->End('Crear nueva asignatura');
?>