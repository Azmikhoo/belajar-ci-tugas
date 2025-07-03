<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h4>Pembelian</h4>

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif ?>

    <table class="table datatable">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>ID Pembelian</th>
                <th>Username</th>
                <th>Waktu Pembelian</th>
                <th>Total Bayar</th>
                <th>Alamat</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($transactions as $i => $item) : ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= $item['id'] ?></td>
                    <td><?= $item['username'] ?></td>
                    <td><?= $item['created_at'] ?></td>
                    <td>IDR <?= number_format($item['total_harga'], 0, ',', '.') ?></td>
                    <td><?= esc($item['alamat']) ?></td>
                    <td>
                        <?php if ($item['status'] == 1) : ?>
                            <span class="badge bg-success">Sudah Selesai</span>
                        <?php else : ?>
                            <span class="badge bg-danger">Belum Selesai</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <!-- Tombol Ubah Status -->
                        <a href="<?= base_url('pembelian/ubah/' . $item['id']) ?>" class="btn btn-warning btn-sm">Ubah Status</a>
                        <!-- Tombol Detail -->
                        <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal<?= $item['id'] ?>">Detail</button>
                    </td>
                </tr>

                <!-- Detail Modal -->
                <div class="modal fade" id="detailModal<?= $item['id'] ?>" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Detail Data</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                            </div>
                            <div class="modal-body">
                                <?php if (!empty($item['detail'])): ?>
                                    <?php foreach ($item['detail'] as $index2 => $item2): ?>
                                        <?= $index2 + 1 ?>)
                                        <?php if (!empty($item2['foto']) && file_exists(FCPATH . "img/" . $item2['foto'])): ?>
                                            <img src="<?= base_url("img/" . $item2['foto']) ?>" width="100px">
                                        <?php endif; ?>
                                        <strong><?= $item2['nama'] ?></strong>
                                        <?= number_to_currency((float) $item2['harga'], 'IDR') ?><br>
                                        (<?= $item2['jumlah'] ?> pcs)<br>
                                        <?= number_to_currency((float) $item2['subtotal_harga'], 'IDR') ?>
                                        <hr>
                                    <?php endforeach; ?>
                                    Ongkir <?= number_to_currency((float) $item['ongkir'], 'IDR') ?>
                                <?php else: ?>
                                    <p>Tidak ada detail transaksi.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Detail Modal -->
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>