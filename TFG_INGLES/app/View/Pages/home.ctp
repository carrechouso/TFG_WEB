<h1 align="center"> PÁGINA INICIAL</h1>

<?php echo $this->Form->create('User',  array('url' => array('controller' => 'users', 'action' => 'login'))); 
      echo $this->Form->Input('username',array('label' => '', 'placeholder' => 'Nombre de Usuario', 'type' => 'text'));
	  echo $this->Form->Input('password',array('label' => '', 'placeholder' => 'Contraseña', 'type' => 'password'));
	  echo $this->Form->End('Acceder--opc:descargar profesor sus tutorias, avisar cambio tutoria');
	  echo $this->Html->link('Registrarse','/Users/add');
	  ?>
 	  </br>
	  <?php
	  echo $this->Html->link('No me recuerdo de mi contaseña o nombre de usuario','/Users/recover');
?>