
# == [ FORM ][ VALIDATION ] ====================================================
$('form').not('.bypass').each ->
    $(@).validate
        ignoreTitle: true,
        errorElement: 'small'
        errorClass: 'invalid'
        ignore: '[type="hidden"], .hide'
        errorPlacement:  (err, ele) ->
            err.insertAfter ele
        submitHandler: (form) ->
            $(form).find('[type="submit"]').attr 'disabled', true
            form.submit()
            return false

# == [ FORM ][ CONFIRM INPUT ] =================================================
$('[data-mvp-role="confirm-input"]').on 'focus', ->
    $($(@).attr('data-mvp-target') or $(@).attr('href')).slideDown()