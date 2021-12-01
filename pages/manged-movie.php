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
                                    <h3 class="font-weight-bold">Movie</h3>
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
                                                            <th>Movie Name</th>
                                                            <th>Movie Details</th>
                                                            <th>Movie Charges</th>
                                                            <th>Movie Image</th>
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
                                                                    <td><?php echo $result[$k]["movie_name"]; ?></td>
                                                                    <td><?php echo $result[$k]["movie_details"]; ?></td>
                                                                    <td>Rs. <?php echo $result[$k]["movie_charges"]; ?>/-</td>
                                                                    <td><img height="100" width="200" src="<?php echo $result[$k]['movie_image']; ?>" alt="<?php echo $result[$k]['movie_name']; ?>">
                                                                    </td>
                                                                    <td>
                                                                        <a class="btn btn-danger btn-rounded pl-3 pr-3 pt-2 pb-2" href="?action=deleteMovie&id=<?php echo $result[$k]["id"]; ?>&path=<?php echo $result[$k]['movie_image']; ?>">Delete</a>
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
                    <h5 class="modal-title" id="exampleModalLabel">Add Movie</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="forms-sample" action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="exampleInputUsername1">Movie Name</label>
                            <input type="text" class="form-control" name="MovieName" id="exampleInputUsername1" placeholder="Movie Name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputUsername1">Movie Details</label>
                            <input type="text" class="form-control" name="MovieDetails" id="exampleInputUsername1" placeholder="Movie Details">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputUsername1">Movie Charges</label>
                            <input type="text" class="form-control" name="MovieCharges" id="exampleInputUsername1" placeholder="Movie Charges">
                        </div>
                        <div class="form-group">
                            <label>Movie Image</label><br>
                            <input type="file" name="files" /><br><br>
                        </div>
                        <input type="submit" name="add-movie" class="btn btn-primary mr-2" value="Add Movie">
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
</script>

</html>