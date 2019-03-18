<template>
  <div>
    <h2>{{$t('settings.title')}}</h2>
    <div v-if="!view.isLoaded" class="spinner spinner-lg"></div>
    <div v-if="view.isLoaded">
    <doc-info
          :placement="'top'"
          :title="$t('docs.tls_policy')"
          :chapter="'tlspolicy'"
          :section="''"
          :inline="false"
    ></doc-info>
      <!-- <h3>{{$t('settings.traffic_internet')}}</h3>
      <form class="form-horizontal" v-on:submit.prevent="saveSettings('internet')">
        <div :class="['form-group', errors.Policy.hasError ? 'has-error' : '']">
          <label
            class="col-sm-2 control-label"
            for="textInput-modal-markup"
          >{{$t('settings.allowed')}}</label>
          <div class="col-sm-5">
            <input type="checkbox" v-model="settings.internet.Policy" class="form-control">
            <span v-if="errors.Policy.hasError" class="help-block">
              {{$t('validation.validation_failed')}}:
              {{$t('validation.'+errors.Policy.message)}}
            </span>
          </div>
        </div>
      </form>

      <h3>{{$t('settings.external_ping')}}</h3>
      <form class="form-horizontal" v-on:submit.prevent="saveSettings('ping')">
        <div :class="['form-group', errors.ExternalPing.hasError ? 'has-error' : '']">
          <label
            class="col-sm-2 control-label"
            for="textInput-modal-markup"
          >{{$t('settings.allowed')}}</label>
          <div class="col-sm-5">
            <input type="checkbox" v-model="settings.ping.ExternalPing" class="form-control">
            <span v-if="errors.ExternalPing.hasError" class="help-block">
              {{$t('validation.validation_failed')}}:
              {{$t('validation.'+errors.ExternalPing.message)}}
            </span>
          </div>
        </div>
      </form>

      <h3>{{$t('settings.portforward')}}</h3>
      <form class="form-horizontal" v-on:submit.prevent="saveSettings('pf')">
        <div :class="['form-group', errors.HairpinNat.hasError ? 'has-error' : '']">
          <label
            class="col-sm-2 control-label"
            for="textInput-modal-markup"
          >{{$t('settings.enable_hairpinnat')}}</label>
          <div class="col-sm-5">
            <input type="checkbox" v-model="settings.pf.HairpinNat" class="form-control">
            <span v-if="errors.HairpinNat.hasError" class="help-block">
              {{$t('validation.validation_failed')}}:
              {{$t('validation.'+errors.HairpinNat.message)}}
            </span>
          </div>
        </div>
      </form> -->

      <h3>{{$t('configuration.props.status')}}</h3>
      <form class="form-horizontal" v-on:submit.prevent="saveSettings('status')">
        <div :class="['form-group', errors.MACValidation.hasError ? 'has-error' : '']">
          <label
            class="col-sm-2 control-label"
            for="textInput-modal-markup"
          >{{$t('configuration.props.status')}}</label>
          <div class="col-sm-5">
            <toggle-button
              class="min-toggle"
              :width="40"
              :height="20"
              :color="{checked: '#0088ce', unchecked: '#bbbbbb'}"
              :value="configuration.status"
              :sync="true"
              @change="toggleSettingsMACValidation()"
            />
            <span
              v-if="errors.MACValidation.hasError"
              class="help-block"
            >{{errors.MACValidation.message}}</span>
          </div>
        </div>
        <div
          v-if="configuration.status"
          :class="['form-group', errors.MACValidationPolicy.hasError ? 'has-error' : '']"
        >
          <label
            class="col-sm-2 control-label"
            for="textInput-modal-markup"
          >{{$t('settings.allow_mac')}}</label>
          <div class="col-sm-5">
            <input type="checkbox" v-model="settings.mac.MACValidationPolicy" class="form-control">
            <span
              v-if="errors.MACValidationPolicy.hasError"
              class="help-block"
            >{{errors.MACValidationPolicy.message}}</span>
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
  name: "Settings",
  mounted() {
    this.getSettings();

    var context = this;
    context.$parent.$on("changes-applied", function() {
      context.getSettings();
    });
  },
  data() {
    return {
      view: {
        isLoaded: false,
        isRoot: false
      },
      settings: {
        internet: {
          Policy: true
        },
        ping: {
          ExternalPing: true
        },
        pf: {
          HairpinNat: false
        },
        mac: {
          MACValidationPolicy: false,
          MACValidation: false
        }
      },
      configuration: {
          props:{
              status: false
          }
      },
      loaders: false,
      errors: this.initErrors()
    };
  },
  methods: {
    initErrors() {
      return {
        Policy: {
          hasError: false,
          message: ""
        },
        ExternalPing: {
          hasError: false,
          message: ""
        },
        HairpinNat: {
          hasError: false,
          message: ""
        },
        MACValidationPolicy: {
          hasError: false,
          message: ""
        },
        MACValidation: {
          hasError: false,
          message: ""
        }
      };
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
          // // internet
          // context.settings.internet.Policy =
          //   success.settings.Policy == "permissive";
          // 
          // // ping
          // context.settings.ping.ExternalPing =
          //   success.settings.ExternalPing == "enabled";
          // 
          // // port forward
          // context.settings.pf.HairpinNat =
          //     success.settings.HairpinNat == "enabled";
          // 
          // // mac
          // context.settings.mac.MACValidationPolicy =
          //   success.settings.MACValidationPolicy == "accept";
          // context.settings.MACValidation =
          //   success.settings.MACValidation == "enabled";

          //context.configuration = success.configuration;
          context.configuration.status = success.configuration.props.status === "enabled";
          
          context.view.isLoaded = true;
        },
        function(error) {
          console.error(error);
        },
        false
      );
    },
    toggleSettingsMACValidation() {
      this.configuration.status = !this.configuration.status;
    },
    saveSettings(type) {
      var context = this;
      // var settingsObj = {
      //   action: "settings",
      //   ExternalPing: context.settings.ping.ExternalPing
      //     ? "enabled"
      //     : "disabled",
      //   HairpinNat: context.settings.pf.HairpinNat
      //       ? "enabled"
      //       : "disabled",
      //   Policy: context.settings.internet.Policy ? "permissive" : "strict",
      //   MACValidationPolicy: context.configuration.status
      //     ? "enabled"
      //     : "disabled",
      //   MACValidation: context.settings.mac.MACValidation
      //     ? "enabled"
      //     : "disabled"
      // };
      
      var settingsObj = {
        action: "configuration",
        status: context.configuration.status
          ? "enabled"
          : "disabled"
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
            "settings.settings_updated_ok"
          );
          nethserver.notifications.error = context.$i18n.t(
            "settings.settings_updated_error"
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
      }, //
        false //
    ); //
    }
  }
};
</script>

<style>
</style>
