<?php
if (!defined('OSTCLIENTINC')) die('Access Denied');

$info = $_POST;
if (!isset($info['timezone']))
    $info += array(
        'backend' => null,
    );
if (isset($user) && $user instanceof ClientCreateRequest) {
    $bk = $user->getBackend();
    $info = array_merge($info, array(
        'backend' => $bk->getBkId(),
        'username' => $user->getUsername(),
    ));
}
$info = Format::htmlchars(($errors && $_POST)?$_POST:$info);

?>
                <a href="<?php echo Format::htmlchars(ROOT_PATH); ?>index.php" class="breadcrumb-link">
                    <svg class="breadcrumb-icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.5 15 L7.5 10 L12.5 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span data-i18n="backHome">Kembali ke Beranda</span>
                </a>

                <div class="welcome-section">
                    <h1 class="welcome-title">
                        <span data-i18n="registerTitle">Daftar</span>
                        <span class="welcome-title-accent" data-i18n="registerTitle2">Akun</span>
                    </h1>
                    <p class="welcome-description"><span data-i18n="registerIntro"><?php echo __(
'Use the forms below to create or update the information we have on file for your account'
); ?></span></p>
                </div>

<?php if (!empty($errors['err'])) { ?>
                <div class="lpb-auth-error" role="alert"><?php echo Format::htmlchars($errors['err']); ?></div>
<?php } ?>

                <div class="lpb-register-wrap">
<form action="account.php" method="post" class="lpb-register-form">
  <?php csrf_token(); ?>
  <input type="hidden" name="do" value="<?php echo Format::htmlchars($_REQUEST['do']
    ?: ($info['backend'] ? 'import' :'create')); ?>" />
<table width="800" class="padded">
<tbody>
<?php
    $GLOBALS['lpb_client_dynamic_form_i18n'] = true;
    $cf = $user_form ?: UserForm::getInstance();
    $cf->render(array('staff' => false, 'mode' => 'create'));
    unset($GLOBALS['lpb_client_dynamic_form_i18n']);
?>
<tr>
    <td colspan="2">
        <div><hr><h3 data-i18n="sectionPreferences"><?php echo __('Preferences'); ?></h3>
        </div>
    </td>
</tr>
    <tr>
        <td width="180">
            <span data-i18n="labelTimezone"><?php echo __('Time Zone');?>:</span>
        </td>
        <td>
            <?php
            $TZ_NAME = 'timezone';
            $TZ_TIMEZONE = $info['timezone'];
            $GLOBALS['lpb_auth_timezone_i18n'] = true;
            include INCLUDE_DIR.'staff/templates/timezone.tmpl.php';
            unset($GLOBALS['lpb_auth_timezone_i18n']); ?>
            <div class="error"><?php echo $errors['timezone']; ?></div>
        </td>
    </tr>
<tr>
    <td colspan="2">
        <div><hr><h3 data-i18n="sectionCredentials"><?php echo __('Access Credentials'); ?></h3></div>
    </td>
</tr>
<?php if ($info['backend']) { ?>
<tr>
    <td width="180">
        <span data-i18n="labelLoginWith"><?php echo __('Login With'); ?>:</span>
    </td>
    <td>
        <input type="hidden" name="backend" value="<?php echo $info['backend']; ?>"/>
        <input type="hidden" name="username" value="<?php echo $info['username']; ?>"/>
<?php foreach (UserAuthenticationBackend::allRegistered() as $bk) {
    if ($bk->getBkId() == $info['backend']) {
        echo $bk->getName();
        break;
    }
} ?>
    </td>
</tr>
<?php } else { ?>
<tr>
    <td width="180">
        <span data-i18n="labelCreatePassword"><?php echo __('Create a Password'); ?>:</span>
    </td>
    <td>
        <input type="password" size="18" name="passwd1" maxlength="128" value="<?php echo $info['passwd1']; ?>">
        &nbsp;<span class="error">&nbsp;<?php echo $errors['passwd1']; ?></span>
    </td>
</tr>
<tr>
    <td width="180">
        <span data-i18n="labelConfirmPassword"><?php echo __('Confirm New Password'); ?>:</span>
    </td>
    <td>
        <input type="password" size="18" name="passwd2" maxlength="128" value="<?php echo $info['passwd2']; ?>">
        &nbsp;<span class="error">&nbsp;<?php echo $errors['passwd2']; ?></span>
    </td>
</tr>
<?php } ?>
</tbody>
</table>
<hr>
<p class="lpb-register-actions">
    <input type="submit" data-i18n-value="registerBtn" value="<?php echo __('Register'); ?>"/>
    <input type="button" data-i18n-value="cancelBtn" value="<?php echo __('Cancel'); ?>" onclick="javascript:
        window.location.href='index.php';"/>
</p>
</form>
                </div>

<?php if (!isset($info['timezone'])) { ?>
<!-- Auto detect client's timezone where possible -->
<script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/jstz.min.js"></script>
<script type="text/javascript">
$(function() {
    var zone = jstz.determine();
    $('#timezone-dropdown').val(zone.name()).trigger('change');
});
</script>
<?php }
