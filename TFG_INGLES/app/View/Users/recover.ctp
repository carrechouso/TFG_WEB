<h1 align="center"> RECUPERAR DATOS</h1>
<?php echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'recover'))) ;
	 echo $this->Form->Input('email',array('label' => '', 'placeholder' => 'introduce tu email', 'type' => 'text'));
	 echo $this->Form->End('recuperar datos');
?>