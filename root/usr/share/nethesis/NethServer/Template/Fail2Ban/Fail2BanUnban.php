<?php
/* @var $view Nethgui\Renderer\Xhtml */
echo $view->header()->setAttribute('template', $T('Fail2BanUnBan_header'));

echo $view->textInput('UnBanIP');

echo $view->buttonList()
    ->insert($view->button('SUBMIT/REFRESH', $view::BUTTON_SUBMIT))
    ->insert($view->button('Help', $view::BUTTON_HELP));

echo "<pre class='fail2ban_unban'>";
echo $view->textLabel('report');
echo "</pre>";


$view->includeCss('
    pre.fail2ban_unban {
        border: 2px solid #aaa;
        padding: 10px;
    }
');
