
# == [ FORMS ] =================================================================
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

$('[data-act="submit"]').on 'click', (e) ->
    $($(@).attr('data-target')).submit()

$('[data-mvp-role="confirm-input"]').on 'focus', ->
    $($(@).attr('data-mvp-target') or $(@).attr('href')).slideDown()

$(".make-switch").on "switch-change", (e, data) ->
    $(data.el).val (if data.value then 1 else 0)

$('.datepicker, .input-group.date').datepicker
    autoclose: true

$('.datepicker-dob').datepicker
    autoclose: true
    startView: 2

# == [ ALERTS ] ================================================================
$('.alert-danger').animate top: $('.navbar-fixed-top').height()

# == [ DATA-HREF ] =============================================================
$('[data-href]').on 'click', ->
    window.location = $(@).attr('data-href');

# == [ TOOLTIPS ] ==============================================================
$('[data-toggle="tooltip"], .tooltipper').tooltip()

# == [ WYSIHTML5 ] =============================================================
$(".wysihtml").wysihtml5
    "font-styles": true
    emphasis: true
    lists: true
    html: true
    link: true
    image: true
    color: false

# == [ SORTABLE ] ==============================================================
$(".sortable").sortable().bind "sortupdate", (e, ui) ->
    ids = $(@).children().map(->
        $(@).attr "data-mvp-id"
    ).get()
    $.post $(@).attr("data-mvp-url"),
        "ids[]": ids
    , ((data) ->
        $.mvp.onAjaxCallback data
    ), "json"

