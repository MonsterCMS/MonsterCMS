<?php
use Monstercms\Core\Module;
return array(

    array(
          'type'=>'tab',
          'label' => 'Текст',
          'items' =>array
         (
              array
              (
                  'name' => "text",
                  'type' => 'ckeditor',
                  'label' => 'Текст*:',
                  'valid' => array
                  (
                      'required'
                  ),
                  'upload_script'=>'/Widgets/UploadCkeditor/PageId/' . $this->pageId.'?',
                  'height'=>'350',
                  'resize_enabled' => false,


              ),
          )
        ),
    array(
          'type'=>'tab',
          'label' => 'Атрибуты',
          'items' =>array
         (
              Module::get('Widgets')->getCssClassFormElement(),
          )
    ),


    array
        (
            'type' => 'submit',
            'value' => ' Сохранить '
        ),
);