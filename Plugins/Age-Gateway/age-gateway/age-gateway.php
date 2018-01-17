<?php
/**
 * Plugin Name: Age Gateway.
 * Plugin URI: http://depixa.com
 * Description: This is the Wordpress Age Gateway to manage Age Restrictions to Sensitive Content and other events activities.
 * Version: 1.0.0
 * Author: Paul Shopi
 * Author URI: http://depixa.com
 * License: A short license name. Example: GPL2
 */

//if( is_admin() )
    $my_settings_page = new AgeGatewaySettingsPage();


class AgeGatewaySettingsPage{
		
	private $options;

    /**
     * Start up
     */
    public function __construct()
    {
        add_action( 'admin_menu', array( $this, 'add_age_gateway_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );
		add_action( 'media_buttons', array( &$this, 'add_media_button' ), 999 );
		add_action( "wp_ajax_age_gateway_media_button", array( &$this, 'ajax_media_button' ) );
        add_action( 'wp_enqueue_scripts', array( &$this, 'age_gateway_load_plugin_scripts') );
        add_shortcode( 'age-gateway', array( $this, 'age_gateway_shortcode') );
		
    }
	
	
    /**
     * Add options page
     */
    public function add_age_gateway_plugin_page()
    {
        // This page will be under "Settings"
        add_menu_page(
            'Settings Admin', 
            'Age Gateway', 
            'manage_options', 
            'age-gateway-setting-admin', 
            array( $this, 'create_age_gateway_admin_page' )
        );
    }


    /**
     * Options page callback
     */
    public function create_age_gateway_admin_page()
    {
        // Set class property
        $this->options = get_option( 'age_gateway_option_name' );
        ?>
        <div class="wrap">
            <?php screen_icon(); ?>
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'age_gateway_option_group' );   
                do_settings_sections( 'age-gateway-setting-admin' );
                submit_button(); 
            ?>
            </form>
        </div>
        <?php
    }
	
	
    /**
     * Register and add settings
     */
    public function page_init()
    {        
        register_setting(
            'age_gateway_option_group', // Option group
            'age_gateway_option_name', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'setting_section_id', // ID
            'Age Gateway Settings', // Title
            array( $this, 'print_section_info' ), // Callback
            'age-gateway-setting-admin' // Page
        );

        add_settings_field(
            'age_gateway_age_limit', // ID
            'Age Limit', // Title 
            array( $this, 'age_gateway_age_limit_callback' ), // Callback
            'age-gateway-setting-admin', // Page
            'setting_section_id' // Section           
        );      

        add_settings_field(
            'age_gateway_title', // ID
            'Title', // Title 
            array( $this, 'age_gateway_title_callback' ), // Callback
            'age-gateway-setting-admin', // Page
            'setting_section_id' // Section           
        );

        add_settings_field(
            'age_gateway_sub_title', // ID
            'Sub Title', // Title 
            array( $this, 'age_gateway_sub_title_callback' ), // Callback
            'age-gateway-setting-admin', // Page
            'setting_section_id' // Section           
        );

        add_settings_field(
            'age_gateway_terms', // ID
            'Terms and Conditions URL', // Title 
            array( $this, 'age_gateway_terms_callback' ), // Callback
            'age-gateway-setting-admin', // Page
            'setting_section_id' // Section           
        );

        add_settings_field(
            'age_gateway_privacy', // ID
            'Privacy Policy URL', // Title 
            array( $this, 'age_gateway_privacy_callback' ), // Callback
            'age-gateway-setting-admin', // Page
            'setting_section_id' // Section           
        );

        add_settings_field(
            'age_gateway_submit', // ID
            'Submit Button Caption', // Title 
            array( $this, 'age_gateway_submit_callback' ), // Callback
            'age-gateway-setting-admin', // Page
            'setting_section_id' // Section           
        );

        add_settings_field(
            'age_gateway_redirect_url', // ID
            'Redirect URL', // Title 
            array( $this, 'age_gateway_redirect_url_callback' ), // Callback
            'age-gateway-setting-admin', // Page
            'setting_section_id' // Section           
        );
        
        add_settings_field(
            'age_gateway_pages', // ID
            'Load for only these pages i.e.(page-one, page-two)', // Title 
            array( $this, 'age_gateway_pages_callback' ), // Callback
            'age-gateway-setting-admin', // Page
            'setting_section_id' // Section           
        );
        
        add_settings_field(
            'age_gateway_cookie_expiry', // ID
            'Remember Me for (Days)', // Title 
            array( $this, 'age_gateway_cookie_expiry_callback' ), // Callback
            'age-gateway-setting-admin', // Page
            'setting_section_id' // Section           
        );
       
        add_settings_field(
            'age_gateway_theme_style', // ID
            'Theme Style', // Title 
            array( $this, 'age_gateway_theme_style_callback' ), // Callback
            'age-gateway-setting-admin', // Page
            'setting_section_id' // Section           
        );
        

    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input )
    {
        $new_input = array();
        if( isset( $input['age_gateway_age_limit'] ) )
            $new_input['age_gateway_age_limit'] = sanitize_text_field( $input['age_gateway_age_limit'] );

        if( isset( $input['age_gateway_title'] ) )
            $new_input['age_gateway_title'] = sanitize_text_field( $input['age_gateway_title'] );

        if( isset( $input['age_gateway_sub_title'] ) )
            $new_input['age_gateway_sub_title'] = sanitize_text_field( $input['age_gateway_sub_title'] );

        if( isset( $input['age_gateway_terms'] ) )
            $new_input['age_gateway_terms'] = sanitize_text_field( $input['age_gateway_terms'] );

        if( isset( $input['age_gateway_privacy'] ) )
            $new_input['age_gateway_privacy'] = sanitize_text_field( $input['age_gateway_privacy'] );

        if( isset( $input['age_gateway_submit'] ) )
            $new_input['age_gateway_submit'] = sanitize_text_field( $input['age_gateway_submit'] );

        if( isset( $input['age_gateway_redirect_url'] ) )
            $new_input['age_gateway_redirect_url'] = sanitize_text_field( $input['age_gateway_redirect_url'] );
        
        if( isset( $input['age_gateway_pages'] ) )
            $new_input['age_gateway_pages'] = sanitize_text_field( $input['age_gateway_pages'] );
        
        if( isset( $input['age_gateway_cookie_expiry'] ) )
            $new_input['age_gateway_cookie_expiry'] = sanitize_text_field( $input['age_gateway_cookie_expiry'] );
        
        if( isset( $input['age_gateway_theme_style'] ) )
            $new_input['age_gateway_theme_style'] = sanitize_text_field( $input['age_gateway_theme_style'] );

        return $new_input;
    }
	

    /** 
     * Print the Section text
     */
    public function print_section_info()
    {
        //print 'Enter your settings below:';
    }
		
    /** 
     * Get the settings option array and print one of its values
     */
    public function age_gateway_age_limit_callback()
    {
        printf(
            '<input type="text" id="age_gateway_age_limit" name="age_gateway_option_name[age_gateway_age_limit]" value="%s" />',
            isset( $this->options['age_gateway_age_limit'] ) ? esc_attr( $this->options['age_gateway_age_limit']) : ''
        );
    }

    /** 

     * Get the settings option array and print one of its values
     */
    public function age_gateway_title_callback()
    {
        printf(
            '<input type="text" id="age_gateway_title" name="age_gateway_option_name[age_gateway_title]" value="%s" />',
            isset( $this->options['age_gateway_title'] ) ? esc_attr( $this->options['age_gateway_title']) : ''
        );
    }

    /** 

     * Get the settings option array and print one of its values
     */
    public function age_gateway_sub_title_callback()
    {
        printf(
            '<input type="text" id="age_gateway_sub_title" name="age_gateway_option_name[age_gateway_sub_title]" value="%s" />',
            isset( $this->options['age_gateway_sub_title'] ) ? esc_attr( $this->options['age_gateway_sub_title']) : ''
        );
    }

    /** 

     * Get the settings option array and print one of its values
     */
    public function age_gateway_terms_callback()
    {
        printf(
            '<input type="text" id="age_gateway_terms" name="age_gateway_option_name[age_gateway_terms]" value="%s" />',
            isset( $this->options['age_gateway_terms'] ) ? esc_attr( $this->options['age_gateway_terms']) : ''
        );
    }

    /** 

     * Get the settings option array and print one of its values
     */
    public function age_gateway_privacy_callback()
    {
        printf(
            '<input type="text" id="age_gateway_privacy" name="age_gateway_option_name[age_gateway_privacy]" value="%s" />',
            isset( $this->options['age_gateway_privacy'] ) ? esc_attr( $this->options['age_gateway_privacy']) : ''
        );
    }

    /** 

     * Get the settings option array and print one of its values
     */
    public function age_gateway_submit_callback()
    {
        printf(
            '<input type="text" id="age_gateway_submit" name="age_gateway_option_name[age_gateway_submit]" value="%s" />',
            isset( $this->options['age_gateway_submit'] ) ? esc_attr( $this->options['age_gateway_submit']) : ''
        );
    }

    /** 

     * Get the settings option array and print one of its values
     */
    public function age_gateway_redirect_url_callback()
    {
        printf(
            '<input type="text" id="age_gateway_redirect_url" name="age_gateway_option_name[age_gateway_redirect_url]" value="%s" />',
            isset( $this->options['age_gateway_redirect_url'] ) ? esc_attr( $this->options['age_gateway_redirect_url']) : ''
        );
    }

    /** 

     * Get the settings option array and print one of its values
     */
    public function age_gateway_pages_callback()
    {
        printf(
            '<input type="text" id="age_gateway_pages" name="age_gateway_option_name[age_gateway_pages]" value="%s" />',
            isset( $this->options['age_gateway_pages'] ) ? esc_attr( $this->options['age_gateway_pages']) : ''
        );
    } 

    /** 

     * Get the settings option array and print one of its values
     */
    public function age_gateway_cookie_expiry_callback()
    {
        printf(
            '<input type="text" id="age_gateway_cookie_expiry" name="age_gateway_option_name[age_gateway_cookie_expiry]" value="%s" />',
            isset( $this->options['age_gateway_cookie_expiry'] ) ? esc_attr( $this->options['age_gateway_cookie_expiry']) : ''
        );
    }    
    
    /** 
     * Get the settings option array and print one of its values
     */
    public function age_gateway_theme_style_callback()
    {
		function set_value($style, $value2){
			if($style==$value2){
				return 'selected="selected"'; 
			};
		}
		
        printf(
            '<select id="age_gateway_theme_style" name="age_gateway_option_name[age_gateway_theme_style]">
			<option value="" '. set_value("",esc_attr( $this->options['age_gateway_theme_style'])) .' >Default</option>
			<option value="dark" '. set_value("dark",esc_attr( $this->options['age_gateway_theme_style'])) .' >Dark</option></select>',
            isset( $this->options['age_gateway_theme_style'] ) ? esc_attr( $this->options['age_gateway_theme_style']) : ''
        );
    }
	
	
			
	public function add_media_button(){
    	if ( current_user_can( 'manage_options' ) ) :
?>
			<a href="<?php echo add_query_arg( array( 'action' => 'age_gateway_media_button', 'width' => '450' ), admin_url( 'admin-ajax.php' ) ); ?>" class="button add_media thickbox" title="Add Age Gateway">
				<span class="dashicons dashicons-feedback" style="color:#888; display: inline-block; width: 18px; height: 18px; vertical-align: text-top; margin: 0 4px 0 0;"></span>
				<?php _e( 'Add Age Gate-Way', 'age-gateway' ); ?>
			</a>
<?php
		endif;
	}

	public function ajax_media_button(){
	?>
		<script type="text/javascript">
			jQuery(document).ready(function($) {
					
					window.send_to_editor( '[age-gateway]' );

					window.tb_remove();
				
			});
		</script>
	<?php
		die(1);
	}
	
    public function age_gateway_load_plugin_scripts() {
        $plugin_url = plugin_dir_url( __FILE__ );
        $options = get_option( 'age_gateway_option_name' );
        $load_pages = $options['age_gateway_pages'];
        $load_page = false;
        if($load_pages != '' && !empty($load_pages)){
            $pages = explode(',',$options['age_gateway_pages']);
            if($pages){
                foreach($pages as $page){
                    if(is_page(trim($page))){
                        $load_page = true;
                        
                    }
                }
            }
        }else{
            $load_page = true;
        }
        if($load_page == true){
            if($options['age_gateway_theme_style']=='dark'){
                wp_enqueue_style( 'style-dark', $plugin_url . 'dark.css' );
            }else{
                wp_enqueue_style( 'style', $plugin_url . 'style.css' );
            }
            wp_enqueue_script('age-gateway-form', $plugin_url  . 'age-gateway-form.js', array('jquery'), '', true);
            wp_localize_script( 'age-gateway-form', 'ajax_object_url', array( 'ajax_url' => $plugin_url.'post.php' ) );
            wp_localize_script( 'age-gateway-form', 'ajax_object_age_limit', array( 'ajax_age_limit' => $options['age_gateway_age_limit'] ) );
            wp_localize_script( 'age-gateway-form', 'ajax_object_redirect_url', array( 'ajax_redirect_url' => $options['age_gateway_redirect_url'] ) );
            $cookie_expiry = ( isset($options['age_gateway_cookie_expiry']) && !empty($options['age_gateway_cookie_expiry']) ) ? $options['age_gateway_cookie_expiry'] : 1;
            wp_localize_script( 'age-gateway-form', 'ajax_object_cookie', array( 'ajax_cookie_expiry' => $cookie_expiry ) );
        }
    }
    
    public function age_gateway_shortcode() {
    $options = get_option( 'age_gateway_option_name' );
        $load_pages = $options['age_gateway_pages'];
        $load_page = false;
        if($load_pages != '' && !empty($load_pages)){
            $pages = explode(',',$options['age_gateway_pages']);
            if($pages){
                foreach($pages as $page){
                    if(is_page(trim($page))){
                        $load_page = true;
                        
                    }
                }
            }
        }else{
            $load_page = true;
        }
        if($load_page == true){
            require( trailingslashit( plugin_dir_path( __FILE__ ) ) . 'age-gateway-form.php' );
            return $html;
        }
    }


}

?>
