{{--
    Partial View: lab-card.blade.php
    Dipakai di: guest/laboratorium.blade.php
    Variable: $lab (object dari DB)
--}}
<div class="col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
    <div class="team-item rounded overflow-hidden h-100">
        <div class="d-flex align-items-center p-4"
             style="background: linear-gradient(135deg, #0563bb 0%, #1e40af 100%);">
            <div class="flex-shrink-0 me-3">
                <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold"
                     style="width:60px;height:60px;font-size:1.4rem;background:rgba(255,255,255,0.2);">
                    <i class="fa fa-flask"></i>
                </div>
            </div>
            <div>
                <h5 class="text-white mb-1">{{ $lab->nama_lab }}</h5>
                <small class="text-white-50">
                    <span class="badge bg-light text-dark me-1">{{ $lab->kode_lab }}</span>
                    @if ($lab->status === 'aktif')
                        <span class="badge bg-success">Aktif</span>
                    @else
                        <span class="badge bg-warning text-dark">Maintenance</span>
                    @endif
                </small>
            </div>
        </div>
        <div class="bg-light p-4 flex-grow-1">
            <div class="row g-2 mb-3">
                <div class="col-6">
                    <small class="text-muted d-block"><i class="fa fa-map-marker-alt me-1 text-primary"></i>Lokasi</small>
                    <span class="fw-semibold small">{{ $lab->lokasi }}</span>
                </div>
                <div class="col-6">
                    <small class="text-muted d-block"><i class="fa fa-users me-1 text-primary"></i>Kapasitas</small>
                    <span class="fw-semibold small">{{ $lab->kapasitas }} orang</span>
                </div>
                <div class="col-12">
                    <small class="text-muted d-block"><i class="fa fa-user-tie me-1 text-primary"></i>Penanggung Jawab</small>
                    <span class="fw-semibold small">{{ $lab->penanggung_jawab }}</span>
                </div>
                @if ($lab->deskripsi)
                <div class="col-12">
                    <small class="text-muted">{{ Str::limit($lab->deskripsi, 90) }}</small>
                </div>
                @endif
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <span class="badge bg-primary">
                    <i class="fa fa-calendar me-1"></i>{{ $lab->jadwals_count }} Jadwal
                </span>
                <a href="{{ route('guest.laboratorium.show', $lab->id) }}"
                   class="btn btn-sm btn-outline-primary">
                    Lihat Jadwal <i class="fa fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>
</div>
