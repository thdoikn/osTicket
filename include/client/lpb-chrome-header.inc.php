<?php
if (!defined('OSTCLIENTINC')) {
    die('Access Denied');
}
if (!isset($lpb_asset)) {
    $lpb_asset = ROOT_PATH . 'assets/lapor-pak-bas/';
}
if (!isset($lpb_active)) {
    $lpb_active = '';
}
if (!isset($signin_url)) {
    $signin_url = ROOT_PATH . 'login.php'
        . ($thisclient ? '?e=' . urlencode($thisclient->getEmail()) : '');
}
if (!isset($signout_url)) {
    $signout_url = ROOT_PATH . 'logout.php?auth=' . $ost->getLinkToken();
}
if (!isset($client_logged_in)) {
    $client_logged_in = $thisclient && $thisclient->isValid() && !$thisclient->isGuest();
}
$lpb_nav_active = function ($key) use ($lpb_active) {
    return ($lpb_active === $key) ? ' nav-link--active' : '';
};
?>
    <header class="header">
        <div class="header-container">
            <div class="header-left">
                <div class="logo">
                    <img src="<?php echo Format::htmlchars($lpb_asset); ?>asset/logo.png" alt="" class="logo-img">
                </div>
            </div>
            <div class="header-center">
                <nav id="lpbMainNav" class="header-nav" aria-label="<?php echo Format::htmlchars(__('Main navigation')); ?>">
                    <div class="lpb-nav-primary">
                        <a href="<?php echo Format::htmlchars(ROOT_PATH); ?>index.php" class="nav-link<?php echo $lpb_nav_active('home'); ?>" data-i18n="navHome">Beranda</a>
                        <a href="<?php echo Format::htmlchars(ROOT_PATH); ?>open.php" class="nav-link<?php echo $lpb_nav_active('open'); ?>" data-i18n="navReport">Lapor</a>
                        <a href="<?php echo Format::htmlchars(ROOT_PATH); ?><?php echo $client_logged_in ? 'tickets.php' : 'view.php'; ?>" class="nav-link<?php echo $lpb_nav_active('view'); ?>" data-i18n="navCheckStatus">Cek Status Laporan</a>
                    </div>
                    <div class="lpb-nav-account lpb-nav-account--drawer">
<?php require CLIENTINC_DIR . 'lpb-chrome-nav-account.inc.php'; ?>
                    </div>
                </nav>
            </div>
            <div class="header-right">
                <div class="lpb-nav-account lpb-nav-account--bar">
<?php require CLIENTINC_DIR . 'lpb-chrome-nav-account.inc.php'; ?>
                </div>
                <div class="language-selector" id="languageSelector">
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <circle cx="9" cy="9" r="7" stroke="white" stroke-width="1.5"/>
                        <path d="M9 2 C11 4, 13 6, 9 9 C5 6, 7 4, 9 2" fill="white"/>
                        <path d="M9 9 C11 11, 13 13, 9 16 C5 13, 7 11, 9 9" fill="white"/>
                    </svg>
                    <span id="currentLang">IDN</span>
                </div>
                <button type="button" class="lpb-nav-toggle" id="lpbNavToggle" aria-controls="lpbMainNav" aria-expanded="false" aria-label="<?php echo Format::htmlchars(__('Menu')); ?>">
                    <span class="lpb-nav-toggle-bars" aria-hidden="true"></span>
                </button>
            </div>
        </div>
        <div class="lpb-nav-backdrop" id="lpbNavBackdrop" hidden aria-hidden="true"></div>
    </header>
