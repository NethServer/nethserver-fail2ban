# nethserver-fail2ban

NethServer configuration of fail2ban

## read

### Input

Available query sections

- `configuration`
- `IPList`
- `statistic`

The input query format is:

```json
echo '{"action":"statistic"}'| /usr/libexec/nethserver/api/nethserver-fail2ban/read| jq

echo '{"action":"IPList"}'| /usr/libexec/nethserver/api/nethserver-fail2ban/read| jq

echo '{"action":"configuration"}'| /usr/libexec/nethserver/api/nethserver-fail2ban/read | jq
```

### Output

The output contains the queried sections. Possible keys are:

- `statistic`

All statistics relative of fail2ban: 

- Number of banned IP per jail
- All the currently active Jails in fail2ban (JailStatus)
- all the jail enabled in the esmith API (JailEnabled)

```json
{
  "TotalBannedIP": {
    "apache-noscript": 250,
    "sogo-auth": 3,
    "rspamd": 1,
    "apache-fakegooglebot": 8,
    "postfix-sasl-abuse": 5,
    "postfix": 77,
    "postfix-ddos": 1977,
    "recidive": 6305,
    "pam-generic": 29,
    "dovecot-nethserver": 32,
    "pam-generic-nethserver": 3,
    "dovecot": 405,
    "roundcube-auth": 1,
    "openvpn": 4404,
    "nextcloud-auth": 4,
    "sshd-ddos": 97,
    "sshd": 23345
  },
  "JailEnabled": 35,
  "JailStatus": [
    "apache-auth",
    "apache-badbots",
    "apache-botsearch",
    "apache-fakegooglebot",
    "apache-modsecurity",
    "apache-nohome",
    "apache-noscript",
    "apache-overflows",
    "apache-scan",
    "apache-shellshock",
    "httpd-admin",
    "pam-generic",
    "pam-generic-nethserver",
    "phpmyadmin",
    "postfix",
    "postfix-ddos",
    "postfix-sasl-abuse",
    "recidive",
    "rspamd",
    "sshd",
    "sshd-ddos"
  ]
}
```
- `configuration`
All available props to store in the fail2ban key of the esmith API
```json
{
  "configuration": {
    "props": {
      "NginxHttpAuth_status": "true",
      "BanTime": "1800",
      "ApacheAuth_status": "true",
      "ApacheBadbots_status": "true",
      "Roundcube_status": "true",
      "FindTime": "3600",
      "BanAction": "shorewall-nethserver",
      "MailJailState": "disabled",
      "Sshd_status": "true",
      "BanLocalNetwork": "disabled",
      "TimedOut": null,
      "OpenVpnAuth_status": "true",
      "ApacheFakegooglebot_status": "true",
      "MysqldAuth_status": "true",
      "ApacheBotsearch_status": "true",
      "EjabberAuth_status": "true",
      "SshdDdos_status": "true",
      "Dovecot_status": "true",
      "ApacheModsecurity_status": "true",
      "ApacheOverflows_status": "true",
      "NginxBotSearch_status": "true",
      "ApachePhpMyAdmin_status": "true",
      "HttpdAdmin_status": "true",
      "ApacheNohome_status": "true",
      "RecidiveBan": "static",
      "Postfix_status": "true",
      "Vsftpd_status": "true",
      "status": "enabled",
      "Sieve_status": "true",
      "ApacheShellshock_status": "true",
      "Nextcloud_status": "true",
      "PamGeneric_status": "true",
      "Urbackup_status": "true",
      "LogLevel": "INFO",
      "ApacheNoscript_status": "true",
      "Owncloud_status": "true",
      "IgnoreIP": "",
      "SogoAuth_status": "true",
      "Recidive_status": "true",
      "AsteriskAuth_status": "true",
      "DbPurgeage": null,
      "Mail": "enabled",
      "MaxRetry": "3",
      "CustomDestemail": [],
      "Webtop_status": "true",
      "Rspamd_status": "true",
      "PostfixSaslAbuse_status": "true",
      "ApacheScan_status": "true"
    }
  }
}
```

- `IPList`

IPList : all IP currently banned by Fail2ban 
JailStatus : All jails currently active in fail2ban 

```json
{
  "IPList": [
    {
      "ip": "13.74.41.52"
    },
    {
      "ip": "59.2.180.218"
    },
    {
      "ip": "13.67.50.214"
    },
    {
      "ip": "144.217.139.57"
    }
  ],
  "JailStatus": [
    "apache-auth",
    "apache-badbots",
    "apache-botsearch",
    "apache-fakegooglebot",
    "apache-modsecurity",
    "apache-nohome",
    "apache-noscript",
    "apache-overflows",
    "apache-scan",
    "apache-shellshock",
    "httpd-admin"
  ]
}

```

## validate

### Constraints

- Datatypes must be consistent (see the `validate` code)

### Input

Invocation example:

- `Jails`

```bash
echo '{"action":"jails","status":"enabled","ApacheAuth_status":"true","ApacheBadbots_status":"true","ApacheBotsearch_status":"true","ApacheFakegooglebot_status":"true","ApacheModsecurity_status":"true","ApacheNohome_status":"true","ApacheNoscript_status":"true","ApacheOverflows_status":"true","ApacheScan_status":"true","ApacheShellshock_status":"true","AsteriskAuth_status":"true","EjabberAuth_status":"true","MysqldAuth_status":"true","Dovecot_status":"true","Postfix_status":"true","PostfixSaslAbuse_status":"true","Sieve_status":"true","Vsftpd_status":"true","NginxHttpAuth_status":"true","NginxBotSearch_status":"true","HttpdAdmin_status":"true","PamGeneric_status":"true","Recidive_status":"true","Sshd_status":"true","SshdDdos_status":"true","OpenVpnAuth_status":"true","Nextcloud_status":"true","Owncloud_status":"true","ApachePhpMyAdmin_status":"true","Roundcube_status":"true","Rspamd_status":"true","SogoAuth_status":"true","Urbackup_status":"true","Webtop_status":"true"}' | /usr/bin/sudo /usr/libexec/nethserver/api/nethserver-fail2ban/validate | jq
```

- `configuration`

```bash
echo '{"action":"configuration","status":"enabled","Mail":"enabled","MailJailState":"disabled","BanLocalNetwork":"disabled","RecidiveBan":"static","CustomDestemail":[],"IgnoreIP":[],"LogLevel":"INFO","MaxRetry":"3","FindTime":"3600","BanTime":"1800"}' | /usr/bin/sudo /usr/libexec/nethserver/api/nethserver-fail2ban/validate | jq
```

- `unban`

Unban the specified IP

```bash
 echo '{"action":"unban","unBanIP":"103.110.185.18"}' | /usr/bin/sudo /usr/libexec/nethserver/api/nethserver-fail2ban/validate | jq
```

## update

See the `validate` input example: the format is the same.
