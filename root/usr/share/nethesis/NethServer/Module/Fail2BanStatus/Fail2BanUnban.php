<?php
namespace NethServer\Module\Fail2BanStatus;

use Nethgui\System\PlatformInterface as Validate;

/**
 * Implement gui module for fail2ban service
 */

class  Fail2BanUnban extends \Nethgui\Controller\AbstractController
{

    private $report;
    private $bannedIP;

    private function getBannedIP()
    {
        return $this->getPlatform()->exec('/usr/bin/sudo /usr/libexec/nethserver/fail2ban-listip')->getOutput();
    }

    private function getReport()
    {
        return $this->getPlatform()->exec('/usr/bin/sudo /usr/libexec/nethserver/fail2ban-listban')->getOutput();
    }

    public function initialize()
    {
        $this->declareParameter('UnBanIP', Validate::IPv4_OR_EMPTY, array('configuration', 'fail2ban', 'UnBanIP'));
        parent::initialize();
    }

    public function bind(\Nethgui\Controller\RequestInterface $request)
    {
        parent::bind($request);
        $this->report = $this->getReport();
        $this->bannedIP = $this->getBannedIP();
    }

    public function prepareView(\Nethgui\View\ViewInterface $view)
    {
        parent::prepareView($view);
        if (!$this->report) {
            $this->report = $this->getReport();
        }
        $view['report'] = $this->report;

        if (!$this->bannedIP) {
            $this->bannedIP = $this->getBannedIP();
        }
        $view['bannedIP'] = $this->bannedIP;

    }

    public function onParametersSaved($changes)
    {
        $this->getPlatform()->signalEvent('nethserver-fail2banUnBan-save@post-process');
    }

}
