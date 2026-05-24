<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KiranaSubCipher</title>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Arial, Helvetica, sans-serif;
        }

        /*Mengubah warna halaman*/
        body{ 
            background:#f3f5fb;
        }

        /*Mengatur bagian atas website*/
        .header{ 
            width:100%;
            padding:40px;
            text-align:center;
            background:linear-gradient(135deg,#005bea,#7303c0);
            color:white;
            border-bottom-left-radius:30px;
            border-bottom-right-radius:30px;
            box-shadow:0 5px 20px rgba(0,0,0,0.2);
        }

        .header h1{
            font-size:55px;
            margin-bottom:10px;
        }

        .header span{
            color:gold;
        }

        .header p{
            font-size:22px;
        }

        /*Lebar isi website 90%*/
        .container{ 
            width:90%;
            margin:auto;
            margin-top:30px;
        }

        .input-box{
            background:white;
            padding:30px;
            border-radius:20px;
            box-shadow:0 5px 15px rgba(0,0,0,0.1);
        }

        .input-box h2{
            color:#6a00ff;
            margin-bottom:20px;
        }

        textarea{
            width:100%;
            height:80px;
            padding:15px;
            border-radius:10px;
            border:2px solid #6a00ff;
            font-size:20px;
            resize:none; /*Agar textarea tidak bisa diperbesar manual*/
        }

        button{
            margin-top:20px;
            width:100%;
            padding:15px;
            border:none;
            border-radius:10px;
            background:linear-gradient(135deg,#005bea,#7303c0);
            color:white;
            font-size:20px;
            cursor:pointer;
            transition:0.3s;
        }

        button:hover{ /*Saat mouse diarahkan tombol sedikit membesar*/
            transform:scale(1.02);
        }

        .hasil-container{ /*membuat card enkripsi dan dekripsi sejajar*/
            display:flex;
            gap:20px;
            margin-top:30px;
            flex-wrap: wrap; /*Agar card turun ke bawah saat layar kecil*/
        }

        .card{ /*Kotak hasil enkripsi/dekripsi*/
            flex:1;
            background:white;
            padding:25px;
            border-radius:20px;
            box-shadow:0 5px 15px rgba(0,0,0,0.1);
        }

        .encrypt{ /*Memberi garis hijau di card enkripsi*/
            border-left:8px solid green;
        }

        .decrypt{ /* Memberi garis biru di card dekripsi*/
            border-left:8px solid #005bea;
        }

        .card h2{
            margin-bottom:20px;
        }

        .encrypt h2{
            color:green;
        }

        .decrypt h2{
            color:#005bea;
        }

        .hasil{
            padding:20px;
            border-radius:10px;
            font-size:40px;
            margin-bottom:15px;
            font-weight:bold;
        }

        .encrypt .hasil{
            background:#e7fff0;
            color:green;
        }

        .decrypt .hasil{
            background:#edf3ff;
            color:#005bea;
        }

        .tabel{
            margin-top:30px;
            background:white;
            padding:25px;
            border-radius:20px;
            box-shadow:0 5px 15px rgba(0,0,0,0.1);
        }

        .tabel h2{
            color:#6a00ff;
            margin-bottom:20px;
        }

        .tabel-wrapper{ /*Agar tabel bisa discroll horizontal di HP */
            overflow-x:auto;
        }

        table{
            min-width: 900px; /*Mencegah tabel terlalu sempit */
            width: 100%;
            border-collapse:collapse;
            text-align:center;
        }

        table td{
            border:1px solid #ccc;
            padding:12px;
            font-size:16px;
        }

        .footer{
            text-align:center;
            margin-top:30px;
            padding:20px;
            color:#555;
        }

    </style>

</head>
<body>

<?php

// =====================================
// Metode Caesar Cipher
// =====================================

// Fungsi Enkripsi
function enkripsi($text, $shift = 3){

    $hasil = "";

    for($i = 0; $i < strlen($text); $i++){

        $char = $text[$i]; //Mengambil satu karakter

        // Huruf besar
        if(ctype_upper($char)){ //Mengecek apakah huruf kapital

            $hasil .= chr((ord($char) - 65 + $shift) % 26 + 65);
        //ord() → ubah huruf jadi angka asli, + $shift → geser huruf, % 26 → agar kembali ke A setelah Z, chr() → ubah angka kembali jadi huruf
        }

        // Huruf kecil
        elseif(ctype_lower($char)){

            $hasil .= chr((ord($char) - 97 + $shift) % 26 + 97);

        }

        // Selain huruf
        else{

            $hasil .= $char;
        }
    }

    return $hasil;
}


// Fungsi Dekripsi
function dekripsi($text, $shift = 3){ /*Mengembalikan cipher menjadi teks*/

    $hasil = "";

    for($i = 0; $i < strlen($text); $i++){

        $char = $text[$i];

        // Huruf besar
        if(ctype_upper($char)){

            $hasil .= chr((ord($char) - 65 - $shift + 26) % 26 + 65);

        }

        // Huruf kecil
        elseif(ctype_lower($char)){

            $hasil .= chr((ord($char) - 97 - $shift + 26) % 26 + 97);

        }

        // Selain huruf
        else{

            $hasil .= $char;
        }
    }

    return $hasil;
}


// Input
$teks = "";
$chiper = "";
$dekripsi = "";

if(isset($_POST['encrypt'])){ //Mengecek apakah tombol ENKRIPSI ditekan

    $teks = $_POST['teks']; //Mengambil isi textarea

    $chiper = enkripsi($teks); //Memanggil/menjalankan proses enkripsi

    $dekripsi = dekripsi($chiper);
}

?>

<div class="header">

    <h1>Kirana<span>Sub</span>Cipher</h1>

    <p>
        Algoritma Kriptografi Substitusi Sederhana (Caesar Cipher)
    </p>

</div>


<div class="container">

    <div class="input-box">

        <h2>MASUKKAN TEKS</h2>

        <form method="POST">

            <textarea 
            name="teks" 
            placeholder="Masukkan teks..."
            ><?php echo $teks; ?></textarea>

            <button type="submit" name="encrypt">
                ENKRIPSI
            </button>

        </form>

    </div>


    <?php if($chiper != ""){ ?>

    <div class="hasil-container">

        <!-- ENKRIPSI -->
        <div class="card encrypt">

            <h2>HASIL ENKRIPSI</h2>

            <div class="hasil">
                <?php echo $chiper; ?> <!-- Menampilkan chiper ke halaman -->
            </div>

            <p>
                Teks di atas menggunakan metode Caesar Cipher.
            </p>

        </div>


        <!-- DEKRIPSI -->
        <div class="card decrypt">

            <h2>HASIL DEKRIPSI</h2>

            <div class="hasil">
                <?php echo $dekripsi; ?>
            </div>

            <p>
                Teks berhasil dikembalikan ke semula.
            </p>

        </div>

    </div>

    <?php } ?>


    <!-- TABEL -->
    <div class="tabel">

        <h2>ATURAN SUBSTITUSI (SHIFT = 3)</h2>
        <div class="tabel-wrapper">
        <table>

            <tr>

                <td><b>Teks</b></td>

                <?php
                foreach(range('A','Z') as $huruf){ //Membuat huruf A sampai Z otomatis
                    echo "<td>$huruf</td>";
                }
                ?>

            </tr>

            <tr>

                <td><b>Cipher</b></td>

                <?php
                foreach(range('D','Z') as $huruf){
                    echo "<td>$huruf</td>";
                }

                foreach(range('A','C') as $huruf){ 
                    echo "<td>$huruf</td>";
                }
                ?>

            </tr>

        </table>
        </div>
    </div>

</div>


<div class="footer"> <!-- Bagian bawah website -->

    © 2026 TalithaIntan | Caesar Cipher

</div>

</body>
</html>