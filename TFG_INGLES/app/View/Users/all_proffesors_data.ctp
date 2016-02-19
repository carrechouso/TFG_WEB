<h1 align="center"> Lista de Profesores</h1>

</ul>
	<?php
		foreach($data as $row){
			?>
				<li><div>
						<?php 
							echo 'Nombre Completo: ' . $row['User']['name'] . ' ' . $row['User']['surname'];?>
							</br><?php
							echo 'Nombre de usuario: ' . $row['User']['username'];?>
					</div>
					</br></br>
					</li>
			<?php
		}

?>
</ul>