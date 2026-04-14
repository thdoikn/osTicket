<?php
if (!defined('OSTCLIENTINC')) {
    die('Access Denied');
}
if (!isset($lpb_asset)) {
    $lpb_asset = ROOT_PATH . 'assets/lapor-pak-bas/';
}
if (!isset($lpb_auth_page)) {
    $lpb_auth_page = 'login';
}
if (isset($lpb_auth_hero) && is_string($lpb_auth_hero) && $lpb_auth_hero !== '') {
    $lpb_auth_hero_file = $lpb_auth_hero;
} elseif ($lpb_auth_page === 'access') {
    $lpb_auth_hero_file = 'foto3.webp';
} else {
    $lpb_auth_hero_file = 'foto1.webp';
}
?>
    <div class="signin-container">
        <div class="signin-left">
            <div class="signin-image-wrapper">
                <img src="<?php echo Format::htmlchars($lpb_asset); ?>asset/<?php echo Format::htmlchars($lpb_auth_hero_file); ?>" alt="" class="signin-background-img">
                <div class="signin-image-overlay"></div>
            </div>
        </div>
        <div class="signin-right">
            <div class="signin-content lpb-auth-content">
