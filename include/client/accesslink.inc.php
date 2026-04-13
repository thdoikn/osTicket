<?php
if(!defined('OSTCLIENTINC')) die('Access Denied');

$email=Format::input($_POST['lemail']?$_POST['lemail']:$_GET['e']);
$ticketid=Format::input($_POST['lticket']?$_POST['lticket']:$_GET['t']);

if ($cfg->isClientEmailVerificationRequired())
    $button = __("Email Access Link");
else
    $button = __("View Ticket");

?>
                <a href="<?php echo Format::htmlchars(ROOT_PATH); ?>index.php" class="breadcrumb-link">
                    <svg class="breadcrumb-icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.5 15 L7.5 10 L12.5 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span data-i18n="backHome">Kembali ke Beranda</span>
                </a>

                <div class="welcome-section">
                    <h1 class="welcome-title">
                        <span data-i18n="authAccessTitle">Cek</span>
                        <span class="welcome-title-accent" data-i18n="authAccessTitle2">Status</span>
                    </h1>
                    <p class="welcome-description">
<?php if ($cfg->isClientEmailVerificationRequired()) { ?>
                        <span data-i18n="accessIntroVerify">Masukkan alamat email dan nomor tiket. Tautan akses akan dikirim ke email Anda.</span>
<?php } else { ?>
                        <span data-i18n="accessIntroDirect">Masukkan alamat email dan nomor tiket untuk masuk dan melihat tiket Anda.</span>
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
                        <label for="email"><span data-i18n="labelEmailAddress"><?php echo __('Email Address'); ?></span></label>
                        <input id="email" placeholder="<?php echo __('e.g. john.doe@osticket.com'); ?>" type="text"
                            name="lemail" size="30" value="<?php echo $email; ?>" class="nowarn" autocomplete="email" data-i18n-placeholder="phEmailExample">
                    </div>
                    <div class="form-group">
                        <label for="ticketno"><span data-i18n="labelTicketNumber"><?php echo __('Ticket Number'); ?></span></label>
                        <input id="ticketno" type="text" name="lticket" placeholder="<?php echo __('e.g. 051243'); ?>"
                            size="30" value="<?php echo $ticketid; ?>" class="nowarn" autocomplete="off" data-i18n-placeholder="phTicketExample">
                    </div>
                    <div class="lpb-login-actions">
<?php if ($cfg->isClientEmailVerificationRequired()) { ?>
                        <button type="submit" class="btn btn-signin"><span data-i18n="accessBtnEmailLink"><?php echo Format::htmlchars($button); ?></span></button>
<?php } else { ?>
                        <button type="submit" class="btn btn-signin"><span data-i18n="accessBtnViewTicket"><?php echo Format::htmlchars($button); ?></span></button>
<?php } ?>
                    </div>
                    <div class="lpb-login-secondary">
<?php if ($cfg && $cfg->getClientRegistrationMode() !== 'disabled') { ?>
                        <div class="register-link">
                            <span data-i18n="accessHaveAccount"><?php echo __('Have an account with us?'); ?></span>
                            <a href="login.php"><span data-i18n="signInBtn"><?php echo __('Sign In'); ?></span></a>
<?php
    if ($cfg->isClientRegistrationEnabled()) { ?>
                            <span class="lpb-access-reg-extra">
                                <span data-i18n="accessRegisterBeforeLink">atau</span>
                                <a href="account.php?do=create"><span data-i18n="createAccount"><?php echo __('Create an account'); ?></span></a>
                                <span data-i18n="accessRegisterAfterLink"> untuk mengakses semua tiket Anda.</span>
                            </span>
<?php
    }
?>
                        </div>
<?php } ?>
                    </div>
                    </div>
                </div>
                </form>

