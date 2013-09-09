    $('#pages-edit-form').validate
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
            '/admin/pages/'+$('#page_id').val()+'/edit'
            $(form).serialize()
            (data) ->
                $(form).find('[type="submit"]').removeAttr 'disabled'
                if data.result is 'success'
                    $.growl
                        title: "OK"
                        message: "Your page has been saved"
                else
                    $.growl
                        title: "Oops"
                        message: "An error has occured"
            'json'
        )
