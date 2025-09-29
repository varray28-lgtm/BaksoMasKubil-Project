<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Tentang</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->

<div class="heading">
   <h3>Tentang Kami</h3>
   <p><a href="home.php">Beranda</a> <span> / Tentang</span></p>
</div>

<!-- about section starts  -->

<section class="about">

   <div class="row">

      <div class="image">
         <img src="images/about-img.svg" alt="">
      </div>

      <div class="content">
         <h3>Kenapa memilih kami?</h3>
         <p>Bakso Mas Kubil berawal dari sebuah dapur rumah tangga sederhana di kawasan Jakarta Timur, di mana pemilik usaha, yang dikenal dengan sapaan Mas Kubil, meracik sendiri resep bakso dari bahan-bahan segar tanpa bahan pengawet dan penyedap buatan. Berbekal keahlian keluarga dalam memasak dan semangat wirausaha, Mas Kubil mulai menjajakan bakso keliling dari kampung ke kampung.

Antusiasme pelanggan terhadap rasa baksonya yang khas membuat Mas Kubil memutuskan untuk membuka warung permanen. Seiring waktu, Bakso Mas Kubil terus berkembang, menambah variasi menu, memperluas jangkauan layanan, dan meningkatkan kapasitas produksi. Hingga kini, Bakso Mas Kubil telah dikenal sebagai salah satu penyedia bakso dengan cita rasa otentik dan harga terjangkau di wilayah sekitarnya.</p>
         <a href="menu.html" class="btn">Menu Kami</a>
      </div>

   </div>

</section>

<!-- about section ends -->

<!-- steps section starts  -->

<section class="steps">

   <h1 class="title">Langkah Pemesanan</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/step-2.png" alt="">
         <h3>Cari Tempat</h3>
         <p>Pilih Meja dan Kursi yang kosong untuk tempat anda makan</p>
      </div>

      <div class="box">
         <img src="images/step-1.png" alt="">
         <h3>Pilih Pesanan</h3>
         <p>Pilih produk yang ingin dipesan, lalu lakukan transaksi</p>
      </div>

      <div class="box">
         <img src="images/step-3.png" alt="">
         <h3>Selamat Menikmati</h3>
         <p>Pesanan yang lezat dan bergizi siap dihidangkan</p>
      </div>

   </div>

</section>

<!-- steps section ends -->

<!-- reviews section starts  -->



<!-- reviews section ends -->



















<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->=






<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".reviews-slider", {
   loop:true,
   grabCursor: true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      0: {
      slidesPerView: 1,
      },
      700: {
      slidesPerView: 2,
      },
      1024: {
      slidesPerView: 3,
      },
   },
});

</script>

</body>
</html>