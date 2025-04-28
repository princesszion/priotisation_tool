
        <div class="card shadow-sm">
            <div class="card-header text-black" >
                <h4><?php echo ucwords(str_replace('_',' ',$this->uri->segment(3)));?></h4>
            </div>
            <div class="card-body" style="overflow:auto;">
                <?= $form; ?>
            </div>
        </div>
