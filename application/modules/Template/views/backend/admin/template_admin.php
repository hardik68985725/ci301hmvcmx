<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Description, Keywords and Author -->
    <meta name="description" content="hardik kathiriya" />
    <meta name="keywords" content="hardik kathiriya" />
    <meta name="author" content="hardik kathiriya" />

    <title>Admin</title>

    <?php $this->load->view('common_styles'); ?>

    <?php echo $this->model_template->get_custom_styles(); ?>

</head>

<body>

    <div id="wrapper">

        <?php $this->load->view( $this->model_template->get_other_view('navigation_admin') ); ?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"><?php echo $this->model_template->get_title(); ?></h1>
                        <div id="template_content">
                            <?php $this->load->view( $this->model_template->get_content_view() ); ?>
                        </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

</body>

<?php $this->load->view('common_scripts'); ?>

<?php echo $this->model_template->get_custom_scripts(); ?>

</html>
