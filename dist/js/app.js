$(document).ready(function () {
  $.swal({
    title: $.get('title'),
    type: $.get('type')
  });
});

$.ajax_request = function (controller = '', data = {}, callback = '') {
  $.ajax({
    url: 'app/controller/' + controller + '.php',
    method: 'post',
    data: data,
    success: callback
  });
}

$.get = function (name) {
  var result = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.search);
  return result != null ? decodeURIComponent(result[1]) || 0 : false;
}

$.swal = function (array = {title, type}) {
  const Toast = Swal.mixin({
    toast: true,
    position: 'top',
    showConfirmButton: true,
    timer: 10000
  });

  if (array.title != '' && array.type != '') {
    Toast.fire({
      icon: array.type,
      title: array.title
    });
  }
}