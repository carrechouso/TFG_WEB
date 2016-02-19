
<script>
$(function() {
      $("#datepicker").datepicker();
});

$(function() {
      $("#datepicker2").datepicker();
});
</script>
<?php 


	
	echo $this->Form->create('Change', array('url' => array('controller' => 'changes', 'action' => 'add')));
	echo $this->Form->input('newDate', array('id'=>'datepicker','type'=>'text', 'label' => 'Nueva fecha de la tutoría'));
	echo $this->Form->input('date', array('id'=>'datepicker2','type'=>'text', 'label' => 'Fecha cambiada la tutoría'));
	echo $this->Form->input('tutorial_id', array('type' => 'hidden', 'value' => $id_tutorial));
	echo $this->Form->input('user_id', array('type' => 'hidden', 'value' => $id_user));
	echo $this->Form->hour('start_hour', 'true',  array('default' => '10'));
	echo $this->Form->minute('start_minute', array('interval' => 10, 'default' => '00'));
	?>
	</br>
	<?php
	echo $this->Form->hour('finish_hour','true', array('default' => '12'));
	echo $this->Form->minute('finish_minute', array('interval' => 10,'default' => '00'));
	echo $this->Form->Input('place',array('label' => '', 'placeholder' => 'número del despacho', 'type' => 'text'));
 	echo $this->Form->End('Confirmar cambio puntual tutoría');
?>
