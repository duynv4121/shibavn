<?php  
    include('top.php');
    include('modals.php');
    $getId = $_GET['id'];
    // loadModalInShippingMark();
?>

<div class="container-fluid">
   <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
      <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
         class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
   </div> -->
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

         <!-- <div class="col-xs-3 mb-3">
            <a href="create.php" class="btn btn-success ">
               <i class="fas fa-plus"></i> Tạo đơn
            </a>
         </div> -->
      </div>
      
   </form>
   <div class="row">

      <div class="col-md-12">
         <h3 style="text-align:center;">Danh sách kiện nhỏ trong lô (SEA) (<?php echo $getId; ?>)</h3>
         <table id="example2" class="table table-hover table-bordered table-striped" data-page-length='100'  >
            <thead style="color:blue">
               <tr>
                 <!--  <th style="text-align: center;color:#00a5e4">STT</th> -->
                  <th style="text-align: center;color:#00a5e4">Date</th>
                  <th style="text-align: center;color:#00a5e4">ID</th>
                 <!--  <th style="text-align: center;color:#00a5e4">Người gửi</th>
                  <th style="text-align: center;color:#00a5e4">Người nhận</th> -->
                  <th style="text-align: center;color:#00a5e4">Cân nặng</th>
                  <th style="text-align: center;color:#00a5e4">Loại hàng</th>
                  <th style="text-align: center;color:#00a5e4">Trạng thái</th>
                  <th></th>
               </tr>
            </thead>
            <tbody>
               <?php
              
               $data = mysql_query("SELECT * FROM ns_listhoadon_sea WHERE id_package = '$getId'");
               
               while($item = mysql_fetch_array($data))
               {  
                  $listcatalog = mysql_query("SELECT * FROM ns_mapcatalog_sea WHERE id_bill = '".$item['id']."'");
                  $arr = [];
                  $str_type = "";
                  while ($temp = mysql_fetch_array($listcatalog)) {
                    $type = mysql_fetch_assoc(mysql_query("SELECT * FROM ns_catalog WHERE id = '".$temp['id_catalog']."'"));
                    array_push($arr, $type['type']);
                  }
                  $str_type = join(',',$arr);

                  $package = mysql_fetch_assoc(mysql_query("SELECT * FROM ns_package_sea WHERE id='".$item['id_package']."'"));
                  // $sName = mysql_fetch_assoc(mysql_query("SELECT * FROM ns_nguoigui WHERE id ='".$package['id_nguoigui']."'"));
                  // $rName = mysql_fetch_assoc(mysql_query("SELECT * FROM ns_nguoinhan WHERE id ='".$package['id_nguoinhan']."'"));
                  $count = mysql_num_rows(mysql_query("SELECT id FROM ns_listhoadon_sea WHERE id_package = '".$package['id']."'"));
                  // <td style="text-align: center; color:black">'.$sName['name'].'</td>
                  // <td style="text-align: center; color:black">'.$rName['name'].'</td>
                  echo '<tr>
                  <td style="text-align: center; color:black">'.$item['date'].'</td>
                  <td style="text-align: center; color:black">'.$item['id'].'</td>
                  
                  <td style="text-align: center; color:black">'.$item['cannang'].'</td>
                  <td style="text-align: center; color:black">'.$str_type.'</td>
                  <td style="text-align: center; color:black">'; 
                  if ($item['status'] == 1) {
                     echo 'checking';
                  }elseif ($item['status'] == 2) {
                      echo 'received';
                  }elseif ($item['status'] == 3) {
                      echo 'exported';
                  }elseif ($item['status'] == 4) {
                      echo 'imported';
                  }elseif ($item['status'] == 5) {
                      echo 'delivering';
                  }
                  elseif ($item['status'] == 6) {
                      echo 'delivered';
                  }

                  echo '</td>
                  <td>
                     <a href="edit_sub_package_for_find_sea.php?id='.$item['id'].'" type="button" class="btn btn-warning"><i class="far fa-edit"></i></a>
                  </td>';
               }
               ?>

            </tbody>
         </table>
      </div>
   </div>
</div>

<?php  
    include('footer.php');
?>

<script type="text/javascript">
   // $('#modalInShippingmark').on('show.bs.modal', function (event) {
   //     var button = $(event.relatedTarget); 
   //     var recipient = button.data('whatever');
   //     var modal = $(this);
   //     $('#exampleModalLabelFake').val(recipient);
   //     modal.find('.modal-body input').val(recipient)
   //     $('#myFramedsm').attr('src', '../inbill/inshippingmark/insm.php?id=' + recipient );

   // })
  //  $(document).ready(function () {
  //     var groupColumn = 7;
  //     var table = $('#example2').DataTable({
  //         scrollX: true,
  //         columnDefs: [{ visible: false, targets: groupColumn }],
  //         order: [[groupColumn, 'asc']],
  //         displayLength: 100,
  //         drawCallback: function (settings) {
  //             var api = this.api();
  //             var rows = api.rows({ page: 'current' }).nodes();
  //             var last = null;
   
  //             api
  //                 .column(groupColumn, { page: 'current' })
  //                 .data()
  //                 .each(function (group, i) {
  //                     if (last !== group) {
  //                         $(rows)
  //                             .eq(i)
  //                             .before('<tr style="background-color: #b8d0de;" class="group"><td colspan="7"><b>' + group + '</b> </td></tr>');
   
  //                         last = group;
  //                     }
  //                 });
  //         },
  //     });
  // });
   $('#example2').DataTable({
      scrollX: true,
      "aaSorting": []
   })
</script>