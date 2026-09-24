@extends('layouts.admin')

@section('content')

<div class="grid grid-cols-12 gap-6">
    <div class="col-span-12 2xl:col-span-9">
        <div class="grid grid-cols-12 gap-6">
            <!-- BEGIN: PRODUK & LAYANAN -->
            <div class="col-span-12 mt-8">
                <div class="intro-y flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">
                        PRODUK & LAYANAN
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
                                    <i data-lucide="credit-card" class="report-box__icon text-primary"></i>
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

                                    </div>
                                    <div class="col-span-12">
                                        <table id="datatabledefault">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Title</th>
                                                    <th>Type</th>
                                                    <th>Kategori</th>
                                                    <th>Tag</th>
                                                    <th>Gambar</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($prolay as $k => $v)
                                                <tr>
                                                    <td>{{ ($k + 1) }}</td>
                                                    <td>{{ $v->title }}</td>
                                                    <td>
                                                        @if ($v->type == 0)
                                                        Produk
                                                        @elseif ($v->type == 1)
                                                        Layanan
                                                        @else
                                                        Lainnya
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($v->kategori == 0)
                                                        Kredit
                                                        @elseif ($v->kategori == 1)
                                                        Deposito
                                                        @elseif ($v->kategori == 2)
                                                        Tabungan
                                                        @elseif ($v->kategori == 3)
                                                        Layanan
                                                        @else
                                                        Lainnya
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($v->tag)
                                                        @foreach (json_decode($v->tag) as $t)
                                                        <span
                                                            class="py-1 px-2 rounded-full text-xs bg-success text-white cursor-pointer font-medium mr-1">
                                                            {{ $t }} </span>
                                                        @endforeach
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-secondary btn-sm"
                                                            href="/recfil?display=true&rf={{ urlencode($v->banner) }}"
                                                            target="_blank">
                                                            <i data-lucide="image"></i>
                                                        </a>
                                                        @if ($v->thumbnail)
                                                        <a class="btn btn-secondary btn-sm"
                                                            href="/recfil?display=true&rf={{ urlencode($v->thumbnail) }}"
                                                            target="_blank">
                                                            <i data-lucide="maximize"></i>
                                                        </a>
                                                        @endif
                                                        <a class="btn btn-secondary btn-sm"
                                                            href="/recfil?display=true&rf={{ urlencode($v->brosur) }}"
                                                            target="_blank">
                                                            <i data-lucide="file-text"></i>
                                                        </a>
                                                        <a class="btn btn-secondary btn-sm"
                                                            href="/recfil?display=true&rf={{ urlencode($v->riplay) }}"
                                                            target="_blank">
                                                            <i data-lucide="file-text"></i>
                                                        </a>

                                                    </td>
                                                    <td>
                                                        <button dat-id="{{ $v->id }}" dat-urutan="{{ $v->urutan }}"
                                                            dat-title="{{ $v->title }}"
                                                            dat-kategori="{{ $v->kategori }}" dat-tag="{{ $v->tag }}"
                                                            dat-type="{{ $v->type }}" dat-content="{{ $v->content }}"
                                                            dat-banner="{{ $v->banner }}"
                                                            dat-thumbnail="{{ $v->thumbnail }}"
                                                            dat-brosur="{{ $v->brosur }}" dat-riplay="{{ $v->riplay }}"
                                                            dat-deskripsi="{{ $v->deskripsi }}"
                                                            onclick="openinputmodal($(this))" type="button"
                                                            class="btn btn-sm btn-warning">
                                                            <i data-lucide="edit"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-sm btn-danger"
                                                            onclick="deldata({{ $v->id }})">
                                                            <i data-lucide="trash"></i>
                                                        </button>
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
            <!-- END: PRODUK & LAYANAN -->
        </div>
    </div>
</div>

<!-- BEGIN: Modal Input -->
<form action="/salamprofit/produklayanan" method="post">
    <div id="modalInputProdukLayanan" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <!-- BEGIN: Modal Header -->
                <div class="modal-header">
                    <h2 class="font-medium text-base mr-auto">Produk & Layanan</h2>
                </div>
                <!-- END: Modal Header -->
                <!-- BEGIN: Modal Body -->
                <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                    <input id="hdnId" name="id" type="hidden" class="form-control">
                    <div class="col-span-12 sm:col-span-6">
                        <label for="txtType" class="form-label">Type</label>
                        <select id="txtType" name="type" class="form-control" onchange="setavailableradio()">
                            <option value="0">Produk</option>
                            <option value="1">Layanan</option>
                            <option value="2">Lainnya</option>
                        </select>
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <div>
                            <label for="slcKategori" class="form-label">Kategori</label>
                            <div class="flex flex-col sm:flex-row mt-2">
                                <div class="form-check mr-2">
                                    <input id="kategori0" class="form-check-input" type="radio" name="kategori"
                                        value="0">
                                    <label class="form-check-label" for="kategori0">Kredit</label>
                                </div>
                                <div class="form-check mr-2 mt-2 sm:mt-0">
                                    <input id="kategori1" class="form-check-input" type="radio" name="kategori"
                                        value="1">
                                    <label class="form-check-label" for="kategori1">Deposito</label>
                                </div>
                                <div class="form-check mr-2 mt-2 sm:mt-0">
                                    <input id="kategori2" class="form-check-input" type="radio" name="kategori"
                                        value="2">
                                    <label class="form-check-label" for="kategori2">Tabungan</label>
                                </div>
                                <div class="form-check mr-2 mt-2 sm:mt-0">
                                    <input id="kategori3" class="form-check-input" type="radio" name="kategori"
                                        value="3">
                                    <label class="form-check-label" for="kategori3">Layanan</label>
                                </div>
                                
                                <div class="form-check mr-2 mt-2 sm:mt-0">
                                    <input id="kategori4" class="form-check-input" type="radio" name="kategori"
                                        value="4">
                                    <label class="form-check-label" for="kategori4">Lainnya</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="txtTitle" class="form-label">Title</label>
                        <input id="txtTitle" name="title" type="text" class="form-control">
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="slcTag" class="form-label">Tag</label>
                        <select id="slcTag" data-header="Pilih/Tambah Tag" name="tag[]" class="tom-select w-full"
                            multiple>
                            @foreach ($tag as $v)
                            <option value="{{$v}}">{{$v}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-12 sm:col-span-12">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <input type="text" id="deskripsi" name="deskripsi" class="form-control">
                    </div>
                    <div class="col-span-12">
                        <hr>
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="filBanner" class="form-label">Banner</label>
                        <input id="filBanner" accept="image/*" type="file" name="banner" class="form-control"
                            dat-showpreview="true">
                    </div>
                 
                    <div class="col-span-12 sm:col-span-6">
                        <label for="filThumbnail" class="form-label">Thumbnail</label>
                        <input id="filThumbnail" accept="image/*" type="file" name="thumbnail" class="form-control"
                            dat-showpreview="true">
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="filbrosur" class="form-label">Brosur</label>
                        <input id="filbrosur" accept=".pdf,.doc,.docx" type="file" name="brosur" class="form-control"
                            dat-showpreview="true">
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="filriplay" class="form-label">RIPLAY</label>
                        <input id="filriplay" type="file" name="riplay" class="form-control" accept=".pdf,.doc,.docx" />

                    </div>
                       <div class="col-span-12 sm:col-span-6">
    <label for="txtUrutan" class="form-label">Urutan</label>
    <input id="txtUrutan" name="urutan" type="number" min="0" class="form-control" value="0">
</div>
                    <div class="col-span-12">
                        <hr>
                    </div>
                    <div class="col-span-12 mb-8">
                        <div id="quilldefaulteditor"></div>
                    </div>
                </div>
                <!-- END: Modal Body -->
                <!-- BEGIN: Modal Footer -->
                <div class="modal-footer">
                    <button type="button" data-tw-dismiss="modal"
                        class="btn btn-outline-secondary w-20 mr-1">Cancel</button>
                    <button type="button" class="btn btn-primary w-20" onclick="savedata()">Simpan</button>
                </div> <!-- END: Modal Footer -->
            </div>
        </div>
    </div>
</form>
<!-- END: Modal Input -->

<script>
    var quilldefaulteditor; 
    var inputmodal;
    $(document).ready(function () {
        inputmodal = tailwind.Modal.getOrCreateInstance(document.querySelector("#modalInputProdukLayanan"));
        // $('#slcTag').select2();
        setavailableradio();
    });
    function openinputmodal(t) {
    // Reset Form
    $('#hdnId').val('');
    $('#txtTitle').val('');
    $('#txtUrutan').val('0'); // Reset default urutan
    $('#txtType').val('0');
    $('#slcTag').val('');
    $('#filBanner').val('');
    $('#filThumbnail').val('');
    $('#filbrosur').val('');
    $('#filriplay').val('');
    $('#deskripsi').val('');
    $('input[name="kategori"]').prop('checked', false);
    
    if (document.querySelector('#slcTag').tomselect) {
        document.querySelector('#slcTag').tomselect.setValue('');
    }
    
    if (typeof quilldefaulteditor !== 'undefined') {
        quilldefaulteditor.setContents([]);
    }

    // Hapus preview lama
    $('.showpreviewfile').remove();

    if (t != null) {
        $('#hdnId').val(t.attr('dat-id'));
        $('#txtTitle').val(t.attr('dat-title'));
        $('#txtUrutan').val(t.attr('dat-urutan') ?? 0); // Set nilai urutan saat edit
        $('#txtType').val(t.attr('dat-type'));
        $('#deskripsi').val(t.attr('dat-deskripsi'));

        if (typeof quilldefaulteditor !== 'undefined') {
            quilldefaulteditor.clipboard.dangerouslyPasteHTML(
                t.attr('dat-content') ?? ''
            );
        }

        if (t.attr('dat-tag') && document.querySelector('#slcTag').tomselect) {
            document.querySelector('#slcTag').tomselect.setValue(
                JSON.parse(t.attr('dat-tag'))
            );
        }

        $('input[name="kategori"][value="' + t.attr('dat-kategori') + '"]').prop('checked', true);

        // Preview File
        if (t.attr('dat-banner')) {
            $('#filBanner').parent().append(
                `<img src="/recfil?rf=${t.attr('dat-banner')}" class="showpreviewfile mt-2" width="130">`
            );
        }

        if (t.attr('dat-thumbnail')) {
            $('#filThumbnail').parent().append(
                `<img src="/recfil?rf=${t.attr('dat-thumbnail')}" class="showpreviewfile mt-2" width="130">`
            );
        }

        if (t.attr('dat-brosur')) {
            $('#filbrosur').parent().append(
                `<a href="/recfil?rf=${t.attr('dat-brosur')}" target="_blank" class="showpreviewfile block mt-2">📄 Lihat Brosur</a>`
            );
        }

        if (t.attr('dat-riplay')) {
            $('#filriplay').parent().append(
                `<a href="/recfil?rf=${t.attr('dat-riplay')}" target="_blank" class="showpreviewfile block mt-2">📎 Lihat Riplay</a>`
            );
        }
    }

    setavailableradio();
    inputmodal.show();
}

function savedata() {
    var id = $('#hdnId').val();
    var titl = $('#txtTitle').val();
    var urutan = $('#txtUrutan').val(); // Ambil nilai urutan
    var type = $('#txtType').val();
    var tags = $('#slcTag').val();
    var ktgr = $('input[name="kategori"]:checked').val();
    var deskripsi = $('#deskripsi').val();
    var cntn = quilldefaulteditor ? quilldefaulteditor.getSemanticHTML() : '';

    var data = new FormData();

    data.append('id', id);
    data.append('title', titl);
    data.append('urutan', urutan); // Kirim parameter urutan ke backend
    data.append('type', type);
    data.append('tag', tags);
    data.append('kategori', ktgr);
    data.append('content', cntn);
    data.append('deskripsi', deskripsi);
    
    if ($('#filBanner')[0].files[0]) data.append('filebanner', $('#filBanner')[0].files[0]);
    if ($('#filThumbnail')[0].files[0]) data.append('filethumbnail', $('#filThumbnail')[0].files[0]);
    if ($('#filbrosur')[0].files[0]) data.append('filbrosur', $('#filbrosur')[0].files[0]);
    if ($('#filriplay')[0].files[0]) data.append('filriplay', $('#filriplay')[0].files[0]);

    $.ajax({
        url: '/salamprofit/produklayanan',
        data: data,
        headers: {
            'X-CSRF-Token': csrf_token 
        },
        cache: false,
        contentType: false,
        processData: false,
        method: 'POST',
        type: 'POST',
        success: function(data){
            location.reload();
        },
        error: function(xhr){
            if (xhr.status == 401) {
                alert(xhr.responseText);
            }
        }
    });
}

    function deldata(id) {
        if (confirm('Hapus Data?')) {
            $.ajax({
                type: "DELETE",
                url: "/salamprofit/produklayanan/" + id,
                headers: {
                    'X-CSRF-Token': csrf_token 
                },
                success: function(data){
                    alert('Berhasil Hapus Data')
                    location.reload();
                },
                error: function(xhr){
                    if (xhr.status == 401) {
                        alert(xhr.responseText);
                    } else {
                        alert(xhr.status);
                    }
                }
            });
        }
    }

    function setavailableradio() {
        var typ = $('#txtType').val();
        
        var showarr = [];
        var cekdef = 4;
        if (typ == 0) {
            showarr = [0,1,2];
            cekdef = 0;
        }
        if (typ == 1) {
            showarr = [3];
            cekdef = 3;
        }
        if (typ == 2) {
            showarr = [4];
        }
        console.log(showarr);
        $('input[name="kategori"][value="' + cekdef + '"]').prop('checked', true);
        $('input[name="kategori"]').parent('.form-check').hide();
        $('input[name="kategori"]').each(function (index, element) {
            if (showarr.includes(Number($(this).val()))) {
                $(this).parent('.form-check').show();
            }
        });
    }
</script>
@endsection