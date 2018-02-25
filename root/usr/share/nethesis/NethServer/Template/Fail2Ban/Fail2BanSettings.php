<?php
/* @var $view Nethgui\Renderer\Xhtml */
echo $view->header()->setAttribute('template', $T('Fail2Ban_header'));

echo $view->panel()
->insert($view->fieldsetSwitch('status', 'enabled', $view::FIELDSETSWITCH_CHECKBOX | $view::FIELDSETSWITCH_EXPANDABLE)->setAttribute('uncheckedValue', 'disabled')

    ->insert($view->columns()
        ->insert($view->slider('FindTime', $view::SLIDER_ENUMERATIVE | $view::LABEL_ABOVE)->setAttribute('label', $T('Maximum find time (${0})')))
        ->insert($view->slider('BanTime', $view::SLIDER_ENUMERATIVE | $view::LABEL_ABOVE)->setAttribute('label', $T('Maximum ban time (${0})')))
    )

    ->insert($view->columns()
        ->insert($view->slider('MaxRetry', $view::SLIDER_ENUMERATIVE | $view::LABEL_ABOVE)->setAttribute('label', $T('Maximum retry number (${0})')))
        ->insert($view->selector('LogLevel', $view::SELECTOR_DROPDOWN))
    )

    ->insert($view->columns()
        ->insert($view->elementList()
            ->insert($view->checkBox('Recidive_Perpetual', 'enabled')->setAttribute('uncheckedValue', 'disabled'))
            ->insert($view->checkBox('BanLocalNetwork', 'enabled')->setAttribute('uncheckedValue', 'disabled'))
            ->insert($view->textArea('IgnoreIP', $view::LABEL_ABOVE)->setAttribute('dimensions', '10x30'))
        )

        ->insert($view->elementList()
            ->insert($view->fieldsetSwitch('Mail', 'enabled', $view::FIELDSETSWITCH_CHECKBOX | $view::FIELDSETSWITCH_EXPANDABLE)->setAttribute('uncheckedValue', 'disabled')
                ->insert($view->checkBox('MailJailState', 'enabled')->setAttribute('uncheckedValue', 'disabled'))
                ->insert($view->textArea('CustomDestemail', $view::LABEL_ABOVE)->setAttribute('dimensions', '10x30'))
            )
        )
    )


    #start the jail status
    ->insert($view->columns()

        #jails column #1
        ->insert($view->elementList()

            ->insert( $view->fieldset(NULL, $view::FIELDSET_EXPANDABLE)->setAttribute('template', $T('ApacheStatus_label'))
                ->insert( $view->elementList()
                    ->insert($view->checkBox('ApacheAuth_status', 'true')->setAttribute('uncheckedValue', 'false'))
                    ->insert($view->checkBox('ApacheBadbots_status', 'true')->setAttribute('uncheckedValue', 'false'))
                    ->insert($view->checkBox('ApacheBotsearch_status', 'true')->setAttribute('uncheckedValue', 'false'))
                    ->insert($view->checkBox('ApacheFakegooglebot_status', 'true')->setAttribute('uncheckedValue', 'false'))
                    ->insert($view->checkBox('ApacheModsecurity_status', 'true')->setAttribute('uncheckedValue', 'false'))
                    ->insert($view->checkBox('ApacheNohome_status', 'true')->setAttribute('uncheckedValue', 'false'))
                    ->insert($view->checkBox('ApacheNoscript_status', 'true')->setAttribute('uncheckedValue', 'false'))
                    ->insert($view->checkBox('ApacheOverflows_status', 'true')->setAttribute('uncheckedValue', 'false'))
                    ->insert($view->checkBox('ApacheScan_status', 'true')->setAttribute('uncheckedValue', 'false'))
                    ->insert($view->checkBox('ApacheShellshock_status', 'true')->setAttribute('uncheckedValue', 'false'))
                )
            )

            ->insert( $view->fieldset(NULL, $view::FIELDSET_EXPANDABLE)->setAttribute('template', $T('DatabaseStatus_label'))
                ->insert( $view->elementList()
                    ->insert($view->checkBox('MysqldAuth_status', 'true')->setAttribute('uncheckedValue', 'false'))
                )
            )

            ->insert( $view->fieldset(NULL, $view::FIELDSET_EXPANDABLE)->setAttribute('template', $T('MailStatus_label'))
                ->insert( $view->elementList()
                    ->insert($view->checkBox('Dovecot_status', 'true')->setAttribute('uncheckedValue', 'false'))
                    ->insert($view->checkBox('PostfixRbl_status', 'true')->setAttribute('uncheckedValue', 'false'))
                    ->insert($view->checkBox('Postfix_status', 'true')->setAttribute('uncheckedValue', 'false'))
                    ->insert($view->checkBox('Sieve_status', 'true')->setAttribute('uncheckedValue', 'false'))
                 )
            )

            ->insert( $view->fieldset(NULL, $view::FIELDSET_EXPANDABLE)->setAttribute('template', $T('FtpStatus_label'))
                ->insert( $view->elementList()
                    ->insert($view->checkBox('Vsftpd_status', 'true')->setAttribute('uncheckedValue', 'false'))
                )
            )

            ->insert( $view->fieldset(NULL, $view::FIELDSET_EXPANDABLE)->setAttribute('template', $T('ChatStatus_label'))
                ->insert( $view->elementList()
                    ->insert($view->checkBox('EjabberAuth_status', 'true')->setAttribute('uncheckedValue', 'false'))
                )
            )

        )

        #jails column #2
        ->insert($view->elementList()

            ->insert( $view->fieldset(NULL, $view::FIELDSET_EXPANDABLE)->setAttribute('template', $T('NginxStatus_label'))
                ->insert( $view->elementList()
                    ->insert($view->checkBox('NginxHttpAuth_status', 'true')->setAttribute('uncheckedValue', 'false'))
                    ->insert($view->checkBox('NginxBotSearch_status', 'true')->setAttribute('uncheckedValue', 'false'))
                )
            )

            ->insert( $view->fieldset(NULL, $view::FIELDSET_EXPANDABLE)->setAttribute('template', $T('SecurityStatus_label'))
                ->insert( $view->elementList()
                    ->insert($view->checkBox('HttpdAdmin_status', 'true')->setAttribute('uncheckedValue', 'false'))
                    ->insert($view->checkBox('PamGeneric_status', 'true')->setAttribute('uncheckedValue', 'false'))
                    ->insert($view->checkBox('Recidive_status', 'true')->setAttribute('uncheckedValue', 'false'))
                )
            )

            ->insert( $view->fieldset(NULL, $view::FIELDSET_EXPANDABLE)->setAttribute('template', $T('SshStatus_label'))
                ->insert( $view->elementList()
                    ->insert($view->checkBox('SshdDdos_status', 'true')->setAttribute('uncheckedValue', 'false'))
                    ->insert($view->checkBox('Sshd_status', 'true')->setAttribute('uncheckedValue', 'false'))
                )
            )

            ->insert( $view->fieldset(NULL, $view::FIELDSET_EXPANDABLE)->setAttribute('template', $T('VPNStatus_label'))
                ->insert( $view->elementList()
                    ->insert($view->checkBox('OpenVpnAuth_status', 'true')->setAttribute('uncheckedValue', 'false'))
                )
            )

            ->insert( $view->fieldset(NULL, $view::FIELDSET_EXPANDABLE)->setAttribute('template', $T('WebappStatus_label'))
                ->insert( $view->elementList()
                    ->insert($view->checkBox('Owncloud_status', 'true')->setAttribute('uncheckedValue', 'false'))
                    ->insert($view->checkBox('ApachePhpMyAdmin_status', 'true')->setAttribute('uncheckedValue', 'false'))
                    ->insert($view->checkBox('Roundcube_status', 'true')->setAttribute('uncheckedValue', 'false'))
                    ->insert($view->checkBox('SogoAuth_status', 'true')->setAttribute('uncheckedValue', 'false'))
                )
            )

        )

    )

);

echo $view->buttonList($view::BUTTON_SUBMIT| $view::BUTTON_HELP)
        ->insert($view->button('RestartFail2ban', $view::BUTTON_SUBMIT)->setAttribute('label', $T('RestartFail2ban_label')));
 
# CSS rules override
$view->includeCss('
    .columns.c2 .column {
        width: 50%;
    }

    .ui-widget textarea {
        max-width: 230px;
    }

    .columns .column {
        padding-left: 0;
    }

    .columns .column:first-child {
        margin-right: 8px;
    }
');

