<?php
/*
  Plugin Name: WP Multi Store Locator Pro 
  Plugin URI: https://codecanyon.net/item/wp-multi-store-locator-pro/19385351
  Description: This plugin provides a number of options for admin in backend to manage their stores and sales manager for respective franchise. WP Store Locator have awesome user interface and displays results with google map in front end. Its a complete package with lots of features like search store, nearby you stores functionality and much more.
  Version: 2.8
  Author: WpExpertsio
  Author URI: https://wpexperts.io/
  Text Domain: store_locator
  License: GPLv2 or later
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}  
define('STORE_LOCATOR_PLUGIN_URL', plugin_dir_url(__FILE__));
define('STORE_LOCATOR_PLUGIN_PATH', plugin_dir_path(__FILE__));

include STORE_LOCATOR_PLUGIN_PATH . 'inc/store_locator_widget.php';
include STORE_LOCATOR_PLUGIN_PATH . 'inc/gravityforms-multiple-form-instances.php';

//create tables
register_activation_hook(__FILE__, 'store_locator_plugin_activation');
function store_locator_plugin_activation() {
    //create tables
    require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );
    global $wpdb;
    if (!empty($wpdb->charset))
        $charset_collate = "DEFAULT CHARACTER SET $wpdb->charset";
    if (!empty($wpdb->collate))
        $charset_collate .= " COLLATE $wpdb->collate";

    //country table
    $country_table = 'store_locator_country';
    if ($wpdb->get_var("SHOW TABLES LIKE '$country_table'") != $country_table) {
        $sql = "CREATE TABLE " . $country_table . " (
            `id` bigint(20) NOT NULL AUTO_INCREMENT,
                        `name` varchar(255) NULL,
            PRIMARY KEY (`id`)
        ) $charset_collate;";
        dbDelta($sql);
        // Insert Countries
        $sql = "INSERT INTO " . $country_table . " (`name`) VALUES ('Afghanistan'),('Albania'),('Algeria'),('American Samoa'),('Andorra'),('Angola'),('Anguilla'),('Antarctica'),('Antigua And Barbuda'),('Argentina'),('Armenia'),('Aruba'),('Australia'),('Austria'),('Azerbaijan'),('Bahamas'),('Bahrain'),('Bangladesh'),('Barbados'),('Belarus'),('Belgium'),('Belize'),('Benin'),('Bermuda'),('Bhutan'),('Bolivia'),('Bosnia And Herzegovina'),('Botswana'),('Bouvet Island'),('Brazil'),('British Indian Ocean Territory'),('Brunei Darussalam'),('Bulgaria'),('Burkina Faso'),('Burundi'),('Cambodia'),('Cameroon'),('Canada'),('Cape Verde'),('Cayman Islands'),('Central African Republic'),('Chad'),('Chile'),('China'),('Christmas Island'),('Cocos (keeling) Islands'),('Colombia'),('Comoros'),('Congo'),('Congo'),('Cook Islands'),('Costa Rica'),('Cote D\'ivoire'),('Croatia'),('Cuba'),('Cyprus'),('Czech Republic'),('Denmark'),('Djibouti'),('Dominica'),('Dominican Republic'),('East Timor'),('Ecuador'),('Egypt'),('El Salvador'),('Equatorial Guinea'),('Eritrea'),('Estonia'),('Ethiopia'),('Falkland Islands (malvinas)'),('Faroe Islands'),('Fiji'),('Finland'),('France'),('French Guiana'),('French Polynesia'),('French Southern Territories'),('Gabon'),('Gambia'),('Georgia'),('Germany'),('Ghana'),('Gibraltar'),('Greece'),('Greenland'),('Grenada'),('Guadeloupe'),('Guam'),('Guatemala'),('Guinea'),('Guinea-bissau'),('Guyana'),('Haiti'),('Heard Island And Mcdonald Islands'),('Holy See (vatican City State)'),('Honduras'),('Hong Kong'),('Hungary'),('Iceland'),('India'),('Indonesia'),('Iran'),('Iraq'),('Ireland'),('Israel'),('Italy'),('Jamaica'),('Japan'),('Jordan'),('Kazakstan'),('Kenya'),('Kiribati'),('Korea'),('Korea'),('Kosovo'),('Kuwait'),('Kyrgyzstan'),('Lao People\'s Democratic Republic'),('Latvia'),('Lebanon'),('Lesotho'),('Liberia'),('Libyan Arab Jamahiriya'),('Liechtenstein'),('Lithuania'),('Luxembourg'),('Macau'),('Macedonia'),('Madagascar'),('Malawi'),('Malaysia'),('Maldives'),('Mali'),('Malta'),('Marshall Islands'),('Martinique'),('Mauritania'),('Mauritius'),('Mayotte'),('Mexico'),('Micronesia'),('Moldova'),('Monaco'),('Mongolia'),('Montserrat'),('Montenegro'),('Morocco'),('Mozambique'),('Myanmar'),('Namibia'),('Nauru'),('Nepal'),('Netherlands'),('Netherlands Antilles'),('New Caledonia'),('New Zealand'),('Nicaragua'),('Niger'),('Nigeria'),('Niue'),('Norfolk Island'),('Northern Mariana Islands'),('Norway'),('Oman'),('Pakistan'),('Palau'),('Palestinian Territory'),('Panama'),('Papua New Guinea'),('Paraguay'),('Peru'),('Philippines'),('Pitcairn'),('Poland'),('Portugal'),('Puerto Rico'),('Qatar'),('Reunion'),('Romania'),('Russian Federation'),('Rwanda'),('Saint Helena'),('Saint Kitts And Nevis'),('Saint Lucia'),('Saint Pierre And Miquelon'),('Saint Vincent And The Grenadines'),('Samoa'),('San Marino'),('Sao Tome And Principe'),('Saudi Arabia'),('Senegal'),('Serbia'),('Seychelles'),('Sierra Leone'),('Singapore'),('Slovakia'),('Slovenia'),('Solomon Islands'),('Somalia'),('South Africa'),('South Georgia And The South Sandwich Islands'),('Spain'),('Sri Lanka'),('Sudan'),('Suriname'),('Svalbard And Jan Mayen'),('Swaziland'),('Sweden'),('Switzerland'),('Syrian Arab Republic'),('Taiwan'),('Tajikistan'),('Tanzania'),('Thailand'),('Togo'),('Tokelau'),('Tonga'),('Trinidad And Tobago'),('Tunisia'),('Turkey'),('Turkmenistan'),('Turks And Caicos Islands'),('Tuvalu'),('Uganda'),('Ukraine'),('United Arab Emirates'),('United Kingdom'),('United States'),('United States Minor Outlying Islands'),('Uruguay'),('Uzbekistan'),('Vanuatu'),('Venezuela'),('Viet Nam'),('Virgin Islands'),('Virgin Islands'),('Wallis And Futuna'),('Western Sahara'),('Yemen'),('Zambia'),('Zimbabwe');";
        dbDelta($sql);
    }

    //state table
    $state_table = 'store_locator_state';
    if ($wpdb->get_var("SHOW TABLES LIKE '$state_table'") != $state_table) {
        $sql = "CREATE TABLE " . $state_table . " (
            `id` bigint(20) NOT NULL AUTO_INCREMENT,
                        `name` varchar(255) NULL,
            PRIMARY KEY (`id`)
        ) $charset_collate;";
        dbDelta($sql);
        // Insert States
        $sql = "INSERT INTO " . $state_table . " (`name`) VALUES ('Alabama'),('Alaska'),('Arizona'),('Arkansas'),('California'),('Colorado'),('Connecticut'),('Delaware'),('District of Columbia'),('Florida'),('Georgia'),('Hawaii'),('Idaho'),('Illinois'),('Indiana'),('Iowa'),('Kansas'),('Kentucky'),('Louisiana'),('Maine'),('Montana'),('Nebraska'),('Nevada'),('New Hampshire'),('New Jersey'),('New Mexico'),('New York'),('North Carolina'),('North Dakota'),('Ohio'),('Oklahoma'),('Oregon'),('Maryland'),('Massachusetts'),('Michigan'),('Minnesota'),('Mississippi'),('Missouri'),('Pennsylvania'),('Rhode Island'),('South Carolina'),('South Dakota'),('Tennessee'),('Texas'),('Utah'),('Vermont'),('Virginia'),('Washington'),('West Virginia'),('Wisconsin'),('Wyoming');";
        dbDelta($sql);
    }

    //transactions table
    $transactions_table = 'store_locator_transactions';
    if ($wpdb->get_var("SHOW TABLES LIKE '$transactions_table'") != $transactions_table) {
        $sql = "CREATE TABLE " . $transactions_table . " (
            `id` bigint(20) NOT NULL AUTO_INCREMENT,
                        `post_id` bigint(20) NULL,
                        `user_id` bigint(20) NULL,
                        `date` datetime NULL,
            PRIMARY KEY (`id`)
        ) $charset_collate;";
        dbDelta($sql);
    }

    // save default options
    $options_to_map = get_option('store_locator_map');
    if(empty($options_to_map)) {
        update_option('store_locator_map',  array ( 'enable' => 1, 'width' => 100, 'widthunit' => '%', 'height' => 550,
            'heightunit' => 'PX', 'type' => 'Roadmap', 'unit' => 'mile', 'radius' => '5,10,[25],50,100,200,500',
            'category' => 1, 'tag' => 1, 'streetViewControl' => 1, 'mapTypeControl' => 1, 'scroll' => 1,
            'marker1' => 'red.png', 'marker2' => 'blue.png',
            'infowindow' => '<div><div>{image}</div><h3>{name}</h3><p>{address} {city}, {state} {country} {zipcode}</p><span>{phone}</span><span>{website}</span><div>',
            'style' => '', 'csize' => 50, 'cluster' => 0,'total_sponsored'=>3,
            'default_search' => 1,'search_field_get_my_location' => 1,'search_field_location' => 1,'search_field_radius'=>1,
            'search_field_category'=>1,'search_field_tags'=>1,'map_window_open'=>'','map_style'=>1,'listing_position'=>'left',
            'custom_style'=>'','show_accordion'=>'','marker1_custom'=>'','marker2_custom'=>'', 'search_layouts'=>'onmap') );
    }
    $options_to_grid = get_option('store_locator_grid');
    if(empty($options_to_grid)) {
        update_option('store_locator_grid', array('enable' => 1, 'total_markers' => 10000, 'scroll' => 1, 'columns' => array("name", "address"), 'view' => 'card','listing_position'=>'left','search_window_position'=>'wpml_search_right'));
    } else{
		$options_to_grid = get_option('store_locator_grid',true);
		$options_to_grid['listing_position'] = 'left';
		$options_to_grid['search_window_position'] = 'wpml_search_right';
		update_option('store_locator_grid', $options_to_grid );
	}
     $placeholders = get_option('placeholder_settings');
    if(empty($placeholders)) {
         $placeholders['location_not_found'] = __('No details available for input:','store_locator');
         $placeholders['select_tags_txt'] = __('Select tags','store_locator');
         $placeholders['select_category_txt'] = __('Select category','store_locator');
         update_option('placeholder_settings',$placeholders);
    } else{ 
		$placeholders['location_not_found'] = __('No details available for input:','store_locator');
		$placeholders['search_options_btn'] = __('Search Options','store_locator');
		update_option('placeholder_settings',$placeholders);
	}
}


//create 'partner' custom post type
add_action('init', 'store_init');
function store_init() {
    
    $store_locator_single = get_option('store_locator_single',true);
    $store_locator_slug = '';
    
    if(isset( $store_locator_single['store_locator_slug'] )) {
        $store_locator_slug = $store_locator_single['store_locator_slug'];
    }
    
    if(empty($store_locator_slug))
        $store_locator_slug = 'store-locator';
    
    $labels = array(
        'name' => __('Stores Locator', 'store_locator'),
        'singular_name' => __('Stores Locator', 'store_locator'),
        'menu_name' => __('Stores Locator', 'store_locator'),
        'name_admin_bar' => __('Store', 'store_locator'),
        'add_new' => __('Add New Store', 'store_locator'),
        'add_new_item' => __('Add New Store', 'store_locator'),
        'new_item' => __('New Store', 'store_locator'),
        'edit_item' => __('Edit Store', 'store_locator'),
        'view_item' => __('View Store', 'store_locator'),
        'all_items' => __('Stores List', 'store_locator'),
        'search_items' => __('Search Store', 'store_locator'),
        'parent_item_colon' => __('Store Partner:', 'store_locator'),
        'not_found' => __('No Store found.', 'store_locator'),
        'not_found_in_trash' => __('No Store found in Trash.', 'store_locator')
    );
    $single_options = get_option('store_locator_single');
    $args = array(
        'labels' => $labels,
        'description' => __('Description.', 'store_locator'),
        'public' => (($single_options['page'])?true:false),
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => $store_locator_slug),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => null,
        'menu_icon' => "dashicons-location-alt",
        'supports' => array('thumbnail')
    );
    $labelsSM = array(
        'name' => __('Sales Managers', 'store_locator'),
        'singular_name' => __('Sales Managers', 'store_locator'),
        'menu_name' => __('Sales Managers', 'store_locator'),
        'name_admin_bar' => __('Book', 'store_locator'),
        'add_new' => __('Add New', 'store_locator'),
        'add_new_item' => __('Add New Sales Manager', 'store_locator'),
        'new_item' => __('New Sales Manager', 'store_locator'),
        'edit_item' => __('Edit Sales Manager', 'store_locator'),
        'view_item' => __('View Sales Manager', 'store_locator'),
        'all_items' => __('Sales Managers List', 'store_locator'),
        'search_items' => __('Search Manager', 'store_locator'),
        'parent_item_colon' => __('Parent Manager:', 'store_locator'),
        'not_found' => __('No Sales Manager found.', 'store_locator'),
        'not_found_in_trash' => __('No Sales Manager found in Trash.', 'store_locator')
    );

    $argsSM = array(
        'labels' => $labelsSM,
        'description' => __('Description.', 'store_locator'),
        'public' => false,
        'publicly_queryable' => false,
        'show_ui' => true,
        'show_in_menu' => false,
        'query_var' => true,
        'exclude_from_search' => true,
        'rewrite' => array('slug' => 'sales-manager'),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => false
    );

    register_post_type('store_locator', $args);
    register_post_type('sales_manager', $argsSM);

    // create custom category for stores
    register_taxonomy( 'store_locator_category', array('store_locator'), array(
            'hierarchical' => true,
            'label' => __('Store Categories', 'store_locator'),
            'singular_label' => __('Category', 'store_locator'),
            'rewrite' => array( 'slug' => 'categories', 'with_front'=> false )
        )
    );
    register_taxonomy_for_object_type( 'store_locator_category', 'store_locator' );

    // create custom tags for stores
    register_taxonomy(
        'store_locator_tag',
        'store_locator',
        array(
            'hierarchical'  => false,
            'label'         => __("Store Tags", 'store_locator'),
            'singular_name' => __("Tag", 'store_locator'),
            'rewrite'       => true,
            'query_var'     => true
        )
    );
}


// Load translation files if exists
add_action( 'plugins_loaded', 'store_locator_load_plugin_textdomain' );
function store_locator_load_plugin_textdomain() {
    load_plugin_textdomain( 'store_locator', false, 'store-locator/languages' );
}


// add submenu page
add_action('admin_menu', 'register_stores_submenu_page');
function register_stores_submenu_page() {
    add_submenu_page('edit.php?post_type=store_locator', __('Sales Manager','store_locator'), __('Sales Managers List','store_locator'), 'manage_options', 'edit.php?post_type=sales_manager');
    add_submenu_page('edit.php?post_type=store_locator', __('Settings','store_locator'), __('Settings','store_locator'), 'manage_options', 'store_locator_settings_page', 'store_locator_settings_page_callback');
    add_submenu_page('edit.php?post_type=store_locator', __('Import/Export','store_locator'), __('Import/Export','store_locator'), 'manage_options', 'import-export-submenu-page-partner', 'import_store_locator_page_callback');
    add_submenu_page('edit.php?post_type=store_locator', __('Statistics','store_locator'), __('Statistics','store_locator'), 'manage_options', 'statistics_submenu_page', 'statistics_submenu_page_callback');
}


add_action('admin_menu', 'disable_new_stores_posts');
function disable_new_stores_posts() {
    global $submenu;
    unset($submenu['edit.php?post_type=store_locator'][10]);
}


//add scripts to backend
add_action('admin_enqueue_scripts', 'store_locator_backend_script');
function store_locator_backend_script() {
    ?>
    <script>
        var stores_json_encoded;
        var ajax_url = '<?php echo admin_url('admin-ajax.php'); ?>';
        var wpmsl_url = '<?php echo STORE_LOCATOR_PLUGIN_URL; ?>';
    </script>
    <?php

    $store_locator_API_KEY = get_option('store_locator_API_KEY');

    $post_type = get_post_type( get_the_ID() );
    
    wp_enqueue_style('store_lcoator_backend-style', STORE_LOCATOR_PLUGIN_URL . '/assets/css/style.css');

    if( $post_type  == 'store_locator' 
        || @$_GET['page'] == 'store_locator_settings_page' 
        || @$_GET['page'] == 'import-export-submenu-page-partner' 
        ) { 
        wp_enqueue_media();
        
        wp_enqueue_script('store_locator_backend_map', "https://maps.googleapis.com/maps/api/js?key=".$store_locator_API_KEY."&libraries=places");
        wp_enqueue_script('store_locator_backend_script',  STORE_LOCATOR_PLUGIN_URL . '/assets/js/backend_script.js', array('jquery'));
        wp_enqueue_script('store_backend_select2', STORE_LOCATOR_PLUGIN_URL . '/assets/js/select2.js');
        wp_enqueue_style('store_backend_select2_style', STORE_LOCATOR_PLUGIN_URL . '/assets/css/select2.css');
        wp_enqueue_script('ldm_script_time_js', STORE_LOCATOR_PLUGIN_URL . 'assets/js/jquery.timepicker.js');
        wp_enqueue_style('ldm_script_time_css', STORE_LOCATOR_PLUGIN_URL . 'assets/css/jquery.timepicker.css');
    }
}


//add scripts to frontend
add_action('wp_enqueue_scripts', 'store_frontend_script',200);
function store_frontend_script() {
    ?>
    <script>
        var ajax_url = '<?php echo admin_url('admin-ajax.php'); ?>';
    </script>
    <?php
    $setting_options = get_option('store_locator_map');
    
    // FOR UPD POWER BUILDER TO AVOID CONFLICTION
    wp_dequeue_script( 'google-maps-api' ); 
    // GOOGLE MAP SCRIPT TO RENDER MAP
    wp_enqueue_script('store_frontend_map', "https://maps.googleapis.com/maps/api/js?key=".get_option('store_locator_API_KEY')."&libraries=places");
     wp_enqueue_script('store_locator_clusters', STORE_LOCATOR_PLUGIN_URL . '/assets/js/markercrysters.js',array('jquery'));

    if( isset( $setting_options['rtl_enabled'] ) ) {
        if( $setting_options['rtl_enabled'] == '1' ) {
            wp_enqueue_style('store_frontend-style', STORE_LOCATOR_PLUGIN_URL . '/assets/css/rtl-style.css');
        } else {
            wp_enqueue_style('store_frontend-style', STORE_LOCATOR_PLUGIN_URL . '/assets/css/style.css');
        }
    } else {
        wp_enqueue_style('store_frontend-style', STORE_LOCATOR_PLUGIN_URL . '/assets/css/style.css');
    }

    wp_enqueue_script('store_frontend_select2', STORE_LOCATOR_PLUGIN_URL . '/assets/js/select2.js', array('jquery'));
    wp_enqueue_style('store_frontend_select2_style', STORE_LOCATOR_PLUGIN_URL . '/assets/css/select2.css');
}

//create custom fields
add_action('add_meta_boxes', 'add_store_locator_meta');
function add_store_locator_meta() {
    add_meta_box('store-info', 
        __('Store Info', 'store_locator'), 
        'store_locator_meta_box_callback_store_info', 
        'store_locator');
    add_meta_box('address-info',
        __('Address Info', 'store_locator'), 
        'store_locator_meta_box_callback_address_info', 
        'store_locator');

    if ( is_plugin_active( 'gravityforms/gravityforms.php' ) ) {
        add_meta_box('gforms-info', 
            __('Gravity Forms Info', 'store_locator'), 
            'store_locator_meta_box_callback_gforms_info', 
            'store_locator');
    }

    add_meta_box('sales-manager-info', 
            __('Sales Manager Info', 'store_locator'), 
            'sales_managers_meta_box_callback',
            'sales_manager');
}

function store_locator_meta_box_callback_store_info($post) {
    // Add a nonce field so we can check for it later.
    wp_nonce_field('store_locator_save_meta_box_data', 'store_locator_meta_box_nonce');
    $post_id = $post->ID;
    ?>
    <table class="widefat" style="border: 0px;">
        <tbody>
        <tr>
            <td><?php echo __("Store Locator Shortcode", 'store_locator'); ?></td>
            <td>
                <input type="text" readonly value="&nbsp;&nbsp;&nbsp;[store_locator_show]" name="store_locator_show"/>
            </td>
        </tr>
        <tr>
            <td><?php echo __("Code", 'store_locator'); ?></td>
            <td>
                <input type="text" value="<?php echo get_post_meta($post_id, 'store_locator_code', true) ? get_post_meta($post_id, 'store_locator_code', true) : ''; ?>" name="store_locator_code"/>
            </td>
        </tr>
        <tr>
            <td><?php echo __("Name", 'store_locator'); ?></td>
            <td>
                <input type="text" value="<?php echo get_post_meta($post_id, 'store_locator_name', true) ? get_post_meta($post_id, 'store_locator_name', true) : ''; ?>" name="store_locator_name"/>
            </td>
        </tr>
        <tr>
            <td><?php echo __("Description", 'store_locator'); ?></td>
            <td>
                <?php
                $content = get_post_meta( $post_id, 'store_locator_description', true );
                wp_editor( $content, "store_locator_description" );
                ?>
            </td>
        </tr>
        <tr>
            <td><?php echo __("Phone", 'store_locator'); ?></td>
            <td>
                <input type="text" value="<?php echo get_post_meta($post_id, 'store_locator_phone', true) ? get_post_meta($post_id, 'store_locator_phone', true) : ''; ?>" name="store_locator_phone"/>
            </td>
        </tr>
        <tr>
            <td><?php echo __("Fax", 'store_locator'); ?></td>
            <td>
                <input type="text" value="<?php echo get_post_meta($post_id, 'store_locator_fax', true) ? get_post_meta($post_id, 'store_locator_fax', true) : ''; ?>" name="store_locator_fax"/>
            </td>
        </tr>
        <tr>
            <td><?php echo __("Website", 'store_locator'); ?></td>
            <td>
                <input type="text" value="<?php echo get_post_meta($post_id, 'store_locator_website', true) ? get_post_meta($post_id, 'store_locator_website', true) : ''; ?>" name="store_locator_website"/>
            </td>
        </tr>
        <tr>
            <td><?php echo __("Working Hours", 'store_locator'); ?></td>
            <?php
            $days = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
            $days_meta = get_post_meta($post_id, 'store_locator_days', true);
            ?>
            <td>
                <table id="store_locator_hours" style="background-color: rgb(241, 241, 241); border-radius: 5px;">
                    <?php foreach ($days as $day): ?>
                        <tr>
                            <td style="border-bottom: 1px solid #dbdbdb;"><?php echo $day; ?></td>
                            <td style="border-bottom: 1px solid #dbdbdb;">
                                <input <?php echo (isset($days_meta[$day]) && $days_meta[$day]['status'] == '1')?'checked':''; ?> type="radio" value="1" id="store_locator_days_<?php echo $day; ?>_1" name="store_locator_days[<?php echo $day; ?>][status]" > <label for="store_locator_days_<?php echo $day; ?>_1"> Opened </label>
                                <input <?php echo (!isset($days_meta[$day]) || $days_meta[$day]['status'] == '0')?'checked':''; ?> type="radio" value="0" id="store_locator_days_<?php echo $day; ?>_0" name="store_locator_days[<?php echo $day; ?>][status]" /> <label for="store_locator_days_<?php echo $day; ?>_0"> Closed </label>
                            </td>
                            <td style="border-bottom: 1px solid #dbdbdb;">
                                <input <?php echo (isset($days_meta[$day]) && $days_meta[$day]['status'] == '1')?'':'style="display: none;"'; ?> size="9" placeholder="Open Time" type="text" value="<?php echo (isset($days_meta[$day]))?$days_meta[$day]['start']:''; ?>" name="store_locator_days[<?php echo $day; ?>][start]" class="start_time"/>
                                <input <?php echo (isset($days_meta[$day]) && $days_meta[$day]['status'] == '1')?'':'style="display: none;"'; ?> size="9" placeholder="Close Time" type="text" value="<?php echo (isset($days_meta[$day]))?$days_meta[$day]['end']:''; ?>" name="store_locator_days[<?php echo $day; ?>][end]" class="end_time" />
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </td>
        </tr>
        <tr>
            <td><?php echo __("Sales Managers", 'store_locator'); ?></td>
            <td>
                <select style="width: 186px;" name="store_locator_sales[]" id="store_locator_sales" multiple="multiple">
                    <?php
                    $args = array(
                        'posts_per_page' => -1,
                        'post_type' => 'sales_manager',
                        'status' => 'publish',
                    );
                    $allSales = get_posts($args);
                    $selectedSales  = get_post_meta($post_id, 'store_locator_sales', true);
                    if(!$selectedSales){
                        $selectedSales = array();
                    }
                    foreach ($allSales as $manager) {
                        ?>
                        <option value="<?php echo $manager->ID; ?>" <?php echo (in_array($manager->ID, $selectedSales)) ? "selected" : ""; ?>><?php echo $manager->post_title; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </td>
        </tr>
        </tbody>
    </table>
    <script>
        // initialize input widgets first
        jQuery('.start_time, .end_time').timepicker({
            'showDuration': true,
            'timeFormat': 'g:i a'
        });
    </script>
    <?php
}

function store_locator_meta_box_callback_address_info($post) {
    $post_id = $post->ID;
    ?>
    <table class="widefat" style="border: 0px;">
        <tbody>
        <tr>
            <td><?php echo __("Address", 'store_locator'); ?></td>
            <td>
                <input id="store_locator_address" type="text" value="<?php echo get_post_meta($post_id, 'store_locator_address', true); ?>" name="store_locator_address"/>
            </td>
        </tr>
        <tr>
            <td><?php echo __("Store Longitude", 'store_locator'); ?></td>
            <td>
                <input   type="text" value="<?php echo get_post_meta($post_id, 'store_locator_lng', true); ?>" disabled />
            </td>
        </tr>
        <tr>
            <td><?php echo __("Store latitude", 'store_locator'); ?></td>
            <td>
                <input  type="text" value="<?php echo get_post_meta($post_id, 'store_locator_lat', true); ?>" disabled />
            </td>
        </tr>
        <tr>
            <td><?php echo __("Country", 'store_locator'); ?></td>
            <td>
                <select style="width: 186px;" name="store_locator_country" id="store_locator_country">
                    <option value="" ></option>
                    <?php
                    global $wpdb;
                    $allCountries = $wpdb->get_results("SELECT * FROM store_locator_country");
                    $selectedCountry = get_post_meta($post_id, 'store_locator_country', true);
                    foreach ($allCountries as $country) {
                        ?>
                        <option value="<?php echo $country->name; ?>" <?php echo ($selectedCountry == $country->name) ? "selected" : ""; ?>><?php echo $country->name; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr <?php echo ($selectedCountry != "United States")?"style='display: none;'":""; ?> >
            <td><?php echo __("State", 'store_locator'); ?></td>
            <td>
                <select style="width: 186px;" name="store_locator_state" id="store_locator_state">
                    <option value="" ></option>
                    <?php
                    global $wpdb;
                    $allStates = $wpdb->get_results("SELECT * FROM store_locator_state");
                    $selectedState = get_post_meta($post_id, 'store_locator_state', true);
                    foreach ($allStates as $state) {
                        ?>
                        <option value="<?php echo $state->name; ?>" <?php echo ($selectedState == $state->name) ? "selected" : ""; ?>><?php echo $state->name; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td><?php echo __("City", 'store_locator'); ?></td>
            <td>
                <input id="store_locator_city" type="text" value="<?php echo get_post_meta($post_id, 'store_locator_city', true) ? get_post_meta($post_id, 'store_locator_city', true) : ''; ?>" name="store_locator_city"/>
            </td>
        </tr>
        <tr>
            <td><?php echo __("Postal Code", 'store_locator'); ?></td>
            <td>
                <input id="store_locator_zipcode" type="text" value="<?php echo get_post_meta($post_id, 'store_locator_zipcode', true) ? get_post_meta($post_id, 'store_locator_zipcode', true) : ''; ?>" name="store_locator_zipcode"/>
            </td>
        </tr>
        </tbody>
    </table>
    <input type="hidden" value="<?php echo get_post_meta($post_id, 'store_locator_lat', true) ? get_post_meta($post_id, 'store_locator_lat', true) : ''; ?>" name="store_locator_lat" id="store_locator_lat"/>
    <input type="hidden" value="<?php echo get_post_meta($post_id, 'store_locator_lng', true) ? get_post_meta($post_id, 'store_locator_lng', true) : ''; ?>" name="store_locator_lng" id="store_locator_lng"/>
    <div id="map-container" style="position: relative;">

        <div id="map_loader" style="z-index: 9;width: 100%; height: 200px;position: absolute;background-color: #fff;"><div class="uil-ripple-css" style="transform: scale(0.6); margin-left: auto; margin-right: auto;"><div></div><div></div></div></div>
        <div id="map-canvas" style="height: 200px;width: 100%;"></div>
    </div>

    <script>
        jQuery(document).ready(function (jQuery) {
            initializeMapBackend();
        });
    </script>
    <?php
}

function store_locator_meta_box_callback_gforms_info($post) {
    $post_id = $post->ID;
    ?>
    <table class="widefat" style="border: 0px;">
        <tbody>
        <tr>
            <td><?php echo __("Select Gravity Form", 'store_locator'); ?></td>
            <td>
                <select style="width: 186px;" name="store_locator_gform" id="store_locator_gforms" >
                    <option value=""></option>
                    <?php

                    $forms = RGFormsModel::get_forms( null, 'title' );
                    $selectedForm = get_post_meta($post_id, 'store_locator_gform', true);

                    foreach ($forms as $form) {
                        ?>
                        <option value="<?php echo $form->id; ?>" <?php echo ($form->id == $selectedForm) ? "selected" : ""; ?>><?php echo $form->title; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </td>
        </tr>
        </tbody>
    </table>
    <?php
}

function sales_managers_meta_box_callback($post) {
    // Add a nonce field so we can check for it later.
    wp_nonce_field('sales_manager_save_meta_box_data', 'sales_manager_meta_box_nonce');
    $post_id = $post->ID;
    ?>
    <table class="widefat" style="border: 0px;">
        <tbody>
        <tr>
            <td><?php echo __("Identification", 'store_locator'); ?></td>
            <td>
                <input type="text" value="<?php echo get_post_meta($post_id, 'sales_manager_id', true) ? get_post_meta($post_id, 'sales_manager_id', true) : ''; ?>" name="sales_manager_id"/>
            </td>
        </tr>
        <tr>
            <td><?php echo __("Title", 'store_locator'); ?></td>
            <td>
                <input type="text" value="<?php echo get_post_meta($post_id, 'sales_manager_title', true) ? get_post_meta($post_id, 'sales_manager_title', true) : ''; ?>" name="sales_manager_title"/>
            </td>
        </tr>
        <tr>
            <td><?php echo __("Name", 'store_locator'); ?></td>
            <td>
                <input type="text" value="<?php echo get_post_meta($post_id, 'sales_manager_name', true) ? get_post_meta($post_id, 'sales_manager_name', true) : ''; ?>" name="sales_manager_name"/>
            </td>
        </tr>
        <tr>
            <td><?php echo __("Phone", 'store_locator'); ?></td>
            <td>
                <input type="text" value="<?php echo get_post_meta($post_id, 'sales_manager_phone', true) ? get_post_meta($post_id, 'sales_manager_phone', true) : ''; ?>" name="sales_manager_phone"/>
            </td>
        </tr>
        <tr>
            <td><?php echo __("E-Mail", 'store_locator'); ?></td>
            <td>
                <input type="text" value="<?php echo get_post_meta($post_id, 'sales_manager_email', true) ? get_post_meta($post_id, 'sales_manager_email', true) : ''; ?>" name="sales_manager_email"/>
            </td>
        </tr>
        </tbody>
    </table>
    <?php
}

//save custom fields
add_action('save_post', 'store_locator_save_meta_box_data');
function store_locator_save_meta_box_data($post_id) {
    if (isset($_POST['post_type']) && 'store_locator' == $_POST['post_type']) {
        // Check if our nonce is set.
        if (!isset($_POST['store_locator_meta_box_nonce'])) {
            return;
        }
        // Verify that the nonce is valid.
        if (!wp_verify_nonce($_POST['store_locator_meta_box_nonce'], 'store_locator_save_meta_box_data')) {
            return;
        }
        // If this is an autosave, our form has not been submitted, so we don't want to do anything.
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        //update post title
        remove_action('save_post', 'store_locator_save_meta_box_data');
        $my_post = array(
            'ID' => $post_id,
            'post_title' => $_POST['store_locator_name'],
            'post_name' => wp_unique_post_slug(
                $_POST['store_locator_name'],
                $post_id,
                'publish',
                'store_locator',
                $post_parent=null
            )
        );
        wp_update_post($my_post);
        add_action('save_post', 'store_locator_save_meta_box_data');

        // update post meta
        if (isset($_POST['store_locator_name']))
            update_post_meta($post_id, 'store_locator_name', $_POST['store_locator_name']);

        if (isset($_POST['store_locator_address']))
            update_post_meta($post_id, 'store_locator_address', $_POST['store_locator_address']);

        if (isset($_POST['store_locator_lat']))
            update_post_meta($post_id, 'store_locator_lat', $_POST['store_locator_lat']);

        if (isset($_POST['store_locator_lng']))
            update_post_meta($post_id, 'store_locator_lng', $_POST['store_locator_lng']);

        if (isset($_POST['store_locator_country']))
            update_post_meta($post_id, 'store_locator_country', $_POST['store_locator_country']);

        if (isset($_POST['store_locator_state']))
            update_post_meta($post_id, 'store_locator_state', $_POST['store_locator_state']);

        if (isset($_POST['store_locator_city']))
            update_post_meta($post_id, 'store_locator_city', $_POST['store_locator_city']);

        if (isset($_POST['store_locator_phone']))
            update_post_meta($post_id, 'store_locator_phone', $_POST['store_locator_phone']);

        if (isset($_POST['store_locator_fax']))
            update_post_meta($post_id, 'store_locator_fax', $_POST['store_locator_fax']);

        if (isset($_POST['store_locator_website']))
            update_post_meta($post_id, 'store_locator_website', $_POST['store_locator_website']);

        if (isset($_POST['store_locator_zipcode']))
            update_post_meta($post_id, 'store_locator_zipcode', $_POST['store_locator_zipcode']);

        if (isset($_POST['store_locator_code']))
            update_post_meta($post_id, 'store_locator_code', $_POST['store_locator_code']);

        if (isset($_POST['store_locator_sales']))
            update_post_meta($post_id, 'store_locator_sales', $_POST['store_locator_sales']);

        if (isset($_POST['store_locator_days']))
            update_post_meta($post_id, 'store_locator_days', $_POST['store_locator_days']);

        if (isset($_POST['store_locator_description']))
            update_post_meta($post_id, 'store_locator_description', $_POST['store_locator_description']);

        if (isset($_POST['store_locator_gform']))
            update_post_meta($post_id, 'store_locator_gform', $_POST['store_locator_gform']);
    }

    else if (isset($_POST['post_type']) && 'sales_manager' == $_POST['post_type']) {

        // Check if our nonce is set.
        if (!isset($_POST['sales_manager_meta_box_nonce'])) {
            return;
        }
        // Verify that the nonce is valid.
        if (!wp_verify_nonce($_POST['sales_manager_meta_box_nonce'], 'sales_manager_save_meta_box_data')) {
            return;
        }
        // If this is an autosave, our form has not been submitted, so we don't want to do anything.
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        //update post title
        remove_action('save_post', 'store_locator_save_meta_box_data');
        $my_post = array('ID' => $post_id, 'post_title' => $_POST['sales_manager_name']);
        wp_update_post($my_post);
        add_action('save_post', 'store_locator_save_meta_box_data');

        //insert/update tax
        $term = get_term_by('slug', $post_id, 'sales_manager_tax');
        if($term){
            wp_update_term($term->term_id, 'sales_manager_tax', array('name' => $_POST['sales_manager_name']));
        }else{
            wp_insert_term($_POST['sales_manager_name'], 'sales_manager_tax', array('slug'    => $post_id));
        }

        // update post meta
        if (isset($_POST['sales_manager_id']))
            update_post_meta($post_id, 'sales_manager_id', $_POST['sales_manager_id']);

        if (isset($_POST['sales_manager_title']))
            update_post_meta($post_id, 'sales_manager_title', $_POST['sales_manager_title']);

        if (isset($_POST['sales_manager_name']))
            update_post_meta($post_id, 'sales_manager_name', $_POST['sales_manager_name']);

        if (isset($_POST['sales_manager_phone']))
            update_post_meta($post_id, 'sales_manager_phone', $_POST['sales_manager_phone']);

        if (isset($_POST['sales_manager_email']))
            update_post_meta($post_id, 'sales_manager_email', $_POST['sales_manager_email']);

        if (isset($_POST['sales_manager_stores']))
            $term_taxonomy_ids = wp_set_object_terms( $post_id, $_POST['sales_manager_stores'], 'store_locator_tax' );
        else
            $term_taxonomy_ids = wp_set_object_terms( $post_id, null, 'store_locator_tax' );
    }
}

//manage custom coulmns display for stores
add_filter('manage_edit-store_locator_columns', 'store_list_columns');
function store_list_columns($columns) {
    unset(
        $columns['date']
    );
    $new_columns = array(
        'title' => __('Name', 'store_locator'),
        'store_address' => __('Address', 'store_locator'),
        'store_sales' => __('Sales Managers', 'store_locator'),
    );
    return array_merge($columns, $new_columns);
}

//manage custom coulmns content display for Stores
add_filter('manage_store_locator_posts_custom_column', 'manage_stores_columns', 10, 2);
function manage_stores_columns($column, $post_id) {
    global $post;
    switch ($column) {
        case 'store_address':
            $meta = get_post_meta($post_id);
            echo $meta['store_locator_address'][0] . " " . $meta['store_locator_city'][0] . " " . $meta['store_locator_state'][0] . " " . $meta['store_locator_country'][0] . " " . $meta['store_locator_zipcode'][0];
            break;
        case 'store_sales':
            $sales = get_post_meta($post_id, 'store_locator_sales', true);
            if($sales){
                foreach ($sales as $manager) {
                    echo get_post($manager)->post_title . "<br>";
                }
            }
            break;
        default :
            break;
    }
}

//manage custom coulmns display for sales managers
add_filter('manage_edit-sales_manager_columns', 'sales_manager_list_columns');
function sales_manager_list_columns($columns) {
    unset(
        $columns['date']
    );
    $new_columns = array(
        'title' => __('Name', 'store_locator'),
        'sales_title' => __('Title', 'store_locator'),
        'sales_phone' => __('Phone', 'store_locator'),
        'sales_email' => __('Email', 'store_locator'),
    );
    return array_merge($columns, $new_columns);
}

//manage custom coulmns content display for Sales
add_filter('manage_sales_manager_posts_custom_column', 'manage_sales_manager_columns', 10, 2);
function manage_sales_manager_columns($column, $post_id) {
    global $post;
    switch ($column) {
        case 'sales_title':
            echo get_post_meta($post_id, 'sales_manager_title', true);
            break;
        case 'sales_phone':
            echo get_post_meta($post_id, 'sales_manager_phone', true);
            break;
        case 'sales_email':
            echo get_post_meta($post_id, 'sales_manager_email', true);
            break;
        default :
            break;
    }
}

// add filters to the query
add_filter('parse_query', 'custom_posts_filter');
function custom_posts_filter($query) {
    global $pagenow;
    if (is_admin() && $pagenow == 'edit.php' && isset($_GET['store_locator_manager']) && $_GET['store_locator_manager'] != '') {
        $query->set('meta_query', array(
                array(
                    'key' => 'store_locator_sales',
                    'value' => ':"' . $_GET['store_locator_manager'] .'"',
                    'compare' => 'REGEXP'
                )
            )
        );
    }
}

// handle the dislay of new fillters
add_action('restrict_manage_posts', 'custom_posts_restrict_manage_posts');
function custom_posts_restrict_manage_posts() {
    $currentManager = isset($_GET['store_locator_manager']) ? $_GET['store_locator_manager'] : '';
    ?>
    <?php if (isset($_GET['post_type']) && $_GET['post_type'] == 'store_locator'): ?>
        <select style="width: 186px;" name="store_locator_manager" >
            <option value=""> <?php echo __("All Sales Managers", 'store_locator'); ?></option>
            <?php
            global $wpdb;
            $q = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE post_type='sales_manager' AND post_status = 'publish' order by 'ID' Desc");

            foreach ($q as $manager) {
                ?>
                <option value="<?php echo $manager->ID; ?>" <?php echo ($manager->ID == $currentManager) ? "selected" : ""; ?>><?php echo $manager->post_title; ?></option>
                <?php
            }
            ?>
        </select>
    <?php endif; ?>
    <?php
}

add_shortcode('store_locator_show', 'store_locator_show_func');
function store_locator_show_func($atts) {

    ob_start();
    $map_options = get_option('store_locator_map');
    $grid_options = get_option('store_locator_grid');
    $radius = ($map_options['radius'])?explode(",",trim($map_options['radius'])):false;
   $tag = isset($map_options['tag']) ? $map_options['tag'] : '';
    $category = isset($map_options['category']) ? $map_options['category'] : '';

     $map_options['marker1'] = STORE_LOCATOR_PLUGIN_URL . "assets/img/" . ((isset($map_options['marker1']) && !empty($map_options['marker1'])) ? $map_options['marker1'] : "blue.png");
    $map_options['marker2'] = STORE_LOCATOR_PLUGIN_URL . "assets/img/" . ((isset($map_options['marker2']) && !empty($map_options['marker2'])) ? $map_options['marker2'] : "red.png");

    if(!empty($map_options['marker1_custom'])) {
        $map_options['marker1'] = $map_options['marker1_custom'];
    }

    if(!empty($map_options['marker2_custom'])) {
        $map_options['marker2'] = $map_options['marker2_custom'];
    }

    $default_radius = 50;
    if(isset($map_options['radius'])){
    preg_match("/^(.*\[)(.*)(\])/", $map_options['radius'], $find);
    $default_radius = trim($find[2]);
    }
    // Attributes
    $map_landing_address=get_option('map_landing_address');
    $atts = shortcode_atts(
        array(
            'location' => isset($map_landing_address['address']) ? $map_landing_address['address'] : 'United States',
            'radius' => $default_radius,
            'city' => isset($map_landing_address['city']) ? $map_landing_address['city'] : '',
            'state' => isset($map_landing_address['country']) ? $map_landing_address['country'] : '',
        ),
        $atts
    );
    $placeholder_setting = get_option('placeholder_settings');
   
     if (is_ssl()) {
        
        $btn = $placeholder_setting['get_location_btn_txt'];
        if(empty($btn)){
            $btn='Get my location';
        } 
        $display = 'style="display:block;"';
    } else {
        $btn='Get my location ssl must be activated';
        $display = 'style="display:none;"';
    }

    $state = (!empty($atts['state'])) ? ', ' . $atts['state']  : '';

    $address = $atts['location'] .' '. $atts['city'] . $state;
    ?>
    <script>
        var store_locator_map_options  =  <?php echo json_encode($map_options); ?>;
        var store_locator_grid_options =  <?php echo json_encode($grid_options); ?>;
        var placeholder_location =  '<?php echo @json_encode($placeholder_setting['location_not_found']); ?>';
        setTimeout(function() {
            wpmsl_update_map('<?php echo $address ?>','<?php echo $atts['radius']?>');
            jQuery('#store_locatore_search_input').val('<?php echo $address?>');
            jQuery('#store_locatore_search_radius option[value="<?php echo $atts['radius']?>"]').prop('selected', true);
            if (jQuery.fn.niceSelect) {  
                jQuery('#store_locatore_search_radius').niceSelect('update'); 
            }
        },2000);
    </script>

    <script type='text/javascript' src='<?php echo STORE_LOCATOR_PLUGIN_URL . '/assets/js/frontend_script.js'; ?>'></script>
    <script type='text/javascript' src='<?php echo STORE_LOCATOR_PLUGIN_URL . '/assets/js/bootstrap-modal.js'; ?>'></script>
    <script type="text/javascript" src="//rawgit.com/googlemaps/v3-utility-library/master/infobox/src/infobox.js"></script>
    <link rel='stylesheet' href='<?php echo STORE_LOCATOR_PLUGIN_URL . '/assets/css/bootstrap-modal.css'; ?>'>

    <?php
    $map_height = 'height:774px;';
    if(isset($map_options['height']) && !empty($map_options['height'])) {
        $map_height = 'height:' . $map_options['height'].$map_options['heightunit'].';'; 
    }
    
    $map_width = 'width:100%;';
    if(isset($map_options['width']) && !empty($map_options['width'])) {
        $map_width = 'width:' . $map_options['width'].$map_options['widthunit'].';'; 
    }
    ?>
    
    <div class="row ob_stor-relocator" id="store-locator-id" style="<?php echo $map_height . $map_width?>">
           <?php $map_landing_address=get_option('map_landing_address') ?>
                <input id="store_locatore_search_lat" name="store_locatore_search_lat" type="hidden" value="<?php echo isset($map_landing_address['lng']) ? $map_landing_address['lat'] : ''; ?>">
                <input id="store_locatore_search_lng" name="store_locatore_search_lng" type="hidden" value="<?php echo isset($map_landing_address['lng']) ? $map_landing_address['lng'] : ''; ?>">
        <?php
        echo do_action('wpmsl_before_map');?>

        <div class="loader"><div>
            <?php
                $placeholder_settings = get_option('placeholder_settings');
                ?>

                <?php if(!empty($map_options['default_search'])){ ?>
                    <div class="col-left leftsidebar slide-left <?php echo isset($grid_options['listing_position']) ? $grid_options['listing_position'].'-skip ' : 'below_map-skip ';  echo isset($grid_options['search_window_position']) ? $grid_options['search_window_position'] : 'wpml_above_map'; ?>">

                        <?php
                        $map_window_open = '';
                        if(isset($map_options['map_window_open'])) {
                            $map_window_open = $map_options['map_window_open'];
                            if(!empty($map_window_open))
                                $map_window_open = 'show_store_locator';
                        }
                     
                        ?>
                        <div class="search-options-btn"><?php echo (isset($placeholder_settings['search_options_btn']) && !empty($placeholder_settings['search_options_btn'])) ? $placeholder_settings['search_options_btn'] : _e('Search Options','wpmsl'); ?></div>

                        
            <div class="store-search-fields <?php echo $map_window_open?>">
                <form id="store_locator_search_form" >
                    <?php if(!empty($display)): ?>
                    <div class="store_locator_field">
                <input id="store_locatore_get_btn" class="<?php echo $map_options['search_field_get_my_location']?>"  type="button" value="<?php  echo __($btn, 'store_locator'); ?>"  <?php echo $display; ?>  />
                    </div>
                <?php endif; ?>
                    <div class="store_locator_field <?php echo isset($map_options['search_field_location']) ? $map_options['search_field_location'] : ''; ?>">
                <input id="store_locatore_search_input"  class="wpsl_search_input " name="store_locatore_search_input" type="text" placeholder="<?php echo ($placeholder_settings['enter_location_txt'] == ''? _e('Location / Zip Code','wpmsl') :$placeholder_settings['enter_location_txt']); ?>">
                    </div>
                 
                
                <?php if($radius): ?>
                    <div class="store_locator_field <?php echo isset($map_options['search_field_radius']) ? $map_options['search_field_radius'] : ''; ?>">
                    <select id="store_locatore_search_radius" name="store_locatore_search_radius" class="wpsl_search_radius ">
                        <?php foreach ($radius as $option): ?>
                            <?php
                            $default = (preg_match("/\[[^\]]*\]/", $option))?true:false;
                            $option = str_replace(array('[',']'), array('',''), $option);
                            ?>
                            <option value="<?php echo $option; ?>" <?php echo ($default)?"selected":"" ?> ><?php echo $option." ".$map_options['unit'] ; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <?php endif; ?>

                <?php
                $terms = get_terms( 'store_locator_category', array('hide_empty' => 0));
                ?>
                <div class="store_locator_field <?php echo isset($map_options['category']) ? $map_options['category'] : ''; ?>">
                    <select name="store_locator_category" id="wpsl_store_locator_category" class="wpsl_locator_category ">
                        <option value=""> <?php echo (!isset($placeholder_settings['select_category_txt']) && $placeholder_settings['select_category_txt']== '') ? _e("Select Category","wpmsl") :$placeholder_settings['select_category_txt']; ?> </option>
                        <?php foreach ( $terms as $term ) : ?>
                            <option value="<?php echo $term->term_id; ?>"> <?php echo $term->name; ?> </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                

                <?php
                $terms = get_terms( 'store_locator_tag', array('hide_empty' => 0));
                 ?>
                <div class="store_locator_field <?php echo isset($map_options['tag']) ? $map_options['tag'] : ''; ?>">
                    <select placeholder="<?php echo (!isset($placeholder_settings['select_tags_txt']) && $placeholder_settings['select_tags_txt'] == '' )? _e('Select Tags','wpmsl'): $placeholder_settings['select_tags_txt']; ?>" name="store_locator_tag[]" class="wpsl_locator_category " id="store_locator_tag" multiple="multiple">
                        <?php foreach ( $terms as $term ) : ?>
                            <option value="<?php echo $term->term_id; ?>"> <?php echo $term->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
               
                <div class="store_locator_field">               
                <input id="store_locatore_search_btn" type="submit" value="<?php  _e("Search", 'wpmsl'); ?>" />
            </div>
                            </form>
                        </div>

                    </div>
                <?php }?>
                <div class="col-right right-sidebar">
                    <div id="map-container" style="position: relative;width: 100%;right: 0%;" class="<?php echo @$grid_options['listing_position']?>">
                        <div id="map_loader" style="display:none;z-index: 9;height: <?php echo $map_options['height'].$map_options['heightunit']; ?>;width: <?php echo $map_options['width'].'%'; ?>;position: absolute;"><div class="uil-ripple-css" style="transform: scale(0.6); margin-left: auto; margin-right: auto;"><div></div><div></div></div></div>
                        <div id="store_locatore_search_results"></div>
                    </div>
                    <?php 
                    if( !empty($grid_options['enable'] ) && isset($grid_options['listing_position']) && $grid_options['listing_position']!='below_map') {                       
                    ?>
                        <div class="map-listings <?php echo $grid_options['listing_position']?>" style="height: <?php echo $map_options['height']?>px">
                        </div>
                        
                    <?php } ?>      
                    
                </div>

            </div>
            <script>
                // adding class in content div
                jQuery( ".ob_stor-relocator" ).addClass( "full_width_div" );
                jQuery( ".ob_stor-relocator" ).addClass( "full_width_div" );
                jQuery( ".loader" ).append( '<img class="load-img" src="<?php echo apply_filters('wpmsl_loading_img',STORE_LOCATOR_PLUGIN_URL.'assets/img/loader.gif'); ?>" width="350" height="350" >' );
               
                jQuery( ".ob_stor-relocator" ).append( '<div class="overlay-store"></div>' );

                jQuery(document).ready(function () {
                    jQuery( ".closesidebar" ).click(function() {
                        jQuery( '.leftsidebar' ).toggleClass( "slide-left" );
                        jQuery( this ).toggleClass( "arrow_right" );
                    });



                });
            </script>
        </div></div>
          <?php 
                    if( !empty( $grid_options['enable'] ) && isset($grid_options['listing_position']) && $grid_options['listing_position']=='below_map') {                      
                    ?>
                        <div class="map-listings <?php echo $grid_options['listing_position']?>" style="height: <?php echo $map_options['height']?>px">
                        </div>
                    <?php } ?>   
    <?php
    do_action('wpmsl_end_shortcode',$address,$atts['radius']);
    return ob_get_clean();
}

// Do Search Ajax
add_action('wp_ajax_make_search_request', 'make_search_request');
add_action('wp_ajax_nopriv_make_search_request', 'make_search_request');
function make_search_request() {

//    $address    = $_POST['store_locator_address'];
    global $wpdb;
    $map_options  = get_option('store_locator_map');
    $grid_options = get_option('store_locator_grid');
    $center_lat   = $_POST['lat'];
    $center_lng   = $_POST['lng'];
    $radius       = (isset($_POST["store_locatore_search_radius"]))?("HAVING distance < ".$_POST["store_locatore_search_radius"]):"";
    $unit         = ( $map_options['unit'] == 'km' ) ? 6371 : 3959;
    $stores       = array();
    $total =  (isset($grid_options['total_markers']) && !empty($grid_options['total_markers']) && $grid_options['total_markers']!='-1') ? absint($grid_options['total_markers']) : '100000';
// Check if we need to filter the results by category.
    $tag_filter = '';
    $cat_filter = '';
    if ((isset($_POST['store_locator_category']) && $_POST['store_locator_category']) && (!isset($_POST['store_locator_tag']) || !$_POST['store_locator_tag'])) {
        if(is_array($_POST['store_locator_category'])){
            $filter_category_ids = $_POST['store_locator_category'];
        }else{
            $filter_category_ids = array($_POST['store_locator_category']);
        }
        $cat_filter = " INNER JOIN $wpdb->term_relationships AS term_rel ON posts.ID = term_rel.object_id
                        INNER JOIN $wpdb->term_taxonomy AS term_tax ON term_rel.term_taxonomy_id = term_tax.term_taxonomy_id
                        AND term_tax.taxonomy = 'store_locator_category'
                        AND term_tax.term_id IN (" . implode(',', $filter_category_ids) . ") ";
    }
    if ((isset($_POST['store_locator_tag']) && $_POST['store_locator_tag']) && (!isset($_POST['store_locator_category']) || !$_POST['store_locator_category'])) {
        if(is_array($_POST['store_locator_tag'])){
            $filter_tag_ids = $_POST['store_locator_tag'];
        }else{
            $filter_tag_ids = array($_POST['store_locator_tag']);
        }
        $tag_filter = " INNER JOIN $wpdb->term_relationships AS term_rel ON posts.ID = term_rel.object_id
                        INNER JOIN $wpdb->term_taxonomy AS term_tax ON term_rel.term_taxonomy_id = term_tax.term_taxonomy_id
                        AND term_tax.taxonomy = 'store_locator_tag'
                        AND term_tax.term_id IN (" . implode(',', $filter_tag_ids) . ") ";
    }

    if ((isset($_POST['store_locator_tag']) && $_POST['store_locator_tag']) && (isset($_POST['store_locator_category']) && $_POST['store_locator_category'])) {
        if(is_array($_POST['store_locator_tag'])){
            $filter_tag_ids = $_POST['store_locator_tag'];
        }else{
            $filter_tag_ids = array($_POST['store_locator_tag']);
        }
        if(is_array($_POST['store_locator_category'])){
            $filter_category_ids = $_POST['store_locator_category'];
        }else{
            $filter_category_ids = array($_POST['store_locator_category']);
        }
        $query_byTag="
                SELECT DISTINCT psts.ID
                FROM $wpdb->posts AS psts, $wpdb->term_relationships AS psts_rel, $wpdb->terms AS psts_ter
                WHERE psts.ID = psts_rel.object_id
                AND psts_ter.term_id = psts_rel.term_taxonomy_id
                AND psts_ter.term_id IN (".implode(',', $filter_tag_ids).")";

        $query_byCat="
                SELECT DISTINCT psts.ID
                FROM $wpdb->posts AS psts, $wpdb->term_relationships AS psts_rel, $wpdb->terms AS psts_ter
                WHERE psts.ID = psts_rel.object_id
                AND psts_ter.term_id = psts_rel.term_taxonomy_id
                AND psts_ter.term_id IN (".implode(',', $filter_category_ids).")";

        $tag_filter = " AND posts.ID IN (".$query_byTag.") ";
        $cat_filter = " AND posts.ID IN (".$query_byCat.") ";
    }

    // Set Your Custom Post Type with lat & lng meta field
    $store_locator_array = array('post_type' => 'store_locator','lat'=> 'store_locator_lat','lng'=> 'store_locator_lng');
    $store_locator = apply_filters('wpmsl_query_array',$store_locator_array);

    $strore_post_type = $store_locator['post_type'];
    $strore_lat = $store_locator['lat'];
    $strore_lng = $store_locator['lng'];



    $stores_query = $wpdb->get_results("SELECT post_lat.meta_value AS lat,
                           post_lng.meta_value AS lng,
                           posts.ID,
                           ( $unit * acos( cos( radians( $center_lat ) ) * cos( radians( post_lat.meta_value ) ) * cos( radians( post_lng.meta_value ) - radians( $center_lng ) ) + sin( radians( $center_lat ) ) * sin( radians( post_lat.meta_value ) ) ) )
                      AS distance
                      FROM $wpdb->posts AS posts
                      INNER JOIN $wpdb->postmeta AS post_lat ON post_lat.post_id = posts.ID AND post_lat.meta_key = '$strore_lat'
                      INNER JOIN $wpdb->postmeta AS post_lng ON post_lng.post_id = posts.ID AND post_lng.meta_key = '$strore_lng'
                      $cat_filter
                      $tag_filter
                      WHERE posts.post_type = '$strore_post_type'
                      AND posts.post_status = 'publish' GROUP BY posts.ID $radius ORDER BY distance LIMIT 0,$total"

    );

    $stores = apply_filters('wpmsl_store_query',$stores_query,$strore_post_type,$strore_lat,$strore_lng,$center_lat,$center_lng,$unit,$radius);

    // include STORE_LOCATOR_PLUGIN_PATH . 'views/results.php';
	show_stores($stores,$map_options,$center_lat,$center_lng,$grid_options);
    wp_die();
}


function show_stores($stores,$map_options ,$center_lat  , $center_lng ,$grid_options){

$counter = 0;
if ($stores) {
    require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );
    global $user_ID;
    global $wpdb;
    $single_options = get_option('store_locator_single');
   $placeholder=get_option('placeholder_settings',true); 
    $locations['center'] = array('lat' => $center_lat, 'lng' => $center_lng);
	foreach ($stores as $store) {
			if(defined('ICL_LANGUAGE_CODE')){
				$my_post_language_details = apply_filters( 'wpml_post_language_details', NULL, $store->ID) ;                
				if(!empty($my_post_language_details['language_code']) 
					and 
					$my_post_language_details['language_code'] == ICL_LANGUAGE_CODE){
					$filter_stores[] = $store;
				}               
			}
    }
    if(!empty($filter_stores) and is_array($filter_stores)){
        $stores = $filter_stores;
    } 
    foreach ($stores as $store) {
        $meta = get_post_meta($store->ID);
        $working_hours = "<table class='store_locator_working_hours'><tr><td colspan='3'>" . __("Working Hours", "store_locator") . "</td></tr>";
        $metaDays = $meta['store_locator_days'][0];
        $metaDays = unserialize($metaDays);     
        $days = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
        foreach ($days as $day) {
            $working_hours .= "<tr class='".(($metaDays[$day]['status'] == "1") ?'store-locator-open':'store-locator-closed') ."'><td>" . $day . "</td><td>" . (($metaDays[$day]['status'] == "1") ? __("Open", "store_locator") : __("Closed", "store_locator")) . "</td><td><span class='store_locator_start'>" . $metaDays[$day]['start'] . "</span><span class='store_locator_end'>" . $metaDays[$day]['end'] . "</span></td></tr>";
        }
        $working_hours .= "</table>";
		if (has_post_thumbnail( $store->ID ) ){ 
		 $images = wp_get_attachment_image_src( get_post_thumbnail_id( $store->ID ), 'single-post-thumbnail' );

		 $image = '<div class="img-content" ><img  style="width:150px;" src="'.$images[0].'" /></div>';

		} else {
			 $image = '';
		}

		$options = get_option('store_locator_map',true);
        $radius_unit = $options['unit'];

        $infowindow_content = $options['infowindow'];
        $infowindow_source = $options['info_window_source'];

        $APKI_KEY = get_option('store_locator_street_API_KEY');

        $img = '';
        $get_store_img = wp_get_attachment_url( get_post_thumbnail_id($store->ID) );
        if(!empty($get_store_img))
            $img = '<img src="'.$get_store_img.'" class="store-img"/>';
//        $img = '<div id="store-'.$counter.'" class="pano-street" style="height:200px"></div>';
		if( $single_options['page'] )
			$store_title = '<a href="'.get_permalink( $store->ID ).'" target="_blank">' . get_the_title($store->ID) . '</a>';
		else
			$store_title =  get_the_title($store->ID);
        $infowindow_content = str_replace('{image}',$img,$infowindow_content);
        $infowindow_content = str_replace('{name}',$store_title,$infowindow_content);
        $infowindow_content = str_replace('{address}',get_post_meta($store->ID,'store_locator_address',true),$infowindow_content);
        $infowindow_content = str_replace('{city}',get_post_meta($store->ID,'store_locator_city',true),$infowindow_content);
        $infowindow_content = str_replace('{state}',get_post_meta($store->ID,'store_locator_state',true),$infowindow_content);
        $infowindow_content = str_replace('{country}',get_post_meta($store->ID,'store_locator_country',true),$infowindow_content);
        $infowindow_content = str_replace('{zipcode}',get_post_meta($store->ID,'store_locator_zipcode',true),$infowindow_content);
        $infowindow_content = str_replace('{phone}',get_post_meta($store->ID,'store_locator_phone',true),$infowindow_content);
        $store_locator_website = get_post_meta($store->ID,'store_locator_website',true);
		if(!empty($store_locator_website)){
        $infowindow_content = str_replace('{website}','<a href="'.get_post_meta($store->ID,'store_locator_website',true).'">'.((isset($placeholder['visit_website']) && !empty($placeholder['visit_website'])) ? $placeholder['visit_website'] : __("Visit Website","store_locator")).'</a>',$infowindow_content);
        }
        else{
             $infowindow_content = str_replace('{website}','',$infowindow_content);
        }
        $infowindow_content .= '<div class="wpsl-distance">'.number_format($store->distance, 2) . ' '.$radius_unit.'</div>';

        $pano_loader = '';
        if($infowindow_source == 'none')
            $pano_loader = 'pano-hide';

        $infowindow = '<div class="store-infowindow">';
        $infowindow .= apply_filters('wpmsl_infowindow_content',$infowindow_content,$store);
        $infowindow .= '</div>';

		$markers_location = array('lat' => $store->lat, 'lng' => $store->lng, 'infowindow' => $infowindow);
		$markers_location = apply_filters('wpmsl_markers_location',$markers_location,$infowindow,$store);
		$locations['locations'][] = $markers_location;

        //insert transactions to DB
         $sql = "INSERT INTO store_locator_transactions (`post_id`, `user_id`, `date`) VALUES ('".$store->ID."', '".$user_ID."', '".date('Y-m-d H:i:s')."')";
         dbDelta($sql);
        $counter++;
    }
} else {
    $locations = array('center' => array('lat' => $center_lat, 'lng' => $center_lng), 'locations' => array());
}
?>

<!-- Show Map -->
<?php
$width = '100%';
if( empty( $grid_options['enable'] ) ) {
	$width = '100%';
}

if ($map_options['enable']): $map_options['enable'];?>

	<div id="store_locatore_search_map" style="height: <?php echo $map_options['height'] . $map_options['heightunit']; ?>;width: <?php echo $width?>;position:absolute" class="<?php echo $map_options['listing_position']?>"></div>

    <script>
        var locations = <?php echo json_encode($locations); ?>;
        store_locator_map_initialize(locations);
    </script>
<?php

	do_action('store_locations',$locations);

 endif; ?>

<!-- Show Grid -->
<?php if ($grid_options['enable'] && isset($grid_options['columns']) && $grid_options['columns']): ?>
    <br>
    <?php if(empty($grid_options['view']) || $grid_options['view'] == 'table'): ?>
    <div class="store_locator_table-container" style="overflow: auto;">
        <table class="store_locator_grid_results" style="margin: 0px;">
            <thead>
                <tr>
                    <?php foreach ($grid_options['columns'] as $column): ?>
                        <th><?php echo $column; ?></th>
                    <?php endforeach; ?>
                </tr>
                </thead>
                    <tbody>
                <?php
                if($stores){
                     if ( is_plugin_active( 'gravityforms/gravityforms.php' ) ) {
                        require_once( GFCommon::get_base_path() . '/form_display.php' );
                     }
                $index = 1;
                foreach ($stores as $store) {
                    $meta = get_post_meta($store->ID);
                    echo '<tr class="store_locator_tr" style="' . (($grid_options['total_markers'] > 0 && $index > $grid_options['total_markers']) ? 'display: none;' : '') . ' ">';
                    foreach ($grid_options['columns'] as $column) {
                        echo '<td>';
                        switch ($column) {
                            case 'name':
                                if($single_options['page']){
                                    echo "<a href='". get_post_permalink($store->ID) ."'>".$meta['store_locator_name'][0]."</a>";
                                }else{
                                    echo ($meta['store_locator_name'][0])?$meta['store_locator_name'][0]:'-';
                                }
                                break;
                            case 'address':
                                echo ($meta['store_locator_address'][0])?$meta['store_locator_address'][0]:'-';
								echo 'abtest1';
                                break;
                            case 'city':
                                echo ($meta['store_locator_city'][0])?$meta['store_locator_city'][0]:'-';
                                break;
                            case 'state':
                                echo ($meta['store_locator_state'][0])?$meta['store_locator_state'][0]:'-';
                                break;
                            case 'country':
                                echo ($meta['store_locator_country'][0])?$meta['store_locator_country'][0]:'-';
                                break;
                            case 'zipcode':
                                echo ($meta['store_locator_zipecode'][0])?$meta['store_locator_zipecode'][0]:'-';
                                break;
                            case 'website':
                                echo ($meta['store_locator_website'][0])?$meta['store_locator_website'][0]:'-';
                                break;
                            case 'phone':
                                echo ($meta['store_locator_phone'][0])?$meta['store_locator_phone'][0]:'-';
                                break;
                            case 'fax':
                                echo ($meta['store_locator_fax'][0])?$meta['store_locator_fax'][0]:'-';
                                break;
                            case 'full_address':
                                echo $meta['store_locator_address'][0] . " " . $meta['store_locator_city'][0] . " " . $meta['store_locator_state'][0] . " " . $meta['store_locator_country'][0] . " " . $meta['store_locator_zipcode'][0];
								echo 'abtest2';
                                break;
                            case 'working_hours':
                                $working_hours = "<table class='store_locator_working_hours'>";
                                $metaDays = $meta['store_locator_days'][0];
                                $metaDays = unserialize($metaDays);
                                $days = array(
                                        "Monday",
                                        "Tuesday",
                                        "Wednesday",
                                        "Thursday",
                                        "Friday",
                                        "Saturday",
                                        "Sunday");
                                foreach ($days as $day) {
                                    $working_hours .= "<tr class='".(($metaDays[$day]['status'] == "1") ?'store-locator-open':'store-locator-closed') ."'><td>" . $day . "</td><td>" . (($metaDays[$day]['status'] == "1") ? __("Open", "store_locator") : __("Closed", "store_locator")) . "</td><td><span class='store_locator_start'>" . $metaDays[$day]['start'] . "</span><span class='store_locator_end'>" . $metaDays[$day]['end'] . "</span></td></tr>";
                                }
                                $working_hours .= "</table>";
                                echo $working_hours;
                                break;
                            case 'managers':
                                $sales = unserialize($meta['store_locator_sales'][0]);
                                if ($sales) {
                                    foreach ($sales as $manager) {
                                        echo get_post($manager)->post_title . "<br>";
                                    }
                                }else{
                                    echo '-';
                                }
                                break;
                            case 'gravity_form':
                                if ( is_plugin_active( 'gravityforms/gravityforms.php' ) ) {
                                $form_id = $meta['store_locator_gform'][0];
                                // get form array
                                $form = RGFormsModel::get_form_meta( $form_id );
                                // form is valid
                                if(empty($form)) {
                                    echo '-';
                                    break;
                                }
                                // print form scripts
                                GFFormDisplay::print_form_scripts($form, true);
                                ?>
                                <!-- Trigger the modal with a button -->
                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-backdrop="static" data-keyboard="false"  data-target="#store-locator-modal-<?php echo $store->ID; ?>"><?php _e('Show Form', 'store_locator'); ?></button>

                                <!-- Modal -->
                                <div id="store-locator-modal-<?php echo $store->ID; ?>" class="modal fade store_locator_gf_form" role="dialog" style="display: none !important;">
                                  <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                      </div>
                                      <div class="modal-body">
                                        <?php
                                            $request_uri = $_SERVER['REQUEST_URI'];
                                            $_SERVER['REQUEST_URI'] = $_SERVER['HTTP_REFERER'];
                                            gravity_form($form_id, false, false, false, array( 'store_id' => $store->ID, 'test' => 2 ), true, 12);
                                            $_SERVER['REQUEST_URI'] = $request_uri;
                                        ?>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <?php
                                }else{
                                    echo '-';
                                }
                                break;
                            default :
                                break;
                        }
                        echo '</td>';
                    }
                    echo '</tr>';
                    $index++;
                }
                }else{
                    echo "<tr><td class='store-locator-not-found' style='text-align: center;' colspan='".count($columns)."'><span><i class='fa fa-map-marker' aria-hidden='true'></i></span><p>". apply_filters('wpmsl_no_stores_found','No Store found') ."</p></td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
        <?php else: ?>
        <div class="store-locator-item-container">
            <?php $placeholder=get_option('placeholder_settings',true); 
            if(isset($placeholder['store_list']) && !empty($placeholder['store_list'])){
            ?>
            <div class="wpsl-list-title"><?php echo $placeholder['store_list']; ?></div>
            <?php } ?>
                <?php
                if($stores){
                 if ( is_plugin_active( 'gravityforms/gravityforms.php' ) ) {
                    require_once( GFCommon::get_base_path() . '/form_display.php' );
                 }
                $index = 1;
				$counter = 1;
				$listing_counter = 1;

                $map_options = get_option('store_locator_map');
                $accordion = '';
                if($map_options['show_accordion'])
                    $accordion = 'accordion-show';
                foreach ($stores as $store) {

					echo '<div class="store-locator-item '.$accordion.'" data-store-id="'.$store->ID.'" data-marker="'. ($counter-1) .'" id="list-item-'. ($counter-1) .'" >';

					do_action('wpmls_before_list_item',$store,$listing_counter);
					$listing_counter++;

					echo '<div class="circle-count">';
						echo apply_filters('wpmsl_list_counter',$counter++,$store);
					echo '</div>';

					$radius_unit = get_option('store_locator_map',true);
					$radius_unit = $radius_unit['unit'];
                    $address = get_post_meta($store->ID,'store_locator_address',true);

                    echo '<div class="store-list-details">';
                    
                    echo '<div class="store-list-address">';
					if( $single_options['page'] )
						$store_title = '<a href="'.get_permalink( $store->ID ).'" target="_blank">' . get_the_title($store->ID) . '</a>';
					else
						$store_title =  get_the_title($store->ID);
                    echo '<input type="hidden" id="pano-address-'.$store->ID.'" class="pano-address" value="'.$address.'" />';
                    $list_content = '<div class="wpsl-name">' . $store_title . '</div>';
                    $list_content .= '<div class="wpsl-distance">'.number_format($store->distance, 2) . ' '.$radius_unit.'</div>';
                    $list_content .= '<div class="wpsl-address">'. $address . '</div>';
                    $list_content .= '<div class="wpsl-city">'.get_post_meta($store->ID,'store_locator_city',true). ', ' . get_post_meta($store->ID,'store_locator_state',true) . ' ' . get_post_meta($store->ID,'store_locator_zipcode',true) .'</div>';
					$store_locator_phone = get_post_meta($store->ID,'store_locator_phone',true);
					if(!empty($store_locator_phone)){
						$list_content .= '<div class="wpsl-phone"> <a href="tel:'.get_post_meta($store->ID,'store_locator_phone',true).'">'.get_post_meta($store->ID,'store_locator_phone',true).'</a> </div>';
					}
					echo $list_data = apply_filters('wpmsl_list_item',$list_content,$store,$radius_unit);

                    do_action('wpmsl_listing_list_item',$store);

					$weblink = get_post_meta($store->ID,'store_locator_website',true);
					if(!empty($weblink)){
					   ?><div class="wpsl-wesite-link"><a href="<?php echo $weblink;?>" target="_blank"><?php echo (isset($placeholder['visit_website']) && !empty($placeholder['visit_website'])) ? $placeholder['visit_website'] : __("Visit Website","store_locator"); ?></a></div>
                   
<?php
                        }
                    $direction_icon = plugins_url( 'assets/img/directions-1x-20150909.png', dirname(__FILE__) );
                    $direction_icon = str_replace(' ','%20',$direction_icon);

                    echo '<div class="store_days_time">';
                    $store_locator_days = get_post_meta($store->ID,'store_locator_days',true);
                    foreach( $store_locator_days as $key => $value ) {
                            if( !empty($value['start']) ) {
                                echo '<p class="days"><b>'.$key.'</b></p>';
                                foreach( $value as $k => $v ) {
                                    if($k == 'start')
                                        echo '<p class="time"><i class="fa fa-clock-o" aria-hidden="true"></i> ' . $v;
                                    else if($k == 'end')
                                    echo ' - ' . $v . '</p>';
                                }
                            }
                    }
                    echo '</div>';

					 echo '</div>';
                     echo "<div class='store-direction' data-direction='".$store->lat.",".$store->lng."' style='cursor:pointer;'>";
                          _e('Get Direction','store_locator');
                        echo "<div jstcache='600' class='section-hero-header-directions-icon' style='background-image:url(".STORE_LOCATOR_PLUGIN_URL."assets/img/directions-1x-20150909.png);background-size: 14px;width: 14px;height: 14px;background-repeat: no-repeat;float: right;'></div>
                        </div>";
					echo '</div>';
                    $index++;

					do_action('wpmls_after_list_item',$store);
					
                echo '</div>';
                }
                }else{
                    echo "<tr><td style='text-align: center;' colspan='".count($columns)."'><div class='store-locator-not-found'><i class='fa fa-map-marker' aria-hidden='true'></i><p>". apply_filters('wpmsl_no_stores_found',__('No Store found','store_locator')) ."</p></div>" ."</td></tr>";
                }
				
                ?>

        </div>
        <?php endif; ?>
        <?php $elements = $grid_options['columns']; ?>
        <?php if (!$grid_options['scroll'] && !empty($elements[0])): ?>
            <div id="store_locator_load_more" style="<?php echo (count($stores) > $grid_options['total_markers']) ? 'display: block;' : 'display: none;'; ?>"> Load more ...</div>
            <script>
                jQuery('#map_loader').hide();
                jQuery('#store_locator_load_more').click(function () {
                    if(jQuery('.store_locator_grid_results tr.store_locator_tr:hidden').length <= <?php echo $grid_options['total_markers']; ?>){
                        jQuery('#store_locator_load_more').hide();
                    }
                    jQuery('.store_locator_grid_results tr.store_locator_tr:hidden:lt(<?php echo $grid_options['total_markers']; ?>)').show("slow");
                    if(jQuery('.store-locator-item:hidden').length <= <?php echo $grid_options['total_markers']; ?>){
                        jQuery('#store_locator_load_more').hide();
                    }
                    jQuery('.store-locator-item:hidden:lt(<?php echo $grid_options['total_markers']; ?>)').show("slow");
                });
            </script>
        <?php endif; ?>    
    </div>
    <?php if ($grid_options['scroll']): ?>
        <script>
            jQuery('#map_loader').hide();
            <?php if (count($stores) > $grid_options['total_markers']):?>        
                jQuery('.store_locator_table-container').scroll(function() {
                    if(jQuery('.store_locator_table-container').scrollTop() == jQuery('.store_locator_grid_results').height() - jQuery('.store_locator_table-container').height()) {
                        jQuery('.store_locator_grid_results tr.store_locator_tr:hidden:lt(<?php echo $grid_options['total_markers']; ?>)').show("slow");
                    }
                });
                jQuery('.store_locator_table-container').height(jQuery('.store_locator_table-container').height()-5);
            <?php endif; ?>    
        </script>
    <?php endif; ?>    
<?php endif; ?>


<style>
/*
Max width before this PARTICULAR table gets nasty
This query will take effect for any screen smaller than 760px
and also iPads specifically.
*/
@media
only screen and (max-width: 760px),
(min-device-width: 768px) and (max-device-width: 1024px)  {

        /* Force table to not be like tables anymore */
        table.store_locator_grid_results, .store_locator_grid_results thead, .store_locator_grid_results tbody, .store_locator_grid_results th, .store_locator_grid_results td, .store_locator_grid_results tr {
                display: block;
        }

        /* Hide table headers (but not display: none;, for accessibility) */
        .store_locator_grid_results thead tr {
                position: absolute;
                top: -9999px;
                left: -9999px;
        }

        .store_locator_grid_results tr { border: 1px solid #ccc; }

        .store_locator_grid_results td {
                /* Behave  like a "row" */
                border: none;
                border-bottom: 1px solid #eee;
                position: relative;
                padding-left: 50%;
        }

        .store_locator_grid_results td:before {
                /* Now like a table header */
                position: absolute;
                /* Top/left values mimic padding */
                top: 6px;
                left: 6px;
                width: 45%;
                padding-right: 10px;
                white-space: nowrap;
        }

        /*
        Label the data
        */
        <?php $index = 1; ?>
        <?php foreach ($grid_options['columns'] as $column): ?>
            .store_locator_grid_results td:nth-of-type(<?php echo $index; ?>):before { content: "<?php echo ucfirst($column); ?>"; }
            <?php $index++; ?>
        <?php endforeach; ?>

</style>

<?php 
} 


// Settings Page
function store_locator_settings_page_callback() {
    

    $store_locator_API_KEY  = get_option('store_locator_API_KEY');
    $store_locator_street_API_KEY  = get_option('store_locator_street_API_KEY');
    $map_options  = get_option('store_locator_map');
    $grid_options = get_option('store_locator_grid');
    $single_options = get_option('store_locator_single');
    $placeholder_setting = get_option('placeholder_settings');

    include STORE_LOCATOR_PLUGIN_PATH . 'views/settings.php';
}

// Statistics Page
function statistics_submenu_page_callback() {
    global $wpdb;
    $args = array(
        'post_type' => 'store_locator',
        'post_status' => 'publish',
        'posts_per_page' => -1
    );
    $stores = get_posts($args);
    $posts_table = $wpdb->prefix . 'posts';
    $transactions = $wpdb->get_results("SELECT ps.post_title as store, count(tr.post_id) as total_count FROM $posts_table ps LEFT JOIN store_locator_transactions tr ON tr.post_id=ps.ID WHERE ps.post_type='store_locator' AND ps.post_status='publish' GROUP BY ps.ID");

    include STORE_LOCATOR_PLUGIN_PATH . 'views/statistics.php';
}


function sample_admin_notice__error($array) {
    $class = 'notice notice-error';
    // $error = '<p>For get your current location SSL must required</p>';
    $admin_notice_array = admin_notice_array($array);
    if(!empty($admin_notice_array)){


        foreach(admin_notice_array($array) as $key => $value){
            if(
                //condition one is site must be ssl.
                !is_ssl() and $key == 'wp-locator-ssl-error'
            ){
                $message = __( $value, $key );
                printf( '<div class="%1$s"><p>%2$s</p></div>', $class, $message );
            }
        }
    }
    $store_locator_API_KEY = get_option('store_locator_API_KEY');
    if(empty($store_locator_API_KEY)){
        $message = __( 'Must Provide Google Map Api for Search Location via google map <a target="_blank" href="https://developers.google.com/maps/documentation/javascript/get-api-key">Click here to Create Google Map Api Key.</a>', 'store_locator' );
        printf( '<div class="%1$s"><p>%2$s</p></div>', $class, $message );
    }

}
add_action( 'admin_notices', 'sample_admin_notice__error' );

function admin_notice_array($array){
    Return array(
        'wp-locator-ssl-error' => '<p>Get Current location functionality is disabled For Store Locator Plugin. You must enable SSL for your domain in order to enable this functionality.</p>',
    );
}

// Do update addresses coordinates Ajax
add_action('wp_ajax_update_coordinates', 'import_store_locator_page_callback');
function import_store_locator_page_callback() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        if (isset($_POST['settings'])) {
            update_option('partner_locator_bg', $_POST['partner_locator_bg']);
            echo '<div class="updated notice notice-success below-h2" id="store_locator_message"><p> Settings Updated Successfully.</p></div>';
        }
       
        // Import sales CSV
        if (isset($_POST['import_sales_button'])) {
            require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );
            $csv_mimetypes = array(
                'text/csv',
                'text/plain',
                'text/comma-separated-values',
                'application/excel',
                'application/vnd.ms-excel',
                'application/vnd.msexcel',
                'application/csv',
                'application/octet-stream',
                'application/txt',
            );
            if (!$_FILES['csv-file']['tmp_name'] || !(in_array($_FILES['csv-file']['type'], $csv_mimetypes)) || $_FILES['csv-file']['size'] == 0) {
                ?>
                <div class="error notice notice-success below-h2" id="message"><p><?php echo __('Please select CSV file.','store_locator'); ?></p></div>
                <?php
            } else {
                $csv = array_map('str_getcsv', file($_FILES['csv-file']['tmp_name']));

                $header = array_shift($csv);
                $sales = array();
                foreach ($csv as $row) {
                    $sales[] = array_combine($header, $row);
                }

                global $user_ID;
                global $wpdb;
                $postmeta_table = $wpdb->prefix . 'postmeta';
                foreach ($sales as $partner) {

                    $args = array(
                        'post_type' => 'sales_manager',
                        'status' => 'publish',
                        'meta_query' => array(
                            array(
                                'key' => 'sales_manager_id',
                                'value' => $partner['Code'],
                                'compare' => '='
                            )
                        )
                    );
                    $exist_post = get_posts($args);
                    if($exist_post &&  $partner['Code']){
                        //edit existing post
                        $edit_post = array(
                            'ID' => $exist_post[0]->ID,
                            'post_title' => $partner['Name'],
                            'post_name' => $partner['Name'] . uniqid(),
                        );
                        $post_id = wp_update_post($edit_post);
                        $wpdb->delete($postmeta_table, array('post_id' => $post_id) );
                    }else{
                        //add new post
                        $new_post = array(
                            'post_title' => $partner['Name'],
                            'post_name' => $partner['Name'] . uniqid(),
                            'post_status' => 'publish',
                            'post_date' => date('Y-m-d H:i:s'),
                            'post_author' => $user_ID,
                            'post_type' => 'sales_manager'
                        );
                        $post_id = wp_insert_post($new_post);
                    }
                    $valuesArr = array();
                    // $sql = "INSERT INTO " . $postmeta_table . " (`post_id`, `meta_key`, `meta_value`) VALUES ";
                    // update post meta
                    $valuesArr[] = array($post_id, 'sales_manager_name', $partner['Name']);
                    $valuesArr[] = array($post_id, 'sales_manager_id', $partner['Code']);
                    $valuesArr[] = array($post_id, 'sales_manager_phone', $partner['Phone']);
                    $valuesArr[] = array($post_id, 'sales_manager_email', $partner['Email']);
                    $valuesArr[] = array($post_id, 'sales_manager_title', $partner['Title']);

                    foreach ($valuesArr as $value) {
                        update_post_meta( $value[0], $value[1], $value[2] );
                    }

                }

                ?>
                <div class="updated notice notice-success below-h2" id="partner_message"><p><?php echo __('Sales Managers Imported Successfully!','store_locator'); ?></p></div>
                <?php
            }
        }

        // Import stores CSV
        if (isset($_POST['import_stores_button'])) {

            require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );
            $csv_mimetypes = array(
                'text/csv',
                'text/plain',
                'text/comma-separated-values',
                'application/excel',
                'application/vnd.ms-excel',
                'application/vnd.msexcel',
                'application/csv',
                'application/octet-stream',
                'application/txt',
            );
            if (!$_FILES['csv-file']['tmp_name'] || !(in_array($_FILES['csv-file']['type'], $csv_mimetypes)) || $_FILES['csv-file']['size'] == 0) {
                ?>
                <div class="error notice notice-success below-h2" id="message"><p><?php echo __('Please select CSV file.','store_locator'); ?></p></div>
                <?php
            } else {
                ?>
                <script>var addresses = [];</script>
                <?php
                $csv = array_map('str_getcsv', file($_FILES['csv-file']['tmp_name']));
 
                $header = array_shift($csv);
                $stores = $records = array();
                //echo '<pre>';
                //print_r($csv);
                foreach ($csv as $row) {
                    $row[6] = preg_replace("/[^0-9,.]/", "",$row[6]);   
                    $string = str_replace(' ', '-', $row[1]); // Replaces all spaces with hyphens.
                    $row[1] = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
                    $row[1] = $string = str_replace('-',' ', $row[1]); 
                    $row[1] = preg_replace('/\s+/', ' ',$row[1]);
                    
                    
                    $strings = str_replace(' ', '-', $row[2]); // Replaces all spaces with hyphens.
                    $row[2] =  $strings; // Removes special chars. addresss
                    $row[2] = $strings = str_replace('-',' ', $row[2]); 
                    $row[2] = preg_replace('/\s+/', ' ',$row[2]);
                    
                    if(!empty($row[1])){
                        $stores[] =  array_combine($header, $row);
                    }
                }
                //echo '<pre>';
                //print_r($stores);
                //exit;
                // import store's csv to db
                update_option('my_import_stores',$stores);
                ?>
                <div class="updated notice notice-success below-h2" id="store_locator_message"></div>
                <script>
                    var addressesPerBatch = 1;
                    var timeoutPerBatch = 1000;
                    var result = new Array();
                    function updateCoordinates() {
                        

                        if (addresses.length > 0) {
                            setTimeout(updateCoordinates, timeoutPerBatch);
                        } else {
                            // update database with LatLng 
                            jQuery('#store_locator_message').html("<p>Uploading...</p>");
                            setTimeout(function () {
                                 jQuery('#store_locator_message').html("<p>Stores uploaded.</p>");
                            }, 2000);
                        }
                    }

                    jQuery(document).ready(function () {
                        updateCoordinates();
                    });
                </script>
                <?php
            }
        }
    }
    ?>
    <div class="wrap">
        <h2><?php echo __('Import/Export => Stores/Sales Managers','store_locator'); ?></h2>
        <div id="dashboard-widgets" class="metabox-holder">
            <div class="postbox-container" >
                <div class="postbox" >
                    <div class="handlediv"><br></div>
                    <h3 style="cursor: auto;" class="hndle">
                        <span><?php echo __("Upload Stores", 'store_locator'); ?><small>(.csv)</small></span>
                        <a href="<?php echo STORE_LOCATOR_PLUGIN_URL . 'sample-data/Sample_Stores.csv'; ?>" style="float: right;text-decoration: none;" download><?php echo __("Download sample ", 'store_locator'); ?></a>
                    </h3>

                    <div class="inside">
                        <p>
                        <form method="post" name="upload_form" enctype="multipart/form-data">
                            <input type="file"  name="csv-file" />
                            <input class="button"  name="import_stores_button" type="submit" value="<?php echo __('Upload','store_locator'); ?>" />
                        </form>
                        </p>

                    </div>
                </div>
            </div>
            <div class="postbox-container" >
                <div class="postbox" >
                    <div class="handlediv"><br></div>
                    <h3 style="cursor: auto;" class="hndle">
                        <a href="<?php echo STORE_LOCATOR_PLUGIN_URL . 'sample-data/Sample_Sales_Managers.csv'; ?>" style="float: right;text-decoration: none;" download><?php echo __("Download sample ", 'store_locator'); ?></a>
                        <span><?php echo __("Import Sales Managers ", 'store_locator'); ?><small>(.csv)</small></span>
                    </h3>
                    <div class="inside">
                        <p>
                        <form method="post" name="upload_form" enctype="multipart/form-data">
                            <input type="file"  name="csv-file" />
                            <input class="button"  name="import_sales_button" type="submit" value="<?php echo __('Import','store_locator'); ?>" />
                        </form>
                        </p>

                    </div>
                </div>
            </div>
        </div>
        
        <div id="dashboard-widgets" class="metabox-holder">
            <div class="postbox-container" >
                <div class="postbox" >
                    <div class="handlediv"><br></div><h3 style="cursor: auto;" class="hndle"><span><?php echo __("Export Stores ", 'store_locator'); ?><small>(.csv)</small></span></h3>
                    <div class="inside">
                        <p>
                        <form method="post" name="export_form">
                            <a class="button" href="<?php echo admin_url('admin-post.php?action=printStores.csv'); ?>"  ><?php echo __("Export", 'store_locator'); ?></a>
                        </form>
                        </p>

                    </div>
                </div>

            </div>
            <div class="postbox-container" >
                <div class="postbox" >
                    <div class="handlediv"><br></div><h3 style="cursor: auto;" class="hndle"><span><?php echo __("Export Sales Managers ", 'store_locator'); ?><small>(.csv)</small></span></h3>
                    <div class="inside">
                        <p>
                        <form method="post" name="export_form">
                            <a class="button" href="<?php echo admin_url('admin-post.php?action=printSales.csv'); ?>"  ><?php echo __("Export", 'store_locator'); ?></a>
                        </form>
                        </p>

                    </div>
                </div>
            </div>
        </div>
        <div id="dashboard-widgets" class="metabox-holder">
        <div class="postbox-container" >
                <div class="postbox" >
                <div class="inside">
                        <p>
                        <form method="post" name="upload_form" enctype="multipart/form-data">
                            <a class="button import_js_stores"><?php echo __('Click here To Import New/Pending Stores','store_locator'); ?> </a>
                        </form>
                        <h5>
                             <?php echo __('Note : Make sure all your address,country,city,state and zip code columns are properly organized in order to save marker location with google map APi.','store_locator'); ?>
                        </h5>
                        <h3 style="
    margin-top: 30px;
    font-weight: bolder;
    background: #f5fff6;
    padding: 10px;
" > <span id="current-count">0</span> of  <span id="tolalcount">0</span><?php echo __('have been imported','store_locator'); ?> <img class="irc_mi_wp_str" src="<?php echo apply_filters('wpmsl_loading_img',STORE_LOCATOR_PLUGIN_URL.'assets/img/loader2.png'); ?>" width="25" height="25"></h3>
                        
            <?php
            $my_import_stores = get_option('my_import_stores');
            
            if(!empty($my_import_stores)){
                            
                foreach($my_import_stores as $storess){
                        global $wpdb;
                        $postmeta_table = $wpdb->prefix . 'postmeta';
                        $args = array(
                            'post_type' => 'store_locator',
                            'status' => 'publish',
                            'meta_query' => array(
                                array(
                                    'key' => 'store_locator_code',
                                    'value' => $storess['Code'],
                                    'compare' => '='
                                )
                            )
                        );
                    $exist_post = get_posts($args);
                    $store_locator_lat = get_post_meta( @$exist_post[0]->ID, 'store_locator_lat',true );        
                    $store_locator_lng = get_post_meta( @$exist_post[0]->ID, 'store_locator_lng',true );        
                            
                            if(empty($store_locator_lat) and empty($store_locator_lng)){
                                $newstores[] = $storess;
                            }
                            
                    
                }
                $my_import_stores = "";
                if(!empty($newstores)){
                    update_option('my_import_stores',$newstores);
                    $my_import_stores = $newstores;
                }
                
            }
            
            
            
            
            
            
            
            if(is_array($my_import_stores)){
                echo '<br>';
                $count = 1;
                ?> <script>stores_json_encoded = <?php echo json_encode($my_import_stores); ?>;</script>
                <div class='stores_div'>
                <?php
                foreach($my_import_stores as $key => $stores){
                    echo '<div class="store_id_'.$stores['Code'].'">'.$count.' '.$stores['Name'].'</div><br>';
                    $count++;
                }
                echo '</div>';
            }
            ?>
            </p>
        </div>
        </div>
        </div>
        </div>
    </div>
    <?php
}




add_action('wp_ajax_import_js_stores_action', 'import_js_stores_function');
function import_js_stores_function() { 
            if (isset($_POST['import_js_stores_post'])) {
                
            $import_js_stores_post = json_decode(str_replace('\\', '', $_POST['import_js_stores_post']), true);
                
                
                
                if(!empty($import_js_stores_post['Code'])){
                global $user_ID;
                global $wpdb;
                $postmeta_table = $wpdb->prefix . 'postmeta';
                    $args = array(
                        'post_type' => 'store_locator',
                        'status' => 'publish',
                        'meta_query' => array(
                            array(
                                'key' => 'store_locator_code',
                                'value' => $import_js_stores_post['Code'],
                                'compare' => '='
                            )
                        )
                    );
                    $exist_post = get_posts($args);
                    if($exist_post &&  $import_js_stores_post['Code']){
                        //edit existing post
                        $edit_post = array(
                            'ID' => $exist_post[0]->ID,
                            'post_title' => $import_js_stores_post['Name'],
                            'post_name' => $import_js_stores_post['Name'] . uniqid(),
                        );
                        $post_id = wp_update_post($edit_post);
                        $wpdb->delete($postmeta_table, array('post_id' => $post_id) );
                    }else{
                        //add new post
                        $new_post = array(
                            'post_title' => $import_js_stores_post['Name'],
                            'post_name' => $import_js_stores_post['Name'] . uniqid(),
                            'post_status' => 'publish',
                            'post_author' => $user_ID,
                            'post_type' => 'store_locator'
                        );
                        $post_id = wp_insert_post($new_post);
                    }
                    $valuesArr = array();
                    $sql = "INSERT INTO " . $postmeta_table . " (`post_id`, `meta_key`, `meta_value`) VALUES ";
                    // update post meta
                    $valuesArr[] = array($post_id, 'store_locator_name', $import_js_stores_post['Name']);
                    $valuesArr[] = array($post_id, 'store_locator_address', $import_js_stores_post['Address']);
                    $valuesArr[] = array($post_id, 'store_locator_country', $import_js_stores_post['Country']);
                    $valuesArr[] = array($post_id, 'store_locator_state', $import_js_stores_post['State']);
                    $valuesArr[] = array($post_id, 'store_locator_city', $import_js_stores_post['City']);
                    //$valuesArr[] = array($post_id, 'store_locator_phone', $import_js_stores_post['Phone']);
                    $valuesArr[] = array($post_id, 'store_locator_phone', "+".str_replace(' ', '', $import_js_stores_post['Phone']));
                    $valuesArr[] = array($post_id, 'store_locator_fax', $import_js_stores_post['Fax']);
                    $valuesArr[] = array($post_id, 'store_locator_website', $import_js_stores_post['Website']);
                    $valuesArr[] = array($post_id, 'store_locator_zipcode', $import_js_stores_post['Zipcode']);
                    $valuesArr[] = array($post_id, 'store_locator_code', $import_js_stores_post['Code']);

                    foreach ($valuesArr as $value) {
                        update_post_meta( $value[0], $value[1], $value[2] );
                        $sql .= " ('" . implode("', '", $value) . "'),";
                    }
                    
                    if(!empty($import_js_stores_post['Category'])){
                        $temp=''; $temp2=''; $cat_ids=array();
                        $taxonomies=explode('|', $import_js_stores_post['Category']);
                        foreach ($taxonomies as $key => $group) {
                            $terms=explode(',', $group);
                            $terms=array_reverse($terms);
                            foreach ($terms as $newkey => $term) {
                                $temp=term_exists( $term, 'store_locator_category' );
                                if($temp){
                                    $temp2=$temp['term_id'];
                                }
                                else
                                {
                                    $new=!empty($temp2) ? wp_insert_term( $term, 'store_locator_category',array('parent'=>$temp2)) : wp_insert_term( $term, 'store_locator_category');
                                    $temp2=$new['term_id'];
                                }

                            }
                            // set term to post 
                            $cat_ids[]=$temp2;
                            $temp2='';
                        }
                        $cat_ids = array_map( 'intval', $cat_ids );
                        $cat_ids = array_unique( $cat_ids );
                        $term_taxonomy_ids = wp_set_object_terms($post_id, $cat_ids, 'store_locator_category', true );
                        clean_term_cache($cat_ids, 'store_locator_category', true);
                    }
                    
                    
                    
                   if(!empty($post_id) and !empty($import_js_stores_post['Code'])){
                        $my_import_stores = get_option('my_import_stores');
                        if(is_array($my_import_stores)){
                                foreach($my_import_stores as $arry){
                                    if($arry['Code'] != $import_js_stores_post['Code']){
                                                $arrayss[] = $arry; 
                                    }
                            
                                }
                                
                            }
                        if(is_array($my_import_stores)){
                            // $key = array_search($import_js_stores_post['Code'], array_column($my_import_stores, 'Code'));
                            // unset($my_import_stores[$key]);
                            
                    $store_locator_API_KEY = get_option('store_locator_API_KEY');                                                                                                                   
                    $records = array('post_id' => $post_id, 'error_msg'=> @$responsedecoded->error_message, 'Code' => $import_js_stores_post['Code'] , 'Name' => $import_js_stores_post['Name'] , 'address' => $import_js_stores_post['Address'] . " " . $import_js_stores_post['Country'] . " " . $import_js_stores_post['City'] . " " . $import_js_stores_post['State'] . " " . $import_js_stores_post['Zipcode']);
                                                                                                                                                                                                
                    $responsedecoded = json_decode(file_get_contents("https://maps.google.com/maps/api/geocode/json?address=".urlencode($records['address'])."&sensor=false&key=".$store_locator_API_KEY));
                    
                    if (empty($responsedecoded)) {
                        "responsedecoded Error #:" . $err;
                        update_post_meta($post_id,'responsedecoded_Error_while_getting_lng_and_lat',$err);
                    } else {
                        if($responsedecoded->status == "OK"){
                            update_post_meta($post_id,'store_locator_lat',$responsedecoded->results[0]->geometry->location->lat);
                            update_post_meta($post_id,'store_locator_lng',$responsedecoded->results[0]->geometry->location->lng);
                            $records['lat'] = $responsedecoded->results[0]->geometry->location->lat;
                            $records['lng'] = $responsedecoded->results[0]->geometry->location->lng;
                            $array = array();
                            
                        } else {
                            $records['lat'] = 'empty';
                            $records['lng'] = 'empty';
                            update_post_meta($post_id,'cURL_Error_while_getting_lng_and_lat',$responsedecoded);
                        }
                    }
                            
                            echo json_encode($records);
                            die();
                            /* if(update_option('my_import_stores',$arrayss)){
                                
                                die();
                            }else{
                                
                                die('failed');
                            } */
                            
                            
                        }
                    }
                    
               /*  foreach ($records as $record) {
                    ?> <script>addresses.push({"post_id": <?php echo $record['post_id']; ?>, "address": "<?php echo $record['address']; ?>"})</script> <?php
                } */
                
                }
                
            }
            
}

// export csv
add_action('admin_post_printStores.csv', 'export_store_locator_csv');
function export_store_locator_csv() {
    if (!current_user_can('manage_options'))
        return;

    header('Content-Type: application/csv');
    header('Content-Disposition: attachment; filename=Stores.csv');
    header('Pragma: no-cache');
    $output_handle = @fopen('php://output', 'w');

    $args = array(
        'post_type' => 'store_locator',
        'post_status' => 'publish',
        'posts_per_page' => -1
    );
    $csv_fields = array('Code', 'Name', 'Address', 'Country', 'City', 'State', 'Phone', 'Fax', 'Website', 'Zipcode','Category');
    fputcsv($output_handle, $csv_fields);
    $my_query = new WP_Query($args);
    if ($my_query->have_posts()) {
        while ($my_query->have_posts()) : $my_query->the_post();
            global $post;
            $terms=get_the_terms($post->ID,'store_locator_category');
            $categories='';
                if(is_array($terms)):
                    $x=0;
                    foreach ($terms as $key => $term):
                        if($x==0)
                        $categories.=$term->name;
                        else
                         $categories.='|'.$term->name;
                        if($term->parent!==0){
                            $ancestors=get_ancestors( $term->parent, 'store_locator_category','taxonomy' );
                            $categories.=','.get_term_by('id', $term->parent, 'store_locator_category')->name;
                            if(is_array($ancestors) && count($ancestors)){
                                foreach ($ancestors as $ancestor) {
                                    $categories.=','.get_term_by('id', $ancestor, 'store_locator_category')->name;
                                }
                            }
                        }
                        $x++;
                    endforeach;
                endif;
                
            $csv_fields = array(
                get_post_meta($post->ID, 'store_locator_code', true),
                get_post_meta($post->ID, 'store_locator_name', true),
                get_post_meta($post->ID, 'store_locator_address', true),
                get_post_meta($post->ID, 'store_locator_country', true),
                get_post_meta($post->ID, 'store_locator_city', true),
                get_post_meta($post->ID, 'store_locator_state', true),
                get_post_meta($post->ID, 'store_locator_phone', true),
                get_post_meta($post->ID, 'store_locator_fax', true),
                get_post_meta($post->ID, 'store_locator_website', true),
                get_post_meta($post->ID, 'store_locator_zipcode', true),
                $categories,
                
            );
            fputcsv($output_handle, $csv_fields);
            
            
        endwhile;
    }
    wp_reset_query();


// Close output file stream
    fclose($output_handle);

    die();
}

add_action('admin_post_printSales.csv', 'export_sales_manager_csv');
function export_sales_manager_csv() {
    if (!current_user_can('manage_options'))
        return;

    header('Content-Type: application/csv');
    header('Content-Disposition: attachment; filename=Sales_Managers.csv');
    header('Pragma: no-cache');
    $output_handle = @fopen('php://output', 'w');

    $args = array(
        'post_type' => 'sales_manager',
        'post_status' => 'publish',
        'posts_per_page' => -1
    );
    $csv_fields = array('Code', 'Title', 'Name', 'Phone','Email');
    fputcsv($output_handle, $csv_fields);
    $my_query = new WP_Query($args);
    if ($my_query->have_posts()) {
        while ($my_query->have_posts()) : $my_query->the_post();
            global $post;
            $csv_fields = array(
                get_post_meta($post->ID, 'sales_manager_id', true),
                get_post_meta($post->ID, 'sales_manager_title', true),
                get_post_meta($post->ID, 'sales_manager_name', true),
                get_post_meta($post->ID, 'sales_manager_phone', true),
                get_post_meta($post->ID, 'sales_manager_email', true),
            );
            fputcsv($output_handle, $csv_fields);
        endwhile;
    }
    wp_reset_query();

    // Close output file stream
    fclose($output_handle);

    die();
}

// get Statistics Ajax
add_action('wp_ajax_show_store_statistics', 'show_store_statistics');
function show_store_statistics() {
    $store_id = NULL;
    $transactions = array();
    if(isset($_POST['store_id']) && $_POST['store_id']){
        $store_id = $_POST['store_id'];
        global $wpdb;
        $transactions = $wpdb->get_results("SELECT DATE_FORMAT(date, '%Y-%m-%d') as date, COUNT(*) as total_count FROM store_locator_transactions WHERE post_id=".$store_id." GROUP BY DATE_FORMAT(date, '%Y-%m-%d')");
        $piDataQuery = $wpdb->get_results("SELECT COUNT(*) as total_count, user_id as user FROM store_locator_transactions WHERE post_id=".$store_id." GROUP BY user_id");
        $piData = array(array('user'=>'Visitor', 'total_count'=> 0),array('user'=>'Registered Users', 'total_count'=> 0));
        foreach ($piDataQuery as $record) {
            if($record->user == 0){
                $piData[0]['total_count'] += $record->total_count;
            }else{
                $piData[1]['total_count'] += $record->total_count;
            }
        }

        include STORE_LOCATOR_PLUGIN_PATH . 'views/statistics_single_store.php';
    }
    wp_die();
}

add_action('wp_dashboard_setup', 'store_locator_custom_dashboard_widgets');

function store_locator_custom_dashboard_widgets() {
    global $wp_meta_boxes;
    wp_add_dashboard_widget('store_locator_custom_dashboard_widget', __('Top Search for Stores','store_locator'), 'store_locator_custom_dashboard_widget_callback');
}


function store_locator_custom_dashboard_widget_callback() {
    global $wpdb;
    $posts_table = $wpdb->prefix . 'posts';
    $transactions = $wpdb->get_results("SELECT ps.post_title as store, count(tr.post_id) as total_count FROM $posts_table ps LEFT JOIN store_locator_transactions tr ON tr.post_id=ps.ID WHERE ps.post_type='store_locator' AND ps.post_status='publish' GROUP BY ps.ID ORDER BY total_count DESC LIMIT 3");
    if($transactions){
        ?>
        <table class="store_locator_data_dashboard">
            <tr>
                <th><?php echo __("Store Name", 'store_locator'); ?></th>
                <th><?php echo __("Hits", 'store_locator'); ?></th>
            </tr>
            <?php foreach ($transactions as $store): ?>
                <tr>
                    <td><?php echo $store->store; ?></td>
                    <td><?php echo $store->total_count; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <a href="<?php echo admin_url('edit.php?post_type=store_locator&page=statistics_submenu_page'); ?>" ><?php echo __("See more ...","store_locator"); ?></a>
        <?php
    }else{
        echo "<div class='store_locator_nodata_dashboard'>"._("No Data found yet.",'store_locator')."</div>";
    }
}


add_filter( 'template_include', 'store_locator_single_id_template', 99 );
function store_locator_single_id_template( $template ) {
    $post_id = get_the_ID();
    $post = get_post($post_id);

    if ( is_single() &&  $post->post_type == "store_locator" ) {
        $template = STORE_LOCATOR_PLUGIN_PATH . 'templates/single-store_locator.php';
    }

    return $template;
}

add_filter( 'gform_submit_button', 'add_paragraph_below_submit', 10, 2 );
function add_paragraph_below_submit( $button, $form ) {

    return $button = "<p>your <a href='http://yourlink.com'>text</a> goes here</p>" . $button;
}

add_action( 'gform_after_submission', 'store_locator_gf_after_submission', 10, 2 );

function store_locator_gf_after_submission( $entry, $form ) {

    if( empty($_POST['gform_field_values']) ) {
        return;
    }

    parse_str($_POST['gform_field_values'], $field_values);

    if( empty($field_values['store_id']) ) {
        return;
    }

    $store_id = $field_values['store_id'];

    //getting post
    $post = get_post( $store_id );

    if($post->post_type != 'store_locator') {
        return;
    }

    $message    = __('This message would tell you that new form entry has been submitted.','store_locator');
    $message   .= __('Title: ','store_locator').rgar($entry, '1');

    $sales = get_post_meta($store_id, 'store_locator_sales', true);

    if($sales){
        foreach ($sales as $manager) {
            // get manager email
            $manager_email = get_post_meta($manager, 'sales_manager_email', true);

            if( !empty($manager_email) ) {
                wp_mail($manager_email, __('Store locator form','store_locator'), $message);
            }
        }
    }
}

// Multi Languages code here //
add_action('init','wpmsl_add_translation');

function wpmsl_add_translation() {
     load_plugin_textdomain('store_locator', FALSE,  basename( dirname( __FILE__ ) ) . '/languages/');
}

// Builders Blocks here
include('builders/main-builders.php');