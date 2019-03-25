<template>
  <div>
    <h2>{{$t('jails.title')}}</h2>
    <div v-if="!view.isLoaded" class="spinner spinner-lg"></div>
    <div v-if="view.isLoaded">

      <h3>{{$t('fail2ban.definition')}}</h3>
      <form class="form-horizontal" v-on:submit.prevent="saveSettings('status')">
        <div :class="['form-group', errors.status.hasError ? 'has-error' : '']">
          <label
            class="col-sm-2 control-label"
            for="textInput-modal-markup"
          >{{$t('fail2ban.status')}}</label>
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
            >{{$t('fail2ban.apache_jails')}}</a>
        </legend>

        <div
          v-if="configuration.status && view.apache"
          :class="['form-group', errors.ApacheAuth_status.hasError ? 'has-error' : '']"
          >
          <label
            class="col-sm-2 control-label"
            for="textInput-modal-markup"
          >{{$t('fail2ban.ApacheAuth_status')}}</label>
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
          >{{$t('fail2ban.ApacheBadbots_status')}}</label>
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
          >{{$t('fail2ban.ApacheBotsearch_status')}}</label>
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
          >{{$t('fail2ban.ApacheFakegooglebot_status')}}</label>
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
          >{{$t('fail2ban.ApacheModsecurity_status')}}</label>
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
          >{{$t('fail2ban.ApacheNohome_status')}}</label>
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
          >{{$t('fail2ban.ApacheNoscript_status')}}</label>
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
          >{{$t('fail2ban.ApacheOverflows_status')}}</label>
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
          :class="['form-group', errors.ApachePhpMyAdmin_status.hasError ? 'has-error' : '']"
          >
          <label
            class="col-sm-2 control-label"
            for="textInput-modal-markup"
          >{{$t('fail2ban.ApachePhpMyAdmin_status')}}</label>
          <div class="col-sm-5">
            <input type="checkbox" v-model="configuration.ApachePhpMyAdmin_status" class="form-control">
            <span
              v-if="errors.ApachePhpMyAdmin_status.hasError"
              class="help-block"
            >{{errors.ApachePhpMyAdmin_status.message}}</span>
          </div>
        </div>

        <div
          v-if="configuration.status && view.apache"
          :class="['form-group', errors.ApacheScan_status.hasError ? 'has-error' : '']"
          >
          <label
            class="col-sm-2 control-label"
            for="textInput-modal-markup"
          >{{$t('fail2ban.ApacheScan_status')}}</label>
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
          >{{$t('fail2ban.ApacheShellshock_status')}}</label>
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
            >{{$t('fail2ban.communication_jails')}}</a>
        </legend>

        <div
          v-if="configuration.status && view.communication"
          :class="['form-group', errors.AsteriskAuth_status.hasError ? 'has-error' : '']"
          >
          <label
            class="col-sm-2 control-label"
            for="textInput-modal-markup"
          >{{$t('fail2ban.AsteriskAuth_status')}}</label>
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
          >{{$t('fail2ban.EjabberAuth_status')}}</label>
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
            >{{$t('fail2ban.database_jails')}}</a>
        </legend>

        <div
          v-if="configuration.status && view.database"
          :class="['form-group', errors.MysqldAuth_status.hasError ? 'has-error' : '']"
          >
          <label
            class="col-sm-2 control-label"
            for="textInput-modal-markup"
          >{{$t('fail2ban.MysqldAuth_status')}}</label>
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
            >{{$t('fail2ban.email_jails')}}</a>
        </legend>

        <div
          v-if="configuration.status && view.email"
          :class="['form-group', errors.Dovecot_status.hasError ? 'has-error' : '']"
          >
          <label
            class="col-sm-2 control-label"
            for="textInput-modal-markup"
          >{{$t('fail2ban.Dovecot_status')}}</label>
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
          >{{$t('fail2ban.PostfixRbl_status')}}</label>
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
          >{{$t('fail2ban.Postfix_status')}}</label>
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
          >{{$t('fail2ban.PostfixSaslAbuse_status')}}</label>
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
          >{{$t('fail2ban.Sieve_status')}}</label>
          <div class="col-sm-5">
            <input type="checkbox" v-model="configuration.Sieve_status" class="form-control">
            <span
              v-if="errors.Sieve_status.hasError"
              class="help-block"
            >{{errors.Sieve_status.message}}</span>
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
        email: false
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
              ApachePhpMyAdmin_status: "true",
              ApacheScan_status: "true",
              ApacheShellshock_status: "true",
              AsteriskAuth_status: "true",
              EjabberAuth_status: "true",
              MysqldAuth_status: "true",
              Dovecot_status: "true",
              PostfixRbl_status: "true",
              Postfix_status: "true",
              PostfixSaslAbuse_status: "true",
              Sieve_status: "true"

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
      ApachePhpMyAdmin_status: {
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
          context.configuration.ApacheAuth_status = success.configuration.props.ApacheAuth_status;
          context.configuration.ApacheBadbots_status = success.configuration.props.ApacheBadbots_status;
          context.configuration.ApacheBotsearch_status = success.configuration.props.ApacheBotsearch_status;
          context.configuration.ApacheFakegooglebot_status = success.configuration.props.ApacheFakegooglebot_status;
          context.configuration.ApacheModsecurity_status = success.configuration.props.ApacheModsecurity_status;
          context.configuration.ApacheNohome_status = success.configuration.props.ApacheNohome_status;
          context.configuration.ApacheNoscript_status = success.configuration.props.ApacheNoscript_status;
          context.configuration.ApacheOverflows_status = success.configuration.props.ApacheOverflows_status;
          context.configuration.ApachePhpMyAdmin_status = success.configuration.props.ApachePhpMyAdmin_status;
          context.configuration.ApacheScan_status = success.configuration.props.ApacheScan_status;
          context.configuration.ApacheShellshock_status = success.configuration.props.ApacheShellshock_status;
          context.configuration.AsteriskAuth_status = success.configuration.props.AsteriskAuth_status;
          context.configuration.EjabberAuth_status = success.configuration.props.EjabberAuth_status;
          context.configuration.MysqldAuth_status = success.configuration.props.MysqldAuth_status;
          context.configuration.Dovecot_status = success.configuration.props.Dovecot_status;
          context.configuration.PostfixRbl_status = success.configuration.props.PostfixRbl_status;
          context.configuration.Postfix_status = success.configuration.props.Postfix_status;
          context.configuration.PostfixSaslAbuse_status = success.configuration.props.PostfixSaslAbuse_status;
          context.configuration.Sieve_status = success.configuration.props.Sieve_status;
          context.view.isLoaded = true;
        },
        function(error) {
          console.error(error);
        },
        false
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
          ApachePhpMyAdmin_status: context.configuration.ApachePhpMyAdmin_status
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
            "fail2ban.settings_updated_ok"
          );
          nethserver.notifications.error = context.$i18n.t(
            "fail2ban.settings_updated_error"
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
            false
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
        false
    );
    }
  }
};
</script>

<style>
</style>
