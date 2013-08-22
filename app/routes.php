<?php
//use App\Models\Organization;

View::share('_title', 'MVP Registration | Refreshingly simple online registration');
View::share('_description', 'Stop erroring');

if ( Session::has('org')) {
    View::share('_org', Session::get('org'));
}

include 'routes/www.php';

include 'routes/org.php';

include 'routes/admin.php';

include 'routes/member.php';
