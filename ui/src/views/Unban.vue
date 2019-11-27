<template>
    <div>
        <h2>{{$t('unban.title')}}</h2>
        <div v-if="!view.isLoaded" class="spinner spinner-lg"></div>
        <div v-if="view.isLoaded">
            <div v-if="JailStatus.length > 0">
                <div v-if="rows.length === 0" >
                    <div class="blank-slate-pf">
                      <div class="blank-slate-pf-icon">
                          <span class="fa fa-lock"></span>
                      </div>
                      <h1>{{$t('unban.No_banned_IP')}}</h1>
                      <p>{{$t('unban.no_IP_desc')}}.</p>
                    </div>
                </div>
              </div>
              <div v-else>
                <h3>{{$t('list')}}</h3>
                  <vue-good-table
                  v-if="view.isLoaded"
                  :customRowsPerPageDropdown="[25,50,100]"
                  :perPage="25"
                  :columns="columns"
                  :rows="rows"
                  :lineNumbers="false"
                  :defaultSortBy="{field: 'ip', type: 'asc'}"
                  :globalSearch="true"
                  :paginate="true"
                  styleClass="table"
                  :nextText="tableLangsTexts.nextText"
                  :prevText="tableLangsTexts.prevText"
                  :rowsPerPageText="tableLangsTexts.rowsPerPageText"
                  :globalSearchPlaceholder="tableLangsTexts.globalSearchPlaceholder"
                  :ofText="tableLangsTexts.ofText"
                  >
                  <template slot="table-row" slot-scope="props">
                      <td class="fancy">
                          <strong>{{ props.row.ip }}</strong>
                      </td>
                      <td>
                          <button
                          @click="unban( props.row.ip )"
                          class="btn btn-default button-minimum"
                          >
                          <span
                          :class="['fa', 'fa-unlock', 'span-right-margin']"
                          ></span>
                          {{$t('unban.unBanIP') }}
                      </button>
                      </td>
                  </template>
                  </vue-good-table>
              </div>
            </div>
            <div v-else>
                <h3>{{$t('unban.Fail2ban_is_probably_down')}}</h3>
                <div class="divider"></div>
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
      IPList: [],
      JailStatus: [],
      loaders: false,
      errors: this.initErrors(),
      tableLangsTexts: this.tableLangs(),
    columns: [
      {
        label: this.$i18n.t("unban.BannedIP"),
        field: "ip",
        filterable: true
      },
      {
          label: this.$i18n.t("action"),
          field: "",
          filterable: true,
          sortable: false
      }
    ],
    rows: []
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
          context.rows = success.IPList;
          
        var jails = [{}];
        jails = success.JailStatus.map(function(i) {
            return {
                email: i
            };
        });
        context.JailStatus = jails.length == 0 ? [] : jails; 
        context.view.isLoaded = true;
        },
        function(error) {
          console.error(error);
        },
        true //sudo
      );
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
            "unban.ip_unlocked_ok"
          );
          nethserver.notifications.error = context.$i18n.t(
            "unban.ip_unlocked_error"
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
.divider {
    border-top: 1px solid #d1d1d1;
}
</style>
