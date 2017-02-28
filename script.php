/* Enter Your Custom Functions Here */

// Add custom validation for CF7 form fields
function is_company_email($email){ // Check against list of common public email providers & return true if the email provided *doesn't* match one of them
    if(
        preg_match('/@gmail./i', $email) ||
        preg_match('/@hotmail./i', $email) ||
        preg_match('/@live./i', $email) ||
        preg_match('/@msn./i', $email) ||
        preg_match('/@aol./i', $email) ||
        preg_match('/@yahoo./i', $email) ||
        preg_match('/@inbox./i', $email) ||
        preg_match('/@outlook./i', $email) ||
        preg_match('/@gmx./i', $email) ||
        preg_match('/@mac./i', $email) ||
        preg_match('/@icloud./i', $email) ||
        preg_match('/@mail./i', $email) ||
        preg_match('/@zoho./i', $email) ||
        preg_match('/@yandex./i', $email) ||
        preg_match('/@me./i', $email)
    ){
        return false; // It's a publicly available email address
    }else{
        return true; // It's probably a company email address
    }
}
 
function custom_email_validation_filter($result, $tag) {  
 
 $tag = new WPCF7_Shortcode( $tag );
 
   if ( 'company-email' == $tag->name ) {
 
 $the_value = isset( $_POST['company-email'] ) ? trim( $_POST['company-email'] ) : '';
 
           if(!is_company_email($the_value)){
                     $result->invalidate( $tag, "Please Enter a valid Business Email ID" );
           }
      }
       return $result;
 }
 
add_filter( 'wpcf7_validate_email', 'custom_email_validation_filter', 10, 2 );
add_filter( 'wpcf7_validate_email*', 'custom_email_validation_filter', 10, 2 );
