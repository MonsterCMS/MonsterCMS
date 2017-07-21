<?php namespace Monstercms\Widgets\Shit;

use Monstercms\Core;

class Controller extends Core\WidgetAbstract implements Core\WidgetInterface
{
    /**
     * Метод возвращает массив с формой редактирования
     * @return array
     */
    public function getFormEdit()
    {
        return include(WIDGET_DIR . DS . 'Shit' . DS . 'Form.php');
    }

    /**
     * Метод возвращает массив с формой добавления
     * @return array
     */
    public function getFormAdd()
    {
        return include(WIDGET_DIR . DS . 'Shit' . DS . 'Form.php');
    }

    /**
     * Метод возвращает представления виджета
     * @param $vars - массив переменных которые видны в шаблоне
     *  @return string
     */
    public function getView(array $vars){
        return $this->view->get('View.php', $vars);
    }

    /**
     * Метод возвращает url иконки
     *  @return string
     */
    public  function getIco()
    {
        return 'http://www.iconsearch.ru/uploads/icons/pidginsmilies/24x24/poop.png';
    }

    /**
     * Метод возвращает название виджета
     *  @return string
     */
    public function getName()
    {
        return "Какашка";
    }


    /**
     * Метод возвращает версию модуля Widget с которой он совместим
     * @return string
     */
    public function compatibility()
    {
        return '1.0';
    }

    /**
     * Размер окна в формате wxh, например: 700x800
     * если метод возвращает пустое заначение или false, то окно не отображается
     * @return string|false
     */
    public function getWindowSize()
    {
        return '700x800';
    }

    /**
     * Массив с параметрами. ключ=>значение
     * Данный массив заполнит форму добавления виджета.
     * После заполнения формы добавления/редактирования виджета
     * пост параметры ($_POST) ключи которых совпадают с ключами параметров виджета,
     * значения параметров виджетов будут сохранены в БД
     * @return array
     */
    public function getParameters()
    {
        return array(
            'name' => 'Говняшкин',
            'age'  => 52
        );
    }
}