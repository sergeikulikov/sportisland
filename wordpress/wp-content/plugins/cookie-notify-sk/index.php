<?php
/*
Plugin Name: Cookie Notify by SK
Description: Выводит уведомления для пользователей сайта о том, что сайт использует Cookie
License:     GPL2

Cookie Notify by SK is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

Cookie Notify by SK is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Cookie Notify by SK. If not, see https://www.sergeikulikov.com.
*/

register_activation_hook( __FILE__, 'cnsk_activation' );
register_deactivation_hook( __FILE__, 'cnsk_deactivation' );

function options() {
	return [
		'cnsk_bg'       => '#000',
		'cnsk_color'    => '#fff',
		'cnsk_text'     => 'Мы используем Cookie',
		'cnsk_position' => 'bottom'
	];
}

function cnsk_activation() {
	$options = cnsk_options();
	foreach ( $options as $key => $value ) {
		update_option( $key, $value );
	}
}

function cnsk_deactivation() {
	$options = cnsk_options();
	foreach ( $options as $key => $value ) {
		delete_option( $key );
	}
}

add_action( 'admin_menu', 'cnsk_register_menu' );

function cnsk_register_menu() {
	add_menu_page(
		'Cookie уведомление',
		'Cookie уведомление',
		'manage_options',
		'cnsk-settings',
		'cnsk_admin_page_view',
		'dashicons-buddicons-pm'
	);
}

function cnsk_admin_page_view() {
	if ( ! empty( $_POST ) ) {
		update_option( 'cnsk_bg', $_POST['cnsk_bg'] );
		update_option( 'cnsk_color', $_POST['cnsk_color'] );
		update_option( 'cnsk_text', $_POST['cnsk_text'] );
		update_option( 'cnsk_position', $_POST['cnsk_position'] );
	}
	$bg       = get_option( 'cnsk_bg' );
	$color    = get_option( 'cnsk_color' );
	$text     = get_option( 'cnsk_text' );
	$position = get_option( 'cnsk_position' );
	?>
    <h2>Настройки уведомления:</h2>
    <form method="post">
        <p>
            <label>Введите значение для фона:
                <input type="text" name="cnsk_bg" value="<?php echo $bg; ?>">
            </label>
        </p>
        <p>
            <label>Введите значение для цвета текста:
                <input type="text" name="cnsk_color" value="<?php echo $color; ?>">
            </label>
        </p>
    </form>
    <p>
        <label>Введите текст уведомления:
            <input type="text" name="cnsk_text" value="<?php echo $text; ?>">
        </label>
    </p>
    <fieldset>
        <legend>
            Выберите расположение для уведомления:
        </legend>
        <label>
            Сверху
            <input type="radio" name="cnsk_position" value="top" <?php checked( 'top', $position, true ); ?>>
        </label>
        <label>
            Снизу
            <input type="radio" name="cnsk_position" value="bottom" <?php checked( 'bottom', $position, true ); ?>>
        </label>
    </fieldset>
    <br>
    <button type="submit">Сохранить настройки</button>
	<?php
}

add_action( 'wp_footer', 'cnsk_front_page_view' );

function cnsk_front_page_view() {
	if ( $_COOKIE['cnsk_cookie_agreement'] !== 'agreed' ):
		$bg = get_option( 'cnsk_bg' );
		$color = get_option( 'cnsk_color' );
		$text = get_option( 'cnsk_text' );
		$position = get_option( 'cnsk_position' );
		$css = $position . ': 0;';
		?>
        <div class="alert">
            <div class="wrapper">
				<?php echo $text; ?>
                <br>
                <button class="alert__btn">Я согласен</button>
            </div>
            <style>
                .alert {
                    color: <?php echo $color; ?>;
                    background-color: <?php echo $bg; ?>;
                    position: fixed;
                <?php echo $css; ?>;
                    left: 0;
                    z-index: 666;
                    text-align: center;
                    font-size: 30px;
                    padding: 20px 10px;
                    width: 100%;
                }

                .alert button {
                    border: 1px solid<?php echo $color; ?>;
                    background-color: transparent;
                    font: inherit;
                    font-size: 14px;
                    color: <?php echo $color; ?>;
                    padding: 10px 20px;
                    cursor: pointer;
                }

                .alert button:hover,
                .alert button:active,
                .alert button:focus {
                    background-color: <?php echo $color; ?>;
                    color: <?php echo $bg; ?>;
                    transition: 0.3s;
                }
            </style>
            <script>
                const url = "<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>";
                const btn = document.querySelector('.alert__btn');
                btn.addEventListener('click', function (e) {
                    const data = new FormData();
                    data.append('action', 'cnsk_cookie_ajax');
                    const xhr = new XMLHttpRequest();
                    xhr.open('POST', url);
                    xhr.send(data);
                    xhr.addEventListener('readystatechange', function () {
                        if (xhr.readyState !== 4) return;
                        if (xhr.status === 200) {
                            btn.parentElement.parentElement.remove();
                        }
                    });
                });
            </script>
        </div>
	<?php
	endif;
}

add_action( 'wp_ajax_nopriv_cnsk_cookie_ajax', 'cnsk_ajax_handler' );
add_action( 'wp_ajax_cnsk_cookie_ajax', 'cnsk_ajax_handler' );

function cnsk_ajax_handler() {
	setcookie( 'cnsk_cookie_agreement', 'agreed', time() + 60 * 60 * 24 * 30, '/' );
	echo 'OK';
	wp_die();
}
