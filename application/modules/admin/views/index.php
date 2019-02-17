<?php if(!empty($this->session->userdata('error'))) { ?>
    <div class="alert alert-danger"><?php echo $this->session->userdata('error'); ?></div>
<?php } ?>


    <?php if(!empty($this->session->userdata('success'))) { ?>
    <div class="alert alert-success"><?php echo $this->session->userdata('success'); ?></div>
<?php } ?>
