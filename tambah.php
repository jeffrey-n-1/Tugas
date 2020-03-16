<?php
include('config.php');
?>
<html>
    <head>
    <link rel="stylesheet"
href="table.css" type ="text/css">
    <title> Perhitungan Nilai AKhir Mahasiswa </title>
    </head>
    <body>
    
    <form methot= "get" action="">
    <br>ID<br>
           <input type="text" name="id" readonly placeholder="Gabisa diisi"><br>
           Nilai 1<br>
           <input type="text" name="tb"><br>
           <br>Nilai 2 <br>
           <input type="text" name="bb"><br>
           <br>Keterangan <br>
           <input type="text" name="nama"><br>
           <input type="submit" name="submit" value="Hitung">
           <input type="submit" name="tampil" value="tampil">
           </form>
           
           <?php
        
        if (isset($_GET['submit'])){
            
            $tb = $_GET['tb'];
            $bb = $_GET['bb'];
            $nama=$_GET['nama'];
            
            $bmi = $bb + $tb;
            $a="A";
            $b="B";
            $c="C";
            $d="D";
           
        
            if ($bmi>=8)

{

$nama = $a;

}

elseif ($bmi>=6)

{

$nama = $b;

}

elseif ($bmi>=4)

{

$nama = $c;

}

elseif ($bmi>=2)

{

$nama = $d;

}
for($i=0;$i<=10;$i++){
    $tb=$bb;
    $bb=$bmi;
    $bmi=$tb+$bb;
    if ($bmi>=8)

    {
    
    $nama = $a;
    
    }
    
    elseif ($bmi>=6)
    
    {
    
    $nama = $b;
    
    }
    
    elseif ($bmi>=4)
    
    {
    
    $nama = $c;
    
    }
    
    elseif ($bmi>=2)
    
    {
    
    $nama = $d;
    
    }

}

            
                
            $sql = mysqli_query($koneksi, "INSERT INTO jumlah (a, b,
c, ket) VALUES('$bb', '$tb', '$bmi', '$nama')") or
die(mysqli_error($koneksi));
		 
                
        }
    
                ?>
    
        <table border=1  class="flat-table">
<thead>
<tr>
<th width=20% height=20%>NO.</th>
<th width="40%">Nilai 1</th>
<th>Nilai 2</th>
<th>Hasil</th>
<th>Keterangan</th>
<th> Fitur </th>
</thead>
</tr>
<tbody>
<?php
if (isset($_GET['tampil'])){
//query ke database SELECT tabel mahasiswa urut berdasarkan idyang paling besar
$sql = mysqli_query($koneksi,
"SELECT * FROM jumlah



") or die(mysqli_error($koneksi));
//jika query diatas menghasilkan nilai > 0 maka menjalankan script dibawah if...
if(mysqli_num_rows($sql) > 0){
//membuat variabel $no untuk menyimpan nomor urut
$no = 1;
//melakukan perulangan while dengan dari dari query $sql
while($data = mysqli_fetch_assoc($sql)){
//menampilkan data perulangan
echo '
<tr>
<td>'.$no.'</td>
<td>'.$data['a'].'</td>
<td>'.$data['b'].'</td>
<td>'.$data['c'].'</td>
<td>'.$data['ket'].'</td>
<td> <a href="delete.php?id='.$data['id'].'" class="badge badge-danger" onclick="return confirm(\'Yakin ingin
menghapus data ini?\')">Delete</a>
</td>
</tr>
';
$no++;
}
//jika query menghasilkan nilai 0
}else{
echo '
<tr>
<td colspan="6">Tidak ada data.</td>
</tr>
';
}

}
?>

<tbody>
</table>

        
    </body>
    </html>