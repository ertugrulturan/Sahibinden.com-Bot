<?php
// V4T1.EU Project v4r1able & t13r
if(empty($_GET["u"])) {
echo "GET Giriniz(?u=)";
exit;
}
$url = htmlspecialchars($_GET["u"]);
$sahibinden_kontrol = explode("/", $url);
if( $sahibinden_kontrol[2]=="www.sahibinden.com" ) { } else { echo "lütfen www.sahibinden.com üzerinden bir adres yazınız!(".$url.")"; exit; }
if( $sahibinden_kontrol[3]=="ilan" ) { } else { echo "lütfen www.sahibinden.com üzerinden bir ilan adresi yazınız!(".$url.")"; exit; }
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.79 Safari/537.36");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
$proxy_array = array("1.1.1.1:80", "1.1.1.1:80", "1.1.1.1:80", "1.1.1.1:80"); // sahibinden.com yabanci ip engelledigi icin turk proxyleri buraya ekleyiniz.
$proxy_rand = array_rand($proxy_array, 2);
curl_setopt($curl, CURLOPT_HTTPPROXYTUNNEL, 0);
curl_setopt($curl, CURLOPT_PROXY, $proxy_array[$proxy_rand[0]]);
$sahibinden_gir = curl_exec($curl);
preg_match_all('@<span class="classifiedId" id="classifiedId">(.*?)</span>@si',$sahibinden_gir,$ilan_kodu);
preg_match_all('@<span(.*?)</span>@si',$sahibinden_gir,$ilan_veri);
preg_match_all('@<span class="pretty-phone-part">(.*?)</span>@si',$sahibinden_gir,$telefon);
preg_match_all('@<h3>(.*?)</h3>@si',$sahibinden_gir,$para);
function duzelt($veri) {
$duzelt = str_replace('>', '', $veri);
$duzelt_2 = str_replace('class=""', '', $duzelt);
$duzelt_3 = str_replace('class="classifiedId" id="classifiedId"', '', $duzelt_2);
return $duzelt_3;
}
$base64 = base64_decode("PGlucHV0IGlkPSJwcmljZUhpc3RvcnlGbGFnIiB0eXBlPSJoaWRkZW4iIHZhbHVlPSIiPgo8aW5wdXQgaWQ9InByaWNlSGlzdG9yeUNsYXNzaWZpZWRJZCIgdHlwZT0iaGlkZGVuIiB2YWx1ZT0iIj4KPGlucHV0IGlkPSJwcmljZUhpc3RvcnlGYXZvcml0ZSIgdHlwZT0iaGlkZGVuIiB2YWx1ZT0iIj4KPGRpdiBpZD0icHJpY2UtaGlzdG9yeS13cmFwcGVyIiBjbGFzcz0icHJpY2UtaGlzdG9yeS13cmFwcGVyIGhpZGRlbiI+CgogICAgPGRpdiBpZD0icHJpY2UtaWNvbi13cmFwcGVyIiBjbGFzcz0icHJpY2UtaGlzdG9yeS13cmFwcGVyIHRpcGl0aXAtdHJpZ2dlciBwcmljZS1oaXN0b3J5LWljb24iIGRhdGEtY2xhc3M9InByaWNlLWhpc3RvcnkiCiAgICAgICAgIGRhdGEtcG9zaXRpb249InNvdXRoIiBkYXRhLWNvbnRlbnQ9IsSwbGFuIEZpeWF0IFRhcmlow6dlc2kiPgogICAgPC9kaXY+CgogICAgPHNwYW4gaWQ9InNwbGFzaC1wcmljZS1oaXN0b3J5LWljb24iPjwvc3Bhbj4KCiAgICA8ZGl2IGlkPSJwcmljZS1oaXN0b3J5LWRyb3Bkb3duIiBjbGFzcz0icHJpY2UtaGlzdG9yeS13cmFwcGVyIHByaWNlLWhpc3RvcnktaW5mbyI+CgogICAgICAgIDxkaXYgY2xhc3M9InNlY3Rpb24tdG9wIj4KICAgICAgICAgICAgPGRpdiBjbGFzcz0ic2VjdGlvbi10aXRsZSI+CiAgICAgICAgICAgICAgICAgICAgPHNwYW4gY2xhc3M9ImZvci1jbGFzc2lmaWVkLW93bmVyIj4KICAgICAgICAgICAgICAgICAgICAgICAgICAgxLBsYW4gRml5YXQgVGFyaWjDp2VzaTwvc3Bhbj4KICAgICAgICAgICAgICAgIDxzcGFuIGNsYXNzPSJmb3ItY2xhc3NpZmllZC1mYXZvdXJpdGUiPgogICAgICAgICAgICAgICAgICAgICAgICAgICBGYXZvcml5ZSBFa2xlbmRpa3RlbiBTb25yYWtpIEZpeWF0IFRhcmlow6dlc2k8L3NwYW4+CiAgICAgICAgICAgIDwvZGl2PgogICAgICAgIDwvZGl2PgoKICAgICAgICA8ZGl2IGNsYXNzPSJzZWN0aW9uLW1haW4iPgoKICAgICAgICAgICAgPHVsIGNsYXNzPSJwcmljZS1oaXN0b3J5LXN1bW1hcnkiPgogICAgICAgICAgICAgICAgPGxpIGNsYXNzPSJwcmljZS1oaXN0b3J5LXN1bW1hcnktaXRlbSBmaXJzdC1wcmljZSI+CiAgICAgICAgICAgICAgICAgICAgPHAgY2xhc3M9Imhpc3RvcnktaGVhZGVyIGZvci1jbGFzc2lmaWVkLW93bmVyIj4KICAgICAgICAgICAgICAgICAgICAgICAgxLBsYW7EsW4gWWF5xLFubGFuZMSxxJ/EsQpGaXlhdDwvcD4KICAgICAgICAgICAgICAgICAgICA8cCBjbGFzcz0iaGlzdG9yeS1oZWFkZXIgZm9yLWNsYXNzaWZpZWQtZmF2b3VyaXRlIj4KICAgICAgICAgICAgICAgICAgICAgICAgRmF2b3JpeWUgRWtsZW5kacSfaW5kZWtpIEZpeWF0PC9wPgogICAgICAgICAgICAgICAgICAgIDxwIGlkPSJpbml0aWFsUHJpY2VUZW1wbGF0ZSIgY2xhc3M9Imhpc3RvcnktYm9keSI+CgogICAgICAgICAgICAgICAgICAgIDwvcD4KICAgICAgICAgICAgICAgIDwvbGk+CiAgICAgICAgICAgICAgICA8bGkgY2xhc3M9InByaWNlLWhpc3Rvcnktc3VtbWFyeS1pdGVtIHByaWNlLWhvbGRlciI+CiAgICAgICAgICAgICAgICAgICAgPGRpdiBjbGFzcz0icHJpY2UtY2hhbmdlLWljb24iPjwvZGl2PgogICAgICAgICAgICAgICAgPC9saT4KICAgICAgICAgICAgICAgIDxsaSBjbGFzcz0icHJpY2UtaGlzdG9yeS1zdW1tYXJ5LWl0ZW0gc2Vjb25kLXByaWNlIj4KICAgICAgICAgICAgICAgICAgICA8cCBjbGFzcz0iaGlzdG9yeS1oZWFkZXIgIj4KICAgICAgICAgICAgICAgICAgICAgICAgxLBsYW7EsW4gxZ51IEFua2kKRml5YXTEsTwvcD4KICAgICAgICAgICAgICAgICAgICA8cCBjbGFzcz0iaGlzdG9yeS1ib2R5IiBpZD0icmVhbFByaWNlVGVtcGxhdGUiPgogICAgICAgICAgICAgICAgICAgIDwvcD4KICAgICAgICAgICAgICAgIDwvbGk+CiAgICAgICAgICAgIDwvdWw+CgogICAgICAgICAgICA8ZGl2IGlkPSJ0YWJsZS13cmFwcGVyIiBjbGFzcz0idGFibGUtd3JhcHBlciI+CiAgICAgICAgICAgICAgICA8dGFibGUgY2xhc3M9InByaWNlLWhpc3RvcnktdGFibGUiPgogICAgICAgICAgICAgICAgICAgIDx0Ym9keT4KICAgICAgICAgICAgICAgICAgICA8dHIgaWQ9Imhpc3Rvcnktcm93Ij4KICAgICAgICAgICAgICAgICAgICAgICAgPHRkIGNsYXNzPSJmb3ItY2xhc3NpZmllZC1vd25lciI+CiAgICAgICAgICAgICAgICAgICAgICAgICAgICDEsGxhbsSxbiBZYXnEsW5sYW5kxLHEn8SxCkZpeWF0PHAgY2xhc3M9ImlubmVyLWRhdGUiPllhecSxbmxhbm1hIFRhcmloaTo8L3A+CiAgICAgICAgICAgICAgICAgICAgICAgIDwvdGQ+CiAgICAgICAgICAgICAgICAgICAgICAgIDx0ZCBjbGFzcz0iZm9yLWNsYXNzaWZpZWQtZmF2b3VyaXRlIj4KICAgICAgICAgICAgICAgICAgICAgICAgICAgIEZhdm9yaXllIEVrbGVuZGnEn2luZGVraSBGaXlhdDxwIGNsYXNzPSJpbm5lci1kYXRlIj5GYXZvcml5ZSBFa2xlbWUgVGFyaWhpOjwvcD4KICAgICAgICAgICAgICAgICAgICAgICAgPC90ZD4KICAgICAgICAgICAgICAgICAgICAgICAgPHRkIGNsYXNzPSJoaXN0b3J5LXByaWNlIj48L3RkPgogICAgICAgICAgICAgICAgICAgIDwvdHI+CiAgICAgICAgICAgICAgICAgICAgPC90Ym9keT4KICAgICAgICAgICAgICAgIDwvdGFibGU+CiAgICAgICAgICAgIDwvZGl2PgoKICAgICAgICAgICAgPGgzIGNsYXNzPSJuby1wcmljZS1oaXN0b3J5Ij4KICAgICAgICAgICAgICAgIDxzcGFuIGNsYXNzPSJmb3ItY2xhc3NpZmllZC1vd25lciI+CiAgICAgICAgICAgICAgICAgICAgxLBsYW4geWF5xLFubGFuZMSxa3RhbiBzb25yYSBmaXlhdCBkZcSfacWfaWtsacSfaSBvbG1hbcSxxZ90xLFyLjwvc3Bhbj4KICAgICAgICAgICAgICAgIDxzcGFuIGNsYXNzPSJmb3ItY2xhc3NpZmllZC1mYXZvdXJpdGUiPgogICAgICAgICAgICAgICAgICAgICAgICBGYXZvcml5ZSBla2xlbmRpa3RlbiBzb25yYSBmaXlhdCBkZcSfacWfaWtsacSfaSBvbG1hbcSxxZ90xLFyLjwvc3Bhbj4=");
$html_sil = explode($base64, $para[1][1]);
echo "URL: ".$url;
echo "<br>";
echo $html_sil[0];
echo "<br>";
echo duzelt($ilan_kodu[1][0]);
echo '<br>';
echo duzelt($ilan_veri[1][42]);
echo '<br>';
echo duzelt($ilan_veri[1][43]);
echo '<br>';
echo duzelt($ilan_veri[1][44]);
echo '<br>';
echo duzelt($ilan_veri[1][45]);
echo '<br>';
echo duzelt($ilan_veri[1][46]);
echo '<br>';
echo duzelt($ilan_veri[1][47]);
echo '<br>';
echo duzelt($ilan_veri[1][48]);
echo '<br>';
echo duzelt($ilan_veri[1][49]);
echo '<br>';
echo duzelt($ilan_veri[1][50]);
echo '<br>';
echo duzelt($ilan_veri[1][51]);
echo '<br>';
echo duzelt($ilan_veri[1][52]);
echo '<br>';
echo duzelt($ilan_veri[1][53]);
echo '<br>';
echo duzelt($ilan_veri[1][54]);
echo '<br>';
echo duzelt($ilan_veri[1][55]);
echo '<br>';
echo duzelt($ilan_veri[1][56]);
echo '<br>';
echo duzelt($ilan_veri[1][57]);
echo '<br>';
echo duzelt($ilan_veri[1][58]);
echo '<br>';
echo duzelt($ilan_veri[1][59]);
echo '<br>';
echo duzelt($ilan_veri[1][60]);
echo '<br>';
echo $telefon[1][0];
echo '<br>';
echo $telefon[1][1];
?>
