import * as $ from 'jquery';
import 'bootstrap';

export default (function () {
  $('[data-toggle="popover"]').popover();
  $('[data-toggle="tooltip"]').tooltip();
}());
