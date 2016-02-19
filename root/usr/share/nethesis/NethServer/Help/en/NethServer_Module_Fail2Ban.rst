
============
  Fail2ban
============


Fail2ban scans log files and bans IPs that show the malicious signs -- too many password failures, seeking for exploits, etc. Generally Fail2Ban is then used to update firewall rules to reject the IP addresses for a specified amount of time, although any arbitrary other action (e.g. sending an email) could also be configured. 

Enable the Service
    Configure the service to start and run.

Maximum find time (findtime)
    The moment that a given number of attempts is detected within a particular time.

Maximum retry number (maxretry)
    The maximum of attempts before to be banned.

Maximum ban time (bantime)
    Duration for IP to be banned for.

Allow bans on the LAN
    By default all local network are whitelisted, enable to ban IP from the LAN.

IP Whitelisting
    Ip listed here will be ignored by fail2ban (one IP per line).

Send email notifications
    Enable to send administrative emails.

Email administrators
    List of email addresses of administrators (one address per line).

List of Jails
    By default all jails are made to start once the service is installed. Here you can desactivate each jail.
