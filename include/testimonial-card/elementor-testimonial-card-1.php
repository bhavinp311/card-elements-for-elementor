<!-- Start Testimonial Card 1 -->
<div class="testimonial-card-style-1">
    <div class="item">
        <div class="feedback">
            <div class="bg-color elementor-content-background-color-wrapper">
                <p class="testimonial-description elementor-testimonial-description-wrapper">
                    <?php echo esc_attr($settings['testimonial_description']); ?>
                </p>
                <span class="testimonial-box-shape elementor-content-background-color-wrapper"></span>
            </div>
            <div class="iq-mt-30">
                <div class="iq-avtar iq-mr-20">
                    <img src="<?php echo esc_url($settings['profile_image']['url']); ?>" class="img-fluid center-block img img-responsive">
                </div>
                <div class="avtar-name">
                    <div class="testimonial-name elementor-testimonial-name-wrapper iq-lead iq-mb-0 iq-tw-6 iq-font-green"><?php echo esc_attr($settings['name']); ?></div>
                    <div class="testimonial-position elementor-testimonial-position-wrapper"><?php echo esc_attr($settings['position']); ?></div>
                    <div class="elementor-star-rating__wrapper">
                        <?php if (!empty($settings['title'])) : ?>
                            <div class="elementor-star-rating__title"><?php echo esc_attr($settings['title']); ?></div>
                        <?php endif; ?>
                        <?php echo wp_kses_post($stars_element); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Testimonial Card -->