<h1 align = 'center'> Lista de asignaturas</h1>
<script>
	$(function() {
      $("#datepicker").datepicker();
	});

	$(function() {
      $("#datepicker2").datepicker();
	});
</script>

<?php 
	$num = 1;
	foreach ($subjects as $row){
		echo $this->Form->create('Subject', array('url' => array('controller' => 'tutorials', 'action' => 'getCalendar')));
		?>
		<p><?php echo $this->Form->checkbox($num++, array('value' => $row['Subject']['id'],'hiddenField' => false));
		echo $row['Subject']['name'];
		?></p><?php
	}
    echo $this->Form->input('numRows', array('value' => $num,'type' => 'hidden'));
	echo $this->Form->input('startDate', array('id'=>'datepicker','type'=>'text', 'label' => 'Fecha de inicio del calendario'));
	echo $this->Form->input('finishDate', array('id'=>'datepicker2','type'=>'text', 'label' => 'Fecha de fin del calendario'));
	echo $this->Form->end('descargar calendario de las asignaturas seleccionadas');
?> 