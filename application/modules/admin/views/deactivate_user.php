<div class="container">
  <h1><?php echo lang('deactivate_heading');?></h1>
  <p><?php echo sprintf(lang('deactivate_subheading'), $user->username);?></p>

  <?php echo form_open("/admin/deactivate/".$user->id);?>

    <p>
      <?php echo lang('deactivate_confirm_y_label', 'confirm');?>
      <input type="radio" name="confirm" value="yes" checked="checked" />
      <?php echo lang('deactivate_confirm_n_label', 'confirm');?>
      <input type="radio" name="confirm" value="no" />
    </p>

    <?php echo form_hidden($csrf); ?>
    <?php echo form_hidden(array('id'=>$user->id)); ?>

    <p>
      <button class="btn btn-primary">Submit</button>
    </p>

  <?php echo form_close();?>
</div>