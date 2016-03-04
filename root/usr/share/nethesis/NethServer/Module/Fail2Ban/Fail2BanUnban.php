<?php
namespace NethServer\Module\Fail2Ban;

use Nethgui\System\PlatformInterface as Validate;

/**
 * Implement gui module for fail2ban service
 */

class  Fail2BanUnban extends \Nethgui\Controller\AbstractController
{

    private $report;


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
    }

    public function prepareView(\Nethgui\View\ViewInterface $view)
    {
        parent::prepareView($view);
        if (!$this->report) {
            $this->report = $this->getReport();
        }
        $view['report'] = $this->report;
    }

    public function onParametersSaved($changes)
    {
        $this->getPlatform()->signalEvent('nethserver-fail2banUnBan-save@post-process');
    }

}
