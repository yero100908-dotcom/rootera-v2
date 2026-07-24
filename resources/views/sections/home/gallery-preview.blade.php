<section class="section bg-offwhite" id="galeri-kerja-nyata" aria-labelledby="galeri-heading">
    <div class="container">
        <div class="text-center" style="margin-bottom:2.5rem">
            <span class="badge badge-green">Portofolio</span>
            <h2 class="section-title" id="galeri-heading" style="margin-top:.75rem">
                Galeri Hasil <span>Kerja Nyata</span>
            </h2>
            <p class="section-sub">Bukti nyata dedikasi dan profesionalisme tim kami di lapangan.</p>
        </div>

        <!-- Tabs Kategori -->
        <div class="gallery-tabs-container">
            <div class="gallery-tabs">
                <button class="gallery-tab active" data-filter="all">TERBARU</button>
                <button class="gallery-tab" data-filter="residential">RESIDENTIAL</button>
                <button class="gallery-tab" data-filter="commercial">COMMERCIAL</button>
            </div>
        </div>

        <!-- 2x2 Grid Layout -->
        <div class="gallery-grid-enhanced" id="gallery-grid">
            <!-- Foto 1 (Residential) -->
            <div class="gallery-item" data-category="residential">
                <div class="gallery-img-wrapper" onclick="openLightbox(0)">
                    <img src="{{ asset('images/Dokumentasi1.jpg') }}" alt="Hasil Kerja Residential 1" onerror="this.src='{{ asset('images/JnJ.jpeg') }}'">
                    <div class="gallery-overlay">
                        <svg class="zoom-icon" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line><line x1="11" y1="8" x2="11" y2="14"></line><line x1="8" y1="11" x2="14" y2="11"></line></svg>
                    </div>
                </div>
            </div>
            <!-- Foto 2 (Commercial) -->
            <div class="gallery-item" data-category="commercial">
                <div class="gallery-img-wrapper" onclick="openLightbox(1)">
                    <img src="{{ asset('images/pengerjaan1.jpg') }}" alt="Hasil Kerja Commercial 1" onerror="this.src='{{ asset('images/Dokumentasi2.jpg') }}'">
                    <div class="gallery-overlay">
                        <svg class="zoom-icon" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line><line x1="11" y1="8" x2="11" y2="14"></line><line x1="8" y1="11" x2="14" y2="11"></line></svg>
                    </div>
                </div>
            </div>
            <!-- Foto 3 (Residential) -->
            <div class="gallery-item" data-category="residential">
                <div class="gallery-img-wrapper" onclick="openLightbox(2)">
                    <img src="{{ asset('images/pengerjaan2.jpg') }}" alt="Hasil Kerja Residential 2" onerror="this.src='{{ asset('images/Dokumentasi3.jpg') }}'">
                    <div class="gallery-overlay">
                        <svg class="zoom-icon" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line><line x1="11" y1="8" x2="11" y2="14"></line><line x1="8" y1="11" x2="14" y2="11"></line></svg>
                    </div>
                </div>
            </div>
            <!-- Foto 4 (Commercial) -->
            <div class="gallery-item" data-category="commercial">
                <div class="gallery-img-wrapper" onclick="openLightbox(3)">
                    <img src="{{ asset('images/pengerjaan3.jpg') }}" alt="Hasil Kerja Commercial 2" onerror="this.src='{{ asset('images/JnJ.webp') }}'">
                    <div class="gallery-overlay">
                        <svg class="zoom-icon" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line><line x1="11" y1="8" x2="11" y2="14"></line><line x1="8" y1="11" x2="14" y2="11"></line></svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol CTA Bawah -->
        <div class="text-center" style="margin-top: 3.5rem;">
            <a href="https://wa.me/6281385404000?text=Halo%20ROOTERA%2C%20saya%20ingin%20konsultasi%20gratis." class="btn btn-primary" target="_blank" rel="noopener" style="padding: 1rem 2.25rem; font-size: 1.1rem; border-radius: 12px; box-shadow: 0 10px 20px rgba(22, 159, 129, 0.25);">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="currentColor" style="margin-right: 8px; display: inline-block; vertical-align: text-bottom;"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
58:                 Konsultasi Gratis Sekarang
59:             </a>
60:         </div>
61: 
62:         <!-- Lightbox Modal -->
63:         <div id="gallery-lightbox" class="lightbox-modal">
64:             <button class="lightbox-close" onclick="closeLightbox()" aria-label="Close Lightbox">&times;</button>
65:             <button class="lightbox-prev" onclick="prevImage()" aria-label="Previous Image">&#10094;</button>
66:             <div class="lightbox-content">
67:                 <img id="lightbox-img" src="" alt="Gallery Preview Besar">
68:             </div>
69:             <button class="lightbox-next" onclick="nextImage()" aria-label="Next Image">&#10095;</button>
70:         </div>
71:     </div>
72: </section>
73: 
74: <style>
75: /* Tabs Styling */
76: .gallery-tabs-container {
77:     width: 100%;
78:     overflow-x: auto;
79:     margin-bottom: 2.5rem;
80:     padding-bottom: 0.5rem; /* Memberikan ruang untuk scrollbar jika muncul */
81:     -webkit-overflow-scrolling: touch;
82: }
83: .gallery-tabs {
84:     display: flex;
85:     justify-content: center;
86:     gap: 0.75rem;
87:     min-width: max-content;
88:     margin: 0 auto;
89: }
90: @media (max-width: 640px) {
91:     .gallery-tabs {
92:         justify-content: flex-start;
93:     }
94: }
95: .gallery-tab {
96:     background: #ffffff;
97:     color: #475569;
98:     border: 1px solid #cbd5e1;
99:     border-radius: 50px;
100:     padding: 0.6rem 1.75rem;
101:     font-weight: 600;
102:     font-size: 0.95rem;
103:     cursor: pointer;
104:     transition: all 0.3s ease;
105:     white-space: nowrap;
106: }
107: .gallery-tab:hover {
108:     background: #f8fafc;
109:     border-color: #169F81; /* Warna hijau brand */
110:     color: #169F81;
111: }
112: .gallery-tab.active {
113:     background: #169F81;
114:     color: #ffffff;
115:     border-color: #169F81;
116:     box-shadow: 0 4px 12px rgba(22, 159, 129, 0.25);
117: }
118: 
119: /* Grid Layout */
120: .gallery-grid-enhanced {
121:     display: grid;
122:     grid-template-columns: 1fr;
123:     gap: 1.5rem;
124: }
125: @media (min-width: 768px) {
126:     .gallery-grid-enhanced {
127:         grid-template-columns: repeat(2, 1fr);
128:     }
129: }
130: 
131: /* Gallery Items & Animation */
132: .gallery-item {
133:     transition: opacity 0.4s ease, transform 0.4s ease;
134:     opacity: 1;
135:     transform: scale(1);
136: }
137: .gallery-item.hide {
138:     display: none;
139: }
140: 
141: /* Image Wrapper */
142: .gallery-img-wrapper {
143:     position: relative;
144:     border-radius: 20px;
145:     overflow: hidden;
146:     box-shadow: 0 10px 25px rgba(0,0,0,0.08);
147:     aspect-ratio: 4/3;
148:     background: #e2e8f0;
149:     cursor: pointer;
150: }
151: .gallery-img-wrapper img {
152:     width: 100%;
153:     height: 100%;
154:     object-fit: cover;
155:     transition: transform 0.5s ease;
156: }
157: 
158: /* Hover Overlay */
159: .gallery-overlay {
160:     position: absolute;
161:     inset: 0;
162:     background: rgba(10, 46, 120, 0.5); /* Brand dark blue transparent */
163:     display: flex;
164:     align-items: center;
165:     justify-content: center;
166:     opacity: 0;
167:     transition: opacity 0.3s ease;
168: }
169: .zoom-icon {
170:     color: white;
171:     transform: scale(0.5);
172:     transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
173: }
174: .gallery-img-wrapper:hover img {
175:     transform: scale(1.08);
176: }
177: .gallery-img-wrapper:hover .gallery-overlay {
178:     opacity: 1;
179: }
180: .gallery-img-wrapper:hover .zoom-icon {
181:     transform: scale(1);
182: }
183: 
184: /* Lightbox Modal */
185: .lightbox-modal {
186:     display: none;
187:     position: fixed;
188:     z-index: 99999;
189:     left: 0;
190:     top: 0;
191:     width: 100%;
192:     height: 100%;
193:     background-color: rgba(15, 23, 42, 0.95); /* Slate 900 */
194:     backdrop-filter: blur(8px);
195:     align-items: center;
196:     justify-content: center;
197:     opacity: 0;
198:     transition: opacity 0.3s ease;
199: }
200: .lightbox-modal.show {
201:     display: flex;
202:     opacity: 1;
203: }
204: .lightbox-content {
205:     position: relative;
206:     max-width: 90%;
207:     max-height: 85vh;
208: }
209: .lightbox-modal img {
210:     max-width: 100%;
211:     max-height: 85vh;
212:     border-radius: 12px;
213:     box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
214:     transform: scale(0.95);
215:     transition: transform 0.3s ease;
216:     object-fit: contain;
217: }
218: .lightbox-modal.show img {
219:     transform: scale(1);
220: }
221: .lightbox-close {
222:     position: absolute;
223:     top: 25px;
224:     right: 35px;
225:     color: #cbd5e1;
226:     font-size: 45px;
227:     font-weight: 300;
228:     background: none;
229:     border: none;
230:     cursor: pointer;
231:     transition: color 0.3s, transform 0.3s;
232:     line-height: 1;
233:     z-index: 10;
234: }
235: .lightbox-close:hover {
236:     color: #ffffff;
237:     transform: scale(1.1);
238: }
239: .lightbox-prev, .lightbox-next {
240:     cursor: pointer;
241:     position: absolute;
242:     top: 50%;
243:     width: 56px;
244:     height: 56px;
245:     transform: translateY(-50%);
246:     color: white;
247:     font-size: 20px;
248:     transition: all 0.3s ease;
249:     border-radius: 50%;
250:     background: rgba(255, 255, 255, 0.1);
251:     border: 1px solid rgba(255,255,255,0.2);
252:     display: flex;
253:     align-items: center;
254:     justify-content: center;
255:     backdrop-filter: blur(4px);
256:     z-index: 10;
257: }
258: .lightbox-prev:hover, .lightbox-next:hover {
259:     background: #169F81;
260:     border-color: #169F81;
261:     transform: translateY(-50%) scale(1.05);
262: }
263: .lightbox-prev {
264:     left: 40px;
265: }
266: .lightbox-next {
267:     right: 40px;
268: }
269: @media (max-width: 640px) {
270:     .lightbox-prev {
271:         left: 10px;
272:         width: 44px;
273:         height: 44px;
274:     }
275:     .lightbox-next {
276:         right: 10px;
277:         width: 44px;
278:         height: 44px;
279:     }
280:     .lightbox-close {
281:         top: 15px;
282:         right: 20px;
283:     }
284: }
285: </style>
286: 
287: <script>
288: document.addEventListener('DOMContentLoaded', function() {
289:     const tabs = document.querySelectorAll('.gallery-tab');
290:     const items = document.querySelectorAll('.gallery-item');
291:     
292:     // --- 1. FILTERING LOGIC ---
293:     tabs.forEach(tab => {
294:         tab.addEventListener('click', () => {
295:             // Reset active classes
296:             tabs.forEach(t => t.classList.remove('active'));
297:             tab.classList.add('active');
298:             
299:             const filterValue = tab.getAttribute('data-filter');
300:             
301:             items.forEach(item => {
302:                 // Jika 'all' atau kategori cocok
303:                 if(filterValue === 'all' || item.getAttribute('data-category') === filterValue) {
304:                     item.classList.remove('hide');
305:                     // Transisi smooth untuk kemunculan
306:                     setTimeout(() => {
307:                         item.style.opacity = '1';
308:                         item.style.transform = 'scale(1)';
309:                     }, 50);
310:                 } else {
311:                     // Transisi smooth untuk menghilangkan
312:                     item.style.opacity = '0';
313:                     item.style.transform = 'scale(0.95)';
314:                     // Sembunyikan sepenuhnya setelah transisi selesai
315:                     setTimeout(() => {
316:                         item.classList.add('hide');
317:                     }, 400); 
318:                 }
319:             });
320:             
321:             // Update list gambar untuk navigasi lightbox berdasarkan foto yang aktif
322:             setTimeout(() => {
323:                 updateLightboxImages();
324:             }, 450);
325:         });
326:     });
327: 
328:     // --- 2. LIGHTBOX LOGIC ---
329:     let currentImages = [];
330:     let currentIndex = 0;
331:     const lightbox = document.getElementById('gallery-lightbox');
332:     const lightboxImg = document.getElementById('lightbox-img');
333: 
334:     function updateLightboxImages() {
335:         currentImages = [];
336:         const visibleItems = document.querySelectorAll('.gallery-item:not(.hide) img');
337:         visibleItems.forEach((img, index) => {
338:             currentImages.push(img.src);
339:             // Update onclick agar index sesuai dengan array yang sudah di-filter
340:             img.closest('.gallery-img-wrapper').setAttribute('onclick', `openLightbox(${index})`);
341:         });
342:     }
343: 
344:     // Inisialisasi daftar gambar saat pertama load
345:     updateLightboxImages();
346: 
347:     window.openLightbox = function(index) {
348:         currentIndex = index;
349:         lightboxImg.src = currentImages[currentIndex];
350:         lightbox.classList.add('show');
351:         document.body.style.overflow = 'hidden'; // Kunci scroll di body
352:     }
353: 
354:     window.closeLightbox = function() {
355:         lightbox.classList.remove('show');
356:         document.body.style.overflow = ''; // Lepas kunci scroll
357:     }
358: 
359:     window.prevImage = function() {
360:         currentIndex = (currentIndex > 0) ? currentIndex - 1 : currentImages.length - 1;
361:         animateLightboxChange();
362:     }
363: 
364:     window.nextImage = function() {
365:         currentIndex = (currentIndex < currentImages.length - 1) ? currentIndex + 1 : 0;
366:         animateLightboxChange();
367:     }
368:     
369:     function animateLightboxChange() {
370:         lightboxImg.style.opacity = '0.3';
371:         lightboxImg.style.transform = 'scale(0.97)';
372:         setTimeout(() => {
373:             lightboxImg.src = currentImages[currentIndex];
374:             lightboxImg.style.opacity = '1';
375:             lightboxImg.style.transform = 'scale(1)';
376:         }, 200);
377:     }
378: 
379:     // Event Listener: Tutup saat area luar gambar diklik
380:     lightbox.addEventListener('click', function(e) {
381:         if (e.target === lightbox) {
382:             closeLightbox();
383:         }
384:     });
385:     
386:     // Event Listener: Navigasi menggunakan Keyboard
387:     document.addEventListener('keydown', function(e) {
388:         if (!lightbox.classList.contains('show')) return;
389:         if (e.key === 'Escape') closeLightbox();
390:         if (e.key === 'ArrowLeft') prevImage();
391:         if (e.key === 'ArrowRight') nextImage();
392:     });
393: });
394: </script>
