<?php
session_start();

$yil =  $_SESSION["yil"];
$gün = $_SESSION["gün"];
$saat = $_SESSION["saat"];
$dakika = $_SESSION["dakika"];
$saniye = $_SESSION["saniye"];
$time =  $_SESSION["time"];
?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jq-3.6.0/jszip-2.5.0/dt-1.13.1/af-2.5.1/b-2.3.3/b-colvis-2.3.3/b-html5-2.3.3/b-print-2.3.3/cr-1.6.1/datatables.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/datetime/1.2.0/css/dataTables.dateTime.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" />

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jq-3.6.0/jszip-2.5.0/dt-1.13.1/af-2.5.1/b-2.3.3/b-colvis-2.3.3/b-html5-2.3.3/b-print-2.3.3/cr-1.6.1/datatables.min.js"></script>




    <style>
        #div1 {
            margin-left: 30px;
            margin-right: 30px;
        }

        #div2 {
            background-color: #393E46;
        }

        body {
            background-color: #EEEEEE;

        }

        #btn {
            background-color: #00ADB5;
            color: white;
        }

        .bg-custom-1 {
            background-color: #85144b;
        }

        .bg-custom-2 {
            background-image: linear-gradient(15deg, #13547a 0%, #80d0c7 100%);
        }
    </style>
</head>

<body>

    <nav id="div2" class="navbar navbar-expand" style="width:100%;">

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample02" aria-controls="navbarsExample02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExample02">
            <ul class="navbar-nav mr-auto">
                <li>
                    <img style="margin-left: 15px;" src="./img/icons8-monkey-50.png" alt="">
                </li>

                <li class="nav-item">
                    <a id="btn" class="btn mx-2 mt-2" href="#">Ana Sayfa</a>
                </li>
                <li class="nav-item">
                    <a id="btn" class="btn mt-2" href="/GIRISCIKIS/deneme.php">Veri Ekleme</a>
                </li>


                <div class="d-flex position-absolute top-0 end-0">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-list-4" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div style="margin-right: 25px;margin-top:7px;" class="collapse navbar-collapse" id="navbar-list-4">
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a style="color: #00ADB5;" class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" aria-haspopup="true" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="./img/icons8-user-55.png" width="40" height="40" class="rounded-circle">
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="profil.php">profil</a>

                                    <a class="dropdown-item" href="cıkıs.php">çıkış yap</a>
                                </div>
                            </li>
                        </ul>
                    </div>
            </ul>


    </nav>




    <div id="div1">
        <div class="d-flex">
            <table class="mb-2" cellspacing="5" cellpadding="5">
                <tbody>
                    <tr>
                        <td>Minimum date:</td>
                        <td><input class="form-control form-control-sm" type="text" id="min" name="min"></td>
                    </tr>
                    <tr>
                        <td>Maximum date:</td>
                        <td><input class="form-control form-control-sm" type="text" id="max" name="max"></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="margin-3">
            <table id="example" class="display" width="100%"></table>
        </div>
        
        <?php 
        var_dump($time);
    //    foreach ($time as $as => $a) {
    //     echo $a->yıl;
    //     echo $a->gün;
       
    //    }
        
        ?> 
    </div>
   
   

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
    <script src="https://cdn.datatables.net/datetime/1.2.0/js/dataTables.dateTime.min.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script>
        var minDate, maxDate;

        // Custom filtering function which will search data in column four between two values
        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                var min = minDate.val();
                var max = maxDate.val();
                var date = new Date(data[3]);

                if (
                    (min === null && max === null) ||
                    (min === null && date <= max) ||
                    (min <= date && max === null) ||
                    (min <= date && date <= max)
                ) {
                    return true;
                }
                return false;
            }
        );

        $(document).ready(function() {
            // Create date inputs
            minDate = new DateTime($('#min'), {
                format: 'YYYY-MM-DD'
            });
            maxDate = new DateTime($('#max'), {
                format: 'YYYY-MM-DD'
            });



            var table = $('#example').DataTable({


                "language": {

                    "sDecimal": ",",
                    "sEmptyTable": "Tabloda herhangi bir veri mevcut değil",
                    "sInfo": "_TOTAL_ kayıttan _START_ - _END_ arasındaki kayıtlar gösteriliyor",
                    "sInfoEmpty": "Kayıt yok",
                    "sInfoFiltered": "(_MAX_ kayıt içerisinden bulunan)",
                    "sInfoPostFix": "",
                    "sInfoThousands": ".",
                    "sLengthMenu": "Sayfada _MENU_ kayıt göster",
                    "sLoadingRecords": "Yükleniyor...",
                    "sProcessing": "",
                    "sSearch": "Ara:",
                    "sZeroRecords": "Eşleşen kayıt bulunamadı",
                    "oPaginate": {
                        "sFirst": "İlk",
                        "sLast": "Son",
                        "sNext": "Sonraki",
                        "sPrevious": "Önceki"
                    },
                    "oAria": {
                        "sSortAscending": ": artan sütun sıralamasını aktifleştir",
                        "sSortDescending": ": azalan sütun soralamasını aktifleştir"

                    }
                },
                processing: true,
                severSide: true,
                ajax: {
                    url: 'api.php',
                    type: 'POST',
                    order: [],
                },
                columns: [{
                        data: 'ad_Soyad'
                    },
                    {
                        data: 'firma'
                    },
                    {
                        data: 'firma_g_c'
                    },
                    {
                        data: 'tarih'
                    },
                    {
                        data: 'saat'
                    },
                    {
                        data: 'giris_cikis'
                    },
                ]


            });


            // Refilter the table
            $("#min, #max").on("change", function() {
                table.draw();

            });
        });
    </script>

</body>

</html>