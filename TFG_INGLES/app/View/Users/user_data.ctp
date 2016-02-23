<h1 align="center"> DATOS DEL  USUARIO</h1>
<?php 



	 echo $this->Form->Input('name',array('label' => '', 'value' => 'Nombre: ' . $name, 'type' => 'text', 'disabled' => 'disabled'));
	 echo $this->Form->Input('surname',array('label' => '', 'value' => 'Apellidos: ' . $surname, 'type' => 'text', 'disabled' => 'disabled'));
	 echo $this->Form->Input('username',array('label' => '', 'value' => 'Nombre de Usuario: ' . $username, 'type' => 'text', 'disabled' => 'disabled'));
	 
	 if ($validate == 1)
	 	echo $this->Form->Input('email',array('label' => '', 'value' => 'Email validado: ' . $email, 'type' => 'text', 'disabled' => 'disabled'));
	 else{
	 	echo $this->Form->Input('savedEmail',array('label' => '', 'value' => 'Email sin validar: ' . $email, 'type' => 'text', 'disabled' => 'disabled'));
	 	echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'changeEmail'))) ;
	 	 	echo $this->Form->Input('email',array('label' => '', 'placeholder' => 'Modificar email' , 'type' => 'text'));
	 	echo $this->Form->End('modificar email');
	 }
	 
	 echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'changePass'))) ;
	 echo $this->Form->Input('password',array('label' => '', 'placeholder' => 'Cambiar Contraseña', 'type' => 'password'));
	 echo $this->Form->Input('password_2',array('label' => '', 'placeholder' => 'Repita la nueva Contraseña', 'type' => 'password'));
	 echo $this->Form->End('Modificar contraseña');
?>