<?php
if (!defined('OSTCLIENTINC')) {
    die('Access Denied!');
}
$info = array();
if ($thisclient && $thisclient->isValid()) {
    $info = array(
        'name' => $thisclient->getName(),
        'email' => $thisclient->getEmail(),
        'phone' => $thisclient->getPhoneNumber(),
    );
}

$info = ($_POST && $errors) ? Format::htmlchars($_POST) : $info;

$form = null;
if (!$info['topicId']) {
    if (array_key_exists('topicId', $_GET) && preg_match('/^\d+$/', $_GET['topicId']) && Topic::lookup($_GET['topicId'])) {
        $info['topicId'] = intval($_GET['topicId']);
    } else {
        $info['topicId'] = $cfg->getDefaultTopicId();
    }
}

$forms = array();
if ($info['topicId'] && ($topic = Topic::lookup($info['topicId']))) {
    foreach ($topic->getForms() as $F) {
        if (!$F->hasAnyVisibleFields()) {
            continue;
        }
        if ($_POST) {
            $F = $F->instanciate();
            $F->isValidForClient();
        }
        $forms[] = $F->getForm();
    }
}

$lpb_open_standalone = defined('LPB_OPEN_STANDALONE') && LPB_OPEN_STANDALONE;

if ($lpb_open_standalone) {
    ?>
<main class="create-ticket-main">
    <div class="create-ticket-container">
        <div class="content-wrapper">
            <div class="breadcrumb-section">
                <a href="<?php echo Format::htmlchars(ROOT_PATH); ?>index.php" class="breadcrumb-link">
                    <svg class="breadcrumb-icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.5 15 L7.5 10 L12.5 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    ← <span data-i18n="backHome">Kembali ke Beranda</span>
                </a>
                <div class="breadcrumb-path">
                    <span data-i18n="navHome">Beranda</span>
                    <span class="breadcrumb-separator">/</span>
                    <span data-i18n="breadcrumbOpen">Buat Tiket Baru</span>
                </div>
            </div>
            <div class="create-ticket-title-section">
                <h1 class="create-ticket-title">
                    <span data-i18n="openPageTitle">Buat Tiket Baru</span>
                </h1>
                <p class="create-ticket-description" data-i18n="openPageDesc">Silahkan mengisi form dibawah untuk membuat tiket Laporan yang baru</p>
            </div>
        </div>
<?php if (!empty($errors['err'])) { ?>
        <div class="content-wrapper">
            <div class="lpb-open-error" role="alert"><?php echo Format::htmlchars($errors['err']); ?></div>
        </div>
<?php } ?>
        <div class="content-wrapper">
    <?php include CLIENTINC_DIR . 'open-form-body.inc.php'; ?>
        </div>
    </div>
</main>
<?php
} else {
    ?>
<h1><?php echo __('Open a New Ticket'); ?></h1>
<p><?php echo __('Please fill in the form below to open a new ticket.'); ?></p>
    <?php include CLIENTINC_DIR . 'open-form-body.inc.php';
}
