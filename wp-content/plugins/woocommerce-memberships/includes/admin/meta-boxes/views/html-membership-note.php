<?php
/**
 * WooCommerce Memberships
 *
 * This source file is subject to the GNU General Public License v3.0
 * that is bundled with this package in the file license.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.html
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@skyverge.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade WooCommerce Memberships to newer
 * versions in the future. If you wish to customize WooCommerce Memberships for your
 * needs please refer to http://docs.woothemes.com/document/woocommerce-memberships/ for more information.
 *
 * @package   WC-Memberships/Admin/Views
 * @author    SkyVerge
 * @category  Admin
 * @copyright Copyright (c) 2014-2015, SkyVerge, Inc.
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * View for a single membership note
 *
 * @since 1.3.0
 * @version 1.3.0
 */
?>

<li rel="<?php echo absint( $note->comment_ID ); ?>" class="<?php echo implode( ' ', array_map( 'sanitize_html_class', $note_classes ) ); ?>">

	<div class="note-content">
		<?php echo wpautop( wptexturize( wp_kses_post( $note->comment_content ) ) ); ?>
	</div>

	<p class="meta">
		<abbr class="exact-date" title="<?php echo esc_attr( $note->comment_date ); ?>"><?php printf( esc_html__( 'added on %1$s at %2$s', WC_Memberships::TEXT_DOMAIN ), date_i18n( wc_date_format(), strtotime( $note->comment_date ) ), date_i18n( wc_time_format(), strtotime( $note->comment_date ) ) ); ?></abbr>
		<?php if ( $note->comment_author !== __( 'WooCommerce', WC_Memberships::TEXT_DOMAIN ) ) printf( ' ' . esc_html__( 'by %s', WC_Memberships::TEXT_DOMAIN ), $note->comment_author ); ?>
		<a href="#" class="delete-note js-delete-note"><?php esc_html_e( 'Delete note', WC_Memberships::TEXT_DOMAIN ); ?></a>
	</p>

</li>
