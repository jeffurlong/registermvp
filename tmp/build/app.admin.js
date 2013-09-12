// Generated by CoffeeScript 1.3.3
(function() {
  var submitPagesForm;

  $('#flash-message').fadeIn(500).delay(3000).fadeOut(500, function() {
    return $(this).remove();
  });

  $('[data-act="submit"]').on('click', function(e) {
    return $($(this).attr('data-target')).submit();
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
    url = (exists ? "/admin/pages/" + $("#page_id").val() + "/edit" : "/admin/pages/create");
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
    return $.post("/admin/pages/" + $("#page_id").val(), {
      _method: "DELETE"
    }, (function(data) {
      $('#delete-page-modal').modal('hide');
      if (data.result === 'success') {
        return window.location.href = "/admin/pages";
      } else {
        return $.growl({
          title: "Oops",
          message: "An error has occured"
        });
      }
    }), 'json');
  });

}).call(this);