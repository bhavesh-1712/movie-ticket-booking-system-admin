<?php require_once "header.php"; ?>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <?php require_once "upper-menu.php"; ?>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <?php require_once "sidebar.php"; ?>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12 grid-margin">
                            <div class="row">
                                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                                    <h3 class="font-weight-bold">Total User</h3>
                                </div>
                                <div class="col-12 col-xl-4">
                                    <div class="justify-content-end d-flex">
                                        <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                            <a class="btn btn-sm btn-light bg-white" type="button"
                                                id="dropdownMenuDate2"  href="?action=export-user-date">
                                                Export
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="table-responsive">
                                                <table id="tblUser" class="display expandable-table" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th>Sr No.</th>
                                                            <th>Customer Id</th>
                                                            <th>Customer Name</th>
                                                            <th>Gmail</th>
                                                            <th>Mobile Number</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            if (! empty($result)) {
                                                                for($k = 0; $k < COUNT($result); $k++){
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $k + 1; ?></td>
                                                            <td>CUST<?php echo $result[$k]["user_id"]; ?></td>
                                                            <td><?php echo $result[$k]["user_name"]; ?>
                                                            <td><?php echo $result[$k]["gmail"]; ?></td>                                                         
                                                            <td><?php echo $result[$k]["mobile_no"]; ?></td>
                                                        
                                                            <td>
                                                                <a class="btn btn-danger btn-rounded p-2"
                                                                    href="?action=deleteCustomer&id=<?php echo $result[$k]['user_id']; ?>">Delete</a>
                                                            </td>
                                                        </tr>
                                                        <?php 
                                                                }
                                                            }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <?php require_once "footer.php"; ?>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->


    <!-- plugins:js -->
    <?php require_once "footer-js.php"; ?>
    <!-- End custom js for this page-->
</body>
<script type="text/javascript">
$(document).ready(function() {
    $('#tblUser').DataTable({
        pageLength: 10,
    });
});
</script>

</html>