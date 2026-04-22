<?php
/*********************************************************************
    profile.php

    Manage client profile. This will allow a logged-in user to manage
    his/her own public (non-internal) information

    Peter Rotich <peter@osticket.com>
    Jared Hancock <jared@osticket.com>
    Copyright (c)  2006-2013 osTicket
    http://www.osticket.com

    Released under the GNU General Public License WITHOUT ANY WARRANTY.
    See LICENSE.TXT for details.

    vim: expandtab sw=4 ts=4 sts=4:
    $Id: $
**********************************************************************/
require 'secure.inc.php';

require_once 'class.user.php';

// Check if User is Guest. If so, redirect them back to ticket page to
// prevent Account Takeover.
if ($thisclient->isGuest()) {
    Http::redirect('tickets.php');
}

$errors = array();
$user = User::lookup($thisclient->getId());

if ($user && $_POST) {
    if ($acct = $thisclient->getAccount()) {
        $acct->update($_POST, $errors);
    }
    if (!$errors && $user->updateInfo($_POST, $errors)) {
        Http::redirect('tickets.php');
    }
}

$lpb_asset = ROOT_PATH . 'assets/lapor-pak-bas/';
$signin_url = ROOT_PATH . 'login.php'
    . ($thisclient ? '?e=' . urlencode($thisclient->getEmail()) : '');
$signout_url = ROOT_PATH . 'logout.php?auth=' . $ost->getLinkToken();
$client_logged_in = $thisclient && $thisclient->isValid() && !$thisclient->isGuest();
$lpb_active = 'profile';
$title = ($cfg && $cfg->getTitle())
    ? $cfg->getTitle() . ' — ' . __('Manage Your Profile Information')
    : __('Manage Your Profile Information');

require CLIENTINC_DIR . 'lpb-form-head.inc.php';
require CLIENTINC_DIR . 'lpb-chrome-header.inc.php';

require CLIENTINC_DIR . 'lpb-profile-page.inc.php';

require CLIENTINC_DIR . 'lpb-chrome-footer.inc.php';
require CLIENTINC_DIR . 'lpb-form-foot.inc.php';
