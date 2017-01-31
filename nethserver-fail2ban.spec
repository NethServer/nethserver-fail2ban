Summary: NethServer configuration for crontab
%define name nethserver-fail2ban
%define version 0.1.3
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
NethServer configuration for ddclient

%prep
%setup

%pre
#With NS7 < RC4 firewalld was not disabled
/usr/bin/systemctl stop firewalld
/usr/bin/systemctl disable firewalld

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

%dir %{_nseventsdir}/%{name}-update

%changelog
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
