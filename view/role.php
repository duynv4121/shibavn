<?php 
  include('top.php');

  if (isset($_POST['btn_save'])) {
    $checkboxes = $_POST['sub'];
    $roleid = $_POST['roleid'];
    $uid = $_POST['userid'];
    deletesubrolelist($roleid, $uid);
    foreach ($checkboxes as $chk){
      updatesubrolelist($roleid, $uid, $chk);
    }
  }
?>

<div class="container-fluid">
   <form action="" method="POST">
      <div class="row">
         <!-- <div class="col-xs-3">
            <div class="input-group date mr-2">
               <div class="form-group ">
                  <input placeholder="Tháng" name="datefrom" type="text" class="form-control" id="datepicker1">
               </div>
            </div>
         </div>
         <div class="col-xs-3 mr-2">
            <button type="submit" name="btn_loc" class="btn btn-info"><i class="fas fa-filter"></i> Lọc</button>
         </div> -->
         <div class="col-md-12 mb-3">
            <h2 style="text-align:center;">Quản lý phân quyền</h2>
         </div>
      </div>
   </form>
   <div class="row">
        <div class="col-md-3">
          <form action="" method="post">
            <div class="form-group">
              <label>Danh sách user</label>
              <select required name="userid" id="user-dropdown" class="form-control">
                <?php 
                  
                  $users = getUserDropdownList();
                  
                  echo '<option>chọn user</option>';
                  while ($item = mysql_fetch_array($users)) {
                    echo '<option value="'.$item['id'].'">'.$item['username'].'</option>';
                  }
                  
                ?>
              </select>
            </div>
            <div class="form-group">
              <label>Danh sách role</label>
              <select required name="roleid" id="role-dropdown" class="form-control">
                <option></option>
              </select>
            </div>
            <div class="form-group">
              <h5><b>Danh sách chức năng</b></h5>
              <div class="checkbox">
                <?php 
                $subroles = getsubroles(); 
                while ($item = mysql_fetch_array($subroles)) {
                  echo '<label><input name="sub[ ]" value="'.$item['id'].'" type="checkbox" class="c">'.$item['subrole'].'</label><br>';
                }
                ?>
              </div>
            </div>
            <div class="form-group">
              <button type="submit" name="btn_save" class="btn btn-success">Save</button>
            </div>
          </form>
        </div>
      <div class="col-md-9">
         <table id="example2" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Chi nhánh</th>
                <th style="width: 50%;">Chức năng</th>
              </tr>
            </thead>
            <tbody>
              <?php 
                $users = getUsers();
                while ($item = mysql_fetch_array($users)) {
                  $rolename = getrolename($item['roleid']);
                  $namesubroles = getsubrolename($item['id'], $item['roleid']);
                  echo '<tr>
                  <td>'.$item['id'].'</td>
                  <td>'.$item['username'].'</td>
                  <td>'.$rolename.'</td><td>';
                  for ($i=0; $i < sizeof($namesubroles); $i++) { 
                    echo ''.$namesubroles[$i].'&nbsp;&nbsp;&nbsp;&nbsp;';
                  }
                  echo '</td></tr>';
                }
              ?>
              <!-- <td></td> -->

            </tbody>
            <tfoot>
              <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Chi nhánh</th>
                <th>Chức năng</th>
              </tr>
            </tfoot>
          </table>
      </div>
   </div>
</div>

<?php  
    include('footer.php');
?>

<script type="text/javascript">
   $('#example2').DataTable({
      scrollX: true,
      "aaSorting": []
   })

   $('#user-dropdown').on('change', function(){
    let userid = this.value;
    $.ajax({
      url: '../controller/ajax.php',
      type: 'POST',
      data: {
        userid: userid,
        action: 'filteruserrole'
      },
      cache: false,
      success: function(result){
        $("#role-dropdown").html(result);
        $("#role-dropdown").trigger('change');
      }
    })
  })

  $('#role-dropdown').on('change', function(){
    let userid = $("#user-dropdown option:selected").val();
    let roleid = this.value;
    $.ajax({
      url: '../controller/ajax.php',
      type: 'POST',
      data: {
        userid: userid,
        roleid: roleid,
        action: 'filterusersubrole'
      },
      cache: false,
      success: function(result){
       $('input:checkbox.c').each(function () {
        this.checked = false;
      });
       $('input:checkbox.c').each(function () {
        for (let i = 0; i < result.length; i++) {
          if (this.value === result[i]) {
            this.checked = true;
          }
        }
      });
     },
     dataType:"json"
   })
  })
</script>