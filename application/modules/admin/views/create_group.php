

<div class="container">
      <h1>Create Group</h1>
      <p>Please enter the group information below.</p>

      <div id="infoMessage"></div>

      <form action="/admin/create_group" method="post" accept-charset="utf-8">

            <p>
                  <label for="group_name">Group Name:</label> <br />
                  <input type="text" name="group_name" value="" id="group_name"  />
            </p>

            <p>
                  <label for="description">Description:</label> <br />
                  <input type="text" name="description" value="" id="description"  />
            </p>

            <p><input class="btn btn-primary" type="submit" name="submit" value="Create Group"  /></p>

      </form>
</div>