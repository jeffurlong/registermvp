<?php
View::share('_title', 'MVP Registration | Refreshingly simple online registration');
View::share('_description', 'Stop erroring');
View::share('_org', Session::get('org'));
View::share('_template', getPageTemplateName());

if ( ! subdomain())
{
    include 'routes/www.php';
}
else
{
    include 'routes/org.php';

    include 'routes/admin.php';

    include 'routes/member.php';
}
