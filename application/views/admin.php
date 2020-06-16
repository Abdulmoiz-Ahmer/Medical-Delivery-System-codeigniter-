 <div class="header bg-primary pb-6">
     <div class="container-fluid">
         <div class="header-body">
             <div class="row align-items-center py-3">
                 <div class="col-lg-6 col-7">
                     <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                         <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                             <li class="breadcrumb-item"><a href="<?php echo base_url('admin/employee') ?>"><i class="fas fa-home"></i></a></li>
                             <li class="breadcrumb-item"><a href="<?php echo base_url('admin/') ?>">Admin</a></li>
                             <li class="breadcrumb-item active" aria-current="page">Employee</li>
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
                         <h3 class="mb-0 float-left">Employees</h3>
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
                                 <th scope="col" class="sort text-center" data-sort="gender">Email</th>
                                 <th scope="col" class="sort text-center" data-sort="dob">CNIC</th>
                                 <th scope="col" class="sort text-center" data-sort="cnic">Designation</th>
                                 <th scope="col" class="sort text-center" data-sort="email">Department</th>
                                 <th scope="col" class="sort text-center" data-sort="status">Salary</th>
                                 <th scope="col" class="sort text-center" data-sort="status">Role</th>
                                 <th scope="col" class="sort text-center" data-sort="address">Joining Date</th>
                                 <th scope="col"></th>
                             </tr>
                         </thead>
                         <tbody class="">
                             <?php
                                if (isset($employees) && count($employees) != 0) {
                                ?>
                                 <?php
                                    foreach ($employees as $employee) {
                                    ?>
                                     <tr>
                                         <td class="text-center"><?php echo $employee['ename'] ?></td>
                                         <td class="text-center"><?php echo $employee['email'] ?></td>
                                         <td class="text-center"><?php echo $employee['cnic'] ?></td>
                                         <td class="text-center"><?php echo $employee['designation'] ?></td>
                                         <td class="text-center"><?php echo $employee['department'] ?></td>
                                         <td class="text-center"><?php echo $employee['salary'] ?></td>

                                         <td class="text-center"><?php if (isset($employee['role_name'])) {
                                                                        echo $employee['role_name'];
                                                                    } else {
                                                                        echo '-';
                                                                    } ?></td>

                                         <td class="text-center"><?php $timestamp = strtotime($employee['date_of_joining']);
                                                                    echo date('d-m-Y', $timestamp);  ?></td>

                                         <td class="text-right">
                                             <div class="dropdown">
                                                 <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                     <i class="fas fa-ellipsis-v"></i>
                                                 </a>
                                                 <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                     <a class="dropdown-item" href="<?php echo base_url('admin/deleteEmployee/') . $employee['eid'] ?>">Delete</a>
                                                     <a class="dropdown-item" href="<?php echo base_url('admin/updateEmployee/') . $employee['eid'] ?>">Update</a>
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
                                     <td colspan="9">No Employees Registered</td>
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

                 <!-- Update Modal -->
                 <div id="updateEmployeeModal" class="modal fade" role="dialog">
                     <div class="modal-dialog">

                         <!-- Modal content-->
                         <div class="modal-content">
                             <div class="modal-header">
                                 <h4 class="modal-title">Update Patient</h4>
                                 <button type="button" class="close" data-dismiss="modal">&times;</button>

                             </div>
                             <div class="modal-body">
                                 <form role="form" action="<?php
                                                            if (isset($employeeId)) {
                                                                echo base_url('admin/updateEmployeeData/') . $employeeId;
                                                            }
                                                            ?>" method="POST">

                                     <?php
                                        if (isset($updationOfEmployeeTimeErrors)) {
                                            echo '<div class="bg-danger text-white border-1 rounded mb-3 p-3">';
                                            echo $updationOfEmployeeTimeErrors;
                                            echo '</div>';
                                        }
                                        ?>
                                     <?php echo form_open(); ?>
                                     <div class="form-group">
                                         <label for="name">Full Name</label>
                                         <input class="form-control" placeholder="John Doe" name="name" value="<?php if (isset($previousUpdationEmployeeData)) {
                                                                                                                    echo $previousUpdationEmployeeData['name'];
                                                                                                                } else if (isset($employeeToUpdate)) {
                                                                                                                    echo $employeeToUpdate['name'];
                                                                                                                } else {
                                                                                                                    echo "";
                                                                                                                } ?>" type="text" pattern="^[a-zA-Z]+(?:[\s.]+[a-zA-Z]+)*$" required>
                                     </div>

                                     <div class="form-group">
                                         <label for="email">Email</label>
                                         <input class="form-control" placeholder="johndoe@mail.domain" name="email" value="<?php if (isset($previousUpdationEmployeeData)) {
                                                                                                                                echo $previousUpdationEmployeeData['email'];
                                                                                                                            } else if (isset($employeeToUpdate)) {
                                                                                                                                echo $employeeToUpdate['email'];
                                                                                                                            } else {
                                                                                                                                echo "";
                                                                                                                            }
                                                                                                                            ?>" type="email" required>

                                     </div>

                                     <div class="form-group">
                                         <label for="cnic">CNIC</label>
                                         <input class="form-control" placeholder="12345-1234567-8" disabled value="<?php if (isset($employeeToUpdate)) {
                                                                                                                        echo $employeeToUpdate['cnic'];
                                                                                                                    } else {
                                                                                                                        echo "";
                                                                                                                    } ?>" name="cnic" type="text" required pattern="^[0-9+]{5}-[0-9+]{7}-[0-9]{1}$">
                                     </div>

                                     <div class="form-group">
                                         <label for="department">Department</label>
                                         <input class="form-control" placeholder="Administration" value="<?php if (isset($previousUpdationEmployeeData)) {
                                                                                                                echo $previousUpdationEmployeeData['department'];
                                                                                                            } else if (isset($employeeToUpdate)) {
                                                                                                                echo $employeeToUpdate['department'];
                                                                                                            } else {
                                                                                                                echo "";
                                                                                                            } ?>" name="department" type="text" required pattern="[A-Za-z]+">

                                     </div>

                                     <div class="form-group">
                                         <label for="designation">Designation</label>
                                         <input class="form-control" placeholder="Doctor" name="designation" value="<?php if (isset($previousUpdationEmployeeData)) {
                                                                                                                        echo $previousUpdationEmployeeData['designation'];
                                                                                                                    } else if (isset($employeeToUpdate)) {
                                                                                                                        echo $employeeToUpdate['designation'];
                                                                                                                    } else {
                                                                                                                        echo "";
                                                                                                                    }
                                                                                                                    ?>" type="text" required pattern="[A-Za-z]+">

                                     </div>

                                     <div class="form-group">
                                         <label for="role">Role</label>
                                         <select class="form-control" name="role" required>
                                             <?php foreach ($roles as $role) : ?>
                                                 <option value="<?php echo $role['id']; ?>" <?php if (isset($previousUpdationEmployeeData) && $previousUpdationEmployeeData['role'] == $role['id']) {
                                                                                                echo "selected";
                                                                                            } else if (isset($employeeToUpdate) && $employeeToUpdate["role_id"] == $role['id']) {
                                                                                                echo "selected";
                                                                                            } ?>><?php echo $role['role_name']; ?></option>
                                             <?php endforeach; ?>
                                         </select>
                                     </div>


                                     <div class="form-group">
                                         <label for="salary">Salary</label>
                                         <input class="form-control" placeholder="100000" value="<?php if (isset($previousUpdationEmployeeData)) {
                                                                                                        echo $previousUpdationEmployeeData['salary'];
                                                                                                    } else if (isset($employeeToUpdate)) {
                                                                                                        echo $employeeToUpdate['salary'];
                                                                                                    } else {
                                                                                                        echo "";
                                                                                                    }
                                                                                                    ?>" name="salary" type="text" pattern="^[1-9]\d*(\.\d+)?$" required>

                                     </div>


                                     <div class="form-group">
                                         <label for="jdate">Date</label>
                                         <input class="form-control" name="jdate" value="<?php if (isset($previousUpdationEmployeeData)) {
                                                                                                echo $previousUpdationEmployeeData['jdate'];
                                                                                            } else if (isset($employeeToUpdate)) {
                                                                                                echo strftime(
                                                                                                    '%Y-%m-%d',
                                                                                                    strtotime($employeeToUpdate['date_of_joining'])
                                                                                                );
                                                                                            } else {
                                                                                                echo "";
                                                                                            }
                                                                                            ?>" type="date" required>

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