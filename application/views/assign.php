 <div class="header bg-primary pb-6">
     <div class="container-fluid">
         <div class="header-body">
             <div class="row align-items-center py-3">
                 <div class="col-lg-6 col-7">
                     <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                         <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                             <li class="breadcrumb-item"><a href="<?php echo base_url('receptionist/assign') ?>"><i class="fas fa-home"></i></a></li>
                             <li class="breadcrumb-item"><a href="<?php echo base_url('receptionist/') ?>">Receptionist</a></li>
                             <li class="breadcrumb-item active" aria-current="page">Assign</li>
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
                         <h3 class="mb-0 float-left">Doctors</h3>
                         <!-- <button type="button" id="openModal" class="float-right btn btn-primary" data-toggle="modal" data-target="#myModal">Add Patient</button> -->
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
                                 <th scope="col" class="sort text-center" data-sort="address">Department</th>
                                 <th scope="col" class="sort text-center" data-sort="address">Designation</th>
                                 <th scope="col"></th>
                             </tr>
                         </thead>
                         <tbody class="">
                             <?php
                                if (isset($doctors) && count($doctors) != 0) {
                                ?>
                                 <?php
                                    foreach ($doctors as $doctor) {
                                    ?>
                                     <tr>
                                         <td class="text-center"><?php echo $doctor['name'] ?></td>
                                         <td class="text-center"><?php echo $doctor['department'] ?></td>
                                         <td class="text-center"><?php echo $doctor['designation'] ?></td>
                                         <td class="text-right">
                                             <div class="dropdown">
                                                 <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                     <i class="fas fa-ellipsis-v"></i>
                                                 </a>
                                                 <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                     <a class="dropdown-item" href="<?php echo base_url() . "receptionist/doctor_to_patient/" . $doctor['id'] ?>">Assign Patient</a>
                                                 </div>
                                             </div>
                                         </td>
                                     </tr>

                                 <?php
                                    }


                                    ?>


                             <?php
                                } else {
                                ?>
                                 <tr>
                                     <td colspan="9">No Doctors Registered</td>
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
                 <div id="assignPatientModal" class="modal fade" role="dialog">
                     <div class="modal-dialog">

                         <!-- Modal content-->
                         <div class="modal-content">
                             <div class="modal-header">
                                 <h4 class="modal-title">Assign Patient</h4>
                                 <button type="button" class="close" data-dismiss="modal">&times;</button>

                             </div>
                             <div class="modal-body">
                                 <form role="form" action="<?php echo base_url('receptionist/assignPatientTheDoctor/') . $doctorId ?>" method="POST">

                                     <?php
                                        if (isset($assignmentTimeErrors)) {
                                            echo '<div class="bg-danger text-white border-1 rounded mb-3 p-3">';
                                            echo $assignmentTimeErrors;
                                            echo '</div>';
                                        }
                                        ?>
                                     <?php echo form_open(); ?>
                                     <div class="form-group">
                                         <label for="name">Doctor's Name</label>
                                         <input class="form-control" placeholder="John Doe" name="name" disabled value="<?php
                                                                                                                        if (isset($doctorToBeAssigned["name"])) {
                                                                                                                            echo $doctorToBeAssigned["name"];
                                                                                                                        }
                                                                                                                        ?>" type="text" pattern="^[a-zA-Z]+(?:[\s.]+[a-zA-Z]+)*$" required>
                                     </div>




                                     <div class="form-group">

                                         <label for="cnic">Patient's Cnic No.</label>
                                         <input class="form-control" placeholder="12345-1234567-8" value="<?php if (isset($previousAssignPatientData)) {
                                                                                                                echo $previousAssignPatientData['cnic'];
                                                                                                            } else {
                                                                                                                echo "";
                                                                                                            } ?>" name="cnic" type="text" required pattern="^[0-9+]{5}-[0-9+]{7}-[0-9]{1}$">
                                     </div>

                                     <div class="clearfix" style="padding: '.5rem'">
                                         <button type="submit" class="btn btn-primary float-right">assign</button>
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