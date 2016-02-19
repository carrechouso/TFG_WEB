<h1 align="center"> Lista de usuarios con email</h1>
<h1> alumnos  validados</h1>
	<ul><?php
		foreach($validateUsers as $row){
			?>
			<li>
				<?php
					echo $row['User']['name'] . ' ' . $row['User']['surname'] . ' email: ' . $row['User']['email'] . ' tipo de usuario: ' . $row['User']['type'];
					echo $this->form->create('User', array('url' => array('controller' => 'Users', 'action' => 'removeAuth')));
					echo $this->form->input('id', array('type' => 'hidden', 'value' => $row['User']['id']));
					echo $this->form->input('email', array('type' => 'hidden', 'value' => $row['User']['email']));
					echo $this->form->end('desahabilitar email');
				?>
			</li>
			<?php
		}

	?>
		</ul>
		<br>
		<br>
		<br>
		<h1> alumnos no validados</h1>
		<ul>
			<?php
				foreach($NonvalidateUsers as $row){
					?>
						<li>
							<?php echo $row['User']['name'] . ' ' . $row['User']['surname'] . '. email: ' . $row['User']['email'] . ' tipo de usuario: ' . $row['User']['type'];
							echo $this->form->create('User', array('url' => array('controller' => 'Users', 'action' => 'addAuth')));
							echo $this->form->input('id', array('type' => 'hidden', 'value' => $row['User']['id']));
							echo $this->form->input('email', array('type' => 'hidden', 'value' => $row['User']['email']));
							echo $this->form->end('Habilitar email');
							?>
						</li>
					<?php
				}
			?>
		</ul>