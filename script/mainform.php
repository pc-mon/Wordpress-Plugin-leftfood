<?php

function forn_controller() {
    global $wpdb;
     $form = '';
    if ($_POST['title']) {
        wp_mail(array($_POST['email'],''),'الرد من موقع عرب في تركيا','موقع عرب يشكرك '.' و سوف يتم التواصل معكم قريباً');
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
        $form = '<h4>Thank you , we\'ll contact you soon '
;    }

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
                <label>عنوان الرسالة</label><input type="" name="title" /><br/>
                <label>التفاصيل</label><textarea name="details"></textarea><br/>
                <label>عنوان المنزل</label><textarea name="address"></textarea><br/>
                <label>الطعام المتواجد</label><textarea name="ff"></textarea><br/>
                <label>المنطقة</label>' . $s . '<br/>
                <label>الاميل</label><input type="email" name="email"/><br/>
                <label>الجوال</label><input type="number" name="mobile" /><br/> 
                <input type="submit" value="إرسال" />
            </form>
            
';
    return $form;
}
