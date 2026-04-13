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
?>
    <header class="signin-header">
        <div class="signin-header-container">
            <div class="signin-header-left">
                <div class="logo">
                    <a href="<?php echo Format::htmlchars(ROOT_PATH); ?>index.php" class="signin-logo-link">
                        <img src="<?php echo Format::htmlchars($lpb_asset); ?>asset/logo.png" alt="" class="logo-img">
                    </a>
                </div>
                <span class="logo-text">Nusantara</span>
            </div>
            <div class="signin-header-center">
                <nav class="header-nav">
                    <a href="<?php echo Format::htmlchars(ROOT_PATH); ?>index.php" class="nav-link" data-i18n="navHome">Beranda</a>
                    <a href="<?php echo Format::htmlchars(ROOT_PATH); ?>open.php" class="nav-link" data-i18n="navReport">Lapor</a>
                    <div class="nav-dropdown">
                        <a href="<?php echo Format::htmlchars(ROOT_PATH); ?>view.php" class="nav-link" data-i18n="navCheckStatus">Cek Status Laporan</a>
                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3 4.5 L6 7.5 L9 4.5" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                </nav>
            </div>
            <div class="signin-header-right">
                <div class="language-selector" id="languageSelector">
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="9" cy="9" r="7" stroke="white" stroke-width="1.5"/>
                        <path d="M9 2 C11 4, 13 6, 9 9 C5 6, 7 4, 9 2" fill="white"/>
                        <path d="M9 9 C11 11, 13 13, 9 16 C5 13, 7 11, 9 9" fill="white"/>
                    </svg>
                    <span id="currentLang">IDN</span>
                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3 4.5 L6 7.5 L9 4.5" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
            </div>
        </div>
    </header>
