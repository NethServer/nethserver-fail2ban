Summary: NethServer configuration for fail2ban
%define name nethserver-fail2ban
%define version 0.0.37
%define release 1
Name: %{name}
Version: %{version}
Release: %{release}%{?dist}
License: GPL
Source: %{name}-%{version}.tar.gz
BuildArch: noarch
URL: http://dev.nethserver.org/projects/nethforge/wiki/%{name}
BuildRequires: nethserver-devtools
Requires: fail2ban perl-Email-Valid
Conflicts: nethserver-release < 6.7
AutoReq: no

%description
NethServer configuration for fail2ban

%prep
%setup

%post
%preun

%build
%{makedocs}
perl createlinks

%install
rm -rf $RPM_BUILD_ROOT
(cd root   ; find . -depth -print | cpio -dump $RPM_BUILD_ROOT)

%{__mkdir_p} -p $RPM_BUILD_ROOT/var/log/
touch $RPM_BUILD_ROOT/var/log/fail2ban.log
%{__mkdir_p} -p $RPM_BUILD_ROOT/var/run/fail2ban

%{genfilelist} \
  --file /usr/bin/fail2ban-listban 'attr(0750,root,root)' \
  --file /usr/bin/fail2ban-unban 'attr(0750,root,root)' \
  --file /var/log/fail2ban.log 'attr(0600,root,root)' \
  --file /usr/libexec/nethserver/fail2ban-listban 'attr(0755,root,root)' \
  --file /usr/libexec/nethserver/shorewall-nethserver 'attr(0750,root,root)' \
$RPM_BUILD_ROOT > e-smith-%{version}-filelist

%clean
rm -rf $RPM_BUILD_ROOT

%files -f e-smith-%{version}-filelist
%defattr(-,root,root)
%doc COPYING

%changelog
* Sat Apr 07 2018 Stephane de Labrusse <stephdl@de-labrusse.fr> 0.0.37-1.ns6
- recidive jail delete the esmith key

* Wed Feb 28 2018  Stephane de Labrusse <stephdl@de-labrusse.fr> 0.0.36-1.ns6
- fail2ban database to fix the recidive unban issue
- fix typo for whitelisting and email address

* Mon Feb 26 2018 Stephane de Labrusse <stephdl@de-labrusse.fr> 0.0.30-1.ns6
- Back to shorewall

* Sun Feb 25 2018 Stephane de Labrusse <stephdl@de-labrusse.fr> 0.0.29-1.ns6
- Recidive jail can be perpetual

* Sun Feb 25 2018 Stephane de Labrusse <stephdl@de-labrusse.fr> 0.0.28-1.ns6
- Use Iptables for banAction instead of shorewall

* Fri Dec 8 2017 Stephane de Labrusse <stephdl@de-labrusse.fr> 0.0.27-1.ns6
- Button creation to restart fail2ban in the gui

* Sat Nov 11 2017 Stephane de Labrusse <stephdl@de-labrusse.fr> 0.0.26-1.ns6
- Validate the content of IgnoreIP & CustomDestemail in nethgui

* Sun Nov 05 2017 Stephane de Labrusse <stephdl@de-labrusse.fr> 0.0.25-1.ns6
- template of /etc/logrotate.d/fail2ban

* Thu Nov 02 2017 Stephane de Labrusse <stephdl@de-labrusse.fr> 0.0.24-1.ns6
- Revert the wildcard 0.0.24-1.ns6
- restart fail2ban on trusted network expand

* Thu Oct 19 2017 Stephane de Labrusse <stephdl@de-labrusse.fr> 0.0.23-1.ns6
- Restart fail2ban service on trusted-network
- back to the * wildcard
- reload the fail2ban configuration when logrotate

* Sun Sep 10 2017 Stephane de Labrusse <stephdl@de-labrusse.fr> 0.0.22-1.ns6
- Restart httpd service on trusted-network

* Sat Aug 19 2017 Stephane de Labrusse <stephdl@de-labrusse.fr> 0.0.21-1.ns6
- escape path file for sogo jail , code from phonon112358

* Fri Jul 28 2017 Stephane de Labrusse <stephdl@de-labrusse.fr> 0.0.20-1.ns6
- Start sogo jail if the log exists

* Sat Jul 15 2017 Stephane de Labrusse <stephdl@de-labrusse.fr> 0.0.19-1.ns6
- Custom MaxRetry property per jail (only by db)
- Remove MaxRetry recidive listed twice

* Thu Jun 29 2017 Stephane de Labrusse <stephdl@de-labrusse.fr> 0.0.17-1.ns6
- Add translation description

* Thu Jun 22 2017 Stephane de Labrusse <stephdl@de-labrusse.fr> 0.0.16-1.ns6
- Removed the wildcard on watched logs

* Thu Jun 22 2017 Stephane de Labrusse <stephdl@de-labrusse.fr> 0.0.15-1.ns6
- Test if the fail2ban log exists for recidive jail

* Sat Jun 17 2017 Stephane de Labrusse <stephdl@de-labrusse.fr> 0.0.14-1.ns6
- Stop to send notifications on start/stop jails
- UI tweaks
- Code from dnutan <dnutan@openaliasbox.org>

* Fri Jun 09 2017 Stephane de Labrusse <stephdl@de-labrusse.fr> 0.0.13-1.ns6
- Test if the dovecot log exists before to start the dovecot/sieve jails

* Wed Mar 29 2017 Stephane de Labrusse <stephdl@de-labrusse.fr> 0.0.11-1-ns6
- Template expansion on trusted-network

* Sun Mar 12 2017 Stephane de Labrusse <stephdl@de-labrusse.fr> 0.0.10-2-ns6
- Added OPENVPN jail

* Sun Mar 12 2017 Stephane de Labrusse <stephdl@de-labrusse.fr> 0.0.9-2-ns6
- GPL license

* Mon Feb 27 2017 Stephane de Labrusse <stephdl@de-labrusse.fr> - 0.0.9-1-ns6
- Added phpmyadmin jail

* Mon Feb 20 2017 Stephane de Labrusse <stephdl@de-labrusse.fr> - 0.0.8-1-ns6
- Handle the log rotation by wildcard
- Create /var/run/fail2ban

* Tue Mar 8 2016 Stephane de Labrusse <stephdl@de-labrusse.fr> - 0.0.7-ns6
- Owncloud Jail created

* Sat Mar 5 2016 Stephane de Labrusse <stephdl@de-labrusse.fr> - 0.0.6-ns6
- Fail2ban panel uses Tab now
- Blacklist tab created with Unban Input Box

* Sat Feb 20 2016 Stephane de Labrusse <stephdl@de-labrusse.fr> - 0.0.5-ns6
- New jail against bad authentication to httpd-admin
- Help page created
- Enhancement of the jail status  with expandable menu.

* Thu Jan 28 2016 Stephane de Labrusse <stephdl@de-labrusse.fr> - 0.0.4-ns6
- WebUI enhanced

* Wed Jan 27 2016 Stephane de Labrusse <stephdl@de-labrusse.fr> - 0.0.3-ns6
- WebUI designed

* Wed Dec 02 2015 Stephane de Labrusse <stephdl@de-labrusse.fr> - 0.0.2-ns6
- Initial release
