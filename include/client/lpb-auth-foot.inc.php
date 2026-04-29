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
        echo $lang; ?>/js<?php echo Format::asset_cache_qs(); ?>"></script>
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
            checkStatusTitle: 'Cek Status',
            checkStatusTitle2: 'Laporan',
            checkStatusDescVerify: 'Masukkan alamat email dan nomor tiket. Tautan akses akan dikirim ke email Anda.',
            checkStatusDescDirect: 'Masukkan E-mail yang anda gunakan saat membuat laporan dan nomor tiket laporan yang telah diberikan.',
            emailLabel: 'Email',
            ticketNumberLabel: 'No. Tiket Laporan',
            emailPlaceholder: 'Masukkan Email',
            ticketNumberPlaceholder: 'Masukkan Nomor Tiket Laporan',
            viewReportBtn: 'Lihat Laporan',
            wantToCreate: 'Ingin membuat Laporan?',
            createReportLink1: 'Ayo membuat',
            createReportLink2: 'Laporan',
            welcome: 'Selamat',
            welcome2: 'Datang',
            welcomeDesc: 'Terima kasih telah berkontribusi. Masuk untuk melanjutkan.',
            authAccessTitle: 'Cek',
            authAccessTitle2: 'Status',
            authAccessDesc: 'Masukkan email dan nomor tiket untuk melanjutkan.',
            accessIntroVerify: 'Masukkan alamat email dan nomor tiket. Tautan akses akan dikirim ke email Anda.',
            accessIntroDirect: 'Masukkan alamat email dan nomor tiket untuk masuk dan melihat tiket Anda.',
            registerTitle: 'Daftar',
            registerTitle2: 'Akun',
            registerThanksTitle: 'Terima',
            registerThanksTitle2: 'Kasih',
            signInBtn: 'Masuk',
            toggleShowPassword: 'Tampilkan sandi',
            toggleHidePassword: 'Sembunyikan sandi',
            loginDefaultTitle: 'Masuk',
            loginDefaultBody: 'Untuk melayani Anda lebih baik, kami menyarankan mendaftar akun dan memverifikasi alamat email yang tercatat.',
            labelEmailOrUser: 'Email atau nama pengguna',
            labelPassword: 'Kata sandi',
            phEmailOrUser: 'Email atau nama pengguna',
            phPassword: 'Kata sandi',
            forgotPassword: 'Lupa kata sandi',
            notYetRegistered: 'Belum punya akun?',
            createAccount: 'Buat akun',
            imAgent: 'Saya agen',
            agentDash: ' — ',
            agentSignIn: 'masuk di sini',
            loginFooterTicketBefore: 'Jika ini pertama kali menghubungi kami atau Anda kehilangan nomor tiket, silakan ',
            loginFooterTicketLink: 'buka tiket baru',
            loginFooterTicketAfter: '.',
            labelEmailAddress: 'Alamat email',
            labelTicketNumber: 'Nomor tiket',
            phEmailExample: 'contoh: nama@domain.com',
            phTicketExample: 'contoh: 051243',
            accessBtnEmailLink: 'Lihat Laporan',
            accessBtnViewTicket: 'Lihat tiket',
            accessHaveAccount: 'Sudah punya akun?',
            accessRegisterBeforeLink: 'atau',
            accessRegisterAfterLink: ' untuk mengakses semua tiket Anda.',
            registerIntro: 'Gunakan formulir di bawah untuk membuat atau memperbarui informasi akun Anda.',
            sectionPreferences: 'Preferensi',
            sectionCredentials: 'Kredensial akses',
            labelTimezone: 'Zona waktu:',
            labelLoginWith: 'Masuk dengan:',
            labelCreatePassword: 'Buat kata sandi:',
            labelConfirmPassword: 'Konfirmasi kata sandi:',
            registerBtn: 'Daftar',
            cancelBtn: 'Batal',
            timezoneAutoDetect: 'Deteksi otomatis',
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
            checkStatusTitle: 'Check Status',
            checkStatusTitle2: 'Report',
            checkStatusDescVerify: 'Enter your email address and ticket number. An access link will be emailed to you.',
            checkStatusDescDirect: 'Enter the email you used when creating the report and the report ticket number provided.',
            emailLabel: 'Email',
            ticketNumberLabel: 'Report Ticket No.',
            emailPlaceholder: 'Enter Email',
            ticketNumberPlaceholder: 'Enter Report Ticket Number',
            viewReportBtn: 'View Report',
            wantToCreate: 'Want to create a Report?',
            createReportLink1: 'Let\'s create a',
            createReportLink2: 'Report',
            welcome: 'Welcome',
            welcome2: 'Back',
            welcomeDesc: 'Thank you for contributing. Sign in to continue.',
            authAccessTitle: 'Check',
            authAccessTitle2: 'Status',
            authAccessDesc: 'Enter your email and ticket number to continue.',
            accessIntroVerify: 'Enter your email address and ticket number. An access link will be emailed to you.',
            accessIntroDirect: 'Enter your email address and ticket number to sign in and view your ticket.',
            registerTitle: 'Create',
            registerTitle2: 'Account',
            registerThanksTitle: 'Thank',
            registerThanksTitle2: 'You',
            signInBtn: 'Sign In',
            toggleShowPassword: 'Show password',
            toggleHidePassword: 'Hide password',
            loginDefaultTitle: 'Sign In',
            loginDefaultBody: 'To better serve you, we encourage our clients to register for an account and verify the email address we have on record.',
            labelEmailOrUser: 'Email or Username',
            labelPassword: 'Password',
            phEmailOrUser: 'Email or Username',
            phPassword: 'Password',
            forgotPassword: 'Forgot My Password',
            notYetRegistered: 'Not yet registered?',
            createAccount: 'Create an account',
            imAgent: 'I\'m an agent',
            agentDash: ' — ',
            agentSignIn: 'sign in here',
            loginFooterTicketBefore: 'If this is your first time contacting us or you\'ve lost the ticket number, please ',
            loginFooterTicketLink: 'open a new ticket',
            loginFooterTicketAfter: '.',
            labelEmailAddress: 'Email Address',
            labelTicketNumber: 'Ticket Number',
            phEmailExample: 'e.g. john.doe@osticket.com',
            phTicketExample: 'e.g. 051243',
            accessBtnEmailLink: 'View Report',
            accessBtnViewTicket: 'View Ticket',
            accessHaveAccount: 'Have an account with us?',
            accessRegisterBeforeLink: 'or',
            accessRegisterAfterLink: ' to access all your tickets.',
            registerIntro: 'Use the forms below to create or update the information we have on file for your account',
            sectionPreferences: 'Preferences',
            sectionCredentials: 'Access Credentials',
            labelTimezone: 'Time Zone:',
            labelLoginWith: 'Login With:',
            labelCreatePassword: 'Create a Password:',
            labelConfirmPassword: 'Confirm New Password:',
            registerBtn: 'Register',
            cancelBtn: 'Cancel',
            timezoneAutoDetect: 'Auto Detect',
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
        document.querySelectorAll('[data-i18n-placeholder]').forEach(function (element) {
            var key = element.getAttribute('data-i18n-placeholder');
            if (pack[key]) {
                element.setAttribute('placeholder', pack[key]);
            }
        });
        document.querySelectorAll('[data-i18n-value]').forEach(function (element) {
            var key = element.getAttribute('data-i18n-value');
            if (pack[key]) {
                element.setAttribute('value', pack[key]);
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
    }
    document.addEventListener('DOMContentLoaded', function () {
        changeLanguage(currentLang);
        var sel = document.getElementById('languageSelector');
        if (sel) {
            sel.addEventListener('click', function () {
                changeLanguage(currentLang === 'id' ? 'en' : 'id');
            });
        }
        var pwd = document.getElementById('passwd');
        var toggle = document.getElementById('passwordToggle');
        if (pwd && toggle) {
            var eye = document.getElementById('eyeIcon');
            var eyeOff = document.getElementById('eyeOffIcon');
            toggle.addEventListener('click', function () {
                var show = pwd.getAttribute('type') === 'password';
                pwd.setAttribute('type', show ? 'text' : 'password');
                if (eye) eye.style.display = show ? 'none' : '';
                if (eyeOff) eyeOff.style.display = show ? '' : 'none';
                var lang = localStorage.getItem('language') || 'id';
                var t = translations[lang] || translations.id;
                toggle.setAttribute('aria-label', show ? (t.toggleHidePassword || 'Hide') : (t.toggleShowPassword || 'Show'));
            });
        }
    });
})();
</script>
</body>
</html>
