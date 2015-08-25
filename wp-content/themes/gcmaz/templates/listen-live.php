<div class="listenlive row">
    <div class="strm-lft col-md-9 col-sm-9 col-xs-7">
        <a class="listenlive-txt centered" href="javascript:void(window.open('http://player.tritondigital.com/EDITME', 'EDITME', 'width=780,height=600'));">
            Listen Live <span class="glyphicon glyphicon-play"></span>
        </a>
    </div>
    <div class="strm-spnsr col-md-3 col-sm-3 col-xs-5">
        <?php
            // first, check if adrotate plugin is even active
            // detect plugin - front end use only
            include_once( ABSPATH . 'wp-admin/includes/plugin.php');
            // check for plugin by using plugin name
            if( is_plugin_active( 'adrotate/adrotate.php' ) ){
                echo adrotate_group(15);
            }
        ?>
    </div>
</div>