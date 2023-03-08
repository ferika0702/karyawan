<form autocomplete="off" class="row g-3 mt-2" action="<?= site_url() ?>karyawan/ <?=$karyawan['id']?>" method="POST" id="form">

    <?= csrf_field() ?>
    
    <input type="hidden" name="_method" value="<?= $karyawan['id'];?>">

    <div class="row mb-3">
        <label for="nik" class="col-sm-3 col-form-label">Nik</label>
        <div class="col-sm-9">
            <input type="number" class="form-control" id="nik" name="nik" value="<?= $karyawan['nik'];?>">
            <div class="invalid-feedback error-nik"></div>
        </div>
    </div>

    <div class="row mb-3">
        <label for="nama_lengkap" class="col-sm-3 col-form-label">Nama Lengkap</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?= $karyawan['nama_lengkap'];?>">
            <div class="invalid-feedback error-nama_lengkap"></div>
        </div>
    </div>

    <div class="row mb-3">
        <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $karyawan['alamat'];?>">
            <div class="invalid-feedback error-alamat"></div>
        </div>
    </div>

    <div class="row mb-3">
        <label for="jenis_kelamin" class="col-sm-3 col-form-label">Jenis Kelamin</label>
        <div class="col-sm-9">
            <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                <option value="<?= $karyawan['jenis_kelamin'];?>"></option>
                <option value="LAKI-LAKI">Laki-Laki</option>
                <option value="PEREMPUAN">Perempuang</option>
            </select>
            <div class="invalid-feedback error-jenis_kelamin"></div>
        </div>
    </div>

    <div class="row mb-3">
        <label for="tempat_lahir" class="col-sm-3 col-form-label">Tempat Lahir</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="<?= $karyawan['tempat_lahir'];?>">
            <div class="invalid-feedback error-tempat_lahir"></div>
        </div>
    </div>

    <div class="row mb-3">
        <label for="tanggal_lahir" class="col-sm-3 col-form-label">Tanggal Lahir</label>
        <div class="col-sm-9">
            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?= $karyawan['tanggal_lahir'];?>">
            <div class="invalid-feedback error-tanggal_lahir"></div>
        </div>
    </div>

    <div class="row mb-3">
        <label for="agama" class="col-sm-3 col-form-label">Agama</label>
        <div class="col-sm-9">
            <select class="form-control" name="agama" id="agama">
                <option value="<?= $karyawan['agama'];?>"></option>
                <option value="ISLAM">Islam</option>
                <option value="KATOLIK">Katolik</option>
                <option value="KRISTEN">Kristen</option>
                <option value="HINDU">Hindu</option>
                <option value="BUDHA">Budha</option>
                <option value="KHONGHUCU">Khonghucu</option>
            </select>
            <div class="invalid-feedback error-agama"></div>
        </div>
    </div>

    <div class="row mb-3">
        <label for="pendidikan" class="col-sm-3 col-form-label">Pendidikan</label>
        <div class="col-sm-9">
            <select class="form-control" name="pendidikan" id="pendidikan">
                <option value="<?= $karyawan['pendidikan'];?>"></option>
                <option value="SD">SD</option>
                <option value="SMP">SMP</option>
                <option value="SMA/SMK">SMA/SMK</option>
                <option value="D I">D I</option>
                <option value="D II">D II</option>
                <option value="D II">D III</option>
                <option value="D IV/S1">D IV/S1</option>
            </select>
            <div class="invalid-feedback error-pendidikan"></div>
        </div>
    </div>

    <div class="row mb-3">
        <label for="no_telp" class="col-sm-3 col-form-label">No Telepon</label>
        <div class="col-sm-9">
            <input type="number" class="form-control" id="no_telp" name="no_telp" value="<?= $karyawan['no_telp'];?>">
            <div class="invalid-feedback error-no_telp"></div>
        </div>
    </div>

    <div class="row mb-3">
        <label for="email" class="col-sm-3 col-form-label">Email</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="email" name="email" value="<?= $karyawan['email'];?>">
            <div class="invalid-feedback error-email"></div>
        </div>
    </div>

    <div class="col-md-9 offset-3 mb-3">
        <button id="#tombolUpdate" class="btn px-5 btn-outline-primary" type="submit">Update<i class="fa-fw fa-solid fa-check"></i></button>
    </div>
</form>

<?= $this->include('MyLayout/js') ?>


<script>
    $(document).ready(function() {
        $('#tabel').DataTable();

        // Alert
        var op = <?= (!empty(session()->getFlashdata('pesan')) ? json_encode(session()->getFlashdata('pesan')) : '""'); ?>;
        if (op != '') {
            Toast.fire({
                icon: 'success',
                title: op
            })
        }
    });

     // Bahan Alert
     const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 5000,
        timerProgressBar: true,
        background: '#EC7063',
        color: '#fff',
        iconColor: '#fff',
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })
</script>