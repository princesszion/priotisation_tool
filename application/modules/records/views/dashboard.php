<!-- Tab Content Start -->
<div class="container-fluid p-0">
    <div class="row no-gutters">
        <div class="col-12">
            <div class="embed-responsive embed-responsive-16by9" style="height: 100vh; margin-top:10px; margin-bottom:10px;">
                <iframe class="embed-responsive-item"
                    src="<?php 
                    $no_data =base_url().'error/error.html';
                    if($active_url!='#'){ echo $active_url;}else{ echo "$no_data"; } ?>"
                    style="border:0;" allowfullscreen>
                </iframe>
            </div>
        </div>
    </div>
</div>