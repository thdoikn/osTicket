<?php
if (!defined('OSTCLIENTINC')) {
    die('Access Denied');
}

$email = Format::input($_POST['lemail'] ? $_POST['lemail'] : $_GET['e']);
$ticketid = Format::input($_POST['lticket'] ? $_POST['lticket'] : $_GET['t']);

?>
                <a href="<?php echo Format::htmlchars(ROOT_PATH); ?>index.php" class="breadcrumb-link">
                    <svg class="breadcrumb-icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.5 15 L7.5 10 L12.5 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span data-i18n="backHome">Kembali ke Beranda</span>
                </a>

                <div class="welcome-section">
                    <h1 class="welcome-title">
                        <span data-i18n="checkStatusTitle">Cek Status</span>
                        <span class="welcome-title-accent" data-i18n="checkStatusTitle2">Laporan</span>
                    </h1>
                    <p class="welcome-description">
<?php if ($cfg->isClientEmailVerificationRequired()) { ?>
                        <span data-i18n="checkStatusDescVerify">Masukkan alamat email dan nomor tiket. Tautan akses akan dikirim ke email Anda.</span>
<?php } else { ?>
                        <span data-i18n="checkStatusDescDirect">Masukkan E-mail yang anda gunakan saat membuat laporan dan nomor tiket laporan yang telah diberikan.</span>
<?php } ?>
                    </p>
                </div>

<?php if (!empty($errors['err'])) { ?>
                <div class="lpb-auth-error" role="alert"><?php echo Format::htmlchars($errors['err']); ?></div>
<?php } ?>
<?php if (isset($msg) && $msg) { ?>
                <div class="lpb-auth-msg" role="status"><?php echo $msg; ?></div>
<?php } ?>

                <form action="login.php" method="post" id="clientLogin" class="lpb-client-login-form login-form">
                    <?php csrf_token(); ?>
                <div class="lpb-login-columns">
                    <div class="login-box">
<?php if (!empty($errors['login'])) { ?>
                    <div class="lpb-auth-error" role="alert"><?php echo Format::htmlchars($errors['login']); ?></div>
<?php } ?>
                    <div class="form-group">
                        <label for="email"><span data-i18n="emailLabel"><?php echo __('Email'); ?></span></label>
                        <input id="email" placeholder="<?php echo Format::htmlchars(__('e.g. john.doe@osticket.com')); ?>" type="text"
                            name="lemail" size="30" value="<?php echo $email; ?>" class="nowarn" autocomplete="email" data-i18n-placeholder="emailPlaceholder">
                    </div>
                    <div class="form-group">
                        <label for="ticketno"><span data-i18n="ticketNumberLabel"><?php echo __('Ticket Number'); ?></span></label>
                        <input id="ticketno" type="text" name="lticket" placeholder="<?php echo Format::htmlchars(__('e.g. 051243')); ?>"
                            size="30" value="<?php echo $ticketid; ?>" class="nowarn" autocomplete="off" data-i18n-placeholder="ticketNumberPlaceholder">
                    </div>
                    <div class="lpb-login-actions">
                        <button type="submit" class="btn btn-signin"><span data-i18n="viewReportBtn"><?php echo __('View Ticket'); ?></span></button>
                    </div>
                    <div class="register-link">
                        <span data-i18n="wantToCreate">Ingin membuat Laporan?</span>
                        <a href="<?php echo Format::htmlchars(ROOT_PATH); ?>open.php" class="register-link-text lpb-access-create-report">
                            <span data-i18n="createReportLink1">Ayo membuat</span>
                            <span class="link-accent" data-i18n="createReportLink2">Laporan</span>
                        </a>
                    </div>
                    </div>
                </div>
                </form>
