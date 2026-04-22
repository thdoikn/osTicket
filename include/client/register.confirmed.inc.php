<?php if ($content) {
    list($tplTitle, $body) = $ost->replaceTemplateVariables(
        array($content->getName(), $content->getBody())); ?>
                <a href="<?php echo Format::htmlchars(ROOT_PATH); ?>index.php" class="breadcrumb-link">
                    <svg class="breadcrumb-icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.5 15 L7.5 10 L12.5 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span data-i18n="backHome">Kembali ke Beranda</span>
                </a>
                <div class="welcome-section">
                    <h1 class="welcome-title">
                        <span data-i18n="registerThanksTitle">Terima</span>
                        <span class="welcome-title-accent" data-i18n="registerThanksTitle2">Kasih</span>
                    </h1>
                </div>
                <div class="lpb-register-confirm-body">
                    <h2 class="welcome-title lpb-register-confirm-cms-title"><?php echo Format::display($tplTitle); ?></h2>
                    <p><?php echo Format::display($body); ?></p>
                </div>
<?php } else { ?>
                <a href="<?php echo Format::htmlchars(ROOT_PATH); ?>index.php" class="breadcrumb-link">
                    <svg class="breadcrumb-icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.5 15 L7.5 10 L12.5 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span data-i18n="backHome">Kembali ke Beranda</span>
                </a>
                <div class="welcome-section">
                    <h1 class="welcome-title">
                        <span data-i18n="registerThanksTitle">Terima</span>
                        <span class="welcome-title-accent" data-i18n="registerThanksTitle2">Kasih</span>
                    </h1>
                </div>
                <div class="lpb-register-confirm-body">
                    <p>
                        <strong><?php echo __('Thanks for registering for an account.'); ?></strong>
                    </p>
                    <p><?php echo __(
"You've confirmed your email address and successfully activated your account.  You may proceed to check on previously opened tickets or open a new ticket."
); ?></p>
                    <p><em><?php echo __('Your friendly support center'); ?></em></p>
                </div>
<?php } ?>
