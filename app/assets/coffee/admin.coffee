# == [ FLASH MESSAGES ] ============================================================================
    $('#flash-message').fadeIn(500).delay(3000).fadeOut 500, ->
        $(@).remove()

    $('#flash-error').fadeIn(500).on 'click', (e) ->
        $(@).fadeOut 500, ->
            $(@).remove()

# == [ SETTINGS ][ Payments ] ======================================================================
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

# == [ SETTINGS ][ Notifications ] =================================================================
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

# == [ PAGES ] =====================================================================================
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
        url = (if (exists) then "/admin/pages/edit/" + $("#page_id").val() else "/admin/pages/new")
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
        $.post "/admin/pages/delete" + $("#page_id").val(),
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

# == [ PROGRAM ][ Trigger Modal ] ==============================================================================
    $('#program-id').change ->
        if $(@).val() is 'new'
            $('#add-program-modal').modal 'show'

# == [ PROGRAM ][ Validate Form ] ==============================================================================
    $('#add-program-form').validate
        ignoreTitle: true,
        errorElement: 'small'
        errorClass: 'invalid'
        ignore: '[type="hidden"], .hide'
        errorPlacement:  (err, ele) ->
            err.insertAfter ele
        submitHandler: (form) ->
            $(form).find('[type="submit"]').attr 'disabled', true
            submitAddProgramForm(form)
            return false

# == [ PROGRAM ][ Submit Form Callback ] =======================================================================
    submitAddProgramForm = (form) ->
        $.post(
            '/admin/seasons/program'
            $(form).serialize()
            (data) ->
                $('#add-program-modal').modal 'hide'
                if data.result is 'success'
                    opt = '<option value="'+data.id+'">'+$('#program-name').val()+' ('+$('#program-gender').val()+')</option>'
                    $('#new-program-option').before opt
                    $('#program-id').val(data.id).change()
                else
                    $.growl
                        title: "An error has occured"
                        message: ""
            'json'
        )

# == [ DIVISIONS ][ Validate Form ] ================================================================
    $('#add-division-form').validate
        ignoreTitle: true,
        errorElement: 'small'
        errorClass: 'invalid'
        ignore: '[type="hidden"], .hide'
        errorPlacement:  (err, ele) ->
            err.insertAfter ele
        submitHandler: (form) ->
            $(form).find('[type="submit"]').attr 'disabled', true
            submitAddDivisionForm(form)
            return false

# == [ PROGRAM ][ Submit Form Callback ] =======================================================================
    submitAddDivisionForm = (form) ->
        $.post(
            '/admin/seasons/division'
            $(form).serialize()
            (data) ->
                $('#add-division-modal').modal 'hide'
                if data.result is 'success'
                    $('#divisions').append '<tr><td><a data-toggle="modal" data-target="#add-division-modal">'+data.name+'</a></td></tr>'
                else
                    $.growl
                        title: "An error has occured"
                        message: ""
            'json'
        )
