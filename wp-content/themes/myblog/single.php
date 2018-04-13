<!Doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ) ?>">
    <link rel="profile" href="gmpg.org/xfn/11">
	<?php wp_head() ?>
</head>
<body <?php body_class(); ?>>
-------이것은 single.php-----------
<div class="jb-container">
	<?php get_header() ?>
    <div class="jb-content">
        <?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post(); ?>
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <ul>
                <li>Author : <?php the_author(); ?></li>
                <li>Date : <?php echo get_the_date(); ?> <?php echo get_the_time(); ?></li>
                <li>Category : <?php the_category( ', ' ); ?></li>
				<?php if ( has_tag() ) : ?>
                    <li>Tag : <?php the_tags( '', ' ', '' ); ?></li>
				<?php endif; ?>
            </ul>
			<?php the_content(); ?>
			<?php
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
			?>
		<?php endwhile; ?>
		<?php endif; ?>
    </div>
	<?php get_sidebar() ?>
    <div class="jb-footer">
        <p>Copyright © <?php bloginfo( 'name' ); ?>All Right Reserved.</p>
    </div>
</div>
<?php wp_footer() ?>
</body>

</html>
