<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $this->model_template->get_title(); ?></title>

    <?php $this->load->view('common_styles'); ?>

    <?php echo $this->model_template->get_custom_styles(); ?>

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Login</h3>
                    </div>
                    <?php
                        // if($this->session->flashdata('fd_msg_login_error') != ''){
                    ?><!--
                        <div class="panel-heading">
                            <h3 class="panel-title"><?php echo $this->session->flashdata('fd_msg_login_error'); ?></h3>
                        </div>
                    --><?php
                        // }
                    ?>
                    <div class="panel-body">
                        <?php
                            $this->load->helper('form');

                            $data = array(
                                'id' => 'form_admin_login',
                                'name' => 'form_admin_login',
                                'method' => 'POST',
                                'role' => 'form'
                            );
                            $form_open = form_open('admin/login_process', $data);
                                $data = array(
                                    'id' => 'email',
                                    'name' => 'email',
                                    'value' => set_value('email'),
                                    'autofocus' => 'autofocus',
                                    'placeholder' => 'Email',
                                    'class' => 'form-control'
                                );
                                $input_email = form_input($data);
                                $label_email = form_label(form_error('email'), 'email');

                                $data = array(
                                    'id' => 'password',
                                    'name' => 'password',
                                    'value' => set_value('password'),
                                    'placeholder' => 'Password',
                                    'class' => 'form-control'
                                );
                                $input_password = form_password($data);
                                $label_password = form_label(form_error('password'), 'password');

                                $data = array(
                                    'id' => 'remember',
                                    'name' => 'remember',
                                    'value' => 'remember'
                                );
                                $input_remember = form_checkbox($data);

                                $data = array(
                                    'id' => 'btn_login',
                                    'name' => 'btn_login',
                                    'value' => 'Login',
                                    'class'=> 'btn btn-lg btn-success btn-block'
                                );
                                $input_submit_login = form_submit($data);
                            $form_close = form_close();
                        ?>
                        <?php echo $form_open; ?>
                            <fieldset>
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
                                <!-- <div class="checkbox">
                                    <label>
                                        <?php echo $input_remember; ?>Remember Me
                                    </label>
                                </div> -->

                                <?php echo $input_submit_login; ?>
                            </fieldset>
                        <?php echo $form_close; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

<?php $this->load->view('common_scripts'); ?>

<?php echo $this->model_template->get_custom_scripts(); ?>

</html>
