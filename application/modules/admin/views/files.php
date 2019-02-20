

<section class="content-header">
    <h1> User Management</h1>
    <ol class="breadcrumb">
        <li><a href="/admin/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#" class="active">User Management</a></li>
    </ol>
</section>
    
<section class="content">

	<?php if(!empty($this->session->userdata('error'))) { ?>
        <div class="alert alert-danger"><?php echo $this->session->userdata('error'); ?></div>
    <?php } ?>


		<?php if(!empty($this->session->userdata('success'))) { ?>
        <div class="alert alert-success"><?php echo $this->session->userdata('success'); ?></div>
    <?php } ?>

        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">List of users</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="tracking-info" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
																		<th>Groups</th>
																		<th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($users as $user) { ?>
                                <tr>
                                    <td><?php echo $user->id; ?></td>
                                    <td><?php echo $user->first_name; ?></td>
                                    <td><?php echo $user->last_name; ?></td>
                                    <td><?php echo $user->email; ?></td>
																		<td><?php foreach ($user->groups as $group):?>
																				<a class="btn-xs bg-purple" href="/admin/edit_group/<?php echo $group->id; ?>"><?php echo $group->name;?></a>
																				<br />
																				<?php endforeach?>
																		</td>
																		<td><?php if($user->active) { ?>
																			<a class="btn-xs bg-purple" href="/admin/deactivate/<?php echo $user->id; ?>"> Active</a>
																		<?php } else { ?>
																			<a class="btn-xs bg-purple" href="/admin/activate/<?php echo $user->id; ?>"> InActive</a>
																		<?php } ?></td>
                                    <td>
																			<a class="btn-xs bg-purple" href="/admin/edit_user/<?php echo $user->id; ?>"> Edit</a>
																		</td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
                </div>
        </div>
				<br>
				<p>
					<a class="btn btn-primary" href="/admin/create_user"><i class="fa fa-plus"></i> Create User</a> <a class="btn btn-primary" href="/admin/create_group"><i class="fa fa-plus"></i> Create Group</a>
				</p>
</section>
<script>
$(function () {
    $('#tracking-info').DataTable();
});
</script>
