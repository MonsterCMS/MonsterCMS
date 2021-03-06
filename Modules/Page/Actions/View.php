<?php

defined('MCMS_ACCESS') or die('No direct script access.');

/**
 * @var $this Core\ControllerAbstract
 */

use \Monstercms\Core;
use \Monstercms\Lib;
use \Monstercms\Modules\page;

$id = $this->getObjectId();

if ($id == 0) {
   throw new Core\HttpErrorException(404);
}

$page_info = $this->model->info($id);

if (empty($page_info)) {
    throw new Core\HttpErrorException(404);
}

$pageHead = Core\PageSemantic::init();
$pageHead->setData($this->moduleName, $id);


$title = $pageHead->getTitle();


Core\Mcms::setTheme($pageHead->getTheme());

if(empty($tile)) {
    $title = $page_info->name . ' - ' . SITE_NAME;
    $pageHead->setTitle($title);
}
$edit = false;
//$edit = (Core\Users::isAdmin()) ? true : false;





$body = Core\Events::cell(
    $this->moduleName . '.top',
    'string',
    array($page_info)
);

$this->view->add('BODY', $body);

/*
$this->tag->BODY .= $this->view->get('top.php');
$this->tag->BODY .= $mEdit->html;
$this->tag->BODY .= $this->view->get('bottom.php');
*/

$widgets = Core\Module::get('Widgets');

$this->view->inc('BODY', 'Top.php');
$this->view->add('BODY', $widgets->toolBar($id));
$this->view->add('BODY', $widgets->view($id));
$this->view->inc('BODY', 'Bottom.php');

$body = Core\Events::cell(
    $this->moduleName . '.bottom',
    'string',
    array($page_info)
);

$this->view->add('BODY', $body);
