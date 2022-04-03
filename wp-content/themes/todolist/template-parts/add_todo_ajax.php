<?php
    require('../../../../wp-load.php');
    $title = $_POST['title'];
    $csrf = $_POST['_csrf'];

    if ($csrf){
        insert_new_todoes($title, $csrf);
    }
