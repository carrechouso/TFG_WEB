<h1 align ="center">Enviar mensaje a <?php echo $name . ' ' . $surname ;?></h1>

<h1> falta por facer borrar mensaje e paginación. mirar o htmlpost link exemplo o final desta clase</h1>

 <?php
	echo $this->Form->create('Message', array('url' => array('controller' => 'messages', 'action' => 'add')));
	echo $this->Form->input('message', array('type' => 'textarea', 'escape' => false));
	echo $this->Form->input('transmitter_id', array('type' => 'hidden', 'value' => $transmitter_id));
	echo $this->Form->input('receiver_id', array('type' => 'hidden', 'value' => $receiver_id));	
	echo $this->Form->End('Enviar mensaje');
?>

<!--<?php //echo $this->Form->postLink(
 //   'Delete',
   // array('action' => 'delete', $country['Country']['id']),
    //array('confirm' => __('Are you sure you want to delete ').$country['Country']['name'].'?')
//)?>
