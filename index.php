<?php 
/*
 Plugin Name: VW Yoga Fitness Pro Posttype
 lugin URI: https://www.vwthemes.com/
 Description: Creating new post type for VW Yoga Fitness Pro Theme.
 Author: VW Themes
 Version: 1.0
 Author URI: https://www.vwthemes.com/
*/

define( 'VW_YOGA_FITNESS_PRO_POSTTYPE_VERSION', '1.0' );
add_action( 'init', 'vw_yoga_fitness_pro_posttype_create_post_type' );

function vw_yoga_fitness_pro_posttype_create_post_type() {

  register_post_type( 'classes',
    array(
      'labels' => array(
        'name' => __( 'Classes','vw-yoga-fitness-pro-posttype' ),
        'singular_name' => __( 'Classes','vw-yoga-fitness-pro-posttype' )
      ),
        'capability_type' => 'post',
        'menu_icon'  => 'dashicons-businessman',
        'public' => true,
        'supports' => array( 
          'title',
          'editor',
          'thumbnail'
      )
    )
  );

  register_post_type( 'events',
    array(
        'labels' => array(
            'name' => __( 'Events','vw-yoga-fitness-pro-posttype' ),
            'singular_name' => __( 'Events','vw-yoga-fitness-pro-posttype' )
        ),
        'capability_type' =>  'post',
        'menu_icon'  => 'dashicons-tag',
        'public' => true,
        'supports' => array(
        'title',
        'editor',
        'thumbnail',
        'page-attributes',
        'comments'
        )
    )
  );

  register_post_type( 'testimonials',
    array(
  		'labels' => array(
  			'name' => __( 'Testimonials','vw-yoga-fitness-pro-posttype' ),
  			'singular_name' => __( 'Testimonials','vw-yoga-fitness-pro-posttype' )
  		),
  		'capability_type' => 'post',
  		'menu_icon'  => 'dashicons-businessman',
  		'public' => true,
  		'supports' => array(
  			'title',
  			'editor',
  			'thumbnail'
  		)
		)
	);
}

/* ---------------- Car Start ----------------- */

// Car Meta
function vw_yoga_fitness_pro_posttype_bn_custom_meta_car() {

  add_meta_box( 'bn_meta', __( 'Car Meta', 'vw-yoga-fitness-pro-posttype-pro' ), 'vw_yoga_fitness_pro_posttype_bn_meta_callback_car', 'classes', 'normal', 'high' );
}
/* Hook things in for admin*/
if (is_admin()){
  add_action('admin_menu', 'vw_yoga_fitness_pro_posttype_bn_custom_meta_car');
}

function vw_yoga_fitness_pro_posttype_bn_meta_callback_car( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'bn_nonce' );
    $bn_stored_meta = get_post_meta( $post->ID );
    $start_date = get_post_meta( $post->ID, 'meta-start-date', true );
    $end_date = get_post_meta( $post->ID, 'meta-end-date', true );
    $class_time_from = get_post_meta( $post->ID, 'meta-class-time-from', true );
    $class_time_to = get_post_meta( $post->ID, 'meta-class-time-to', true );
    $classes_duration = get_post_meta( $post->ID, 'meta-class-duration', true );
    ?>
  <div id="property_stuff">
    <table id="list-table">     
      <tbody id="the-list" data-wp-lists="list:meta">
        <tr id="meta-1">
          <td class="left">
              <?php _e( 'Classes Start Date', 'vw-yoga-fitness-pro-posttype' )?>
          </td>
          <td class="left" >
            <input type="text" name="meta-start-date" id="meta-start-date" value="<?php echo esc_html($start_date); ?>" />
          </td>
        </tr>
        <tr id="meta-2">
          <td class="left">
              <?php _e( 'Classes End Date', 'vw-yoga-fitness-pro-posttype' )?>
          </td>
          <td class="left" >
              <input type="text" name="meta-end-date" id="meta-end-date" value="<?php echo esc_html($end_date); ?>" />
          </td>
        </tr>
        <tr id="meta-3">
          <td class="left">
              <?php _e( 'Class Time From', 'vw-yoga-fitness-pro-posttype' )?>
          </td>
          <td class="left" >
              <input type="text" name="meta-class-time-from" id="meta-class-time-from" value="<?php echo esc_html($class_time_from); ?>" />
          </td>
        </tr>
        <tr id="meta-4">
          <td class="left">
            <?php _e( 'Class Time To', 'vw-yoga-fitness-pro-posttype' )?>
          </td>
          <td class="left" >
            <input type="text" name="meta-class-time-to" id="meta-class-time-to" value="<?php echo esc_html($class_time_to); ?>" />
          </td>
        </tr>
        <tr id="meta-5">
          <td class="left">
            <?php _e( 'Classes Duration', 'vw-yoga-fitness-pro-posttype' )?>
          </td>
          <td class="left" >
            <input type="text" name="meta-class-duration" id="meta-class-duration" value="<?php echo esc_html($classes_duration); ?>" />
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <?php
}

function vw_yoga_fitness_pro_posttype_bn_meta_save_car( $post_id ) {

  if (!isset($_POST['bn_nonce']) || !wp_verify_nonce($_POST['bn_nonce'], basename(__FILE__))) {
    return;
  }

  if (!current_user_can('edit_post', $post_id)) {
    return;
  }

  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return;
  }
  if( isset( $_POST[ 'meta-start-date' ] ) ) {
      update_post_meta( $post_id, 'meta-start-date', sanitize_text_field($_POST[ 'meta-start-date' ]) );
  } 

  if( isset( $_POST[ 'meta-end-date' ] ) ) {
      update_post_meta( $post_id, 'meta-end-date', sanitize_text_field($_POST[ 'meta-end-date' ]) );
  } 

  if( isset( $_POST[ 'meta-class-time-from' ] ) ) {
      update_post_meta( $post_id, 'meta-class-time-from', sanitize_text_field($_POST[ 'meta-class-time-from' ]) );
  } 

  if( isset( $_POST[ 'meta-class-time-to' ] ) ) {
      update_post_meta( $post_id, 'meta-class-time-to', sanitize_text_field($_POST[ 'meta-class-time-to' ]) );
  } 

  if( isset( $_POST[ 'meta-class-duration' ] ) ) {
      update_post_meta( $post_id, 'meta-class-duration', sanitize_text_field($_POST[ 'meta-class-duration' ]) );
  } 
}
add_action( 'save_post', 'vw_yoga_fitness_pro_posttype_bn_meta_save_car' );

/* events shortcode */
function vw_yoga_fitness_pro_posttype_classes_func( $atts ) {
  $events = '';
  $events = '<div class="row">';
  $query = new WP_Query( array( 'post_type' => 'classes') );

    if ( $query->have_posts() ) :

  $k=1;
  $new = new WP_Query('post_type=classes');

  while ($new->have_posts()) : $new->the_post();
        $custom_url ='';
        $post_id = get_the_ID();
        $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'medium' );
        $url = $thumb['0'];
        $excerpt = wp_trim_words(get_the_excerpt(),15);
        $custom_url = get_permalink();
        $events .= '<div class="col-lg-4 col-md-6 col-sm-6">
                      <div class="classes-box">
                        <img src="'.esc_url($url).'">
                        <h4><a href="'.esc_url($custom_url).'">'.esc_html(get_the_title()) .'</a></h4>
                        <div class="classes-info">
                          '.$excerpt.'
                        </div>
                      </div>
                  </div>';


    if($k%2 == 0){
      $events.= '<div class="clearfix"></div>';
    }
      $k++;
  endwhile;
  else :
    $events = '<h2 class="center">'.esc_html__('Post Not Found','vw-yoga-fitness-pro-posttype').'</h2>';
  endif;
  $events .= '</div>';
  return $events;
}

add_shortcode( 'vw-yoga-fitness-pro-classes', 'vw_yoga_fitness_pro_posttype_classes_func' );


/* ----------------- events --------------------- */

// events Meta
function vw_yoga_fitness_pro_posttype_bn_custom_meta_events() {

    add_meta_box( 'bn_meta', __( 'Events Meta', 'vw-yoga-fitness-pro-posttype-pro' ), 'vw_yoga_fitness_pro_posttype_bn_meta_callback_events', 'events', 'normal', 'high' );
}
/* Hook things in for admin*/
if (is_admin()){
  add_action('admin_menu', 'vw_yoga_fitness_pro_posttype_bn_custom_meta_events');
}

function vw_yoga_fitness_pro_posttype_bn_meta_callback_events( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'bn_nonce' );
    $bn_stored_meta = get_post_meta( $post->ID );
    $service_image = get_post_meta( $post->ID, 'service-meta-image', true );
    $event_date = get_post_meta( $post->ID, 'meta-event-date', true );
    $event_time = get_post_meta( $post->ID, 'meta-event-time', true );
    $event_location = get_post_meta( $post->ID, 'meta-event-location', true );
    ?>
  <div id="property_stuff">
    <table id="list-table">     
      <tbody id="the-list" data-wp-lists="list:meta">
        
        <tr id="meta-2">
          <td class="left">
            <?php _e( 'Event Date', 'vw-yoga-fitness-pro-posttype' )?>
          </td>
          <td class="left" >
            <input type="text" name="meta-event-date" id="meta-event-date" value="<?php echo esc_html($event_date); ?>" />
          </td>
        </tr>
        <tr id="meta-3">
          <td class="left">
            <?php _e( 'Event Time', 'vw-yoga-fitness-pro-posttype' )?>
          </td>
          <td class="left" >
            <input type="text" name="meta-event-time" id="meta-event-time" value="<?php echo esc_html($event_time); ?>" />
          </td>
        </tr>
        <tr id="meta-3">
          <td class="left">
            <?php _e( 'Event Location', 'vw-yoga-fitness-pro-posttype' )?>
          </td>
          <td class="left" >
            <input type="text" name="meta-event-location" id="meta-event-location" value="<?php echo esc_html($event_location); ?>" />
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <?php
}

function vw_yoga_fitness_pro_posttype_bn_meta_save_events( $post_id ) {

  if (!isset($_POST['bn_nonce']) || !wp_verify_nonce($_POST['bn_nonce'], basename(__FILE__))) {
    return;
  }

  if (!current_user_can('edit_post', $post_id)) {
    return;
  }

  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return;
  }

  if( isset( $_POST[ 'meta-event-date' ] ) ) {
      update_post_meta( $post_id, 'meta-event-date', sanitize_text_field($_POST[ 'meta-event-date' ]) );
  } 
  if( isset( $_POST[ 'meta-event-time' ] ) ) {
      update_post_meta( $post_id, 'meta-event-time', sanitize_text_field($_POST[ 'meta-event-time' ]) );
  }
  if( isset( $_POST[ 'meta-event-location' ] ) ) {
      update_post_meta( $post_id, 'meta-event-location', sanitize_text_field($_POST[ 'meta-event-location' ]) );
  }
}
add_action( 'save_post', 'vw_yoga_fitness_pro_posttype_bn_meta_save_events' );

/* events shortcode */
function tg_pet_shop_pro_posttype_events_func( $atts ) {

  $events = '';
  $events = '<div class="row">';
  $query = new WP_Query( array( 'post_type' => 'events') );

    if ( $query->have_posts() ) :

  $k=1;
  $new = new WP_Query('post_type=events');

  while ($new->have_posts()) : $new->the_post();
        $custom_url ='';
        $post_id = get_the_ID();
        $event_date = get_post_meta($post_id,'meta-event-date',true);
        $event_time = get_post_meta($post_id,'meta-event-time',true);
        $event_location = get_post_meta($post_id,'meta-event-location',true);
        $excerpt = wp_trim_words(get_the_excerpt(),15);
        $custom_url = get_permalink(); 
        $events .= '<div class="col-lg-6 col-md-6 col-sm-12">
                      <div class="events-box">
                        <h4><a href="'.esc_url($custom_url).'">'.esc_html(get_the_title()) .'</a></h4>
                        <div class="events-meta-data">
                          <span>
                            <i class="far fa-calendar-alt"></i>
                            '.$event_date.'
                          </span>
                          <span>
                            <i class="far fa-clock"></i>
                            '.$event_time.'
                          </span>
                          <span>
                            <i class="fas fa-map-marker-alt"></i>
                            '.$event_location.'
                          </span>
                        </div>
                        <div class="events-info">
                          '.$excerpt.'
                        </div>
                      </div>
                    </div>';


    if($k%2 == 0){
      $events.= '<div class="clearfix"></div>';
    }
      $k++;
  endwhile;
  else :
    $events = '<h2 class="center">'.esc_html__('Post Not Found','vw-yoga-fitness-pro-posttype').'</h2>';
  endif;
  $events .= '</div>';
  return $events;
}

add_shortcode( 'vw-yoga-fitness-pro-events', 'tg_pet_shop_pro_posttype_events_func' );

/*----------------------Testimonial section ----------------------*/

function vw_yoga_fitness_pro_posttype_bn_testimonial_meta_box() {
	add_meta_box( 'vw-yoga-fitness-pro-posttype-testimonial-meta', __( 'Enter Details', 'vw-yoga-fitness-pro-posttype' ), 'vw_yoga_fitness_pro_posttype_bn_testimonial_meta_callback', 'testimonials', 'normal', 'high' );
}
// Hook things in for admin
if (is_admin()){
    add_action('admin_menu', 'vw_yoga_fitness_pro_posttype_bn_testimonial_meta_box');
}
/* Adds a meta box for custom post */
function vw_yoga_fitness_pro_posttype_bn_testimonial_meta_callback( $post ) {
	wp_nonce_field( basename( __FILE__ ), 'vw_yoga_fitness_pro_posttype_posttype_testimonial_meta_nonce' );
  $bn_stored_meta = get_post_meta( $post->ID );
  if(!empty($bn_stored_meta['vw_yoga_fitness_pro_posttype_testimonial_desigstory'][0]))
      $bn_vw_yoga_fitness_pro_posttype_testimonial_desigstory = $bn_stored_meta['vw_yoga_fitness_pro_posttype_testimonial_desigstory'][0];
    else
      $bn_vw_yoga_fitness_pro_posttype_testimonial_desigstory = '';
	?>
	<div id="testimonials_custom_stuff">
		<table id="list">
			<tbody id="the-list" data-wp-lists="list:meta">
				<tr id="meta-1">
					<td class="left">
						<?php _e( 'Designation', 'vw-yoga-fitness-pro-posttype' )?>
					</td>
					<td class="left" >
						<input type="text" name="vw_yoga_fitness_pro_posttype_testimonial_desigstory" id="vw_yoga_fitness_pro_posttype_testimonial_desigstory" value="<?php echo esc_attr( $bn_vw_yoga_fitness_pro_posttype_testimonial_desigstory ); ?>" />
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	<?php
}

/* Saves the custom meta input */
function vw_yoga_fitness_pro_posttype_bn_metadesig_save( $post_id ) {
	if (!isset($_POST['vw_yoga_fitness_pro_posttype_posttype_testimonial_meta_nonce']) || !wp_verify_nonce($_POST['vw_yoga_fitness_pro_posttype_posttype_testimonial_meta_nonce'], basename(__FILE__))) {
		return;
	}

	if (!current_user_can('edit_post', $post_id)) {
		return;
	}

	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}

	// Save desig.
	if( isset( $_POST[ 'vw_yoga_fitness_pro_posttype_testimonial_desigstory' ] ) ) {
		update_post_meta( $post_id, 'vw_yoga_fitness_pro_posttype_testimonial_desigstory', sanitize_text_field($_POST[ 'vw_yoga_fitness_pro_posttype_testimonial_desigstory']) );
	}
}

add_action( 'save_post', 'vw_yoga_fitness_pro_posttype_bn_metadesig_save' );


/*------------------- Testimonial Shortcode -------------------------*/

function vw_yoga_fitness_pro_posttype_testimonials_func( $atts ) {
    $testimonial = ''; 
    $testimonial = '<div id="testimonials"><div class="row testimonial_shortcodes">';
      $new = new WP_Query( array( 'post_type' => 'testimonials') );
      if ( $new->have_posts() ) :
        $k=1;
        while ($new->have_posts()) : $new->the_post();
          $post_id = get_the_ID();
          $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'medium' );
          $url = $thumb['0'];
          $excerpt = vw_yoga_fitness_pro_string_limit_words(get_the_excerpt(),20);
          $designation = get_post_meta($post_id,'vw_yoga_fitness_pro_posttype_testimonial_desigstory',true);

          $testimonial .= '<div class="col-lg-4 col-md-6 col-sm-6 mb-4"><div class="testimonial_box_sc text-center">';
                if (has_post_thumbnail()){
                    $testimonial.= '<img src="'.esc_url($url).'">';
                    }
               $testimonial .= '<div class="qoute_text_sc">'.$excerpt.'</div>
                <h4 class="testimonial_name_sc"><a href="'.get_the_permalink().'">'.get_the_title().'</a></h4>
                <cite>'.esc_html($designation).'</cite>
              </div></div>';
          $k++;         
        endwhile; 
        wp_reset_postdata();
      else :
        $testimonial = '<div id="testimonial" class="testimonial_wrap col-md-3 mt-3 mb-4"><h2 class="center">'.__('Not Found','vw-yoga-fitness-pro-posttype').'</h2></div>';
      endif;
    $testimonial .= '</div></div>';
    return $testimonial;
}
add_shortcode( 'vw-yoga-fitness-pro-testimonials', 'vw_yoga_fitness_pro_posttype_testimonials_func' );

// ------------------ Shortcodes -------------------------

