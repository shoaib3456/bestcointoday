      <!-- Default box -->
      
      <!-- /.card -->

      </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
     
    </div>
    <strong>
  </footer>

  
<!-- ./wrapper -->

<!-- jQuery -->
<script src="vendor/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="vendor/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- bs-custom-file-input -->
<script src="vendor/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- AdminLTE App -->
<script src="vendor/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="vendor/dist/js/demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>


<script>
  $(function () {
    bsCustomFileInput.init();
  });


  $(document).ready(function() {
  $('#Description').summernote(
    {
        placeholder: 'Describe your coin here. What is the goal, plans, why is this coin unique?',
        tabsize: 2,
        height: 120,
        toolbar: [
          ['style', ['']],
          ['font', ['bold', 'underline', 'italic']],
          ['color', ['']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['']],
          ['insert', ['link', '', '']],
          ['view', ['', '', '']]
        ]
      }
  );
});
$(document).ready(function() {
  $('#information').summernote(
    {
        placeholder: '',
        tabsize: 2,
        height: 120,
        toolbar: [
          ['style', ['']],
          ['font', ['bold', 'underline', 'italic']],
          ['color', ['']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['']],
          ['insert', ['link', '', '']],
          ['view', ['', '', '']]
        ]
      }
  );
});

</script>

</body></html>