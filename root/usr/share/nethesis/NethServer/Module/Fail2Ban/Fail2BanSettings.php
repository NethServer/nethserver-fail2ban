<?php
namespace NethServer\Module\Fail2Ban;

use Nethgui\System\PlatformInterface as Validate;

/**
 * Implement gui module for fail2ban service
 */

class  Fail2BanSettings extends \Nethgui\Controller\AbstractController
{

    public function initialize()
    {
    $this->declareParameter('BanLocalNetwork', Validate::SERVICESTATUS, array('configuration', 'fail2ban', 'BanLocalNetwork'));
    $this->declareParameter('FindTime', Validate::POSITIVE_INTEGER, array('configuration', 'fail2ban', 'FindTime'));
    $this->declareParameter('BanTime', Validate::POSITIVE_INTEGER, array('configuration', 'fail2ban', 'BanTime'));
    $this->declareParameter('CustomDestemail', Validate::NOTEMPTY, array('configuration', 'fail2ban', 'CustomDestemail'));
    $this->declareParameter('IgnoreIP', Validate::ANYTHING, array('configuration', 'fail2ban', 'IgnoreIP'));
    $this->declareParameter('LogLevel', $this->createValidator()->memberOf('CRITICAL','ERROR','WARNING','NOTICE','INFO','DEBUG'), 
                 array('configuration', 'fail2ban', 'LogLevel'));
    $this->declareParameter('Mail', Validate::SERVICESTATUS, array('configuration', 'fail2ban', 'Mail'));
	$this->declareParameter('MailJailState', Validate::SERVICESTATUS, array('configuration', 'fail2ban', 'MailJailState'));
    $this->declareParameter('MaxRetry', Validate::POSITIVE_INTEGER, array('configuration', 'fail2ban', 'MaxRetry'));
    $this->declareParameter('status', Validate::SERVICESTATUS, array('configuration', 'fail2ban', 'status'));


    $this->declareParameter('ApacheAuth_status', $this->createValidator()->memberOf('true','false'), array('configuration', 'fail2ban', 'ApacheAuth_status'));
    $this->declareParameter('ApacheBadbots_status', $this->createValidator()->memberOf('true','false'), array('configuration', 'fail2ban', 'ApacheBadbots_status'));
    $this->declareParameter('ApacheBotsearch_status', $this->createValidator()->memberOf('true','false'), array('configuration', 'fail2ban', 'ApacheBotsearch_status'));
    $this->declareParameter('ApacheFakegooglebot_status', $this->createValidator()->memberOf('true','false'), array('configuration', 'fail2ban', 'ApacheFakegooglebot_status'));
    $this->declareParameter('ApacheModsecurity_status', $this->createValidator()->memberOf('true','false'), array('configuration', 'fail2ban', 'ApacheModsecurity_status'));
    $this->declareParameter('ApacheNohome_status', $this->createValidator()->memberOf('true','false'), array('configuration', 'fail2ban', 'ApacheNohome_status'));
    $this->declareParameter('ApacheNoscript_status', $this->createValidator()->memberOf('true','false'), array('configuration', 'fail2ban', 'ApacheNoscript_status'));
    $this->declareParameter('ApacheOverflows_status', $this->createValidator()->memberOf('true','false'), array('configuration', 'fail2ban', 'ApacheOverflows_status'));
    $this->declareParameter('ApacheScan_status', $this->createValidator()->memberOf('true','false'), array('configuration', 'fail2ban', 'ApacheScan_status'));
    $this->declareParameter('ApacheShellshock_status', $this->createValidator()->memberOf('true','false'), array('configuration', 'fail2ban', 'ApacheShellshock_status'));
    $this->declareParameter('ApachePhpMyAdmin_status', $this->createValidator()->memberOf('true','false'), array('configuration', 'fail2ban', 'ApachePhpMyAdmin_status'));
    $this->declareParameter('Dovecot_status', $this->createValidator()->memberOf('true','false'), array('configuration', 'fail2ban', 'Dovecot_status'));
    $this->declareParameter('EjabberAuth_status', $this->createValidator()->memberOf('true','false'), array('configuration', 'fail2ban', 'EjabberAuth_status'));
    $this->declareParameter('HttpdAdmin_status', $this->createValidator()->memberOf('true','false'), array('configuration', 'fail2ban', 'HttpdAdmin_status'));
    $this->declareParameter('MysqldAuth_status', $this->createValidator()->memberOf('true','false'), array('configuration', 'fail2ban', 'MysqldAuth_status'));
    $this->declareParameter('Nextcloud_status', $this->createValidator()->memberOf('true','false'), array('configuration', 'fail2ban', 'Nextcloud_status'));
    $this->declareParameter('NginxBotSearch_status', $this->createValidator()->memberOf('true','false'), array('configuration', 'fail2ban', 'NginxBotSearch_status'));
    $this->declareParameter('NginxHttpAuth_status', $this->createValidator()->memberOf('true','false'), array('configuration', 'fail2ban', 'NginxHttpAuth_status'));
    $this->declareParameter('OpenVpnAuth_status', $this->createValidator()->memberOf('true','false'), array('configuration', 'fail2ban', 'OpenVpnAuth_status'));
    $this->declareParameter('Owncloud_status', $this->createValidator()->memberOf('true','false'), array('configuration', 'fail2ban', 'Owncloud_status'));
    $this->declareParameter('PamGeneric_status', $this->createValidator()->memberOf('true','false'), array('configuration', 'fail2ban', 'PamGeneric_status'));
    $this->declareParameter('PostfixRbl_status', $this->createValidator()->memberOf('true','false'), array('configuration', 'fail2ban', 'PostfixRbl_status'));
    $this->declareParameter('Postfix_status', $this->createValidator()->memberOf('true','false'), array('configuration', 'fail2ban', 'Postfix_status'));
    $this->declareParameter('Recidive_status', $this->createValidator()->memberOf('true','false'), array('configuration', 'fail2ban', 'Recidive_status'));
    $this->declareParameter('Recidive_Perpetual', Validate::SERVICESTATUS, array('configuration', 'fail2ban', 'Recidive_Perpetual'));
    $this->declareParameter('Roundcube_status', $this->createValidator()->memberOf('true','false'), array('configuration', 'fail2ban', 'Roundcube_status'));
    $this->declareParameter('Sieve_status', $this->createValidator()->memberOf('true','false'), array('configuration', 'fail2ban', 'Sieve_status'));
    $this->declareParameter('SogoAuth_status', $this->createValidator()->memberOf('true','false'), array('configuration', 'fail2ban', 'SogoAuth_status'));
    $this->declareParameter('SshdDdos_status', $this->createValidator()->memberOf('true','false'), array('configuration', 'fail2ban', 'SshdDdos_status'));
    $this->declareParameter('Sshd_status', $this->createValidator()->memberOf('true','false'), array('configuration', 'fail2ban', 'Sshd_status'));
    $this->declareParameter('Urbackup_status', $this->createValidator()->memberOf('true','false'), array('configuration', 'fail2ban', 'Urbackup_status'));
    $this->declareParameter('Vsftpd_status', $this->createValidator()->memberOf('true','false'), array('configuration', 'fail2ban', 'Vsftpd_status'));
    $this->declareParameter('AsteriskAuth_status', $this->createValidator()->memberOf('true','false'), array('configuration', 'fail2ban', 'AsteriskAuth_status'));

        parent::initialize();
    }

        public static function splitLines($text)
    {
        return array_filter(preg_split("/[,;\s]+/", $text));
    }

    public function readIgnoreIP($dbList)
    {
        return implode("\r\n", explode(',' ,$dbList));
    }

    public function writeIgnoreIP($viewText)
    {
        return array(implode(',', self::splitLines($viewText)));
    }

    public function readCustomDestemail($dbList)
    {
        return implode("\r\n", explode(',' ,$dbList));
    }

    public function writeCustomDestemail($viewText)
    {
        return array(implode(',', self::splitLines($viewText)));
    }

    public function validate(\Nethgui\Controller\ValidationReportInterface $report)
    {
        parent::validate($report);
        $itemValidator = $this->getPlatform()->createValidator(\Nethgui\System\PlatformInterface::IP);

        foreach (self::splitLines($this->parameters['IgnoreIP']) as $v) {
            if ( ! $itemValidator->evaluate($v)) {
                $report->addValidationErrorMessage($this, 'AllowedIP', 'Not an IP', array($v));
                break;
            }
        }
        $emailValidator = $this->getPlatform()->createValidator(\Nethgui\System\PlatformInterface::EMAIL);

        foreach (self::splitLines($this->parameters['CustomDestemail']) as $v) {
            if ( ! $emailValidator->evaluate($v)) {
                $report->addValidationErrorMessage($this, 'CustomDestemail', 'Not an email', array($v));
                break;
            }
        }
    }

    public function prepareView(\Nethgui\View\ViewInterface $view)
    {
        parent::prepareView($view);
        $view['BanTimeDatasource'] = \Nethgui\Renderer\AbstractRenderer::hashToDatasource(array(
                '600' => $view->translate('${0} seconds', array(600)),
                '900' => $view->translate('${0} seconds', array(900)),
                '1800' => $view->translate('${0} seconds', array(1800)),
                '3600' => $view->translate('${0} hour', array(1)),
                '7200' => $view->translate('${0} hours', array(2)),
                '86400' => $view->translate('${0} day', array(1)),
                '172800' => $view->translate('${0} days', array(2)),
                '604800' => $view->translate('${0} week', array(1)),
                '1209600' => $view->translate('${0} weeks', array(2)),

        ));
        $view['FindTimeDatasource'] = \Nethgui\Renderer\AbstractRenderer::hashToDatasource(array(
                '600' => $view->translate('${0} seconds', array(600)),
                '900' => $view->translate('${0} seconds', array(900)),
                '1800' => $view->translate('${0} seconds', array(1800)),
                '3600' => $view->translate('${0} hour', array(1)),
                '7200' => $view->translate('${0} hours', array(2)),
                '86400' => $view->translate('${0} day', array(1)),
                '172800' => $view->translate('${0} days', array(2)),
                '604800' => $view->translate('${0} week', array(1)),
                '1209600' => $view->translate('${0} weeks', array(2)),

        ));

        $view['MaxRetryDatasource'] = \Nethgui\Renderer\AbstractRenderer::hashToDatasource(array(
                '1' => $view->translate('${0}', array(1)),
                '2' => $view->translate('${0}', array(2)),
                '3' => $view->translate('${0}', array(3)),
                '4' => $view->translate('${0}', array(4)),
                '5' => $view->translate('${0}', array(5)),
                '6' => $view->translate('${0}', array(6)),
                '7' => $view->translate('${0}', array(7)),
                '8' => $view->translate('${0}', array(8)),
                '9' => $view->translate('${0}', array(9)),
                '10' => $view->translate('${0}', array(10)),

        ));

        $view['LogLevelDatasource'] = \Nethgui\Renderer\AbstractRenderer::hashToDatasource(array(
                 'CRITICAL' => $view->translate('CRITICAL'),
                 'ERROR' => $view->translate('ERROR'),
                 'WARNING' => $view->translate('WARNING'),
                 'NOTICE' => $view->translate('NOTICE'),
                 'INFO' => $view->translate('INFO'),
                 'DEBUG' => $view->translate('DEBUG'),));

    }
    public function process()
    {
        parent::process();
        if ($this->getRequest()->hasParameter('RestartFail2ban')) {
            $this->getPlatform()->signalEvent('nethserver-fail2ban-save');
        }
    }
    public function onParametersSaved($changes)
    {
        $this->getPlatform()->signalEvent('nethserver-fail2ban-save &');
    }

}
