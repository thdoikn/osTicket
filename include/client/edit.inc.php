<?php

if (!defined('OSTCLIENTINC') || !$thisclient || !$ticket || !$ticket->checkUserAccess($thisclient)) {
    die('Access Denied!');
}

?>

<?php if (defined('LPB_TICKET_SHELL') && LPB_TICKET_SHELL) { ?>
<div class="lpb-ticket-breadcrumb">
    <a href="<?php echo Format::htmlchars(ROOT_PATH); ?>index.php" class="breadcrumb-link">
        <svg class="breadcrumb-icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12.5 15 L7.5 10 L12.5 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <span data-i18n="backHome">Kembali ke Beranda</span>
    </a>
    <div class="breadcrumb-path">
        <span data-i18n="navHome">Beranda</span>
        <span class="breadcrumb-separator">/</span>
        <span data-i18n="breadcrumbReportStatus">Status Laporan</span>
    </div>
</div>
<main class="lpb-ticket-detail-main"><div class="lpb-ticket-detail-inner lpb-ticket-detail-inner--edit">
<?php } ?>

<h1>
<?php
if (defined('LPB_TICKET_SHELL') && LPB_TICKET_SHELL) { ?>
    <span data-i18n="ticketEditingTitle">Mengedit Tiket</span> #<?php echo Format::htmlchars($ticket->getNumber()); ?>
<?php
} else {
    echo sprintf(__('Editing Ticket #%s'), $ticket->getNumber());
} ?>
</h1>

<form action="tickets.php" method="post">
    <?php echo csrf_token(); ?>
    <input type="hidden" name="a" value="edit"/>
    <input type="hidden" name="id" value="<?php echo Format::htmlchars($_REQUEST['id']); ?>"/>
<table width="800">
    <tbody id="dynamic-form">
    <?php if ($forms) {
        foreach ($forms as $form) {
            $form->render(array('staff' => false));
        }
    } ?>
    </tbody>
</table>
<hr>
<p style="text-align: center;">
    <input type="submit" <?php
    if (defined('LPB_TICKET_SHELL') && LPB_TICKET_SHELL) {
        ?>data-i18n-value="ticketBtnUpdate" value="Perbarui"<?php
    } else {
        ?>value="<?php echo __('Update'); ?>"<?php
    }
    ?>/>
    <input type="reset" <?php
    if (defined('LPB_TICKET_SHELL') && LPB_TICKET_SHELL) {
        ?>data-i18n-value="btnReset" value="Reset"<?php
    } else {
        ?>value="<?php echo __('Reset'); ?>"<?php
    }
    ?>/>
    <input type="button" <?php
    if (defined('LPB_TICKET_SHELL') && LPB_TICKET_SHELL) {
        ?>data-i18n-value="btnCancel" value="Batal"<?php
    } else {
        ?>value="<?php echo __('Cancel'); ?>"<?php
    }
    ?> onclick="javascript:
        window.location.href='index.php';"/>
</p>
</form>

<?php if (defined('LPB_TICKET_SHELL') && LPB_TICKET_SHELL) { ?>
</div></main>
<?php } ?>
