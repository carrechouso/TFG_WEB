<h1 align = "center">Lista de asignaturas</h1>

<ul>
	<?php
		foreach($subjects as $row){
			?>
				<li>
					<p>
					<?php
						echo 'Nombre: ' . $row['Subject']['name'] . ' Cuatrimeste: ' . $row['Subject']['quarter'] . ' nº de creditos: ' . $row['Subject']['credits'] . ' Código: ' . $row['Subject']['code'];
						if(AuthComponent::user('type') == 'admin'){
							 echo $this->Form->postLink(  'Delete', array('action' => 'delete', $row['Subject']['id']), array('confirm' => __('Seguro que quieres eliminar la asignatura ') . $row['Subject']['name'] .'?'));
						}
					?>
					</p>
				</li>
			<?php
		}	
	?>
</ul>