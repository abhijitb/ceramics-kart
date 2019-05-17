
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Import Data</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Import Data</li>
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
                <?php if($show_parsed_data) { ?>
                    <div class="box box-danger">
                        <div class="box-header">
                            <h3 class="box-title">Parsed Fields</h3>
                        </div>
                        <div class="box-body table-responsive ">
                            <h4> Choose field mapping </h4>
                            <form method="post" id="import_csv" action="/admin/import">
                                <input type="hidden" name="type" value="save">
                                <input type="hidden" name="tablename" value="<?php echo $tablename; ?>">
                                <input type="hidden" name="csv_data_id" value="<?php echo $insert_id;?>">
                                <div class="form-group">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Imported File Fields</th>
                                                <th>Example</th>
                                                <th>Required Fields</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $counter = count($parsed_file_headers);
                                            for($i = 0; $i < $counter; $i++) { ?>
                                            <tr>
                                                <td>
                                                    <?php echo $parsed_file_headers[$i]; ?>
                                                </td>
                                                <td>
                                                    <?php echo $preview_data[$i]; ?>
                                                </td>
                                                <td>
                                                    <select name="<?php echo $parsed_file_headers[$i];?>">
                                                    <?php foreach($required_fields as $key => $field ) { ?>
                                                        <option value="<?php echo $field;?>" <?php if($parsed_file_headers[$i] == $field) echo "selected"; ?>><?php echo $field;?></option>
                                                    <?php } ?>
                                                        <option value="-1">Ignore</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="import_csv" class="btn btn-info" id="import_csv_btn">Import Data</button>
                                </div>      
                            </form>
                        </div>
                    </div>
                <?php } else {?>
                    <div class="box box-primary">
                        <div class="box-body">
                            <div class="col-md-4">
                                <form method="post" id="import_csv" enctype="multipart/form-data" action="/admin/import">
                                    <input type="hidden" name="type" value="parse">
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
                                        <label for="InputFile">Select File (.CSV File)</label>
                                        <input type="file" id="InputFile" name="csv_file" accept=".csv">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" name="import_csv" class="btn btn-info" id="import_csv_btn">Parse Data</button>
                                    </div>      
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
	</section>
    <!-- /.content -->
<script>
    $('#sms-group-list').DataTable({});
</script>