<?php

/*
Plugin Name: GCMAZ Custom Settings
Plugin URI: http://www.gcmaz.com
Description: Custom Settings for GCMAZ WordPress site
Author: Stacy Mark
Version: 1.0
Author URI: 
*/


// SETTINGS PAGE IN ADMIN
class GCMAZ_Settings{

    // Used to make previously saved settings available to the class
    public $settings;
    
    // Retrieves previously saved settings and binds class methods to existing WordPress actions to ensure everything initializes in the correct order
    public function __construct()
    {
      $this->settings = get_option('gcmaz_settings');
      add_action('admin_menu', array($this, 'gcmaz_admin_menu'));
      add_action('admin_init', array($this, 'register_gcmaz_settings'));
      add_action('admin_notices', array($this, 'admin_error_notice_action'));
      add_filter('plugin_action_links', array($this, 'gcmaz_plugin_action_links'), 10, 2);
    }

    // adds GCMAZ to menu
    public function gcmaz_admin_menu(){
        $page_title = 'Great Circle Media';
        $menu_title = 'GCMAZ';
        $capability = 'manage_options';
        $menu_slug = 'gcmaz-settings';
        add_options_page($page_title, $menu_title, $capability, $menu_slug, array($this, 'gcmaz_settings'));
    }
    
    // displays the content of the gcmaz settings page
    public function gcmaz_settings(){
         if (!current_user_can('manage_options')){
             wp_die('You do not have sufficient permissions to access this feature');
         }
         ?>
        <div class="wrap">
            <h2>Custom WordPress Settings for GCMAZ</h2>
            <section style="border-bottom:3px solid #e3e3e3;">
            <form method="post" action="options.php" enctype="multipart/form-data">
                <?php settings_fields( 'gcmaz_options_group' );?>
                <?php do_settings_sections( 'gcmaz-settings' );?>
                <?php submit_button('Save Changes', 'submit', 'gcmaz_save');?>
            </form>
            </section>
            <div>
                <h3>Read Me:</h3>
                <h4>JetPack Publicize</h4>
                <p>Publicize must also be enabled inside JetPack.  The Default setting is on or off for ALL so we're tweaking it.  Too tedious for people to check/uncheck the Facebook Twitter auto post option</p>
                <h4>TuneGenie</h4>
                <p>The url for the stations TuneGenie song list feed</p>
            </div>
        </div>
        <?php
    }

    // register the new settings fields and functions
    public function register_gcmaz_settings() {
        // First, we register a section. This is necessary since all future options must belong to one. 
        // Second, add the fields that belong to the section
        // 
        // Station Call Letters
        add_settings_section(
                'gcmaz-station-section',                                   // ID used to identify this section and with which to register options
                'Station Call Letters:',                                     // Title to be displayed on the administration page
                array($this, 'gcmaz_station_section_callback'),      // Callback used to render the description of the section
                'gcmaz-settings'                                              // Page on which to add this section of options
                );
        add_settings_field(
                'gcmaz_station',                                          // ID
                'Enter the Station Call Letters:',                        // label
                array($this, 'gcmaz_station_callback'),           // name of the function rendering  interface
                'gcmaz-settings',                                        // page this option will be displayed
                'gcmaz-station-section',                               // name of the section this field belongs
                array('')                                                      // array of arguments to pass to the callback
                );
        // TuneGenie
        /*
        add_settings_section(
                'gcmaz-tunegenie-section',                            // ID used to identify this section and with which to register options
                'TuneGenie URL:',                                          // Title to be displayed on the administration page
                array($this, 'gcmaz_tunegenie_section_callback'),      // Callback used to render the description of the section
                'gcmaz-settings'                                          // Page on which to add this section of options
                );
        add_settings_field(
                'gcmaz_tunegenie',                                      // ID
                'Enter the TuneGenie URL:',                        // label
                array($this, 'gcmaz_tunegenie_callback'),     // name of the function rendering  interface
                'gcmaz-settings',                                 // page this option will be displayed
                'gcmaz-tunegenie-section',                        // name of the section this field belongs
                array('')                                             // array of arguments to pass to the callback
                );
        */
        // JetPack Publicize
        add_settings_section(
                'gcmaz-publicize-section',                            // ID used to identify this section and with which to register options
                'JetPack Publicize auto-publish tweak:',         // Title to be displayed on the administration page
                array($this, 'gcmaz_publicize_section_callback'),      // Callback used to render the description of the section
                'gcmaz-settings'                                 // Page on which to add this section of options
                );
        add_settings_field(
                'gcmaz_publicize',                                      // ID
                'Enable Users:',                                         // label
                array($this, 'gcmaz_publicize_callback'),     // name of the function rendering  interface
                'gcmaz-settings',                                      // page this option will be displayed
                'gcmaz-publicize-section',                            // name of the section this field belongs
                array('')                                                     // array of arguments to pass to the callback
                );
        // Finally, we register the fields with WordPress
        register_setting(
            'gcmaz_options_group',
            'gcmaz_settings',
            array($this, 'gcmaz_validate')
            );

    } 

    // GCMAZ Station Call Letters Section Description
    public function gcmaz_station_section_callback(){
        echo 'Enter the call letters for this station';
    }
    // GCMAZ Station Call Letters
    public function gcmaz_station_callback(){
        if( isset( $this->settings['gcmaz_station'] ) ){
            $station = $this->settings['gcmaz_station'];
        } else {
            $station = '';
        }
        echo "<input type='textbox' name='gcmaz_settings[gcmaz_station]' id='gcmaz_settings[gcmaz_station]' value='$station' size='10' />";
    }
    
    
    // GCMAZ JetPack Publicize Section Description
    public function gcmaz_publicize_section_callback(){
        if(is_plugin_active( 'jetpack/jetpack.php' )){
            echo 'This setting enables/disables the auto publish setting in JetPack Publicize if JetPack is installed and active (Publicize must also be active)';
        } else {
            echo "UNAVAILABLE - The JetPack (Publicize) Plugin isn't active";
        }
    }
    
    // GCMAZ JetPack Publicize Fields
    public function gcmaz_publicize_callback(){
        // check if JetPack is active
        if(is_plugin_active( 'jetpack/jetpack.php' )){
                $i = 0;
                echo "<ul>";
                foreach($this->get_gcmaz_users() as $user){
                    // save user ID's if enable is checked
                    $gcmaz_uid = $user->ID;
                    $user_setting = "gcmaz_settings[gcmaz_publicize][$i]";
                    //print_r($user_setting);
                    //print_r($this);
                    //print_r($this->settings);

                    // check if the objects settings array is populated, if not assign empty array
                    $gcmaz_jp_pub_settings = isset($this->settings['gcmaz_publicize']) ? $this->settings['gcmaz_publicize'] : array(0);

                    if( in_array( $gcmaz_uid, $gcmaz_jp_pub_settings ) ){
                        // retrieve stored ID's and check the box
                        echo "<li><input type='checkbox' name='$user_setting' id='$user_setting' value='$gcmaz_uid'  checked='true' /> " . $user->display_name . "</li>";
                    } else {
                        // ID's not stored wont be checked
                        echo "<li><input type='checkbox' name='$user_setting' id='$user_setting' value='$gcmaz_uid' /> " . $user->display_name . "</li>";
                    }
                    $i++;

                }
                echo "</ul>";
                //print_r($this->settings['gcmaz_publicize']);
        } else {

            echo "The JetPack (Publicize) Plugin isn't active";
            
            // get stored values and reenter them if saved            
            $i = 0;
            foreach($this->get_gcmaz_users() as $user){
                // save user ID's if enable is checked
                $gcmaz_uid = $user->ID;
                $user_setting = "gcmaz_settings[gcmaz_publicize][$i]";

                // check if the objects settings array is populated, if not assign empty array
                $gcmaz_jp_pub_settings = isset($this->settings['gcmaz_publicize']) ? $this->settings['gcmaz_publicize'] : array(0);

                if( in_array( $gcmaz_uid, $gcmaz_jp_pub_settings ) ){
                    // retrieve stored ID's to resave
                    echo "<input type='hidden' name='$user_setting' id='$user_setting' value='$gcmaz_uid' />";
                }
                $i++;

            }
        }
    }
    
    // GCMAZ TuneGenie Section Description
    /*
    public function gcmaz_tunegenie_section_callback(){
        echo 'Enter the link for this stations TuneGenie feed';
    }
    // GCMAZ TuneGenie
    public function gcmaz_tunegenie_callback(){
        if( isset( $this->settings['gcmaz_tunegenie'] ) ){
            $tg_link = $this->settings['gcmaz_tunegenie'];
        } else {
            $tg_link = '';
        }
        echo "<input type='textbox' name='gcmaz_settings[gcmaz_tunegenie]' id='gcmaz_settings[gcmaz_tunegenie]' value='$tg_link' size='50' />";
    }
    */
    
    
    // called in register_gcmaz_setting -> register_setting
    // EACH option we want to store HAS TO set a value in the returning $output array
    // validate and sanitize our inputs before returning output
    public function gcmaz_validate($input){
        //get current values to return
        $output = $this->settings;

        //Station
        $output['gcmaz_station'] = sanitize_text_field($input['gcmaz_station']);
        
        //Publicize
        $output['gcmaz_publicize'] = array_filter($input['gcmaz_publicize'], 'is_numeric');
        
        //TuneGenie
        /*
        if( !empty($input['gcmaz_tunegenie']) && !filter_var($input['gcmaz_tunegenie'], FILTER_VALIDATE_URL) ){
            add_settings_error('gcmaz_settings', 'invalid-url', 'URL is not valid');
        } else {
            $output['gcmaz_tunegenie'] = $input['gcmaz_tunegenie'];
        }
        */
        
        return $output;
    }

    //need to hook error in gcmaz_validate to admin_notices to display it
    public function admin_error_notice_action(){
        settings_errors('gcmaz_settings');
    }
    
    // adds shortcut to edit settings on plugin page
    public function gcmaz_plugin_action_links($links, $file){
        static $this_plugin;

        if(!$this_plugin){
            $this_plugin = plugin_basename (__FILE__);
        }
        if($file == $this_plugin){
            // The "page" query string value must be equal to the slug
            // of the Settings admin page we defined earlier, which in
            // this case equals "page-takeover-settings".
            $settings_link = '<a href="' . get_bloginfo('wpurl') . '/wp-admin/admin.php?page=gcmaz-settings">Settings</a>';
            array_unshift($links, $settings_link);
        }
        return $links;
    }
    
    //used to get our user list of admins and editors
    public function get_gcmaz_users(){
        //define the roles we want to grab
        $roles = array('Super Admin', 'Administrator', 'Editor', 'Author');
        $gcmaz_users = array();
        
        foreach($roles as $role){
            //the user query
            $user_query = new WP_User_Query( array('role' => $role) );
            if(!empty($user_query->results)) {
                // merge the role results
                $gcmaz_users = array_merge($gcmaz_users, $user_query->results);
            }
        }
        return $gcmaz_users;
    }

}

new GCMAZ_Settings;