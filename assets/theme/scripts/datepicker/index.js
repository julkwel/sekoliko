import * as $ from 'jquery';
import 'bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js';

export default (function () {
  $('.start-date').datepicker();
  $('.end-date').datepicker();
}())
