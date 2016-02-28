<h1 align = "center"> Lista de cambios puntuales </h1>

<ul>
	<?php
		
		//print_r($tutorias);
		foreach ($tutorials as $row) {
			
			$fecha =  explode("-", $row['c']['newDate']);
			$dia = $fecha[2] . '/' . $fecha[1] . '/' . $fecha[0];

			$fechaVieja =  explode("-", $row['c']['date']);
			$diaViejo = $fechaVieja[2] . '/' . $fechaVieja[1] . '/' . $fechaVieja[0];
			
			$min_inicio = $row['c']['start_minute'];
			$min_fin = $row['c']['finish_minute'];
			if($min_inicio == '0')
				$min_inicio = '00';
		
			if($min_fin == '0')
				$min_fin = '00';
			
			if( AuthComponent::user('type') == 'profesor' ){
				
				if($row['c']['user_id'] == AuthComponent::user('id')){
				?>
					<li> <?php echo $row['p']['name'] . ' ' .$row['p']['surname'] . ' día ' .$dia . ' tutorías de ' . $row['a']['name'] . ' son desde las '. $row['c']['start_hour'] . ':' . $min_inicio. ' hasta las ' . $row['c']['finish_hour'] . ':' . $min_fin . "\n\r" . 'La tutoría sustituida era el día ' . $diaViejo . ' en ' . $row['c']['place'];
						?>
						</br>
						<?php
						echo $this->Form->postLink(  'Eliminar cambio puntual', array('action' => 'delete', $row['c']['id']), array('confirm' => __('¿Seguro que quieres eliminar el cambio puntual? ') . $row['a']['name'] .'?')); 
				}
			}else if (AuthComponent::user('type') == 'admin'){
				
				?>
					<li> <?php echo $row['p']['name'] . ' ' .$row['p']['surname'] . ' día ' .$dia . ' tutorías de ' . $row['a']['name'] . ' son desde las '. $row['c']['start_hour'] . ':' . $min_inicio. ' hasta las ' . $row['c']['finish_hour'] . ':' . $min_fin . ' en ' . $row['c']['place']; 
						?>
						</br>
						<?php
						echo $this->Form->postLink(  'Eliminar cambio puntual', array('action' => 'delete', $row['c']['id']), array('confirm' => __('¿Seguro que quieres eliminar el cambio puntual? ') . $row['a']['name'] .'?'));
			}		
			?>
			</br></br>
			</li>
			<?php
		}
	?>
</ul>