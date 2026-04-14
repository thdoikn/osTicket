<?php
/*********************************************************************
    open.php

    New tickets handle.

    Peter Rotich <peter@osticket.com>
    Copyright (c)  2006-2013 osTicket
    http://www.osticket.com

    Released under the GNU General Public License WITHOUT ANY WARRANTY.
    See LICENSE.TXT for details.

    vim: expandtab sw=4 ts=4 sts=4:
*********************************************************************/
require('client.inc.php');
define('SOURCE', 'Web'); // Ticket source.
$ticket = null;
$errors = array();
if ($_POST) {
    $vars = $_POST;
    $vars['deptId'] = $vars['emailId'] = 0; // Just Making sure we don't accept crap...only topicId is expected.
    if ($thisclient) {
        $vars['uid'] = $thisclient->getId();
    } elseif ($cfg->isCaptchaEnabled()) {
        if (!$_POST['captcha']) {
            $errors['captcha'] = __('Enter text shown on the image');
        } elseif (strcmp($_SESSION['captcha'], md5(strtoupper($_POST['captcha'])))) {
            $errors['captcha'] = sprintf('%s - %s', __('Invalid'), __('Please try again!'));
        }
    }

    $tform = TicketForm::objects()->one()->getForm($vars);
    $messageField = $tform->getField('message');
    $attachments = $messageField->getWidget()->getAttachments();
    if (!$errors) {
        $vars['message'] = $messageField->getClean();
        if ($messageField->isAttachmentsEnabled()) {
            $vars['files'] = $attachments->getFiles();
        }
    }

    // Drop the draft.. If there are validation errors, the content
    // submitted will be displayed back to the user
    Draft::deleteForNamespace('ticket.client.' . substr(session_id(), -12));
    // Ticket::create...checks for errors..
    if (($ticket = Ticket::create($vars, $errors, SOURCE))) {
        $msg = __('Support ticket request created');
        // Drop session-backed form data
        unset($_SESSION[':form-data']);
        // Logged in...simply view the newly created ticket.
        if ($thisclient && $thisclient->isValid()) {
            // Regenerate session id
            $thisclient->regenerateSession();
            @header('Location: tickets.php?id=' . $ticket->getId());
        } else {
            $ost->getCSRF()->rotate();
        }
    } else {
        $errors['err'] = $errors['err'] ?: sprintf(
            '%s %s',
            __('Unable to create a ticket.'),
            __('Correct any errors below and try again.')
        );
    }
}

// page
$nav->setActiveNav('new');
if ($cfg->isClientLoginRequired()) {
    if ($cfg->getClientRegistrationMode() == 'disabled') {
        Http::redirect('view.php');
    } elseif (!$thisclient) {
        require_once 'secure.inc.php';
    } elseif ($thisclient->isGuest()) {
        require_once 'login.php';
        exit();
    }
}

$lpb_asset = ROOT_PATH . 'assets/lapor-pak-bas/';
$signin_url = ROOT_PATH . 'login.php'
    . ($thisclient ? '?e=' . urlencode($thisclient->getEmail()) : '');
$signout_url = ROOT_PATH . 'logout.php?auth=' . $ost->getLinkToken();
$client_logged_in = $thisclient && $thisclient->isValid() && !$thisclient->isGuest();
$lpb_active = 'open';
$title = ($cfg && $cfg->getTitle())
    ? $cfg->getTitle() . ' — ' . __('Open a New Ticket')
    : __('Open a New Ticket');

require CLIENTINC_DIR . 'lpb-form-head.inc.php';
require CLIENTINC_DIR . 'lpb-chrome-header.inc.php';

if ($ost->getError()) {
    echo sprintf('<div class="lpb-alert lpb-alert-error">%s</div>', $ost->getError());
} elseif ($ost->getWarning()) {
    echo sprintf('<div class="lpb-alert lpb-alert-warning">%s</div>', $ost->getWarning());
} elseif ($ost->getNotice()) {
    echo sprintf('<div class="lpb-alert lpb-alert-notice">%s</div>', $ost->getNotice());
}

if ($ticket
    && (
        (($topic = $ticket->getTopic()) && ($page = $topic->getPage()))
        || ($page = $cfg->getThankYouPage())
    )
) {
    echo '<main class="create-ticket-main"><div class="create-ticket-container"><div class="content-wrapper lpb-thankyou">';
    if (!empty($msg)) {
        echo '<div class="lpb-alert lpb-alert-success" role="status">', $msg, '</div>';
    }
    echo Format::viewableImages(
        $ticket->replaceVars(
            $page->getLocalBody()
        ),
        array('type' => 'P')
    );
    echo '</div></div></main>';
} else {
    define('LPB_OPEN_STANDALONE', true);
    require CLIENTINC_DIR . 'open.inc.php';
}

require CLIENTINC_DIR . 'lpb-chrome-footer.inc.php';
require CLIENTINC_DIR . 'lpb-form-foot.inc.php';
