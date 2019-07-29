
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Export Data</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Export Data</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <?php if(!empty($this->session->userdata('error'))) { ?>
            <div class="alert alert-danger"><?php echo $this->session->userdata('error'); ?></div>
        <?php } ?>

        <?php if(!empty($this->session->userdata('success'))) { ?>
            <div class="alert alert-success"><?php echo $this->session->userdata('success'); ?></div>
        <?php } ?>

        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tablename">Select Table</label>
                                <select name="tablename" id="tablename" class="form-control">
                                    <option value="-1"> --- Select Table --- </option>
                                    <?php foreach($tables as $table) {
                                        $name = ucwords(str_replace('_', ' ',  $table));
                                    ?>
                                    <option value="<?php echo $table;?>"> <?php echo $name;?> </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="view_data" class="btn btn-info" id="view-data">View Data</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Data</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table id="table-data" class="table table-bordered table-hover">
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <form id="delete-data" action="/admin/delete-table-data" method="POST"></form>

    <!-- /.content -->
<script type="text/javascript">
$('#view-data').on('click', function() {
    var view_data_button = $(this);
    var table_name = $('select[name="tablename"]').find(':selected').val();
    if(table_name != 0) {
        view_data_button.button('loading');
        $.ajax({
            url: "/admin/table-data",
            type: "GET",
            data: {"table" : table_name},
            dataType: "json",
            success: function(data) {
                if(data.status == 'success') {
                    render_table_data(data.table_data, data.table_fields);
                    view_data_button.button('reset');
                }
            },
            error: function(e) {
            }
        });
    }
});

function render_table_data(table_data, table_fields) {
    var columns = [];
    $.each(table_fields, function(index, value) {
        var data = {data: value.toLowerCase().replace(/\s/g, '_'), title: value};
        columns.push(data);
    });

    if($.fn.DataTable.isDataTable('#table-data')) {
        $('#table-data').DataTable().destroy();
    }
    $('#table-data thead').empty();
    $('#table-data tbody').empty();

    var dataTable = $('#table-data').DataTable({
        destroy: true,
        pageLength: 50,
        data: table_data,
        columns: columns,
        'dom': 'Bfrtip',
        'columnDefs': [{
            'targets': 0,
            'checkboxes': {
               'selectRow': true
            },
        }],
        'select': {
            'style': 'multi',
        },
        'order': [[1, 'asc']],
        'buttons': [
            { 
                text: 'Delete',
                action: function() {
                    var form = $('#delete-data');
                    var rows_selected = dataTable.column(0).checkboxes.selected();

                    // Iterate over all selected checkboxes
                    $.each(rows_selected, function(index, rowId) {
                        $(form).append(
                            $('<input>')
                                .attr('type', 'hidden')
                                .attr('name', 'id[]')
                                .val(rowId)
                        );
                    });
                    $(form).append(
                        $('<input>')
                            .attr('type', 'hidden')
                            .attr('name', 'table')
                            .val($('select[name="tablename"]').find(':selected').val())
                    );
                    $.ajax({  
                        type: "POST",  
                        url: $(form).attr('action'),
                        data: $(form).serialize(),
                        dataType: "json",
                        success: function(data) {  
                            if(data.status == 'success') {
                                $('#view-data').trigger('click');
                            }
                        }  
                    }); 
                }
            },
            { extend: 'csv', text: 'Download as CSV' }
        ]
    });
}

</script>