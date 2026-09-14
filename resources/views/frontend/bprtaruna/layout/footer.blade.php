<style>
    .footer1 {
        background-color: #eaedf1;
        /* bisa ganti warna sesuai keinginan */
        color: #000000;
        padding-top: 60px;
    }

    .whatsapp-float {
        position: fixed;
        bottom: 28px;
        right: 27px;
        z-index: 1000;
    }
     @media (max-width: 768px) {
        .whatsapp-float {
            bottom: 80px;
            right: 15px;
        }

        .footer-custom .footer-group {
            flex-direction: column !important;
            align-items: center !important;
            text-align: center !important;
            gap: 15px;
        }

        .footer-custom .footer-item {
            width: 100% !important;
            margin-bottom: 10px;
        }

        .footer-custom .col-md-4.text-center.text-md-end {
            justify-content: center !important;
            margin-top: 15px;
        }

        .footer-custom .col-md-4.text-center.text-md-end a {
            margin: 0 8px 8px 8px;
        }

        .footer-custom {
            padding-bottom: 80px;
        }
    }
    .mobile-bottom-nav {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        height: 65px;
        background: #ffffff;
        border-top: 4px solid #ddd;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 999;
    }

    .mobile-bottom-nav ul {
        display: flex;
        justify-content: space-around;
        align-items: center;
        width: 100%;
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .mobile-bottom-nav ul li {
        flex: 1;
        text-align: center;
    }

    .mobile-bottom-nav ul li a {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 100%;
        padding-top: 9px;
        font-size: 12px;
        color: #333;
        text-decoration: none;
        line-height: 1.1;
    }

    .mobile-bottom-nav ul li a i {
        font-size: 22px;
        margin-bottom: 3px;
    }

    .mobile-bottom-nav ul li a.active,
    .mobile-bottom-nav ul li a:hover {
        color: #ff092a;
    }
</style>
<footer>

    <div class="footer1 _relative">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="single-footer-items footer-logo-area">
                        <div class="footer-logo">
                            <a href="#"> <img src="{{asset('frontend/bprtaruna/assets/img/logo/logo.png')}}"
                                    style="height: 40px; width: 170px;" alt=""></a>
                        </div>
                        <div class="space20"></div>
                        <div class="heading1">

                            <td>
                                <p
                                    style="
                                   font-size:15px; 
                                   color:#676879; 
                                   text-align:center; 
                                   line-height:1.3; 
                                   ">
                                    PT. BPR Taruna Adidaya Santosa berizin dan diawasi oleh Otoritas serta
                                    merupakan peserta penjaminan LPS.
                                    <br><br>

                                    Maksimum nilai simpanan yang dijamin LPS per nasabah per bank adalah
                                    Rp2 miliar.
                                    <br><br>

                                    Untuk mengetahui Tingkat Bunga Penjaminan LPS silakan akses
                                    <a href="https://apps.lps.go.id/BankPesertaLPSRate" target="_blank"
                                        style="color:#0d6efd; text-decoration:none; font-weight:500;">
                                        di sini
                                    </a>.
                                </p>

                            </td>

                        </div>

                    </div>
                </div>

                <div class="col-lg col-md-6 col-12">
                    <div class="single-footer-items">
                        <h3>Jaringan Kantor</h3>

                        <select id="pilihKantor" class="form-select mb-3"
                            style="background-color:#0d6efd; color:#fff; text-transform:none;">

                            @foreach ($kantorglobal as $kantor)
                                <option value="{{ $kantor->id }}" data-nama="{{ $kantor->kantor }}"
                                    data-alamat="{{ $kantor->alamat }}" data-telp="{{ $kantor->no_telp }}"
                                    data-lat="{{ $kantor->latitude }}" data-lng="{{ $kantor->longitude }}"
                                    data-thumb="/recfil?display=true&rf={{ $kantor->thumbnail }}"
                                    {{ strtolower($kantor->kantor) == 'kantor pusat' ? 'selected' : '' }}>
                                    {{ $kantor->kantor }}
                                </option>
                            @endforeach

                        </select>

                        <div id="detailKantor">
                            <p id="namaKantor" style="font-weight:600; margin-bottom:4px;"></p>
                            <p id="alamatKantor" style="font-size:14px; margin-bottom:4px;"></p>
                            <p id="telpKantor" style="font-size:14px; margin-bottom:10px;"></p>

                            <div id="thumbnailContainer"></div>
                        </div>

                    </div>
                </div>



                <div class="col-lg col-md-6 col-12">
                    <div class="single-footer-items">
                        <h3>Tautan</h3>

                        <ul class="menu-list">
                            {{-- <li><a href="/lelang-jualaset"> </a></li> --}}
                            {{-- <li><a href="#">Jual Aset</a></li> --}}
                            <li><a href="/rekrutmen">E - Recruitment</a></li>
                            <li><a href="/pengaduan">Pengaduan Nasabah</a></li>
                            <li><a href="/jaringankantor">Jaringan Kantor</a></li>
                            {{-- <li><a href="https://docs.google.com/forms/d/e/1FAIpQLSfO340OmQU84nottx330Gphj8vQbtgVhJa2Wx46YAjS4u_Ajw/viewform?pli=1">Survey Kepuasan Pelangggan</a></li> --}}
                        </ul>
                        {{-- <div>
                                        <ul class="social-icon">
                                            <li> <a href="https://www.ppatk.go.id/">  <img src="frontend/nusaintim/assets/img/logo/ppatk1.png" alt="" style="height: 35px; width: 35px; margin-right: 7px;"> </a></li>
                                            <li> <a href="https://www.ojk.go.id/id/Default.aspx"> <img src="frontend/nusaintim/assets/img/logo/ojk.jpeg" alt="" style="height: 35px; width: 35px; margin-right: 7px;"> </a> </li>
                                             <li> <a href="https://www.bi.go.id/id/default.aspx"> <img src="frontend/nusaintim/assets/img/logo/bii.jpg" alt="" style="height: 35px; width: 35px; margin-right: 7px;"> </a> </li>
                                              <li> <a href="https://lps.go.id/"> <img src="frontend/nusaintim/assets/img/logo/lps.jpg" alt="" style="height: 35px; width: 35px; margin-right: 7px;"> </a> </li>
                                        </ul>
                                      </div> --}}
                    </div>
                </div>


                <div class="col-lg-3 col-md-6 col-12">
                    <div class="single-footer-items">
                        <h3>Hubungi Kami</h3>

                        <div class="contact-box">
                            <div class="icon">
                                <img src="{{asset('frontend/nusaintim/assets/img/icons/footer1-icon1.png')}}" alt="">
                            </div>
                            <div class="pera">
                                <a href="tel:(0291) 431191">(0291) 431191</a>
                            </div>
                        </div>

                        <div class="contact-box">
                            <div class="icon">
                                <img src="{{asset('frontend/nusaintim/assets/img/icons/wa.png')}}" alt=""
                                    style="width: 23px; height: 23px;">
                            </div>
                            <div class="pera">
                                <a href="https://wa.me/6285723526093" target="_blank">6285723526093</a>
                            </div>
                        </div>

                        <div class="contact-box">
                            <div class="icon">
                                <img src="{{asset('frontend/nusaintim/assets/img/icons/footer1-icon3.png')}}" alt="">
                            </div>
                            <div class="pera">
                                <a href="mailto:bprnusaintim@yahoo.com"
                                    style="font-size: 15px;">banktaruna@gmail.com</a>
                            </div>
                        </div>

                        <div>
                            <ul class="social-icon">
                                <li><a href="https://id-id.facebook.com/BPRTarunaAdidayaSantos4/"><i
                                            class="fa-brands fab fa-facebook-f"></i></a></li>
                                {{-- <li><a href="#"><i class="fa-brands fa-x-twitter"></i></a></li> --}}
                                <li><a href="https://www.youtube.com/watch?v=H16FqvSvDbM"><i
                                            class="fa-brands fa-youtube"></i></a></li>
                                <li><a href="https://www.instagram.com/bprtarunaadidayasantosa/"><i
                                            class="fa-brands fa-instagram"></i></a></li>
                            </ul>
                        </div>


                    </div>
                </div>
            </div>

            {{-- <div style="text-align: center; margin-top: 20px; ">
            <p style="font-size: 15px; color: #676879;">PT. Bpr Taruna Adidaya Santosa berizin dan diawasi oleh
                Otoritas. serta merupakan peserta penjaminan LPS,
                <br>
                Maksimum nilai simpanan yang dijamin LPS pernasabah per bank adalah 2 miliar. <br>
                Untuk mengetahui Tingkat Bunga Penjaminan LPS silahkan akses <a
                    href="https://apps.lps.go.id/BankPesertaLPSRate" target="_blank">disini</a>
            </p>

            <img src="frontend/nusaintim/assets/img/logo/lpsbawah.png" style="height: 200px;" alt="">
        </div> --}}

            <div class="space40"></div>
        </div>

        <div class="copyright-area">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-7">
                        <div class="coppyright">
                            <p>@ Copyright <b>Bank Taruna</b> Supported by <a href="https://antaruang.com/"
                                    target="_blank" style="color: red">Antar Uang</a></p>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="coppyright right-area">
                            <a href="#"></a>
                            <a href="#"></a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <a href="https://wa.me/62895412301818" target="_blank" class="whatsapp-float">
        <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" width="60">
    </a>
</footer>
<nav class="mobile-bottom-nav d-block d-lg-none">
    <ul>
        <li><a href="/"><i class="fa-solid fa-house"></i><span>Beranda</span></a></li>
        <li><a href="/kredit"><i class="fa-solid fa-credit-card"></i><span>Kredit</span></a></li>
        <li><a href="/deposito"><i class="fa-solid fa-coins"></i><span>Deposito</span></a></li>
        <li><a href="/tabungan"><i class="fa-solid fa-piggy-bank"></i><span>Tabungan</span></a></li>
        <li><a href="/jaringankantor"><i class="fa-solid fa-phone"></i><span>Kontak</span></a></li>
    </ul>
</nav>


<!--===== FOOTER AREA END =======-->
<script>
    function tampilkanKantor() {

        let select = document.getElementById('pilihKantor');
        let selected = select.options[select.selectedIndex];

        let nama = selected.getAttribute('data-nama');
        let alamat = selected.getAttribute('data-alamat');
        let telp = selected.getAttribute('data-telp');
        let lat = selected.getAttribute('data-lat');
        let lng = selected.getAttribute('data-lng');
        let thumb = selected.getAttribute('data-thumb');

        //    document.getElementById('namaKantor').innerText = nama;
        document.getElementById('alamatKantor').innerText = alamat;

        document.getElementById('telpKantor').innerHTML =
            `<strong>Telp : </strong> 
         <a href="tel:${telp}" style="color:#000;">${telp}</a>`;

        let googleLink = `https://www.google.com/maps?q=${lat},${lng}`;

        let thumbnailHTML = `
        <a href="${googleLink}" target="_blank">
            <img src="${thumb}" 
                 style="width:100%; height:70px; object-fit:cover; border-radius:8px; cursor:pointer; text-align:center"
                 alt="Lokasi Kantor">
        </a>
    `;

        document.getElementById('thumbnailContainer').innerHTML = thumbnailHTML;
    }

    // Ketika dropdown berubah
    document.getElementById('pilihKantor')
        .addEventListener('change', tampilkanKantor);

    // Saat pertama kali halaman dibuka (default Kantor Pusat langsung tampil)
    window.addEventListener('DOMContentLoaded', tampilkanKantor);
</script>
