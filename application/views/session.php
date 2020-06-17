 <div class="header bg-primary pb-6">
     <div class="container-fluid">
         <div class="header-body">
             <div class="row align-items-center py-3">
                 <div class="col-lg-6 col-7">
                     <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                         <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                             <li class="breadcrumb-item"><a href="<?php echo base_url('receptionist/allpatients') ?>"><i class="fas fa-home"></i></a></li>
                             <li class="breadcrumb-item"><a href="<?php echo base_url('receptionist/') ?>">Receptionist</a></li>
                             <li class="breadcrumb-item active" aria-current="page">Sessions</li>
                         </ol>
                     </nav>
                 </div>
             </div>
         </div>
     </div>
 </div>



 <div class="container-fluid mt--6">
     <!-- <div class="row">
         <div class="col pt-7">
             <form role="form" action="<?php echo base_url('receptionist/load_sessions') ?>" method="POST">
                 <div class="form-group">
                     <label for="cnic">CNIC</label>
                     <div class="input-group mb-3">
                         <input class="form-control" placeholder="12345-1234567-8" value="<?php if (!isset($clear)) {
                                                                                                echo set_value('scnic');
                                                                                            } else {
                                                                                                echo "";
                                                                                            } ?>" name="scnic" type="text" required pattern="^[0-9+]{5}-[0-9+]{7}-[0-9]{1}$">
                         <div class="input-group-append">
                             <button class="btn btn-outline-secondary" type="submit">Load Sessions</button>
                         </div>
                     </div>
                 </div>
             </form>
         </div>
     </div> -->

     <div class="row">
         <div class="col">
             <div class="card">
                 <!-- Card header -->
                 <div class="card-header border-0">
                     <div class="clearfix" style="padding: '.5rem'">
                         <h3 class="mb-0 float-left">Sessions</h3>
                         <button type="button" id="openModal" class="float-right btn btn-primary" data-toggle="modal" data-target="#addSessionModal">Add Session</button>
                     </div>
                     <div>
                     </div>
                 </div>


                 <!-- Light table -->
                 <div class="table-responsive">
                     <table class="table align-items-center table-flush">
                         <thead class="thead-light">
                             <tr>
                                 <th scope="col" class="sort text-center" data-sort="name">Patien Name</th>
                                 <th scope="col" class="sort text-center" data-sort="symptom">Symptoms</th>
                                 <th scope="col" class="sort text-center" data-sort="doctor's_name">Doctor's Name</th>
                                 <th scope="col" class="sort text-center" data-sort="session_date">Session Date</th>
                             </tr>
                         </thead>
                         <tbody class="">
                             <?php
                                if (isset($sessions) && count($sessions) != 0) {
                                ?>
                                 <?php
                                    foreach ($sessions as $session) {
                                    ?>
                                     <tr>
                                         <td class="text-center"><?php echo $session['pname'] ?></td>

                                         <td class="text-center"><?php echo $session['symptoms'] ?></td>

                                         <td class="text-center">
                                             <?php
                                                if (!empty($session['ename'])) {
                                                    echo $session['ename'];
                                                } else {
                                                    echo '-';
                                                }
                                                ?>
                                         </td>
                                         <td class="text-center"><?php $timestamp = strtotime($session['date']);
                                                                    echo date('d-m-Y', $timestamp);  ?></td>
                                     </tr>

                                 <?php
                                    }
                                    ?>
                             <?php
                                } else {
                                ?>
                                 <tr>
                                     <td colspan="9">No Sessions Registered</td>
                                 </tr>
                             <?php
                                }
                                ?>

                         </tbody>
                     </table>
                 </div>
                 <!-- Card footer -->
                 <div class="card-footer py-4">
                     <div class="d-flex justify-content-end"> <?php echo $this->pagination->create_links(); ?></div>
                 </div>

                 <!-- Add Modal -->
                 <div id="addSessionModal" class="modal fade" role="dialog">
                     <div class="modal-dialog">

                         <!-- Modal content-->
                         <div class="modal-content">
                             <div class="modal-header">
                                 <h4 class="modal-title">Add Session</h4>
                                 <button type="button" class="close" data-dismiss="modal">&times;</button>

                             </div>
                             <div class="modal-body">
                                 <form role="form" action="<?php echo base_url('receptionist/add_session') ?>" method="POST">

                                     <?php
                                        if (isset($errorsOfAddSession) && $errorsOfAddSession) {
                                            echo '<div class="bg-danger text-white border-1 rounded mb-3 p-3">';
                                            echo $errorsOfAddSession;
                                            echo '</div>';
                                        }
                                        ?>
                                     <?php echo form_open(); ?>




                                     <div class="form-group">

                                         <label for="cnic">CNIC</label>
                                         <div class="input-group input-group-merge input-group-alternative">
                                             <div class="input-group-prepend">
                                                 <span class="input-group-text"><i class="fa fa-id-card" aria-hidden="true"></i></span>
                                             </div>
                                             <input class="form-control" placeholder="12345-1234567-8" value="<?php if (isset($previousDataAddSession)) {
                                                                                                                    echo $previousDataAddSession['cnic'];
                                                                                                                } else {
                                                                                                                    echo "";
                                                                                                                } ?>" name="cnic" type="text" required pattern="^[0-9+]{5}-[0-9+]{7}-[0-9]{1}$">
                                         </div>
                                     </div>

                                     <div class="form-group">
                                         <label for="symptoms">Symptoms</label>
                                         <div class="input-group input-group-merge input-group-alternative">
                                             <div class="input-group-prepend">
                                                 <span class="input-group-text"><i class="fa fa-heartbeat" aria-hidden="true"></i></span>
                                             </div>
                                             <textarea class="form-control" name="symptoms" placeholder="backpain ..." rows="3" required><?php if (isset($previousDataAddSession)) {
                                                                                                                                                echo $previousDataAddSession['symptoms'];
                                                                                                                                            } ?></textarea>
                                         </div>
                                     </div>

                                     <div class="clearfix" style="padding: '.5rem'">
                                         <button type="submit" class="btn btn-primary float-right">Create</button>
                                         <button type="button" class="btn btn-danger float-left" data-dismiss="modal">Close</button>
                                     </div>
                                 </form>
                             </div>

                         </div>

                     </div>
                 </div>

                 <!-- Update Modal -->
                 <div id="updateModal" class="modal fade" role="dialog">
                     <div class="modal-dialog">

                         <!-- Modal content-->
                         <div class="modal-content">
                             <div class="modal-header">
                                 <h4 class="modal-title">Update Session</h4>
                                 <button type="button" class="close" data-dismiss="modal">&times;</button>

                             </div>
                             <div class="modal-body">
                                 <form role="form" action="<?php
                                                            if (isset($patientId)) {
                                                                echo base_url('receptionist/updatePatientData/') . $patientId;
                                                            }
                                                            ?>" method="POST">

                                     <?php
                                        if (isset($updationTimeErrors)) {
                                            echo '<div class="bg-danger text-white border-1 rounded mb-3 p-3">';
                                            echo $updationTimeErrors;
                                            echo '</div>';
                                        }
                                        ?>
                                     <?php echo form_open(); ?>
                                     <div class="form-group">
                                         <label for="uname">Full Name</label>
                                         <input class="form-control" placeholder="John Doe" name="uname" value="<?php
                                                                                                                if (isset($previousData)) {
                                                                                                                    echo $previousData["uname"];
                                                                                                                } else {
                                                                                                                    if (isset($patientToUpdate)) {
                                                                                                                        echo $patientToUpdate['name'];
                                                                                                                    }
                                                                                                                }

                                                                                                                ?>" type="text" pattern="^[a-zA-Z]+(?:[\s.]+[a-zA-Z]+)*$" required>
                                     </div>




                                     <div class="form-group">

                                         <label for="ucnic">CNIC</label>
                                         <input class="form-control" placeholder="12345-1234567-8" disabled value="<?php if (isset($previousData)) {
                                                                                                                        echo $previousData["ucnic"];
                                                                                                                    } else {
                                                                                                                        if (isset($patientToUpdate)) {
                                                                                                                            echo $patientToUpdate['cnic'];
                                                                                                                        }
                                                                                                                    } ?>" name="ucnic" type="text" required pattern="^[0-9+]{5}-[0-9+]{7}-[0-9]{1}$">
                                     </div>

                                     <div class="form-group">
                                         <label for="uemail">Email</label>
                                         <input class="form-control" placeholder="johndoe@mail.domain" name="uemail" value="<?php if (isset($previousData)) {
                                                                                                                                echo $previousData["uemail"];
                                                                                                                            } else {
                                                                                                                                if (isset($patientToUpdate)) {
                                                                                                                                    echo $patientToUpdate['email'];
                                                                                                                                }
                                                                                                                            }
                                                                                                                            ?>" type="email" required>

                                     </div>

                                     <div class="form-group">
                                         <label for="jdate">Date Of Birth</label>
                                         <input class="form-control" name="ubday" value="<?php if (isset($previousData)) {
                                                                                                echo $previousData["ubday"];
                                                                                            } else {
                                                                                                if (isset($patientToUpdate) && $patientToUpdate['birthday']) {
                                                                                                    echo strftime(
                                                                                                        '%Y-%m-%d',
                                                                                                        strtotime($patientToUpdate['birthday'])
                                                                                                    );
                                                                                                }
                                                                                            }

                                                                                            ?>" type="date" required>

                                     </div>
                                     <div class="form-group">
                                         <label for="address">Address</label>
                                         <textarea class="form-control" name="uaddress" placeholder="123 Main Street, New York, NY 10030" rows="3" required><?php if (isset($previousData)) {
                                                                                                                                                                echo $previousData["uaddress"];
                                                                                                                                                            } else {
                                                                                                                                                                if (isset($patientToUpdate)) {
                                                                                                                                                                    echo $patientToUpdate['address'];
                                                                                                                                                                }
                                                                                                                                                            } ?></textarea>
                                     </div>


                                     <div class="form-group">
                                         <label for="gender">Gender</label>
                                         <select class="form-control" name="ugender" disabled required>
                                             <option value="1" <?php
                                                                if (isset($previousData) && $previousData["ugender"] == 1) {
                                                                    echo "selected";
                                                                } else if (isset($patientToUpdate) && $patientToUpdate["gender"] == 1) {
                                                                    echo "selected";
                                                                }
                                                                ?>>Female</option>
                                             <option value="2" <?php if (isset($previousData) && $previousData["ugender"] == 2) {
                                                                    echo "selected";
                                                                } else if (isset($patientToUpdate) && $patientToUpdate["gender"] == 2) {
                                                                    echo "selected";
                                                                } ?>>Male</option>
                                             <option value="3" <?php if (isset($previousData) && $previousData["ugender"] == 3) {
                                                                    echo "selected";
                                                                } else if (isset($patientToUpdate) && $patientToUpdate["gender"] == 3) {
                                                                    echo "selected";
                                                                } ?>>Other</option>
                                         </select>
                                     </div>


                                     <div class="clearfix" style="padding: '.5rem'">
                                         <button type="submit" class="btn btn-primary float-right">Save</button>
                                         <button type="button" class="btn btn-danger float-left" data-dismiss="modal">Close</button>
                                     </div>
                                 </form>
                             </div>

                         </div>

                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>