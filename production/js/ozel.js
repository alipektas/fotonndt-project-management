$(function() {

    //Veriler Sayfa Yüklendiği Gibi Çekiliyor

    var isno = $('.getting').val();





    $("#listele").load("fieldtask-welding-table.php?isno=" + isno);


    $("#yeni-ekle").click(function() {


        $("#geridon").fadeIn(300);
        $("#listele").fadeOut(300);
        $("#yeni-ekle").fadeOut(300);
        $("#kayit-ekle").fadeIn(300);


    });


    $("#duzenleme-islemi").click(function() {


        $("#listele").fadeOut(500);
        $("#kayit-duzenle").fadeIn(500);


    });

    //KAYNAK EKLEME BAŞLANGIÇ
    $("#kaynak-gonder").click(function() {


        if (
            $("#fieldtask_welding_no").val() == "" ||
            $("#fieldtask_welding_size").val() == "" ||
            $("#fieldtask_welding_method").val() == "") {


            $("#bos-alan").fadeIn(1000).delay(2000).fadeOut(500);

            event.preventDefault();





        } else {

            $.ajax({




                type: "post",
                url: "fieldtask-onduty-islem.php",
                data: $("#kaynakno-ekle").serialize(),

                success: function(malzemecevap) {

                    
                    $("#basari-islem").fadeIn(500).text("Kaynak kaydedildi.").delay(2000).fadeOut(500);


                    $("#fieldtask_welding_no").val("");
                    $("#fieldtask_welding_size").val(null).trigger('change');
                    //$("#fieldtask_welding_method").val("");
                    $("#fieldtask_welding_length").val("");
                    $("#fieldtask_welding_welderno").val("");
                    $("#kayit-ekle").hide();
                    var obj = JSON.parse(malzemecevap);
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

                }
            })

        }

    });
// KAYNAK EKLEME SON

// KAYNAK GÜNCELLE BAŞLANGIÇ
$("#kaynak-guncelleme-butonu").click(function() {


    if (
        $("#fieldtask_welding_no2").val() == "" ||
        $("#fieldtask_welding_size2").val() == "" ||
        $("#fieldtask_welding_method2").val() == "") {


        $("#bos-alan").fadeIn(1000).delay(2000).fadeOut(500);

        event.preventDefault();





    } else {

        $.ajax({




            type: "post",
            url: "fieldtask-welding-update.php",
            data: $("#kaynak-guncelleme-formu").serialize(),

            success: function(kaynakguncelcevap) {

                
                $("#basari-islem").fadeIn(500).text("Kaynak kaydedildi.").delay(2000).fadeOut(500);


                $("#fieldtask_welding_no_gun").val("");
                $("#fieldtask_welding_size_gun").val(null).trigger('change');
                //$("#fieldtask_welding_method_gun").val("");
                $("#fieldtask_welding_length_gun").val("");
                $("#fieldtask_welding_welderno_gun").val("");
                $("#kayit-ekle").hide();
                $("#kaynak-guncelleme-alani").hide();
                var obj = JSON.parse(kaynakguncelcevap);
                document.getElementById('kaynak-no').innerHTML = obj.fieldtask_welding_no3;
                document.getElementById('kaynak-testmetodu').innerHTML = obj.fieldtask_welding_method3;
                document.getElementById('kaynak-cap').innerHTML = obj.fieldtask_welding_size3;
                document.getElementById('kaynak-metraj').innerHTML = obj.fieldtask_welding_length3;
                document.getElementById('kaynak-kaynakci').innerHTML = obj.fieldtask_welding_welderno3;
                $("#kaynak-guncelleme-alani-acma").val(obj.fieldtask_welding_id3);
                $("#kaynak-guncelleme-alani-acma").fadeIn(200);
                $("#kaynak-detay").fadeIn(200);

                $("#malzeme-listele").load("fieldtask-material-table.php?kaynakno="+obj.fieldtask_welding_id3);
                $("#malzeme-listele").fadeIn(200);
                $("#malzeme-ekleme-alani").fadeIn(200);
                $("#malzeme-to-kaynak-ekle").fadeIn(200);

            }
        })

    }

});
//KAYNAK GÜNCELLE SON


    $("#kaynak-guncelleme-vazgec").click(function() {

        
        $("#kaynak-guncelleme-alani").hide();
        $("#malzeme-ekleme-alani").fadeIn(200);
        $("#malzeme-listele").fadeIn(200);
        $("#kaynak-guncelleme-alani-acma").fadeIn(200);


    });


    $("#malzeme-guncelleme-vazgec").click(function() {

        $("#malzeme-guncelleme").hide();
        $("#malzeme-ekleme-alani").fadeIn(200);
        $("#malzeme-listele").fadeIn(200);

    });

    $("#geridon").click(function() {

        $("#malzeme-to-kaynak-ekle").hide();
        $("#malzeme-ekleme-alani").hide();
        $("#geridon").hide();
        $("#kayit-ekle").hide();
        $("#malzeme-listele").hide();
        $("#kaynak-guncelleme-alani").hide();
        $("#listele").load("fieldtask-welding-table.php?isno=" + isno);
        $("#listele").fadeIn(500);
        $("#yeni-ekle").fadeIn(300);

    });

    $("#malzeme-to-kaynak-ekle").click(function() {

        $("#malzeme-to-kaynak-ekle").hide();
        $("#malzeme-ekleme-alani").hide();
        $("#malzeme-listele").hide();
        
        $("#kayit-ekle").fadeIn(200);

    });

    $("body").on("click", ".malzemesil", function() {

        var welding_material_id = $(this).attr("id");
        var kn = $(this).attr("deger");
        var parent = $(this).parent("td").parent("tr");

        //alert(bilgi_id);

        if (confirm(  kn + ' isimli malzeme silinecek. Silmek istediğinizden emin misiniz?')) {

            $.ajax({

                type: "post",
                url: "fieldtask-material-delete.php",
                data: { 'welding_material_id': welding_material_id },
                success: function(silcevap) {

                    //$("#listele").load("veriler.php");

                    parent.fadeOut('slow');

                }

            })

        }

    });

    $("body").on("click", ".kaynaksil", function() {

        var fieldtask_welding_id = $(this).attr("id");
        var kn = $(this).attr("deger");
        var parent = $(this).parent("td").parent("tr");

        //alert(bilgi_id);

        if (confirm(  kn + ' isimli kaynak silinecek. Silmek istediğinizden emin misiniz?')) {

            $.ajax({

                type: "post",
                url: "fieldtask-welding-delete.php",
                data: { 'fieldtask_welding_id': fieldtask_welding_id },
                success: function(silcevap) {

                    //$("#listele").load("veriler.php");

                    parent.fadeOut('slow');

                }

            })

        }

    });

// KAYNAK BİLGİ TABLOSU, GÜNCELLEME TUŞU BAŞLANGIÇ
$("#kaynak-guncelleme-alani-acma").click(function()  {
    var fieldtask_welding_id = $(this).attr("value");
    //$("#malzeme-ekleme-alani").hide();
    $("#malzeme-listele").hide();
    $("#malzeme-ekleme-alani").hide();
    $("#kaynak-guncelleme-alani-acma").hide();

    $.ajax({
        type: "post",
        url: "fieldtask-welding-fill.php",
        data: {'fieldtask_welding_id': fieldtask_welding_id},
        success: function(duzenlekaynakdoldurcevap) {
            //$("#ad_duzenle").val(duzenlecevap);
            var obj = JSON.parse(duzenlekaynakdoldurcevap);
            var $fillmethod = $("#fieldtask_welding_method_gun").select2();
            var $fillsize = $("#fieldtask_welding_size_gun").select2();
                $fillmethod.val(obj.fieldtask_welding_method2).trigger("change");
                $fillsize.val(obj.fieldtask_welding_size2).trigger("change");
            $("#fieldtask_welding_no_gun").val(obj.fieldtask_welding_no2);
            $("#fieldtask_welding_length_gun").val(obj.fieldtask_welding_length2);
            $("#fieldtask_welding_welderno_gun").val(obj.fieldtask_welding_welderno2);
            $("#fieldtask_welding_id_gun").val(obj.fieldtask_welding_id2);
            $("#kaynak-guncelleme-alani").fadeIn(200);
            

        }
    })
});
// KAYNAK BİLGİ TABLOSU, GÜNCELLEME TUŞU SONU


// MALZEME TABLOSU, SAYI GÜNCELLEME TUŞU BAŞLANGIÇ
$("body").on("click", ".malzemegunbut", function() {
    var welding_material_id = $(this).attr("id");
    $("#malzeme-ekleme-alani").hide();
    $("#malzeme-listele").hide();
    $("#malzeme-guncelleme").fadeIn(200);

    $.ajax({
        type: "post",
        url: "fieldtask-onduty-material-fill.php",
        data: {'welding_material_id': welding_material_id},
        success: function(duzenledoldurcevap) {
            //$("#ad_duzenle").val(duzenlecevap);
            var obj = JSON.parse(duzenledoldurcevap);
            var $example = $("#welding_material_sid-guncel").select2();
                $example.val(obj.welding_material_sid).trigger("change");
            $("#welding_material_quantity-guncel").val(obj.welding_material_quantity);
            $("#welding_material_id-guncel").val(welding_material_id);



        }
    })
});
// MALZEME TABLOSU, SAYI GÜNCELLEME TUŞU SONU


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
                $("#malzeme-listele").load("fieldtask-material-table.php?kaynakno="+obj.fieldtask_welding_id);
                $("#malzeme-listele").fadeIn(200);
            }
        })



    });

    //malzeme ekleme yeni
    $("#malzeme-gonder").click(function() {
        if (
            
            $("#welding_material_sid").val() == "" ||
            $("#welding_material_quantity").val() == "") {


            $("#bos-alan").fadeIn(1000).delay(2000).fadeOut(500);

            event.preventDefault();





        }
        else{
        $.ajax({

            type: "post",
            url: "fieldtask-onduty-malzeme.php",
            data: $("#malzeme-ekle").serialize(),

            success: function(cevapd) {

                $("#basari-islem-duzenle").fadeIn(500).text(cevapd).delay(2000).fadeOut(500);
                $("#malzeme-listele").load("fieldtask-material-table.php?kaynakno=" + cevapd);
                $("#malzeme-listele").fadeIn(200);
                $("#welding_material_quantity").val("");
                $("#welding_material_sid").val(null).trigger('change');
                

            }

        })
    }
    });

     //Malzeme Guncelleme İşlemi
    $("#malzeme-guncelleme-butonu").click(function() {

        $.ajax({

            type: "post",
            url: "fieldtask-onduty-material-update.php",
            data: $("#malzeme-guncelleme-formu").serialize(),

            success: function(cevapd) {

                $("#malzeme-guncelleme").hide();
                $("#basari-islem-duzenle").fadeIn(500).text(cevapd).delay(2000).fadeOut(500);
                $("#malzeme-listele").load("fieldtask-material-table.php?kaynakno=" + cevapd);
                $("#malzeme-listele").fadeIn(200);

            }

        })
    });

    //Guncelleme İşlemi


    $("#mlz-guncelle").click(function() {

        $.ajax({

            type: "post",
            url: "fieldtask-onduty-malzeme.php",
            data: $("#malzeme-guncelle").serialize(),

            success: function(cevapd) {

                $("#malzeme-ekle").hide();
                $("#listele").fadeIn(500);
                $("#yeni-ekle").fadeIn(500);
                $("#basari-islem-duzenle").fadeIn(500).text(cevapd).delay(2000).fadeOut(500);
                $("#listele").load("fieldtask-welding-table.php?isno=" + isno);

            }

        })
    });


    $("#geridonduzenle").click(function() {

        $("#malzeme-ekle").hide();
        $("#listele").fadeIn(500);
        $("#yeni-ekle").fadeIn(500);



    });

    // lokasyon bulma scripti başlangıç


    $("#gorev-bitirme").click(function() {


        if (
            $("#latitude").val() == "" ||
            $("#longitude").val() == ""
        ) {


            $("#bos-alan-konum").fadeIn(500).delay(2000).fadeOut(500);

            event.preventDefault();

        } else {}

    });

    $("#konum-sil").click(function() {
            $("#latitude").val("");
            $("#longitude").val("");
        }

    );

    $(".lokasyonvazgec").click(function() {
        $("#latitude").val("");
        $("#longitude").val("");
    }

);



    // butonu seçelim
    let button = document.getElementById('konum-bul');

    // butona tıklandığında bunu yakalayalım
    button.onclick = function() {

        // tarayıcının destekleyip desteklemediğine bakalım
        if (navigator.geolocation) {

            // Eğer kullanıcı izin vermiş ise showPosition fonksiyonu çalışacak
            navigator.geolocation.getCurrentPosition(showPosition);

        } else {
            x.innerHTML = "Geolocation tarayıcınızda desteklenmiyor.";
        }

    };

    // position ile gönderilen datayı alıyoruz
    function showPosition(position) {

        /* sonuçları göstereceğimiz etiketi seçtik
    document.getElementById('latitude').value=position.coords.latitude;
    document.getElementById('longitude').position.coords.longitude;
            
       sonuçları etiketimizin içinde gösteriyoruz     */

        $("#latitude").val(position.coords.latitude);
        $("#longitude").val(position.coords.longitude);
        $("#aktif-etme").fadeIn(500);

    }



    // lokasyon bulma scripti bitiş 







});