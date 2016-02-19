
<h1 align="center"> REGISTRO Profesor</h1>
<?php echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'addProffesor'))) ;
	 echo $this->Form->Input('name',array('label' => '', 'placeholder' => 'Nombre', 'type' => 'text'));
	 echo $this->Form->Input('surname',array('label' => '', 'placeholder' => 'Apellidos', 'type' => 'text'));
	 echo $this->Form->Input('username',array('label' => '', 'placeholder' => 'Nombre de Usuario', 'type' => 'text'));
	 echo $this->Form->Input('password',array('label' => '', 'placeholder' => 'Contraseña', 'type' => 'password'));
	 echo $this->Form->Input('password_2',array('label' => '', 'placeholder' => 'Repita la Contraseña', 'type' => 'password'));
	 echo $this->Form->Input('type',array('label' => '', 'placeholder' => 'Contraseña', 'type' => 'hidden', 'value' => 'profesor'));
	 echo $this->Form->Input('email',array('label' => '', 'placeholder' => 'Email', 'type' => 'text'));
	 echo $this->Form->Input('authenticated',array('value' => 'True', 'type' => 'hidden'));
	 echo $this->Form->End('Crear nuevo profesor');
?>