<?php
/*
Template Name: Contribute
*/
?>

<?php
// review subdomain sites template-advertising for reference
// plan to get 
// a. listing type to direct to appropriate post type (whats, comm, conc CPT)
		// (gravity forms and the CPT plugin cant direct dynamically to CPT during form submission so need separate forms for each CPT)
// b. possible get dates before the forms too
		// this would allow me to convert to already used CPT date formats before submission (*_date, *_endate, *_fulldate, *_fullenddate)

// Enqueue jquery UI (Datepicker) + jQuery UI CSS + jquery validate + datepicker validate
function enqueue_dp_ui_contribute(){
    //wp_enqueue_script('jquery-ui-datepicker');
    //wp_enqueue_style( 'jquery-ui-style', '//ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/themes/smoothness/jquery-ui.css', true);
    wp_enqueue_script( 'jquery-ui-custom', get_template_directory_uri() . '/assets/js/jquery-ui-1.11.4.custom/jquery-ui.min.js');
    wp_enqueue_style( 'jquery-ui-style', get_template_directory_uri() . '/assets/js/jquery-ui-1.11.4.custom/jquery-ui.min.css');
    //wp_enqueue_script('jquery-validate', get_template_directory_uri() . '/assets/js/jquery-validation-1.13.1/dist/jquery.validate.min.js');
    //wp_enqueue_script( 'jquery-ui-datepicker-validate', get_template_directory_uri() . '/assets/js/jquery.ui.datepicker.validation.package-1.0.1/jquery.ui.datepicker.validation.min.js');
}
add_action('wp_head', 'enqueue_dp_ui_contribute');
?>

<div class="in-cnt-wrp row">
    <div class="centered rbn-hdg">
        <?php get_template_part('templates/page', 'header'); ?>
    </div>
    <div class="pg-content">
<!--<div>
    <span>Data: </span><span id="showData"></span>
</div> -->
		<div class="contributeTop">
			
		</div>
		<br class="clearfix"/>
    	<div class="contributeTypeSection" style="margin:10px auto;">
    		<p>What are you submitting?</p>
    		<input type="radio" name="contributeType" id="contributeTypeWhats" value="whats"/> Event<br/>
			<input type="radio" name="contributeType" id="contributeTypeCommunity" value="community"/> Community Information<br/>
			<input type="radio" name="contributeType" id="contributeTypeConcert" value="concert"/> Concert<br/>
			<input type="hidden" name="contributeTypeVal" id="contributeTypeVal" value=""/>
    	</div>
    	<div class="contributeDateRangeSection" style="margin:10px auto;">
    		<p>Single date or multiple?</p>
    		<input type="radio" name="contributeDateRange" id="contributeDateSingle" value="single"/> Single<br/>
    		<input type="radio" name="contributeDateRange" id="contributeDateMulti" value="multiple"/> Multiple<br/>
    		<input type="hidden" name="contributeDateRangeVal" id="contributeDateMulti" value=""/>
    	</div>
    	<div class="contributeDateSingleSection" style="margin:10px auto;">
    		<p>Select the date</p>
	        <label>Date: </label>  <input size="15" name="event_date" id="event_date" class="dpDate" value="" readonly="true" /> 
	        <input type="hidden" name="event_fulldate" id="event_fulldate" class="dpDate"/>
    	</div>
    	<div class="contributeDateMultiSection" style="margin:10px auto;">
    		<p>Select the start and end dates</p>
	        <label>Start Date: </label>  <input size="15" name="event_date" id="event_date" class="dpDate" value="" readonly="true" /> 
	        &nbsp; &nbsp; &nbsp; 
	        <label>End Date: </label>  <input size="15" name="event_enddate" id="event_enddate" class="dpDate" value="" readonly="true" /> 
	        <input type="hidden" name="event_fulldate" id="event_fulldate" class="dpDate"/>
	        <input type="hidden" name="event_fullenddate" id="event_fullenddate" class="dpDate"/>
    	</div>

    	<div class="contributeBtm" style="margin:20px auto;">
    		 <button id="restart" style="" onclick="startOver()" disabled>Start Over</button><button id="next" style="">Next</button><span class="msg"></span>
    	</div>
    	<br class="clearfix"/>

        <?php 
        	// IF STEPS COMPLETED, SHOW FORM
        	//get_template_part('templates/content', 'page');
        ?>
    </div>
</div>

<script type="text/javascript">
function startOver(){
	document.location.reload(true);
}
jQuery(document).ready(function(){

	//init
	jQuery('.contributeDateRangeSection').hide();
	jQuery('.contributeDateSingleSection').hide();
	jQuery('.contributeDateMultiSection').hide();
	var curStep = 1;

	//store our elements in vars
	var $typeWhats = jQuery(document).find('#contributeTypeWhats');
	var $typeComm = jQuery(document).find('#contributeTypeCommunity');
	var $typeConcert = jQuery(document).find('#contributeTypeConcert');
	var $dateSingle = jQuery(document).find('#contributeDateSingle');
	var $dateMulti = jQuery(document).find('#contributeDateMulti');



	//select Type function
	function selectType(){
		if(!(($typeWhats).is(':checked') || ($typeComm).is(':checked') || ($typeConcert).is(':checked'))){
			jQuery('.msg').html('Please select one');
			return false;
		} else {
			jQuery('.msg').html('');
			jQuery('#restart').removeAttr("disabled");
			//var $contType = jQuery('input[name=contributeType]:checked').val();
			//jQuery('#showData').html($contType);
			curStep = 2;
			return true;
		}
	}

	//select Date Range function
	function selectDateRange(){
		if(!(($dateSingle).is(':checked') || ($dateMulti).is(':checked'))){
			jQuery('.msg').html('Please select one');
		} else {
			jQuery('.msg').html('');
			//show date inputs based on single or multiple
			//var $contDateRange = jQuery('input[name=contributeDateRange]:checked').val();
			//jQuery('#showData').html($contDateRange);
			curStep = 3;
			return true;
		}
	}

	//select Date (single) function
	function selectDateSingle(){

	}

	//select Date (mutli) function
	function selectDateMulti(){

	}


	jQuery('#next').click(function(){
		if(curStep === 1){
			//if selectType returned true, hide Type and show Date Range
			if(selectType()){
				jQuery('.contributeTypeSection').hide();
				jQuery('.contributeDateRangeSection').show();
			}
		} else if(curStep === 2){
			if(selectDateRange()){
				jQuery('.contributeDateRangeSection').hide();
				//if selectDateRange returned true, hide Range and show inputs for single or multiple
				if(jQuery('input[name=contributeDateRange]:checked').val() === 'single'){
					jQuery('.contributeDateSingleSection').show();
				} else if(jQuery('input[name=contributeDateRange]:checked').val() === 'multiple'){
					jQuery('.contributeDateMultiSection').show();
				}
			}
		} else if(curStep === 3){

		}


		//DATEPICKER STUFF

        // datepicker
        jQuery('#event_date').datepicker({ dateFormat : 'D, M d yy' });
        jQuery('#event_enddate').datepicker({ dateFormat : 'D, M d yy' });
        jQuery('#event_fulldate').datepicker({dateFormat:'yymmdd'});
        jQuery('#event_fullenddate').datepicker({dateFormat:'yymmdd'});
        
        // START DATE CHANGE
        function startDateChange() {
            var $startDateVal = jQuery('#event_date').val();
            // changing the start date ?
            if( $startDateVal === '' || $startDateVal === null || $startDateVal === undefined){
                // if set to null, set event_fulldate to default & set endate to null
                jQuery('#event_fulldate').datepicker('setDate', '20000101');
                jQuery('#event_enddate').datepicker('setDate', '');
                jQuery('#event_fullenddate').datepicker('setDate', '');
            } else {
                var $endDateVal = jQuery('#event_enddate').val();
                var parsedStartDate = jQuery.datepicker.parseDate('D, M d yy', $startDateVal);
                jQuery('#event_fulldate').datepicker('setDate', parsedStartDate);
            }
        }
        jQuery('#event_date').change(startDateChange);
        
        
        // END DATE CHANGE
        function endDateChange() {
            var $endDateVal = jQuery('#event_enddate').val();
            var parsedEndDate = jQuery.datepicker.parseDate('D, M d yy', $endDateVal);
            jQuery('#event_fullenddate').datepicker('setDate', parsedEndDate);
        }
        jQuery('#event_enddate').change(endDateChange);
        

		// CLEAR DATES FUNCTION
        jQuery('.clear-event-dates').on("click", function(event){
            event.preventDefault();
             jQuery('#event_date').datepicker('setDate', '');
             jQuery('#event_enddate').datepicker('setDate', '');
             startDateChange();
             endDateChange();
        });


	});
});
</script>