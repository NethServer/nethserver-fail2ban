<?php

echo "<div class='dashboard-item'>";
echo $view->header()->setAttribute('template',$T('fail2banstatus_title'));

if ( ! file_exists ('/var/lib/nethserver/fail2ban/fail2ban.json')) {
    echo $T('no_fail2ban_stat_label');
    }
else {
    $totalCounter = 0;
    echo "<dl>";

    foreach ($view['status']['TotalBannedIP'] as $key => $value) {
        if (is_numeric ($value)){
            $totalCounter = $totalCounter + $value;
            echo '<dt>'."$key"."</dt><dd>"."$value"."</dd>";
        }
    }
    echo '<br/>'.'<dt>'.$T('TotalBannedIP_label').'</dt><dd>'."$totalCounter".'</dd>';

    echo "</dl>";
}
echo "</div>";
