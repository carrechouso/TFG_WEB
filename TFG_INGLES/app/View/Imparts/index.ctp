<h1 align="center">Mis asignaturas</h1>
<?php
	
	$userData = $this->Session->read('userData');
	$userType = $this->Session->read('userType');
	//print_r($data);
	
	?>
	<ul><?php

	foreach($data as $row){
		if ($userType == 'admin'){
			?>
				<li><p>
					<?php
						echo 'Nombre: ' . $row['a']['name'] . ' Cuatrimeste: ' . $row['a']['quarter'] . ' nº de creditos: ' . $row['a']['credits'] . ' Profesor: ' . $row['p']['name'] . ' ' . $row['p']['surname'];
						echo $this->Form->postLink('Dejar asignatura', array('action' => 'delete', $row['i']['id']), array('confirm' => __('¿Dar de baja a profesor de la asignatura? ') . $row['a']['name'] .'?'));

		}else if ($userType == 'profesor'){
			if ($row['i']['user_id'] == $userData[0]['User']['id']){
				?>
				<li><p>
					<?php
						echo 'Nombre: ' . $row['a']['name'] . ' Cuatrimeste: ' . $row['a']['quarter'] . ' nº de creditos: ' . $row['a']['credits'];
						echo $this->Form->postLink('Dejar asignatura', array('action' => 'delete', $row['i']['id']), array('confirm' => __('¿Dar de baja a profesor de la asignatura? ') . $row['a']['name'] .'?'));
					
			}
		}
		
		?>
		</p>
		</li>
		<?php
	}
?>
</ul>
