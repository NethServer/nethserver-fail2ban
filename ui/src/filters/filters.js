import Vue from "vue"

/*global ns*/
var Filters = {

  dateFormat: function (value) {
    var moment = require("moment");
    if (+new Date(value) > 0) {
      var converted = isNaN(value) ? String(value) : String(value).length == 10 ? value * 1000 : value
      return moment(converted).format("DD MMMM YYYY, HH:mm");
    } else return "-";
  },
  humanFormat: function (number, decimals = false) {
    var result;

    switch (true) {
      case number === null || number === "" || isNaN(number):
        result = "-";
        break;

      case number >= 0 && number < 1000:
        result = number;
        break;

      case number >= 1000 && number < Math.pow(1000, 2):
        if (decimals) {
          result = Math.round(number / 1000 * 10) / 10 + " K";
        } else {
          result = Math.round(number / 1000) + " K";
        }
        break;

      case number >= Math.pow(1000, 2) && number < Math.pow(1000, 3):
        if (decimals) {
          result = Math.round(number / Math.pow(1000, 2) * 10) / 10 + " M";
        } else {
          result = Math.round(number / Math.pow(1000, 2)) + " M";
        }
        break;

      case number >= Math.pow(1000, 3) && number < Math.pow(1000, 4):
        if (decimals) {
          result = Math.round(number / Math.pow(1000, 3) * 10) / 10 + " B";
        } else {
          result = Math.round(number / Math.pow(1000, 3)) + " B";
        }
        break;

      default:
        if (decimals) {
          result = Math.round(number / Math.pow(1000, 4) * 10) / 10 + " T";
        } else {
          result = Math.round(number / Math.pow(1000, 4)) + " T";
        }
    }
    return result;
  }
};

for (var f in Filters) {
  Vue.filter(f, Filters[f])
}
