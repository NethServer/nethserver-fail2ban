========
Fail2ban
========

Fail2ban scans log files (e.g. /var/log/apache/error_log) and bans IPs that show the malicious signs – too many password failures, seeking for exploits, etc. Generally Fail2Ban is then used to update firewall rules to reject the IP addresses for a specified amount of time, although any arbitrary other action (e.g. sending an email) could also be configured. Out of the box Fail2Ban comes with filters for various services (Apache, Dovecot, Ssh, Postfix, etc).

Fail2Ban is able to reduce the rate of incorrect authentications attempts however, it cannot eliminate the risk that weak authentication presents. To improve the security, open the access to service only for secure networks using the firewall.
Installation

E-smith Database
================

Fail2ban settings are  stored in the configuration e-smith database, all options are exposed to the end user, except the MAXRetry values for each jail. See below how to activate it

You can set custom values for the MaxRetry property of each jail, once removed you go back to the default MaxRetry value. ::

    config show fail2ban |grep -i '_maxretry'

    Apache_MaxRetry=
    Dovecot_MaxRetry=
    Ejabberd_MaxRetry=
    HttpdAdmin_MaxRetry=
    Mysqld_MaxRetry=
    Nextcloud_MaxRetry=
    Nginx_MaxRetry=
    OpenVpn_MaxRetry=
    Owncloud_MaxRetry=
    PamGeneric_MaxRetry=
    Postfix_MaxRetry=
    Recidive_MaxRetry=
    Roundcube_MaxRetry=
    Sieve_MaxRetry=
    Sogo_MaxRetry=
    Sshd_MaxRetry=
    Urbackup_MaxRetry=
    Vsftpd_MaxRetry=

Only available by a db command, to set it: ::

    config setprop fail2ban Recidive_MaxRetry 6
    signal-event nethserver-fail2ban-save

If you delete the property you go back to the default MaxRetry value: ::

    config setprop fail2ban Recidive_MaxRetry ''
    signal-event nethserver-fail2ban-save


Database for IP
===============

The IPs are stored in a sqlite database (upstream configuration) and a esmith database to give a real permanent ban for the recidive jail.
you can see the ban database by ::

    db fail2ban show

A ban counter is made, an IP cannot be unbanned if the counter is not equal to zero (a jail is still active), when the last jail is unbanned, the esmith key is removed of the database. The date of the last ban/unban is stored in the database for debugging purpose.

To find recursive informations on an IP, fail2ban actions, failed attempts, grep could be used: ::

    grep -srni 'xxx\.xxx\.xxx\.xxx' /var/log
