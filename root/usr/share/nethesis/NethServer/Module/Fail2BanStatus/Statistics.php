<?php
namespace NethServer\Module\Fail2BanStatus;

use Nethgui\System\PlatformInterface as Validate;

/**
 * Implement gui module for fail2ban service
 */

class  Statistics extends \Nethgui\Controller\AbstractController
{

    public $sortId = 10;

    private $status = "";

    private function readFail2banStatus()
    {
        return json_decode($this->getPlatform()->exec('/usr/libexec/nethserver/fail2ban-status')->getOutput(), true);
    }

    public function process()
    {
        $this->status = $this->readFail2banStatus();
    }

    public function prepareView(\Nethgui\View\ViewInterface $view)
    {
        if (!$this->status) {
            $this->status = $this->readFail2banStatus();
        }
        $view['status'] = $this->status;
    }
}
