<footer class="footer">
    <div class="footer-top">
        <a href="<?=BASE_URL?>catalog.php" class="footer-item">Каталог</a>
        <?php if(isset($_SESSION['id'])):?>
        <a href="<?=BASE_URL?>settings.php" class="footer-item">Личный кабинет</a>
        <?php else:?>
        <a href="<?=BASE_URL?>authorization.php" class="footer-item">Личный кабинет</a>
        <?php endif;?>
    </div>
    <div class="footer-bottom">
        <p class="footer__copyright">Разработал я )</p>
        <div class="footer-socials">
            <a href="https://vk.com/ediciussss"   target="_blank" class="footer-socials__item">
                <img
                    src="/assets/img/static/VK_BW_Compact_Logo.png"
                    alt="vk" />
            </a>
        </div>
    </div>
</footer>