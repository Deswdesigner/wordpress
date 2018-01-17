// JavaScript Document
/** 
 * Description: This is the Wordpress Age Gateway JavaScript file 
 *              implementing jQuery to validate users details 
 *              to determine if they are of the right age to view the contents of the current page.
 * Version: 1.0.0
 * Author: Paul Shopi
 * Author URI: http://depixa.com
 * License: A short license name. Example: GPL2
 */
	var error = 0;
	var err_msg = '';
	var age_lmt = {
		'AX': '18',
		'AF': '0',
		'AL': '18',
		'DZ': '18',
		'AS': '21',
		'AD': '18',
		'AO': '18',
		'AI': '0',
		'AQ': '0',
		'AG': '18',
		'AR': '18',
		'AM': '18',
		'AW': '0',
		'AU': '18',
		'AT': '18',
		'AZ': '21',
		'BS': '18',
		'BH': '21',
		'BD': '0',
		'BB': '18',
		'BY': '18',
		'BE': '18',
		'BZ': '18',
		'BJ': '18',
		'BM': '0',
		'BT': '18',
		'BO': '18',
		'BQ': '18',
		'BA': '18',
		'BW': '18',
		'BR': '0',
		'BN': '18',
		'BG': '18',
		'BF': '18',
		'BI': '18',
		'KH': '18',
		'CM': '18',
		'CA': '19',
		'CV': '18',
		'KY': '0',
		'CF': '0',
		'TD': '18',
		'CL': '18',
		'CN': '18',
		'HK': '18',
		'CX': '0',
		'CC': '0',
		'CO': '18',
		'KM': '18',
		'CD': '18',
		'CG': '18',
		'CK': '18',
		'CR': '18',
		'CI': '18',
		'HR': '18',
		'CU': '18',
		'CW': '18',
		'CY': '18',
		'CZ': '18',
		'DK': '18',
		'DJ': '18',
		'DM': '18',
		'DO': '18',
		'EC': '18',
		'EG': '21',
		'SV': '18',
		'GQ': '18',
		'ER': '18',
		'EE': '18',
		'ET': '18',
		'FK': '0',
		'FO': '0',
		'FJ': '18',
		'FI': '18',
		'FR': '18',
		'GF': '0',
		'PF': '0',
		'TF': '18',
		'GA': '18',
		'GE': '21',
		'DE': '18',
		'GH': '18',
		'GI': '0',
		'GR': '18',
		'GL': '0',
		'GD': '18',
		'GP': '0',
		'GU': '0',
		'GT': '18',
		'GG': '18',
		'GN': '18',
		'GW': '18',
		'GY': '18',
		'HT': '18',
		'HM': '0',
		'VA': '21',
		'HN': '21',
		'HU': '18',
		'IS': '0',
		'IN': '25',
		'IO': '0',
		'ID': '21',
		'IR': '0',
		'IQ': '0',
		'IE': '18',
		'IM': '18',
		'IL': '18',
		'IT': '18',
		'JM': '18',
		'JP': '20',
		'JE': '18',
		'JO': '0',
		'KZ': '0',
		'KE': '18',
		'KI': '18',
		'KP': '19',
		'KR': '19',
		'KW': '0',
		'KG': '0',
		'LA': '0',
		'LV': '18',
		'LB': '18',
		'LS': '18',
		'LR': '18',
		'LY': '0',
		'LI': '18',
		'LT': '18',
		'LU': '18',
		'MO': '0',
		'MK': '18',
		'MG': '18',
		'MW': '18',
		'MY': '18',
		'MV': '18',
		'ML': '0',
		'MT': '18',
		'MH': '18',
		'MQ': '0',
		'MR': '18',
		'MU': '18',
		'YT': '18',
		'MX': '18',
		'FM': '21',
		'MD': '18',
		'MC': '18',
		'MN': '18',
		'ME': '18',
		'MS': '0',
		'MA': '18',
		'MZ': '18',
		'MM': '18',
		'NA': '18',
		'NR': '18',
		'NP': '0',
		'NL': '18',
		'NC': '18',
		'NZ': '18',
		'NI': '18',
		'NE': '18',
		'NG': '18',
		'NU': '0',
		'NF': '0',
		'MP': '0',
		'NO': '20',
		'OM': '21',
		'PK': '0',
		'PW': '21',
		'PS': '18',
		'PA': '18',
		'PG': '18',
		'PY': '20',
		'PE': '18',
		'PN': '0',
		'PL': '18',
		'PT': '18',
		'PR': '18',
		'QA': '18',
		'RE': '0',
		'RO': '18',
		'RU': '18',
		'RW': '18',
		'BL': '18',
		'SH': '0',
		'KN': '18',
		'LC': '18',
		'MF': '18',
		'VC': '18',
		'PM': '0',
		'WS': '21',
		'SM': '18',
		'ST': '0',
		'SA': '0',
		'SN': '18',
		'RS': '18',
		'SC': '18',
		'SL': '18',
		'SG': '18',
		'SX': '18',
		'SK': '18',
		'SI': '18',
		'SB': '21',
		'SO': '18',
		'ZA': '18',
		'GS': '0',
		'SS': '18',
		'ES': '18',
		'LK': '21',
		'SD': '0',
		'SR': '18',
		'SJ': '0',
		'SZ': '18',
		'SE': '20',
		'CH': '18',
		'SY': '18',
		'TW': '18',
		'TJ': '0',
		'TZ': '18',
		'TH': '18',
		'GM': '18',
		'TL': '18',
		'TG': '18',
		'TK': '0',
		'TO': '18',
		'TT': '18',
		'TN': '18',
		'TR': '18',
		'TM': '21',
		'TC': '0',
		'TV': '18',
		'UG': '18',
		'UA': '18',
		'AE': '18',
		'GB': '18',
		'US': '21',
		'UM': '0',
		'UY': '18',
		'UZ': '0',
		'VU': '18',
		'VE': '18',
		'VN': '18',
		'VG': '0',
		'VI': '0',
		'WF': '0',
		'EH': '0',
		'YE': '0',
		'ZM': '18',
		'ZW': '18'
	}
	
    /*
     * check if the user has already been to this site and is eligible
     */
	jQuery(document).ready(function(e){
		checkCookie();
	});
	
    /*
     * process the user's details and check eligibility
     */
	function age_gateway_post_data(){
		var dd = jQuery('#dd').val();
		var mm = jQuery('#mm').val();
		var yyyy = jQuery('#yyyy').val();
		var country = jQuery('#country').val();
		var age_limit = age_lmt[country];
		var remember = 0;
		if(jQuery('#remember').is(':checked')){
			remember = jQuery('#remember').val();
		}
		
		var age_limit_default = ajax_object_age_limit.ajax_age_limit;
		var redir = ajax_object_redirect_url.ajax_redirect_url;
		var cookieExpiry = ajax_object_cookie.ajax_cookie_expiry;
		var age = age_gateway_calculate_age(mm,dd,yyyy);
        
		if(age>=age_limit){
			jQuery('.age-gate-way-overlay').removeClass("age_gate_way_wrap");
			jQuery('.age-gate-way-overlay').addClass("age-gate-way-none");
			if(remember>0){
                if(cookieExpiry < 1 || cookieExpiry == ''){
                    cookieExpiry = 1;
                }
				setCookie("accessPageContent", 1, cookieExpiry);		
			}
			/*
             * redirect to url if its set
             */
            if(redir != '' && redir != undefined){
                window.location.replace(redir);
            }
        }else{
			jQuery('#age-gate-way-err').html("You are not of the Right Age to view the Contents of this page.");
		}
		
		/*
         * calculate the age of the user based on the country
         */
		function age_gateway_calculate_age(birth_month,birth_day,birth_year)
		{
			today_date = new Date();
			today_year = today_date.getFullYear();
			today_month = today_date.getMonth();
			today_day = today_date.getDate();
			age = today_year - birth_year;
		
			if ( today_month < (birth_month - 1))
			{
				age--;
			}
			if (((birth_month - 1) == today_month) && (today_day < birth_day))
			{
				age--;
			}
			return age;
		}
	}
	
	
	/*
     * sanitize the user's form details and validate accordingly
     */
	function age_gateway_validate_section(sectionObject){
		error = 0;
		err_msg = '';
		var placeholder = '';
		// loop through the input controls in the current section
		jQuery(sectionObject+' input, '+sectionObject+' select, '+sectionObject+' textarea, '+sectionObject+' input:checkbox').each(
			function(index){  
				// create an object of the current input control
				var input = jQuery(this);

				// set the value of the data attribute
				data_format = input.attr('data');
				placeholder = input.attr('placeholder');
				// set the value of the input
				val = input.val();
				
				var pass1 = document.getElementById('pass1');
				var pass2 = document.getElementById('pass2');
				
				// check for any scripts or tags in string from input
				// this is checking for any XSS attacks
				if(IsContainsTags(val)==true){
					input.addClass('invalid');
					error++; // increase the error number by 1
				}else{
					val = val.replace(/(<([^>]+)>)/ig,"");
					// check which data format is the input by checking its 'data' attribute
					// if normal text validate the data
					if(data_format == 'required'){
						if(val=='' || val.length==0 || IsContainsTags(val)==true){
							input.addClass('invalid');
							error++; // increase the error number by 1
							err_msg=err_msg+'Please select a '+ placeholder+'<br />';
						}else{
							input.removeClass('invalid');
							input.addClass('valid');
						}
						if(input.is(":checkbox")){
							if(input.is(":checked")){
								input.removeClass('invalid');
								input.addClass('valid');
							}else{
								input.removeClass('valid');
								input.addClass('invalid');
								error++; // increase the error number by 1
								err_msg=err_msg+'Please check a '+ placeholder+'<br />';
							}
						}
						if(input.is(":radio")){
							var currentRadioName = "";
							var alreadyChecked = false;
								currentRadioName = input.attr('name');
							if(input.is(":checked")){
								input.removeClass('invalid');
								input.addClass('valid');
							}
							jQuery("input[name=" + currentRadioName + "]").each(function(){
								if(jQuery(this).is(":checked")){
									alreadyChecked = true;
								}
							});
							if(alreadyChecked == true){
								input.removeClass('invalid');
								input.addClass('valid');	
							}else{
								input.removeClass('valid');
								input.addClass('invalid');
								error++; // increase the error number by 1
								err_msg=err_msg+'Please select a '+ placeholder+'<br />';
							}
						}
					}
					// if email format validate the email
					if(data_format == 'email'){
						if(IsEmailValid(val)==false || val=='' || val.length==0 || IsContainsTags(val)==true){
							input.addClass('invalid');
							error++; // increase the error number by 1
							err_msg=err_msg+'Please enter a valid '+ placeholder+'<br />';
						}else{
							input.removeClass('invalid');
							input.addClass('valid');
						}
					}
				}
			}
		);
	}

	/*
     * strip and escape any tags or invalid characters from string
     */
	function escapeHtml(string) {
		return String(string).replace(/[&<>"'\/]/g, function (s) {
		  return entityMap[s];
		});
	}
	
	/*
     * check if string contains any tags
     */
	function IsContainsTags(string){
		var expRe = /(<([^>]+)>)/ig;
		return expRe.test(string);
	}

	/*
     * set the coockie to remember the user the next time they visit this page
     */
	function setCookie(cname, cvalue, exdays) {
		var d = new Date();
		d.setTime(d.getTime() + (exdays*24*60*60*1000));
		var expires = "expires="+d.toUTCString();
		document.cookie = cname + "=" + cvalue + "; " + expires;
	}
	
	/*
     * get available cookies for verification check
     */
	function getCookie(cname) {
		var name = cname + "=";
		var ca = document.cookie.split(';');
		for(var i=0; i<ca.length; i++) {
			var c = ca[i];
			while (c.charAt(0)==' ') c = c.substring(1);
			if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
		}
		return "";
	}
	
	/*
     * verify the user, 
     * check if they are eligible, 
     * set the parameters to remember the user
     */
	function checkCookie() {
		var contents = getCookie("accessPageContent");
		if (contents != "" && (contents > 0)) {
			jQuery('.age-gate-way-overlay').addClass("age-gate-way-none");
			jQuery('.age-gate-way-overlay').removeClass("age_gate_way_wrap");
		} else {
			//alert("no");
			jQuery('.age-gate-way-overlay').removeClass("age-gate-way-none");
			jQuery('.age-gate-way-overlay').addClass("age_gate_way_wrap");
			jQuery(".age-gate-way-submit-data").click(function(e){
                e.preventDefault();
				age_gateway_validate_section('.age-gate-way-overlay');
				if(error<1){
					err_msg = '';
					jQuery('#age-gate-way-err').html('');
					age_gateway_post_data();
				}else{
					jQuery('#age-gate-way-err').html(err_msg);
				}
			});
		}
	}
