    $('[data-mvp-act="submit"]').on 'click', (e) ->
        $($(@).attr('data-target')).submit()

    $('#pages-form').validate
        ignoreTitle: true,
        errorElement: 'small'
        errorClass: 'invalid'
        ignore: '[type="hidden"], .hide'
        errorPlacement:  (err, ele) ->
            err.insertAfter ele
        submitHandler: (form) ->
            $(form).find('[type="submit"]').attr 'disabled', true
            submitPagesForm(form)
            return false

    submitPagesForm = (form) ->
        exists = $(form).find('[name="_method"]').val() is 'PUT'
        url = (if (exists) then "/admin/pages/" + $("#page_id").val() + "/edit" else "/admin/pages/create")
        $.post(
            url
            $(form).serialize()
            (data) ->
                $(form).find('[type="submit"]').removeAttr 'disabled'
                if data.result is 'success'
                    if exists
                        $.growl
                            title: "Your page has been saved"
                            message: ""
                    else
                        window.location.href = "/admin/pages?message=Your-page-has-been-saved"
                else
                    $.growl
                        title: "Oops"
                        message: "An error has occured"
            'json'
        )
