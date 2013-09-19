    $('#flash-message').fadeIn(500).delay(3000).fadeOut 500, ->
        $(@).remove()

    $('#flash-error').fadeIn(500).on 'click', (e) ->
        $(@).fadeOut 500, ->
            $(@).remove()

    $('[data-act="submit"]').on 'click', (e) ->
        $($(@).attr('data-target')).submit()

    $('[data-act="deactivate-payment-processor"]').on 'click', (e) ->
        $.post '/admin/settings/payments',
            _method:'DELETE'
            payment_processor:''
            (data) ->
                if data.result is 'success'
                    window.location.href = '/admin/settings/payments'
                else
                    $.growl
                        title: "An error has occured"
                        message: ""
            'json'

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
                    title: "An error has occured"
                    message: ""
        ), 'json'

    $('#add-notification-form').validate
        ignoreTitle: true,
        errorElement: 'small'
        errorClass: 'invalid'
        ignore: '[type="hidden"], .hide'
        errorPlacement:  (err, ele) ->
            err.insertAfter ele
        submitHandler: (form) ->
            $(form).find('[type="submit"]').attr 'disabled', true
            submitAddNotificationForm(form)
            return false

    submitAddNotificationForm = (form) ->
        $.post(
            '/admin/settings/notifications/create'
            $(form).serialize()
            (data) ->
                $('#add-notification-modal').modal 'hide'
                if data.result is 'success'
                    window.location.href = "/admin/settings/notifications"
                else
                    $.growl
                        title: "An error has occured"
                        message: ""
            'json'
        )

    $(".delete-notification-toggle").on 'click', (e) ->
        $('[data-act="delete-order-notification"]').attr 'data-target', $(@).attr('data-notification')
        $("#delete-notification-modal").modal()

    $('[data-act="delete-order-notification"]').on 'click', (e) ->
        $.post "/admin/settings/notifications/" + $(@).attr('data-target'),
            _method : "DELETE"
            , ((data) ->
                $("#delete-notification-modal").modal 'hide'
                if data.result is 'success'
                    window.location.href = "/admin/settings/notifications"
                else
                    $.growl
                        title: "An error has occured"
                        message: ""
            ), 'json'


