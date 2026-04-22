<?php
if (!defined('OSTCLIENTINC')) {
    die('Access Denied');
}
?>
<?php if ($client_logged_in) { ?>
                <span class="nav-link"><?php echo Format::htmlchars($thisclient->getName()); ?></span>
                <a href="<?php echo Format::htmlchars(ROOT_PATH); ?>profile.php" class="nav-link"><span data-i18n="navProfile">Profil</span></a>
                <a href="<?php echo Format::htmlchars(ROOT_PATH); ?>tickets.php" class="nav-link"><span data-i18n="navTickets">Tiket</span> (<span class="lpb-nav-ticket-count"><?php
                    echo (int) $thisclient->getNumTickets(); ?></span>)</a>
                <a href="<?php echo Format::htmlchars($signout_url); ?>" class="nav-link login-link lpb-nav-signout"><span data-i18n="navSignOut">Keluar</span></a>
<?php } else { ?>
                <a href="<?php echo Format::htmlchars($signin_url); ?>" class="nav-link login-link" data-i18n="navLogin">Masuk</a>
<?php } ?>
