<template>
    <div>
        <h2>{{$t('dashboard.title')}}</h2>
        <div v-if="!view.isLoaded" class="spinner spinner-lg"></div>
        <div v-if="view.isLoaded">
            <h3 >{{$t('dashboard.number_total_of_bans')}}:
              <span :title="configuration.totalBans">
                {{configuration.totalBans | humanFormat}}
              </span>
            </h3>
            <span>{{$t('dashboard.time_of_the_last_stats')}}</span>
            <span class="margin-left fa fa-clock-o panel-icon"></span>
            <span class="margin-left-sm">{{configuration.date | dateFormat}}</span> 
            <div class="divider"></div>
            <div class="row row-dashboard">
              <div class="col-lg-4">
                <h3 >{{$t('dashboard.number_bans_per_jail')}}</h3>
                <div v-if="Object.keys(configuration.TotalBannedIP).length == 0" class="empty-piechart">
                    <span class="fa fa-pie-chart"></span>
                    <div>{{ $t('dashboard.empty_piechart_label') }}</div>
                </div>
                <div v-else id="fail2ban-pie-chart"></div>
              </div>
              <div class="col-lg-4">
                  <div class="container-fluid">
                      <div class="row ">
                          <h3 class="col-xs-6 col-sm-4 col-md-3 col-lg-4">
                            {{$t('dashboard.number_of_active_jail')}}:
                            <span :title="configuration.JailStatus.length">
                              {{configuration.JailStatus.length | humanFormat}}
                            </span>
                          </h3>
                          <h3 class="col-xs-6 col-sm-4 col-md-3 col-lg-4" >
                            {{$t('dashboard.number_of_enabled_jails')}}:
                            <span :title="configuration.JailEnabled">
                              {{configuration.JailEnabled | humanFormat}}
                            </span>
                          </h3>
                      </div>
                      <div class="row row-dashboard">
                          <div class="col-xs-12 col-sm-8 col-md-6 col-lg-8 resources-panel">
                              <div class="panel panel-default">
                                  <div class="panel-heading">
                                      <h3 class="panel-title">
                                          <span class="icon-header-panel">
                                              <span class="fa pficon-on-running "></span>
                                          </span>{{$t('dashboard.list_active_jails')}}
                                      </h3>
                                  </div>
                                  <div class="panel-body">
                                      <div v-if="configuration.JailStatus.length >0" >
                                        <div  v-for="jail in configuration.JailStatus">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">{{jail}}</div>
                                            </div>
                                        </div>
                                      </div>
                                      <div v-else>
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">{{$t('dashboard.Fail2ban_is_probably_down')}}</div>
                                        </div>
                                      </div>
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
import generatePieChart from "@/piechart";
export default {
  name: "Unban",
  mounted() {
    this.getBanned();

  },
    updated() {
    var $ = window.jQuery;
    $('[data-toggle="tooltip"]').tooltip();
    if (!this.rspamdPieChart) {
      this.rspamdPieChart = generatePieChart("#fail2ban-pie-chart", {
         columns: []
       });
    }
    this.rspamdPieChart.load({
   json: this.configuration.TotalBannedIP
   });

  },
  data() {
    return {
      view: {
        isLoaded: false,
      },
      configuration:{
          IPList: "",
          date: 0
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
          action: "statistic"
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
          context.configuration.JailEnabled = success.JailEnabled;
          context.configuration.date = success.date;

          var totalBans = 0;

         for (var jail in success.TotalBannedIP) {
             totalBans += Number(success.TotalBannedIP[jail]);
         }
         context.configuration.totalBans = totalBans;

          context.view.isLoaded = true;
        },
        function(error) {
          console.error(error);
        },
        true //sudo
      );
    }
  }
};
</script>

<style>
.empty-piechart {
  margin-top: 2em;
  text-align: center;
  color: #9c9c9c;
}
.empty-piechart .fa {
  font-size: 92px;
  color: #bbbbbb;
}
.pficon-on-running {
    margin-right: 2px;
}
.margin-left-sm {
    margin-left: 4px;
}
.margin-left {
    margin-left: 10px;
}
.divider {
    border-top: 1px solid #d1d1d1;
}
.row-dashboard {
    margin-bottom: 25px;
}
</style>
