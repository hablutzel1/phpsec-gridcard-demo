<a href="signin.php">Authentication</a>
<h1>Sign up</h1>
<form method="post">
    <label>Username:
        <input type="text" name="username">
    </label>
    <input type="submit"/>
</form>

<?php
if ($_POST) {
    include 'phpsec_includes.php';
    $psl = new \phpSec\Core();
    $psl['store'] = new \phpSec\Store\File("data", $psl);
    $gridcard = new \phpSec\Auth\Gridcard($psl);
    $gridcard->generate();
    $username = $_POST['username'];
    $gridcard->save($username);
    echo "Grid card successfully generated and associated to user '$username', now try authentication.";
    echo $gridcard->getGridHTML();
}