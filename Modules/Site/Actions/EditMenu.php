<?php namespace Monstercms\Modules\Site;

defined('MCMS_ACCESS') or die('No direct script access.');

/**
 * @var $this Core\ControllerAbstract
 */

use \Monstercms\Core;
use \Monstercms\Lib;


if (!Core\Users::isAdmin()) {
    throw new Core\HttpErrorException(403);
}

if ($this->getObjectId() === 0) {
    throw new Core\HttpErrorException(404);
}

$id = $this->getObjectId();

Lib\View::setBasicTemplate(THEMES_DIALOG_PATH);

$this->view->add('TITLE', Core\Lang::get('Site.editMenuTitle'));

$formItems = include($this->modulePath . 'Forms' . DS . 'Menu.php');

$this->view->add('BODY', $this->model('Menu')->edit($id, $formItems));
