<div class="entry-content">
    <?php if(has_post_thumbnail()) { ?>
        <a href="<?php echo wp_get_attachment_image_url(get_post_thumbnail_id($post->ID), 'full', false); ?>" title="<?php the_title_attribute(); ?>">
            <?php the_post_thumbnail(); ?>
        </a>
    <?php }
    the_content(); ?>
    <div class="entry-links">
        <?php wp_link_pages(); ?>
    </div>
</div>