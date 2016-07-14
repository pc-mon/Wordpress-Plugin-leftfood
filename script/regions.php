<?php

function pageregions() {
    global $wpdb;
    if ($_POST['title']) {
        $wpdb->insert(
                $wpdb->prefix . 'regions', array(
            'title' => sanitize_text_field($_POST['title']),
                )
        );
    }
    $results = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'regions ');
    echo "<h1>المناطق</h1>";
    ?>

    <form method="post">
        <table>
            <thead>
                <tr>
                    <td>
                        <h4>إنشاء مناطق جديدة</h4>
                    </td>
                </tr>

            </thead>
            <tbody>
                <tr>
                    <th>
                        <label for="title">اسم المنطقة</label>
                    </th>
                    <td>
                        <input type="text" name="title" id="title" class="title" />
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="إنشاء" />
                    </td>
                </tr>
            </tbody>

        </table>
    </form>
    <?php foreach ($results as $v) { ?>
        <div style="width:18%;display: inline-block;border:1px solid black;">
            <span>
                <h4 style="padding-left:10px;padding-right:10px;"><?= $v->title ?></h4>
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