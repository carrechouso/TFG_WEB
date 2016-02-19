<h1 align = "center">Lista de profesores</h1>
<ul>
	<?php
		foreach ($proffesors as $proffesor){
			?>
				<li> 
					<?php 
						echo $this->Html->Link($proffesor['User']['name'] . ' ' . $proffesor['User']['surname'], array('controller' => 'Users', 'action' => 'proffesorData','?' => array('proffesor_id' => $proffesor['User']['id'], 'name' => $proffesor['User']['name'], 'surname' => $proffesor['User']['surname'])));
					?>
				</li>
				<?php
		}
	?>
</ul>