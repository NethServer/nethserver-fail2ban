<template>
    <div>
        <h2>{{$t('logs.title')}}</h2>
        <h3>
            <pre id="log-file" class="monospace m-right-sm">{{!view.follow ? 'tail -'+view.lines+' /var/log/fail2ban.log' : 'tail -f /var/log/fail2ban.log'}}</pre>
            <button @click="handleLogs()" class="btn btn-primary">{{view.follow ? $t('logs.stop_follow') : $t('logs.follow')}}</button>
        </h3>
        <div v-if="!view.logsLoaded" id="loader" class="spinner spinner-lg view-spinner"></div>
        <pre id="logs-output" v-if="view.logsLoaded" class="logs">{{view.logsContent}}</pre>
    </div>
</template>

<script>
export default {
  name: "Logs",
  mounted() {
    this.getLogs();
  },
  data() {
    return {
      view: {
        logsLoaded: false,
        logsContent: "",
        follow: false,
        lines: 50
      }
    };
  },
  methods: {
    handleLogs() {
      this.view.follow = !this.view.follow;
      this.view.logsContent = "";
      this.$forceUpdate();
      this.getLogs();
    },
    getLogs() {
      var context = this;
      nethserver.readLogs(
        {
          action: this.view.follow ? "follow" : "dump",
          lines: this.view.follow ? null : this.view.lines,
          mode: "file",
          paths: ["/var/log/fail2ban.log"]
        },
        this.view.follow
          ? function(stream) {
              context.view.logsLoaded = true;

              context.view.logsContent += stream;

              document.getElementById(
                "logs-output"
              ).scrollTop = document.getElementById("logs-output").scrollHeight;
            }
          : null,
        function(success) {
          context.view.logsLoaded = true;

          if (success.length == 0) {
            context.view.logsContent = context.i18n.t("logs.process_terminated");
          } else {
            context.view.logsContent = success;
          }

            setTimeout(function() {
                document.getElementById(
            "logs-output"
          ).scrollTop = document.getElementById("logs-output").scrollHeight;
            },100)

        },
        function(error) {
          context.view.logsLoaded = true;
          context.logsContent = error;
        },
        true
      );
    }
  }
};
</script>

<style>
.monospace {
  display: inline;
  padding: 5px;
  font-size: 12px;
}

.logs {
  max-height: 500px;
}
</style>