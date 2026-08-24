import fs from 'fs';
import path from 'path';
import sharp from 'sharp';
import { fileURLToPath } from 'url';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

const sourceDir = path.resolve(__dirname, '../public/images/dokumentasi-pekerjaan');
const targetDir = path.resolve(__dirname, '../public/images/dokumentasi');

if (!fs.existsSync(targetDir)) {
    fs.mkdirSync(targetDir, { recursive: true });
    console.log(`Created target directory: ${targetDir}`);
}

const fileMap = {
    "AFTER GUTTER YANG SUDAH DI BERSIHKAN OLEH TEKNISI ROOTERA PLUMBING.jpeg": "after-pembersihan-talang-gutter-rootera.webp",
    "AFTER SETELAH GUTTER YANG SUDAH DI BERSIHKAN OLEH TEKNISI ROOTERA PLUMBING.jpeg": "after-gutter-resto-bersih-rootera.webp",
    "INSPEKSI CEK SALURAN DALAM KLOSET MENGGUNAKAN MESIN KAMERA CCTV UNTUK MELIHAT PENYEBAB MAMPET SALURAN KLOSET.jpeg": "inspeksi-cctv-saluran-kloset-mampet.webp",
    "INSPEKSI SALURAN PIPA MENGGUNAKAN KAMERA CCTV MELIHAT KONDISI PIPA YANG TERSUMBAT.jpeg": "inspeksi-kamera-cctv-pipa-tersumbat.webp",
    "inspeksi-saluran-pipa-floor-drain-menggunakan-kamera-cctv-kantor-pertamina-sunter.jpeg": "inspeksi-cctv-floor-drain-pertamina-sunter.webp",
    "Pelancar Drainase Kitchen Resto di Soichiro Japanese Steakhouse Jakarta  Rootera Plumbing.png": "pelancaran-drainase-kitchen-soichiro-steakhouse-jakarta.webp",
    "Pelancar Floor Drain Kamar Mandi Mampet di EM Gelato Blok M  Rootera Plumbing.jpg": "pelancaran-floor-drain-em-gelato-blok-m.webp",
    "PELANCAR SALURAN FLOOR DRAIN KAMAR MANDI MAMPET ROOTERA PLUMBING.jpeg": "pelancar-floor-drain-kamar-mandi-rumah.webp",
    "PELANCAR SALURAN FLOOR DRAIN KAMAR MANDI MAMPET RUMAH WARGA ROOTERA PLUMBING.jpeg": "pelancaran-saluran-floor-drain-residensial.webp",
    "PELANCAR SALURAN GUTTER RESTO MAMPET ROOTERA PLUMBING.jpg": "pelancar-saluran-gutter-resto-jakarta.webp",
    "PELANCAR SALURAN KLOSET KAMAR MANDI MAMPET ROOTERA PLUMBING.jpg": "pelancar-saluran-kloset-toilet-mampet.webp",
    "PELANCAR SALURAN MAMPET PADA RESTO ROOTERA PLUMBING.jpg": "pelancaran-saluran-mampet-area-resto.webp",
    "PELANCAR SALURAN PIPA MENGGUNAKAN MESIN DRAIN CLEANER OLEH TEKNISI ROOTERA PLUMBING.jpeg": "mesin-drain-cleaner-pelancar-pipa.webp",
    "PELANCARAN SALURAN FLOOR DRAIN KAMAR MANDI MENGGUNAKAN MESIN RIDGID DAN SPIRAL OLEH TEKNISI ROOTERA PLUMBING.jpeg": "proses-ridgid-spiral-floor-drain.webp",
    "PELANCARAN SALURAN GUTTER RESTO DI JAKARTA DILAKUKAN OLEH TEKNISI ROOTERA PLUMBING.jpeg": "proses-pelancaran-gutter-restoran-jakarta.webp",
    "PELANCARAN SALURAN MAMPET STASIUN KAI OLEH TEKNISI ROOTERA PLUMBING DI DAERAH JAWA.jpeg": "proyek-pelancaran-saluran-stasiun-kai-1.webp",
    "PEMBERSIH DAN PELANCARAN SALURAN BAK KONTROL RESTO YANG MAMPET TOTAL KARENA ADANYA LEMAK DAN SAMPAH DI LANCARKAN KEMBALI OLEH TEKNISI ROOTERA PLUMBING SOLUSI TUNTAS SALURAN BERKUALITAS.jpeg": "pembersihan-lemak-bak-kontrol-resto.webp",
    "PROSES RIDGID PELANCAR SALURAN GUTTER MAMPET DI RESTORAN SEPORSI MIE KARI JAKARTA DIKERJAKAN OLEH TEKNISI ROOTERA PLUMBING.jpeg": "pelancaran-gutter-seporsi-mie-kari-jakarta.webp",
    "RIDGID PELANCAR SALURAN FLOOR DRAIN KAMAR MANDI MENGGUNAKAN MESIN RIDGID DAN SPIRAL ROOTERA PLUMBING.jpeg": "pelancar-mesin-ridgid-floor-drain-kamar-mandi.webp",
    "RIDGID SALURAN BAK KONTROL MAMPET ROOTERA PLUMBING.jpeg": "pelancaran-bak-kontrol-mesin-ridgid.webp",
    "RIDGID SALURAN BAK KONTROL YANG MAMPET KARENA ADA NYA SAMPAH PLASTIK DAN LEMAK YANG MENUMPUK DAN MENGGANGGU OPERASIONAL RESTORAN MAKA DARI ITU ROOTERA HADIR SEBAGAI SOLUSI UNTUK BISNIS ANDA.jpeg": "penanganan-bak-kontrol-lemak-sampah-resto.webp",
    "RIDGID SALURAN PELANCAR SALURAN GUTTER RESTO MAMPET ROOTERA PLUMBING.jpeg": "servis-ridgid-gutter-resto-mampet.webp",
    "RIDGID SALURAN STASIUN KAI MAMPET DIKERJAKAN OLEH ROOTERA PLUMBING DI DAERAH JAWA TENGAH.jpeg": "proyek-pelancaran-stasiun-kai-jateng-2.webp",
    "RIDGID SALURAN STASIUN KAI YANG MAMPET OLEH ROOTERA PLUMBING DI JAWA TENGAH.jpeg": "penanganan-saluran-stasiun-kai-jateng-3.webp",
    "RIDGID SALURAN WASTAFEL MAMPET MENGGUNAKAN MESIN RIDGID DAN SPIRAL DI LAKUKAN OLEH TEKNISI ROOTERA PLUMBING YANG BERPENGALAMAN DAN PROFESIONAL.jpeg": "teknisi-pelancar-wastafel-mesin-ridgid.webp",
    "RIDGID SALURAN WASTAFEL MAMPET MENGGUNAKAN MESIN RIDGID DRAIN CLEANER DAN SPIRAL BAJA DILAKUKAN OLEH TEKNISI ROOTERA PLUMBING.jpeg": "drain-cleaner-spiral-baja-wastafel.webp",
    "ROOTERA PLUMBING HADIR SEBAGAI MOMENTUM DI BUTUHKAN NYA PELANCAR SALURAN MAMPET DI STASIUN JAWA TENGAH.jpeg": "dokumentasi-proyek-stasiun-kai-jateng-4.webp",
    "ROOTERA PLUMBING MENGERJAKAN SALURAN MAMPET DI STASIUN DI JAWA TENGAH.jpeg": "teknisi-rootera-stasiun-kai-jateng.webp",
    "ROOTERA PLUMBING PELANCAR SALURAN BAK KONTROL PERUMAHAN WARGA DENGAN BERSIH AMAN CEPAT DAN PROFESIONAL.jpg": "pelancar-bak-kontrol-perumahan-warga.webp",
    "ROOTERA PLUMBING PELANCAR SALURAN FLOOR DRAIN KAMAR MANDI MENGGUNAKAN MESIN RIDGID DAN SPIRAL DI PERTAMINA SUNTER.jpeg": "pelancar-saluran-pertamina-sunter-jakarta.webp",
    "ROOTERA PLUMBING PELANCAR SALURAN KLOSET KAMAR MANDI MENGGUNAKAN MESIN RIDGID DAN SPIRAL BAJA DI LAKUKAN TEKNISI ROOTERA PLUMBING YANG BERPENGALAMAN.jpeg": "pelancaran-kloset-spiral-baja-profesional.webp",
    "ROOTERA PLUMBING PELANCAR SALURAN RESTO MAMPET JABODETABEK.jpg": "layanan-pelancar-saluran-resto-jabodetabek.webp",
    "ROOTERA PLUMBING RIDGID SALURAN GREASE TRAP RESTORAN.jpg": "pembersihan-grease-trap-restoran.webp",
    "SALURAN BAK KONTROL RESTO YANG MAMPET MENGHAMBAT AKTIVITAS OPERASIONAL RESTO JADI PENGHAMBAT MAKA DARI ITU ROOTERA HADIR SEBAGAI SOLUSI MENANGANI SALURAN MAMPET SAMPAI LANCAR.jpeg": "solusi-bak-kontrol-mampet-operasional-resto.webp",
    "TEKNISI ROOTERA BERPAKAIAN APD LENGKAP UNTUK MENGERJAKAN DI SALAH SATU PABRIK MAKANAN TERNAMA DI INDONESIA MENGERJAKAN SALURAN SINK YANG MAMPET.jpeg": "teknisi-apd-lengkap-sink-pabrik-makanan.webp",
    "inspeksi_saluran_wastafel_mampet_rootera_plumbing.mp4": "video-inspeksi-cctv-wastafel.mp4"
};

async function processAssets() {
    const filesInDir = fs.readdirSync(sourceDir);
    let successCount = 0;
    let errorCount = 0;

    console.log(`Starting asset processing for ${Object.keys(fileMap).length} files...\n`);

    for (const [origName, newName] of Object.entries(fileMap)) {
        // Handle potential space mismatches or long filename truncation on Windows
        let actualFile = filesInDir.find(f => f.trim().toLowerCase() === origName.trim().toLowerCase());
        
        if (!actualFile) {
            const prefix = origName.substring(0, 35).toLowerCase();
            actualFile = filesInDir.find(f => f.toLowerCase().startsWith(prefix));
        }

        if (!actualFile) {
            console.error(`❌ Source file not found: "${origName}"`);
            errorCount++;
            continue;
        }

        const rawSrc = path.join(sourceDir, actualFile);
        const rawDest = path.join(targetDir, newName);
        const srcPath = process.platform === 'win32' && !rawSrc.startsWith('\\\\?\\') ? '\\\\?\\' + rawSrc : rawSrc;
        const destPath = process.platform === 'win32' && !rawDest.startsWith('\\\\?\\') ? '\\\\?\\' + rawDest : rawDest;

        try {
            if (newName.endsWith('.mp4')) {
                fs.copyFileSync(srcPath, destPath);
                console.log(`📹 Copied Video: ${actualFile} -> ${newName}`);
            } else {
                await sharp(srcPath)
                    .webp({ quality: 83 })
                    .toFile(destPath);
                console.log(`✅ Converted WebP: ${actualFile} -> ${newName}`);
            }
            successCount++;
        } catch (err) {
            console.error(`❌ Failed processing ${actualFile}: ${err.message}`);
            errorCount++;
        }
    }

    console.log(`\n========================================`);
    console.log(`Summary: ${successCount} successful, ${errorCount} errors.`);
    console.log(`Target folder: ${targetDir}`);
    console.log(`========================================`);
}

processAssets();
