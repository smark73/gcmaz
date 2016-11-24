<?php

/** This action is documented in bp-templates/bp-legacy/buddypress/members/single/profile/profile-wp.php */
do_action( 'bp_before_profile_loop_content' ); ?>

<?php if ( bp_has_profile() ) : ?>

	<?php while ( bp_profile_groups() ) : bp_the_profile_group(); ?>

		<?php if ( bp_profile_group_has_fields() ) : ?>

			<?php

			/** This action is documented in bp-templates/bp-legacy/buddypress/members/single/profile/profile-wp.php */
			do_action( 'bp_before_profile_field_content' ); ?>

			<div class="bp-widget <?php bp_the_profile_group_slug(); ?>">

				<h4><?php bp_the_profile_group_name(); ?></h4>

				<table class="profile-fields">

					<?php while ( bp_profile_fields() ) : bp_the_profile_field(); ?>

						<?php if ( bp_field_has_data() ) : ?>

							<tr<?php bp_field_css_class(); ?>>
                                                            
                                <?php
                                    // check if this is the "Favorite Stations" data to custom format it for display
                                    if( bp_get_the_profile_field_name() == 'Favorite Stations' ) :
                                ?>
                                        <td class="label"><?php bp_the_profile_field_name(); ?></td>

                                        <td class="data">
                                            <ul class="profile-fav-stations">
                                                
                                                <?php 
                                                    // returns a string like "<a href="blah">92.9 KAFF</a>, <a href="blah">93-9 The Mountain</a>, ...."
                                                    // strip the tags, then split at commas into array
                                                    $fav_stations = strip_tags( bp_get_the_profile_field_value() );
                                                    //echo $fav_stations;

                                                    $fav_stations_array = explode(', ', $fav_stations );
                                                    //print_r( $fav_stations_array );

                                                    foreach( $fav_stations_array as $fav_station ){
                                                        echo "<li class='list-unstyled'>" . $fav_station . "</li>";
                                                    }
                                                ?>
                                                
                                            </ul>
                                        </td>



                                <?php else : ?>

                                        <td class="label"><?php bp_the_profile_field_name(); ?></td>

                                        <td class="data"><?php bp_the_profile_field_value(); ?></td>
                                        
                                <?php endif;?>
							</tr>

						<?php endif; ?>

						<?php

						/**
						 * Fires after the display of a field table row for profile data.
						 *
						 * @since BuddyPress (1.1.0)
						 */
						do_action( 'bp_profile_field_item' ); ?>

					<?php endwhile; ?>

				</table>
			</div>

			<?php

			/** This action is documented in bp-templates/bp-legacy/buddypress/members/single/profile/profile-wp.php */
			do_action( 'bp_after_profile_field_content' ); ?>

		<?php endif; ?>

	<?php endwhile; ?>

	<?php

	/** This action is documented in bp-templates/bp-legacy/buddypress/members/single/profile/profile-wp.php */
	do_action( 'bp_profile_field_buttons' ); ?>

<?php endif; ?>

<?php

/** This action is documented in bp-templates/bp-legacy/buddypress/members/single/profile/profile-wp.php */
do_action( 'bp_after_profile_loop_content' ); ?>
