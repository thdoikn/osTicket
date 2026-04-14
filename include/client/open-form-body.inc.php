<?php
if (!defined('OSTCLIENTINC')) {
    die('Access Denied!');
}
$lpb_form_outer_class = !empty($lpb_open_standalone) ? 'create-ticket-form' : '';
?>
            <form id="ticketForm"<?php if ($lpb_form_outer_class) { ?> class="<?php echo Format::htmlchars($lpb_form_outer_class); ?>"<?php } ?> method="post" action="open.php" enctype="multipart/form-data">
                <?php csrf_token(); ?>
                <input type="hidden" name="a" value="open">
                <table class="lpb-open-table" cellpadding="0" cellspacing="0" border="0" width="100%">
                    <tbody>
<?php
if (!$thisclient) { ?>
                        <tr class="lpb-form-section-heading">
                            <td colspan="2"><h3 class="form-section-title"><?php echo __('User Information'); ?></h3></td>
                        </tr>
<?php
    $uform = UserForm::getUserForm()->getForm($_POST);
    if ($_POST) {
        $uform->isValid();
    }
    $uform->render(array('staff' => false, 'mode' => 'create'));
} else { ?>
                        <tr><td colspan="2"><hr /></td></tr>
                        <tr><td><?php echo __('Email'); ?>:</td><td><?php
                            echo $thisclient->getEmail(); ?></td></tr>
                        <tr><td><?php echo __('Client'); ?>:</td><td><?php
                            echo Format::htmlchars($thisclient->getName()); ?></td></tr>
<?php } ?>
                    </tbody>
                    <tbody>
                        <tr><td colspan="2"><hr /></td></tr>
                        <tr>
                            <td colspan="2" style="padding-top:10px;">
                                <div class="form-header" style="margin-bottom:0.5em">
                                    <label for="topicId">
                                        <span class="required"><b><?php echo __('Help Topic'); ?></b><span class="error">*</span></span>
                                        <br/>
                                        <select id="topicId" name="topicId" onchange="javascript:
                    var data = $(':input[name]', '#dynamic-form').serialize();
                    $.ajax(
                      'ajax.php/form/help-topic/' + this.value,
                      {
                        data: data,
                        dataType: 'json',
                        success: function(json) {
                          $('#dynamic-form').empty().append(json.html);
                          $(document.head).append(json.media);
                        }
                      });">
                                            <option value="" selected="selected">&mdash; <?php echo __('Select a Help Topic'); ?> &mdash;</option>
                                            <?php
                                            if ($topics = Topic::getPublicHelpTopics()) {
                                                foreach ($topics as $id => $name) {
                                                    echo sprintf(
                                                        '<option value="%d" %s>%s</option>',
                                                        $id,
                                                        ($info['topicId'] == $id) ? 'selected="selected"' : '',
                                                        $name
                                                    );
                                                }
                                            } ?>
                                        </select>
                                    </label>
                                    <?php
                                    if (!empty($errors['topicId'])) { ?>
                                        <div class="error"><?php echo Format::htmlchars($errors['topicId']); ?></div>
                                    <?php } ?>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                    <tbody id="dynamic-form">
                        <?php
                        $options = array('mode' => 'create');
                        foreach ($forms as $form) {
                            include CLIENTINC_DIR . 'templates/dynamic-form.tmpl.php';
                        } ?>
                    </tbody>
                    <tbody>
                        <?php
                        if ($cfg && $cfg->isCaptchaEnabled() && (!$thisclient || !$thisclient->isValid())) {
                            if ($_POST && $errors && !$errors['captcha']) {
                                $errors['captcha'] = __('Please re-enter the text again');
                            }
                            ?>
                        <tr class="captchaRow">
                            <td class="required"><?php echo __('CAPTCHA Text'); ?>:</td>
                            <td>
                                <span class="captcha"><img src="captcha.php" border="0" align="left" alt=""></span>
                                &nbsp;&nbsp;
                                <input id="captcha" type="text" name="captcha" size="6" autocomplete="off">
                                <em><?php echo __('Enter the text shown on the image.'); ?></em>
                                <font class="error">*&nbsp;<?php echo $errors['captcha']; ?></font>
                            </td>
                        </tr>
                            <?php
                        } ?>
                        <tr><td colspan="2">&nbsp;</td></tr>
                    </tbody>
                </table>
                <div class="form-submit-section lpb-form-actions">
                    <button type="submit" class="btn-submit-report">
                        <span data-i18n="btnCreateTicket">Kirim Laporan</span>
                    </button>
                    <button type="reset" name="reset" class="lpb-btn-secondary">
                        <span data-i18n="btnReset">Reset</span>
                    </button>
                    <button type="button" name="cancel" class="lpb-btn-cancel" onclick="javascript:
            $('.richtext').each(function() {
                var redactor = $(this).data('redactor');
                if (redactor && redactor.opts.draftDelete)
                    redactor.plugin.draft.deleteDraft();
            });
            window.location.href='index.php';">
                        <span data-i18n="btnCancel">Batal</span>
                    </button>
                </div>
            </form>
