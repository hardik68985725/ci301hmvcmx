<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />

        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <!-- Description, Keywords and Author -->
        <meta name="description" content="hardik kathiriya" />
        <meta name="keywords" content="hardik kathiriya" />
        <meta name="author" content="hardik kathiriya" />

        <title><?php echo $this->model_template->get_title(); ?></title>

        <?php $this->load->view('front_styles'); ?>

        <?php echo $this->model_template->get_custom_styles(); ?>
    </head>

    <!-- Add class "boxed" along with body for boxed layout. -->
    <!-- Add "pattern-x" (1 to 5) for background patterns. -->
    <!-- Add "img-x" (1 to 5) for background images. -->
    <body>

        <!-- Outer Starts -->
        <div class="outer">

            <?php $this->load->view( $this->model_template->get_other_view('topbar') ); ?>

            <?php $this->load->view( $this->model_template->get_other_view('header') ); ?>

            <?php $this->load->view( $this->model_template->get_content_view() ); ?>

            <?php $this->load->view( $this->model_template->get_other_view('footer') ); ?>

            <?php $this->load->view( $this->model_template->get_other_view('bottombar') ); ?>

        </div>
        <!-- Outer Ends -->

        <!-- Scroll to top -->
        <span class="totop"><a href="#"><i class="fa fa-angle-up bg-color"></i></a></span>

    </body>

<?php $this->load->view('front_scripts'); ?>

<?php echo $this->model_template->get_custom_scripts(); ?>

</html>
