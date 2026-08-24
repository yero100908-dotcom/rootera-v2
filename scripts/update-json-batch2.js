import fs from 'fs';
import path from 'path';
import { fileURLToPath } from 'url';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

const jsonPath = path.resolve(__dirname, '../resources/data/portfolio.json');

const existing = JSON.parse(fs.readFileSync(jsonPath, 'utf8'));

const batch2 = [
  {
    "id": "doc-b2-01",
    "title": "Before & After Pembersihan Talang Gutter",
    "fileName": "before-pembersihan-talang-gutter.webp",
    "beforeFileName": "before-pembersihan-talang-gutter.webp",
    "pairFileName": "after-pembersihan-talang-gutter-rootera.webp",
    "fileType": "image",
    "mediaType": "image",
    "category": "before_after",
    "serviceType": "Talang Air / Gutter",
    "client": "Komersial / Residensial",
    "location": "Jabodetabek",
    "toolUsed": "Manual & Water Flush",
    "placement": ["home_before_after", "service_gutter", "portfolio_gallery"],
    "altText": "Kondisi sebelum talang gutter dibersihkan oleh Rootera Plumbing",
    "description": "Kondisi fisik talang gutter sebelum pembersihan total dari penumpukan lumpur hitam dan daun busuk."
  },
  {
    "id": "doc-b2-02",
    "title": "Inspeksi Kamera CCTV Pipa Gedung Kantor Jakarta",
    "fileName": "video-inspeksi-cctv-gedung-kantor-jakarta.mp4",
    "fileType": "video",
    "mediaType": "video",
    "category": "cctv_inspection",
    "serviceType": "Inspeksi Kamera CCTV",
    "client": "Gedung Perkantoran Jakarta",
    "location": "Jakarta",
    "toolUsed": "Kamera CCTV Pipa HD Flexible",
    "placement": ["home_hero", "service_cctv", "b2b_landing", "portfolio_gallery"],
    "altText": "Video inspeksi kamera CCTV saluran pipa mampet gedung perkantoran Jakarta oleh Rootera Plumbing",
    "description": "Video rekaman asli pengujian internal pipa buangan gedung perkantoran di Jakarta menggunakan kamera CCTV waterproof."
  },
  {
    "id": "doc-b2-03",
    "title": "Kondisi Pipa Resto Mall Tersumbat Lemak Pekat",
    "fileName": "kondisi-pipa-lemak-resto-mall-tersumbat.webp",
    "fileType": "image",
    "mediaType": "image",
    "category": "cctv_inspection",
    "serviceType": "Inspeksi Kamera CCTV & Drainase Resto",
    "client": "Restoran Mall Komersial",
    "location": "Jakarta",
    "toolUsed": "Kamera CCTV Pipa Endoskopi",
    "placement": ["service_sink", "service_cctv", "b2b_landing", "portfolio_gallery"],
    "altText": "Visual internal pipa resto mall yang penuh dengan endapan lemak pekat membatu",
    "description": "Tampilan kondisi bagian dalam pipa pembuangan dapur resto mall yang tersumbat parah oleh pembekuan lemak makanan."
  },
  {
    "id": "doc-b2-04",
    "title": "Pelancaran Saluran Gutter Lemak Restoran Sushi Tei",
    "fileName": "video-pelancaran-gutter-lemak-sushi-tei.mp4",
    "fileType": "video",
    "mediaType": "video",
    "category": "commercial_resto",
    "serviceType": "Talang Air & Grease Trap",
    "client": "Restoran Sushi Tei",
    "location": "Jabodetabek",
    "toolUsed": "Mesin Spiral Rotary Ridgid",
    "placement": ["home_featured", "home_trust", "service_gutter", "b2b_landing", "portfolio_gallery"],
    "altText": "Video pengerjaan pelancaran gutter mampet akibat lemak di Restoran Sushi Tei oleh Rootera Plumbing",
    "description": "Aksi teknisi Rootera Plumbing melancarkan saluran gutter pembuangan lemak mampet total di outlet Restoran Sushi Tei."
  },
  {
    "id": "doc-b2-05",
    "title": "Pelancaran Saluran Mampet Area Stasiun Tugu Yogyakarta",
    "fileName": "video-pelancaran-saluran-stasiun-tugu-yogyakarta.mp4",
    "fileType": "video",
    "mediaType": "video",
    "category": "commercial_b2b",
    "serviceType": "Saluran Utama & Drainase Gedung",
    "client": "Stasiun Tugu Yogyakarta",
    "location": "Yogyakarta",
    "toolUsed": "Mesin Ridgid Heavy-Duty Cable",
    "placement": ["home_trust", "b2b_landing", "portfolio_gallery"],
    "altText": "Video aksi teknisi Rootera Plumbing melancarkan saluran pembuangan mampet di Stasiun Tugu Yogyakarta",
    "description": "Pengerjaan darurat pelancaran jaringan drainase fasilitas publik Stasiun Kereta Api Tugu Yogyakarta secara tuntas."
  },
  {
    "id": "doc-b2-06",
    "title": "Pelancaran Kloset Mampet Pabrik Industri",
    "fileName": "pelancaran-kloset-mampet-pabrik-industri.webp",
    "fileType": "image",
    "mediaType": "image",
    "category": "commercial_b2b",
    "serviceType": "Saluran Kloset / Toilet Industri",
    "client": "Pabrik Industri",
    "location": "Jawa Barat",
    "toolUsed": "Spiral Rotary Cable K-50",
    "placement": ["service_kloset", "b2b_landing", "portfolio_gallery"],
    "altText": "Pelancaran saluran mampet pada kloset mampet di pabrik industri oleh Rootera Plumbing",
    "description": "Penanganan kloset toilet karyawan pabrik mampet total tanpa bongkar menggunakan mesin rotary cable heavy duty."
  },
  {
    "id": "doc-b2-07",
    "title": "Proyek Pelancaran Saluran Mall Banjarmasin (Part 1)",
    "fileName": "pelancaran-saluran-mampet-mall-banjarmasin-1.webp",
    "fileType": "image",
    "mediaType": "image",
    "category": "commercial_b2b",
    "serviceType": "Drainase Mall & Komersial",
    "client": "Mall Banjarmasin",
    "location": "Banjarmasin, Kalimantan Selatan",
    "toolUsed": "Mesin Ridgid Drain Cleaner Heavy Duty",
    "placement": ["b2b_landing", "portfolio_gallery"],
    "altText": "Pelancaran saluran mampet pada Mall Banjarmasin dikerjakan oleh tim teknisi spesialis Rootera Plumbing",
    "description": "Ekspansi layanan nasional Rootera Plumbing menangani proyek pelancaran saluran pembuangan utama Mall Banjarmasin."
  },
  {
    "id": "doc-b2-08",
    "title": "Pelancaran Wastafel Mampet Rumah Warga",
    "fileName": "pelancaran-wastafel-mampet-rumah-warga.webp",
    "fileType": "image",
    "mediaType": "image",
    "category": "residential",
    "serviceType": "Kitchen Sink & Drainase",
    "client": "Rumah Warga",
    "location": "Jabodetabek",
    "toolUsed": "Mesin Spiral Rotary Ridgid",
    "placement": ["service_sink", "portfolio_gallery"],
    "altText": "Pelancaran saluran wastafel dapur mampet pada rumah warga oleh tim teknisi ahli Rootera Plumbing",
    "description": "Pembersihan pipa afur wastafel cuci piring rumah tangga yang tersumbat lemak sisa makanan."
  },
  {
    "id": "doc-b2-09",
    "title": "Pelancaran Saluran Bio Tank Bogor Jawa Barat",
    "fileName": "pelancaran-saluran-bio-tank-bogor-jabar.webp",
    "fileType": "image",
    "mediaType": "image",
    "category": "residential",
    "serviceType": "Bio Tank / Septic Tank",
    "client": "Residensial & Komersial",
    "location": "Bogor, Jawa Barat",
    "toolUsed": "Auger Heavy Cable & Pressure Flush",
    "placement": ["service_biotank", "portfolio_gallery"],
    "altText": "Pengerjaan pelancaran saluran pipa Bio Tank mampet oleh teknisi ahli Rootera Plumbing di Bogor Jawa Barat",
    "description": "Pembersihan penumpukan kerak dan sumbatan pipa outlet pembuangan bio tank di Bogor Jawa Barat."
  },
  {
    "id": "doc-b2-10",
    "title": "Video Ridgid Pelancaran Saluran Kloset Pabrik Jabar",
    "fileName": "video-ridgid-saluran-kloset-pabrik-jabar.mp4",
    "fileType": "video",
    "mediaType": "video",
    "category": "commercial_b2b",
    "serviceType": "Saluran Kloset / Toilet Industri",
    "client": "Pabrik Jawa Barat",
    "location": "Jawa Barat",
    "toolUsed": "Mesin Ridgid Cable Spiral Heavy Duty",
    "placement": ["service_kloset", "b2b_landing", "portfolio_gallery"],
    "altText": "Video proses Ridgid pelancaran saluran kloset mampet di pabrik Jawa Barat oleh Rootera Plumbing",
    "description": "Video rekaman penetrasi kawat auger mesin Ridgid melancarkan toilet komersial pabrik industri di Jawa Barat."
  },
  {
    "id": "doc-b2-11",
    "title": "Video Ridgid Drain Cleaner Gutter Resto Mie Kari",
    "fileName": "video-ridgid-drain-cleaner-gutter-mie-kari.mp4",
    "fileType": "video",
    "mediaType": "video",
    "category": "commercial_resto",
    "serviceType": "Talang Air / Gutter",
    "client": "Seporsi Mie Kari",
    "location": "Jakarta",
    "toolUsed": "Mesin Ridgid Drain Cleaner & Spiral Steel",
    "placement": ["service_gutter", "portfolio_gallery"],
    "altText": "Video pengerjaan Ridgid saluran gutter resto Seporsi Mie Kari menggunakan mesin drain cleaner dan spiral Rootera Plumbing",
    "description": "Video pengerjaan pembersihan kerak kuah kari dan minyak padat pada gutter buangan resto Seporsi Mie Kari."
  },
  {
    "id": "doc-b2-12",
    "title": "Pelancaran Saluran Mall Banjarmasin Mesin Ridgid (Part 2)",
    "fileName": "pelancaran-saluran-mall-banjarmasin-mesin-ridgid-2.webp",
    "fileType": "image",
    "mediaType": "image",
    "category": "commercial_b2b",
    "serviceType": "Drainase Mall & Komersial",
    "client": "Mall Banjarmasin",
    "location": "Banjarmasin, Kalimantan Selatan",
    "toolUsed": "Mesin Ridgid Drain Cleaner",
    "placement": ["b2b_landing", "portfolio_gallery"],
    "altText": "Ridgid saluran mampet pada Mall Banjarmasin dikerjakan oleh tim profesional Rootera Plumbing",
    "description": "Dokumentasi lanjutan pengikatan kerak limbah pipa gedung pusat perbelanjaan Mall Banjarmasin."
  }
];

// Avoid duplicate entries if script re-run
const existingIds = new Set(existing.map(item => item.id));
const filteredBatch2 = batch2.filter(item => !existingIds.has(item.id));

const merged = [...existing, ...filteredBatch2];
fs.writeFileSync(jsonPath, JSON.stringify(merged, null, 2));

console.log(`✅ Successfully updated portfolio.json! Added ${filteredBatch2.length} items. Total items: ${merged.length}`);
