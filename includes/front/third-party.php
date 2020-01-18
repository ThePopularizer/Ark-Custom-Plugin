<?php

if ( ! defined( 'ABSPATH' ) ) exit;

/* Google Analytics */
if ( function_exists( 'get_field' ) ) {
  if (get_field('google_analytics_id', 'option')) {
    function analytics_code() {
      $analytics_id = get_field('google_analytics_id', 'option');
      if ( $analytics_id && (!is_user_logged_in() || current_user_can( 'subscriber' ) )) { ?> <!-- Analytics Turned Off for Logged-in, Non-subscriber Users -->
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $analytics_id; ?>"></script>
        <script async>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());
          gtag('config', '<?php echo $analytics_id; ?>');
        </script>
      <?php
      }
    }
    add_action('wp_head', 'analytics_code' );
  }
}
