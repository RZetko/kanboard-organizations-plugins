<?php
	$org = $this->task->taskMetadataModel->get($task['id'], 'organization'); 
?>

<p><b>Organizácia: </b><?= htmlspecialchars($org); ?></p>
