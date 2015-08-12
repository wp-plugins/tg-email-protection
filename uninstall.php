<?php

 // If uninstall is not called from WordPress, exit
  if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit();
  }
  else {
    delete_option('tg_email_protection_options');
  }
  
?>