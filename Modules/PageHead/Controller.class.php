<?php namespace Monstercms\Modules\PageHead;

use \Monstercms\Core as Core;
use \Monstercms\Core\Lang;
use \Monstercms\Lib;
use \Monstercms\Lib\Request;
use \Monstercms\Modules\Page;
use Monstercms\Core\MCMS;

class Controller extends Core\ControllerAbstract
{
   public function getSeoForm()
   {
      return include($this->modulePath . DS . "Forms" . DS . "Seo.php");
   }

   public function fullSeoForm($module, $objectId) {

      $pageHead = Core\PageHead::init();
      $pageHead->setData($module, $objectId);

      return array
      (
          'menu_item_seo_title'       => $pageHead->getTitle(),
          'menu_item_seo_description' => $pageHead->getDescription(),
          'menu_item_seo_keywords'    => $pageHead->getKeywords(),
          'menu_item_seo_canonical'   => $pageHead->getCanonical(),
          'menu_item_seo_noindex'     => (int) $pageHead->isNoindex()
      );
   }

   public function saveSeoForm($module, $objectId) {
      $pageHead = Core\PageHead::init();
      $pageHead->setTitle(Request::getPost('menu_item_seo_title'));
      $pageHead->setDescription(Request::getPost('menu_item_seo_description'));
      $pageHead->setKeywords(Request::getPost('menu_item_seo_keywords'));
      $pageHead->setCanonical(Request::getPost('menu_item_seo_canonical'));
      $pageHead->setNoindex(Request::getPost('menu_item_seo_noindex'));
      $pageHead->save($module, $objectId);
   }
}