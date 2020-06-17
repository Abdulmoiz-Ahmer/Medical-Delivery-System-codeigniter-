 <div class="header bg-primary pb-6">
     <div class="container-fluid">
         <div class="header-body">
             <div class="row align-items-center py-3">
                 <div class="col-lg-6 col-7">
                     <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                         <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                             <li class="breadcrumb-item"><a href="<?php echo base_url('Msa/prescription') ?>"><i class="fas fa-home"></i></a></li>
                             <li class="breadcrumb-item"><a href="<?php echo base_url('Msa/stocks/') ?>">Medical Support Officer</a></li>
                             <li class="breadcrumb-item active" aria-current="page">Stocks</li>
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
                         <h3 class="mb-0 float-left">Stocks</h3>
                         <button type="button" id="openModal" class="float-right btn btn-primary" data-toggle="modal" data-target="#AddStockModal">Add Stock</button>
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
                                 <th scope="col" class="sort text-center" data-sort="gender">Weight</th>
                                 <th scope="col" class="sort text-center" data-sort="dob">Unit Price (Rs.)</th>
                                 <th scope="col" class="sort text-center" data-sort="cnic">Total Quantity</th>
                                 <th scope="col" class="sort text-center" data-sort="cnic">Batch Cost Price (Rs.)</th>
                                 <th scope="col" class="sort text-center" data-sort="email">Batch Manufacturing Date</th>
                                 <th scope="col" class="sort text-center" data-sort="address">Batch Expiry Date</th>
                                 <th scope="col"></th>
                             </tr>
                         </thead>
                         <tbody>
                             <?php
                                if (isset($stocks) && count($stocks) != 0) {
                                ?>
                                 <?php
                                    foreach ($stocks as $stock) {
                                    ?>
                                     <tr>
                                         <td class="text-center"><?php echo $stock['name'] ?></td>
                                         <td class="text-center"><?php echo $stock['weight'] . " " . $stock['weight_unit'] ?></td>
                                         <td class="text-center"><?php echo $stock['unit_price'] ?></td>
                                         <td class="text-center"><?php echo $stock['cost_price'] ?></td>
                                         <td class="text-center"><?php echo $stock['quantity'] ?></td>
                                         <td class="text-center"><?php $timestamp = strtotime($stock['date']);
                                                                    echo date('d-m-Y', $timestamp);  ?></td>
                                         <td class="text-center"><?php $timestamp = strtotime($stock['expiry']);
                                                                    echo date('d-m-Y', $timestamp);  ?></td>
                                         <td class="text-right">
                                             <div class="dropdown">
                                                 <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                     <i class="fas fa-ellipsis-v"></i>
                                                 </a>
                                                 <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                     <a class="dropdown-item" href="<?php echo base_url('Msa/updateStock/') . $stock['id'] ?>">Update</a>
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

                 <!-- Add Modal -->
                 <div id="AddStockModal" class="modal fade" role="dialog">
                     <div class="modal-dialog">

                         <!-- Modal content-->
                         <div class="modal-content">
                             <div class="modal-header">
                                 <h4 class="modal-title">Add Stock</h4>
                                 <button type="button" class="close" data-dismiss="modal">&times;</button>

                             </div>
                             <div class="modal-body">
                                 <form role="form" action="<?php echo base_url('Msa/addStockData') ?>" method="POST">

                                     <?php
                                        if (isset($additionStockTimeErrors)) {
                                            echo '<div class="bg-danger text-white border-1 rounded mb-3 p-3">';
                                            echo $additionStockTimeErrors;
                                            echo '</div>';
                                        }
                                        ?>
                                     <?php echo form_open(); ?>
                                     <div class="form-group">
                                         <label for="name">Name</label>
                                         <input class="form-control" placeholder="Ativan" name="name" value="<?php if (isset($previousAdditionStockData)) {
                                                                                                                    echo $previousAdditionStockData['name'];
                                                                                                                } ?>" type="text" pattern="^[a-zA-Z]+(?:[\s.]+[a-zA-Z]+)*$" required>
                                     </div>

                                     <div class="form-group">
                                         <label for="name">Weight</label>
                                         <div class="form-row">
                                             <div class="col-8">
                                                 <input class="form-control" placeholder="4" name="weight" value="<?php if (isset($previousAdditionStockData)) {
                                                                                                                        echo $previousAdditionStockData['weight'];
                                                                                                                    } ?>" type="number" min="1" required>
                                             </div>

                                             <div class="col-4">
                                                 <select class="form-control" name="weight_unit" required>
                                                     <option value="kg" <?php if (isset($previousAdditionStockData)) {
                                                                            if ($previousAdditionStockData['weight_unit'] == 'kg') {
                                                                                echo "selected";
                                                                            }
                                                                        } else echo ""; ?>>kg</option>
                                                     <option value="g" <?php if (isset($previousAdditionStockData)) {
                                                                            if ($previousAdditionStockData['weight_unit'] == 'g') {
                                                                                echo "selected";
                                                                            }
                                                                        } else echo ""; ?>>g</option>
                                                     <option value="mg" <?php if (isset($previousAdditionStockData)) {
                                                                            if ($previousAdditionStockData['weight_unit'] == 'mg') {
                                                                                echo "selected";
                                                                            }
                                                                        } else echo ""; ?>>mg</option>

                                                     <option value="mcg" <?php if (isset($previousAdditionStockData)) {
                                                                                if ($previousAdditionStockData['weight_unit'] == 'mcg') {
                                                                                    echo "selected";
                                                                                }
                                                                            } else echo ""; ?>>mcg</option>
                                                 </select>
                                             </div>
                                         </div>
                                     </div>

                                     <div class="form-group">
                                         <label for="name">Unit Price</label>
                                         <input class="form-control" placeholder="4" name="unit_price" value="<?php if (isset($previousAdditionStockData)) {
                                                                                                                    echo $previousAdditionStockData['unit_price'];
                                                                                                                } ?>" type="number" min="1" required>
                                     </div>


                                     <div class="form-group">
                                         <label for="name">Quantity</label>
                                         <input class="form-control" placeholder="4" name="quantity" value="<?php if (isset($previousAdditionStockData)) {
                                                                                                                echo $previousAdditionStockData['quantity'];
                                                                                                            } ?>" type="number" min="1" required>
                                     </div>

                                     <div class="form-group">
                                         <label for="name">Cost Price</label>
                                         <input class="form-control" placeholder="4" name="cost_price" value="<?php if (isset($previousAdditionStockData)) {
                                                                                                                    echo $previousAdditionStockData['cost_price'];
                                                                                                                } ?>" type="number" min="1" required>
                                     </div>


                                     <div class="form-group">
                                         <label for="mdate">Manufacturing Date</label>
                                         <input class="form-control" name="mdate" value="<?php if (isset($previousAdditionStockData)) {
                                                                                                echo $previousAdditionStockData['mdate'];
                                                                                            } ?>" type="date" required>

                                     </div>

                                     <div class="form-group">
                                         <label for="edate">Expiry Date</label>
                                         <input class="form-control" name="edate" value="<?php if (isset($previousAdditionStockData)) {
                                                                                                echo $previousAdditionStockData['edate'];
                                                                                            } ?>" type="date" required>

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
                 <div id="updateStockModal" class="modal fade" role="dialog">
                     <div class="modal-dialog">

                         <!-- Modal content-->
                         <div class="modal-content">
                             <div class="modal-header">
                                 <h4 class="modal-title">Update Patient</h4>
                                 <button type="button" class="close" data-dismiss="modal">&times;</button>

                             </div>

                             <div class="modal-body">
                                 <form role="form" action="<?php
                                                            if (isset($stockId)) {
                                                                echo base_url('Msa/updateStockData/') . $stockId;
                                                            }
                                                            ?>" method="POST">

                                     <?php
                                        if (isset($updationStockTimeErrors)) {
                                            echo '<div class="bg-danger text-white border-1 rounded mb-3 p-3">';
                                            echo $updationStockTimeErrors;
                                            echo '</div>';
                                        }
                                        ?>
                                     <?php echo form_open(); ?>
                                     <div class="form-group">
                                         <label for="name">Name</label>
                                         <input class="form-control" placeholder="Ativan" name="name" value="<?php if (isset($previousUpdationStockData)) {
                                                                                                                    echo $previousUpdationStockData['name'];
                                                                                                                } else if (isset($stockToUpdate)) {
                                                                                                                    echo  $stockToUpdate[0]['name'];
                                                                                                                } ?>" type="text" pattern="^[a-zA-Z]+(?:[\s.]+[a-zA-Z]+)*$" required>
                                     </div>

                                     <div class="form-group">
                                         <label for="name">Weight</label>
                                         <div class="form-row">
                                             <div class="col-8">
                                                 <input class="form-control" placeholder="4" name="weight" value="<?php if (isset($previousUpdationStockData)) {
                                                                                                                        echo $previousUpdationStockData['weight'];
                                                                                                                    } else if (isset($stockToUpdate)) {
                                                                                                                        echo  $stockToUpdate[0]['weight'];
                                                                                                                    }  ?>" type="number" min="1" required>
                                             </div>

                                             <div class="col-4">
                                                 <select class="form-control" name="weight_unit" required>
                                                     <option value="kg" <?php if (isset($previousUpdationStockData)) {
                                                                            if ($previousUpdationStockData['weight_unit'] == 'kg') {
                                                                                echo "selected";
                                                                            }
                                                                        } else if (isset($stockToUpdate) && $stockToUpdate[0]['weight_unit'] == 'kg') {
                                                                            echo "selected";
                                                                        } else echo ""; ?>>kg</option>
                                                     <option value="g" <?php if (isset($previousUpdationStockData)) {
                                                                            if ($previousUpdationStockData['weight_unit'] == 'g') {
                                                                                echo "selected";
                                                                            }
                                                                        } else if (isset($stockToUpdate) && $stockToUpdate[0]['weight_unit'] == 'g') {
                                                                            echo "selected";
                                                                        } else echo ""; ?>>g</option>
                                                     <option value="mg" <?php if (isset($previousUpdationStockData)) {
                                                                            if ($previousUpdationStockData['weight_unit'] == 'mg') {
                                                                                echo "selected";
                                                                            }
                                                                        } else if (isset($stockToUpdate) && $stockToUpdate[0]['weight_unit'] == 'mg') {
                                                                            echo "selected";
                                                                        } else echo ""; ?>>mg</option>

                                                     <option value="mcg" <?php if (isset($previousUpdationStockData)) {
                                                                                if ($previousUpdationStockData['weight_unit'] == 'mcg') {
                                                                                    echo "selected";
                                                                                }
                                                                            } else if (isset($stockToUpdate) && $stockToUpdate[0]['weight_unit'] == 'mcg') {
                                                                                echo "selected";
                                                                            } else echo ""; ?>>mcg</option>
                                                 </select>
                                             </div>
                                         </div>
                                     </div>

                                     <div class="form-group">
                                         <label for="name">Unit Price</label>
                                         <input class="form-control" placeholder="4" name="unit_price" value="<?php if (isset($previousUpdationStockData)) {
                                                                                                                    echo $previousUpdationStockData['unit_price'];
                                                                                                                } else if (isset($stockToUpdate)) {
                                                                                                                    echo  $stockToUpdate[0]['unit_price'];
                                                                                                                }  ?>" type="number" min="1" required>
                                     </div>


                                     <div class="form-group">
                                         <label for="name">Quantity</label>
                                         <input class="form-control" placeholder="4" name="quantity" value="<?php if (isset($previousUpdationStockData)) {
                                                                                                                echo $previousUpdationStockData['quantity'];
                                                                                                            } else if (isset($stockToUpdate)) {
                                                                                                                echo  $stockToUpdate[0]['quantity'];
                                                                                                            }  ?>" type="number" min="1" required>
                                     </div>

                                     <div class="form-group">
                                         <label for="name">Cost Price</label>
                                         <input class="form-control" placeholder="4" name="cost_price" value="<?php if (isset($previousUpdationStockData)) {
                                                                                                                    echo $previousUpdationStockData['cost_price'];
                                                                                                                } else if (isset($stockToUpdate)) {
                                                                                                                    echo  $stockToUpdate[0]['cost_price'];
                                                                                                                }  ?>" type="number" min="1" required>
                                     </div>


                                     <div class="form-group">
                                         <label for="mdate">Manufacturing Date</label>
                                         <input class="form-control" name="mdate" value="<?php if (isset($previousUpdationStockData)) {
                                                                                                echo $previousUpdationStockData['mdate'];
                                                                                            } else if (isset($stockToUpdate)) {
                                                                                                echo strftime(
                                                                                                    '%Y-%m-%d',
                                                                                                    strtotime($stockToUpdate[0]['date'])
                                                                                                );
                                                                                            }  ?>" type="date" required>

                                     </div>

                                     <div class="form-group">
                                         <label for="edate">Expiry Date</label>
                                         <input class="form-control" name="edate" value="<?php if (isset($previousUpdationStockData)) {
                                                                                                echo $previousUpdationStockData['edate'];
                                                                                            } else if (isset($stockToUpdate)) {
                                                                                                echo strftime(
                                                                                                    '%Y-%m-%d',
                                                                                                    strtotime($stockToUpdate[0]['expiry'])
                                                                                                );
                                                                                            }  ?>" type="date" required>

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