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
            navProfile: 'Profil',
            navTickets: 'Tiket',
            navSignOut: 'Keluar',
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
            threadEditedBadge: 'Disunting',
            breadcrumbProfile: 'Profil',
            profilePageTitle: 'Kelola Informasi Profil Anda',
            profilePageDesc: 'Gunakan formulir di bawah untuk memperbarui informasi akun yang kami simpan.',
            profileBtnUpdate: 'Perbarui',
            sectionPreferences: 'Preferensi',
            sectionCredentials: 'Kredensial akses',
            labelTimezone: 'Zona waktu:',
            labelPreferredLanguage: 'Bahasa pilihan:',
            profileUseBrowserPreference: '— Gunakan preferensi peramban —',
            profileLabelCurrentPassword: 'Kata sandi saat ini:',
            profileLabelNewPassword: 'Kata sandi baru:',
            profileLabelConfirmNewPassword: 'Konfirmasi kata sandi baru:',
            fieldPhoneExt: 'Ekst'
        },
        en: {
            navHome: 'Home',
            navReport: 'Report',
            navCheckStatus: 'Check Report Status',
            navLogin: 'Login',
            navProfile: 'Profile',
            navTickets: 'Tickets',
            navSignOut: 'Sign Out',
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
            threadEditedBadge: 'Edited',
            breadcrumbProfile: 'Profile',
            profilePageTitle: 'Manage Your Profile Information',
            profilePageDesc: 'Use the forms below to update the information we have on file for your account.',
            profileBtnUpdate: 'Update',
            sectionPreferences: 'Preferences',
            sectionCredentials: 'Access Credentials',
            labelTimezone: 'Time Zone:',
            labelPreferredLanguage: 'Preferred Language:',
            profileUseBrowserPreference: '— Use Browser Preference —',
            profileLabelCurrentPassword: 'Current Password:',
            profileLabelNewPassword: 'New Password:',
            profileLabelConfirmNewPassword: 'Confirm New Password:',
            fieldPhoneExt: 'Ext'
        }
    };
    var registerFields = {
        id: {
            email: 'Alamat email',
            name: 'Nama lengkap',
            phone: 'Nomor telepon',
            notes: 'Catatan',
            subject: 'Subjek',
            address: 'Alamat',
            company: 'Perusahaan'
        },
        en: {
            email: 'Email Address',
            name: 'Full Name',
            phone: 'Phone Number',
            notes: 'Notes',
            subject: 'Subject',
            address: 'Address',
            company: 'Company'
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
        var rf = registerFields[lang] || registerFields.id;
        document.querySelectorAll('[data-i18n-field]').forEach(function (element) {
            var fn = element.getAttribute('data-i18n-field');
            if (fn && rf[fn]) {
                element.textContent = rf[fn];
            }
        });
        document.querySelectorAll('.lpb-bilingual').forEach(function (element) {
            var idt = element.getAttribute('data-id');
            var ent = element.getAttribute('data-en');
            if (idt !== null && ent !== null) {
                element.textContent = lang === 'id' ? idt : ent;
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
