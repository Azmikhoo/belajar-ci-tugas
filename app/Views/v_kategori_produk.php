<?= $this->extend('layout') ?>
<?= $this->section('content') ?> 

<?php if (session()->getFlashData('success')) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashData('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashData('failed')) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= session()->getFlashData('failed') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<section class="section">
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addModal">
        Tambah Data
    </button>

    <table class="table datatable">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($kategori as $index => $kat) : ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><?= esc($kat['nama']) ?></td>
                    <td>
                        <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editModal-<?= $kat['id'] ?>">Ubah</button>
                        <a href="<?= base_url('kategori/delete/' . $kat['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</section>

<!-- Modal Tambah -->
<div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="<?= base_url('kategori') ?>" method="post" class="modal-content">
            <?= csrf_field(); ?>
            <div class="modal-header">
                <h5 class="modal-title">Tambah Kategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="form-group mb-3">
                    <label>Nama Kategori</label>
                    <input type="text" name="nama" class="form-control" placeholder="Masukkan nama kategori" required>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button class="btn btn-primary" type="submit">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Modals Edit -->
<?php foreach ($kategori as $kat) : ?>
    <div class="modal fade" id="editModal-<?= $kat['id'] ?>" tabindex="-1" aria-labelledby="editModalLabel-<?= $kat['id'] ?>" aria-hidden="true">
        <div class="modal-dialog">
            <form action="<?= base_url('kategori/edit/' . $kat['id']) ?>" method="post" class="modal-content">
                <?= csrf_field(); ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel-<?= $kat['id'] ?>">Edit Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label>Nama Kategori</label>
                        <input type="text" name="nama" class="form-control" value="<?= esc($kat['nama']) ?>" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
<?php endforeach ?>

<?= $this->endSection() ?>
