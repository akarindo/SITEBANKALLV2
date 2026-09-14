<!-- BEGIN: Side Menu -->
<nav class="side-nav">
	<a href="" class="intro-x flex items-center pl-5 pt-4 mt-3">
		<img alt="Midone - HTML Admin Template" class="w-6" src="{{asset('admin/dist/images/logo.svg')}}">
		<span class="hidden xl:block text-white text-lg ml-3"> Admin Website <br> {{ config('subdomain.APP_NAME') }}
		</span>
	</a>
	<div class="side-nav__devider my-6"></div>
	<ul>

		<li>
			<a href="/salamprofit/login" class="{{Request::is('login') ? 'side-menu side-menu--active' : 'side-menu'}}">
				<div class="side-menu__icon"> <i data-lucide="home"></i> </div>
				<div class="side-menu__title">
					Dashboard
				</div>
			</a>
		</li>
		<li>
			<a href="/salamprofit/user"
				class="{{Request::is('salamprofit/user') ? 'side-menu side-menu--active' : 'side-menu'}}">
				<div class="side-menu__icon"> <i data-lucide="user"></i> </div>
				<div class="side-menu__title">
					User
				</div>
			</a>
		</li>

		<li>
			<a href="/salamprofit/banner"
				class="{{Request::is('salamprofit/banner') ? 'side-menu side-menu--active' : 'side-menu'}}">
				<div class="side-menu__icon"> <i data-lucide="image"></i> </div>
				<div class="side-menu__title">
					Banner
				</div>
			</a>
		</li>
		<li>
			<a href="javascript:;" class="side-menu">
				<div class="side-menu__icon"> <i data-lucide="database"></i> </div>
				<div class="side-menu__title">
					Master Pengajuan
					<div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
				</div>
			</a>
			<ul class="">
				<li>
					<a href="master-produk-pinjaman"
						class="{{Request::is('salamprofit/master-produk-pinjaman') ? 'side-menu side-menu--active' : 'side-menu'}}">
						<div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
						<div class="side-menu__title"> Produk Pinjaman </div>
					</a>
				</li>
				<li>
					<a href="/salamprofit/master-produk-deposito"
						class="{{Request::is('salamprofit/master-produk-deposito') ? 'side-menu side-menu--active' : 'side-menu'}}">
						<div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
						<div class="side-menu__title"> Produk Deposito </div>
					</a>
				</li>
				<li>
					<a href="/salamprofit/master-produk-tabungan"
						class="{{Request::is('salamprofit/master-produk-tabungan') ? 'side-menu side-menu--active' : 'side-menu'}}">
						<div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
						<div class="side-menu__title"> Produk Tabungan </div>
					</a>
				</li>
				<li>
					<a href="/salamprofit/master-produk-kredit"
						class="{{Request::is('salamprofit/master-produk-kredit') ? 'side-menu side-menu--active' : 'side-menu'}}">
						<div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
						<div class="side-menu__title"> Produk Kredit </div>
					</a>
				</li>
				<li>
					<a href="/salamprofit/master-jenis-agunan"
						class="{{Request::is('salamprofit/master-jenis-agunan') ? 'side-menu side-menu--active' : 'side-menu'}}">
						<div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
						<div class="side-menu__title"> Jenis Agunan </div>
					</a>
				</li>
			</ul>
		</li>
		{{-- <li>
			<a href="javascript:;" class="side-menu">
				<div class="side-menu__icon"> <i data-lucide="database"></i> </div>
				<div class="side-menu__title">
					Master Pekerjaan
					<div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
				</div>
			</a>
			<ul class="">
				<li>
					<a href="#"
						class="{{Request::is('salamprofit/banner') ? 'side-menu side-menu--active' : 'side-menu'}}">
						<div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
						<div class="side-menu__title"> Bidang Pekerjaan </div>
					</a>
				</li>
				<li>
					<a href="#"
						class="{{Request::is('salamprofit/banner') ? 'side-menu side-menu--active' : 'side-menu'}}">
						<div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
						<div class="side-menu__title"> Jenis Pekerjaan </div>
					</a>
				</li>

			</ul>
		</li> --}}
		<li>
			<a href="javascript:;" class="side-menu">
				<div class="side-menu__icon"> <i data-lucide="database"></i> </div>
				<div class="side-menu__title">
					Master Jabatan
					<div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
				</div>
			</a>
			<ul class="">
				<li>
					<a href="/salamprofit/master-jabatan"
						class="{{Request::is('salamprofit/master-jabatan') ? 'side-menu side-menu--active' : 'side-menu'}}">
						<div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
						<div class="side-menu__title"> Jabatan </div>
					</a>
				</li>
			</ul>
		</li>
		<li>
			<a href="javascript:;" class="side-menu">
				<div class="side-menu__icon"> <i data-lucide="file-text"></i> </div>
				<div class="side-menu__title">
					Pengajuan Online
					<div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
				</div>
			</a>
			<ul class="">
				<li>
					<a href="/salamprofit/data-pengajuan-kredit"
						class="{{Request::is('salamprofit/data-pengajuan-kredit') ? 'side-menu side-menu--active' : 'side-menu'}}">
						<div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
						<div class="side-menu__title"> Kredit </div>
					</a>
				</li>
				<li>
					<a href="/salamprofit/data-pengajuan-deposito"
						class="{{Request::is('salamprofit/data-pengajuan-deposito') ? 'side-menu side-menu--active' : 'side-menu'}}">
						<div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
						<div class="side-menu__title"> Deposito </div>
					</a>
				</li>
				<li>
					<a href="/salamprofit/data-pengajuan-tabungan"
						class="{{Request::is('salamprofit/data-pengajuan-tabungan') ? 'side-menu side-menu--active' : 'side-menu'}}">
						<div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
						<div class="side-menu__title"> Tabungan </div>
					</a>
				</li>

			</ul>
		</li>
		<li>
			<a href="/salamprofit/produklayanan"
				class="{{Request::is('salamprofit/produklayanan') ? 'side-menu side-menu--active' : 'side-menu'}}">
				<div class="side-menu__icon"> <i data-lucide="credit-card"></i> </div>
				<div class="side-menu__title"> Produk/Layanan </div>
			</a>
		</li>
		<li>
			<a href="/salamprofit/pages"
				class="{{Request::is('salamprofit/pages') ? 'side-menu side-menu--active' : 'side-menu'}}">
				<div class="side-menu__icon"> <i data-lucide="edit"></i> </div>
				<div class="side-menu__title"> Manage Berita </div>
			</a>
		</li>
		<li>
			<a href="javascript:;" class="side-menu">
				<div class="side-menu__icon"> <i data-lucide="message-circle"></i> </div>
				<div class="side-menu__title">
					Pengaduan Online
					<div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
				</div>
			</a>
			<ul class="">
				<li>
					<a href="/salamprofit/master-jenis-pengaduan"
						class="{{Request::is('salamprofit/master-jenis-pengaduan') ? 'side-menu side-menu--active' : 'side-menu'}}">
						<div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
						<div class="side-menu__title"> Jenis Pengaduan </div>
					</a>
				</li>
				<li>
					<a href="/salamprofit/data-jenis-pengaduan"
						class="{{Request::is('salamprofit/data-jenis-pengaduan') ? 'side-menu side-menu--active' : 'side-menu'}}">
						<div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
						<div class="side-menu__title"> Data Pengaduan </div>
					</a>
				</li>
			</ul>
		</li>
		<li>
			<a href="/salamprofit/wbs"
				class="{{Request::is('salamprofit/wbs') ? 'side-menu side-menu--active' : 'side-menu'}}">
				<div class="side-menu__icon"> <i data-lucide="file-text"></i> </div>
				<div class="side-menu__title"> Report WBS </div>
			</a>
		</li>
		<li>
			<a href="/salamprofit/laporan"
				class="{{Request::is('salamprofit/laporan') ? 'side-menu side-menu--active' : 'side-menu'}}">
				<div class="side-menu__icon"> <i data-lucide="file-text"></i> </div>
				<div class="side-menu__title">
					Laporan
				</div>
			</a>
		</li>
		<li>
			<a href="/salamprofit/lelang"
				class="{{Request::is('salamprofit/lelang') ? 'side-menu side-menu--active' : 'side-menu'}}">
				<div class="side-menu__icon"> <i data-lucide="hammer"></i> </div>
				<div class="side-menu__title"> Lelang </div>
			</a>
		</li>
		<li>
			<a href="javascript:;" class="side-menu">
				<div class="side-menu__icon"> <i data-lucide="file-text"></i> </div>
				<div class="side-menu__title">
					Rekruitmen
					<div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
				</div>
			</a>
			<ul class="">
				<li>
					<a href="/salamprofit/rekruitmen"
						class="{{Request::is('salamprofit/rekruitmen') ? 'side-menu side-menu--active' : 'side-menu'}}">
						<div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
						<div class="side-menu__title">Lowongan </div>
					</a>
				</li>
				<li>
					<a href="/salamprofit/rekruitmen-data"
						class="{{Request::is('salamprofit/rekruitmen-data') ? 'side-menu side-menu--active' : 'side-menu'}}">
						<div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
						<div class="side-menu__title">Lamaran</div>
					</a>
				</li>


			</ul>
		</li>
		<li>
			<a href="/salamprofit/profile"
				class="{{Request::is('salamprofit/profile') ? 'side-menu side-menu--active' : 'side-menu'}}">
				<div class="side-menu__icon"> <i data-lucide="landmark"></i> </div>
				<div class="side-menu__title"> Profile </div>
			</a>
		</li>
		<li>
			<a href="/salamprofit/gallery"
				class="{{Request::is('salamprofit/gallery') ? 'side-menu side-menu--active' : 'side-menu'}}">
				<div class="side-menu__icon"> <i data-lucide="camera"></i> </div>
				<div class="side-menu__title"> Galery </div>
			</a>
		</li>
		<li>
			<a href="/salamprofit/jaringan-kantor"
				class="{{Request::is('salamprofit/jaringan-kantor') ? 'side-menu side-menu--active' : 'side-menu'}}">
				<div class="side-menu__icon"> <i data-lucide="map-pin"></i> </div>
				<div class="side-menu__title"> Jaringan Kantor </div>
			</a>
		</li>
		<li>
			<a href="/salamprofit/data-umkm"
				class="{{Request::is('salamprofit/data-umkm') ? 'side-menu side-menu--active' : 'side-menu'}}">
				<div class="side-menu__icon"> <i data-lucide="landmark"></i> </div>
				<div class="side-menu__title"> UMKM </div>
			</a>
		</li>
		<li>
			<a href="/salamprofit/counter-rate"
				class="{{Request::is('salamprofit/counter-rate') ? 'side-menu side-menu--active' : 'side-menu'}}">
				<div class="side-menu__icon"> <i data-lucide="file-text"></i> </div>
				<div class="side-menu__title"> Counter Rate </div>
			</a>
		</li>
		{{-- <li>
			<a href="javascript:;" class="side-menu">
				<div class="side-menu__icon"> <i data-lucide="file-text"></i> </div>
				<div class="side-menu__title">
					UMKM
					<div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
				</div>
			</a>
			<ul class="">
				<li>
					<a href="/salamprofit/master-layanan"
						class="{{Request::is('salamprofit/master-layanan') ? 'side-menu side-menu--active' : 'side-menu'}}">
						<div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
						<div class="side-menu__title">Master Layanan</div>
					</a>
				</li>
				<li>
					<a href="/salamprofit/data-umkm"
						class="{{Request::is('salamprofit/data-umkm') ? 'side-menu side-menu--active' : 'side-menu'}}">
						<div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
						<div class="side-menu__title">Data UMKM</div>
					</a>
				</li>


			</ul>
		</li> --}}
		<li>
			<a href="javascript:;"
				class="side-menu {{Request::is('salamprofit/website') ? 'side-menu--open' : ''}} {{Request::is('salamprofit/seo') ? 'side-menu--open' : ''}} ">
				<div class="side-menu__icon"> <i data-lucide="settings"></i> </div>
				<div class="side-menu__title">
					Setting
					<div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
				</div>
			</a>
			<ul
				class="{{Request::is('salamprofit/website') ? 'side-menu__sub-open' : ''}} {{Request::is('salamprofit/seo') ? 'side-menu__sub-open' : ''}}">
				<li>
					<a href="/salamprofit/website"
						class="{{Request::is('salamprofit/website') ? 'side-menu side-menu--active' : 'side-menu'}}">
						<div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
						<div class="side-menu__title"> Website </div>
					</a>
				</li>
				<li>
					<a href="/salamprofit/seo-setting"
						class="{{Request::is('salamprofit/seo-setting') ? 'side-menu side-menu--active' : 'side-menu'}}">
						<div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
						<div class="side-menu__title"> SEO </div>
					</a>
				</li>

			</ul>
		</li>

	</ul>
</nav>
<!-- END: Side Menu -->