<?php
// TODO check if these lines could be avoided by using composer.

$new_include_path = get_include_path() . PATH_SEPARATOR . 'libs/';
set_include_path($new_include_path);
include 'Pimple.php';

// TODO check if there is any standard PHP mechanism to look for files based on namespaced class names.
include 'phpSec/Core.php';
include 'phpSec/Crypt/Crypto.php';
include 'phpSec/Auth/Gridcard.php';
include 'phpSec/Crypt/Rand.php';
include 'phpSec/Store/Store.php';
include 'phpSec/Store/File.php';
include 'phpSec/Exception.php';
include 'phpSec/Exception/IOException.php';
include 'phpSec/Exception/GeneralSecurityException.php';