<div class="post-card-style-6 card card3_style" style="background-image: url('<?php echo esc_url(wp_get_attachment_url(get_post_thumbnail_id())); ?>'); background-size: contain; background-repeat: no-repeat;">

    <div class="card-info-hover">

        <div class="card-clock-info">
            <?php
			if ($settings['show_meta_data'] == "yes") {
                if (in_array('date', $settings['meta_data'])) { ?>
                    <span class="card-time"><?php echo get_the_date('d M, Y'); ?></span>
                    <?php 
                }
            } ?>
        </div>

    </div>

    <div class="card-img" style="background-image: url('<?php echo esc_url(wp_get_attachment_url(get_post_thumbnail_id())); ?>');"></div>

    <a href="<?php the_permalink(); ?>" class="card-link">
        <div class="card-img-hover"></div>
    </a>

    <div class="card-info post-content post_bg">
        <div class="card-category card_meta post-card_category">
            <a class="category "><?php echo wp_kses_post(post_card_posted_categories()); ?></a>
        </div>
        <?php
        if (isset($settings['show_title']) && $settings['show_title'] == 'yes') {
            $title_tag = sanitize_text_field($settings['title_tag']);
            if ($title_tag == 'h1' || $title_tag == 'h2' || $title_tag == 'h3' || $title_tag == 'h4' || $title_tag == 'h5' || $title_tag == 'h6' || $title_tag == 'div' ||  $title_tag == 'span' ||  $title_tag == 'p') {
                $tag = $title_tag;
            } else {
                $tag = 'h2';
            }
            ?>
            <<?php echo esc_attr($tag); ?> class="card-title card_title ">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </<?php echo esc_attr($tag); ?>>
            <?php } ?>
		<?php
            if (isset($settings['show_excerpt']) && $settings['show_excerpt'] == 'yes') {
                if ($settings['excerpt_from'] == 'content') {
                    $content = get_the_content();
                } else if ($settings['excerpt_from'] == 'excerpt') {
                    $content = get_the_excerpt();
                } else {
                    $content = get_the_content();
                }
                if ($settings['show_read_more'] == "yes") {
                    $read_more = '<a href="' . esc_url(get_permalink()) . '" rel="bookmark" class="entry-read-more post-card_read-more">' . ' &nbsp;' . $settings['read_more_text'] . '</a>';
                } else {
                    $read_more = "";
                }
                ?> 
                <p class="description post-card_excerpt post-card-alignment">
                    <?php echo wp_kses_post(wp_trim_words($content, $settings['excerpt_length'], $read_more));
                    ?>
                </p>
            <?php } ?> 
        <div class="card-by">
            <div class="card-author card_aling">
                <?php
				if ($settings['show_meta_data'] == "yes") {
                if (in_array('author', $settings['meta_data'])) {
                    post_card_posted_by();
                }
                if (in_array('comments', $settings['meta_data'])) {
                    post_card_comment_count();
                }
                if (in_array('tags', $settings['meta_data'])) {
                    post_card_posted_tag();
                }
				}
                ?>
            </div>
        </div>
    </div>
</div>
