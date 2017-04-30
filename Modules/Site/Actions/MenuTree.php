<?php namespace Monstercms\Modules\site;
/**
 * @var $this Core\ControllerAbstract
 */

defined('MCMS_ACCESS') or die('No direct script access.');


use \Monstercms\Core as Core;
use \Monstercms\Core\Lang;
use \Monstercms\Lib as Lib;

if ($this->getObjectId() === 0){
    throw new Core\HttpErrorException(404);
}

if (!Core\Users::isAdmin()) {
    throw new Core\HttpErrorException(403);
}

$menuId = $this->getObjectId();

$list = $this->model('MenuItems')->menuItemsList($menuId);

$out = array();

$out['menuId'] = $menuId;

if (!is_array($list))
{
    print  json_encode($out);

    exit();
}

$s = 0;
foreach ($list as $item)
{

    $out['items'][$s] = array
    (
       'id'          =>  $item['id'],
       'pId'         =>  $item['parent_id'],
       'name'        =>  $item['name'],
       'menuId'      =>  $menuId,
       'hide'        =>  $item['hide'],
       'module_name' =>  Core\Mcms::getMenuItemName($item['module'], $item['item_type']),
       'open'        =>  'true',
       'menu'        => array
       (
           array
           (
               'icoClass' => "fa fa-external-link-square",
               'name'     => Lang::get('Site.goTo'),
               'url'      => "/site/GoTo/id/" . $item['id'],
               'role'     => 'link',
               'attr'     =>''

           ),
           array
            (
                'icoClass' => "fa fa-cog",
                'name'     => Lang::get('Site.config'),
                'url'      => "/site/MenuItemEdit/id/" . $item['id'],
               'role'      => 'link',
               'attr'      => ''

            ),
           array
           (
               'icoClass' => "fa fa-trash-o",
               'name'     => Lang::get('Site.delete'),
               'url'      => "/site/MenuItemDelete/id/" .
                            $item['id'].'/menu_id/'. $menuId,
               'role'     => 'menu-item-delete',
               'attr'     => 'data-confirm-text="'.Lang::get('Site.confirmDelete').'"'
           ),

       )
    );
    $out['items'][$s]['url']   = '';
    $out['items'][$s]['icons'] = array(array('class'=>'fa fa-file-o'));

    /*if link*/
    if((int) $item['url_id'] === 0 && !empty($item['link_url']))
    {
        $out['items'][$s]['url']   = $item['link_url'];
        $out['items'][$s]['icons'] = array
        (
            array('class'=>'fa fa-link','title' => Lang::get('site.link'))
        );
    }
    /*if index*/
    else if((int) $item['index'] === 1)
    {
        $out['items'][$s]['url'] = '/';
        $out['items'][$s]['icons'] = array
        (
            array('class'=>'fa fa-home','title'=>Lang::get('site.index'))
        );
    }
    /*if not index and not link*/
    else
    {
        $out['items'][$s]['menu'][] = array
        (
            'icoClass' => "fa fa-home",
            'name'     => Lang::get('Site.makeIndex'),
            'url'      => "/site/MakeIndex/id/" . $item['id'],
            'role'    => 'set-index',
            'attr'   =>''
        );
    }

    $s++;
}

//print_r($out);

print  json_encode($out);
exit();