<template>
  <div>
    <h2>{{$t('unban.title')}}</h2>
    <div v-if="!view.isLoaded" class="spinner spinner-lg"></div>
    <div v-if="view.isLoaded">

      <!-- <form class="form-horizontal" v-on:submit.prevent="unban()"> -->

<!-- <div class="container">
      <div class="row "> -->
      <div class="container">
<div  v-for="(value, unBanIP) in configuration.IPList">
        <!-- <div class="col-4 col-sm-6">
            {{ key }}
        </div>     -->
           <button
            @click="unban( unBanIP )"
            class="button btn btn-default button-minimum "
          >
          <span
  :class="['fa','fa-unlock']"
  
></span>
            {{$t('fail2ban.unban'+' : '+unBanIP)}}
            </button>
</div>
</div>

<!-- </div>
</div> -->


      <!-- </form> -->
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
          action: "IPList"
        },
        null,
        function(success) {
          try {
            success = JSON.parse(success);
          } catch (e) {
            console.error(e);
          }
          context.configuration.IPList = success;
          context.view.isLoaded = true;
        },
        function(error) {
          console.error(error);
        },
        false
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

.button {
  -webkit-transition-duration: 0.4s; /* Safari */
  transition-duration: 0.4s;
  width: 250px;
}

.button:hover {
  background-color: #4CAF50; /* Green */
  color: white;
}
</style>
