<div class="page-header">
	<h2><?= t('Remove Organization') ?></h2>
</div>

<div class="confirm">
	<p class="alert alert-info">
		<?= t('Do you really want to remove this organization?') ?>
	</p>

	<p><strong><?= htmlspecialchars($key); ?></strong></p>

	<div class="form-actions">
		<?= $this->url->link(t('Yes'), 'OrganizationController', 'removeProject', array('plugin' => 'organizations', 'project_id' => $project['id'], 'key' => $key), true, 'btn btn-red') ?>
		<?= t('or') ?>
		<?= $this->url->link(t('cancel'), 'OrganizationController', 'project', array('plugin' => 'organizations', 'project_id' => $project['id'])) ?>
	</div>
</div>
