<?php
	$project_id = $this->task->request->getIntegerParam('project_id');
	$project_md = $this->task->projectMetadataModel->getAll($project_id);
	$orgs_raw = explode('||', $project_md['organizations']);
	$organizations = array();
	foreach ($orgs_raw as $org_raw) {
		$org_raw = trim(preg_replace('/\s+/', ' ', $org_raw));
		if ($org_raw != '')
			$organizations[] = $org_raw;
	}
	$organizations = array_unique($organizations);
	asort($organizations);
	array_unshift($organizations, '');

        $task_id = $this->task->taskMetadataModel->request->getIntegerParam('task_id');
	$taskOrg = $this->task->taskMetadataModel->get($task_id, 'organization');
?>

<?= $this->form->label(t('Organization'), 'organization') ?>
<select name="organization" id="form-organization">
	<?php foreach ($organizations as $org): ?>
		<option <?= ($taskOrg == $org) ? "selected" : "" ?> value="<?= htmlspecialchars($org) ?>"><?= htmlspecialchars($org) ?></option>
	<?php endforeach ?>
</select>
