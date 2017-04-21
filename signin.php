<a href="signup.php">Sign up</a>

<h1>Sign in</h1>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    ?>
    <form method="post">
        <label>Username:
            <input type="text" name="username">
        </label>
        <input type="submit" name="action" value="Proceed to grid card validation"/>
    </form>
    <?php
} else {
    include 'phpsec_includes.php';
    $psl = new \phpSec\Core();
    $psl['store'] = new \phpSec\Store\File("data", $psl);
    $gridcard = new \phpSec\Auth\Gridcard($psl);
    $username = $_POST['username'];
    $userLoadedCorrectly = $gridcard->load($username);
    if ($userLoadedCorrectly) {
        if ($_POST['action'] == 'Proceed to grid card validation') {
            $nextCells = $gridcard->getNextCells();
            ?>
            <form method="post">
                <?php
                for ($i = 0; $i < 3; $i++) {
                    $cell = $nextCells[$i];
                    echo "<label>$cell<input type='text' name='f$i' ></label><br />";
                }
                ?>
                <input type="hidden" name="username" value="<?php echo $username; ?>"/>
                <input type="submit" name="action" value="Complete authentication">
            </form>
            <?php
        } else if ($_POST['action'] == 'Complete authentication') {
            $providedCellValues = array();
            for ($i = 0; $i < 3; $i++) {
                $var = $_POST["f" . $i];
                $providedCellValues[] = $var;
            }
            $ok = $gridcard->validate($providedCellValues, $_POST['username']);
            if ($ok) {
                echo "Successful authentication.";
            } else {
                echo "Unsuccessful authentication.";
            }
        }
    } else {
        echo "User is not registered. Please sign up for this user.";
    }
}