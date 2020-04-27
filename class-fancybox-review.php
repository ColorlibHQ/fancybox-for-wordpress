<?php

class Fancybox_Review {

	private $value;
	private $messages;
	private $link = 'https://wordpress.org/plugins/fancybox-for-wordpress/#reviews';
	private $slug = 'mfbfw';
	
	function __construct() {

		$this->messages = array(
			'notice'  => __( "Hi there! Stoked to see you're using Fancybox for a few days now - hope you like it! And if you do, please consider rating it. It would mean the world to us.  Keep on rocking!", 'mfbfw' ),
			'rate'    => __( 'Rate the plugin', 'mfbfw' ),
			'rated'   => __( 'Remind me later', 'mfbfw' ),
			'no_rate' => __( 'Don\'t show again', 'mfbfw' ),
		);

		if ( isset( $args['messages'] ) ) {
			$this->messages = wp_parse_args( $args['messages'], $this->messages );
		}

		add_action( 'init', array( $this, 'init' ) );

	}

	public function init() {
		if ( ! is_admin() ) {
			return;
		}

		$this->value = $this->value();

		if ( $this->check() ) {
			add_action( 'admin_notices', array( $this, 'five_star_wp_rate_notice' ) );
			add_action( 'wp_ajax_epsilon_mfbfw_review', array( $this, 'ajax' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
			add_action( 'admin_print_footer_scripts', array( $this, 'ajax_script' ) );
		}

	}

	private function check() {

		if ( ! current_user_can('manage_options') ) {
			return false;
		}

		return( time() > $this->value );

	}

	private function value() {

		$value = get_option( 'mfbfw-rate-time', false );

		if ( $value ) {
			return $value;
		}

		$value = time() + DAY_IN_SECONDS;
		update_option( 'mfbfw-rate-time', $value );

		return $value;

	}

	public function five_star_wp_rate_notice() {

		$url = sprintf( $this->link, $this->slug );

		?>
		<div id="<?php echo esc_attr($this->slug) ?>-epsilon-review-notice" class="notice notice-success is-dismissible" style="margin-top:30px;">
			<p><?php echo sprintf( esc_html( $this->messages['notice'] ), $this->value ) ; ?></p>
			<p class="actions">
				<a id="epsilon-rate" href="<?php echo esc_url( $url ) ?>" target="_blank" class="button button-primary epsilon-review-button">
					<?php echo esc_html( $this->messages['rate'] ); ?>
				</a>
				<a id="epsilon-later" href="#" style="margin-left:10px" class="epsilon-review-button"><?php echo esc_html( $this->messages['rated'] ); ?></a>
				<a id="epsilon-no-rate" href="#" style="margin-left:10px" class="epsilon-review-button"><?php echo esc_html( $this->messages['no_rate'] ); ?></a>
			</p>
		</div>
		<?php
	}

	public function ajax() {

		check_ajax_referer( 'epsilon-mfbfw-review', 'security' );

		if ( ! isset( $_POST['check'] ) ) {
			wp_die( 'ok' );
		}

		$time = get_option( 'mfbfw-rate-time' );

		if ( 'epsilon-rate' == $_POST['check'] ) {
			$time = time() + YEAR_IN_SECONDS * 5;
		}elseif ( 'epsilon-later' == $_POST['check'] ) {
			$time = time() + WEEK_IN_SECONDS;
		}elseif ( 'epsilon-no-rate' == $_POST['check'] ) {
			$time = time() + YEAR_IN_SECONDS * 5;
		}

		update_option( 'mfbfw-rate-time', $time );
		wp_die( 'ok' );

	}

	public function enqueue() {
		wp_enqueue_script( 'jquery' );
	}

	public function ajax_script() {

		$ajax_nonce = wp_create_nonce( "epsilon-mfbfw-review" );

		?>

		<script type="text/javascript">
			jQuery( document ).ready( function( $ ){

				$( '.epsilon-review-button' ).click( function( evt ){
					var href = $(this).attr('href'),
						id = $(this).attr('id');

					if ( 'epsilon-rate' != id ) {
						evt.preventDefault();
					}

					var data = {
						action: 'epsilon_mfbfw_review',
						security: '<?php echo $ajax_nonce; ?>',
						check: id
					};

					if ( 'epsilon-rated' === id || 'epsilon-rate' === id ) {
						data['epsilon-review'] = 1;
					}

					$.post( '<?php echo admin_url( 'admin-ajax.php' ) ?>', data, function( response ) {
						$( '#<?php echo $this->slug ?>-epsilon-review-notice' ).slideUp( 'fast', function() {
							$( this ).remove();
						} );
					});

				} );

				$('#mfbfw-epsilon-review-notice .notice-dismiss').click(function(){

					var data = {
						action: 'epsilon_mfbfw_review',
						security: '<?php echo $ajax_nonce; ?>',
						check: 'epsilon-later'
					};

					$.post( '<?php echo admin_url( 'admin-ajax.php' ) ?>', data, function( response ) {
						$( '#<?php echo $this->slug ?>-epsilon-review-notice' ).slideUp( 'fast', function() {
							$( this ).remove();
						} );
					});
				});

			});
		</script>

		<?php
	}
}

new Fancybox_Review();