<?php
/**
 * @filesource modules/index/views/linesettings.php
 *
 * @copyright 2016 Goragod.com
 * @license https://www.kotchasan.com/license/
 *
 * @see https://www.kotchasan.com/
 */

namespace Index\Linesettings;

use Kotchasan\Html;

/**
 * module=linesettings
 *
 * @author Goragod Wiriya <admin@goragod.com>
 *
 * @since 1.0
 */
class View extends \Gcms\View
{
    /**
     * ฟอร์มตั้งค่า LINE
     *
     * @param object $config
     *
     * @return string
     */
    public function render($config)
    {
        $form = Html::create('form', [
            'id' => 'setup_frm',
            'class' => 'setup_frm',
            'autocomplete' => 'off',
            'action' => 'index.php/index/model/linesettings/submit',
            'onsubmit' => 'doFormSubmit',
            'ajax' => true,
            'token' => true
        ]);
        $fieldset = $form->add('fieldset', [
            'titleClass' => 'icon-line',
            'title' => '{LNG_LINE Login}'
        ]);
        // line_channel_id
        $fieldset->add('number', [
            'id' => 'line_channel_id',
            'labelClass' => 'g-input icon-number',
            'itemClass' => 'item',
            'label' => '{LNG_Channel ID} <a href="https://www.goragod.com/index.php?module=knowledge&id=3903" target=_blank class=icon-help></a>',
            'value' => isset($config->line_channel_id) ? $config->line_channel_id : ''
        ]);
        // line_channel_secret
        $fieldset->add('text', [
            'id' => 'line_channel_secret',
            'labelClass' => 'g-input icon-password',
            'itemClass' => 'item',
            'label' => '{LNG_Channel secret}',
            'comment' => '{LNG_for login by LINE account}',
            'value' => isset($config->line_channel_secret) ? $config->line_channel_secret : ''
        ]);
        // line_callback_url
        $fieldset->add('text', [
            'id' => 'line_callback_url',
            'labelClass' => 'g-input icon-copy',
            'itemClass' => 'item',
            'label' => '{LNG_Callback URL}',
            'readonly' => true,
            'value' => str_replace('www.', '', WEB_URL.'line/callback.php')
        ]);
        $fieldset = $form->add('fieldset', [
            'titleClass' => 'icon-line',
            'title' => '{LNG_Messaging API}'
        ]);
        // line_official_account
        $fieldset->add('text', [
            'id' => 'line_official_account',
            'labelClass' => 'g-input icon-line',
            'itemClass' => 'item',
            'label' => '{LNG_Bot basic ID}  <a href="https://www.goragod.com/index.php?module=knowledge&id=3904" target=_blank class=icon-help></a>',
            'comment' => '{LNG_LINE official account (with @ prefix, e.g. @xxxx)}',
            'value' => isset($config->line_official_account) ? $config->line_official_account : ''
        ]);
        // line_channel_access_token
        $fieldset->add('text', [
            'id' => 'line_channel_access_token',
            'labelClass' => 'g-input icon-password',
            'itemClass' => 'item',
            'label' => '{LNG_Channel access token (long-lived)}',
            'comment' => '{LNG_send message to user When a user adds LINE&#039;s official account as a friend}',
            'value' => isset($config->line_channel_access_token) ? $config->line_channel_access_token : ''
        ]);
        // line_webhook_url
        $fieldset->add('text', [
            'id' => 'line_webhook_url',
            'labelClass' => 'g-input icon-copy',
            'itemClass' => 'item',
            'label' => '{LNG_Webhook URL}',
            'readonly' => true,
            'value' => str_replace('www.', '', WEB_URL.'line/webhook.php')
        ]);
        $fieldset = $form->add('fieldset', [
            'class' => 'submit'
        ]);
        // submit
        $fieldset->add('submit', [
            'class' => 'button save large icon-save',
            'value' => '{LNG_Save}'
        ]);
        // Javascript
        $form->script('initLinesettings();');
        // คืนค่า HTML
        return $form->render();
    }
}
