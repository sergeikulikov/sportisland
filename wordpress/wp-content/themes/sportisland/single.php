<?php
get_header();
?>

<main class="main-content">
    <div class="wrapper">
		<?php get_template_part( 'tmp/breadcrumbs' ); ?>
    </div>
	<?php
	if ( have_posts() ):
		while ( have_posts() ):
			the_post(); ?>
            <article class="main-article wrapper">
                <header class="main-article__header">
					<?php
					$custom_thumb = get_field( 'post_si_thumb' );
					if ( $custom_thumb ) {
						$url = $custom_thumb['url'];
						$alt = $custom_thumb['alt'];
						?>
                        <picture>
                           <source srcset="<?php echo $custom_thumb['sizes']['si_pic']; ?>" media="(max-width: 600px)">
                            <img src="<?php echo $url; ?>" alt="<?php echo $alt; ?>" class="main-article__thumb">
                        </picture>
						<?php
					} else {
						the_post_thumbnail( 'post-thumbnail', [ 'class' => 'main-article__thumb' ] );
					}
					?>
                    <h1 class="main-article__h"><?php the_title(); ?></h1>
                </header>
				<?php the_content(); ?>
                <footer class="main-article__footer">
                    <time datetime="<?php echo get_the_date( 'Y-m-d' ); ?>"><?php echo get_the_date( 'd F Y' ); ?></time>
                    <button class="main-article__like like"
                            style="background-color: transparent; border: none; font-size: 16px; font: inherit; cursor: pointer;"
                            data-href="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>"
                            data-id="<?php echo $id; ?>"
                    >
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                             x="0px"
                             y="0px" viewBox="0 0 51.997 51.997" style="enable-background:new 0 0 51.997 51.997;"
                             xml:space="preserve">
              <style> path {
                      fill: #666;
                  }
              </style>
                            <path d="M51.911,16.242C51.152,7.888,45.239,1.827,37.839,1.827c-4.93,0-9.444,2.653-11.984,6.905
	c-2.517-4.307-6.846-6.906-11.697-6.906c-7.399,0-13.313,6.061-14.071,14.415c-0.06,0.369-0.306,2.311,0.442,5.478
	c1.078,4.568,3.568,8.723,7.199,12.013l18.115,16.439l18.426-16.438c3.631-3.291,6.121-7.445,7.199-12.014
	C52.216,18.553,51.97,16.611,51.911,16.242z"/>
            </svg>
                        <span class="like__text">Нравится </span>
                        <span class="like__count">
                            <?php
                            $likes = get_post_meta( $id, 'si-like', true );
                            echo $likes ? $likes : 0;
                            ?>
                        </span>
                    </button>
                    <script>
                        window.addEventListener('load', function () {
                            const likeBtn = document.querySelector('.like');
                            const postID = likeBtn.getAttribute('data-id');
                            try {
                                if (!localStorage.getItem('liked')) {
                                    localStorage.setItem('liked', '');
                                }
                            } catch (e) {
                                console.log(e);
                            }

                            function getAboutLike(id) {
                                let hasLike = false;
                                try {
                                    hasLike = localStorage.getItem('liked').split(',').includes(id);
                                } catch (e) {
                                    console.log(e);
                                }
                                return hasLike;
                            }

                            let hasLike = getAboutLike(postID);
                            if (hasLike) {
                                likeBtn.classList.add('like_liked');
                            }
                            likeBtn.addEventListener('click', function (e) {
                                e.preventDefault();
                                let hasLike = getAboutLike(postID);
                                const data = new FormData();
                                data.append('action', 'post-likes');
                                let todo = hasLike ? 'minus' : 'plus';
                                data.append('todo', todo);
                                data.append('id', postID);
                                const xhr = new XMLHttpRequest();
                                xhr.open('POST', likeBtn.getAttribute('data-href'));
                                xhr.send(data);
                                likeBtn.disabled = true;
                                xhr.addEventListener('readystatechange', function () {
                                    if (xhr.readyState !== 4) return;
                                    if (xhr.status === 200) {
                                        likeBtn.querySelector('.like__count').innerText = xhr.responseText;
                                        let localData = localStorage.getItem('liked');
                                        let newData = '';
                                        if (hasLike) {
                                            newData = localData.split(',').filter(function (id) {
                                                return id !== postID
                                            })
                                                .join(',');
                                        } else {
                                            newData = localData.split(',').filter(function (id) {
                                                return id !== '';
                                            }).concat(postID).join(',');
                                        }
                                        localStorage.setItem('liked', newData);
                                        likeBtn.classList.toggle('like_liked');
                                    } else {
                                        console.log(xhr.statusText);
                                    }
                                    likeBtn.disabled = false;
                                });
                            });
                        });
                    </script>
                </footer>
            </article>
		<?php
		endwhile;
	endif; ?>
</main>

<?php
get_footer();
?>

