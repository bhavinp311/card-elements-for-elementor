<!-- Start Testimonial Card 2 -->
<div class="testimonial-card-style-2">
    <div class="item">
        <div class="media">
            <div class="media-left">
                <img src="<?php echo esc_url($settings['profile_image']['url']); ?>" class="img-fluid center-block img img-responsive">
            </div>
            <div class="media-body">
                <div class="media-heading iq-ml-10">
                    <p class="testimonial-description elementor-testimonial-description-wrapper">
                        <?php echo esc_attr($settings['testimonial_description']); ?>
                    </p>
                    <div class="blog">
                        <div class="testimonial-name elementor-testimonial-name-wrapper name"><?php echo esc_attr($settings['name']); ?></div>
                        <span class="testimonial-position elementor-testimonial-position-wrapper"><?php echo esc_attr($settings['position']); ?></span>
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
</div>
<!-- End Testimonial Card -->