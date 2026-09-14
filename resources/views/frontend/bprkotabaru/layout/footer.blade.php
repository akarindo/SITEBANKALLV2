 <!-- Footer Start -->
 <style>
     .visitor-stats {
         background-color: #f8f9fa;
         padding: 20px;
         /* Diperkecil dari 30px */
         border-radius: 8px;
         box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
         text-align: center;
     }

     .visitor-stats h5 {
         font-size: 16px;
         /* Diperkecil dari 24px */
         font-weight: 700;
         color: #333;
         margin-bottom: 10px;
     }

     .visitor-stats p {
         font-size: 12px;
         /* Diperkecil dari 14px */
         color: #666;
         margin-bottom: 20px;
     }

     .stats-container {
         display: flex;
         justify-content: space-evenly;
         /* Distribusi yang lebih merata untuk 2 item */
         gap: 10px;
     }

     .stat-item {
         display: flex;
         flex-direction: column;
         align-items: center;
         text-align: center;
     }

     .stat-item i {
         font-size: 22px;
         /* Diperkecil dari 28px */
         color: #cb201d;
         margin-bottom: 8px;
     }

     .stat-info .stat-number {
         display: block;
         font-size: 18px;
         /* Diperkecil dari 28px */
         font-weight: 700;
         color: #333;
         line-height: 1;
     }

     .stat-info p {
         font-size: 10px;
         /* Diperkecil dari 12px */
         color: #888;
         margin: 5px 0 0;
     }

     .whatsapp-float {
         position: fixed;
         bottom: 28px;
         right: 27px;
         z-index: 1000;
     }


     /* Mobile Bottom Navigation */
     .mobile-bottom-nav {
         position: fixed;
         bottom: 0;
         left: 0;
         width: 100%;
         background: #3b87f9;
         /* warna hijau menyesuaikan website */
         z-index: 9999;
         border-top: 1px solid rgba(255, 255, 255, 0.2);
         padding: 10px 0;
     }

     .mobile-bottom-nav ul {
         display: flex;
         margin: 0;
         padding: 5px 0;
         list-style: none;
     }

     .mobile-bottom-nav ul li {
         flex: 1;
         text-align: center;
     }

     .mobile-bottom-nav ul li a {
         display: flex;
         flex-direction: column;
         align-items: center;
         justify-content: center;
         color: #ffffff;
         font-size: 12px;
         text-decoration: none;
     }

     .mobile-bottom-nav ul li a i {
         font-size: 18px;
         margin-bottom: 2px;
     }

     .mobile-bottom-nav ul li a:hover {
         color: #f7c319;
     }

     .running-text {
         width: 100%;
         overflow: hidden;
         white-space: nowrap;
     }

     .running-text span {
         display: inline-block;
         padding-left: 100%;
         animation: runningText 25s linear infinite;
     }

     @keyframes runningText {
         0% {
             transform: translateX(0);
         }

         100% {
             transform: translateX(-100%);
         }
     }
 </style>
 <div class="container-fluid footer py-5 wow fadeIn" data-wow-delay="0.2s">
     <div class="container py-5">
         <div class="row g-5">
             <div class="col-md-6 col-lg-6 col-xl-3">
                 <div class="footer-item d-flex flex-column">
                     <div class="footer-item">
                         <h4 class="text-white mb-4">Tentang Kami</h4>
                         <p class="mb-3" style="color: #fff">PT. BPR Kotabaru yang merupakan Bank Perkreditan Rakyat
                             milik Pemprov Kalimantan
                             Selatan dan Pemkab Kotabaru.
                         </p>
                         <div class="d-flex align-items-center">
                             <a class="btn btn-light btn-md-square me-2" href="#"><i
                                     class="fab fa-facebook-f"></i></a>
                             <a class="btn btn-light btn-md-square me-2" href="#"><i
                                     class="fab fa-twitter"></i></a>
                             <a class="btn btn-light btn-md-square me-2"
                                 href="https://www.instagram.com/bpr.bankkotabaru/"><i class="fab fa-instagram"></i></a>
                             <a class="btn btn-light btn-md-square me-0" href="#"><i
                                     class="fab fa-linkedin-in"></i></a>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="col-md-6 col-lg-6 col-xl-3">
                 <div class="footer-item d-flex flex-column">
                     <h4 class="text-white mb-4">Tautan Terkait</h4>
                     <a href="/pengaduan" style="color: #fff"><i class="fas fa-angle-right me-2"
                             style="color: #fff"></i> Pengaduan Nasabah</a>
                     <a href="/rekrutmen" style="color: #fff"><i class="fas fa-angle-right me-2"
                             style="color: #fff"></i> Karir</a>
                     <a href="/informasi" style="color: #fff"><i class="fas fa-angle-right me-2"
                             style="color: #fff"></i> Berita</a>
                     <a href="/jaringankantor" style="color: #fff"><i class="fas fa-angle-right me-2"
                             style="color: #fff"></i> Jaringan Kantor</a>

                 </div>
             </div>
             <div class="col-md-6 col-lg-6 col-xl-4">
                 <div class="footer-item d-flex flex-column">
                     <h4 class="text-white mb-4">Informasi Kontak</h4>


                     <a href="tel:051824525" style="color: #fff"><i class="fas fa-phone me-2" style="color: #fff"></i>+0518
                         24525</a>
                     <a href="https://wa.me/6285348046915" style="color: #fff" class="mb-3">
                         <i class="fab fa-whatsapp me-2" style="color: #fff"></i> 085348046915
                     </a>
                     <a href="#" style="color: #fff; "><i class="fas fa-envelope me-2" style="color: #fff;"></i>
                         bankKotabaru_perseroda@yahoo.com</a>
                     <a href="#" style="color: #fff"><i class="fa fa-map-marker-alt me-2"
                             style="color: #fff; "></i>Jl. Kenanga No.2 Desa Dirgahayu Kelurahan Kotabaru tengah
                         Kabupaten Kotabaru
                        </a>

                 </div>
             </div>
             <div class="col-md-6 col-lg-6 col-xl-2">
                 <div class="footer-item-post d-flex flex-column">
                     <div class="visitor-stats">
                         <h5>Statistik Pengunjung</h5>
                         {{-- <p>
                           Pantau aktivitas real-time website kami dan lihat bagaimana kami terus berkembang.
                       </p> --}}
                         <div class="stats-container">
                             <div class="stat-item">
                                 <i class="fas fa-users"></i>
                                 <div class="stat-info">
                                     <span class="stat-number" data-target="{{ $total_visitor }}">0</span>
                                     <p>Total Pengunjung</p>
                                 </div>
                             </div>
                             <div class="stat-item">
                                 <i class="fas fa-user-check"></i>
                                 <div class="stat-info">
                                     <span class="stat-number" data-target="{{ $today_visitor }}">0</span>
                                     <p>Pengunjung Hari Ini</p>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>

     </div>
     <div class="container footer-menu">
         <div class="f-menu running-text">
             <span style="color: #fff; font-size: 15px; font-family: 'Open Sans', sans-serif; font-weight:500;">
                 PT. BPR Kotabaru berizin dan diawasi oleh Otoritas Jasa Keuangan serta merupakan peserta penjaminan
                 LPS.
                 Maksimum nilai simpanan yang dijamin oleh
                 LPS adalah Rp.2 Miliar per nasabah per bank. Untuk informasi tingkat suku bunga
                 penjaminan LPS dapat diakses
             </span>
         </div>
     </div>
 </div>

 <!-- Footer End -->
 <nav class="mobile-bottom-nav d-block d-lg-none">
     <ul>
         <li><a href="/"><i class="fas fa-home"></i><span>Beranda</span></a></li>
         <li><a href="/kredit"><i class="fas fa-credit-card"></i><span>Kredit</span></a></li>
         <li><a href="/deposito"><i class="fas fa-coins"></i><span>Deposito</span></a></li>
         <li><a href="/tabungan"><i class="fas fa-piggy-bank"></i><span>Tabungan</span></a></li>
         <li><a href="/jaringankantor"><i class="fas fa-phone"></i><span>Kontak</span></a></li>
     </ul>
 </nav>



 <!-- Copyright Start -->
 <div class="container-fluid copyright py-4" style="background:#000;">
     <div class="container">
         <div class="row g-4 align-items-center">
             <div class="col-md-6 text-center text-md-start mb-md-0">
                 <span style="color:#fff;">
                     <a href="#" style="color:#fff;">
                         <i class="fas fa-copyright me-2"></i>
                         PT. BPR Kotabaru
                     </a>
                     support by
                     <a href="https://antaruang.com" style="color:#f7c319;">
                         Antar Uang
                     </a>
                 </span>
             </div>
         </div>
     </div>
 </div>

 {{-- <a href="#" class="btn btn-primary btn-lg-square back-to-top"><i class="fa fa-arrow-up"></i></a>    --}}
 <script>
     document.addEventListener('DOMContentLoaded', () => {
         const animateCounter = (element) => {
             const target = +element.getAttribute('data-target');
             const increment = target / 200;
             let current = 0;
             const updateCounter = () => {
                 current += increment;
                 if (current < target) {
                     element.innerText = Math.ceil(current);
                     requestAnimationFrame(updateCounter);
                 } else {
                     element.innerText = target.toLocaleString('id-ID');
                 }
             };
             updateCounter();
         };

         const statsSection = document.querySelector('.visitor-stats');
         const observer = new IntersectionObserver((entries) => {
             entries.forEach(entry => {
                 if (entry.isIntersecting) {
                     const counters = document.querySelectorAll('.stat-number');
                     counters.forEach(counter => animateCounter(counter));
                     observer.unobserve(statsSection);
                 }
             });
         }, {
             threshold: 0.5
         });

         if (statsSection) {
             observer.observe(statsSection);
         }
     });
 </script>
