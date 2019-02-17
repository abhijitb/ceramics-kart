
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Import Data
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Import</li>
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

		<div class="box-body table-responsive no-padding">
            <form method="post" id="import_csv" enctype="multipart/form-data" action="/admin/import">
                <div class="form-group">
                    <div class="control-label col-md-3 col-sm-3 col-xs-12">
                        <label for="middle-name" class="control-label pull-right">Select CSV File</label>
                    </div>
                    <div class="control-label col-md-3 col-sm-3 col-xs-12">
                        <label class="btn btn-primary btn-upload" for="inputFile" title="Upload CSV file">
                            <input name="csv_file" type="file" class="sr-only" id="inputFile" name="file" accept=".csv">
                            <span class="docs-tooltip" data-toggle="tooltip" title="Upload CSV file">
                            <span class="fa fa-upload"></span>
                            </span>
                        </label>
                    </div>
                    <div class="control-label col-md-6 col-sm-6 col-xs-12">
                        <button type="submit" name="import_csv" class="btn btn-info" id="import_csv_btn">Import CSV</button>
                    </div>
                </div>      
            </form>
		</div>
	</section>
    <!-- /.content -->
  