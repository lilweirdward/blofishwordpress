<?php
/**
 * @package Akismet
 */
/*
Plugin Name: Square Ninja
Description: Listing Square Dashboard Items
Version: 1.0
Author: customwpninjas
*/
// ini_set('display_errors',1);
defined( 'ABSPATH' ) OR exit;

if ( ! class_exists( 'Squareup_Import_Export' ) ) {

	// plugin version
    define( 'Squareup_Import_Export', '0.1' ); // version ##

	// instatiate class via hook, only if inside admin
    if ( is_admin() ) {

        // instatiate plugin via WP hook - not too early, not too late ##
        add_action( 'init', array ( 'Squareup_Import_Export', 'get_instance' ), 0 );

    }

	/**
     * Main plugin class
     *
     * @since 0.1
     **/
	class Squareup_Import_Export{

		private static $instance = null;

		/**
         * Creates or returns an instance of this class.
         *
         * @return  Foo     A single instance of this class.
         */
		public static function get_instance(){

			if(null == self::$instance){
				self::$instance = new self;
			}

			return self::$instance;
		}

		/**
         * Class contructor
         *
         * @since 0.1
         **/
        private function __construct()
        {

		}
	}
}
$cats = array();

add_action( 'admin_menu', 'register_square_ninja' );

function register_square_ninja(){
	add_menu_page('Square ninja', 'Square Settings', 'manage_options', __FILE__, 'square_list_page', "dashicons-external");

	add_submenu_page( 'edit.php?post_type=product', 'Square To Woo', 'Square >> Woo', 'manage_options', 'square-to-woo-submenu-page', 'square_woo_submenu_page_callback' );

	add_submenu_page( 'edit.php?post_type=product', 'Woo To Square', 'Woo >> Square', 'manage_options', 'woo-to-square-submenu-page', 'woo_square_submenu_page_callback' );

	add_submenu_page( __FILE__, 'Help Page', 'Help', 'manage_options', 'woo-square-help-page', 'woo_square_help_page' );
}

function woo_square_help_page(){

	echo '<h3>Square - WooCommerce Help Page</h3> ';
	/**
	 * Check if WooCommerce is active
	 **/
	if ( !in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		// Put your plugin code here
		echo 'Please install/activate woocommerce to use this plugin.';
		return;
	}
	include(plugin_dir_path( __FILE__ ) . 'inc/css.php');
	?>
	<div class="WooSquare_left" style="max-width: 60%;">
		<h3>Steps To Import Your Square and WooCommerce Products</h3>

		<h4>#1: Register your Square Application</h4>

		 Before this plugin can retrieve your inventory data, you need to register it with Square.<br/>
		  * Go to <a href="https://connect.squareup.com/apps" target="_blank">https://connect.squareup.com/apps</a> Sign in with your Square account's email address and password if prompted.<br/>
		  * In the New App form, provide a Name for your application, then click Save. <strong>Any name is fine, don't over think this</strong><br/>
		  * The Apps page shows your new app's unique credentials, including a <strong>Personal Access Token</strong>. You provide this Personal Access Token to this plugin in your settings page. Copy and paste that so that your WooCommerce can talk to your Square<br/><br/>

		  <img src="<?php echo plugin_dir_url( __FILE__ ) . 'images/personal-access-token.jpg';?>">
		 <br/>
		<h4>#2: Goto the Plugin Settings Page</h4>

		  * Paste your Personal Access Token in the field provided<br/>
		  * Click save<br/>

		<h4>#3: Goto "Woo >> Square" or "Square >> Woo"</h4>
		  * Import your products either way you like. <br/>
		  <strong>Note:</strong>You will overwrite products that have been previously imported but you will not affect existing products.
		  <br /><iframe width="500" height="281" src="//www.youtube.com/embed/BTplhbDIF9s?rel=0" frameborder="0" allowfullscreen></iframe>
	</div>
	<?php
	include(plugin_dir_path( __FILE__ ) . 'inc/contact.php');
}

function square_woo_submenu_page_callback() {
    echo '<h3>Square >> Woo</h3>';
	/**
	 * Check if WooCommerce is active
	 **/
	if ( !in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		// Put your plugin code here
		echo '<h4>Please install/activate woocommerce to use this plugin.</h4>';
		return;
	}
	include(plugin_dir_path( __FILE__ ) . 'inc/css.php');
	?>
	<?php if(isset($_POST['square_woo_status_submit'])){
		include(plugin_dir_path( __FILE__ ) . 'inc/square_woo.php');
	}?>
	<div class="WooSquare_left">
		<div class="banner-img">
			<div class="img">
				<a target="_blank" href="http://wphostingninjas.com/">
					<img src="<?php echo plugin_dir_url( __FILE__ ) . 'images/wphostingninjas-banner.jpg';?>">
				</a>
			</div>
		</div>
		<div class="WooSquare_check_wrap">
			<div class="WooSquare_check_content">
				This function will allow you to import your Square products into WooCommerce
				<br/>
				If you have not ever imported your products, they will be created.
				<br/>
				If you have imported your products before, they will be updated.
				<br/><br/>
				<strong>*NOTE*:</strong> Updating your products will overwrite any old Square products that are in WooCommerce.
				<br/><br/>
				<strong>This will not affect existing WooCommerce Products if this is your first time running the import!</strong>
				<br/><br/>
				Press the "Submit" button below to begin the import. Any questions? Fill out the form to the right and a Ninja will get back with you right away.
				<br/><br/>
			</div>
		</div>
		<div class="WooSquare_check_wrap">
			<div class="WooSquare_check_label">
				<form method="post">
					<input type="submit" value="Import to WooCommerce" name="square_woo_status_submit">
				</form>
			</div>
		</div>
		<div class="banner-img">
			<div class="img">
				<form target="_top" method="post" action="https://www.paypal.com/cgi-bin/webscr">
					<input type="hidden" value="_s-xclick" name="cmd">
					<input type="hidden" value="E9STJGRYXRH24" name="hosted_button_id">
					<input border="0" type="image" alt="PayPal - The safer, easier way to pay online!" name="submit" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif">
					<img border="0" width="1" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" alt="">
				</form>
			</div>
			<div class="img">
				<a target="_blank" href="http://customwpninjas.com/"><img src="<?php echo plugin_dir_url( __FILE__ ) . 'images/customwpninjas-banner.jpg';?>"></a>
			</div>
		</div>
	</div>
	<?php
	include(plugin_dir_path( __FILE__ ) . 'inc/contact.php');
}


function list_square_categories(){

	$url = 'https://connect.squareup.com/v1/me/categories?permissions=ITEMS_READ';
	$auth_bearer = 'Authorization: Bearer '. get_option('square_api_key');
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HEADER, FALSE);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
	curl_setopt($ch, CURLOPT_HTTPHEADER, array($auth_bearer,'Accept: application/json'));
	$head = curl_exec($ch);
	$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close($ch);

	$response = json_decode($head);

	return $response;
	// pre($response);
}
function woo_square_submenu_page_callback() {
    echo '<h2>Woo >> Square</h2>';
	/**
	 * Check if WooCommerce is active
	 **/
	if ( !in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		// Put your plugin code here
		echo '<h4>Please install/activate woocommerce to use this plugin.</h4>';
		return;
	}
	include(plugin_dir_path( __FILE__ ) . 'inc/css.php');
	?>
	<?php if($_POST['woo_square_status_submit']){
		include(plugin_dir_path( __FILE__ ) . 'inc/woo_square.php');
	}?>
	<div class="WooSquare_left">
		<div class="banner-img">
			<div class="img">
				<a target="_blank" href="http://wphostingninjas.com/">
					<img src="<?php echo plugin_dir_url( __FILE__ ) . 'images/wphostingninjas-banner.jpg';?>">
				</a>
			</div>
		</div>
		<div class="WooSquare_check_wrap">
			<div class="WooSquare_check_content">
				This function will allow you to import your WooCommerce Products into your Square Dashboard.<br/>
				<br/>
				If you have not ever imported your products, they will be created.<br/>
				<br/>
				If you have imported your products before, they will be updated.
				<br/><br/>
				<strong>*NOTE*:</strong> Updating your products will overwrite any old WooCommerce products that are already in Square.
				<br/><br/>
				<strong>This will not affect existing Square Products if this is your first time running the import!</strong>
				<br/><br/>
				Press the "Submit" button below to begin the import. Any questions? Fill out the form to the right and a Ninja will get back with you right away.
				<br/><br/>
			</div>
		</div>
		<div class="WooSquare_check_wrap">
			<div class="WooSquare_check_label">
				<form method="post">
					<input type="submit" value="Import to Square" name="woo_square_status_submit">
				</form>
			</div>
		</div>
		<div class="banner-img">
			<div class="img">
				<form target="_top" method="post" action="https://www.paypal.com/cgi-bin/webscr">
					<input type="hidden" value="_s-xclick" name="cmd">
					<input type="hidden" value="E9STJGRYXRH24" name="hosted_button_id">
					<input border="0" type="image" alt="PayPal - The safer, easier way to pay online!" name="submit" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif">
					<img border="0" width="1" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" alt="">
				</form>
			</div>
			<div class="img">
				<a target="_blank" href="http://customwpninjas.com/"><img src="<?php echo plugin_dir_url( __FILE__ ) . 'images/customwpninjas-banner.jpg';?>"></a>
			</div>
		</div>
	</div>
	<?php
	include(plugin_dir_path( __FILE__ ) . 'inc/contact.php');
}

function square_update_inventory($var, $stock){

	$auth_bearer = 'Authorization: Bearer '. get_option('square_api_key');
	$data_string = '{
		  "quantity_delta": '.$stock.',
		  "adjustment_type": "MANUAL_ADJUST"
		}';
	$url = 'https://connect.squareup.com/v1/me/inventory/'.$var.'?permissions=ITEMS_WRITE';
			$ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array($auth_bearer,'Accept: application/json','Content-Type: application/json','Content-Length: ' . strlen($data_string)));
            $head = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

			$response = json_decode($head);

			// pre($response);
}
function square_upload_image($response,$image_data){

	$url = 'https://connect.squareup.com/v1/me/items/'.$response->id.'/image?permissions=ITEMS_WRITE';
	$auth_bearer = 'Authorization: Bearer '. get_option('square_api_key');
	$json = json_encode(array('image_data' => $image_data));
	$delimiter = '-------------' . uniqid();
	// file upload fields: name => array(type=>'mime/type',content=>'raw data')

	$header = array(
		$auth_bearer,
		'Accept: application/json',
		'Content-Type: multipart/form-data boundary=' . $delimiter,
		'Content-Length: ' . strlen($json)
	);

	/* $fileFields = array(
		'file1' => array(
			'type' => 'text/plain',
			'content' => $image_data
		),
	); */
	// all other fields (not file upload): name => value
	/* $postFields = array(
		'image'   => $image_data,
	); */

	$data = '';

	// populate normal fields first (simpler)
	/* foreach ($postFields as $name => $content) {
	   $data .= "--" . $delimiter . "\r\n";
		$data .= 'Content-Disposition: form-data; name="' . $name . '"';
		// note: double endline
		$data .= "\r\n\r\n";
	} */
	// populate file fields
	/* foreach ($fileFields as $name => $file) {
		$data .= "--" . $delimiter . "\r\n";
		// "filename" attribute is not essential; server-side scripts may use it
		$data .= 'Content-Disposition: form-data; name="' . $name . '";' . ' filename="' . $name . '"' . "\r\n";
		// this is, again, informative only; good practice to include though
		$data .= 'Content-Type: ' . $file['type'] . "\r\n";
		// this endline must be here to indicate end of headers
		$data .= "\r\n";
		// the file itself (note: there's no encoding of any kind)
		$data .= $file['content'] . "\r\n";
	}
	// last delimiter
	$data .= "--" . $delimiter . "--\r\n"; */

	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HTTPHEADER , $header);
	curl_setopt($ch, CURLOPT_POSTFIELDS, 'image='.$image_data);
	$head = curl_exec($ch);
	curl_close($ch);

	$response = json_decode($head);

	// pre($httpCode);
	// pre($response);













/*



	$fh = fopen('php://memory','rw');
	fwrite( $fh, $image_data);
	rewind($fh);

	$post = json_encode(array('image_data' => $image_data));
	$url = 'https://connect.squareup.com/v1/me/items/'.$response->id.'/image?permissions=ITEMS_WRITE';
	// echo 'boundary=--'.md5(time()).'--';

	$header = array(
		'Authorization: Bearer 9YOeKRh3cKbDM7lVEznQYQ',
		'Accept: application/json',
		'Content-Type: multipart/form-data',
		'Content-Length: ' . strlen($post)
	);

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	// curl_setopt($ch, CURLOPT_HEADER, FALSE);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	// curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
	curl_setopt($ch, CURLOPT_POST, 1);
	// curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
	curl_setopt($ch, CURLOPT_INFILE, $fh);
	curl_setopt($ch, CURLOPT_INFILESIZE, $image_data);
	$head = curl_exec($ch);
	$httpCode = curl_getinfo($ch);
	curl_close($ch);

	$response = json_decode($head);

	pre($httpCode);
	pre($response); */
	// return $response;
}

function square_create_category($json){

	$auth_bearer = 'Authorization: Bearer '. get_option('square_api_key');
	$url = 'https://connect.squareup.com/v1/me/categories?permissions=ITEMS_WRITE';
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HEADER, FALSE);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
	curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array($auth_bearer,'Accept: application/json','Content-Type: application/json','Content-Length: ' . strlen($json)));
	$head = curl_exec($ch);
	$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close($ch);

	$response = json_decode($head);

	return $response;
}

function square_list_page(){
	// getCurl();
	echo '<h2>Square WooCommerce Settings</h2>';

	/**
	 * Check if WooCommerce is active
	 **/
	if ( !in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		// Put your plugin code here
		echo '<h4>Please install/activate woocommerce to use this plugin.</h4>';
		return;
	}

	include(plugin_dir_path( __FILE__ ) . 'inc/css.php');
	?>
	<?php if($_POST['square_api_save'] && $_POST['api_key']){
		$api = sanitize_text_field($_POST['api_key']);
		update_option( 'square_api_key', $api );
	}?>
	<div class="WooSquare_left">
		<div class="banner-img">
			<div class="img">
				<a target="_blank" href="http://wphostingninjas.com/">
					<img src="<?php echo plugin_dir_url( __FILE__ ) . 'images/wphostingninjas-banner.jpg';?>">
				</a>
			</div>
		</div>
		<div class="WooSquare_check_wrap">
			<div class="WooSquare_check_form">
				<?php $square_api = get_option( 'square_api_key' );?>
				<form method="post">
					Please put your API Key below to import/export products with Squareup. <a href="admin.php?page=woo-square-help-page">Click here</a> for help on finding your API key<br/><br/>
					<span>API Key: </span><input type="text" name="api_key" placeholder="xxxxxxxxxxxxxxxxx" value="<?php echo $square_api ? $square_api : ''?>">
					<!--<input type="submit" value="Save" name="square_api_save">-->
					<p class="submit">
						<input type="submit" value="Save Changes" class="button button-primary" id="submit" name="square_api_save">
					</p>
				</form>
			</div>
		</div>
		<div class="banner-img">
			<div class="img">
				<form target="_top" method="post" action="https://www.paypal.com/cgi-bin/webscr">
					<input type="hidden" value="_s-xclick" name="cmd">
					<input type="hidden" value="E9STJGRYXRH24" name="hosted_button_id">
					<input border="0" type="image" alt="PayPal - The safer, easier way to pay online!" name="submit" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif">
					<img border="0" width="1" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" alt="">
				</form>
			</div>
			<div class="img">
				<a target="_blank" href="http://customwpninjas.com/"><img src="<?php echo plugin_dir_url( __FILE__ ) . 'images/customwpninjas-banner.jpg';?>"></a>
			</div>
		</div>
	</div>
	<?php
	include(plugin_dir_path( __FILE__ ) . 'inc/contact.php');
}

function getCurl(){
	global $cats;
	$auth_bearer = 'Authorization: Bearer '. get_option('square_api_key');
	$url = 'https://connect.squareup.com/v1/me/items?permissions=ITEMS_READ';
	$ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($ch, CURLOPT_HTTPHEADER, array($auth_bearer,'Accept: application/json'));
            $head = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

			$response = json_decode($head);

			$product_categories = get_terms( 'product_cat','hide_empty=0');

			foreach($product_categories as $category){
				$cats[] = $category->name;
			}

			if($response){
				// echo 'here';
				foreach($response as $product){
					wpsd_insert_product_term($product->category->name);
					wpsd_insert_product($product);
					// echo 'Category '.$product->category->name . '<br/>';
					// echo 'Product Name '.$product->name . '<br/>';

					/* if(!empty($product['variations'])){
						pre($product['variations']);
					}
					echo '<br/><br/>'; */
				}
			}
			pre($response);
}

function wpsd_insert_product($product, $inventoryArray){

	global $wpdb;
	// echo $product->name . '<br/>';
	// pre($product);
	// pre($product->variations);
	foreach($product->variations as $variation){

		$posttitle = $product->name . ' ' . $variation->name;
		$exist = wpsd_product_exist($variation , $product);


		if( $exist == 'exist' )
		{
			$postid = $wpdb->get_var( "SELECT ID FROM $wpdb->posts WHERE post_title = '" . $posttitle . "' and post_status = 'publish' limit 1" );
			if($postid){
				update_post_meta( $postid, '_visibility', 'visible' );
				 update_post_meta( $postid, '_stock_status', 'instock');
				 update_post_meta( $postid, '_regular_price', number_format(($variation->price_money->amount/100),2) );
				 update_post_meta( $postid, '_price', number_format(($variation->price_money->amount/100),2) );
				 update_post_meta( $postid, '_sku', $variation->sku);
				 update_post_meta( $postid, '_stock', '5');
				 update_post_meta( $postid, '_manage_stock', true);
				 wpsd_add_inventory($postid, $variation, $inventoryArray);

				 // add_post_meta($postid, 'variation_id', $variation->id);

				 if($product->master_image->url){
					upload_featured_image_from_url($postid, $product);
					// echo 'Image uploaded <br/>';
				 }
			}
			echo $product->name . ' ' . $variation->name . ' already exists.<br/>';
		}elseif ( $exist == 'copy' ){
			echo 'Creating copy of ' . $product->name . ' ' . $variation->name;
		}elseif ( $exist == 'create' ){

			$wp_category = get_term_by('name', $product->category->name, 'product_cat');
			// pre($wp_category);

			$term_id = $wp_category->term_id ? $wp_category->term_id : 0;
			$post_title = $product->name . ' ' . $variation->name;
			$post_content = $product->description;


			$my_post = array(
			  'post_title'    => $post_title,
			  'post_content'  => $post_content,
			  'post_status'   => 'publish',
			  'post_author'   => 1,
			  'post_type' => 'product',
			  'tax_input' => array( 'product_cat' => $term_id )
			);

			// Insert the post into the database
			$id = wp_insert_post( $my_post );

			if($id){
				 update_post_meta( $id, '_visibility', 'visible' );
				 update_post_meta( $id, '_stock_status', 'instock');
				 update_post_meta( $id, '_regular_price', number_format(($variation->price_money->amount/100),2) );
				 update_post_meta( $id, '_price', number_format(($variation->price_money->amount/100),2) );
				 update_post_meta( $id, '_sku', $variation->sku);
				 update_post_meta( $id, '_manage_stock', true);
				 wpsd_add_inventory($id, $variation, $inventoryArray);

				 add_post_meta($id, 'squareup_id', $variation->item_id);
				 add_post_meta($id, 'variation_id', $variation->id);
				 if($product->master_image->url){
					upload_featured_image_from_url($id, $product);
					// echo 'Image uploaded <br/>';
				 }

				echo $product->name . ' ' . $variation->name . ' created.<br/>';
			}
		}else{
			echo 'Problem creating ' . $product->name . ' ' . $variation->name;
		}
	}
}

function wpsd_add_inventory($postid, $variation, $inventoryArray){

	foreach($inventoryArray as $inventory){
		if($inventory->variation_id == $variation->id){
			update_post_meta( $postid, '_stock', $inventory->quantity_on_hand);
		}
	}
}
function wpsd_product_exist($variation, $product){
	global $wpdb;

	$posttitle = $product->name . ' ' . $variation->name;
	// $post = $wpdb->get_results( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "' and post_status = 'publish'" );
	$postid = $wpdb->get_var( "SELECT ID FROM $wpdb->posts WHERE post_title = '" . $posttitle . "' and post_status = 'publish' limit 1" );
	if($postid){
		$squareup_id = get_post_meta( $postid, 'squareup_id' );
		if($squareup_id){
			return 'exist';
		}else{
			return 'copy';
		}
	}else{
		return 'create';
	}
	// pre($post);
	// echo $postid; */
}

function get_post_id_by_name($title){

}

function wpsd_insert_product_term($term)
{
	global $cats;
	// print_r($cats);
	if(!in_array($term , $cats)){
		$cats[] = $term;
		$slug = create_slug($term);
		wp_insert_term(
		  $term,
		  'product_cat', // the taxonomy
		  array(
			'description'=> $term,
			'slug' => $slug
		  )
		);
	}
}
// add_action('init', 'wpse_insert_term');

function upload_featured_image_from_url($post_id, $product_Arr){
	// Add Featured Image to Post

	$image_url  = $product_Arr->master_image->url; // Define the image URL here
	$upload_dir = wp_upload_dir(); // Set upload folder
	$image_data = file_get_contents($image_url); // Get image data
	$filename   = basename($image_url); // Create image file name

	$info = pathinfo($filename);
	$ext = $info['extension'];
	$name = create_slug( $product_Arr->name );

	$new_filename = 'square-'. $name . '.' . $ext;

	// Check folder permission and define file location
	if( wp_mkdir_p( $upload_dir['path'] ) ) {
		$file = $upload_dir['path'] . '/' . $new_filename;
	} else {
		$file = $upload_dir['basedir'] . '/' . $new_filename;
	}

	// Create the image  file on the server
	file_put_contents( $file, $image_data );

	// Check image file type
	$wp_filetype = wp_check_filetype( $filename, null );

	// Set attachment data
	$attachment = array(
		'post_mime_type' => $wp_filetype['type'],
		'post_title'     => sanitize_file_name( $filename ),
		'post_content'   => '',
		'post_status'    => 'inherit'
	);

	// Create the attachment
	$attach_id = wp_insert_attachment( $attachment, $file, $post_id );

	// Include image.php
	require_once(ABSPATH . 'wp-admin/includes/image.php');

	// Define attachment metadata
	$attach_data = wp_generate_attachment_metadata( $attach_id, $file );

	// Assign metadata to attachment
	wp_update_attachment_metadata( $attach_id, $attach_data );

	// And finally assign featured image to post
	set_post_thumbnail( $post_id, $attach_id );
}

function pn_get_attachment_id_from_url( $attachment_url = '' ) {

	global $wpdb;
	$attachment_id = false;

	// If there is no url, return.
	if ( '' == $attachment_url )
		return;

	// Get the upload directory paths
	$upload_dir_paths = wp_upload_dir();

	// Make sure the upload path base directory exists in the attachment URL, to verify that we're working with a media library image
	if ( false !== strpos( $attachment_url, $upload_dir_paths['baseurl'] ) ) {

		// If this is the URL of an auto-generated thumbnail, get the URL of the original image
		$attachment_url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url );

		// Remove the upload path base directory from the attachment URL
		$attachment_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $attachment_url );

		// Finally, run a custom database query to get the attachment ID from the modified attachment URL
		$attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url ) );

	}

	return $attachment_id;
}

function get_the_category_custom( $id = false, $tcat = 'product_cat' ) {
    $categories = get_the_terms( $id, $tcat );
    if ( ! $categories )
        $categories = array();

    $categories = array_values( $categories );

    foreach ( array_keys( $categories ) as $key ) {
        _make_cat_compat( $categories[$key] );
    }

    // Filter name is plural because we return alot of categories (possibly more than #13237) not just one
    return apply_filters( 'get_the_categories', $categories );
}

function create_slug($string){
   $slug=preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
   return $slug;
}

function pre($arr = array()){
	echo '<pre>';
	print_r($arr);
	echo '</pre>';
}
