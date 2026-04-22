<?php
if (!isset($errors) || !is_array($errors)) {
    $errors = array();
}
?>
<div class="lpb-register-wrap">
<form action="<?php echo Format::htmlchars(ROOT_PATH); ?>profile.php" method="post" class="lpb-register-form">
  <?php csrf_token(); ?>
<table width="100%" class="padded">
<?php
foreach ($user->getForms() as $f) {
    $f->render(['staff' => false]);
}
?>
</table>
<?php
if ($acct = $thisclient->getAccount()) {
    $info = $acct->getInfo();
    $info = Format::htmlchars(($errors && $_POST) ? $_POST : $info);
?>
<table width="100%" class="padded lpb-profile-settings-table">
<colgroup>
    <col class="lpb-profile-col-label">
    <col class="lpb-profile-col-value">
</colgroup>
<tr>
    <td colspan="2">
        <div><hr><h3><span data-i18n="sectionPreferences">Preferensi</span></h3>
        </div>
    </td>
</tr>
<tr>
    <td>
        <span data-i18n="labelTimezone">Zona waktu:</span>
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
<?php if ($cfg->getSecondaryLanguages()) { ?>
<tr>
    <td>
        <span data-i18n="labelPreferredLanguage">Bahasa pilihan:</span>
    </td>
    <td>
<?php
    $langs = Internationalization::getConfiguredSystemLanguages(); ?>
        <select name="lang">
            <option value="" data-i18n="profileUseBrowserPreference">&mdash; Gunakan preferensi peramban &mdash;</option>
<?php foreach ($langs as $l) {
    $selected = ($info['lang'] == $l['code']) ? 'selected="selected"' : ''; ?>
            <option value="<?php echo $l['code']; ?>" <?php echo $selected;
                ?>><?php echo Internationalization::getLanguageDescription($l['code']); ?></option>
<?php } ?>
        </select>
        <span class="error">&nbsp;<?php echo $errors['lang']; ?></span>
    </td>
</tr>
<?php }
    if ($acct->isPasswdResetEnabled()) { ?>
<tr>
    <td colspan="2">
        <div><hr><h3><span data-i18n="sectionCredentials">Kredensial akses</span></h3></div>
    </td>
</tr>
<?php if (!isset($_SESSION['_client']['reset-token'])) { ?>
<tr>
    <td>
        <span data-i18n="profileLabelCurrentPassword">Kata sandi saat ini:</span>
    </td>
    <td>
        <input type="password" size="18" name="cpasswd" maxlength="128" value="<?php echo $info['cpasswd']; ?>">
        &nbsp;<span class="error">&nbsp;<?php echo $errors['cpasswd']; ?></span>
    </td>
</tr>
<?php } ?>
<tr>
    <td>
        <span data-i18n="profileLabelNewPassword">Kata sandi baru:</span>
    </td>
    <td>
        <input type="password" size="18" name="passwd1" maxlength="128" value="<?php echo $info['passwd1']; ?>">
        &nbsp;<span class="error">&nbsp;<?php echo $errors['passwd1']; ?></span>
    </td>
</tr>
<tr>
    <td>
        <span data-i18n="profileLabelConfirmNewPassword">Konfirmasi kata sandi baru:</span>
    </td>
    <td>
        <input type="password" size="18" name="passwd2" maxlength="128" value="<?php echo $info['passwd2']; ?>">
        &nbsp;<span class="error">&nbsp;<?php echo $errors['passwd2']; ?></span>
    </td>
</tr>
<?php } ?>
</table>
<?php } ?>
<hr>
<p class="lpb-register-actions">
    <input type="submit" data-i18n-value="profileBtnUpdate" value="Perbarui"/>
    <input type="reset" data-i18n-value="btnReset" value="Reset"/>
    <input type="button" data-i18n-value="btnCancel" value="Batal" onclick="javascript:
        window.location.href='<?php echo Format::htmlchars(ROOT_PATH); ?>index.php';"/>
</p>
</form>
</div>
