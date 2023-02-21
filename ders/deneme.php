
<?php
session_start();
global $gun_farki;

require __DIR__.'/baglan.php';
 $kullanici = $_SESSION["ad"] ;


 $sql = "SELECT * FROM  giris_cikis where ad_soyad = '$kullanici' ORDER BY tarih DESC";

 $users = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
 
 $response = [];
 
 $response['data']=[];
 $e = 1;
foreach ($users as $user) {
    


    $ad = $user['ad_soyad'];
    $firma = $user['firma'];
    $girma_g_C = $user['firma_g_c'];
    $tarih = $user['tarih'];
    $date1 = str_replace('/', '-', $user['saat']);
    $saat = date("H:i:", strtotime($date1));

    $giriscikis = $user['giris_cikis'];

    
    for ($i = 0; $i <200; $i++) {
        $trh= $tarih;
        if ($trh =$tarih) {
            global $baslangicTarihi, $bitisTarihi;
            if ($giriscikis === "Giriş") {
                $baslangicTarihi = (strtotime($tarih)+ strtotime($saat))/8600;
                
    
            } 
            if ($giriscikis === "Çıkış") {
                $bitisTarihi = (strtotime($tarih )+ strtotime($saat))/8600;
                
    
            }
        }if($trh =! $tarih){
            $trh = $tarih;
        }
        $fark =$baslangicTarihi- $bitisTarihi;
        //Aradaki saniye farkını bulduk.

        $dakika = $fark / 60;
        $saniye_farki = floor($fark - (floor($dakika) * 60));

        $saat = $dakika / 60;
        $dakika_farki = floor($dakika - (floor($saat) * 60));

        $gun = $saat / 24;
        $saat_farki = floor($saat - (floor($gun) * 24));

        $yil = floor($gun / 365);
        $gun_farki = floor($gun - (floor($yil) * 365));
        if ($e== 1) {
            $time = [];
            array_push(
                $time,
                $_SESSION["yıl"]=$yil,
                $_SESSION["gün"]=$gun_farki . ' gün ' ,
                $_SESSION["saat"]= $saat_farki . ' saat ',
                $_SESSION["dakika"]= $dakika_farki . ' dakika ',
                $_SESSION["saniye"]= $saniye_farki . ' saniye ' 
            );
            
        $e--;
        }
        echo $yil . ' yıl ';
        echo $gun_farki . ' gün ';
        echo $saat_farki . ' saat ';
        echo $dakika_farki . ' dakika ';
        echo $saniye_farki . ' saniye ';
        $baslangicTarihi = 0;
        $bitisTarihi = 0;
        $e= 0;
    }      
}
$_SESSION['time']=$time;
header('location:/GIRISCIKIS/ders/datatables.php');
        ?>