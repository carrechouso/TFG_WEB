<h1 align ="center">Lista de  mensajes</h1>
 <ul>
 <?php

	foreach($messages as $message){
		?>
		
			<?php
				if($message['m']['transmitter_id'] == AuthComponent::user('id')){
					?>
		<li>
			<?php
					if(AuthComponent::user('type') == 'admin' || AuthComponent::user('type') == 'alumno'){
						
						echo 'Emisor: ' . $message['a']['name'] . ' ' . $message['a']['surname'];
						?></br>
						<?php
						echo 'Receptor: ' . $message['p']['name'] . ' ' . $message['p']['surname'];
						?></br>
						<?php
						echo 'Fecha del message: ' . $message['m']['date'];
						?></br>
						<?php
						echo 'Mensaje: ' . $message['m']['message'];
						?></br><br>
						<?php
					}else{
						echo 'Emisor: ' . $message['p']['name'] . ' ' . $message['p']['surname'];
						?></br>
						<?php
						echo 'Receptor: ' . $message['a']['name'] . ' ' . $message['a']['surname'];
						?></br>
						<?php
						echo 'Fecha del message: ' . $message['m']['date'];
						?></br>
						<?php
						echo 'Mensaje: ' . $message['m']['message'];
						?></br><br>
						<?php
					}
					?>
						</li>
					<?php
				}else if($message['m']['receiver_id'] == AuthComponent::user('id')){
					?>
					<li>
					<?php
					if(AuthComponent::user('type') == 'admin' || AuthComponent::user('type') == 'alumno'){
					
						echo 'Emisor: ' . $message['p']['name'] . ' ' . $message['p']['surname'];
						?></br>
						<?php
						echo 'Receptor: ' . $message['a']['name'] . ' ' . $message['a']['surname'];
						?></br>
						<?php
						echo 'Fecha del message: ' . $message['m']['date'];
						?></br>
						<?php
						echo 'message: ' . $message['m']['message'];
						?>
						</br>
						<?php
						
						echo $this->Html->link('responder message', array('controller' => 'messages', 'action' => 'add', '?' => array('name' => $message['p']['name'] , 'surname' => $message['p']['surname'], 'receiver_id' => $message['m']['transmitter_id'], 'transmitter_id' => $message['m']['receiver_id'] )));
						?></br><br>
						<?php
					}else{
						echo 'Emisor: ' . $message['a']['name'] . ' ' . $message['a']['surname'];
						?></br>
						<?php
						echo 'Receptor: ' . $message['p']['name'] . ' ' . $message['p']['surname'];
						?></br>
						<?php
						echo 'Fecha del message:' . $message['m']['date'];
						?></br>
						<?php
						echo 'message: ' . $message['m']['message'];
						?>
						</br>
						<?php
						echo $this->Html->link('responder message', array('controller' => 'messages', 'action' => 'add', '?' => array('name' => $message['a']['name'] , 'surname' => $message['a']['surname'], 'receiver_id' => $message['m']['transmitter_id'], 'transmitter_id' => $message['m']['receiver_id'] )));
						?></br><br>
						<?php
					}
					?>
						</li>
					<?php
		} 
	}
?>
</ul>
