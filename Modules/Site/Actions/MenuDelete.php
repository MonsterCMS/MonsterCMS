<?php namespace Monstercms\Modules\Site;

defined('MCMS_ACCESS') or die('No direct script access.');

use \Monstercms\Core;
use \Monstercms\Lib;

if (!Core\Users::isAdmin()) {
    throw new Core\HttpErrorException(403);
}

if ($this->getObjectId() === 0) {
    throw new Core\HttpErrorException(404);
}
$id = (int) $this->getObjectId();

$out = array(
    'menuId'  => $id,
    'delete'  => false,
    'message' => ''
);

if (!$this->model('MenuItems')->isChilds($id)) {
    $this->model('Menu')->menuDelete($id);
    $out['delete'] = true;
} else {
    $out['message'] = Core\Lang::get('site.errorDeleteMenu');
}

print json_encode($out);
exit();