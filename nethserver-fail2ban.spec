Summary: NethServer configuration for crontab
%define name nethserver-fail2ban
%define version 0.0.13
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
NethServer configuration for ddclient

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
$RPM_BUILD_ROOT > e-smith-%{version}-filelist

%clean
rm -rf $RPM_BUILD_ROOT

%files -f e-smith-%{version}-filelist
%defattr(-,root,root)
%doc COPYING

%changelog
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
