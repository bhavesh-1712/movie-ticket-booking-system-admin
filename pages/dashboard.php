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
                                <div class="col-12 col-xl-12 mb-4 mb-xl-0">
                                    <h3 class="font-weight-bold">Welcome, <?php echo $result[0]['name'];?></h3>
                                    <!-- <h6 class="font-weight-normal mb-0">All systems are running smoothly! You have <span class="text-primary">3 unread alerts!</span></h6> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 mb-4 stretch-card transparent" data-toggle="modal">
                            <div class="card card-tale">
                                <div class="card-body">
                                    <p class="mb-4">No of movies</p>
                                    <p class="fs-30 mb-2"><?php echo $data['totalMovie'];?></p>
                                    <!-- <p>10.00% (30 days)</p> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4 stretch-card transparent">
                            <div class="card card-dark-blue">
                                <div class="card-body">
                                    <p class="mb-4">Total Customer</p>
                                    <p class="fs-30 mb-2"><?php echo $data['totalCustomer'];?></p>
                                    <!-- <p>22.00% (30 days)</p> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4 stretch-card transparent">
                            <div class="card card-light-blue">
                                <div class="card-body">
                                    <p class="mb-4">No of slot</p>
                                    <p class="fs-30 mb-2"><?php echo $data['totalSlot'];?></p>
                                    <!-- <p>2.00% (30 days)</p> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4 stretch-card transparent">
                            <div class="card card-light-danger">
                                <div class="card-body">
                                    <p class="mb-4">Total Income</p>
                                    <p class="fs-30 mb-2">Rs. <?php echo $data['totalIncome'];?>/-</p>
                                    <!-- <p>0.22% (30 days)</p> -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <br>
                    <?php
                    echo "<pre>";
                    var_dump($bookingDetail);
                    echo "</pre>";
                    $str = ['A','B','C','D','E','F','G','H','I','J'];
                    ?>
                    <?php 
                        foreach($bookingDetail as $data){
                    ?>
                    <div class="container">
                        <h5 class="text-center"><?php echo $data['movie_name']; ?></h5>
                        <div class="row">
                            <div class="col-sm-4">
                                <p>Time Sloat 1</p>
                                <?php  
                                    $count=1;
                                    for($row=0;$row<10;$row++){ 
                                        for($col=0; $col<4;$col++){  
                                            $flag=false; 
                                            foreach($data['booking_data'][3] as $seatData){ 
                                                if($seatData['seat_no']==$count){
                                                    $flag=true;
                                                }
                                            }   
                                            if($flag){
                                                echo "<button class='btn text-center' style='margin:2px;width:40px;background-color:#00FF00'>".$str[$row].($count++)."</button>";  
                                            }
                                            else{
                                                echo "<button class='btn text-center' style='margin:2px;width:40px;background-color:#FF0000'>".$str[$row].($count++)."</button>";  
                                            }                    
                                        } 
                                         echo "<br>";
                                    } ?>
                            </div>

                        </div>
                    </div>
                    <?php
                    }?>
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

</html>