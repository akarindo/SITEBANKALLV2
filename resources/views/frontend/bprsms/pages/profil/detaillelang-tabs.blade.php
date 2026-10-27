<div class="sms-detail-content">
    <ul class="nav nav-tabs" id="smsDetailTab" role="tablist">
        <li class="nav-item" role="presentation"><button class="nav-link active" id="sms-uraian-tab" data-bs-toggle="tab" data-bs-target="#sms-uraian" type="button" role="tab">Uraian</button></li>
        <li class="nav-item" role="presentation"><button class="nav-link" id="sms-lampiran-tab" data-bs-toggle="tab" data-bs-target="#sms-lampiran" type="button" role="tab">Lampiran</button></li>
        @if (!$isAsset)
            <li class="nav-item" role="presentation"><button class="nav-link" id="sms-kodelot-tab" data-bs-toggle="tab" data-bs-target="#sms-kodelot" type="button" role="tab">Kode Lot</button></li>
        @endif
        <li class="nav-item" role="presentation"><button class="nav-link" id="sms-penyelenggara-tab" data-bs-toggle="tab" data-bs-target="#sms-penyelenggara" type="button" role="tab">Info Penyelenggara</button></li>
    </ul>
    <div class="tab-content" id="smsDetailTabContent">
        <div class="tab-pane fade show active sms-detail-tab-pane" id="sms-uraian" role="tabpanel" aria-labelledby="sms-uraian-tab">{!! $lelang->uraian ?: '<p>Belum ada uraian tersedia.</p>' !!}</div>
        <div class="tab-pane fade sms-detail-tab-pane" id="sms-lampiran" role="tabpanel" aria-labelledby="sms-lampiran-tab">{!! $lelang->lampiran ?: '<p>Belum ada lampiran tersedia.</p>' !!}</div>
        @if (!$isAsset)
            <div class="tab-pane fade sms-detail-tab-pane" id="sms-kodelot" role="tabpanel" aria-labelledby="sms-kodelot-tab"><p>{{ $lelang->kode_lot ?: '-' }}</p></div>
        @endif
        <div class="tab-pane fade sms-detail-tab-pane" id="sms-penyelenggara" role="tabpanel" aria-labelledby="sms-penyelenggara-tab"><p>{{ $lelang->penyelenggara ?: '-' }}</p></div>
    </div>
</div>
