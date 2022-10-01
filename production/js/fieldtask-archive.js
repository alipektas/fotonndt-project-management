$(function() {

    //Veriler Sayfa Yüklendiği Gibi Çekiliyor

    var isno = $('.getting').val();





    $("#listele").load("fieldtask-welding-table-archive.php?isno=" + isno);



    $("#duzenleme-islemi").click(function() {


        $("#listele").fadeOut(500);
        $("#kayit-duzenle").fadeIn(500);


    });


    $("#geridon").click(function() {

        $("#malzeme-to-kaynak-ekle").hide();
        $("#malzeme-ekleme-alani").hide();
        $("#geridon").hide();
        $("#kayit-ekle").hide();
        $("#malzeme-listele").hide();
        $("#kaynak-guncelleme-alani").hide();
        $("#listele").load("fieldtask-welding-table-archive.php?isno=" + isno);
        $("#listele").fadeIn(500);
        $("#yeni-ekle").fadeIn(300);

    });




    $("body").on("click", ".kaynakdetay", function() {

        var fieldtask_welding_id = $(this).attr("id");

        $.ajax({

            type: "post",
            url: "duzenle.php",
            data: { 'fieldtask_welding_id': fieldtask_welding_id},
            success: function(kaynakdetaycevap) {

                $("#listele").hide();
                $("#yeni-ekle").hide();
                $("#geridon").fadeIn(200);
                $("#malzeme-to-kaynak-ekle").fadeIn(200);
                $("#malzeme-ekleme-alani").fadeIn(200);
                $("#kaynak-guncelleme-alani-acma").fadeIn(200);
                var obj = JSON.parse(kaynakdetaycevap);
                document.getElementById('kaynak-no').innerHTML = obj.fieldtask_welding_no;
                document.getElementById('kaynak-testmetodu').innerHTML = obj.fieldtask_welding_method;
                document.getElementById('kaynak-cap').innerHTML = obj.fieldtask_welding_size;
                document.getElementById('kaynak-metraj').innerHTML = obj.fieldtask_welding_length;
                document.getElementById('kaynak-kaynakci').innerHTML = obj.fieldtask_welding_welderno;
                $("#kaynak-guncelleme-alani-acma").val(obj.fieldtask_welding_id);
                $("#kaynak-detay").fadeIn(200);
               $("#weldingno").val(obj.fieldtask_welding_id);
                $("#malzeme-ekleme-alani").fadeIn(200);
                $("#malzeme-to-kaynak-ekle").fadeIn(200);
                $("#malzeme-listele").load("fieldtask-material-table-archive.php?kaynakno="+obj.fieldtask_welding_id);
                $("#malzeme-listele").fadeIn(200);
            }
        })



    });









});