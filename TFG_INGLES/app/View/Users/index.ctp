<h1 align="center"> PÁGINA INICIAL USUARIO LOGUEADO</h1>

<h3> usuario correcto</h3>

<?php 

	echo 'tipoUsuario:' . AuthComponent::user('type');
	?>
	</br></br>
	<?php
	if( AuthComponent::user('type') == 'admin'){
		
		echo $this->Html->link("Dar de alta a profesor",array('controller' => 'Users', 'action' => 'addProffesor'));
		?></br>

		<?php
		echo $this->Html->link("Dar de alta asignatura",array('controller' => 'subjects', 'action' => 'add'));
		?></br>
		<?php
		echo $this->Html->link("Lista de tutorias",array('controller' => 'Tutorials', 'action' => 'index'));
		?></br>
		<!--<?php
		//echo $this->Html->link("Resgistrarse en asignatura",array('controller' => 'imparts', 'action' => 'add'));
		?></br>-->
		<?php
			echo $this->Html->link("Asignaturas  y profesores",array('controller' => 'imparts', 'action' => 'index'));
		?>
		</br>
		<?php
			echo $this->Html->link("Lista de cambios puntuales de tutorías",array('controller' => 'changes', 'action' => 'index'));
			?>
		</br>
		<?php
			echo $this->Html->link("lista de profesores", array('controller' => 'users', 'action' => 'allProffesorsData'));
			?>
		</br>
		<?php
			echo $this->Html->link("Listar/Validar alumnos", array('controller' => 'users', 'action' => 'authList'));

	?>
	<?php
	}
	if( AuthComponent::user('type') != 'profesor'){
		?>
		</br>
		<?php
		echo $this->Html->link("Profesores y tutorias", array('controller' => 'users', 'action' => 'proffesorsList'));
		?>
		</br>
		<?php
			echo $this->Html->link("Lista de asignaturas",array('controller' => 'subjects', 'action' => 'index'));
		?>
		</br>
		<?php
			echo $this->Html->link("Descargar calendario de tutorías",array('controller' => 'tutorials', 'action' => 'getCalendar'));
		
		}
		else{
				
			echo $this->Html->link("Mis tutorias",array('controller' => 'Tutorials', 'action' => 'index'));
			?>
			</br>
			<?php
				echo $this->Html->link("Resgistrarse en asignatura",array('controller' => 'imparts', 'action' => 'add'));
			?>
			</br>
			<?php
				echo $this->Html->link("Mis asignaturas",array('controller' => 'imparts', 'action' => 'index'));
			?>
			</br>
			<?php
				echo $this->Html->link("Lista de cambios puntuales mis tutorías",array('controller' => 'changes', 'action' => 'index'));
			?>
			</br>
			<?php
			echo $this->Html->link("Lista de asignaturas",array('controller' => 'subjects', 'action' => 'index'));
		}
		?>
		</br>
		<?php
		echo $this->Html->link("Lista de Mensajes",array('controller' => 'messages', 'action' => 'index'));
		?>
		</br>
		<?php
		echo $this->Html->link("Mi perfil",array('controller' => 'users', 'action' => 'userData'));
?>

