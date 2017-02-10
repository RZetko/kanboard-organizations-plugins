<div class="page-header">
	<h2><?= t('Metadata') ?></h2>
</div>


<?php if (empty($metadata)): ?>
	<p class="alert"><?= t('No metadata') ?></p>
<?php else: ?>
	<table class="table-small table-fixed">
		<tr>
			<th class="column-40"><?= t('Key') ?></th>
			<th class="column-40"><?= t('Value') ?></th>
			<th class="column-20"><?= t('Action') ?></th>
		</tr>
		<?php foreach ($metadata as $key => $value): ?>
			<tr>
				<td><?= htmlspecialchars($key); ?></td>
				<td><?= htmlspecialchars($value); ?></td>
				<td>
					<ul>
						<li>
							<?= $this->url->link(t('Remove'), 'OrganizationController', 'confirmProject', array('plugin' => 'organizations', 'project_id' => $project['id'], 'key' => $key ), false, 'popover') ?>
						</li>
						<li>
							<?= $this->url->link(t('Edit'), 'OrganizationController', 'editProject', array('plugin' => 'organizations', 'project_id' => $project['id'], 'key' => $key ), false, 'popover') ?>
						</li>
					</ul>
				</td>
			</tr>
		<?php endforeach ?>
	</table>
<?php endif ?>

<?= $this->render('organizations:project/form', array('project' => $project, 'form_headline' => t('Add metadata'), 'values' => array())) ?>
