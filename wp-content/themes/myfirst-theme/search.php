<?php get_header(); ?>

    <div id="content">
        <?php if ( have_posts() ) : ?>
            <h2 id="search-title">검색결과</h2>
            <?php while ( have_posts() ) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <div class="page-header">
                        <h1 class="h2"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
                    </div>
                    <section class="post_content">
                        <?php the_excerpt(); ?>
                    </section> <!-- close article section -->
                </article>
            <?php endwhile; ?>
        <?php else : ?>
            <h2>검색결과가 없습니다.</h2>
        <?php endif; ?>
    </div><!--close content-->

<?php get_sidebar(); ?>
    <div class="clear"></div>

<?php get_footer(); ?>