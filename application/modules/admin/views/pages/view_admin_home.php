<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


<?php
    $this->load->helper('form');
    $input_submit_page = form_submit(array('id' => 'btn_submit_page', 'name' => 'btn_submit_page', 'class' => 'btn btn-lg btn-success btn-block', 'value' => 'Submit'));
    $form_close = form_close();
?>

<div class="my-admin-pages">

    <!-- flash message -->
    <div class="row">
        <div class="col-md-12">
            <?php if ( $this->session->flashdata('suc_msg_page_home_edit') != '' ) { ?>
                <div class="alert alert-success">
                    <?php echo $this->session->flashdata('suc_msg_page_home_edit'); ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
