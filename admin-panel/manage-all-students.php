<!DOCTYPE html>

<?php
include '../class/include.php';
?>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Student Log History</title>
        <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
        <meta property="og:url" content="http://demo.madebytilde.com/elephant">
        <meta property="og:type" content="website">
        <meta property="og:image" content="../../elephant.html">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="@madebytilde">
        <meta name="twitter:creator" content="@madebytilde">
        <meta name="twitter:image" content="../../elephant.html">
        <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-iconaa.png">
        <link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32">
        <link rel="icon" type="image/png" href="favicon-16x16.png" sizes="16x16">
        <link rel="manifest" href="manifest.json">
        <link rel="mask-icon" href="safari-pinned-tab.svg" color="#f7a033">
        <meta name="theme-color" content="#ffffff">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,400italic,500,700">
        <link rel="stylesheet" href="css/vendor.min.css">
        <link rel="stylesheet" href="css/elephant.min.css">
        <link rel="stylesheet" href="css/application.min.css">
        <link rel="stylesheet" href="css/demo.min.css">
    </head>
    <body class="layout layout-header-fixed">
        <div class="layout-header">
            <div class="navbar navbar-default">
                <div class="navbar-header">
                    <a class="navbar-brand navbar-brand-center" href="dashboard.php">
                        <img class="navbar-brand-logo" src="./../img/logo.png" alt="Elephant">
                    </a>
                    <button class="navbar-toggler visible-xs-block collapsed" type="button" data-toggle="collapse" data-target="#sidenav">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="bars">
                            <span class="bar-line bar-line-1 out"></span>
                            <span class="bar-line bar-line-2 out"></span>
                            <span class="bar-line bar-line-3 out"></span>
                        </span>
                        <span class="bars bars-x">
                            <span class="bar-line bar-line-4"></span>
                            <span class="bar-line bar-line-5"></span>
                        </span>
                    </button>
                    <button class="navbar-toggler visible-xs-block collapsed" type="button" data-toggle="collapse" data-target="#navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="arrow-up"></span>
                        <span class="ellipsis ellipsis-vertical">
                            <img class="ellipsis-object" width="32" height="32" src="img/0180441436.jpg" alt="Teddy Wilson">
                        </span>
                    </button>
                </div>
                <div class="navbar-toggleable">
                    <nav id="navbar" class="navbar-collapse collapse">
                        <button class="sidenav-toggler hidden-xs" title="Collapse sidenav ( [ )" aria-expanded="true" type="button">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="bars">
                                <span class="bar-line bar-line-1 out"></span>
                                <span class="bar-line bar-line-2 out"></span>
                                <span class="bar-line bar-line-3 out"></span>
                                <span class="bar-line bar-line-4 in"></span>
                                <span class="bar-line bar-line-5 in"></span>
                                <span class="bar-line bar-line-6 in"></span>
                            </span>
                        </button>
                        <?php include './head-nav-right.php'; ?>
                        <div class="title-bar">
                            <h1 class="title-bar-title">
                                <span class="d-ib">Student Log  History
                                </span>
                                <span class="d-ib">
                                    <a class="title-bar-shortcut" href="#" title="Add to shortcut list" data-container="body" data-toggle-text="Remove from shortcut list" data-trigger="hover" data-placement="right" data-toggle="tooltip">
                                        <span class="sr-only">Add to shortcut list</span>
                                    </a>
                                </span>
                            </h1>
                            <p class="title-bar-description">
                                <small>You can personalize your dashboard by using <a href="widgets.html">widgets</a>.</small>
                            </p>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
        <div class="layout-main">
            <?php
            include 'navigation.php';
            ?>
            <div class="layout-content">
                <div class="layout-content-body">
                    <div class="row gutter-xs">
                        <div class="col-xs-12">
<!--                            <p><small>The tables presented below use <a href="https://datatables.net/extensions/colreorder/" target="_blank">DataTables ColReorder Extension</a>, the styling of which is completely rewritten in SASS, without modifying however anything in JavaScript.</small></p>-->
                        </div>
                    </div>
                    <div class="row gutter-xs">
                        <div class="col-xs-12">
                            <div class="card">
                                <div class="card-header">

                                    <strong>Student Log  History  </strong>
                                </div>
                                <div class="card-body">

                                    <table id="demo-datatables-colreorder-1" class="table table-hover table-striped table-nowrap dataTable" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Id.</th>
                                                <th>Student ID</th>
                                                <th>Student Name</th>
                                                <th>Email</th>
                                                <th>NIC NUmber</th>
                                                <th>Option</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Id.</th>
                                                <th>Student ID</th>
                                                <th>Student Name</th>
                                                <th>Email</th>
                                                <th>NIC NUmber</th>
                                                <th>Option</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php
                                            $STUDENT = new Student(NULL);
                                            foreach ($STUDENT->all() as $key => $student) {
                                                $key++;
                                                ?>
                                                <tr>
                                                    <td><?php echo $key ?></td>
                                                    <td><?php echo $student['student_id'] ?></td>
                                                    <td><?php echo $student['full_name'] ?></td> 
                                                    <td><?php echo $student['email'] ?></td> 
                                                    <td><?php echo $student['nic_number'] ?></td> 
                                                    <td> 
                                                        <a href="edit-student.php?id=<?php echo $student['id'] ?>" class="op-link btn btn-sm btn-info"><i class="icon icon-pencil"></i></a>  |  
                                                        <a href="#" class="delete-student btn btn-sm btn-danger" data-id="<?php echo $student['id'] ?>"><i class="waves-effect icon icon-trash" data-type="cancel"></i></a> |   
                                                        <a href="view-student.php?id=<?php echo $student['id'] ?>" class="op-link btn btn-sm btn-primary"><i class="icon icon-eye"></i></a>
                                                        <?php
                                                        if ($student['status'] == 1) {
                                                            ?>
                                                            <i class="icon icon-circle" style="color: #4faf41; margin-left: 10px;"></i> 
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>


                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--            <div class="layout-footer">
                            <div class="layout-footer-body">
                                <small class="version">Version 1.4.0</small>
                                <small class="copyright">2017 &copy; Elephant <a href="http://madebytilde.com/">Made by Tilde</a></small>
                            </div>
                        </div>-->
        </div>
        <script src="js/vendor.min.js"></script>
        <script src="js/elephant.min.js"></script>
        <script src="js/application.min.js"></script>
        <script src="js/demo.min.js"></script>
        <script>
            (function (i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                        m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', '../../../www.google-analytics.com/analytics.js', 'ga');
            ga('create', 'UA-83990101-1', 'auto');
            ga('send', 'pageview');
        </script>
    </body>
</html>