<?php
echo Config::get('app.domain').Request::path();
echo '<br />-<br />';
echo Request::url();
