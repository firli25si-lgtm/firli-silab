{{--
    Partial View: jadwal-row.blade.php
    Dipakai di: guest/laboratorium-detail.blade.php
    Variable: $jadwal (object dari Query Builder)
--}}
<tr>
    <td>
        <span class="badge"
              style="background-color: #0563bb;">
            {{ $jadwal->hari }}
        </span>
    </td>
    <td>
        <i class="fa fa-clock text-muted me-1"></i>
        {{ substr($jadwal->jam_mulai, 0, 5) }} – {{ substr($jadwal->jam_selesai, 0, 5) }}
    </td>
    <td class="fw-semibold">{{ $jadwal->mata_kuliah }}</td>
    <td>{{ $jadwal->dosen_pengampu }}</td>
    <td>
        <span class="badge bg-light text-dark border">
            <i class="fa fa-users me-1"></i>{{ $jadwal->kapasitas_peserta }} peserta
        </span>
    </td>
    <td>{{ $jadwal->keterangan ?? '-' }}</td>
</tr>
