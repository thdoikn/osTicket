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
            breadcrumbOpen: 'Buat Tiket Baru',
            openPageTitle: 'Buat Tiket Baru',
            openPageDesc: 'Silahkan mengisi form dibawah untuk membuat tiket Laporan yang baru',
            btnCreateTicket: 'Kirim Laporan',
            btnReset: 'Reset',
            btnCancel: 'Batal'
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
            breadcrumbOpen: 'Open a New Ticket',
            openPageTitle: 'Open a New Ticket',
            openPageDesc: 'Please fill in the form below to open a new ticket.',
            btnCreateTicket: 'Create Ticket',
            btnReset: 'Reset',
            btnCancel: 'Cancel'
        }
    };
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
        document.querySelectorAll('[data-i18n]').forEach(function (element) {
            var key = element.getAttribute('data-i18n');
            if (translations[lang] && translations[lang][key]) {
                element.textContent = translations[lang][key];
            }
        });
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
