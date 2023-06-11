<?php

add_action('admin_head', 'my_custom_fonts');

function my_custom_fonts() {
  echo '<style>
    .postbox.acf-postbox.seamless{
        background:#FFF;
        border-radius:10px;
        padding:1rem;
        border:1px solid #bdbdbd;
    }
  </style>';
}

?>