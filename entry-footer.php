<footer class="entry-footer">
    <span class="cat-links">
        <?php esc_html_e('Categories: ', 'simplyblankslate');
        the_category(', '); ?>
    </span>
    <span class="tag-links">
        <?php the_tags(); ?>
    </span>
    <?php if(comments_open()) { ?>
        <span class="meta-sep">|</span>
        <span class="comments-link">
            <a href="<?php echo esc_url(get_comments_link()); ?>">
                <?php echo sprintf(esc_html__('Comments', 'simplyblankslate')); ?>
            </a>
        </span>
    <?php } ?>
</footer> 