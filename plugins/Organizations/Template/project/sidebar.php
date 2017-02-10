<?php if ($this->user->hasProjectAccess('organizations', 'index', $project['id'])): ?>
	<li>
		<?= $this->url->link(t('Metadata'), 'OrganizationController', 'project', array('plugin' => 'organizations', 'project_id' => $project['id'])) ?>
	</li>
<?php endif ?>
