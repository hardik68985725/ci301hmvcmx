<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div>
    <div class="row">
        <div class="col-md-4 "><!-- col-md-offset-4 -->
            <div class="panel_profile panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">admin profile</h3>
                </div>

                <?php
                    if($this->session->flashdata('admin_profile_process_success') != ''){
                ?>
                    <div class="alert alert-success">
                        <?php echo $this->session->flashdata('admin_profile_process_success'); ?>
                    </div>
                <?php
                    }
                ?>

                <div class="panel-body">
                    <?php
                        $this->load->helper('form');

                        $data = array(
                            'id' => 'form_admin_profile'
                            ,'name' => 'form_admin_profile'
                            ,'method' => 'POST'
                            ,'role' => 'form'
                        );
                        $form_open = form_open('admin/admin_profile_process', $data);
                            $data = array(
                                'id' => 'admin_name'
                                ,'name' => 'admin_name'
                                ,'value' => input_value_by_action('profile', $admin_action, $admin_login_details->admin_name, set_value('admin_name'))
                                ,'autofocus' => 'autofocus'
                                ,'placeholder' => 'Admin Name'
                                ,'class' => 'form-control'
                            );
                            $input_admin_name = form_input($data);
                            $label_admin_name = form_label(form_error('admin_name'), 'admin_name', array('class' => 'label_error'), array('class' => 'label_error'));

                            $data = array(
                                'id' => 'email'
                                ,'name' => 'email'
                                ,'value' => input_value_by_action('profile', $admin_action, $admin_login_details->admin_email, set_value('email'))
                                ,'autofocus' => 'autofocus'
                                ,'placeholder' => 'Email'
                                ,'class' => 'form-control'
                            );
                            $input_email = form_input($data);
                            $label_email = form_label(form_error('email'), 'email', array('class' => 'label_error'));

                            $data = array(
                                'id' => 'password'
                                ,'name' => 'password'
                                // ,'value' => input_value_by_action('profile', $admin_action, $admin_login_details->admin_password, set_value('password'))
                                ,'value' => input_value_by_action('profile', $admin_action, '', set_value('password'))
                                ,'placeholder' => 'Password'
                                ,'class' => 'form-control'
                            );
                            $input_password = form_password($data);
                            $label_password = form_label(form_error('password'), 'password', array('class' => 'label_error'));

                            $data = array(
                                'id' => 'new_password'
                                ,'name' => 'new_password'
                                ,'value' => input_value_by_action('profile', $admin_action, '', set_value('new_password'))
                                ,'placeholder' => 'New Password'
                                ,'class' => 'form-control'
                            );
                            $input_new_password = form_password($data);
                            $label_new_password = form_label(form_error('new_password'), 'new_password', array('class' => 'label_error'));

                            $data = array(
                                'id' => 'confirm_new_password'
                                ,'name' => 'confirm_new_password'
                                ,'value' => input_value_by_action('profile', $admin_action, '', set_value('confirm_new_password'))
                                ,'placeholder' => 'Confirm New Password'
                                ,'class' => 'form-control'
                            );
                            $input_confirm_new_password = form_password($data);
                            $label_confirm_new_password = form_label(form_error('confirm_new_password'), 'confirm_new_password', array('class' => 'label_error'));

                            $data = array(
                                'id' => 'btn_submit_profile'
                                ,'name' => 'btn_submit_profile'
                                ,'value' => 'Submit'
                                ,'class'=> 'btn btn-lg btn-success btn-block'
                            );
                            $input_submit_profile = form_submit($data);
                        $form_close = form_close();
                    ?>
                    <?php echo $form_open; ?>
                        <fieldset>
                            <div class="form-group">
                                <?php
                                    echo $input_admin_name;
                                    echo $label_admin_name;
                                ?>
                            </div>
                            <div class="form-group">
                                <?php
                                    echo $input_email;
                                    echo $label_email;
                                ?>
                            </div>
                            <div class="form-group">
                                <?php
                                    echo $input_password;
                                    echo $label_password;
                                ?>
                            </div>
                            <div class="form-group">
                                <?php
                                    echo $input_new_password;
                                    echo $label_new_password;
                                ?>
                            </div>
                            <div class="form-group">
                                <?php
                                    echo $input_confirm_new_password;
                                    echo $label_confirm_new_password;
                                ?>
                            </div>
                            <?php echo $input_submit_profile; ?>
                        </fieldset>
                    <?php echo $form_close; ?>
                </div>
            </div>
        </div>
        <div class="col-md-8">
        </div>
    </div>
</div>
