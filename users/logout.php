<?php

require '../helper/alert-helper.php';

session_start();

unset($_SESSION['username']);
session_destroy();

echo setAlert('See you again.', 'index.php');
exit;