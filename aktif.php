   <!-- navigasi -->
        <!-- Navigasi Halaman Sebelumnya -->
        <?php if ($halamanAktif > 1) : ?>
            <a href="?halaman=<?php echo $halamanAktif - 1; ?>">&lt;</a>
        <?php endif; ?>

        <!-- Navigasi Halaman -->
        <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
            <?php if ($i == $halamanAktif) : ?>
                <a href="?halaman=<?php echo $i; ?>" style="font-weight: bold;"><?php echo $i; ?></a>
            <?php else : ?>
                <a href="?halaman=<?php echo $i; ?>"><?php echo $i; ?></a>
            <?php endif; ?>
        <?php endfor; ?>

        <!-- Navigasi Halaman Berikutnya -->
        <?php if ($halamanAktif < $jumlahHalaman) : ?>
            <a href="?halaman=<?php echo $halamanAktif + 1; ?>">&gt;</a>
        <?php endif; ?>
