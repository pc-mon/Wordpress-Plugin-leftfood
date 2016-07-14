<?php

function pagerequests() {
    global $wpdb;
    if ($_POST['title']) {
        $wpdb->insert(
                $wpdb->prefix . 'regions', array(
            'title' => sanitize_text_field($_POST['title']),
                )
        );
    }
    $results = $wpdb->get_results('SELECT f.*,r.title as t FROM ' . $wpdb->prefix . 'foodrequests f,'. $wpdb->prefix . 'regions r where region=f.id');
    echo "<h1>المناطق</h1>";
    ?>


    <?php foreach ($results as $v) { ?>
        <div style="width:18%;display: inline-block;border:1px solid black;">
            <span>
                <h4 style="padding-left:10px;padding-right:10px;"><?= $v->title ?></h4>
                <h4 style="padding-left:10px;padding-right:10px;"><?= $v->details ?></h4>
                <h4 style="padding-left:10px;padding-right:10px;"><?= $v->foods ?></h4>
                <h4 style="padding-left:10px;padding-right:10px;"><?= $v->email ?></h4>
                <h4 style="padding-left:10px;padding-right:10px;"><?= $v->address ?></h4>
                <h4 style="padding-left:10px;padding-right:10px;"><?= $v->t ?></h4>
                <h4 style="padding-left:10px;padding-right:10px;"><?= $v->created ?></h4> 
            </span>
            <span>
                <!--<a href="#d<?= $v->id ?>" title="Delete" >Delete</a>-->
                <!--<a href="#u<?= $v->id ?>" title="Update" >Update</a>-->
            </span>
        </div>
    <?php } ?>

    <?php
}
?>