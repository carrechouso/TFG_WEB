<h1 align="center">Lista de tutorias</h1>

<ul>
	<?php
	
	foreach ($tutorials as $row) {
		$min_inicio = $row['Tutorial']['start_minute'];
		$min_fin = $row['Tutorial']['finish_minute'];
	
		if($min_inicio == '0')
			$min_inicio = '00';
		
		if($min_fin == '0')
			$min_fin = '00';

		if( AuthComponent::user('type') == 'profesor' ){
			if($row['Tutorial']['user_id'] == AuthComponent::user('id')){
			?>
				<li> <?php echo $row['Subject']['name'] . ' ' .$row['User']['name'] . ' ' .$row['User']['surname'] . ' ' . $row['Tutorial']['day'] . ' de ' . $row['Tutorial']['start_hour']. ':' . $min_inicio. ' a ' . $row['Tutorial']['finish_hour']. ':' . $min_fin. '  '; 
					?></br><?php
					echo $this->Form->postLink( 'Eliminar Tutoría', array('action' => 'delete', $row['Tutorial']['id']), array('confirm' => __('¿Seguro que quieres eliminar la tutoría? ')));
					echo $this->Form->create('Tutorial',array('url' => array('controller' => 'tutorials', 'action' => 'change')));
				    echo $this->Form->input('tutorial',array('type'=>'hidden','value' => $row['Tutorial']['id']));
					echo $this->Form->input('proffesor',array('type'=>'hidden','value' => $row['User']['id']));
					echo $this->Form->end('cambio puntual');
					?>
				</li>
				<?php 
			}
		}else if( AuthComponent::user('type')== 'admin' ){
			?>
			<li> <?php echo $row['Subject']['name'] . ' ' .$row['User']['name'] . ' ' .$row['User']['surname'] . ' ' . $row['Tutorial']['day'] . ' de ' . $row['Tutorial']['start_hour']. ':' . $min_inicio. ' a ' . $row['Tutorial']['finish_hour']. ':' . $min_fin. '  '; 
					?></br><?php
					echo $this->Form->postLink( 'Eliminar Tutoría', array('action' => 'delete', $row['Tutorial']['id']), array('confirm' => __('¿Seguro que quieres eliminar la tutoría? ')));
					echo $this->Form->create('Tutorial',array('url' => array('controller' => 'tutorials', 'action' => 'change')));
				    echo $this->Form->input('tutorial',array('type'=>'hidden','value' => $row['Tutorial']['id']));
				    echo $this->Form->input('proffesor',array('type'=>'hidden','value' => $row['User']['id']));
					echo $this->Form->end('cambio puntual');
					
					?>
				</li>
			<?php 
		}
	}
	?>
	</ul>
	</br>
	</br>
	</br>
	</br>

	<?php
		echo $this->Html->link("Dar de alta tutoría",array('controller' => 'Tutorials', 'action' => 'add'));
		?>
	</br>
