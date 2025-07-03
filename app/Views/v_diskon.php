<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<?php if (session()->getFlashData('success')) : ?>
    <div class="alert alert-info alert-dismissible fade show" role="alert">
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

<h4>Manajemen Diskon</h4>

<button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addModal">Tambah Data</button>

<table class="table datatable">
    <thead>
        <tr>
            <th>#</th>
            <th>Tanggal</th>
            <th>Nominal</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($diskonList)) : ?>
            <?php foreach ($diskonList as $i => $d): ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= $d['tanggal'] ?></td>
                    <td>Rp<?= number_format($d['nominal'], 0, ',', '.') ?></td>
                    <td>
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editModal-<?= $d['id'] ?>">Ubah</button>
                        <a href="<?= base_url('diskon/delete/' . $d['id']) ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                    </td>
                </tr>

                <!-- Edit Modal -->
                <div class="modal fade" id="editModal-<?= $d['id'] ?>" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="<?= base_url('diskon/save') ?>" method="post">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="id" value="<?= $d['id'] ?>">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Diskon</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                </div>
                                <div class="modal-body">
                                    <label>Tanggal</label>
                                    <input readonly type="date" name="tanggal" class="form-control" value="<?= $d['tanggal'] ?>" required>
                                    <label>Nominal</label>
                                    <input type="number" name="nominal" class="form-control" value="<?= $d['nominal'] ?>" required>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    <button class="btn btn-primary" type="submit">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- End Edit Modal -->
            <?php endforeach ?>
        <?php else: ?>
            <tr><td colspan="4" class="text-center">Belum ada data diskon.</td></tr>
        <?php endif; ?>
    </tbody>
</table>

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= base_url('diskon/save') ?>" method="post">
                <?= csrf_field(); ?>
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Diskon</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <label>Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" required>
                    <label>Nominal</label>
                    <input type="number" name="nominal" class="form-control" required>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
