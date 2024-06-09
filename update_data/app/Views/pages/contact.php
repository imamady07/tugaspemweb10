<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class=container>
    <div class="row">
        <div class="col">
            <h2>Hubungi Kami</h2>

            <?php foreach ($alamat as $a) : ?>
                <ul>
                    <li><?= esc($a['tipe']); ?></li>
                    <li><?= esc($a['alamat']); ?></li>
                    <li><?= esc($a['kota']); ?></li>
                </ul>
            <?php endforeach; ?>

        </div>
    </div>
</div>
<?= $this->endSection(); ?>