$('page-edit-form').validate
    ignoreTitle: true,
    errorElement: 'small'
    errorClass: 'invalid'
    ignore: '[type="hidden"], .hide'
    errorPlacement:  (err, ele) ->
        err.insertAfter ele
    submitHandler: (form) ->
        $(form).find('[type="submit"]').attr 'disabled', true
        submitPageEditForm(form)
        return false

submitPageEditForm = (form) ->
    $.post(
        '/admin/pages/edit'
        $(form).serialize()
        (data) ->
            $(form).find('[type="submit"]').removeAttr 'disabled'
            if data.result is 'success'
                $.growl
                    title: "Your page has been saved"
            else
                $.growl
                    title: "Oops"
        'json'
    )
