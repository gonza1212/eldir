$(document).ready(function(){
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
    $.ajax({
        type:'POST',
        url:'/getUser',
        data:'_token = <?php echo csrf_token() ?>',
        success:function(data) {
            $("#texto-actividad").text(data.actividadActual[0] + ":" + data.actividadActual[1]);
            $("#texto-revisitas").text(data.actividadActual[4]);
        }
    });
});
