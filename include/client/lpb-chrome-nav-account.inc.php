<?php
if (!defined('OSTCLIENTINC')) {
    die('Access Denied');
}
?>
<?php if ($client_logged_in) { ?>
                <span class="nav-link"><?php echo Format::htmlchars($thisclient->getName()); ?></span>
                <a href="<?php echo Format::htmlchars(ROOT_PATH); ?>profile.php" class="nav-link"><?php echo __('Profile'); ?></a>
                <a href="<?php echo Format::htmlchars(ROOT_PATH); ?>tickets.php" class="nav-link"><?php
                    echo sprintf(__('Tickets (%d)'), $thisclient->getNumTickets()); ?></a>
                <a href="<?php echo Format::htmlchars($signout_url); ?>" class="nav-link login-link"><?php echo __('Sign Out'); ?></a>
<?php } else { ?>
                <a href="<?php echo Format::htmlchars($signin_url); ?>" class="nav-link login-link" data-i18n="navLogin">Masuk</a>
<?php } ?>
