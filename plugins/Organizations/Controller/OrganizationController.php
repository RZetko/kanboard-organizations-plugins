<?php

namespace Kanboard\Plugin\Organizations\Controller;

use Kanboard\Controller\BaseController;

/**
 * Metadata
 *
 * @package controller
 * @author  BlueTeck
 */
class OrganizationController extends BaseController {

    public function project() {
        $project = $this->getProject();

        $metadata = $this->projectMetadataModel->getAll($project['id']);

        $this->response->html($this->helper->layout->project('organizations:project/metadata', array('title' => t('Organizations'),
                    'project' => $project,
                    'metadata' => $metadata)));
    }

    public function task() {
        $project = $this->getProject();
        $task = $this->getTask();

        $metadata = $this->taskMetadataModel->getAll($task['id']);

        $this->response->html($this->helper->layout->task('organizations:task/metadata', array('title' => t('Organization'),
                    'task' => $task,
                    'add_form' => true,
                    'project' => $project,
                    'metadata' => $metadata)));
    }

    public function saveTask() {
        $task = $this->getTask();
        $values = $this->request->getValues();

        $this->taskMetadataModel->save($task['id'], array($values['key'] => $values['value']));

        return $this->response->redirect($this->helper->url->to('OrganizationController', 'task', array('plugin' => 'organizations', 'task_id' => $task['id'], 'project_id' => $task['project_id'])), true);
    }

    public function saveProject() {
        $project = $this->getProject();
        $values = $this->request->getValues();

        $this->projectMetadataModel->save($project['id'], array($values['key'] => $values['value']));

        return $this->response->redirect($this->helper->url->to('OrganizationController', 'project', array('plugin' => 'organizations', 'project_id' => $project['id'])), true);
    }

    public function confirmProject() {
        $project = $this->getProject();
        $key = $this->request->getStringParam('key');

        $this->response->html($this->template->render('organizations:project/remove', array(
                    'project' => $project,
                    'key' => $key,
        )));
    }

    public function removeTask() {
        $task = $this->getTask();
        $key = $this->request->getStringParam('key');

        $this->taskMetadataModel->remove($task['id'], $key);

        return $this->response->redirect($this->helper->url->to('OrganizationController', 'task', array('plugin' => 'organizations', 'task_id' => $task['id'], 'project_id' => $task['project_id'])), true);
    }

    public function removeProject() {
        $project = $this->getProject();
        $key = $this->request->getStringParam('key');

        $this->projectMetadataModel->remove($project['id'], $key);

        return $this->response->redirect($this->helper->url->to('OrganizationController', 'project', array('plugin' => 'organizations', 'project_id' => $project['id'])), true);
    }

    public function editProject() {
        $project = $this->getProject();
        $key = $this->request->getStringParam('key');
        $metadata = $this->projectMetadataModel->get($project['id'], $key);

        $this->response->html($this->template->render('organizations:project/form', array(
                    'project' => $project,
                    'form_headline' => t('Edit organization'),
                    'values' => array('key' => $key, 'value' => $metadata),
        )));
    }

    public function editTask() {
        $project = $this->getProject();
        $task = $this->getTask();
        $key = $this->request->getStringParam('key');
        $metadata = $this->taskMetadataModel->get($task['id'], $key);

        $this->response->html($this->template->render('organizations:task/form', array(
                    'project' => $project,
                    'task' => $task,
                    'form_headline' => t('Edit organization'),
                    'values' => array('key' => $key, 'value' => $metadata),
        )));
    }

}
