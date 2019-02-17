
<section class="content-header">
    <h1> User List</h1>
    <ol class="breadcrumb">
        <li><a href="/admin/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#" class="active">Send SMS</a></li>
    </ol>
</section>
    
<section class="content">

    <?php if(!empty($this->session->userdata('success'))) { ?>
        <div class="alert alert-success"><?php echo $this->session->userdata('success'); ?></div>
    <?php } ?>

    <form name="user_list" action="/admin/sms" method="post">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Select the users to send SMS to</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <p>
                            <input type="checkbox" class="check" id="checkAll"> Check All
                        </p>
                        
                        <table id="sms-user-list" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Mobile Number</th>
                                    <th>Amount</th>
                                    <th>Unique Code</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($lists as $list_item) { ?>
                                <tr>
                                    <td><input class="check" type="checkbox" name="user_ids[]" value="<?php echo $list_item->id; ?>"></td>
                                    <td><?php echo $list_item->first_name; ?></td>
                                    <td><?php echo $list_item->last_name; ?></td>
                                    <td><?php echo $list_item->mobile_number; ?></td>
                                    <td><?php echo $list_item->amount; ?></td>
                                    <td><?php echo $list_item->code; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
                <p>
                    <button class="btn btn-primary pull-right">Send SMS</button>
                </p>
            </div>
        </div>
    </form>
</section>
<script>
$("#checkAll").click(function () {
    $(".check").prop('checked', $(this).prop('checked'));
});

$(function () {
    $('#sms-user-list').DataTable();
})
</script>