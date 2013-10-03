// Generated by CoffeeScript 1.3.3
(function() {
  var submitAddNotificationForm, submitPagesForm;

  $('#flash-message').fadeIn(500).delay(3000).fadeOut(500, function() {
    return $(this).remove();
  });

  $('#flash-error').fadeIn(500).on('click', function(e) {
    return $(this).fadeOut(500, function() {
      return $(this).remove();
    });
  });

  $('[data-act="submit"]').on('click', function(e) {
    return $($(this).attr('data-target')).submit();
  });

  $('[data-act="deactivate-payment-processor"]').on('click', function(e) {
    return $.post('/admin/settings/payments', {
      _method: 'DELETE',
      payment_processor: ''
    }, function(data) {
      if (data.result === 'success') {
        return window.location.href = '/admin/settings/payments';
      } else {
        return $.growl({
          title: "An error has occured",
          message: ""
        });
      }
    }, 'json');
  });

  $('#pages-form').validate({
    ignoreTitle: true,
    errorElement: 'small',
    errorClass: 'invalid',
    ignore: '[type="hidden"], .hide',
    errorPlacement: function(err, ele) {
      return err.insertAfter(ele);
    },
    submitHandler: function(form) {
      $(form).find('[type="submit"]').attr('disabled', true);
      submitPagesForm(form);
      return false;
    }
  });

  submitPagesForm = function(form) {
    var exists, url;
    exists = $(form).find('[name="_method"]').val() === 'PUT';
    url = (exists ? "/admin/pages/edit/" + $("#page_id").val() : "/admin/pages/new");
    return $.post(url, $(form).serialize(), function(data) {
      $(form).find('[type="submit"]').removeAttr('disabled');
      if (data.result === 'success') {
        if (exists) {
          return $.growl({
            title: "Your page has been saved",
            message: ""
          });
        } else {
          return window.location.href = "/admin/pages";
        }
      } else {
        return $.growl({
          title: "Oops",
          message: "An error has occured"
        });
      }
    }, 'json');
  };

  $('[data-act="delete-page"]').on('click', function(e) {
    return $.post("/admin/pages/delete" + $("#page_id").val(), {
      _method: "DELETE"
    }, (function(data) {
      $('#delete-page-modal').modal('hide');
      if (data.result === 'success') {
        return window.location.href = "/admin/pages";
      } else {
        return $.growl({
          title: "An error has occured",
          message: ""
        });
      }
    }), 'json');
  });

  $('#add-notification-form').validate({
    ignoreTitle: true,
    errorElement: 'small',
    errorClass: 'invalid',
    ignore: '[type="hidden"], .hide',
    errorPlacement: function(err, ele) {
      return err.insertAfter(ele);
    },
    submitHandler: function(form) {
      $(form).find('[type="submit"]').attr('disabled', true);
      submitAddNotificationForm(form);
      return false;
    }
  });

  submitAddNotificationForm = function(form) {
    return $.post('/admin/settings/notifications/create', $(form).serialize(), function(data) {
      $('#add-notification-modal').modal('hide');
      if (data.result === 'success') {
        return window.location.href = "/admin/settings/notifications";
      } else {
        return $.growl({
          title: "An error has occured",
          message: ""
        });
      }
    }, 'json');
  };

  $(".delete-notification-toggle").on('click', function(e) {
    $('[data-act="delete-order-notification"]').attr('data-target', $(this).attr('data-notification'));
    return $("#delete-notification-modal").modal();
  });

  $('[data-act="delete-order-notification"]').on('click', function(e) {
    return $.post("/admin/settings/notifications/" + $(this).attr('data-target'), {
      _method: "DELETE"
    }, (function(data) {
      $("#delete-notification-modal").modal('hide');
      if (data.result === 'success') {
        return window.location.href = "/admin/settings/notifications";
      } else {
        return $.growl({
          title: "An error has occured",
          message: ""
        });
      }
    }), 'json');
  });

  $('.chosen-select').chosen();

}).call(this);
