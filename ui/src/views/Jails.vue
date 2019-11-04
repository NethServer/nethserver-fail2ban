<template>
  <div>
    <h2>{{$t('jails.title')}}</h2>
    <div v-if="!view.isLoaded" class="spinner spinner-lg"></div>
    <div v-if="view.isLoaded">

      <h3>{{$t('jails.configuration')}}</h3>
      <form class="form-horizontal" v-on:submit.prevent="saveSettings('status')">
        <div :class="['form-group', errors.status.hasError ? 'has-error' : '']">
          <label
            class="col-sm-2 control-label"
            for="textInput-modal-markup"
          >{{$t('jails.status')}}</label>
          <div class="col-sm-5">
            <toggle-button
              class="min-toggle"
              :width="40"
              :height="20"
              :color="{checked: '#0088ce', unchecked: '#bbbbbb'}"
              :value="configuration.status"
              :sync="true"
              @change="toggleFail2banStatus()"
            />
            <span
              v-if="errors.status.hasError"
              class="help-block"
            >{{errors.status.message}}</span>
          </div>
        </div>
        <!-- apache jails -->

        <legend v-if="configuration.status" class="fields-section-header-pf" aria-expanded="true">
            <span
            :class="['fa fa-angle-right field-section-toggle-pf', view.apache ? 'fa-angle-down' : '']"
            ></span>
            <a
            class="field-section-toggle-pf"
            @click="toggleJailMenu('apache')"
            >{{$t('jails.apache_jails')}}</a>
        </legend>

        <div
          v-if="configuration.status && view.apache"
          :class="['form-group', errors.ApacheAuth_status.hasError ? 'has-error' : '']"
          >
          <label
            class="col-sm-2 control-label"
            for="textInput-modal-markup"
          >Apache-auth</label>
          <div class="col-sm-5">
            <input type="checkbox" v-model="configuration.ApacheAuth_status" class="form-control">
            <span
              v-if="errors.ApacheAuth_status.hasError"
              class="help-block"
            >{{errors.ApacheAuth_status.message}}</span>
          </div>
        </div>

        <div
          v-if="configuration.status && view.apache"
          :class="['form-group', errors.ApacheBadbots_status.hasError ? 'has-error' : '']"
          >
          <label
            class="col-sm-2 control-label"
            for="textInput-modal-markup"
          >Apache-badbots</label>
          <div class="col-sm-5">
            <input type="checkbox" v-model="configuration.ApacheBadbots_status" class="form-control">
            <span
              v-if="errors.ApacheBadbots_status.hasError"
              class="help-block"
            >{{errors.ApacheBadbots_status.message}}</span>
          </div>
        </div>

        <div
          v-if="configuration.status && view.apache"
          :class="['form-group', errors.ApacheBotsearch_status.hasError ? 'has-error' : '']"
          >
          <label
            class="col-sm-2 control-label"
            for="textInput-modal-markup"
          >Apache-botsearch</label>
          <div class="col-sm-5">
            <input type="checkbox" v-model="configuration.ApacheBotsearch_status" class="form-control">
            <span
              v-if="errors.ApacheBotsearch_status.hasError"
              class="help-block"
            >{{errors.ApacheBotsearch_status.message}}</span>
          </div>
        </div>

        <div
          v-if="configuration.status && view.apache"
          :class="['form-group', errors.ApacheFakegooglebot_status.hasError ? 'has-error' : '']"
          >
          <label
            class="col-sm-2 control-label"
            for="textInput-modal-markup"
          >Apache-fakegooglebot</label>
          <div class="col-sm-5">
            <input type="checkbox" v-model="configuration.ApacheFakegooglebot_status" class="form-control">
            <span
              v-if="errors.ApacheFakegooglebot_status.hasError"
              class="help-block"
            >{{errors.ApacheFakegooglebot_status.message}}</span>
          </div>
        </div>

        <div
          v-if="configuration.status && view.apache"
          :class="['form-group', errors.ApacheModsecurity_status.hasError ? 'has-error' : '']"
          >
          <label
            class="col-sm-2 control-label"
            for="textInput-modal-markup"
          >Apache-modsecurity</label>
          <div class="col-sm-5">
            <input type="checkbox" v-model="configuration.ApacheModsecurity_status" class="form-control">
            <span
              v-if="errors.ApacheModsecurity_status.hasError"
              class="help-block"
            >{{errors.ApacheModsecurity_status.message}}</span>
          </div>
        </div>

        <div
          v-if="configuration.status && view.apache"
          :class="['form-group', errors.ApacheNohome_status.hasError ? 'has-error' : '']"
          >
          <label
            class="col-sm-2 control-label"
            for="textInput-modal-markup"
          >Apache-nohome</label>
          <div class="col-sm-5">
            <input type="checkbox" v-model="configuration.ApacheNohome_status" class="form-control">
            <span
              v-if="errors.ApacheNohome_status.hasError"
              class="help-block"
            >{{errors.ApacheNohome_status.message}}</span>
          </div>
        </div>

        <div
          v-if="configuration.status && view.apache"
          :class="['form-group', errors.ApacheNoscript_status.hasError ? 'has-error' : '']"
          >
          <label
            class="col-sm-2 control-label"
            for="textInput-modal-markup"
          >Apcache-noscript</label>
          <div class="col-sm-5">
            <input type="checkbox" v-model="configuration.ApacheNoscript_status" class="form-control">
            <span
              v-if="errors.ApacheNoscript_status.hasError"
              class="help-block"
            >{{errors.ApacheNoscript_status.message}}</span>
          </div>
        </div>

        <div
          v-if="configuration.status && view.apache"
          :class="['form-group', errors.ApacheOverflows_status.hasError ? 'has-error' : '']"
          >
          <label
            class="col-sm-2 control-label"
            for="textInput-modal-markup"
          >Apache-overflows</label>
          <div class="col-sm-5">
            <input type="checkbox" v-model="configuration.ApacheOverflows_status" class="form-control">
            <span
              v-if="errors.ApacheOverflows_status.hasError"
              class="help-block"
            >{{errors.ApacheOverflows_status.message}}</span>
          </div>
        </div>

        <div
          v-if="configuration.status && view.apache"
          :class="['form-group', errors.ApacheScan_status.hasError ? 'has-error' : '']"
          >
          <label
            class="col-sm-2 control-label"
            for="textInput-modal-markup"
          >Apache-scan</label>
          <div class="col-sm-5">
            <input type="checkbox" v-model="configuration.ApacheScan_status" class="form-control">
            <span
              v-if="errors.ApacheScan_status.hasError"
              class="help-block"
            >{{errors.ApacheScan_status.message}}</span>
          </div>
        </div>

        <div
          v-if="configuration.status && view.apache"
          :class="['form-group', errors.ApacheShellshock_status.hasError ? 'has-error' : '']"
          >
          <label
            class="col-sm-2 control-label"
            for="textInput-modal-markup"
          >Apache-shellshock</label>
          <div class="col-sm-5">
            <input type="checkbox" v-model="configuration.ApacheShellshock_status" class="form-control">
            <span
              v-if="errors.ApacheShellshock_status.hasError"
              class="help-block"
            >{{errors.ApacheShellshock_status.message}}</span>
          </div>
        </div>
        <!-- communication_jails -->
        <legend v-if="configuration.status" class="fields-section-header-pf" aria-expanded="true">
            <span
            :class="['fa fa-angle-right field-section-toggle-pf', view.communication ? 'fa-angle-down' : '']"
            ></span>
            <a
            class="field-section-toggle-pf"
            @click="toggleJailMenu('communication')"
            >{{$t('jails.communication_jails')}}</a>
        </legend>

        <div
          v-if="configuration.status && view.communication"
          :class="['form-group', errors.AsteriskAuth_status.hasError ? 'has-error' : '']"
          >
          <label
            class="col-sm-2 control-label"
            for="textInput-modal-markup"
          >Asterisk-auth</label>
          <div class="col-sm-5">
            <input type="checkbox" v-model="configuration.AsteriskAuth_status" class="form-control">
            <span
              v-if="errors.AsteriskAuth_status.hasError"
              class="help-block"
            >{{errors.AsteriskAuth_status.message}}</span>
          </div>
        </div>

        <div
          v-if="configuration.status && view.communication"
          :class="['form-group', errors.EjabberAuth_status.hasError ? 'has-error' : '']"
          >
          <label
            class="col-sm-2 control-label"
            for="textInput-modal-markup"
          >Ejjaber-auth</label>
          <div class="col-sm-5">
            <input type="checkbox" v-model="configuration.EjabberAuth_status" class="form-control">
            <span
              v-if="errors.EjabberAuth_status.hasError"
              class="help-block"
            >{{errors.EjabberAuth_status.message}}</span>
          </div>
        </div>

        <!-- database_jails -->
        <legend v-if="configuration.status" class="fields-section-header-pf" aria-expanded="true">
            <span
            :class="['fa fa-angle-right field-section-toggle-pf', view.database ? 'fa-angle-down' : '']"
            ></span>
            <a
            class="field-section-toggle-pf"
            @click="toggleJailMenu('database')"
            >{{$t('jails.database_jails')}}</a>
        </legend>

        <div
          v-if="configuration.status && view.database"
          :class="['form-group', errors.MysqldAuth_status.hasError ? 'has-error' : '']"
          >
          <label
            class="col-sm-2 control-label"
            for="textInput-modal-markup"
          >Mysqld-auth</label>
          <div class="col-sm-5">
            <input type="checkbox" v-model="configuration.MysqldAuth_status" class="form-control">
            <span
              v-if="errors.MysqldAuth_status.hasError"
              class="help-block"
            >{{errors.MysqldAuth_status.message}}</span>
          </div>
        </div>

        <!-- email_jails -->
        <legend v-if="configuration.status" class="fields-section-header-pf" aria-expanded="true">
            <span
            :class="['fa fa-angle-right field-section-toggle-pf', view.email ? 'fa-angle-down' : '']"
            ></span>
            <a
            class="field-section-toggle-pf"
            @click="toggleJailMenu('email')"
            >{{$t('jails.email_jails')}}</a>
        </legend>

        <div
          v-if="configuration.status && view.email"
          :class="['form-group', errors.Dovecot_status.hasError ? 'has-error' : '']"
          >
          <label
            class="col-sm-2 control-label"
            for="textInput-modal-markup"
          >Dovecot</label>
          <div class="col-sm-5">
            <input type="checkbox" v-model="configuration.Dovecot_status" class="form-control">
            <span
              v-if="errors.Dovecot_status.hasError"
              class="help-block"
            >{{errors.Dovecot_status.message}}</span>
          </div>
        </div>

        <div
          v-if="configuration.status && view.email"
          :class="['form-group', errors.PostfixRbl_status.hasError ? 'has-error' : '']"
          >
          <label
            class="col-sm-2 control-label"
            for="textInput-modal-markup"
          >Postfix-rbl</label>
          <div class="col-sm-5">
            <input type="checkbox" v-model="configuration.PostfixRbl_status" class="form-control">
            <span
              v-if="errors.PostfixRbl_status.hasError"
              class="help-block"
            >{{errors.PostfixRbl_status.message}}</span>
          </div>
        </div>

        <div
          v-if="configuration.status && view.email"
          :class="['form-group', errors.Postfix_status.hasError ? 'has-error' : '']"
          >
          <label
            class="col-sm-2 control-label"
            for="textInput-modal-markup"
          >Postfix</label>
          <div class="col-sm-5">
            <input type="checkbox" v-model="configuration.Postfix_status" class="form-control">
            <span
              v-if="errors.Postfix_status.hasError"
              class="help-block"
            >{{errors.Postfix_status.message}}</span>
          </div>
        </div>

        <div
          v-if="configuration.status && view.email"
          :class="['form-group', errors.PostfixSaslAbuse_status.hasError ? 'has-error' : '']"
          >
          <label
            class="col-sm-2 control-label"
            for="textInput-modal-markup"
          >Postfix-sasl-abuse</label>
          <div class="col-sm-5">
            <input type="checkbox" v-model="configuration.PostfixSaslAbuse_status" class="form-control">
            <span
              v-if="errors.PostfixSaslAbuse_status.hasError"
              class="help-block"
            >{{errors.PostfixSaslAbuse_status.message}}</span>
          </div>
        </div>

        <div
          v-if="configuration.status && view.email"
          :class="['form-group', errors.Sieve_status.hasError ? 'has-error' : '']"
          >
          <label
            class="col-sm-2 control-label"
            for="textInput-modal-markup"
          >Sieve</label>
          <div class="col-sm-5">
            <input type="checkbox" v-model="configuration.Sieve_status" class="form-control">
            <span
              v-if="errors.Sieve_status.hasError"
              class="help-block"
            >{{errors.Sieve_status.message}}</span>
          </div>
        </div>

        <!-- ftp_jails -->
        <legend v-if="configuration.status" class="fields-section-header-pf" aria-expanded="true">
            <span
            :class="['fa fa-angle-right field-section-toggle-pf', view.ftp ? 'fa-angle-down' : '']"
            ></span>
            <a
            class="field-section-toggle-pf"
            @click="toggleJailMenu('ftp')"
            >{{$t('jails.ftp_jails')}}</a>
        </legend>

        <div
          v-if="configuration.status && view.ftp"
          :class="['form-group', errors.Sieve_status.hasError ? 'has-error' : '']"
          >
          <label
            class="col-sm-2 control-label"
            for="textInput-modal-markup"
          >Vsftpd</label>
          <div class="col-sm-5">
            <input type="checkbox" v-model="configuration.Vsftpd_status" class="form-control">
            <span
              v-if="errors.Vsftpd_status.hasError"
              class="help-block"
            >{{errors.Vsftpd_status.message}}</span>
          </div>
        </div>

        <!-- nginx_jails -->
        <legend v-if="configuration.status" class="fields-section-header-pf" aria-expanded="true">
            <span
            :class="['fa fa-angle-right field-section-toggle-pf', view.nginx ? 'fa-angle-down' : '']"
            ></span>
            <a
            class="field-section-toggle-pf"
            @click="toggleJailMenu('nginx')"
            >{{$t('jails.nginx_jails')}}</a>
        </legend>

        <div
          v-if="configuration.status && view.nginx"
          :class="['form-group', errors.NginxHttpAuth_status.hasError ? 'has-error' : '']"
          >
          <label
            class="col-sm-2 control-label"
            for="textInput-modal-markup"
          >Nginx-http-auth</label>
          <div class="col-sm-5">
            <input type="checkbox" v-model="configuration.NginxHttpAuth_status" class="form-control">
            <span
              v-if="errors.NginxHttpAuth_status.hasError"
              class="help-block"
            >{{errors.NginxHttpAuth_status.message}}</span>
          </div>
        </div>

        <div
          v-if="configuration.status && view.nginx"
          :class="['form-group', errors.NginxBotSearch_status.hasError ? 'has-error' : '']"
          >
          <label
            class="col-sm-2 control-label"
            for="textInput-modal-markup"
          >Nginx-botsearch</label>
          <div class="col-sm-5">
            <input type="checkbox" v-model="configuration.NginxBotSearch_status" class="form-control">
            <span
              v-if="errors.NginxBotSearch_status.hasError"
              class="help-block"
            >{{errors.NginxBotSearch_status.message}}</span>
          </div>
        </div>

        <!-- security_jails -->
        <legend v-if="configuration.status" class="fields-section-header-pf" aria-expanded="true">
            <span
            :class="['fa fa-angle-right field-section-toggle-pf', view.security ? 'fa-angle-down' : '']"
            ></span>
            <a
            class="field-section-toggle-pf"
            @click="toggleJailMenu('security')"
            >{{$t('jails.security_jails')}}</a>
        </legend>

        <div
          v-if="configuration.status && view.security"
          :class="['form-group', errors.HttpdAdmin_status.hasError ? 'has-error' : '']"
          >
          <label
            class="col-sm-2 control-label"
            for="textInput-modal-markup"
          >Httpd-admin</label>
          <div class="col-sm-5">
            <input type="checkbox" v-model="configuration.HttpdAdmin_status" class="form-control">
            <span
              v-if="errors.HttpdAdmin_status.hasError"
              class="help-block"
            >{{errors.HttpdAdmin_status.message}}</span>
          </div>
        </div>

        <div
          v-if="configuration.status && view.security"
          :class="['form-group', errors.PamGeneric_status.hasError ? 'has-error' : '']"
          >
          <label
            class="col-sm-2 control-label"
            for="textInput-modal-markup"
          >Pam-generic</label>
          <div class="col-sm-5">
            <input type="checkbox" v-model="configuration.PamGeneric_status" class="form-control">
            <span
              v-if="errors.PamGeneric_status.hasError"
              class="help-block"
            >{{errors.PamGeneric_status.message}}</span>
          </div>
        </div>

        <div
          v-if="configuration.status && view.security"
          :class="['form-group', errors.Recidive_status.hasError ? 'has-error' : '']"
          >
          <label
            class="col-sm-2 control-label"
            for="textInput-modal-markup"
          >Recidive</label>
          <div class="col-sm-5">
            <input type="checkbox" v-model="configuration.Recidive_status" class="form-control">
            <span
              v-if="errors.Recidive_status.hasError"
              class="help-block"
            >{{errors.Recidive_status.message}}</span>
          </div>
        </div>

        <!-- ssh_jails -->
        <legend v-if="configuration.status" class="fields-section-header-pf" aria-expanded="true">
            <span
            :class="['fa fa-angle-right field-section-toggle-pf', view.ssh ? 'fa-angle-down' : '']"
            ></span>
            <a
            class="field-section-toggle-pf"
            @click="toggleJailMenu('ssh')"
            >{{$t('jails.ssh_jails')}}</a>
        </legend>

        <div
          v-if="configuration.status && view.ssh"
          :class="['form-group', errors.Sshd_status.hasError ? 'has-error' : '']"
          >
          <label
            class="col-sm-2 control-label"
            for="textInput-modal-markup"
          >Sshd</label>
          <div class="col-sm-5">
            <input type="checkbox" v-model="configuration.Sshd_status" class="form-control">
            <span
              v-if="errors.Sshd_status.hasError"
              class="help-block"
            >{{errors.Sshd_status.message}}</span>
          </div>
        </div>

        <div
          v-if="configuration.status && view.ssh"
          :class="['form-group', errors.SshdDdos_status.hasError ? 'has-error' : '']"
          >
          <label
            class="col-sm-2 control-label"
            for="textInput-modal-markup"
          >Sshd-ddos</label>
          <div class="col-sm-5">
            <input type="checkbox" v-model="configuration.SshdDdos_status" class="form-control">
            <span
              v-if="errors.SshdDdos_status.hasError"
              class="help-block"
            >{{errors.SshdDdos_status.message}}</span>
          </div>
        </div>

        <!-- vpn_jails -->
        <legend v-if="configuration.status" class="fields-section-header-pf" aria-expanded="true">
            <span
            :class="['fa fa-angle-right field-section-toggle-pf', view.vpn ? 'fa-angle-down' : '']"
            ></span>
            <a
            class="field-section-toggle-pf"
            @click="toggleJailMenu('vpn')"
            >{{$t('jails.vpn_jails')}}</a>
        </legend>

        <div
          v-if="configuration.status && view.vpn"
          :class="['form-group', errors.OpenVpnAuth_status.hasError ? 'has-error' : '']"
          >
          <label
            class="col-sm-2 control-label"
            for="textInput-modal-markup"
          >Openvpn</label>
          <div class="col-sm-5">
            <input type="checkbox" v-model="configuration.OpenVpnAuth_status" class="form-control">
            <span
              v-if="errors.OpenVpnAuth_status.hasError"
              class="help-block"
            >{{errors.OpenVpnAuth_status.message}}</span>
          </div>
        </div>

        <!-- webApps_jails -->
        <legend v-if="configuration.status" class="fields-section-header-pf" aria-expanded="true">
            <span
            :class="['fa fa-angle-right field-section-toggle-pf', view.webApps ? 'fa-angle-down' : '']"
            ></span>
            <a
            class="field-section-toggle-pf"
            @click="toggleJailMenu('webApps')"
            >{{$t('jails.webApps_jails')}}</a>
        </legend>

        <div
          v-if="configuration.status && view.webApps"
          :class="['form-group', errors.Nextcloud_status.hasError ? 'has-error' : '']"
          >
          <label
            class="col-sm-2 control-label"
            for="textInput-modal-markup"
          >Nextcloud</label>
          <div class="col-sm-5">
            <input type="checkbox" v-model="configuration.Nextcloud_status" class="form-control">
            <span
              v-if="errors.Nextcloud_status.hasError"
              class="help-block"
            >{{errors.Nextcloud_status.message}}</span>
          </div>
        </div>

        <div
          v-if="configuration.status && view.webApps"
          :class="['form-group', errors.Owncloud_status.hasError ? 'has-error' : '']"
          >
          <label
            class="col-sm-2 control-label"
            for="textInput-modal-markup"
          >Owncloud</label>
          <div class="col-sm-5">
            <input type="checkbox" v-model="configuration.Owncloud_status" class="form-control">
            <span
              v-if="errors.Owncloud_status.hasError"
              class="help-block"
            >{{errors.Owncloud_status.message}}</span>
          </div>
        </div>

        <div
          v-if="configuration.status && view.webApps"
          :class="['form-group', errors.ApachePhpMyAdmin_status.hasError ? 'has-error' : '']"
          >
          <label
            class="col-sm-2 control-label"
            for="textInput-modal-markup"
          >phpMyAdmin</label>
          <div class="col-sm-5">
            <input type="checkbox" v-model="configuration.ApachePhpMyAdmin_status" class="form-control">
            <span
              v-if="errors.ApachePhpMyAdmin_status.hasError"
              class="help-block"
            >{{errors.ApachePhpMyAdmin_status.message}}</span>
          </div>
        </div>

        <div
          v-if="configuration.status && view.webApps"
          :class="['form-group', errors.Roundcube_status.hasError ? 'has-error' : '']"
          >
          <label
            class="col-sm-2 control-label"
            for="textInput-modal-markup"
          >Roundcubemail</label>
          <div class="col-sm-5">
            <input type="checkbox" v-model="configuration.Roundcube_status" class="form-control">
            <span
              v-if="errors.Roundcube_status.hasError"
              class="help-block"
            >{{errors.Roundcube_status.message}}</span>
          </div>
        </div>

        <div
          v-if="configuration.status && view.webApps"
          :class="['form-group', errors.Rspamd_status.hasError ? 'has-error' : '']"
          >
          <label
            class="col-sm-2 control-label"
            for="textInput-modal-markup"
          >Rspamd</label>
          <div class="col-sm-5">
            <input type="checkbox" v-model="configuration.Rspamd_status" class="form-control">
            <span
              v-if="errors.Rspamd_status.hasError"
              class="help-block"
            >{{errors.Rspamd_status.message}}</span>
          </div>
        </div>

        <div
          v-if="configuration.status && view.webApps"
          :class="['form-group', errors.SogoAuth_status.hasError ? 'has-error' : '']"
          >
          <label
            class="col-sm-2 control-label"
            for="textInput-modal-markup"
          >SOGo</label>
          <div class="col-sm-5">
            <input type="checkbox" v-model="configuration.SogoAuth_status" class="form-control">
            <span
              v-if="errors.SogoAuth_status.hasError"
              class="help-block"
            >{{errors.SogoAuth_status.message}}</span>
          </div>
        </div>

        <div
          v-if="configuration.status && view.webApps"
          :class="['form-group', errors.Urbackup_status.hasError ? 'has-error' : '']"
          >
          <label
            class="col-sm-2 control-label"
            for="textInput-modal-markup"
          >Urbackup</label>
          <div class="col-sm-5">
            <input type="checkbox" v-model="configuration.Urbackup_status" class="form-control">
            <span
              v-if="errors.Urbackup_status.hasError"
              class="help-block"
            >{{errors.Urbackup_status.message}}</span>
          </div>
        </div>

        <div
          v-if="configuration.status && view.webApps"
          :class="['form-group', errors.Webtop_status.hasError ? 'has-error' : '']"
          >
          <label
            class="col-sm-2 control-label"
            for="textInput-modal-markup"
          >Webtop</label>
          <div class="col-sm-5">
            <input type="checkbox" v-model="configuration.Webtop_status" class="form-control">
            <span
              v-if="errors.Webtop_status.hasError"
              class="help-block"
            >{{errors.Webtop_status.message}}</span>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label" for="textInput-modal-markup">
            <div v-if="loaders" class="spinner spinner-sm form-spinner-loader adjust-top-loader"></div>
          </label>
          <div class="col-sm-5">
            <button class="btn btn-primary" type="submit">{{$t('save')}}</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>

<script>

export default {
  name: "Jails",
  mounted() {
    this.getSettings();

  },
  data() {
    return {
      view: {
        isLoaded: false,
        apache: false,
        communication: false,
        database: false,
        email: false,
        ftp:false,
        nginx:false,
        security: false,
        ssh: false,
        vpn:false,
        webApps: false
      },
      configuration: {
              status: true,
              ApacheAuth_status: "true",
              ApacheBadbots_status: "true",
              ApacheBotsearch_status: "true",
              ApacheFakegooglebot_status: "true",
              ApacheModsecurity_status: "true",
              ApacheNohome_status: "true",
              ApacheNoscript_status: "true",
              ApacheOverflows_status: "true",
              ApacheScan_status: "true",
              ApacheShellshock_status: "true",
              AsteriskAuth_status: "true",
              EjabberAuth_status: "true",
              MysqldAuth_status: "true",
              Dovecot_status: "true",
              PostfixRbl_status: "true",
              Postfix_status: "true",
              PostfixSaslAbuse_status: "true",
              Sieve_status: "true",
              Vsftpd_status: "true",
              NginxHttpAuth_status: "true",
              NginxBotSearch_status: "true",
              HttpdAdmin_status: "true",
              PamGeneric_status:"true",
              Recidive_status: "true",
              Sshd_status:"true",
              SshdDdos_status:"true",
              OpenVpnAuth_status:"true",
              Nextcloud_status: "true",
              Owncloud_status: "true",
              ApachePhpMyAdmin_status: "true",
              Roundcube_status: "true",
              Rspamd_status: "true",
              SogoAuth_status: "true",
              Urbackup_status: "true",
              Webtop_status: "true"
      },
      loaders: false,
      errors: this.initErrors()
    };
  },
  methods: {
    initErrors() {
      return {
      status: {
        hasError: false,
        message: ""
      },
      ApacheAuth_status: {
        hasError: false,
        message: ""
      },
      ApacheBadbots_status: {
        hasError: false,
        message: ""
      },
      ApacheBotsearch_status: {
        hasError: false,
        message: ""
      },
      ApacheFakegooglebot_status: {
        hasError: false,
        message: ""
      },
      ApacheModsecurity_status: {
        hasError: false,
        message: ""
      },
      ApacheNohome_status: {
        hasError: false,
        message: ""
      },
      ApacheNoscript_status: {
        hasError: false,
        message: ""
      },
      ApacheOverflows_status: {
        hasError: false,
        message: ""
      },
      ApacheScan_status: {
        hasError: false,
        message: ""
      },
      ApacheShellshock_status: {
        hasError: false,
        message: ""
      },
      AsteriskAuth_status: {
        hasError: false,
        message: ""
      },
      EjabberAuth_status: {
        hasError: false,
        message: ""
      },
      MysqldAuth_status: {
        hasError: false,
        message: ""
      },
      Dovecot_status: {
        hasError: false,
        message: ""
      },
      PostfixRbl_status: {
        hasError: false,
        message: ""
      },
      Postfix_status: {
        hasError: false,
        message: ""
      },
      PostfixSaslAbuse_status: {
        hasError: false,
        message: ""
      },
      Sieve_status: {
        hasError: false,
        message: ""
      },
      Vsftpd_status: {
        hasError: false,
        message: ""
      },
      NginxHttpAuth_status: {
        hasError: false,
        message: ""
      },
      NginxBotSearch_status: {
        hasError: false,
        message: ""
      },
      HttpdAdmin_status: {
        hasError: false,
        message: ""
      },
      PamGeneric_status: {
        hasError: false,
        message: ""
      },
      Recidive_status: {
        hasError: false,
        message: ""
      },
      Sshd_status: {
        hasError: false,
        message: ""
      },
      SshdDdos_status: {
        hasError: false,
        message: ""
      },
      OpenVpnAuth_status: {
        hasError: false,
        message: ""
      },
      Nextcloud_status: {
        hasError: false,
        message: ""
      },
      Owncloud_status: {
        hasError: false,
        message: ""
      },
      ApachePhpMyAdmin_status: {
        hasError: false,
        message: ""
      },
      Roundcube_status: {
        hasError: false,
        message: ""
      },
      Rspamd_status: {
        hasError: false,
        message: ""
      },
      SogoAuth_status: {
        hasError: false,
        message: ""
      },
      Urbackup_status: {
        hasError: false,
        message: ""
      },
      Webtop_status: {
        hasError: false,
        message: ""
      }
      };
    },
    toggleJailMenu(jail) {
      this.view[jail] = !this.view[jail];
      this.$forceUpdate();
    },
    getSettings() {
      var context = this;

      context.view.isLoaded = false;
      nethserver.exec(
        ["nethserver-fail2ban/read"],
        {
          action: "configuration"
        },
        null,
        function(success) {
          try {
            success = JSON.parse(success);
          } catch (e) {
            console.error(e);
          }
          context.configuration.status = success.configuration.props.status == "enabled";
          context.configuration.ApacheAuth_status = success.configuration.props.ApacheAuth_status == "true";
          context.configuration.ApacheBadbots_status = success.configuration.props.ApacheBadbots_status == "true";
          context.configuration.ApacheBotsearch_status = success.configuration.props.ApacheBotsearch_status == "true";
          context.configuration.ApacheFakegooglebot_status = success.configuration.props.ApacheFakegooglebot_status == "true";
          context.configuration.ApacheModsecurity_status = success.configuration.props.ApacheModsecurity_status == "true";
          context.configuration.ApacheNohome_status = success.configuration.props.ApacheNohome_status == "true";
          context.configuration.ApacheNoscript_status = success.configuration.props.ApacheNoscript_status == "true";
          context.configuration.ApacheOverflows_status = success.configuration.props.ApacheOverflows_status == "true";
          context.configuration.ApacheScan_status = success.configuration.props.ApacheScan_status == "true";
          context.configuration.ApacheShellshock_status = success.configuration.props.ApacheShellshock_status == "true";
          context.configuration.AsteriskAuth_status = success.configuration.props.AsteriskAuth_status == "true";
          context.configuration.EjabberAuth_status = success.configuration.props.EjabberAuth_status == "true";
          context.configuration.MysqldAuth_status = success.configuration.props.MysqldAuth_status == "true";
          context.configuration.Dovecot_status = success.configuration.props.Dovecot_status == "true";
          context.configuration.PostfixRbl_status = success.configuration.props.PostfixRbl_status == "true";
          context.configuration.Postfix_status = success.configuration.props.Postfix_status == "true";
          context.configuration.PostfixSaslAbuse_status = success.configuration.props.PostfixSaslAbuse_status == "true";
          context.configuration.Sieve_status = success.configuration.props.Sieve_status == "true";
          context.configuration.Vsftpd_status = success.configuration.props.Vsftpd_status == "true";
          context.configuration.NginxHttpAuth_status = success.configuration.props.NginxHttpAuth_status == "true";
          context.configuration.NginxBotSearch_status = success.configuration.props.NginxBotSearch_status == "true";
          context.configuration.HttpdAdmin_status = success.configuration.props.HttpdAdmin_status == "true";
          context.configuration.PamGeneric_status = success.configuration.props.PamGeneric_status == "true";
          context.configuration.Recidive_status = success.configuration.props.Recidive_status == "true";
          context.configuration.Sshd_status = success.configuration.props.Sshd_status == "true";
          context.configuration.SshdDdos_status = success.configuration.props.SshdDdos_status == "true";
          context.configuration.OpenVpnAuth_status = success.configuration.props.OpenVpnAuth_status == "true";
          context.configuration.Nextcloud_status = success.configuration.props.Nextcloud_status == "true";
          context.configuration.Owncloud_status = success.configuration.props.Owncloud_status == "true";
          context.configuration.ApachePhpMyAdmin_status = success.configuration.props.ApachePhpMyAdmin_status == "true";
          context.configuration.Roundcube_status = success.configuration.props.Roundcube_status == "true";
          context.configuration.Rspamd_status = success.configuration.props.Rspamd_status == "true";
          context.configuration.SogoAuth_status = success.configuration.props.SogoAuth_status == "true";
          context.configuration.Urbackup_status = success.configuration.props.Urbackup_status == "true";
          context.configuration.Webtop_status = success.configuration.props.Webtop_status == "true";
          
          context.view.isLoaded = true;
        },
        function(error) {
          console.error(error);
        },
        true //sudo
      );
    },
    toggleFail2banStatus() {
      this.configuration.status = !this.configuration.status;
    },
    saveSettings(type) {
      var context = this;
      var settingsObj = {
        action: "jails",
        status: context.configuration.status
          ? "enabled"
          : "disabled",
          ApacheAuth_status: context.configuration.ApacheAuth_status
            ? "true"
            : "false",
          ApacheBadbots_status: context.configuration.ApacheBadbots_status
            ? "true"
            : "false",
          ApacheBotsearch_status: context.configuration.ApacheBotsearch_status
            ? "true"
            : "false",
          ApacheFakegooglebot_status: context.configuration.ApacheFakegooglebot_status
            ? "true"
            : "false",
          ApacheModsecurity_status: context.configuration.ApacheModsecurity_status
            ? "true"
            : "false",
          ApacheNohome_status: context.configuration.ApacheNohome_status
            ? "true"
            : "false",
          ApacheNoscript_status: context.configuration.ApacheNoscript_status
            ? "true"
            : "false",
          ApacheOverflows_status: context.configuration.ApacheOverflows_status
            ? "true"
            : "false",
          ApacheScan_status: context.configuration.ApacheScan_status
            ? "true"
            : "false",
          ApacheShellshock_status: context.configuration.ApacheShellshock_status
            ? "true"
            : "false",
          AsteriskAuth_status: context.configuration.AsteriskAuth_status
            ? "true"
            : "false",
          EjabberAuth_status: context.configuration.EjabberAuth_status
            ? "true"
            : "false",
          MysqldAuth_status: context.configuration.MysqldAuth_status
            ? "true"
            : "false",
          Dovecot_status: context.configuration.Dovecot_status
            ? "true"
            : "false",
          PostfixRbl_status: context.configuration.PostfixRbl_status
            ? "true"
            : "false",
          Postfix_status: context.configuration.Postfix_status
            ? "true"
            : "false",
          PostfixSaslAbuse_status: context.configuration.PostfixSaslAbuse_status
            ? "true"
            : "false",
          Sieve_status: context.configuration.Sieve_status
            ? "true"
            : "false",
          Vsftpd_status: context.configuration.Vsftpd_status
            ? "true"
            : "false",
          NginxHttpAuth_status: context.configuration.NginxHttpAuth_status
            ? "true"
            : "false",
          NginxBotSearch_status: context.configuration.NginxBotSearch_status
            ? "true"
            : "false",
          HttpdAdmin_status: context.configuration.HttpdAdmin_status
            ? "true"
            : "false",
          PamGeneric_status: context.configuration.PamGeneric_status
            ? "true"
            : "false",
          Recidive_status: context.configuration.Recidive_status
            ? "true"
            : "false",
          Sshd_status: context.configuration.Sshd_status
            ? "true"
            : "false",
          SshdDdos_status: context.configuration.SshdDdos_status
            ? "true"
            : "false",
          OpenVpnAuth_status: context.configuration.OpenVpnAuth_status
            ? "true"
            : "false",
          Nextcloud_status: context.configuration.Nextcloud_status
            ? "true"
            : "false",
          Owncloud_status: context.configuration.Owncloud_status
            ? "true"
            : "false",
          ApachePhpMyAdmin_status: context.configuration.ApachePhpMyAdmin_status
            ? "true"
            : "false",
          Roundcube_status: context.configuration.Roundcube_status
            ? "true"
            : "false",
          Rspamd_status: context.configuration.Rspamd_status
            ? "true"
            : "false",
          SogoAuth_status: context.configuration.SogoAuth_status
            ? "true"
            : "false",
          Urbackup_status: context.configuration.Urbackup_status
            ? "true"
            : "false",
          Webtop_status: context.configuration.Webtop_status
            ? "true"
            : "false"
      };
      context.loaders = true;
      context.errors = context.initErrors();
      nethserver.exec(
        ["nethserver-fail2ban/validate"],
        settingsObj,
        null,
        function(success) {
          context.loaders = false;

          // notification
          nethserver.notifications.success = context.$i18n.t(
            "jails.settings_updated_ok"
          );
          nethserver.notifications.error = context.$i18n.t(
            "jails.settings_updated_error"
          );

          // update values
          nethserver.exec(
            ["nethserver-fail2ban/update"],
            settingsObj,
            function(stream) {
              console.info("fail2ban", stream);
            },
            function(success) {
              context.getSettings();
            },
            function(error, data) {
              console.error(error, data);
            },
            true //sudo
          );
        },
        function(error, data) {
          var errorData = {};
          context.loaders = false;
          context.errors = context.initErrors();

          try {
            errorData = JSON.parse(data);
            for (var e in errorData.attributes) {
              var attr = errorData.attributes[e];
              context.errors[attr.parameter].hasError = true;
              context.errors[attr.parameter].message = attr.error;
            }
          } catch (e) {
            console.error(e);
          }
      },
        true //sudo
    );
    }
  }
};
</script>

<style>
</style>
