<?php
/* @var $view Nethgui\Renderer\Xhtml */
echo $view->header()->setAttribute('template', $T('Fail2BanUnBan_header'));

echo $view->textInput('UnBanIP');

echo $view->buttonList()
    ->insert($view->button('SUBMIT/REFRESH', $view::BUTTON_SUBMIT));

// Banned IP
echo "<pre class='fail2ban-item'>";
echo $view->fieldset(NULL,$view::FIELDSET_EXPANDABLE)->setAttribute('template', $T('BannedIP'))
    ->insert($view->textLabel('bannedIP'));
echo "</pre>";

// Active Jails
echo "<pre class='fail2ban-item'>";
echo $view->fieldset(NULL,$view::FIELDSET_EXPANDABLE)->setAttribute('template', $T('ActiveJails'))
    ->insert($view->textLabel('report'));
echo "</pre>";
