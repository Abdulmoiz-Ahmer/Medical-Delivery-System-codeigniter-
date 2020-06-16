 <div class="header bg-primary pb-6">
     <div class="container-fluid">
         <div class="header-body">
             <div class="row align-items-center py-3">
                 <div class="col-lg-6 col-7">
                     <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                         <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                             <li class="breadcrumb-item"><a href="<?php echo base_url('Mo/mypatients') ?>"><i class="fas fa-home"></i></a></li>
                             <li class="breadcrumb-item"><a href="<?php echo base_url('Mo/') ?>">Medical Operator</a></li>
                             <li class="breadcrumb-item active" aria-current="page">My Patients</li>
                         </ol>
                     </nav>
                 </div>
             </div>
         </div>
     </div>
 </div>



 <div class="container-fluid mt--6">
     <div class="row">
         <div class="col">
             <div class="card">
                 <!-- Card header -->
                 <div class="card-header border-0">
                     <div class="clearfix" style="padding: '.5rem'">
                         <h3 class="mb-0 float-left">My Patients</h3>
                         <button type="button" id="openModal" class="float-right btn btn-primary" data-toggle="modal" data-target="#addPrescriptionModal">Add Prescription</button>
                     </div>
                     <div>
                     </div>
                 </div>


                 <!-- Light table -->
                 <div class="table-responsive">
                     <table class="table align-items-center table-flush">
                         <thead class="thead-light">
                             <tr>
                                 <th scope="col" class="sort text-center" data-sort="name">Name</th>
                                 <th scope="col" class="sort text-center" data-sort="gender">Gender</th>
                                 <th scope="col" class="sort text-center" data-sort="dob">DOB</th>
                                 <th scope="col" class="sort text-center" data-sort="cnic">CNIC</th>
                                 <th scope="col" class="sort text-center" data-sort="email">Email</th>
                                 <th scope="col" class="sort text-center" data-sort="address">Address</th>
                                 <th scope="col" class="sort text-center" data-sort="status">Status</th>
                             </tr>
                         </thead>
                         <tbody class="">
                             <?php
                                if (isset($patients) && count($patients) != 0) {
                                ?>
                                 <?php
                                    foreach ($patients as $patient) {
                                    ?>
                                     <tr>
                                         <td class="text-center"><?php echo $patient['pname'] ?></td>
                                         <td class="text-center"><?php if ($patient['gender'] == 1) {
                                                                        echo "Female";
                                                                    } elseif ($patient['gender'] == 2) {
                                                                        echo "Male";
                                                                    } elseif ($patient['gender'] == 3) {
                                                                        echo "Other";
                                                                    } ?></td>
                                         <td class="text-center"><?php $timestamp = strtotime($patient['birthday']);
                                                                    echo date('d-m-Y', $timestamp);  ?></td>
                                         <td class="text-center"><?php echo $patient['cnic'] ?></td>
                                         <td class="text-center"><?php echo $patient['email'] ?></td>
                                         <td class="text-center"><?php echo $patient['address'] ?></td>
                                         <td class="text-center"><?php
                                                                    if (!empty($patient['status'])) {
                                                                        echo $patient['status'];
                                                                    } else {
                                                                        echo '-';
                                                                    }
                                                                    ?></td>
                                     </tr>
                                 <?php
                                    }
                                    ?>


                             <?php
                                } else {
                                ?>
                                 <tr>
                                     <td colspan="8" class="text-center">No Patients Allocated To You Yet</td>
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
                 <div id="addPrescriptionModal" class="modal fade" role="dialog">
                     <div class="modal-dialog">

                         <!-- Modal content-->
                         <div class="modal-content">
                             <div class="modal-header">
                                 <h4 class="modal-title">Add Prescription</h4>
                                 <button type="button" class="close" data-dismiss="modal">&times;</button>

                             </div>
                             <div class="modal-body">
                                 <form role="form" action="<?php echo base_url('Mo/add_prescripiton') ?>" method="POST">

                                     <?php
                                        if (isset($additionOfPrescription)) {
                                            echo '<div class="bg-danger text-white border-1 rounded mb-3 p-3">';
                                            echo $additionOfPrescription;
                                            echo '</div>';
                                        }
                                        ?>
                                     <?php echo form_open(); ?>
                                     <div class="form-group">

                                         <label for="cnic">Patient's Cnic No.</label>
                                         <input class="form-control" placeholder="12345-1234567-8" value="<?php if (isset($previousAddPrescripitionData)) {
                                                                                                                echo $previousAddPrescripitionData["cnic"];
                                                                                                            }  ?>" name="cnic" type="text" pattern="^[0-9+]{5}-[0-9+]{7}-[0-9]{1}$" required>
                                     </div>

                                     <div class="form-group">
                                         <label for="comment">Medicines</label>
                                         <textarea class="form-control" name="gdetails" placeholder="Temazepam (Restoril) 2 times per day" rows="3" required><?php if (isset($previousAddPrescripitionData)) {
                                                                                                                                                                    echo $previousAddPrescripitionData["gdetails"];
                                                                                                                                                                }  ?></textarea>
                                     </div>


                                     <div class="form-group">

                                         <label for="intake">Intake Duration</label>
                                         <input class="form-control" placeholder="6 (in weeks)" value="<?php if (isset($previousAddPrescripitionData)) {
                                                                                                            echo $previousAddPrescripitionData["intake"];
                                                                                                        } ?>" name="intake" type="number" required>
                                     </div>

                                     <div class="form-group">
                                         <label for="comment">Comment</label>
                                         <textarea class="form-control" name="comment" placeholder="Additional doctors remarks..." rows="3" required><?php if (isset($previousAddPrescripitionData)) {
                                                                                                                                                            echo $previousAddPrescripitionData["comment"];
                                                                                                                                                        } ?></textarea>
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
                                 <h4 class="modal-title">Update Patient</h4>
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