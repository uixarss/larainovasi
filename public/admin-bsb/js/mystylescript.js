$(function(){

    $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
    });


    $(document).on('click', "#potensiSDA", function(){
        console.log("SDA Aktif");
        $("#SDA").show();
        $("#SDM").hide();
        $("#SDS").hide();
        $("#SDE").hide();
      });

    $(document).on('click', "#potensiSDM", function(){
        console.log("SDM Aktif");
        $("#SDA").hide();
        $("#SDM").show();
        $("#SDS").hide();
        $("#SDE").hide();
      });

    $(document).on('click', "#potensiSDS", function(){
        console.log("SDS Aktif");
        $("#SDA").hide();
        $("#SDM").hide();
        $("#SDS").show();
        $("#SDE").hide();
      });

    $(document).on('click', "#potensiSDE", function(){
        console.log("SDE Aktif");
        $("#SDA").hide();
        $("#SDM").hide();
        $("#SDS").hide();
        $("#SDE").show();
      });



});
