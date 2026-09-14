<!-- BEGIN: Top Bar -->
<div class="top-bar -mx-4 px-4 md:mx-0 md:px-0">
	<!-- BEGIN: Breadcrumb -->
	<nav aria-label="breadcrumb" class="-intro-x mr-auto hidden sm:flex">
		<div class="flex items-center">
			<img src="{{ asset(config('subdomain.GLOBAL_LOGO')) }}" alt="Logo"
				style="margin-left: 20px; heigth:50px; width: 200px;">
		</div>

	</nav>
	<!-- END: Breadcrumb -->
	<!-- BEGIN: Search -->
	<div class="intro-x relative mr-3 sm:mr-6">
		<div class="search hidden sm:block">
			<input type="text" class="search__input form-control border-transparent" placeholder="Search...">
			<i data-lucide="search" class="search__icon dark:text-slate-500"></i>
		</div>
		<a class="notification sm:hidden" href=""> <i data-lucide="search"
				class="notification__icon dark:text-slate-500"></i> </a>
		<div class="search-result">
			<div class="search-result__content">
				<div class="search-result__content__title">Pages</div>
				<div class="mb-5">
					<a href="" class="flex items-center">
						<div
							class="w-8 h-8 bg-success/20 dark:bg-success/10 text-success flex items-center justify-center rounded-full">
							<i class="w-4 h-4" data-lucide="inbox"></i> </div>
						<div class="ml-3">Mail Settings</div>
					</a>
					<a href="" class="flex items-center mt-2">
						<div class="w-8 h-8 bg-pending/10 text-pending flex items-center justify-center rounded-full">
							<i class="w-4 h-4" data-lucide="users"></i> </div>
						<div class="ml-3">Users & Permissions</div>
					</a>
					<a href="" class="flex items-center mt-2">
						<div
							class="w-8 h-8 bg-primary/10 dark:bg-primary/20 text-primary/80 flex items-center justify-center rounded-full">
							<i class="w-4 h-4" data-lucide="credit-card"></i> </div>
						<div class="ml-3">Transactions Report</div>
					</a>
				</div>

			</div>
		</div>
	</div>
	<!-- END: Search -->
	<!-- BEGIN: Notifications -->
	<div class="intro-x dropdown mr-auto sm:mr-6" hidden>
		<div class="dropdown-toggle notification notification--bullet cursor-pointer" role="button"
			aria-expanded="false" data-tw-toggle="dropdown"> <i data-lucide="bell"
				class="notification__icon dark:text-slate-500"></i> </div>
		<div class="notification-content pt-2 dropdown-menu">
			<div class="notification-content__box dropdown-content">
				<div class="notification-content__title">Notifications</div>
				<div class="cursor-pointer relative flex items-center ">
					<div class="w-12 h-12 flex-none image-fit mr-1">
						<img alt="Midone - HTML Admin Template" class="rounded-full"
							src="{{asset('admin/dist/images/icon.png')}}">
						<div
							class="w-3 h-3 bg-success absolute right-0 bottom-0 rounded-full border-2 border-white dark:border-darkmode-600">
						</div>
					</div>
					<div class="ml-2 overflow-hidden">
						<div class="flex items-center">
							<a href="javascript:;" class="font-medium truncate mr-5">{{ Auth::user()->name }}</a>
							<div class="text-xs text-slate-400 ml-auto whitespace-nowrap">01:10 PM</div>
						</div>
						<div class="w-full truncate text-slate-500 mt-0.5">Lorem Ipsum is simply dummy text of the
							printing and typesetting industry. Lorem Ipsum has been the industry&#039;s standard dummy
							text ever since the 1500</div>
					</div>
				</div>
				<div class="cursor-pointer relative flex items-center mt-5">
					<div class="w-12 h-12 flex-none image-fit mr-1">
						<img alt="Midone - HTML Admin Template" class="rounded-full"
							src="{{asset('admin/dist/images/profile-10.jpg')}}">
						<div
							class="w-3 h-3 bg-success absolute right-0 bottom-0 rounded-full border-2 border-white dark:border-darkmode-600">
						</div>
					</div>
					<div class="ml-2 overflow-hidden">
						<div class="flex items-center">
							<a href="javascript:;" class="font-medium truncate mr-5">Christian Bale</a>
							<div class="text-xs text-slate-400 ml-auto whitespace-nowrap">01:10 PM</div>
						</div>
						<div class="w-full truncate text-slate-500 mt-0.5">There are many variations of passages of
							Lorem Ipsum available, but the majority have suffered alteration in some form, by injected
							humour, or randomi</div>
					</div>
				</div>

			</div>
		</div>
	</div>
	<!-- END: Notifications -->
	<!-- BEGIN: Account Menu -->
	<div class="intro-x dropdown">

		<!-- BUTTON (Avatar + Nama) -->
		<div class="dropdown-toggle flex items-center gap-3 cursor-pointer" role="button" aria-expanded="false"
			data-tw-toggle="dropdown">

			<div class="w-10 h-10 rounded-full overflow-hidden shadow-lg image-fit">
				<img src="{{asset('admin/dist/images/icon.jpg')}}" alt="User">
			</div>

			<div class="flex flex-col leading-tight">
				<span class="font-medium text-slate-800">{{ Auth::user()->name }}</span>

			</div>
		</div>

		<!-- DROPDOWN MENU -->
		<div class="dropdown-menu w-40 mt-2">
			<ul class="dropdown-content bg-primary text-white">

				<li>
					<hr class="dropdown-divider border-white/[0.08]">
				</li>

				<li>
					<a href="" class="dropdown-item hover:bg-white/5">
						<i data-lucide="user" class="w-4 h-4 mr-2"></i> Profile
					</a>
				</li>

				<li>
					<hr class="dropdown-divider border-white/[0.08]">
				</li>

				<li>
					<a href="{{ route('logout') }}"
						onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
						class="dropdown-item hover:bg-white/5">
						<i data-lucide="toggle-right" class="w-4 h-4 mr-2"></i> Logout
					</a>
					<form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
				</li>

			</ul>
		</div>
	</div>

	<!-- END: Account Menu -->
</div>
<!-- END: Top Bar -->