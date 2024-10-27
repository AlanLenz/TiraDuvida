<?php

require_once "../model/Login.class.php";

$Login = new Login();

if ($Login->logoff()):
    print 1;
else:
    print 0;
endif;
