<?php

namespace Kanboard\Plugin\Organizations;

use Kanboard\Core\Plugin\Base;
use Kanboard\Core\Translator;

class Plugin extends Base {
	public function initialize() {
		// Project
		$this->template->hook->attach('template:project:sidebar', 'organizations:project/sidebar');

		// Task
		$this->template->hook->attach('template:task:form:third-column', 'organizations:task_creation/form');

		$this->hook->on('model:task:modification:prepare', array($this, 'beforeEditTask'));
		$this->hook->on('model:task:creation:aftersave', array($this, 'afterSaveTask'));
	
		// Task in board
		$this->template->hook->attach('template:board:task:footer', 'organizations:task/footer');

	}

	public function onStartup()
	{
		// Translation
		Translator::load($this->languageModel->getCurrentLanguage(), __DIR__.'/Locale');
	}

	public function beforeEditTask(array &$values)
	{
		$task_id = $this->request->getIntegerParam('task_id');
		$project_id = $this->request->getIntegerParam('project_id');
		$orgName = $values['organization'];
		$this->taskMetadataModel->save($task_id, ['organization' => $orgName]);
		unset($values['organization']);

		return $this->response->redirect($this->helper->url->to('OrganizationController', 'task', array('plugin' => 'organizations', 'task_id' => $task_id, 'project_id' => $project_id)), true);
	}

	public function afterSaveTask($task_id)
	{
		$orgArr = explode("organization=", $this->request->getBody());
		$orgName = $orgArr[1];
		$this->taskMetadataModel->save($task_id, ['organization' => $orgName]);
		
		return $this->response->redirect($this->helper->url->to('OrganizationController', 'task', array('plugin' => 'organizations', 'task_id' => $task_id)), true);
	}

	public function getPluginName() {
		return 'Organizations';
	}

	public function getPluginDescription() {
		return t('Create organizations for projects and add them to tasks');
	}

	public function getPluginAuthor() {
		return 'Zdenko Pikula @ IP Security Consulting';
	}

	public function getPluginVersion() {
		return '1.0.0';
	}

	public function getPluginHomepage() {
		return 'https://www.ipsec.info';
	}
}
