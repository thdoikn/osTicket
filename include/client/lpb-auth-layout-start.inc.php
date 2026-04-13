<?php
if (!defined('OSTCLIENTINC')) {
    die('Access Denied');
}
if (!isset($lpb_asset)) {
    $lpb_asset = ROOT_PATH . 'assets/lapor-pak-bas/';
}
?>
    <div class="signin-container">
        <div class="signin-left">
            <div class="signin-image-wrapper">
                <img src="<?php echo Format::htmlchars($lpb_asset); ?>asset/foto1.jpg" alt="" class="signin-background-img">
                <div class="signin-image-overlay"></div>
            </div>
        </div>
        <div class="signin-right">
            <div class="signin-content lpb-auth-content">
