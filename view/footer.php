		</div>
	</div><!-- /.container-fluid -->
    </section>
	</div>
	
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong><a href="https://shibaexpress.vn">SHIBAEXPRESS.VN</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="gd/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="gd/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="gd/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="gd/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="gd/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="gd/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="gd/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="gd/plugins/moment/moment.min.js"></script>
<script src="gd/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="gd/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="gd/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="gd/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="gd/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="gd/dist/js/pages/dashboard.js"></script>

<script src="../vendor/datatables/jquery.dataTables.min.js"></script>
<script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="gd/plugins/select2/js/select2.full.min.js"></script>

</body>
</html>


<script type="text/javascript">
$(document).ready(function() {
    $('#example3').DataTable( {
		  "pageLength": 100
,
        responsive: {
            details: {
                type: 'column'
            }
        },
        columnDefs: [ {
            className: 'dtr-control',
            orderable: false,
        } ],
        order: [ 0, 'desc' ]
    } );
} );

$(document).ready(function() {
    $('#example5').DataTable( {
		
		  "pageLength": 100
,
 "bPaginate": false,
        "bFilter": false,
        "bInfo": false,
   
        columnDefs: [ {
            className: 'dtr-control',
            orderable: false,
            targets:   0
        } ],
        order: [ 1, 'desc' ]
    } );
} );


  $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

</script>

<script>
  $(function () {
    // Summernote
    $('#summernote').summernote()

    // CodeMirror
    CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
      mode: "htmlmixed",
      theme: "monokai"
    });
  })
  
  
  
  
</script>