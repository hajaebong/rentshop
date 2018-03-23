<?php get_header(); ?>

    <div id="content">
        <?php if ( have_posts() ) : ?>

            <?php while ( have_posts() ) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <div class="page-header">
                        <h1 class="h2"><?php the_title(); ?></h1>
                    </div>
                    <div class="content-widget">
                        <?php dynamic_sidebar('content-widgets'); ?>
                    </div>
                    <section class="post_content">
                        <?php the_content( ); ?>
                    </section> <!-- close article section -->
                    <div class="post-meta-data">
                        <span class="tag-links"><?php the_tags('태그: ', ', ', '<br />'); ?></span>
                        카테고리: <span class="cat-links"><?php the_category(', ') ?></span> |
                        <span class="comments-popup-link"><?php comments_popup_link('댓글 없음 &#187;', '1 댓글 &#187;', '% 댓글 &#187;'); ?></span>
                        <span class="edit-post-link"><?php edit_post_link( __( '편집' )); ?></span>
                    </div>
                </article>
                <?php comments_template(); ?>
            <?php endwhile; ?>
        <?php else : ?>
            <h2>컨텐츠가 없습니다.</h2>
        <?php endif; ?>
    </div><!--close content-->

<?php get_sidebar(); ?>
    <div class="clear"></div>

<?php get_footer(); ?>