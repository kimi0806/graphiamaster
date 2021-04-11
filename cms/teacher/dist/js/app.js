$(document).ready(function () {
  $.swal({
    title: $.get('title'),
    type: $.get('type')
  });

  setInterval(function(){
    $.load_unseen_notification(); 
  }, 600000);
});

$('#notification-link').on('blur', function () {
  $.ajax_request(
    controller = 'NotificationsController',
    data = {seen_notifications: '', to_user_id: 1, enable: 0}
  );

  $.load_unseen_notification(); 
});

var load_notifications = function (response ={}) {
  var response = JSON.parse(response);

  if (response.alert.type == 'error' || (response.alert.type == 'info' && response.count > 0)) {
    $.swal({
      title: response.alert.title,
      type: response.alert.type
    });
  }

  $('#notification-count').text(response.count);
  $('#notification-container').html(response.view);
}

$.load_unseen_notification =function () {
  $.ajax_request(
    controller = 'NotificationsController',
    data = {load_notifications: '', to_user_id: 1},
    callback = load_notifications
  );
}

$.ajax_request = function (controller = '', data = {}, callback = '') {
  $.ajax({
    url: '../../app/controller/' + controller + '.php',
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
    position: 'top-right',
    showConfirmButton: false,
    timer: 5000
  });

  if (array.title != '' && array.type != '') {
    Toast.fire({
      icon: array.type,
      title: array.title
    });
  }
}