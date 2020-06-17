 <div class="header bg-primary pb-6">
     <div class="container-fluid">
         <div class="header-body">
             <div class="row align-items-center py-3">
                 <div class="col-lg-6 col-7">
                     <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                         <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                             <li class="breadcrumb-item"><a href="<?php echo base_url('Msa/prescription') ?>"><i class="fas fa-home"></i></a></li>
                             <li class="breadcrumb-item"><a href="<?php echo base_url('Msa/') ?>">Medical Support Officer</a></li>
                             <li class="breadcrumb-item active" aria-current="page">Prescriptions</li>
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
                         <h3 class="mb-0 float-left">Prescriptions</h3>
                     </div>
                     <div>
                     </div>
                 </div>

                 <!-- Light table -->
                 <div class="table-responsive">
                     <table class="table align-items-center table-flush">
                         <thead class="thead-light">
                             <tr>
                                 <th scope="col" class="sort text-center" data-sort="name">Patient's Name</th>
                                 <th scope="col" class="sort text-center" data-sort="gender">Email</th>
                                 <th scope="col" class="sort text-center" data-sort="dob">Address</th>
                                 <th scope="col" class="sort text-center" data-sort="status">Status</th>
                                 <th scope="col" class="sort text-center" data-sort="cnic">Medicine</th>
                                 <th scope="col" class="sort text-center" data-sort="email">Intake Duration (weeks)</th>
                                 <th scope="col" class="sort text-center" data-sort="doctor">Doctor</th>
                                 <th scope="col" class="sort text-center" data-sort="address">Doctor's Comment</th>
                                 <th scope="col" class="sort text-center" data-sort="address">Prescribed Date</th>

                                 <th scope="col"></th>
                             </tr>
                         </thead>
                         <tbody class="">
                             <?php
                                if (isset($prescriptions) && count($prescriptions) != 0) {
                                ?>
                                 <?php
                                    foreach ($prescriptions as $prescription) {
                                    ?>
                                     <tr>
                                         <td class="text-center"><?php echo $prescription['name'] ?></td>
                                         <td class="text-center"><?php echo $prescription['email'] ?></td>
                                         <td class="text-center"><?php echo $prescription['address'] ?></td>
                                         <td class="text-center"><?php
                                                                    if (!empty($prescription['status'])) {
                                                                        if ($prescription['status'] == 1) {
                                                                            echo 'Active';
                                                                        } else {
                                                                            echo 'Inactive';
                                                                        }
                                                                    } else {
                                                                        echo 'Inactive';
                                                                    }
                                                                    ?></td>
                                         <td class="text-center"><?php echo $prescription['general_details'] ?></td>
                                         <td class="text-center"><?php echo $prescription['intake_duration'] ?></td>
                                         <td class="text-center"><?php echo $prescription['dname'] ?></td>
                                         <td class="text-center"><?php echo $prescription['mo_comment'] ?></td>

                                         <td class="text-center"><?php $timestamp = strtotime($prescription['create_date']);
                                                                    echo date('d-m-Y', $timestamp);  ?></td>
                                         <td class="text-right">
                                             <div class="dropdown">
                                                 <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                     <i class="fas fa-ellipsis-v"></i>
                                                 </a>
                                                 <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                     <a class="dropdown-item" href="<?php echo base_url('Msa/RequestConfirmationModal/') . $prescription['pr_id'] ?>">Send Request</a>
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
                                     <td colspan="9">No Patients Registered</td>
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

                 <div id="sendRequestConfirmationModal" class="modal fade" role="dialog">
                     <div class="modal-dialog">

                         <!-- Modal content-->
                         <div class="modal-content">
                             <div class="modal-header">
                                 <h4 class="modal-title">Are You Sure?</h4>
                                 <button type="button" class="close" data-dismiss="modal">&times;</button>

                             </div>
                             <div class="modal-body">
                                 <form role="form" action="<?php
                                                            if (isset($prescriptionId)) {
                                                                echo base_url('Msa/sendRequest/') . $prescriptionId;
                                                            }
                                                            ?>" method="POST">

                                     <?php echo form_open(); ?>
                                     <div class="clearfix" style="padding: '.5rem'">
                                         <button type="submit" class="btn btn-primary float-right">Yes</button>
                                         <button type="button" class="btn btn-danger float-left" data-dismiss="modal">No</button>
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