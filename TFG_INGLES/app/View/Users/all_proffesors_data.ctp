<h1 align="center"> Lista de Profesores</h1>

</ul>
	<?php

		foreach($data as $row){
			?>
				<li><div>
						<?php 
							echo 'Nombre Completo: ' . $row['User']['name'] . ' ' . $row['User']['surname'];?>
							</br><?php
							echo 'Nombre de usuario: ' . $row['User']['username'];

							if(AuthComponent::user('type') == 'admin'){

								 ?></br><?php
								 echo $this->Form->postLink(  'Eliminar Profesor', array('action' => 'removeProffesor', $row['User']['id']), array('confirm' => __('Seguro que quieres eliminar al profesor ') . $row['User']['name'] .' ' . $row['User']['surname'] . '?'));
							}
						?>
							
					</div>
					</br></br>
					</li>
			<?php
		}

?>
</ul>