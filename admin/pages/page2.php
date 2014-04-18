<?php
if( ! class_exists( 'WP_List_Table' ) ) {
   require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class My_List_Table extends WP_List_Table {
   var $example_data = array(
	  array('ID' => 1,'booktitle' => 'Quarter Share', 'author' => 'Nathan Lowell',
	  'isbn' => '978-0982514542'),
	  array('ID' => 2, 'booktitle' => '7th Son: Descent','author' => 'J. C. Hutchins',
	  'isbn' => '0312384378'),
	  array('ID' => 3, 'booktitle' => 'Shadowmagic', 'author' => 'John Lenahan',
	  'isbn' => '978-1905548927'),
	  array('ID' => 4, 'booktitle' => 'The Crown Conspiracy', 'author' => 'Michael J. Sullivan',
	  'isbn' => '978-0979621130'),
	  array('ID' => 5, 'booktitle'     => 'Max Quick: The Pocket and the Pendant', 'author'    => 'Mark Jeffrey',
	  'isbn' => '978-0061988929'),
	  array('ID' => 6, 'booktitle' => 'Jack Wakes Up: A Novel', 'author' => 'Seth Harwood',
	  'isbn' => '978-0307454355')
   );
   function get_columns(){
	  $columns = array(
		 'booktitle' => 'Title',
		 'author'    => 'Author',
		 'isbn'      => 'ISBN'
	  );
	  return $columns;
   }

   function prepare_items() {
	  $columns = $this->get_columns();
	  $hidden = array();
	  $sortable = array();
	  $this->_column_headers = array($columns, $hidden, $sortable);
	  $this->items = $this->example_data;;
   }
   function column_default( $item, $column_name ) {
	  switch( $column_name ) { 
	  case 'booktitle':
	  case 'author':
	  case 'isbn':
		 return $item[ $column_name ];
	  default:
		 return print_r( $item, true ) ; //Show the whole array for troubleshooting purposes
	  }
   }
}

$myListTable = new My_List_Table();
$myListTable->prepare_items(); 
$myListTable->display(); 
