<?php
if (!defined('OSTCLIENTINC')) {
    die('Access Denied!');
}
?>
<main class="create-ticket-main">
    <div class="create-ticket-container">
        <div class="content-wrapper">
            <div class="breadcrumb-section">
                <a href="<?php echo Format::htmlchars(ROOT_PATH); ?>index.php" class="breadcrumb-link">
                    <svg class="breadcrumb-icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.5 15 L7.5 10 L12.5 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    ← <span data-i18n="backHome">Kembali ke Beranda</span>
                </a>
                <div class="breadcrumb-path">
                    <span data-i18n="navHome">Beranda</span>
                    <span class="breadcrumb-separator">/</span>
                    <span data-i18n="ticketsListBreadcrumb">Daftar tiket</span>
                </div>
            </div>
            <div class="create-ticket-title-section">
                <h1 class="create-ticket-title">
                    <span data-i18n="ticketsListPageTitle">Daftar tiket Anda</span>
                </h1>
                <p class="create-ticket-description" data-i18n="ticketsListPageDesc">Lihat dan kelola tiket laporan yang telah Anda kirim.</p>
            </div>
        </div>
        <div class="content-wrapper lpb-profile-form-wrap">
            <?php require CLIENTINC_DIR . 'tickets.inc.php'; ?>
        </div>
    </div>
</main>
