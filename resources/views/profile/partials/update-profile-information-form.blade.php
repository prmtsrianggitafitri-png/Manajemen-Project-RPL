<div class="container mx-auto py-8 flex flex-col md:flex-row gap-6">

    <div class="w-full md:w-1/3">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-bold mb-4">Informasi Profil</h2>
                <div class="mb-3">
                    <label class="text-muted small d-block">Nama Lengkap</label>
                    <p class="fw-semibold mb-0">{{ $user->nama }}</p>
                </div>
                <div class="mb-3">
                    <label class="text-muted small d-block">NIM</label>
                    <p class="fw-semibold mb-0">{{ $user->nim ?? '220101xxx' }}</p>
                </div>
                <div class="mb-0">
                    <label class="text-muted small d-block">Tahun Masuk</label>
                    <p class="fw-semibold mb-0">{{ $user->tahun_masuk ?? '2022' }}</p>
                </div>
        </div>
    </div>
</div>