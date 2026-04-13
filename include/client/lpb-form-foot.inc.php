<?php
if (!defined('OSTCLIENTINC')) {
    die('Access Denied');
}
?>
<div id="overlay"></div>
<div id="loading">
    <h4><?php echo __('Please Wait!'); ?></h4>
    <p><?php echo __('Please wait... it will take a second!'); ?></p>
</div>
<?php
if (($lang = Internationalization::getCurrentLanguage()) && $lang != 'en_US') { ?>
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>ajax.php/i18n/<?php
        echo $lang; ?>/js"></script>
<?php } ?>
<script type="text/javascript">
    getConfig().resolve(<?php
    include INCLUDE_DIR . 'ajax.config.php';
    $api = new ConfigAjaxAPI();
    print $api->client(false);
    ?>);
</script>
<script>
(function () {
    var translations = {
        id: {
            navHome: 'Beranda',
            navReport: 'Lapor',
            navCheckStatus: 'Cek Status Laporan',
            navLogin: 'Masuk',
            footerNav: 'Navigasi',
            footerLinks: 'Pranala',
            linkOfficial: 'Situs Resmi IKN',
            linkMonitoring: 'Monitoring Proyek IKN',
            linkInvestment: 'Investasi',
            backHome: 'Kembali ke Beranda',
            breadcrumbReportStatus: 'Status Laporan',
            breadcrumbOpen: 'Buat Tiket Baru',
            openPageTitle: 'Buat Tiket Baru',
            openPageDesc: 'Silahkan mengisi form dibawah untuk membuat tiket Laporan yang baru',
            btnCreateTicket: 'Kirim Laporan',
            btnReset: 'Reset',
            btnCancel: 'Batal',
            ticketSectionBasic: 'Informasi Dasar Tiket',
            ticketSectionUser: 'Informasi Pengguna',
            ticketLabelStatus: 'Status tiket',
            ticketLabelDepartment: 'Departemen',
            ticketLabelCreateDate: 'Tanggal dibuat',
            ticketLabelName: 'Nama',
            ticketLabelEmail: 'Email',
            ticketLabelPhone: 'Telepon',
            ticketBtnPrint: 'Cetak',
            ticketBtnEdit: 'Ubah',
            ticketBtnReloadTitle: 'Muat ulang',
            ticketTitlePostReply: 'Balas',
            ticketHintReply: 'Untuk membantu Anda, harap berikan rincian yang spesifik.',
            ticketBannerReopen: 'Tiket akan dibuka kembali saat pesan dikirim.',
            ticketBtnPostReply: 'Kirim Balasan',
            ticketGuestLead: 'Mencari tiket lainnya?',
            ticketGuestSignIn: 'Masuk',
            ticketGuestOr: 'atau',
            ticketGuestRegister: 'daftar',
            ticketGuestTail: 'untuk pengalaman terbaik di helpdesk kami.',
            ticketEditingTitle: 'Mengedit Tiket',
            ticketBtnUpdate: 'Perbarui',
            threadPostedVerb: 'mengirim',
            threadEditedBadge: 'Disunting'
        },
        en: {
            navHome: 'Home',
            navReport: 'Report',
            navCheckStatus: 'Check Report Status',
            navLogin: 'Login',
            footerNav: 'Navigation',
            footerLinks: 'Links',
            linkOfficial: 'Official IKN Site',
            linkMonitoring: 'IKN Project Monitoring',
            linkInvestment: 'Investment',
            backHome: 'Back to Home',
            breadcrumbReportStatus: 'Report status',
            breadcrumbOpen: 'Open a New Ticket',
            openPageTitle: 'Open a New Ticket',
            openPageDesc: 'Please fill in the form below to open a new ticket.',
            btnCreateTicket: 'Create Ticket',
            btnReset: 'Reset',
            btnCancel: 'Cancel',
            ticketSectionBasic: 'Basic Ticket Information',
            ticketSectionUser: 'User Information',
            ticketLabelStatus: 'Ticket Status',
            ticketLabelDepartment: 'Department',
            ticketLabelCreateDate: 'Create Date',
            ticketLabelName: 'Name',
            ticketLabelEmail: 'Email',
            ticketLabelPhone: 'Phone',
            ticketBtnPrint: 'Print',
            ticketBtnEdit: 'Edit',
            ticketBtnReloadTitle: 'Reload',
            ticketTitlePostReply: 'Post a Reply',
            ticketHintReply: 'To best assist you, we request that you be specific and detailed.',
            ticketBannerReopen: 'Ticket will be reopened on message post',
            ticketBtnPostReply: 'Post Reply',
            ticketGuestLead: 'Looking for your other tickets?',
            ticketGuestSignIn: 'Sign In',
            ticketGuestOr: 'or',
            ticketGuestRegister: 'register for an account',
            ticketGuestTail: 'for the best experience on our help desk.',
            ticketEditingTitle: 'Editing Ticket',
            ticketBtnUpdate: 'Update',
            threadPostedVerb: 'posted',
            threadEditedBadge: 'Edited'
        }
    };

    /**
     * Best-effort substring replacement for thread event lines (English phrases from server).
     * Reverses when switching back using paired maps; server HTML is canonical in data-lpb-orig.
     */
    function lpbLocalizeTicketThreadEvents(lang) {
        var container = document.getElementById('ticketThread');
        if (!container) {
            return;
        }
        var selectors = '.thread-event .description';
        var nodes = container.querySelectorAll(selectors);
        var pairsToId = [
            ['Created by', 'Dibuat oleh'],
            ['Updated by', 'Diperbarui oleh'],
            ['Edited on', 'Disunting pada']
        ];
        nodes.forEach(function (el) {
            if (!el.getAttribute('data-lpb-orig-html')) {
                el.setAttribute('data-lpb-orig-html', el.innerHTML);
            }
            var base = el.getAttribute('data-lpb-orig-html');
            var html = base;
            if (lang === 'id') {
                pairsToId.forEach(function (p) {
                    html = html.split(p[0]).join(p[1]);
                });
            }
            el.innerHTML = html;
        });
    }

    var currentLang = localStorage.getItem('language') || 'id';
    function changeLanguage(lang) {
        currentLang = lang;
        localStorage.setItem('language', lang);
        var root = document.getElementById('htmlLang');
        if (root) {
            root.setAttribute('lang', lang === 'id' ? 'id' : 'en');
        }
        var cur = document.getElementById('currentLang');
        if (cur) {
            cur.textContent = lang === 'id' ? 'IDN' : 'ENG';
        }
        var pack = translations[lang] || translations.id;
        document.querySelectorAll('[data-i18n]').forEach(function (element) {
            var key = element.getAttribute('data-i18n');
            if (pack[key]) {
                element.textContent = pack[key];
            }
        });
        document.querySelectorAll('[data-i18n-value]').forEach(function (element) {
            var key = element.getAttribute('data-i18n-value');
            if (pack[key]) {
                element.setAttribute('value', pack[key]);
            }
        });
        document.querySelectorAll('[data-i18n-title]').forEach(function (element) {
            var key = element.getAttribute('data-i18n-title');
            if (pack[key]) {
                element.setAttribute('title', pack[key]);
            }
        });
        document.querySelectorAll('[data-i18n-placeholder]').forEach(function (element) {
            var key = element.getAttribute('data-i18n-placeholder');
            if (pack[key]) {
                element.setAttribute('placeholder', pack[key]);
            }
        });
        lpbLocalizeTicketThreadEvents(lang);
    }
    document.addEventListener('DOMContentLoaded', function () {
        changeLanguage(currentLang);
        var sel = document.getElementById('languageSelector');
        if (sel) {
            sel.addEventListener('click', function () {
                changeLanguage(currentLang === 'id' ? 'en' : 'id');
            });
        }
    });
})();
</script>
</body>
</html>
