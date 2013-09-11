    $('#flash-message').fadeIn(500).delay(3000).fadeOut 500, ->
        $(@).remove()

    $('[data-act="submit"]').on 'click', (e) ->
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
                        window.location.href = "/admin/pages"
                else
                    $.growl
                        title: "Oops"
                        message: "An error has occured"
            'json'
        )

    $('[data-act="delete-page"]').on 'click', (e) ->
        $.post "/admin/pages/" + $("#page_id").val(),
            _method : "DELETE"
        , ((data) ->
            $('#delete-page-modal').modal 'hide'
            if data.result is 'success'
                window.location.href = "/admin/pages"
            else
                $.growl
                    title: "Oops"
                    message: "An error has occured"
        ), 'json'
