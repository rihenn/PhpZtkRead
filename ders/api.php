
<?php
session_start();
global $gun_farki;

require __DIR__.'/baglan.php';
 $kullanici = $_SESSION["ad"] ;


 $sql = "SELECT * FROM  giris_cikis where ad_soyad = '$kullanici' ORDER BY tarih DESC";

 $users = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
 
 $response = [];
 
 $response['data']=[];

foreach ($users as $user){
    $e = 1;
     $d = 0;

    $ad = $user['ad_soyad'];
    $firma = $user['firma']; 
    $girma_g_C = $user['firma_g_c'];
    $tarih =$user['tarih'];
    $date1 = str_replace('/', '-', $user['saat']);
    $saat = date("H:i:", strtotime($date1));
  
    $giriscikis =  $user['giris_cikis'];

    

    $response['data'][] = [
        'ad_Soyad' => $user['ad_soyad'],
        'firma' => $user['firma'],
        'firma_g_c' => $user['firma_g_c'],
        'tarih' => $user['tarih'],
        'saat' => $user['saat'],
        'giris_cikis' => $user['giris_cikis'],
    ];
    
}

echo json_encode($response);
?>