<?php
if (!defined('OSTCLIENTINC')) die('Access Denied');

$email=Format::input($_POST['luser']?:$_GET['e']);
$passwd=Format::input($_POST['lpasswd']?:$_GET['t']);

$content = Page::lookupByType('banner-client');

if ($content) {
    list($title, $body) = $ost->replaceTemplateVariables(
        array($content->getLocalName(), $content->getLocalBody()));
} else {
    $title = __('Sign In');
    $body = __('To better serve you, we encourage our clients to register for an account and verify the email address we have on record.');
}

$title_en = Format::striptags($title);
$title_id = $title_en;
if (preg_match('/^sign\s+in\s+to\s+/i', $title_en)) {
    $title_id = preg_replace('/^sign\s+in\s+to\s+/i', 'Masuk ke ', $title_en);
}
$body_en = Format::striptags($body);
$body_id = $body_en;
if (stripos($body_en, 'To better serve you') !== false
        || (stripos($body_en, 'encourage') !== false && stripos($body_en, 'register') !== false)) {
    $body_id = 'Untuk melayani Anda lebih baik, kami menganjurkan agar klien mendaftar akun dan memverifikasi alamat email yang tercatat.';
}

?>
                <a href="<?php echo Format::htmlchars(ROOT_PATH); ?>index.php" class="breadcrumb-link">
                    <svg class="breadcrumb-icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.5 15 L7.5 10 L12.5 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span data-i18n="backHome">Kembali ke Beranda</span>
                </a>

                <div class="welcome-section">
                    <h1 class="welcome-title"><span class="lpb-bilingual" data-id="<?php echo Format::htmlchars($title_id); ?>" data-en="<?php echo Format::htmlchars($title_en); ?>"><?php echo Format::htmlchars($title_id); ?></span></h1>
                    <p class="welcome-description"><span class="lpb-bilingual" data-id="<?php echo Format::htmlchars($body_id); ?>" data-en="<?php echo Format::htmlchars($body_en); ?>"><?php echo Format::htmlchars($body_id); ?></span></p>
                </div>

<?php if (!empty($errors['err'])) { ?>
                <div class="lpb-auth-error" role="alert"><?php echo Format::htmlchars($errors['err']); ?></div>
<?php } ?>

                <form action="login.php" method="post" id="clientLogin" class="lpb-client-login-form login-form">
                    <?php csrf_token(); ?>
                <div class="lpb-login-columns">
                    <div class="login-box">
<?php if (!empty($errors['login'])) { ?>
                    <div class="lpb-auth-error" role="alert"><?php echo Format::htmlchars($errors['login']); ?></div>
<?php } ?>
                    <div class="form-group">
                        <label for="username"><span data-i18n="labelEmailOrUser"><?php echo __('Email or Username'); ?></span></label>
                        <input id="username" placeholder="<?php echo __('Email or Username'); ?>" type="text" name="luser" size="30" value="<?php echo $email; ?>" class="nowarn" autocomplete="username" data-i18n-placeholder="phEmailOrUser">
                    </div>
                    <div class="form-group">
                        <label for="passwd"><span data-i18n="labelPassword"><?php echo __('Password'); ?></span></label>
                        <div class="password-input-wrapper">
                            <input id="passwd" placeholder="<?php echo __('Password'); ?>" type="password" name="lpasswd" size="30" maxlength="128" value="<?php echo $passwd; ?>" class="nowarn" autocomplete="current-password" data-i18n-placeholder="phPassword">
                            <button type="button" class="password-toggle" id="passwordToggle" aria-label="<?php echo __('Show password'); ?>">
                                <svg id="eyeIcon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10 4C6 4 3.73 6.11 2 9.5C3.73 12.89 6 15 10 15C14 15 16.27 12.89 18 9.5C16.27 6.11 14 4 10 4Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <circle cx="10" cy="9.5" r="2.5" stroke="currentColor" stroke-width="1.5"/>
                                </svg>
                                <svg id="eyeOffIcon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                    <path d="M2 2L18 18M8.88 8.88C8.3 9.46 8 10.22 8 11C8 12.66 9.34 14 11 14C11.78 14 12.54 13.7 13.12 13.12M14.71 14.71C13.5 15.53 11.85 16 10 16C6 16 3.73 13.89 2 10.5C2.64 9.19 3.5 8.06 4.5 7.19M7.53 7.53C7.19 7.87 7 8.41 7 9C7 10.66 8.34 12 10 12C10.59 12 11.13 11.81 11.47 11.47" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="lpb-login-actions">
                        <button type="submit" class="btn-signin"><span data-i18n="signInBtn"><?php echo __('Sign In'); ?></span></button>
<?php if ($suggest_pwreset) { ?>
                        <a class="lpb-forgot-link" href="pwreset.php"><span data-i18n="forgotPassword"><?php echo __('Forgot My Password'); ?></span></a>
<?php } ?>
                    </div>
                    <div class="lpb-login-secondary">
<?php
$ext_bks = array();
foreach (UserAuthenticationBackend::allRegistered() as $bk)
    if ($bk instanceof ExternalAuthentication)
        $ext_bks[] = $bk;

if (count($ext_bks)) {
    foreach ($ext_bks as $bk) { ?>
                        <div class="external-auth"><?php $bk->renderExternalLink(); ?></div><?php
    }
}
if ($cfg && $cfg->isClientRegistrationEnabled()) {
    if (count($ext_bks)) echo '<hr class="lpb-login-divider"/>';
?>
                        <div class="register-link">
                            <span data-i18n="notYetRegistered"><?php echo __('Not yet registered?'); ?></span>
                            <a href="account.php?do=create"><span data-i18n="createAccount"><?php echo __('Create an account'); ?></span></a>
                        </div>
<?php } ?>
                    </div>
                    </div>
                </div>
                </form>

