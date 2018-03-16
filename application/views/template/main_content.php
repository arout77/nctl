<?php require_once 'header.php';?>

<body class="hold-transition skin-green sidebar-mini">
    <div class="wrapper">

        <?php require_once 'nav_menu.php';?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
        <!-- Content Header (Page header) -->
            <section class="content-header">
              <h1>
                Dashboard
                <small>Control panel</small>
              </h1>
              <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
              </ol>
            </section>

            <!-- Main content -->
            <section class="content">

                <?php echo $content; ?>

            </section>
        </div>
    </div>

<?php require_once 'footer.php';?>
