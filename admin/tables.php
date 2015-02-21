<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Load WP_List_Table if not loaded
if ( ! class_exists( 'WP_List_Table' ) ) {
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

/**
 * @file
 *
 * Tables Generator
 */
if ( ! class_exists( 'wp_admin_table' ) ) {
	class wp_admin_table extends WP_List_Table {
		/**
		 * Number of results to show per page
		 *
		 * @var string
		 */
		public $per_page = 10;

		/**
		 * URL of this page
		 *
		 * @var string
		 */
		public $base_url;

		/**
		 * Total number of items
		 *
		 * @var int
		 */
		public $total_count;

		/**
		 * Total number of Filter 1 items
		 *
		 * @var int
		 */
		public $fitler1_count;

		/**
		 * Total number of Filter 2 items
		 *
		 * @var int
		 */
		public $filter2_count;

		/**
		 * Example Data
		 *
		 * @var array
		 */
		var $example_data = array(
			array(
				'ID'        => 1,
				'booktitle' => 'Quarter Share',
				'author'    => 'Nathan Lowell',
				'isbn'      => '978-0982514542'
			),
			array(
				'ID'        => 2,
				'booktitle' => '7th Son: Descent',
				'author'    => 'J. C. Hutchins',
				'isbn'      => '0312384378'
			),
			array(
				'ID'        => 3,
				'booktitle' => 'Shadowmagic',
				'author'    => 'John Lenahan',
				'isbn'      => '978-1905548927'
			),
			array(
				'ID'        => 4,
				'booktitle' => 'The Crown Conspiracy',
				'author'    => 'Michael J. Sullivan',
				'isbn'      => '978-0979621130'
			),
			array(
				'ID'        => 5,
				'booktitle' => 'Max Quick: The Pocket and the Pendant',
				'author'    => 'Mark Jeffrey',
				'isbn'      => '978-0061988929'
			),
			array(
				'ID'        => 6,
				'booktitle' => 'Jack Wakes Up: A Novel',
				'author'    => 'Seth Harwood',
				'isbn'      => '978-0307454355'
			),
			array(
				'ID'        => 7,
				'booktitle' => 'The Crown Conspiracy',
				'author'    => 'Michael J. Sullivan',
				'isbn'      => '978-0954321130'
			),
			array(
				'ID'        => 8,
				'booktitle' => 'Max Quick: The Pocket and the Pendant',
				'author'    => 'Mark Jeffrey',
				'isbn'      => '978-0061654929'
			),
			array(
				'ID'        => 9,
				'booktitle' => 'Jack Wakes Up: A Novel',
				'author'    => 'Seth Harwood',
				'isbn'      => '978-4337987355'
			),
			array(
				'ID'        => 10,
				'booktitle' => 'Quarter Share',
				'author'    => 'Nathan Lowell',
				'isbn'      => '978-1022514542'
			),
			array(
				'ID'        => 11,
				'booktitle' => '7th Son: Descent',
				'author'    => 'J. C. Hutchins',
				'isbn'      => '0312444378'
			),
			array(
				'ID'        => 12,
				'booktitle' => 'Shadowmagic',
				'author'    => 'John Lenahan',
				'isbn'      => '978-3005548927'
			),
		);

		/**
		 * Get things started
		 *
		 * @see WP_List_Table::__construct()
		 */
		public function __construct() {
			// Set parent defaults
			parent::__construct( array(
				'singular' => __( 'Items', 'wp-pb' ),    // Singular name of the listed records
				'plural'   => __( 'Item', 'wp-pb' ),        // Plural name of the listed records
				'ajax'     => false                    // Does this table support ajax?
			) );

			$this->get_items_counts();
			$this->process_bulk_action();
			$this->base_url = admin_url( 'admin.php?page=page-id-2' );
		}

		/**
		 * Advanced Filtering functionality
		 *
		 * @access public
		 *
		 * @return void
		 */
		public function advanced_filters() {
			?>
			<div id="wp-pb-payment-filters">
				<?php $this->search_box( __( 'Search', 'wp-pb' ), 'wp-pb-payments' ); ?>
			</div>

		<?php
		}

		/**
		 * Show the search field
		 *
		 * @access public
		 *
		 * @param string $text Label for the search box
		 * @param string $input_id ID of the search box
		 *
		 * @return void
		 */
		public function search_box( $text, $input_id ) {
			if ( empty( $_REQUEST['s'] ) && ! $this->has_items() ) {
				return;
			}

			$input_id = $input_id . '-search-input';

			if ( ! empty( $_REQUEST['orderby'] ) ) {
				echo '<input type="hidden" name="orderby" value="' . esc_attr( $_REQUEST['orderby'] ) . '" />';
			}
			if ( ! empty( $_REQUEST['order'] ) ) {
				echo '<input type="hidden" name="order" value="' . esc_attr( $_REQUEST['order'] ) . '" />';
			}
			?>
			<p class="search-box">
				<label class="screen-reader-text" for="<?php echo $input_id ?>"><?php echo $text; ?>:</label>
				<input type="search" id="<?php echo $input_id ?>" name="s" value="<?php _admin_search_query(); ?>"/>
				<?php submit_button( $text, 'button', false, false, array( 'ID' => 'search-submit' ) ); ?><br/>
			</p>
		<?php
		}

		/**
		 * Retrieve the view types
		 *
		 * @access public
		 *
		 * @return array $views All the views available
		 */
		public function get_views() {

			$current       = isset( $_GET['filter'] ) ? $_GET['filter'] : '';
			$total_count   = '&nbsp;<span class="count">(' . $this->total_count . ')</span>';
			$filter1_count = '&nbsp;<span class="count">(' . $this->filter1_count . ')</span>';
			$filter2_count = '&nbsp;<span class="count">(' . $this->filter2_count . ')</span>';

			$views = array(
				'all'     => sprintf( '<a href="%s"%s>%s</a>', remove_query_arg( array(
					'filter',
					'paged'
				) ), $current === 'all' || $current == '' ? ' class="current"' : '', __( 'All', 'wp-pb' ) . $total_count ),
				'filter1' => sprintf( '<a href="%s"%s>%s</a>', add_query_arg( array(
					'filter' => 'filter1',
					'paged'  => false
				) ), $current === 'filter1' ? ' class="current"' : '', __( 'Filter 1', 'wp-pb' ) . $filter1_count ),
				'filter2' => sprintf( '<a href="%s"%s>%s</a>', add_query_arg( array(
					'filter' => 'filter2',
					'paged'  => false
				) ), $current === 'filter2' ? ' class="current"' : '', __( 'Filter 2', 'wp-pb' ) . $filter2_count ),
			);

			return apply_filters( 'wp_pb_payments_table_views', $views );
		}

		/**
		 * Retrieve the table columns
		 *
		 * @access public
		 *
		 * @return array $columns Array of all the list table columns
		 */
		function get_columns() {
			$columns = array(
				'ID'        => 'ID',
				'booktitle' => 'Title',
				'author'    => 'Author',
				'isbn'      => 'ISBN'
			);

			return apply_filters( 'wp_pb_payments_table_columns', $columns );
		}

		/**
		 * Retrieve the table's sortable columns
		 *
		 * @access public
		 *
		 * @return array Array of all the sortable columns
		 */
		public function get_sortable_columns() {
			$columns = array(
				'ID'        => array( 'ID', true ),
				'booktitle' => array( 'booktitle', false ),
				'author'    => array( 'author', false ),
				'isbn'      => array( 'isbn', false ),
			);

			return apply_filters( 'wp_pb_payments_table_sortable_columns', $columns );
		}

		/**
		 * This function renders most of the columns in the list table.
		 *
		 * @access public
		 *
		 * @param array $item Contains all the data of the discount code
		 * @param string $column_name The name of the column
		 *
		 * @return string Column Name
		 */
		function column_default( $item, $column_name ) {
			switch ( $column_name ) {
				case 'ID':
				case 'booktitle':
				case 'author':
				case 'isbn':
					return $item[ $column_name ];
				default:
					return print_r( $item, true ); //Show the whole array for troubleshooting purposes
			}
		}

		/**
		 * Process the bulk actions
		 *
		 * @access public
		 *
		 * @return void
		 */
		public function process_bulk_action() {

		}

		/**
		 * Retrieve all the data for all the items
		 *
		 * @access public
		 *
		 * @return array Array of all the data for the items
		 */
		public function table_data() {
			// Query Parameters
			$page          = isset( $_GET['paged'] ) ? $_GET['paged'] : 1;
			$per_page      = $this->per_page;
			$orderby       = isset( $_GET['orderby'] ) ? $_GET['orderby'] : 'ID';
			$order         = isset( $_GET['order'] ) ? $_GET['order'] : 'DESC';
			$order_inverse = $order == 'DESC' ? 'ASC' : 'DESC';
			$status        = isset( $_GET['status'] ) ? $_GET['status'] : 'any';
			$search        = isset( $_GET['s'] ) ? sanitize_text_field( $_GET['s'] ) : null;

			// TODO: Make the data query-able
			return $this->example_data;
		}

		/**
		 * Setup the final data for the table
		 *
		 * @access public
		 *
		 * @return void
		 */
		public function prepare_items() {
			$columns               = $this->get_columns();
			$hidden                = array();
			$sortable              = $this->get_sortable_columns();
			$this->_column_headers = array( $columns, $hidden, $sortable );
			$this->items           = $this->table_data();

			$status = isset( $_GET['filter'] ) ? $_GET['filter'] : 'any';
			switch ( $status ) {
				case 'filter1':
					$total_items = $this->filter1;
					break;
				case 'filter2':
					$total_items = $this->filter2;
					break;
				case 'any':
					$total_items = $this->total_count;
					break;
			}

			$this->set_pagination_args(
				array(
					'total_items' => $total_items,
					'per_page'    => $this->per_page,
					'total_pages' => ceil( $total_items / $this->per_page ),
				)
			);
		}

		/**
		 * Retrieve the payment counts
		 *
		 * @access public
		 *
		 * @return void
		 */
		public function get_items_counts() {

			// Total items count
			$this->total_count = intval( count( $this->example_data ) );

			// Filter_1 items count
			$this->filter1_count = intval( $this->total_count / 2 );

			// Filter_2 items count
			$this->filter2_count = intval( $this->total_count / 2 );
		}
	}
}

