
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

# == [ ALERTS ] ================================================================
$('.alert-danger').animate top: $('.navbar-fixed-top').height()

# == [ DATA-HREF ] =============================================================
$('[data-href]').on 'click', ->
    window.location = $(@).attr('data-href');

# == [ TOOLTIPS ] ==============================================================
$('[data-toggle="tooltip"]').tooltip()

# == [ WYSIHTML5 ] =============================================================
$(".wysihtml").wysihtml5
    "font-styles": true
    emphasis: true
    lists: true
    html: true
    link: true
    image: true
    color: false
