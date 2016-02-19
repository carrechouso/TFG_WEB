<h1 align = "center">Datos de <?php echo $name . ' ' . $surname;?></h1>
<ul>
	<?php
	$userData = $this->Session->read('userData');
		if (sizeof($data) == 0){
			?>
				<h1>
					El profesor no imparte ninguna tutoría por el momento
				</h1>
			<?php
		}else{
			foreach ($data as $proffesor){
				$start_minute =  $proffesor['t']['start_minute'];
				$finish_minute =  $proffesor['t']['finish_minute'];
			
				if($start_minute == 0){
					$start_minute = '00';
				}

				if($finish_minute == 0){
					$finish_minute = '00';
				}

				?>
					<li> 
						<?php 

							echo 'Asignatura: ' . $proffesor['a']['name'];
						?>
							</br>
						<?php
							echo 'Despacho: ' . $proffesor['t']['place'];
						?>
							</br>
						<?php
							echo 'Hora inicio: ' . $proffesor['t']['start_hour'] .':' . $start_minute;
						?>
							</br>
						<?php
							echo 'Hora fin: ' . $proffesor['t']['finish_hour'] .':' . $finish_minute;
							?></br>
							<?php
							echo $this->Html->link('enviar mensaje', array('controller' => 'messages', 'action' => 'add', '?' => array('name' => $name , 'surname' => $surname, 'receiver_id' => $proffesor['p']['id'], 'transmitter_id' => $userData[0]['User']['id'] )));
						
						?>
						</br></br>

					</li>
					<?php
			}
		}
	?>
</ul>