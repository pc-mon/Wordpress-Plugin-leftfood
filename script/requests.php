<?php

function pagerequests() {
    global $wpdb;
    $current_user = wp_get_current_user();
    if ($_POST['reply']) {
        wp_mail(array($_POST['email'],''),'الرد من موقع عرب في تركيا','موقع عرب يشكرك '.esc_textarea($_POST['reply']));
        $wpdb->update(
                $wpdb->prefix . 'foodrequests', array(
            'finished' => $current_user->id,
                    'sentmail' => esc_textarea($_POST['reply'])
                ), array('id' => (int) $_POST['id'])
        );
    }
    $results = $wpdb->get_results('SELECT f.*,r.title as t FROM ' . $wpdb->prefix . 'foodrequests f,' . $wpdb->prefix . 'regions r where region=r.id ORDER BY finished');
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
                <?php if ($v->finished == 0) { ?>
                    <form method="post">
                        <div class="sendform">
                            <label for="reply">الرد</label>
                            <textarea name="reply" ></textarea><br/>
                            <input type="hidden" name="id" value="<?= $v->id ?>" />
                            <input type="hidden" name="email" value="<?= $v->email ?>" />
                            <input type="submit" value="إرسال" />
                        </div>    
                    </form>
                <?php } else { ?>
                    
                <?php } ?>
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
 