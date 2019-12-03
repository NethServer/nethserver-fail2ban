import Vue from "vue"

/*global ns*/
var Filters = {

  dateFormat: function (value) {
    var moment = require("moment");
    if (+new Date(value) > 0) {
      var converted = isNaN(value) ? String(value) : String(value).length == 10 ? value * 1000 : value
      return moment(converted).format("DD MMMM YYYY, HH:mm");
    } else return "-";
  }
};

for (var f in Filters) {
  Vue.filter(f, Filters[f])
}
