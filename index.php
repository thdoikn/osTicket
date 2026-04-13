<?php
/*********************************************************************
    index.php — Lapor Pak Bas landing (visual only; logic remains osTicket)
*********************************************************************/
require('client.inc.php');

$lpb_asset = ROOT_PATH . 'assets/lapor-pak-bas/';
$page_title = ($cfg && is_object($cfg) && $cfg->getTitle())
    ? $cfg->getTitle()
    : 'osTicket :: ' . __('Support Ticket System');

$signin_url = ROOT_PATH . 'login.php'
    . ($thisclient ? '?e=' . urlencode($thisclient->getEmail()) : '');
$signout_url = ROOT_PATH . 'logout.php?auth=' . $ost->getLinkToken();

$client_logged_in = $thisclient && $thisclient->isValid() && !$thisclient->isGuest();

/** International digits only, e.g. 6281112345678. Leave empty until official line is known. */
$lpb_whatsapp_number = '';
$lpb_whatsapp_url = $lpb_whatsapp_number !== ''
    ? 'https://wa.me/' . preg_replace('/\D+/', '', $lpb_whatsapp_number)
    : '';
?>
<!DOCTYPE html>
<html lang="id" id="htmlLang">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo Format::htmlchars($page_title); ?></title>
    <link rel="stylesheet" href="<?php echo Format::htmlchars($lpb_asset); ?>style.css">
</head>
<body>
    <header class="header">
        <div class="header-container">
            <div class="header-left">
                <div class="logo">
                    <img src="<?php echo Format::htmlchars($lpb_asset); ?>asset/logo.png" alt="" class="logo-img">
                </div>
            </div>
            <div class="header-center">
                <nav class="header-nav">
                    <a href="<?php echo Format::htmlchars(ROOT_PATH); ?>index.php" class="nav-link" data-i18n="navHome">Beranda</a>
                    <a href="<?php echo Format::htmlchars(ROOT_PATH); ?>open.php" class="nav-link" data-i18n="navReport">Lapor</a>
                    <div class="nav-dropdown">
                        <a href="<?php echo Format::htmlchars(ROOT_PATH); ?>view.php" class="nav-link" data-i18n="navCheckStatus">Cek Status Laporan</a>
                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3 4.5 L6 7.5 L9 4.5" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                </nav>
            </div>
            <div class="header-right">
<?php if ($client_logged_in) { ?>
                <span class="nav-link"><?php echo Format::htmlchars($thisclient->getName()); ?></span>
                <a href="<?php echo Format::htmlchars(ROOT_PATH); ?>profile.php" class="nav-link"><?php echo __('Profile'); ?></a>
                <a href="<?php echo Format::htmlchars(ROOT_PATH); ?>tickets.php" class="nav-link"><?php
                    echo sprintf(__('Tickets (%d)'), $thisclient->getNumTickets()); ?></a>
                <a href="<?php echo Format::htmlchars($signout_url); ?>" class="nav-link login-link"><?php echo __('Sign Out'); ?></a>
<?php } else { ?>
                <a href="<?php echo Format::htmlchars($signin_url); ?>" class="nav-link login-link" data-i18n="navLogin">Masuk</a>
<?php } ?>
                <div class="language-selector" id="languageSelector">
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="9" cy="9" r="7" stroke="white" stroke-width="1.5"/>
                        <path d="M9 2 C11 4, 13 6, 9 9 C5 6, 7 4, 9 2" fill="white"/>
                        <path d="M9 9 C11 11, 13 13, 9 16 C5 13, 7 11, 9 9" fill="white"/>
                    </svg>
                    <span id="currentLang">IDN</span>
                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3 4.5 L6 7.5 L9 4.5" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
            </div>
        </div>
    </header>

    <main class="hero-section">
        <div class="hero-background">
            <div class="hero-overlay"></div>
        </div>
        <div class="hero-content">
            <h1 class="hero-title" data-i18n="title">Selamat datang di Lapor Pak Bas</h1>
            <p class="hero-description" data-i18n="description">
                Website Lapor Pak Bas merupakan platform pelaporan digital yang dirancang untuk mendukung transparansi, respons cepat, dan akuntabilitas dalam penanganan keluhan serta pengaduan masyarakat di wilayah Ibu Kota Nusantara (IKN). Sistem ini menyediakan mekanisme pelaporan yang mudah, terstandar, dan terintegrasi dengan unit terkait di Otorita IKN, sehingga setiap laporan dapat ditindaklanjuti secara efektif berdasarkan kategori permasalahan, lokasi kejadian, dan urgensi penanganan.
            </p>
            <div class="hero-buttons">
                <a href="<?php echo Format::htmlchars(ROOT_PATH); ?>open.php" class="btn-primary" data-i18n="btnNewTicket">Buat Tiket Baru</a>
                <a href="<?php echo Format::htmlchars(ROOT_PATH); ?>view.php" class="btn-secondary" data-i18n="btnCheckTicket">Periksa Status Tiket</a>
            </div>
        </div>
        <footer class="hero-footer">
            <p>&copy;<?php echo date('Y'); ?> Humas Otorita IKN - Setyar</p>
        </footer>
    </main>

    <section class="faq-section">
        <div class="faq-container">
            <h2 class="faq-title" data-i18n="faqTitle">Soal Sering Ditanya (SSD)</h2>
            <div class="faq-list">
                <div class="faq-item active">
                    <div class="faq-question">
                        <span data-i18n="faqQ1">Bagaimana cara memulai laporan?</span>
                        <svg class="faq-icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 7.5 L10 12.5 L15 7.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div class="faq-answer">
                        <p data-i18n="faqA1">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <span data-i18n="faqQ2">Bagaimana cara membuat akun?</span>
                        <svg class="faq-icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 7.5 L10 12.5 L15 7.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div class="faq-answer">
                        <p data-i18n="faqA2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <span data-i18n="faqQ3">Saya lupa kata sandi akun saya, bagaimana cara melakukan reset kata sandi?</span>
                        <svg class="faq-icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 7.5 L10 12.5 L15 7.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div class="faq-answer">
                        <p data-i18n="faqA3">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <span data-i18n="faqQ4">Apa arti nomor tiket?</span>
                        <svg class="faq-icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 7.5 L10 12.5 L15 7.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div class="faq-answer">
                        <p data-i18n="faqA4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <span data-i18n="faqQ5">Bagaimana cara mendapatkan nomor tiket saya?</span>
                        <svg class="faq-icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 7.5 L10 12.5 L15 7.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div class="faq-answer">
                        <p data-i18n="faqA5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="whatsapp-section">
        <div class="whatsapp-background">
            <img src="<?php echo Format::htmlchars($lpb_asset); ?>asset/whatsapp-bg.png" alt="" class="whatsapp-bg-img">
            <div class="whatsapp-overlay"></div>
        </div>
        <div class="whatsapp-content">
            <h2 class="whatsapp-title" data-i18n="waTitle">Anda juga bisa melaporkan lewat WhatsApp</h2>
            <p class="whatsapp-description" data-i18n="waDesc">
                Anda dapat melaporkan keluhan atau pengaduan melalui WhatsApp ke Otorita Ibu Kota Nusantara. Laporan yang masuk akan diteruskan kepada Kepala OIKN untuk ditindaklanjuti.
            </p>
            <a class="btn-whatsapp" href="<?php echo $lpb_whatsapp_url ? Format::htmlchars($lpb_whatsapp_url) : '#'; ?>"
                <?php if (!$lpb_whatsapp_url) { ?>id="lpb-wa-placeholder" title="<?php echo Format::htmlchars('WhatsApp belum dikonfigurasi — isi $lpb_whatsapp_number di index.php'); ?>"<?php }
                else { ?>target="_blank" rel="noopener noreferrer"<?php } ?>
            >
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" fill="#25D366"/>
                </svg>
                <span data-i18n="waButton">Mulai Lapor di WhatsApp</span>
            </a>
        </div>
    </section>

    <footer class="main-footer">
        <div class="footer-pattern-top"></div>
        <div class="footer-container">
            <div class="footer-column footer-logo">
                <div class="footer-logo-section">
                    <img src="<?php echo Format::htmlchars($lpb_asset); ?>asset/logo1.png" alt="" class="footer-logo-img">
                </div>
                <div class="footer-address">
                    <p class="footer-address-item">
                        Kantor Nusantara Balai Kota/City Hall, Ibu Kota Nusantara, Pemaluan, Kec. Sepaku, Kabupaten Penajam Paser Utara, Kalimantan Timur (76147)
                    </p>
                    <p class="footer-address-item">
                        Kantor Jakarta Menara Mandiri II Lantai 5, Jalan Jenderal Sudirman Kav 54-55, Senayan, Jakarta Selatan, Jakarta (12190)
                    </p>
                </div>
            </div>
            <div class="footer-column footer-nav">
                <h3 class="footer-title" data-i18n="footerNav">Navigasi</h3>
                <ul class="footer-links">
                    <li><a href="<?php echo Format::htmlchars(ROOT_PATH); ?>index.php" data-i18n="navHome">Beranda</a></li>
                    <li><a href="<?php echo Format::htmlchars(ROOT_PATH); ?>open.php" data-i18n="navReport">Lapor</a></li>
                    <li><a href="<?php echo Format::htmlchars(ROOT_PATH); ?>view.php" data-i18n="navCheckStatus">Cek Status Laporan</a></li>
                </ul>
            </div>
            <div class="footer-column footer-links-column">
                <h3 class="footer-title" data-i18n="footerLinks">Pranala</h3>
                <ul class="footer-links">
                    <li><a href="#" data-i18n="linkOfficial">Situs Resmi IKN</a></li>
                    <li><a href="#" data-i18n="linkMonitoring">Monitoring Proyek IKN</a></li>
                    <li><a href="#" data-i18n="linkInvestment">Investasi</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-pattern-bottom"></div>
    </footer>

    <script>
        const translations = {
            id: {
                title: "Selamat datang di Lapor Pak Bas",
                description: "Website Lapor Pak Bas merupakan platform pelaporan digital yang dirancang untuk mendukung transparansi, respons cepat, dan akuntabilitas dalam penanganan keluhan serta pengaduan masyarakat di wilayah Ibu Kota Nusantara (IKN). Sistem ini menyediakan mekanisme pelaporan yang mudah, terstandar, dan terintegrasi dengan unit terkait di Otorita IKN, sehingga setiap laporan dapat ditindaklanjuti secara efektif berdasarkan kategori permasalahan, lokasi kejadian, dan urgensi penanganan.",
                btnNewTicket: "Buat Tiket Baru",
                btnCheckTicket: "Periksa Status Tiket",
                navHome: "Beranda",
                navReport: "Lapor",
                navCheckStatus: "Cek Status Laporan",
                navLogin: "Masuk",
                faqTitle: "Soal Sering Ditanya (SSD)",
                faqQ1: "Bagaimana cara memulai laporan?",
                faqA1: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
                faqQ2: "Bagaimana cara membuat akun?",
                faqA2: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
                faqQ3: "Saya lupa kata sandi akun saya, bagaimana cara melakukan reset kata sandi?",
                faqA3: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
                faqQ4: "Apa arti nomor tiket?",
                faqA4: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
                faqQ5: "Bagaimana cara mendapatkan nomor tiket saya?",
                faqA5: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
                waTitle: "Anda juga bisa melaporkan lewat WhatsApp",
                waDesc: "Anda dapat melaporkan keluhan atau pengaduan melalui WhatsApp ke Otorita Ibu Kota Nusantara. Laporan yang masuk akan diteruskan kepada Kepala OIKN untuk ditindaklanjuti.",
                waButton: "Mulai Lapor di WhatsApp",
                footerNav: "Navigasi",
                footerLinks: "Pranala",
                linkOfficial: "Situs Resmi IKN",
                linkMonitoring: "Monitoring Proyek IKN",
                linkInvestment: "Investasi"
            },
            en: {
                title: "Welcome to Lapor Pak Bas",
                description: "The Lapor Pak Bas website is a digital reporting platform designed to enhance transparency, rapid response, and accountability in addressing public complaints and issues within the Nusantara Capital City (IKN) area. The system provides a streamlined, standardized, and integrated reporting mechanism that connects directly to relevant units within the Nusantara Capital Authority, enabling every report to be handled effectively based on issue category, incident location, and response priority.",
                btnNewTicket: "Create New Ticket",
                btnCheckTicket: "Check Ticket Status",
                navHome: "Home",
                navReport: "Report",
                navCheckStatus: "Check Report Status",
                navLogin: "Login",
                faqTitle: "Frequently Asked Questions (FAQ)",
                faqQ1: "How to start a report?",
                faqA1: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
                faqQ2: "How to create an account?",
                faqA2: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
                faqQ3: "I forgot my account password, how do I reset it?",
                faqA3: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
                faqQ4: "What does a ticket number mean?",
                faqA4: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
                faqQ5: "How do I get my ticket number?",
                faqA5: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
                waTitle: "You can also report via WhatsApp",
                waDesc: "You can report complaints or issues through WhatsApp to the Nusantara Capital Authority. Reports received will be forwarded to the Head of OIKN for follow-up.",
                waButton: "Start Reporting on WhatsApp",
                footerNav: "Navigation",
                footerLinks: "Links",
                linkOfficial: "Official IKN Site",
                linkMonitoring: "IKN Project Monitoring",
                linkInvestment: "Investment"
            }
        };

        let currentLang = localStorage.getItem('language') || 'id';

        function changeLanguage(lang) {
            currentLang = lang;
            localStorage.setItem('language', lang);
            document.getElementById('htmlLang').setAttribute('lang', lang);
            document.getElementById('currentLang').textContent = lang === 'id' ? 'IDN' : 'ENG';
            document.querySelectorAll('[data-i18n]').forEach(function (element) {
                var key = element.getAttribute('data-i18n');
                if (translations[lang] && translations[lang][key]) {
                    element.textContent = translations[lang][key];
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function () {
            changeLanguage(currentLang);
            document.getElementById('languageSelector').addEventListener('click', function () {
                changeLanguage(currentLang === 'id' ? 'en' : 'id');
            });
            document.querySelectorAll('.faq-question').forEach(function (question) {
                question.addEventListener('click', function () {
                    var faqItem = this.parentElement;
                    var isActive = faqItem.classList.contains('active');
                    document.querySelectorAll('.faq-item').forEach(function (item) {
                        item.classList.remove('active');
                    });
                    if (!isActive) {
                        faqItem.classList.add('active');
                    }
                });
            });
            var wa = document.getElementById('lpb-wa-placeholder');
            if (wa) {
                wa.addEventListener('click', function (e) {
                    e.preventDefault();
                });
            }
        });
    </script>
</body>
</html>
