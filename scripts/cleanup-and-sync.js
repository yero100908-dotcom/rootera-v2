import fs from 'fs';
import path from 'path';
import { fileURLToPath } from 'url';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

const imgDir = path.resolve(__dirname, '../public/images/dokumentasi');
const videoDir = path.resolve(__dirname, '../public/videos/dokumentasi');
const legacyDir = path.resolve(__dirname, '../public/images/dokumentasi-pekerjaan');

if (!fs.existsSync(videoDir)) {
    fs.mkdirSync(videoDir, { recursive: true });
}

console.log('--- Starting Asset Verification & Cleanup ---\n');

// 1. Move any mp4 files from images/dokumentasi to videos/dokumentasi
if (fs.existsSync(imgDir)) {
    const imgFiles = fs.readdirSync(imgDir);
    imgFiles.forEach(file => {
        if (file.endsWith('.mp4')) {
            const src = path.join(imgDir, file);
            const dest = path.join(videoDir, file);
            fs.renameSync(src, dest);
            console.log(`📹 Consolidated Video: Moved ${file} -> videos/dokumentasi/`);
        }
    });
}

// 2. Count active WebP images & MP4 videos
const activeWebpFiles = fs.existsSync(imgDir) ? fs.readdirSync(imgDir).filter(f => f.endsWith('.webp')) : [];
const activeMp4Files = fs.existsSync(videoDir) ? fs.readdirSync(videoDir).filter(f => f.endsWith('.mp4')) : [];

console.log(`\nActive .webp Images Count: ${activeWebpFiles.length}`);
console.log(`Active .mp4 Videos Count: ${activeMp4Files.length}`);
console.log(`Total Active Documentation Assets: ${activeWebpFiles.length + activeMp4Files.length}`);

// 3. Perform cleanup on legacy source directory
if (fs.existsSync(legacyDir)) {
    const rawLegacyPath = process.platform === 'win32' && !legacyDir.startsWith('\\\\?\\') ? '\\\\?\\' + legacyDir : legacyDir;
    try {
        fs.rmSync(rawLegacyPath, { recursive: true, force: true });
        console.log(`\n🗑️ Successfully deleted legacy directory: public/images/dokumentasi-pekerjaan/`);
    } catch (err) {
        console.error(`❌ Failed to delete legacy directory: ${err.message}`);
    }
} else {
    console.log(`\nℹ️ Legacy directory public/images/dokumentasi-pekerjaan/ does not exist (already cleaned).`);
}

console.log('\n========================================');
console.log('Asset Cleanup & Verification Completed Successfully!');
console.log('========================================');
