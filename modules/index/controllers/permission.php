<?php
/**
 * @filesource modules/index/controllers/permission.php
 *
 * @copyright 2016 Goragod.com
 * @license https://www.kotchasan.com/license/
 *
 * @see https://www.kotchasan.com/
 */

namespace Index\Permission;

use Gcms\Login;
use Kotchasan\Html;
use Kotchasan\Http\Request;
use Kotchasan\Language;

/**
 * module=permission
 *
 * @author Goragod Wiriya <admin@goragod.com>
 *
 * @since 1.0
 */
class Controller extends \Gcms\Controller
{
    /**
     * รายชื่อสมาชิก
     *
     * @param Request $request
     *
     * @return string
     */
    public function render(Request $request)
    {
        // ข้อความ title bar
        $this->title = Language::get('Permission');
        // เลือกเมนู
        $this->menu = 'member';
        // แอดมิน
        $login = Login::isAdmin();
        // แอดมิน, ไม่ใช่สมาชิกตัวอย่าง
        if (Login::notDemoMode($login)) {
            // แสดงผล
            $section = Html::create('section');
            // breadcrumbs
            $breadcrumbs = $section->add('nav', [
                'class' => 'breadcrumbs'
            ]);
            $ul = $breadcrumbs->add('ul');
            $ul->appendChild('<li><span class="icon-user">{LNG_Users}</span></li>');
            $ul->appendChild('<li><span>'.$this->title.'</span></li>');
            $section->add('header', [
                'innerHTML' => '<h2 class="icon-list">'.$this->title.'</h2>'
            ]);
            $div = $section->add('div', [
                'class' => 'content_bg'
            ]);
            // แสดงตาราง
            $div->appendChild(\Index\Permission\View::create()->render($request));
            // คืนค่า HTML
            return $section->render();
        }
        // 404
        return \Index\Error\Controller::execute($this, $request->getUri());
    }
}
