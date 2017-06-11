Summary: NethServer configuration for fail2ban
%define name nethserver-fail2ban
%define version 0.1.14
%define release 1
Name: %{name}
Version: %{version}
Release: %{release}%{?dist}
License: GPL
Source: %{name}-%{version}.tar.gz
BuildArch: noarch
URL: http://dev.nethserver.org/projects/nethforge/wiki/%{name}
BuildRequires: nethserver-devtools
Requires: fail2ban fail2ban-shorewall perl-Email-Valid
#AutoReq: no

%description
NethServer configuration for fail2ban

%prep
%setup

%pre
#With NS7 < RC4 firewalld was not disabled
#with the stable version, it could be removed
/usr/bin/systemctl stop firewalld >/dev/null 2>&1
/usr/bin/systemctl disable firewalld >/dev/null 2>&1

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

%{genfilelist} %{buildroot} \
  --file /usr/bin/fail2ban-listban 'attr(0750,root,root)' \
  --file /usr/bin/fail2ban-unban 'attr(0750,root,root)' \
  --file /var/log/fail2ban.log 'attr(0600,root,root)' \
  --file /usr/libexec/nethserver/fail2ban-listban 'attr(0755,root,root)' \
$RPM_BUILD_ROOT > e-smith-%{version}-filelist

%clean
rm -rf $RPM_BUILD_ROOT

%files -f e-smith-%{version}-filelist
%defattr(-,root,root)
%doc COPYING
%dir %{_nseventsdir}/%{name}-update

%changelog
* Fri Jun 09 2017 Stephane de Labrusse <stephdl@de-labrusse.fr> 0.1.14-1.ns7
- Test if the dovecot log exists before to start the dovecot/sieve jails

* Wed May 03 2017 Stephane de Labrusse <stephdl@de-labrusse.fr> 0.1.13-1-ns7
- postfix-ddos jail updated

* Tue May 02 2017 Stephane de Labrusse <stephdl@de-labrusse.fr> 0.1.12-1-ns7
- Added postfix-ddos jail
- Added dovecot-nethserver Jail
- Added pam-generic-nethserver jail

* Mon May 01 2017 Stephane de Labrusse <stephdl@de-labrusse.fr> 0.1.11-1-ns7
- adjusted log file and backend in jail

* Mon May 01 2017 Stephane de Labrusse <stephdl@de-labrusse.fr> 0.1.10-1-ns7
- Added custom regex against dovecot and pam-generic
- pam-generic.local & dovecot.local

* Wed Mar 29 2017 Stephane de Labrusse <stephdl@de-labrusse.fr> 0.1.9-1-ns7
- Template expansion on trusted-network

* Sun Mar 12 2017 Stephane de Labrusse <stephdl@de-labrusse.fr> 0.1.8-2-ns7
- Added OPENVPN Jail
- Enforce the MaxRetry setting

* Sun Mar 12 2017 Stephane de Labrusse <stephdl@de-labrusse.fr> 0.1.7-2-ns7
- GPL license

* Mon Feb 27 2017 Stephane de Labrusse <stephdl@de-labrusse.fr> - 0.1.7-1-ns7
- added phpmyadmin jail

* Mon Feb 27 2017 Stephane de Labrusse <stephdl@de-labrusse.fr> - 0.1.6-1-ns7
- added wildcard in httpd log

* Fri Feb 24 2017 Stephane de Labrusse <stephdl@de-labrusse.fr> - 0.1.5-1-ns7
- Corrected the email recipient

* Mon Feb 20 2017 Stephane de Labrusse <stephdl@de-labrusse.fr> - 0.1.4-1-ns7
- Handle the log rotation by wildcard
- Create /var/run/fail2ban

* Tue Jan 31 2017 Stephane de Labrusse <stephdl@de-labrusse.fr> - 0.1.3-2-ns7
- Firewalld is stopped and disabled in %pre

* Wed Nov 23 2016 Stephane de Labrusse <stephdl@de-labrusse.fr> - 0.1.3-1-ns7
- urbackup jail is templated now

* Mon Nov 21 2016 Stephane de Labrusse <stephdl@de-labrusse.fr> - 0.1.2-1-ns7
- Urbackup Jail created

* Sun Nov 6 2016 Stephane de Labrusse <stephdl@de-labrusse.fr> - 0.1.1-1-ns7
- Nextcloud jail created

* Sun Nov 6 2016 Stephane de Labrusse <stephdl@de-labrusse.fr> - 0.1.0-1-ns7
- NS7 adaptation

* Tue Mar 8 2016 Stephane de Labrusse <stephdl@de-labrusse.fr> - 0.0.7-ns6
- Owncloud Jail created

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
