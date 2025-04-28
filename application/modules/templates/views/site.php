<?php require_once 'partials/css_files.php';?>

        <!-- ============================================================== -->
        <!-- Main wrapper - style you can find in pages.scss -->
        <!-- ============================================================== -->
<div id="main-wrapper">

<?php 

require_once 'partials/header.php';


if(!empty(get_flash('danger')) || !empty(get_flash('success'))){
require_once 'partials/alerts.php';

     
unset($_SESSION['danger']);
unset($_SESSION['success']);
        

}

$this->load->view($module . "/" . $view);

require_once 'partials/footer.php';



?>
	