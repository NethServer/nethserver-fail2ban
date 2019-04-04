<template>
<div>
<h2>{{$t('dashboard.title')}}</h2>
<div v-if="!view.isLoaded" class="spinner spinner-lg"></div>
<div v-if="view.isLoaded">
    <h3 class="col-lg-6">{{$t('dashboard.number_of_active_jail')}}: {{configuration.JailStatus.length}}</h3>
    <div class="row row-dashboard">
        <div class="col-lg-8"> 
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 resources-panel">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <span class="icon-header-panel">
                                <span class="fa fa-check right"></span>
                            </span>{{$t('dashboard.list_active_jails')}}
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div  v-for="jail in configuration.JailStatus">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">{{jail}}</div>
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5 resources-panel">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <span class="icon-header-panel">
                                <span class="fa pficon-locked right"></span>
                            </span>{{$t('dashboard.number_bans_per_jail')}}
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div  v-for="(value, Jail) in configuration.TotalBannedIP">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">{{Jail}}:</div>
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">{{value}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</template>

<script>

export default {
  name: "Unban",
  mounted() {
    this.getBanned();

  },
  data() {
    return {
      view: {
        isLoaded: false,
      },
      configuration:{
          IPList: ""
      },
      loaders: false,
      errors: this.initErrors()
    };
  },
  methods: {
    initErrors() {
      return {
      unBanIP: {
        hasError: false,
        message: ""
      }
      };
    },
    getBanned() {
      var context = this;

      context.view.isLoaded = false;
      nethserver.exec(
        ["nethserver-fail2ban/read"],
        {
          action: "Statistic"
        },
        null,
        function(success) {
          try {
            success = JSON.parse(success);
          } catch (e) {
            console.error(e);
          }
          context.configuration.TotalBannedIP = success.TotalBannedIP;
          context.configuration.JailStatus = success.JailStatus;
          
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
    },
    unban(type) {
      var context = this;
      var settingsObj = {
        action: "unban",
         unBanIP: type
      };
      console.log(type);
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
              context.getBanned();
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
