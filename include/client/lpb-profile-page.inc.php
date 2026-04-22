<?php
if (!defined('OSTCLIENTINC')) {
    die('Access Denied!');
}
if (!isset($errors) || !is_array($errors)) {
    $errors = array();
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
                    <span data-i18n="breadcrumbProfile">Profil</span>
                </div>
            </div>
            <div class="create-ticket-title-section">
                <h1 class="create-ticket-title">
                    <span data-i18n="profilePageTitle">Kelola Informasi Profil Anda</span>
                </h1>
                <p class="create-ticket-description" data-i18n="profilePageDesc">Gunakan formulir di bawah untuk memperbarui informasi akun yang kami simpan.</p>
            </div>
        </div>
<?php if (!empty($errors['err'])) { ?>
        <div class="content-wrapper">
            <div class="lpb-open-error" role="alert"><?php echo Format::htmlchars($errors['err']); ?></div>
        </div>
<?php } ?>
        <div class="content-wrapper">
            <?php require CLIENTINC_DIR . 'profile.inc.php'; ?>
        </div>
    </div>
</main>
