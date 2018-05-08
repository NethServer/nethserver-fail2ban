<?php
namespace NethServer\Module\Dashboard\SystemStatus;

/*
 * Copyright (C) 2018 Nethesis S.r.l.
 *
 * This script is part of NethServer.
 *
 * NethServer is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * NethServer is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with NethServer.  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * Retrieve the total number of jails of jails
 *
 * @author Stephane de Labrusse <stephdl@de-labrusse.fr>
 */
class Fail2ban extends \Nethgui\Controller\AbstractController
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
