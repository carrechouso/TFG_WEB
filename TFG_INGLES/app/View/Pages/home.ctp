<h1 align="center"> PÁGINA INICIAL</h1>

<?php echo $this->Form->create('User',  array('url' => array('controller' => 'users', 'action' => 'login'))); 
      echo $this->Form->Input('username',array('label' => '', 'placeholder' => 'Nombre de Usuario', 'type' => 'text'));
	  echo $this->Form->Input('password',array('label' => '', 'placeholder' => 'Contraseña', 'type' => 'password'));
	  echo $this->Form->End('Acceder-funcion before filter nos controladores para paginas permitidas sen loguearse');
	  echo $this->Html->link('Registrarse','/Users/add');
?>