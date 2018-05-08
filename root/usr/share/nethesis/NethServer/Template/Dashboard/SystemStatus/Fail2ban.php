<?php

echo "<div class='dashboard-item'>";
echo $view->header()->setAttribute('template',$T('fail2banstatus_title'));

if ( ! file_exists ('/var/lib/nethserver/db/fail2ban.json')) {
    echo $T('no_fail2ban_stat_label');
    }
else {
    $totalCounter = 0;
    foreach ($view['status']['TotalBannedIP'] as $key => $value) {
        if (is_numeric ($value)){
            $totalCounter = $totalCounter + $value;
        }
    }
    echo '<br/>'.'<b>'.$T('TotalBannedIP_label').'</b>'." : $totalCounter";
}

