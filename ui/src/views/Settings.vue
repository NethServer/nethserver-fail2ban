<template>
  <div>
    <h2>{{$t('settings.title')}}</h2>
    <div v-if="!view.isLoaded" class="spinner spinner-lg"></div>
    <div v-if="view.isLoaded">
    <doc-info
          :placement="'top'"
          :title="$t('docs.fail2ban')"
          :chapter="'fail2ban'"
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

      <h3>{{$t('fail2ban.definition')}}</h3>
      <form class="form-horizontal" v-on:submit.prevent="saveSettings('status')">
        <div :class="['form-group', errors.status.hasError ? 'has-error' : '']">
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
              v-if="errors.status.hasError"
              class="help-block"
            >{{errors.status.message}}</span>
          </div>
        </div>
        
        
        
        <!-- IgnoreIP -->
        
        <div
        v-if="configuration.status"
        :class="['form-group', errors.IgnoreIP.hasError ? 'has-error' : '']"
        >
        <label
        class="col-sm-2 control-label"
        for="textInput-modal-markup"
        >{{$t('settings.allow_only')}}</label>
        <div class="col-sm-5">
            <textarea v-model="configuration.IgnoreIP" class="form-control"></textarea>
            <span v-if="errors.IgnoreIP.hasError" class="help-block">
                {{$t('validation.validation_failed')}}:
                {{$t('validation.'+errors.IgnoreIP.message)}}
            </span>
        </div>
        </div>    

        <!-- mail -->
        
        <div
          v-if="configuration.status"
          :class="['form-group', errors.mail.hasError ? 'has-error' : '']"
        >
          <label
            class="col-sm-2 control-label"
            for="textInput-modal-markup"
          >{{$t('fail2ban.mail')}}</label>
          <div class="col-sm-5">
            <input type="checkbox" v-model="configuration.mail" class="form-control">
            <span
              v-if="errors.mail.hasError"
              class="help-block"
            >{{errors.mail.message}}</span>
          </div>
        </div>
        
        

        <div
        v-if="configuration.mail && configuration.status"
       v-for="(a, i) in configuration.CustomDestemail"
       v-bind:key="i"
       :class="['form-group', errors.CustomDestemail.hasError ? 'has-error' : '']"
     >
       <label class="col-sm-2 control-label" for="textInput-modal-markup">
         {{i == 0 ?
         $t('settings.notify_to') : ''}}
       </label>
       <div v-if="configuration.mail && configuration.status"
            class="col-sm-5">
         <input   v-model="a.email" class="form-control">
         <span v-if="errors.CustomDestemail.hasError" class="help-block">
           {{$t('validation.validation_failed')}}:
           {{$t('validation.'+errors.CustomDestemail.message)}}
         </span>
       </div>
       <div v-if="i > 0" class="col-sm-2">
         <button @click="removeEmail(a, i)" class="btn btn-default" type="button">
           <span class="fa fa-minus card-icon-def"></span>
         </button>
       </div>
     </div>
     <div   v-if="configuration.mail && configuration.status"
            class="form-group">
       <div class="col-sm-2 control-label"></div>
       <div class="col-sm-5">
         <button @click="addEmail()" class="btn btn-default" type="button">
           <span class="fa fa-plus card-icon-def"></span>
           {{$t('settings.add_email')}}
         </button>
        </div>
    </div>

<!-- advanced -->

<legend class="fields-section-header-pf" aria-expanded="true">
  <span
    :class="['fa fa-angle-right field-section-toggle-pf', configuration.advanced ? 'fa-angle-down' : '']"
  ></span>
  <a
    class="field-section-toggle-pf"
    @click="toggleAdvancedMode()"
  >{{$t('advanced_mode')}}</a>
</legend>


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
      //   internet: {
      //     Policy: true
      //   },
      //   ping: {
      //     ExternalPing: true
      //   },
      //   pf: {
      //     HairpinNat: false
      //   },
        mac: {
         MACValidationPolicy: false,
         MACValidation: false
        }
      },
      configuration: {
    //      props:{
              status: true,
              mail: true,
              CustomDestemail: [{}],
              IgnoreIP: ""
    //      }
      },
      loaders: false,
      errors: this.initErrors()
    };
  },
  methods: {
    initErrors() {
      return {
        // Policy: {
        //   hasError: false,
        //   message: ""
        // },
        // ExternalPing: {
        //   hasError: false,
        //   message: ""
        // },
        // HairpinNat: {
        //   hasError: false,
        //   message: ""
        // },
        MACValidationPolicy: {
          hasError: false,
          message: ""
        },
        status: {
          hasError: false,
          message: ""
      },
      mail: {
        hasError: false,
        message: ""
      },
      CustomDestemail: {
        hasError: false,
        message: ""
      },
      IgnoreIP: {
          haserror: false,
          message:""
      }
      };
    },
    toggleAdvancedMode() {
      this.configuration.advanced = !this.configuration.advanced;
    },
    addEmail() {
      this.configuration.CustomDestemail.push({
        isNew: true
      });
    },
    removeEmail(alias, index) {
      this.configuration.CustomDestemail.splice(index, 1);
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
          context.configuration.status = success.configuration.props.status == "enabled";
          context.configuration.mail = success.configuration.props.Mail == "enabled";
//          context.configuration.CustomDestemail = success.configuration.props.CustomDestemail == "enabled";
            var emails = [{}];
            emails = success.configuration.props.CustomDestemail.map(function(i) {
                  return {
                    email: i
                  };
              });
                  context.configuration.CustomDestemail = emails.length == 0 ? [{}] : emails;
                  context.configuration.IgnoreIP = success.configuration.props.IgnoreIP.split(
  ","
).join("\n");
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
          : "disabled",
          Mail: context.configuration.mail
            ? "enabled"
            : "disabled",
          CustomDestemail:  context.configuration.CustomDestemail.map(function(e) {
              return e.email;
          }),
          IgnoreIP: context.configuration.IgnoreIP.length > 0
            ? context.configuration.IgnoreIP.split("\n")
            : []
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
      }, //
        false //
    ); //
    }
  }
};
</script>

<style>
</style>
