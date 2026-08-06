<?php
/**
 * "Rate this plugin" admin notice.
 *
 * @package FancyBox_For_WordPress
 */

defined( 'ABSPATH' ) || exit;

class Fancybox_Review {

	private $value;
	private $messages;
	private $link = 'https://wordpress.org/plugins/fancybox-for-wordpress/#reviews';
	private $slug = 'mfbfw';

	function __construct() {

		add_action( 'init', array( $this, 'init' ) );
	}

	public function init() {

		if ( ! is_admin() ) {
			return;
		}

		$this->messages = array(
			'notice'  => __( "Hi there! Stoked to see you're using Fancybox for a few days now - hope you like it! And if you do, please consider rating it. It would mean the world to us.  Keep on rocking!", 'fancybox-for-wordpress' ),
			'rate'    => __( 'Rate the plugin', 'fancybox-for-wordpress' ),
			'rated'   => __( 'Remind me later', 'fancybox-for-wordpress' ),
			'no_rate' => __( 'Don\'t show again', 'fancybox-for-wordpress' ),
		);

		// Registered unconditionally so the dismiss request is still handled after the
		// notice itself has stopped rendering.
		add_action( 'wp_ajax_epsilon_mfbfw_review', array( $this, 'ajax' ) );

		if ( $this->check() ) {
			add_action( 'admin_notices', array( $this, 'five_star_wp_rate_notice' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
			add_action( 'admin_print_footer_scripts', array( $this, 'ajax_script' ) );
		}
	}

	private function check() {

		if ( ! current_user_can( 'manage_options' ) ) {
			return false;
		}

		$this->value = $this->value();

		return ( time() > $this->value );
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

		?>
		<div id="<?php echo esc_attr( $this->slug ); ?>-epsilon-review-notice" class="notice notice-success is-dismissible" style="margin-top:30px;">
			<p><?php echo esc_html( $this->messages['notice'] ); ?></p>
			<p class="actions">
				<a id="epsilon-rate" href="<?php echo esc_url( $this->link ); ?>" target="_blank" rel="noopener noreferrer" class="button button-primary epsilon-review-button">
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

		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( 'forbidden', '', array( 'response' => 403 ) );
		}

		if ( ! isset( $_POST['check'] ) ) {
			wp_die( 'ok' );
		}

		$check = sanitize_key( wp_unslash( $_POST['check'] ) );
		$time  = get_option( 'mfbfw-rate-time' );

		if ( 'epsilon-rate' === $check || 'epsilon-no-rate' === $check ) {
			$time = time() + YEAR_IN_SECONDS * 5;
		} elseif ( 'epsilon-later' === $check ) {
			$time = time() + WEEK_IN_SECONDS;
		}

		update_option( 'mfbfw-rate-time', $time );
		wp_die( 'ok' );
	}

	public function enqueue() {

		wp_enqueue_script( 'jquery' );
	}

	public function ajax_script() {

		$ajax_nonce = wp_create_nonce( 'epsilon-mfbfw-review' );

		?>
		<script type="text/javascript">
			jQuery( document ).ready( function( $ ){

				var noticeId = '#<?php echo esc_js( $this->slug ); ?>-epsilon-review-notice',
					ajaxUrl  = '<?php echo esc_url_raw( admin_url( 'admin-ajax.php' ) ); ?>',
					nonce    = '<?php echo esc_js( $ajax_nonce ); ?>';

				function dismiss( check, callback ) {
					$.post( ajaxUrl, {
						action: 'epsilon_mfbfw_review',
						security: nonce,
						check: check
					}, function() {
						$( noticeId ).slideUp( 'fast', function() {
							$( this ).remove();
						} );
						if ( callback ) { callback(); }
					} );
				}

				$( '.epsilon-review-button' ).on( 'click', function( evt ){
					var id = $( this ).attr( 'id' );

					if ( 'epsilon-rate' !== id ) {
						evt.preventDefault();
					}

					dismiss( id );
				} );

				$( noticeId ).on( 'click', '.notice-dismiss', function(){
					dismiss( 'epsilon-later' );
				} );

			});
		</script>

		<?php
	}
}

new Fancybox_Review();
