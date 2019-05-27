<br>
<div class="col-md-12">
    <?php if(!empty($this->session->userdata('error'))) { ?>
        <div class="alert alert-danger"><?php echo $this->session->userdata('error'); ?></div>
    <?php } ?>

    <?php if(!empty($this->session->userdata('message'))) { ?>
        <div class="alert alert-success"><?php echo $this->session->userdata('message'); ?></div>
    <?php } ?>
</div>