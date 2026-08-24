import fs from 'fs';
import path from 'path';
import { fileURLToPath } from 'url';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

const imgDir = path.resolve(__dirname, '../public/images/dokumentasi');
const jsonPath = path.resolve(__dirname, '../resources/data/portfolio.json');

const videoThumbMap = {
    'video-inspeksi-cctv-wastafel.mp4': {
        thumbName: 'thumb-video-inspeksi-cctv-wastafel.webp',
        sourceWebp: 'inspeksi-kamera-cctv-pipa-tersumbat.webp'
    },
    'video-inspeksi-cctv-gedung-kantor-jakarta.mp4': {
        thumbName: 'thumb-video-inspeksi-cctv-gedung-kantor-jakarta.webp',
        sourceWebp: 'inspeksi-cctv-floor-drain-pertamina-sunter.webp'
    },
    'video-pelancaran-gutter-lemak-sushi-tei.mp4': {
        thumbName: 'thumb-video-pelancaran-gutter-lemak-sushi-tei.webp',
        sourceWebp: 'pelancar-saluran-gutter-resto-jakarta.webp'
    },
    'video-pelancaran-saluran-stasiun-tugu-yogyakarta.mp4': {
        thumbName: 'thumb-video-pelancaran-saluran-stasiun-tugu-yogyakarta.webp',
        sourceWebp: 'proyek-pelancaran-saluran-stasiun-kai-1.webp'
    },
    'video-ridgid-saluran-kloset-pabrik-jabar.mp4': {
        thumbName: 'thumb-video-ridgid-saluran-kloset-pabrik-jabar.webp',
        sourceWebp: 'pelancaran-kloset-mampet-pabrik-industri.webp'
    },
    'video-ridgid-drain-cleaner-gutter-mie-kari.mp4': {
        thumbName: 'thumb-video-ridgid-drain-cleaner-gutter-mie-kari.webp',
        sourceWebp: 'pelancaran-gutter-seporsi-mie-kari-jakarta.webp'
    }
};

console.log('--- Generating Unique Video Thumbnails ---');

Object.entries(videoThumbMap).forEach(([videoFile, info]) => {
    const srcPath = path.join(imgDir, info.sourceWebp);
    const destPath = path.join(imgDir, info.thumbName);

    if (fs.existsSync(srcPath)) {
        fs.copyFileSync(srcPath, destPath);
        console.log(`✅ Created unique thumbnail: ${info.thumbName} (from ${info.sourceWebp})`);
    } else {
        console.warn(`⚠️ Source webp missing: ${info.sourceWebp}`);
    }
});

// Update portfolio.json
if (fs.existsSync(jsonPath)) {
    const data = JSON.parse(fs.readFileSync(jsonPath, 'utf8'));
    let updatedCount = 0;

    data.forEach(item => {
        if ((item.mediaType === 'video' || item.fileType === 'video' || item.fileName.endsWith('.mp4')) && videoThumbMap[item.fileName]) {
            item.thumbnail = videoThumbMap[item.fileName].thumbName;
            updatedCount++;
        }
    });

    fs.writeFileSync(jsonPath, JSON.stringify(data, null, 2), 'utf8');
    console.log(`\n✅ Updated ${updatedCount} video items in portfolio.json with unique thumbnails!`);
}

console.log('========================================');
