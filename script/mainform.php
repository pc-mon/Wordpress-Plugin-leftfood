<?php

function forn_controller() {
    if ($_POST) {
        $form = '<h1>ok</h1>';
    }
    
    return $form;
}

function form_view() {
    $form =  ' 
            <form action="' . esc_url( $_SERVER['REQUEST_URI'] ) . '"  method="post">
                <label>Title</label><input type="" /><br/>
                <label>Details</label><textarea name=""></textarea><br/>
                <label>Address</label><textarea name=""></textarea><br/>
                <label>Left Food</label><textarea name=""></textarea><br/>
                <label>Region</label><input type="" /><br/>
                <label>Email</label><input type="" /><br/>
                <label>Mobile</label><input type="" /><br/> 
                <input type="submit" />
            </form>
            
';
    return $form ;
}
