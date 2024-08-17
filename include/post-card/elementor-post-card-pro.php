<!-- Start Post Card pro -->
<?php
$colum = $settings['post_card_columns'];
for($i=0; $i<$colum; $i++){
?>
<div class="post-card-style-pro text-center">
    <a href="https://1.envato.market/CEPE" target="_blank"><img src="<?php echo esc_url(CARD_ELEMENTS_ELEMENTOR_URL); ?>images/banner-pro.png" alt="<?php echo esc_html__('Card Elements Pro for Elementor', 'card-elements-for-elementor'); ?>"></a>
    <h6 class="buy-suggest"><?php echo esc_html__('Get the access of all power packed Design, Premium Support and much more.', 'card-elements-for-elementor'); ?> <a href="https://1.envato.market/CEPE" target="_blank" class="buy-link"><?php echo esc_html__('BUY PREMIUM VERSION', 'card-elements-for-elementor'); ?></a> <?php esc_html__('Today', 'card-elements-for-elementor'); ?>.</h6>
    <button class="live-preview"><a class="preview-link" href="https://demo.techeshta.com/elementor/card-elements/post-card/" target="_blank"><?php echo esc_html__('Live Preview', 'card-elements-for-elementor'); ?></a></button>
</div>
<?php } ?>
<!-- End Post Card -->
