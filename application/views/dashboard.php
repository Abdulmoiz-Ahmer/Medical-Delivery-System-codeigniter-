</div>
<!-- Argon Scripts -->
<!-- Core -->
<script src="<?php echo base_url('assets/vendor/jquery/dist/jquery.min.js') ?>"></script>
<script src="<?php echo base_url('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?php echo base_url('assets/vendor/js-cookie/js.cookie.js') ?>"></script>
<script src="<?php echo base_url('assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js') ?>"></script>
<script src="<?php echo base_url('assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js') ?>"></script>
<!-- Optional JS -->
<script src="<?php echo base_url('assets/vendor/chart.js/dist/Chart.min.js') ?>"></script>
<script src="<?php echo base_url('assets/vendor/chart.js/dist/Chart.extension.js') ?>"></script>
<!-- Argon JS -->
<script src="<?php echo base_url('assets/js/argon.js?v=1.2.0') ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.bootstrap-growl.min.js') ?>"></script>
<?php
if (isset($growl)) {
    if ($growl == -1) {

?>
        <script type="text/javascript">
            $(function() {
                var msg = "<?php echo $message; ?>"
                setTimeout(function() {
                    $.bootstrapGrowl(msg, {
                        type: 'danger',
                        width: 'auto',
                        allow_dismiss: true
                    });
                }, 1000);
            });
        </script>
    <?php
    } else if ($growl == 1) {
    ?>
        <script type="text/javascript">
            $(function() {
                var msg = "<?php echo $message; ?>"
                setTimeout(function() {
                    $.bootstrapGrowl(msg, {
                        type: 'success',
                        width: 'auto',
                        allow_dismiss: true
                    });
                }, 1000);
            });
        </script>
<?php
    }
}
?>


<?php
if (isset($openModal)) {
    if ($openModal == 1) {


?>
        <script type="text/javascript">
            $(function() {
                $("#openModal").click();
            });
        </script>
    <?php
    }
}
if (isset($openUpdateModal) && $openUpdateModal) {
    ?>
    <script type="text/javascript">
        $(function() {
            $('#updateModal').modal('show');
        });
    </script>
<?php
}
if (isset($doctorToBeAssigned) && $doctorToBeAssigned) {
?>
    <script type="text/javascript">
        $(function() {
            $('#assignPatientModal').modal('show');
        });
    </script>
<?php
}
if (isset($openAddSessionModal) && $openAddSessionModal) {
?>
    <script type="text/javascript">
        $(function() {
            $('#addSessionModal').modal('show');
        });
    </script>
<?php
}
if (isset($openAddPrescriptionModal) && $openAddPrescriptionModal) {
?>
    <script type="text/javascript">
        $(function() {
            $('#addPrescriptionModal').modal('show');
        });
    </script>
<?php
}
if (isset($openUpdateEmployeeModal) && $openUpdateEmployeeModal) {
?>
    <script type="text/javascript">
        $(function() {
            $('#updateEmployeeModal').modal('show');
        });
    </script>
<?php
}
if (isset($openStockAddModal) && $openStockAddModal) {
?>
    <script type="text/javascript">
        $(function() {
            $('#AddStockModal').modal('show');
        });
    </script>
<?php
}
if (isset($openUpdateStockModal) && $openUpdateStockModal) {
?>
    <script type="text/javascript">
        $(function() {
            $('#updateStockModal').modal('show');
        });
    </script>
<?php
}
if (isset($openDeleteEmployeeConfirmation) && $openDeleteEmployeeConfirmation) {
?>
    <script type="text/javascript">
        $(function() {
            $('#deleteEmployeeConfirmation').modal('show');
        });
    </script>
<?php
}
if (isset($openSendRequestConfirmationModal) && $openSendRequestConfirmationModal) {
?>
    <script type="text/javascript">
        $(function() {
            $('#sendRequestConfirmationModal').modal('show');
        });
    </script>
<?php
}

?>






</body>


</html>