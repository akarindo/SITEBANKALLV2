@extends('layouts.admin')

@section('content')
@php
    $isBprSms = config('subdomain.CUSTOM_PAGE_BERANDA') === 'frontend.bprsms.index';
@endphp
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
<style>
    .modal-dialog {
        max-width: 90% !important;
        width: 70% !important;
    }
</style>

<div class="grid grid-cols-12 gap-6">
    <div class="col-span-12 2xl:col-span-9">
        <div class="grid grid-cols-12 gap-6">
            <!-- BEGIN: BANNER -->
            <div class="col-span-12 mt-8">
                <div class="intro-y flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">
                        LELANG
                    </h2>
                    <a href="" class="ml-auto flex items-center text-primary"> <i data-lucide="refresh-ccw"
                            class="w-4 h-4 mr-3"></i> Reload Data </a>
                </div>
                {{-- BEGIN: DATACARD --}}
                <div class="grid grid-cols-12 gap-6 mt-5">
                    <div class="col-span-12 intro-y">
                        <div class="report-box">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-lucide="image" class="report-box__icon text-primary"></i>
                                    <div class="ml-auto"> 
                                        <button class="btn btn-sm btn-primary" type="button"
                                            onclick="openinputmodal(null)">
                                            <i data-lucide="plus-square"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="grid grid-cols-12 gap-6 mt-2">
                                    <div class="col-span-12">
                                        <hr>
                                    </div>
                                    <div class="col-span-12 lg:col-span-6">
                                        <form action="/salamprofit/lelang" method="get">
                                            <div class="input-group">
                                                <input type="date" name="str" class="form-control"
                                                    value="{{ $date_start }}" data-single-mode="true">
                                                <div class="input-group-text">-</div>
                                                <input type="date" name="end" class="form-control"
                                                    value="{{ $date_end }}" data-single-mode="true">
                                            </div>
                                            <button class="btn btn-primary w-full mt-2" type="submit">Cari</button>
                                        </form>
                                    </div>
                                    <div class="col-span-12">
                                        <table id="datatabledefault">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Urutan</th>
                                                    <th>Title</th>
                                                    <th>Mulai - Selesai</th>
                                                    <th>Image Banner</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($data as $key => $v)
                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                    <td>{{$v->urutan}}</td>
                                                    <td>{{$v->title}}</td>
                                                    <td>{{\Carbon\Carbon::parse($v->mulai)->format('d-m-Y')}} s/d
                                                        {{\Carbon\Carbon::parse($v->selesai)->format('d-m-Y')}}</td>
                                                    <td>
                                                        <a class="btn btn-secondary btn-sm"
                                                            href="/recfil?display=true&rf={{$v->banner}}"
                                                            target="_blank" title="Lihat Banner">
                                                            <i data-lucide="maximize-2"></i>
                                                        </a>
                                                        <a class="btn btn-secondary btn-sm"
                                                            href="/recfil?display=true&rf={{$v->thumbnail}}"
                                                            target="_blank" title="Lihat Thumbnail">
                                                            <i data-lucide="maximize"></i>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <span class="btn btn-sm btn-warning"><i data-lucide="edit"
                                                                onclick="openinputmodal({{$v}})"></i></span>
                                                        <span class="btn btn-sm btn-danger"
                                                            onclick="confirmdelete('/salamprofit/lelang/{{$v->id}}')"><i
                                                                data-lucide="trash"></i></span>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-span-12">
                                        <hr>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- END: DATACARD --}}
            </div>
            <!-- END: BANNER -->
        </div>
    </div>
</div>

<!-- BEGIN: Modal Input -->
<div id="modalInputBanner" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="/salamprofit/lelang" method="post" enctype="multipart/form-data">
                @csrf
                <input type="text" name="txtId" id="txtId" hidden>
                <!-- BEGIN: Modal Header -->
                <div class="modal-header">
                    <h2 class="font-medium text-base mr-auto">Lelang</h2>
                </div>
                <!-- END: Modal Header -->
                <!-- BEGIN: Modal Body -->
                <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                    <div class="col-span-12 sm:col-span-6">
                        <label for="txtUrutan" class="form-label">Urutan</label>
                        <input id="txtUrutan" name="urutan" type="number" class="form-control" min="1" step="1">
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="txtType" class="form-label">Type</label>
                        <select id="txtType" name="type" class="form-control">
                            <option value="0">Lelang</option>
                            <option value="1">Jual Aset</option>
                        </select>
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="slcTag" class="form-label">Tag</label>
                        <select id="slcTag" data-header="Pilih/Tambah Tag" name="tag[]" class="tom-select w-full"
                            multiple>
                            @foreach ($tag as $t)
                            <option value="{{$t}}">{{$t}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="slcKategori" class="form-label">Kategori</label>
                        <select id="slcKategori" data-header="Pilih/Tambah Kategori" name="kategori[]"    data-placeholder="Wajib isi (Rumah/Kendaraan/Elektronik/Tanah/Pabrik)" 
                            class="tom-select w-full" multiple>
                            @foreach ($kategori as $k)
                            <option value="{{$k}}">{{$k}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="txtTitle" class="form-label">Title</label>
                        <input id="txtTitle" name="title" type="text" class="form-control">
                        @error('title')
                        <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-span-12 sm:col-span-6 auction-limit-field">
                        <label for="txtLimit" class="form-label">Limit</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input id="txtLimit" name="limit" type="number" class="form-control" placeholder="0">
                        </div>
                    </div>
                    @if ($isBprSms)
                    <div class="col-span-12 sm:col-span-6 sms-asset-only" style="display: none;">
                        <label for="txtHargaPenawaran" class="form-label">Harga Penawaran</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input id="txtHargaPenawaran" name="harga_penawaran" type="number" class="form-control" min="0" placeholder="0">
                        </div>
                    </div>
                    @endif
                    <div class="col-span-12 sm:col-span-6">
                        <label for="txtCaraPenawaran" class="form-label">Cara Penawaran</label>
                        <select id="txtCaraPenawaran" name="cara_penawaran" class="form-control">
                            <option value="0">Open Bidding</option>
                            <option value="1">Closed Bidding</option>
                        </select>
                    </div>
                    <div class="col-span-12 sm:col-span-6 auction-guarantee-field">
                        <label for="txtJaminan" class="form-label">Jaminan</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input id="txtJaminan" name="jaminan" type="number" class="form-control">
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 auction-guarantee-deadline-field">
                        <label for="detBatasAkhirJaminan" class="form-label">Batas Akhir Jaminan</label>
                        <input id="detBatasAkhirJaminan" type="date" name="batas_akhir_jaminan" class="form-control"
                            data-single-mode="true">
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="detMulai" class="form-label">Mulai Lelang</label>
                        <input id="detMulai" type="date" name="mulai" class="form-control" data-single-mode="true">
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="detSelesai" class="form-label">Selesai Lelang</label>
                        <input id="detSelesai" type="date" name="selesai" class="form-control" data-single-mode="true">
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="txtPenyelenggara" class="form-label">Penyelenggara</label>
                        <input id="txtPenyelenggara" name="penyelenggara" type="text" class="form-control">
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="txtKodeLot" class="form-label">Kode Lot</label>
                        <input id="txtKodeLot" name="kode_lot" type="text" class="form-control">
                    </div>
                    {{-- <div class="col-span-12 sm:col-span-6">
                        <label for="txtUraian" class="form-label">Uraian</label>
                        <input id="txtUraian" name="uraian" type="text" class="form-control">
                    </div> --}}
                    <div class="col-span-12 sm:col-span-6">
                        <label for="txtLampiran" class="form-label">Lampiran</label>
                        <input id="txtLampiran" name="lampiran" type="text" class="form-control">
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="txtProvinsi" class="form-label">Provinsi</label>
                        <input id="txtProvinsi" name="provinsi" type="text" class="form-control">
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="txtKota" class="form-label">Kota</label>
                        <input id="txtKota" name="kota" type="text" class="form-control">
                    </div>
                    @if ($isBprSms)
                    <div class="col-span-12 sm:col-span-6 sms-asset-only" style="display: none;">
                        <label for="txtLokasi" class="form-label">Lokasi Aset</label>
                        <input id="txtLokasi" name="lokasi" type="text" class="form-control">
                    </div>
                    <div class="col-span-12 sm:col-span-6 sms-asset-only" style="display: none;">
                        <label for="txtLuasTanah" class="form-label">Luas Tanah</label>
                        <input id="txtLuasTanah" name="luas_tanah" type="text" class="form-control" placeholder="Contoh: 120 m2">
                    </div>
                    <div class="col-span-12 sm:col-span-6 sms-asset-only" style="display: none;">
                        <label for="txtLuasBangunan" class="form-label">Luas Bangunan</label>
                        <input id="txtLuasBangunan" name="luas_bangunan" type="text" class="form-control" placeholder="Contoh: 80 m2">
                    </div>
                    <div class="col-span-12 sm:col-span-6 sms-asset-only" style="display: none;">
                        <label for="txtLegalitas" class="form-label">Legalitas</label>
                        <input id="txtLegalitas" name="legalitas" type="text" class="form-control" placeholder="Contoh: SHM / HGB">
                    </div>
                    @endif
                    <div class="col-span-12 sm:col-span-6">
                        <label for="txtLink" class="form-label">Link</label>
                        <input id="txtLink" name="link" type="text" class="form-control">
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="filThumbnail" class="form-label">Thumbnail</label>
                        <input id="filThumbnail" accept="image/*" type="file" name="thumbnail" class="form-control"
                            dat-showpreview="true">
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="filBanner" class="form-label">Banner</label>
                        <input id="filBanner" accept="image/*" type="file" name="banner" class="form-control"
                            dat-showpreview="true">
                    </div>
                    @if ($isBprSms)
                    <div class="col-span-12 sms-asset-only" style="display: none;">
                        <label for="filAlbum" class="form-label">Album Foto / Gambar Aset</label>
                        <input id="filAlbum" accept="image/jpeg,image/png,image/webp" type="file" name="album[]" class="form-control" multiple>
                        <div class="form-help mt-1">Pilih beberapa gambar untuk ditampilkan sebagai slider pada banner detail aset. Maksimal 2 MB per gambar.</div>
                    </div>
                    @endif
                    <div class="col-span-12">
                        <label for="txtUraian" class="form-label">Uraian Lengkap</label>
                        <input type="hidden" name="uraian" id="txtUraianHidden">
                        
                        <div id="editorUraian" class="bg-white" style="height: 300px;"></div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" data-tw-dismiss="modal"
                        class="btn btn-outline-secondary w-20 mr-1">Cancel</button>
                    <button type="submit" class="btn btn-primary w-20">Simpan</button>
                </div> <!-- END: Modal Footer -->
            </form>
        </div>
    </div>
</div>
<!-- END: Modal Input -->

<script>
    var inputmodal;
    var quillUraian; // Definisi variabel global
    const isBprSms = @json($isBprSms);

$(document).ready(function () {
    // 1. Inisialisasi Quill dengan Toolbar Lengkap
    quillUraian = new Quill('#editorUraian', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                ['blockquote', 'code-block'],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                [{ 'script': 'sub'}, { 'script': 'super' }],
                [{ 'indent': '-1'}, { 'indent': '+1' }],
                [{ 'direction': 'rtl' }],
                [{ 'color': [] }, { 'background': [] }],
                [{ 'align': [] }],
                ['link', 'image', 'video'],
                ['clean']
            ]
        }
    });

    // 2. Sinkronisasi otomatis ke hidden input saat ada perubahan text
    quillUraian.on('text-change', function() {
        var html = quillUraian.root.innerHTML;
        // Jika editor kosong (hanya ada tag p kosong), set null agar validasi DB bersih
        if (html === '<p><br></p>') html = '';
        $('#txtUraianHidden').val(html);
    });

    inputmodal = tailwind.Modal.getOrCreateInstance(document.querySelector("#modalInputBanner"));
    $('#txtType').on('change', toggleAssetFields);
    toggleAssetFields();
});

function toggleAssetFields() {
    if (!isBprSms) {
        return;
    }

    const isAsset = $('#txtType').val() === '1';
    $('.sms-asset-only').toggle(isAsset);
    $('.auction-limit-field').toggle(!isAsset);
    $('.auction-guarantee-field').toggle(!isAsset);
    $('.auction-guarantee-deadline-field').toggle(!isAsset);
}

function openinputmodal(t) {
    inputmodal.show();
    
    // Reset Form
    $('#txtId').val(null);
    $('#txtHargaPenawaran, #txtLokasi, #txtLuasTanah, #txtLuasBangunan, #txtLegalitas').val('');
    quillUraian.setContents([]); // Mengosongkan editor
    $('#txtUraianHidden').val('');
    $('.showpreviewfile_0_0').remove();
    $('.showpreviewfile_1_0').remove();
    $('.showpreviewalbum').remove();

    if (t) {
        $('#txtId').val(t.id);
        $('#txtUrutan').val(t.urutan);
        $('#txtType').val(t.type).trigger('change');
        
        // Set data ke Quill Editor
        if (t.uraian) {
            quillUraian.root.innerHTML = t.uraian;
            $('#txtUraianHidden').val(t.uraian);
        }

        // ... kode assignment lainnya (title, limit, tag, dll) ...
        document.querySelector('#slcTag').tomselect.setValue(t.tags);
        document.querySelector('#slcKategori').tomselect.setValue(t.kategoris);
        $('#txtTitle').val(t.title);
        $('#txtLimit').val(t.limit);
        $('#txtHargaPenawaran').val(t.harga_penawaran || '');
        $('#txtCaraPenawaran').val(t.cara_penawaran).trigger('change');
        $('#txtJaminan').val(t.jaminan);
        $('#detBatasAkhirJaminan').val(dayjs(t.batas_akhir_jaminan).format('YYYY-MM-DD'));
        $('#detMulai').val(dayjs(t.mulai).format('YYYY-MM-DD'));
        $('#detSelesai').val(dayjs(t.selesai).format('YYYY-MM-DD'));
        $('#txtPenyelenggara').val(t.penyelenggara);
        $('#txtKodeLot').val(t.kode_lot);
        $('#txtLampiran').val(t.lampiran);
        $('#txtProvinsi').val(t.provinsi);
        $('#txtKota').val(t.kota);
        $('#txtLokasi').val(t.lokasi || '');
        $('#txtLuasTanah').val(t.luas_tanah || '');
        $('#txtLuasBangunan').val(t.luas_bangunan || '');
        $('#txtLegalitas').val(t.legalitas || '');
        $('#txtLink').val(t.link);

        // Preview Image Logic tetap sama
        if (t.thumbnail) {
            $('#filThumbnail').parent().append('<img src="/recfil?rf=' + t.thumbnail + '" class="showpreviewfile_0_0 mt-2" style="width:130px;">')
        }
        if (t.banner) {
            $('#filBanner').parent().append('<img src="/recfil?rf=' + t.banner + '" class="showpreviewfile_1_0 mt-2" style="width:130px;">')
        }
        if (Array.isArray(t.album)) {
            t.album.forEach(function (image) {
                $('#filAlbum').parent().append('<img src="/recfil?rf=' + image + '" class="showpreviewalbum mt-2 mr-2" style="width:130px; height:90px; object-fit:cover;">');
            });
        }
    }

    toggleAssetFields();
}
</script>
@endsection
