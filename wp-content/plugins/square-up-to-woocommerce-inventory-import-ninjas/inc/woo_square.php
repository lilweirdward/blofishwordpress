<?php
	/* get Inventory of all items */
	$url1 = 'https://connect.squareup.com/v1/me/inventory?permissions=ITEMS_READ';
	$ch1 = curl_init();
            curl_setopt($ch1, CURLOPT_URL, $url1);
            curl_setopt($ch1, CURLOPT_HEADER, FALSE);
            curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch1, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($ch1, CURLOPT_HTTPHEADER, array('Authorization: Bearer '. get_option('square_api_key'),'Accept: application/json'));
            $head1 = curl_exec($ch1);
            $httpCode1 = curl_getinfo($ch1, CURLINFO_HTTP_CODE);
            curl_close($ch1);

			$inventoryArray = json_decode($head1);

	/* $args = array(
		'meta_query' => array(
			array(
				'key' => 'squareup_id',
				'value' => '',
				'compare' => 'NOT EXISTS'
			)
		),
		'post_type' => 'product',
		'posts_per_page' => 999999
	); */
	$args = array(
		'post_type' => 'product',
		'posts_per_page' => 999999
	);
	$posts = get_posts($args);

    echo '<pre>'.print_r( $posts, true ).'</pre>';
	// pre($posts);die;

	$square_categories = list_square_categories();

	$s_cat_Arr = array();
	foreach($square_categories as $category){
		$s_cat_Arr[$category->id] =  $category->name;
	}

	$updated = 0;
	foreach($posts as $post){

		$meta = get_post_meta( $post->ID );
        echo '<pre>'.print_r( $meta, true ).'</pre>';exit;
		// pre($post);
		// pre($meta);

		if(!$meta['squareup_id'] || $meta['squareup_id'] == '' ){
			/* Create Square Product */

			if (has_post_thumbnail( $post->ID ) ):
				$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
				$image_url = $image[0];
			endif;

			// pre($meta);
			$sku = $meta['_sku'][0];
			$price = $meta['_price'][0] * 100;
			$visibility = $meta['_visibility']=='visible' ? 'PUBLIC' : 'PRIVATE';
			$_stock = intval($meta['_stock'][0]);

			$categories = get_the_category_custom($post->ID);
			if($categories){
				$cat_name = $categories[0]->name;

				if(!in_array($cat_name,$s_cat_Arr)){
					$cat_json = json_encode(array('name' => $cat_name));
					$cat_response = square_create_category($cat_json);

					$category_id = $cat_response->id;
				}else{
					$category_id = array_search($cat_name,$s_cat_Arr);
				}
			}else{
				$category_id = '';
			}

			$data_string = '{
			  "name": "'.$post->post_title.'",
			  "description": "'.$post->post_content.'",
			  "visibility": "PRIVATE",
			  "track_inventory": "true",
			  "available_online": "true",
			  "category_id": "'.$category_id.'",
			  "variations": [
				{
				  "name": "'.$post->post_title.'",
				  "pricing_type": "FIXED_PRICING",
				  "track_inventory": "true",
				  "price_money": {
					"currency_code": "USD",
					"amount": '.$price.'
				  },
				  "sku": "'.$sku.'"
				}
			  ]
			}';

				$url = 'https://connect.squareup.com/v1/me/items?permissions=ITEMS_WRITE';
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_HEADER, FALSE);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
				curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '. get_option( 'square_api_key' ) ,'Accept: application/json','Content-Type: application/json','Content-Length: ' . strlen($data_string)));
				$head = curl_exec($ch);
				$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
				curl_close($ch);

				$response = json_decode($head);

				update_post_meta( $post->ID, 'squareup_id', $response->id );

				// pre($response);

				$variation_id = $response->variations[0]->id;

				// $encoded_image=(file_get_contents($image_url));

				square_update_inventory($variation_id,$_stock);
				// square_upload_image($response, $encoded_image);
				$updated++;
		}else{
			/* Update Square product */

			$_stock = intval($meta['_stock'][0]);
			foreach($inventoryArray as $inventory){
				if($inventory->variation_id == $meta['variation_id'][0]){
					$adjust = $_stock - $inventory->quantity_on_hand;
					square_update_inventory(trim($meta['variation_id'][0]),$adjust);
				}
			}
		}


	}

	echo '<h3>'.$updated . ' products uploaded to squareup.</h3>';
?>
