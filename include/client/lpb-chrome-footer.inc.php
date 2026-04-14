<?php
if (!defined('OSTCLIENTINC')) {
    die('Access Denied');
}
if (!isset($lpb_asset)) {
    $lpb_asset = ROOT_PATH . 'assets/lapor-pak-bas/';
}
?>
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
