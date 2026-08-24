import fs from 'fs';
import path from 'path';
import sharp from 'sharp';
import { fileURLToPath } from 'url';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

const sourceDir = path.resolve(__dirname, '../public/images/dokumentasi-pekerjaan');
const targetImgDir = path.resolve(__dirname, '../public/images/dokumentasi');
const targetVideoDir = path.resolve(__dirname, '../public/videos/dokumentasi');

if (!fs.existsSync(targetImgDir)) {
    fs.mkdirSync(targetImgDir, { recursive: true });
}

if (!fs.existsSync(targetVideoDir)) {
    fs.mkdirSync(targetVideoDir, { recursive: true });
    console.log(`Created video directory: ${targetVideoDir}`);
}

const batch2Map = {
    "BEFORE GUTTER.jpeg": { dest: "before-pembersihan-talang-gutter.webp", type: "image" },
    "INSPEKSI SALURAN PIPA MENGGUNAKAN KAMERA CCTV DI KANTORAN JAKARTA OLEH ROOTERA PLUMBING.mp4": { dest: "video-inspeksi-cctv-gedung-kantor-jakarta.mp4", type: "video" },
    "KONDISI PIPA RESTO MALL YANG PENUH DENGAN LEMAK DAN MENGAKIBATKANNYA MAMPET.jpeg": { dest: "kondisi-pipa-lemak-resto-mall-tersumbat.webp", type: "image" },
    "PELANCARAN SALURAN GUTTER YANG MAMPET TOTAL DIKARENAKAN PENUMPUKAN LEMAK PADA RESTORAN SUSHI TEI.mp4": { dest: "video-pelancaran-gutter-lemak-sushi-tei.mp4", type: "video" },
    "PELANCARAN SALURAN MAMPET PADA AREA STASIUN TUGU DILAKUKAN OLEH TEKNISI ROOTERA PLUMBING.mp4": { dest: "video-pelancaran-saluran-stasiun-tugu-yogyakarta.mp4", type: "video" },
    "PELANCARAN SALURAN MAMPET PADA KLOSET MAMPET DI PABRIK OLEH ROOTERA PLUMBING.jpeg": { dest: "pelancaran-kloset-mampet-pabrik-industri.webp", type: "image" },
    "PELANCARAN SALURAN MAMPET PADA MALL BANJARMASIN DI KERJAKAN OLEH TEKNISI ROOTERA PLUMBING.jpeg": { dest: "pelancaran-saluran-mampet-mall-banjarmasin-1.webp", type: "image" },
    "PELANCARAN SALURAN WASTAFEL PADA RUMAH WARGA OLEH TIM TEKNISI ROOTERA PLUMBING YANG AHLI DAN PROFESIONAL.jpeg": { dest: "pelancaran-wastafel-mampet-rumah-warga.webp", type: "image" },
    "PENGERJAAN PELANCARAN SALURAN BIO TANK YANG MAMPET OLEH TEKNISI AHLI ROOTERA PLUMBING PENGERJAAN DI BOGOR JAWA BARAT.jpeg": { dest: "pelancaran-saluran-bio-tank-bogor-jabar.webp", type: "image" },
    "RIDGID PELANCARAN SALURAN KLOSET MAMPET DI PABRIK JAWA BARAT OLEH ROOTERA PLUMBING.mp4": { dest: "video-ridgid-saluran-kloset-pabrik-jabar.mp4", type: "video" },
    "RIDGID SALURAN GUTTER RESTO SEPORSI MIE KARI MENGGUNAKAN MESIN DRAIN CLEANER DAN SPIRAL ROOTERA PLUMBING.mp4": { dest: "video-ridgid-drain-cleaner-gutter-mie-kari.mp4", type: "video" },
    "RIDGID SALURAN MAMPET PADA MALL BANJARMASIN OLEH ROOTERA PLUMBING.jpeg": { dest: "pelancaran-saluran-mall-banjarmasin-mesin-ridgid-2.webp", type: "image" }
};

async function processBatch2() {
    const filesInDir = fs.readdirSync(sourceDir);
    let successCount = 0;
    let errorCount = 0;

    console.log(`Starting Batch 2 asset processing for ${Object.keys(batch2Map).length} files...\n`);

    for (const [origName, info] of Object.entries(batch2Map)) {
        let actualFile = filesInDir.find(f => f.trim().toLowerCase() === origName.trim().toLowerCase());

        if (!actualFile) {
            const prefix = origName.substring(0, 30).toLowerCase();
            actualFile = filesInDir.find(f => f.toLowerCase().startsWith(prefix));
        }

        if (!actualFile) {
            console.error(`❌ Source file not found: "${origName}"`);
            errorCount++;
            continue;
        }

        const rawSrc = path.join(sourceDir, actualFile);
        const targetFolder = info.type === 'video' ? targetVideoDir : targetImgDir;
        const rawDest = path.join(targetFolder, info.dest);

        const srcPath = process.platform === 'win32' && !rawSrc.startsWith('\\\\?\\') ? '\\\\?\\' + rawSrc : rawSrc;
        const destPath = process.platform === 'win32' && !rawDest.startsWith('\\\\?\\') ? '\\\\?\\' + rawDest : rawDest;

        try {
            if (info.type === 'video') {
                fs.copyFileSync(srcPath, destPath);
                console.log(`📹 Copied Video: ${actualFile} -> videos/dokumentasi/${info.dest}`);
            } else {
                await sharp(srcPath)
                    .webp({ quality: 83 })
                    .toFile(destPath);
                console.log(`✅ Converted WebP: ${actualFile} -> images/dokumentasi/${info.dest}`);
            }
            successCount++;
        } catch (err) {
            console.error(`❌ Failed processing ${actualFile}: ${err.message}`);
            errorCount++;
        }
    }

    console.log(`\n========================================`);
    console.log(`Summary Batch 2: ${successCount} successful, ${errorCount} errors.`);
    console.log(`========================================`);
}

processBatch2();
