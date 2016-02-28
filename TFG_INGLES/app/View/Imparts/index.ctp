<h1 align="center">Mis asignaturas</h1>
	
	<ul><?php

	foreach($data as $row){
		if (AuthComponent::user('type')== 'admin'){
			?>
				<li><p>
					<?php
						echo 'Nombre: ' . $row['a']['name'] . ' Cuatrimeste: ' . $row['a']['quarter'] . ' nº de creditos: ' . $row['a']['credits'] . ' Profesor: ' . $row['p']['name'] . ' ' . $row['p']['surname'];
						echo $this->Form->postLink('Dejar asignatura', array('action' => 'delete', $row['i']['id']), array('confirm' => __('¿Dar de baja a profesor de la asignatura? ') . $row['a']['name'] .'?'));

		}else if (AuthComponent::user('type') == 'profesor'){
			if ($row['i']['user_id'] == AuthComponent::user('id')){
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
