
<section class="content-header">
    <h1>Reports</h1>
    <ol class="breadcrumb">
        <li><a href="/admin/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#" class="active">Report</a></li>
    </ol>
</section>
    
<section class="content">
        <div class="row">
            <div class="col-xs-12">

            <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab">Tracker</a></li>
              <li><a href="#tab_2" data-toggle="tab">SMS</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    <div class="box-header">
                        <h3 class="box-title">Tracking info</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="tracking-info" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Mobile Number</th>
                                    <th>IP Address</th>
                                    <th>User Agent</th>
                                    <th>TimeStamp</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($tracking_info as $list_item) { ?>
                                <tr>
                                    <td><?php echo $list_item->id; ?></td>
                                    <td><?php echo $list_item->first_name; ?></td>
                                    <td><?php echo $list_item->last_name; ?></td>
                                    <td><?php echo $list_item->mobile_number; ?></td>
                                    <td><?php echo $list_item->ip; ?></td>
                                    <td><?php echo $list_item->user_agent; ?></td>
                                    <td><?php echo date('d-m-Y h:i:s a', $list_item->created_date); ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
                    <div class="box-header">
                        <h3 class="box-title">SMS Reports</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="sms-report" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Message Id</th>
                                    <th>Message</th>
                                    <th>Mobile Number</th>
                                    <th>Code</th>
                                    <th>Status</th>
                                    <th>Sent On</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($sms_data as $list_item) { ?>
                                <tr>
                                    <td><?php echo $list_item->id; ?></td>
                                    <td><?php echo $list_item->message_id; ?></td>
                                    <td><?php echo $list_item->message; ?></td>
                                    <td><?php echo $list_item->mobile_number; ?></td>
                                    <td><?php echo $list_item->code; ?></td>
                                    <td><?php echo $list_item->status; ?></td>
                                    <td><?php echo date('d-m-Y h:i:s a', $list_item->created_date); ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.tab-content -->
          </div>
        </div>
    </div>
    <br>
</section>
<script>
$(function () {
    $('#tracking-info').DataTable({
        'dom': 'Bfrtip',
        'buttons': [
            { extend: 'csv', text: 'Download as CSV' }
        ]
    });
    $('#sms-report').DataTable({});
});
</script>