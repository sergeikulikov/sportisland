<?php
get_header();
if ( is_home() ):
	?>

    <main class="main-content">
        <h1 class="sr-only">Страница категорий блога на сайте спорт-клуба SportIsland</h1>
        <div class="wrapper">
			<?php get_template_part( 'tmp/breadcrumbs' ); ?>
        </div>
		<?php
		if ( have_posts() ):
			?>
            <section class="last-posts">
                <div class="wrapper">
                    <h2 class="main-heading last-posts__h"> последние записи </h2>
                    <ul class="posts-list">
						<?php
						while ( have_posts() ):
							the_post();
							?>
                            <li class="last-post">
                                <a href="<?php the_permalink(); ?>" class="last-post__link"
                                   aria-label="Читать текст статьи: <?php the_title(); ?>">
                                    <figure class="last-post__thumb">
										<?php the_post_thumbnail( 'post-thumbnail', [ 'class' => 'last-post__img' ] ); ?>
                                    </figure>
                                    <div class="last-post__wrap">
                                        <h3 class="last-post__h"><?php the_title(); ?></h3>
                                        <p class="last-post__text"><?php echo get_the_excerpt(); ?></p>
                                        <span class="last-post__more link-more">Подробнее</span>
                                    </div>
                                </a>
                            </li>
						<?php endwhile; ?>
                    </ul>
                </div>
            </section>
		<?php
		else:
			get_template_part( 'tmp/no-posts' );
		endif;
		$cats = get_categories();
		if ( $cats ):
			?>
            <section class="categories">
                <div class="wrapper">
                    <h2 class="categories__h main-heading"> категории </h2>
                    <ul class="categories-list">
						<?php foreach ( $cats as $cat ):
							$cat_link = get_category_link( $cat->cat_ID );
							$img = get_field( 'cat_thumb', 'category_' . $cat->cat_ID );
							$img_url = $img['url'];
							$img_alt = $img['alt'];
							?>
                            <li class="category">
                                <a href="<?php echo $cat_link; ?>" class="category__link">
                                    <img src="<?php echo $img_url; ?>" alt="<?php echo $img_alt; ?>"
                                         class="category__thumb">
                                    <span class="category__name"><?php echo $cat->name; ?></span>
                                </a>
                            </li>
						<?php endforeach; ?>
                    </ul>
                </div>
            </section>
		<?php endif; ?>
    </main>
<?php
else:
	?>
    <main class="main-content">
        <h1 class="sr-only">Страница на сайте спорт-клуба SportIsland</h1>
        <div class="wrapper">
			<?php get_template_part( 'tmp/breadcrumbs' ); ?>
        </div>
		<?php
		if ( have_posts() ):
			?>
            <section class="last-posts">
                <div class="wrapper">
                    <h2 class="main-heading last-posts__h">Записи </h2>
                    <ul class="posts-list">
						<?php
						while ( have_posts() ):
							the_post();
							?>
                            <li class="last-post">
                                <a href="<?php the_permalink(); ?>" class="last-post__link"
                                   aria-label="Читать текст статьи: <?php the_title(); ?>">
                                    <figure class="last-post__thumb">
										<?php the_post_thumbnail( 'post-thumbnail', [ 'class' => 'last-post__img' ] ); ?>
                                    </figure>
                                    <div class="last-post__wrap">
                                        <h3 class="last-post__h"><?php the_title(); ?></h3>
                                        <p class="last-post__text"><?php echo get_the_excerpt(); ?></p>
                                        <span class="last-post__more link-more">Подробнее</span>
                                    </div>
                                </a>
                            </li>
						<?php endwhile; ?>
                    </ul>
					<?php the_posts_pagination(); ?>
                </div>
            </section>
		<?php
		else:
			get_template_part( 'tmp/no-posts' );
		endif;
		?>
    </main>

<?php
endif;
get_footer();
?>
