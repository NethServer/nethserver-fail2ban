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
              :lang="'en'"
        ></doc-info>
      <h3>{{$t('settings.configuration')}}</h3>
      <form class="form-horizontal" v-on:submit.prevent="saveSettings('status')">
        <div :class="['form-group', errors.status.hasError ? 'has-error' : '']">
          <label
            class="col-sm-2 control-label"
            for="textInput-modal-markup"
          >{{$t('settings.status')}}</label>
          <div class="col-sm-5">
            <toggle-button
              class="min-toggle"
              :width="40"
              :height="20"
              :color="{checked: '#0088ce', unchecked: '#bbbbbb'}"
              :value="configuration.status"
              :sync="true"
              @change="toggleStatus()"
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
        >{{$t('settings.IgnoreIP')}}
        <doc-info
          :placement="'top'"
          :title="$t('settings.IgnoreIP')"
          :chapter="'IgnoreIP'"
          :inline="true"
        ></doc-info>
        </label>
        <div class="col-sm-5">
            <textarea v-model="configuration.IgnoreIP" class="form-control"></textarea>
            <span v-if="errors.IgnoreIP.hasError" class="help-block">
                {{$t('validation.validation_failed')}}:
                {{$t('validation.'+errors.IgnoreIP.message)}}: '{{errors.IgnoreIP.value}}'
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
          >{{$t('settings.mail')}}</label>
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
             <input  required type="email" v-model="a.email" class="form-control">
             <span v-if="errors.CustomDestemail.hasError" class="help-block">
               {{$t('validation.validation_failed')}}:
               {{$t('validation.'+errors.CustomDestemail.message)}}
             </span>
           </div>
           <div v-if="i >= 0" class="col-sm-2">
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

        <div
          v-if="configuration.status && configuration.mail"
          :class="['form-group', errors.MailJailState.hasError ? 'has-error' : '']"
        >
          <label
            class="col-sm-2 control-label"
            for="textInput-modal-markup"
          >{{$t('settings.MailJailState')}}
          <doc-info
            :placement="'top'"
            :title="$t('settings.MailJailState')"
            :chapter="'MailJailState'"
            :inline="true"
          ></doc-info>
          </label>
          <div class="col-sm-5">
            <input type="checkbox" v-model="configuration.MailJailState" class="form-control">
            <span
              v-if="errors.MailJailState.hasError"
              class="help-block"
            >{{errors.MailJailState.message}}</span>
          </div>
        </div>

        <!-- advanced -->

        <legend v-if="configuration.status" class="fields-section-header-pf" aria-expanded="true">
            <span
            :class="['fa fa-angle-right field-section-toggle-pf', configuration.advanced ? 'fa-angle-down' : '']"
            ></span>
            <a
            class="field-section-toggle-pf"
            @click="toggleAdvancedMode()"
            >{{$t('advanced_mode')}}</a>
        </legend>

        <div
          v-if="configuration.status && configuration.advanced"
          :class="['form-group', errors.RecidiveBan.hasError ? 'has-error' : '']"
        >
          <label
            class="col-sm-2 control-label"
            for="textInput-modal-markup"
          >{{$t('settings.Recidive')}}
          <doc-info
            :placement="'top'"
            :title="$t('settings.Recidive')"
            :chapter="'Recidive'"
            :inline="true"
          ></doc-info>
          </label>
          <div class="col-sm-5">
              <input type="radio" id="IncrementalBanTime" value="incremental"
                v-model="configuration.RecidiveBan" class="form-control" >
              <label for="IncrementalBanTime">{{$t('settings.Recidive_Incremental')}}
                <doc-info
                :placement="'top'"
                :title="$t('settings.Recidive_Incremental')"
                :chapter="'Incremental_BanTime'"
                :inline="true"
                ></doc-info>
              </label>
              <br />
              <input type="radio" id="RecidiveBanTime" value="static"
                v-model="configuration.RecidiveBan" class="form-control" >
              <label for="RecidiveBanTime">{{$t('settings.Recidive_BanTime')}}
                <doc-info
                :placement="'top'"
                :title="$t('settings.Recidive_BanTime')"
                :chapter="'Recidive_BanTime'"
                :inline="true"
                ></doc-info>
              </label>
              <br />
              <input type="radio" id="RecidiveBanDisabled" value="disabled"
                v-model="configuration.RecidiveBan" class="form-control" >
              <label for="RecidiveBanDisabled">{{$t('settings.Recidive_Disabled')}}
            <span
              v-if="errors.RecidiveBan.hasError"
              class="help-block"
            >{{errors.RecidiveBan.message}}
            </span>
          </div>
        </div>

        <div
          v-if="configuration.status && configuration.advanced"
          :class="['form-group', errors.BanLocalNetwork.hasError ? 'has-error' : '']"
        >
          <label
            class="col-sm-2 control-label"
            for="textInput-modal-markup"
          >{{$t('settings.BanLocalNetwork')}}</label>
          <div class="col-sm-5">
            <input type="checkbox" v-model="configuration.BanLocalNetwork" class="form-control">
            <span
              v-if="errors.BanLocalNetwork.hasError"
              class="help-block"
            >{{errors.BanLocalNetwork.message}}</span>
          </div>
        </div>

        <div 
          v-if="configuration.status && configuration.advanced"
          :class="['form-group', errors.LogLevel.hasError ? 'has-error' : '']">
          <label
            class="col-sm-2 control-label"
            for="textInput-modal-markup"
          >{{$t('settings.LogLevel')}}
          <doc-info
            :placement="'top'"
            :title="$t('settings.LogLevel')"
            :chapter="'LogLevel'"
            :inline="true"
          ></doc-info>
          </label>
          <div class="col-sm-5">
            <select
              required
              type="text"
              v-model="configuration.LogLevel"
              class="combobox form-control"
            >
              <option value="INFO">{{$t('settings.LogLevel_INFO')}}</option>
              <option value="NOTICE">{{$t('settings.LogLevel_NOTICE')}}</option>
              <option value="WARNING">{{$t('settings.LogLevel_WARNING')}}</option>
              <option value="ERROR">{{$t('settings.LogLevel_ERROR')}}</option>
              <option value="CRITICAL">{{$t('settings.LogLevel_CRITICAL')}}</option>
            </select>
            <span v-if="errors.LogLevel.hasError" class="help-block">
              {{$t('validation.validation_failed')}}:
              {{$t('validation.'+errors.LogLevel.message)}}
            </span>
          </div>
        </div>
        <!-- slider -->
        <div v-if="configuration.status && configuration.advanced" :class="['form-group', errors.MaxRetry.hasError ? 'has-error' : '']">
            <label class="col-sm-2 control-label" for="filter">{{$t('settings.MaxRetry')}}</label>
            <div class="col-sm-5">
                <div>{{configuration.MaxRetry}}</div>
                <vue-slider v-model="configuration.MaxRetry" :min="1" :max="10" :use-keyboard="true" :tooltip="'none'"></vue-slider>
                <span v-if="errors.MaxRetry.hasError" class="help-block">{{$t('settings.Not_valid_MaxRetry')}}</span>
            </div>
        </div>
        <div v-if="configuration.status && configuration.advanced" :class="['form-group', errors.FindTime.hasError ? 'has-error' : '']">
            <label class="col-sm-2 control-label" for="filter">{{$t('settings.FindTime')}}
                <doc-info
                  :placement="'top'"
                  :title="$t('settings.FindTime')"
                  :chapter="'FindTime'"
                  :inline="true"
                ></doc-info>
            </label>
            <div class="col-sm-5">
                <div>{{ $t('settings.FindTime_'+configuration.FindTime) }}</div>
                <vue-slider v-model="configuration.FindTime"  :data="FindTime" :tooltip="'none'"></vue-slider>
                <span v-if="errors.FindTime.hasError" class="help-block">{{$t('settings.Not_valid_FindTime')}}</span>
            </div>
        </div>
        <div v-if="configuration.status && configuration.advanced" :class="['form-group', errors.BanTime.hasError ? 'has-error' : '']">
            <label class="col-sm-2 control-label" >{{$t('settings.BanTime')}}</label>
            <div class="col-sm-5">
                <div>{{ $t('settings.BanTime_'+configuration.BanTime) }}</div>
                <vue-slider v-model="configuration.BanTime"  :data="BanTime" :tooltip="'none'"></vue-slider>
                <span v-if="errors.BanTime.hasError" class="help-block">{{$t('settings.Not_valid_BanTime')}}</span>
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
import VueSlider from 'vue-slider-component'
import 'vue-slider-component/theme/default.css'


export default {
  name: "Settings",
  components: {
    VueSlider
  },
  mounted() {
    this.getSettings();

  },
  data() {
    return {
        FindTime: ['600','900','1800','3600','7200','86400','172800','604800','1209600'],
        BanTime: ['60','120','180','240','300','360','420','480','540','600','900','1800','3600','7200','86400','172800','604800','1209600'],
      view: {
        isLoaded: false,
        isRoot: false
      },
      configuration: {
              status: true,
              mail: true,
              CustomDestemail: [],
              IgnoreIP: [],
              MailJailState: false,
              BanLocalNetwork: false,
              LogLevel: "INFO",
              MaxRetry: '3',
              FindTime: '900',
              BanTime: '600',
              RecidiveBan: 'static'
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
      },
      MailJailState: {
          haserror: false,
          message:""
      },
      BanLocalNetwork: {
          haserror: false,
          message:""
      },
      LogLevel: {
          haserror: false,
          message:""
      },
      MaxRetry: {
          haserror: false,
          message:""
      },
      FindTime: {
          haserror: false,
          message:""
      },
      BanTime: {
          haserror: false,
          message:""
      },
      RecidiveBan: {
          haserror: false,
          message:""
      }
      };
    },
    toggleAdvancedMode() {
      this.configuration.advanced = !this.configuration.advanced;
      this.$forceUpdate();
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
          context.configuration.status = success.configuration.props.status == "enabled";
          context.configuration.mail = success.configuration.props.Mail == "enabled";
          context.configuration.MailJailState = success.configuration.props.MailJailState == "enabled";
          context.configuration.BanLocalNetwork = success.configuration.props.BanLocalNetwork == "enabled";
          context.configuration.RecidiveBan = success.configuration.props.RecidiveBan;
            var emails = [{}];
            emails = success.configuration.props.CustomDestemail.map(function(i) {
                  return {
                    email: i
                  };
              });
          context.configuration.CustomDestemail = emails.length == 0 ? [] : emails;
          context.configuration.IgnoreIP = success.configuration.props.IgnoreIP.split(",").join("\n");
          context.configuration.LogLevel = success.configuration.props.LogLevel;
          context.configuration.MaxRetry = success.configuration.props.MaxRetry;
          context.configuration.FindTime = success.configuration.props.FindTime;
          context.configuration.BanTime = success.configuration.props.BanTime;

          context.view.isLoaded = true;
        },
        function(error) {
          console.error(error);
        },
        true //sudo
      );
    },
    toggleStatus() {
      this.configuration.status = !this.configuration.status;
      this.$forceUpdate();
    },
    saveSettings(type) {
      var context = this;

      // Remove empty lines and whitespace at begin and end of Allow
      var  CleanIgnoreIP = ((context.configuration.IgnoreIP.split("\n")).filter(e => String(e).trim())).map(str => str.trim());

      var settingsObj = {
        action: "configuration",
        status: context.configuration.status
          ? "enabled"
          : "disabled",
          Mail: context.configuration.mail
            ? "enabled"
            : "disabled",
          MailJailState: context.configuration.MailJailState
            ? "enabled"
            : "disabled",
          BanLocalNetwork: context.configuration.BanLocalNetwork
            ? "enabled"
            : "disabled",
          RecidiveBan: context.configuration.RecidiveBan,
          CustomDestemail:  context.configuration.CustomDestemail.map(function(e) {
              return e.email;
          }),
          IgnoreIP: context.configuration.IgnoreIP.length > 0
            ? CleanIgnoreIP
            : [],
          LogLevel: context.configuration.LogLevel,
          MaxRetry: context.configuration.MaxRetry,
          FindTime: context.configuration.FindTime,
          BanTime: context.configuration.BanTime
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
              context.errors[attr.parameter].value = attr.value;
            }
          } catch (e) {
            console.error(e);
          }
      },
        true // sudo
    );
    }
  }
};
</script>

<style scoped>
input[type=radio].form-control {
    width: 12px !important;
    height: 12px !important;
    display: inline-block;
    vertical-align: -25%;
    margin-right: 1em;
}
</style>
