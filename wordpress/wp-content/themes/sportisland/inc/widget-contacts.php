<?php

class SI_Widget_Contacts extends WP_Widget {
	public function __construct() {
		parent::__construct(
			'si_widget_contacts',
			'SportIsland - Виджет контактов',
			[
				'name'        => 'SportIsland - Виджет контактов',
				'description' => 'Выводит номер телефона и адрес'
			]
		);
	}

	public function form( $instance ) {
		?>

        <p>
            <label for="<?php echo $this->get_field_id( 'id-phone' ); ?>">Введите номер телефона:</label>
            <input
                    id="<?php echo $this->get_field_id( 'id-phone' ); ?>"
                    type="text"
                    name="<?php echo $this->get_field_name( 'phone' ); ?>"
                    value="<?php echo $instance['phone']; ?>"
                    class="widefat"
            >
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'id-address' ); ?>">Введите адрес:</label>
            <input
                    id="<?php echo $this->get_field_id( 'id-address' ); ?>"
                    type="text"
                    name="<?php echo $this->get_field_name( 'address' ); ?>"
                    value="<?php echo $instance['address']; ?>"
                    class="widefat"
            >
        </p>
		<?php
	}

	public function widget( $args, $instance ) {
	    $tel_text = $instance['phone'];
	    $pattern = '/[^+0-9]/';
	    $tel = preg_replace($pattern, '', $tel_text);
		?>
        <address class="main-header__widget widget-contacts">
            <a href="tel:<?php echo $tel; ?>" class="widget-contacts__phone"><?php echo $instance['phone']; ?></a>
            <p class="widget-contacts__address"><?php echo $instance['address']; ?></p>
        </address>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		return $new_instance;

	}
}