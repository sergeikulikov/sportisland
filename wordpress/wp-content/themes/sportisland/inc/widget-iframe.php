<?php

class SI_Widget_Iframe extends WP_Widget {
	public function __construct() {
		parent::__construct(
			'si_widget_iframe',
			'SportIsland - Iframe виджет',
			[
				'name'        => 'SportIsland - Iframe виджет',
				'description' => 'Выводит Iframe для карт и прочего контента'
			]
		);
	}

	public function form( $instance ) {
		?>

        <p>
            <label for="<?php echo $this->get_field_id( 'id-code' ); ?>">Введите свой текст:</label>
            <textarea
                    id="<?php echo $this->get_field_id( 'id-code' ); ?>"
                    name="<?php echo $this->get_field_name( 'code' ); ?>"
                    value="<?php echo esc_html($instance['code']); ?>"
                    class="widefat"
            >
                <?php echo esc_html($instance['code']); ?>
            </textarea>
        </p>
		<?php
	}

	public function widget( $args, $instance ) {
		echo $instance['code'];

	}

	public function update( $new_instance, $old_instance ) {
		return $new_instance;

	}
}