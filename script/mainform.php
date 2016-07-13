<?php

function forn_controller() {
    global $wpdb;
    $form = '<h1>ok</h1>';
    if ($_POST['title']) {
        $wpdb->insert(
                $wpdb->prefix . 'foodrequests', array(
            'title' => sanitize_text_field($_POST['title']),
            'details' => esc_textarea($_POST['details']),
            'foods' => esc_textarea($_POST['ff']),
            'email' => sanitize_email($_POST['email']),
            'mobile' => sanitize_text_field($_POST['mobile']),
            'address' => esc_textarea($_POST['address']),
            'region' => (int) sanitize_text_field($_POST['r']),
                )
        );
    }

    return $form;
}

function form_view() {
    global $wpdb;

    $results = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'regions ');
    $s = '<select name="r">';
    foreach ($results as $v) {
        $s .= "<option value='{$v->id}' >{$v->title}</option>";
    }
    $s .= '</select>';
    $form = ' 
            <form action="' . esc_url($_SERVER['REQUEST_URI']) . '"  method="post">
                <label>Title</label><input type="" name="title" /><br/>
                <label>Details</label><textarea name="details"></textarea><br/>
                <label>Address</label><textarea name="address"></textarea><br/>
                <label>Left Food</label><textarea name="ff"></textarea><br/>
                <label>Region</label>' . $s . '<br/>
                <label>Email</label><input type="email" name="email"/><br/>
                <label>Mobile</label><input type="number" name="mobile" /><br/> 
                <input type="submit" />
            </form>
            
';
    return $form;
}
