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
                                    <h3 class="font-weight-bold">Slots</h3>
                                </div>
                                <div class="col-12 col-xl-4">
                                    <div class="justify-content-end d-flex">
                                        <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                            <a class="btn btn-sm btn-light bg-white" type="button" id="dropdownMenuDate2" data-toggle="modal" data-target="#addMainCategory">
                                                + Add New
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
                                                <table id="tblMainCategory" class="display expandable-table" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th>Sr No.</th>
                                                            <th>Start Time</th>
                                                            <th>End Time</th>
                                                            <th>Delete</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        if (!empty($result)) {
                                                            for ($k = 0; $k < COUNT($result); $k++) {
                                                        ?>
                                                                <tr>
                                                                    <td><?php echo $k + 1; ?></td>
                                                                    <td><?php echo $result[$k]["start_time"]; ?></td>
                                                                    <td><?php echo $result[$k]["end_time"]; ?></td>
                                                                    <td>
                                                                        <a class="btn btn-danger btn-rounded pl-3 pr-3 pt-2 pb-2" href="?action=deleteSlot&id=<?php echo $result[$k]["id"]; ?>">Delete</a>
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


    <!-- model -->
    <div class="modal fade" id="addMainCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Slot</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="forms-sample" action="" method="POST">
                        <div class="form-group">
                            <label for="exampleInputUsername1">Start Time</label>
                            <input type="text" class="form-control timepicker" name="StartTime"  id="timepicker" placeholder="Start Time">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputUsername1">End Time</label>
                            <input type="text" class="form-control timepicker" name="EndTime" id="timepicker" placeholder="End Time">
                        </div>
                        <input type="submit" name="add-slot" class="btn btn-primary mr-2" value="Add Slot">
                        <button class="btn btn-light" data-dismiss="modal">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end model -->

    <!-- plugins:js -->
    <?php require_once "footer-js.php"; ?>
    <!-- End custom js for this page-->
</body>
<script type="text/javascript">
    $(document).ready(function() {
        $('#tblMainCategory').DataTable({
            pageLength: 5,
        });
    });

    $(document).ready(function(){
        $('#timepicker').timepicker({'scrollDefault': 'now'});
    });
</script>

</html>