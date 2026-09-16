@extends('frontend.bprstaja.layout.main')

@section('content')
<style>

/* Banner */
.banner-img{
    width:100%;
    height:500px;
    object-fit:cover;
    display:block;
}

@media(max-width:768px){
    .banner-img{
        height:260px;
    }
}

/* Card Kredit */
.team-box{
    margin-bottom:30px;
}

.kredit-img{
    width:100%;
    height:400px;
    object-fit:fill;
    border-radius:15px;
    transition:0.3s;
}

.kredit-img:hover{
    transform:scale(1.03);
}

/* Mobile */
@media(max-width:768px){
    .kredit-img{
        height:auto;
    }
}

</style>


<div class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Produk Pembiayaan</h2>
            </div>
        </div>
    </div>
</div>


<div class="team2 team-page sp" style="padding-top:50px; padding-bottom:60px;">
    <div class="container">

        <div class="row">

            @foreach ($kredit as $item)
            <div class="col-lg-4 col-md-6 col-12">

                <div class="team-box">

                    <a href="{{ route('detkredit', $item->id) }}">

                        <img 
                        src="/recfil?display=true&rf={{ $item->thumbnail }}"
                        alt="{{ $item->title ?? 'kredit' }}"
                        class="kredit-img">

                    </a>

                </div>

            </div>
            @endforeach

        </div>

    </div>
</div>

@endsection