# Requirements Document

## Introduction

JAPLO (Jasa Pengantar Lokal) adalah platform ojek online lokal berbasis web yang dibangun menggunakan Laravel 10, PHP 8.1, MySQL, dan Laravel Sanctum. Platform ini melayani tiga aktor utama: Customer, Driver, dan Admin. Fitur inti mencakup pemesanan ojek, layanan kuliner, produk, kesehatan, pencetakan, tracking GPS, rating, dan pembayaran.

Dokumen ini mendefinisikan requirements untuk **Perencanaan Agile Project JAPLO** — mencakup struktur Sprint, Product Backlog, timeline pengerjaan, dokumen pertemuan client (Berita Acara), dokumen pertemuan Manajemen Proyek (MANPRO), serta klasifikasi fitur yang sudah dikerjakan versus yang masih dalam antrean pengembangan.

---

## Glossary

- **JAPLO**: Jasa Pengantar Lokal — nama platform ojek online lokal yang dikembangkan.
- **Sprint**: Iterasi pengembangan berdurasi tetap (2 minggu) dalam metode Agile/Scrum.
- **Product Backlog**: Daftar terurut seluruh fitur, perbaikan, dan pekerjaan teknis yang dibutuhkan project.
- **Sprint Backlog**: Subset dari Product Backlog yang dipilih untuk diselesaikan dalam satu Sprint.
- **Agile_Planner**: Sistem/dokumen yang mengelola perencanaan Agile JAPLO.
- **Scrum_Master**: Peran fasilitator yang memimpin proses Agile/Scrum.
- **Product_Owner**: Peran pemilik product yang memprioritaskan backlog dan mewakili kebutuhan bisnis.
- **Development_Team**: Tim pengembang yang mengerjakan Sprint Backlog.
- **Client**: Pemangku kepentingan atau pemberi proyek yang mewakili kebutuhan bisnis.
- **MANPRO**: Manajemen Proyek — proses dan dokumentasi pengelolaan proyek.
- **Berita_Acara**: Dokumen resmi catatan pertemuan antara tim proyek dan client.
- **Sprint_Review**: Pertemuan akhir Sprint untuk mendemonstrasikan increment yang selesai kepada stakeholder.
- **Sprint_Retrospective**: Pertemuan refleksi tim setelah Sprint untuk perbaikan proses.
- **Daily_Standup**: Pertemuan harian singkat (maks 15 menit) untuk sinkronisasi tim.
- **Definition_of_Done**: Kriteria yang harus terpenuhi agar sebuah item dinyatakan selesai.
- **Story_Point**: Satuan estimasi relatif kompleksitas/usaha suatu user story.
- **Velocity**: Jumlah Story Point yang diselesaikan tim dalam satu Sprint.
- **MVP**: Minimum Viable Product — versi minimum produk yang dapat digunakan pengguna nyata.
- **Feature_Existing**: Fitur yang sudah selesai diimplementasikan dan ada di codebase aktif.
- **Feature_Backlog**: Fitur yang sudah ada struktur database-nya tetapi belum memiliki model/controller lengkap.
- **Feature_Planned**: Fitur yang direncanakan tetapi belum ada implementasi apapun.
- **Tech_Stack**: Laravel 10, PHP 8.1, MySQL, Laravel Sanctum, Blade templating.

---

## Requirements

### Requirement 1: Struktur Sprint dan Timeline Agile

**User Story:** Sebagai Product Owner, saya ingin memiliki struktur Sprint yang jelas dengan timeline terukur, sehingga seluruh tim memahami kapan setiap fitur harus diselesaikan dan dapat melacak kemajuan proyek secara transparan.

#### Acceptance Criteria

1. THE Agile_Planner SHALL mendefinisikan durasi Sprint sebesar 2 minggu per iterasi.
2. THE Agile_Planner SHALL membagi seluruh project JAPLO ke dalam minimal 6 Sprint dengan tanggal mulai dan selesai dalam format YYYY-MM-DD yang eksplisit pada setiap entri Sprint.
3. WHEN sebuah Sprint dimulai, THE Agile_Planner SHALL menetapkan Sprint Goal berupa minimal satu pernyataan hasil yang dapat diverifikasi — yaitu alur end-to-end dari fitur utama Sprint berjalan tanpa error blocking.
4. THE Agile_Planner SHALL menetapkan kapasitas tim dalam Story Point per Sprint: default 40 SP untuk estimasi awal; jika velocity historis Sprint sebelumnya tersedia, maka velocity historis tersebut yang digunakan sebagai kapasitas Sprint berikutnya.
5. WHEN sebuah Sprint berakhir, THE Agile_Planner SHALL mencatat persentase Sprint Goal yang tercapai pada Sprint Planning Artifact sebagai angka (misal: 100%, 75%).
6. THE Agile_Planner SHALL membedakan setiap item dalam Sprint dengan label eksplisit salah satu dari: `[EXISTING]`, `[BACKLOG]`, atau `[PLANNED]`.
7. THE Agile_Planner SHALL menetapkan milestone MVP pada Sprint ke-3 dengan kriteria terverifikasi: (a) alur registrasi–login–logout semua role selesai tanpa error, (b) alur booking ojek hingga status accepted selesai tanpa error, (c) halaman payment checkout–success/failed dapat diakses dan merekam data ke database, (d) halaman tracking order dapat dibuka dan menampilkan status order secara live.
8. THE Agile_Planner SHALL menghasilkan satu artefak Sprint Planning (tabel atau dokumen) per Sprint yang memuat: Sprint Number, Tanggal Mulai, Tanggal Selesai, Sprint Goal, Kapasitas SP, daftar item dengan label status, dan persentase pencapaian (diisi saat Sprint selesai).

---

### Requirement 2: Product Backlog

**User Story:** Sebagai Scrum_Master, saya ingin memiliki Product Backlog yang terurut dan lengkap, sehingga Development_Team selalu tahu item mana yang paling bernilai dan harus dikerjakan berikutnya.

#### Acceptance Criteria

1. THE Agile_Planner SHALL mendaftar seluruh user story dalam Product Backlog dengan format: ID, Judul, Deskripsi, Priority (High/Medium/Low), Story Point, dan Status.
2. THE Agile_Planner SHALL menetapkan prioritas berdasarkan nilai bisnis, di mana fitur inti (auth, ojek booking, payment) mendapat prioritas High.
3. THE Agile_Planner SHALL menandai setiap item backlog dengan satu dari tiga status: `Done` (Feature_Existing), `In Progress` (Feature_Backlog), atau `To Do` (Feature_Planned).
4. WHEN item backlog berstatus `Done`, THE Agile_Planner SHALL mencantumkan Sprint di mana item tersebut diselesaikan.
5. THE Agile_Planner SHALL memisahkan backlog ke dalam kategori: Epic Auth & Onboarding, Epic Layanan Transportasi, Epic Layanan Kuliner, Epic Layanan Produk, Epic Layanan Kesehatan, Epic Layanan Pencetakan, Epic Sosial & Promosi, Epic Payment & Integrasi, dan Epic Admin & Manajemen.
6. IF sebuah item backlog memiliki dependensi terhadap item lain, THEN THE Agile_Planner SHALL mencantumkan ID dependensi tersebut secara eksplisit.
7. THE Agile_Planner SHALL menyertakan backlog teknis (technical debt) sebagai kategori tersendiri, mencakup: integrasi Google Maps API nyata, integrasi payment gateway (Midtrans/Xendit), notifikasi WhatsApp, dan push notification.

---

### Requirement 3: Klasifikasi Fitur — Sudah Ada vs Belum Ada

**User Story:** Sebagai Development_Team, saya ingin klasifikasi yang jelas antara fitur yang sudah ada di codebase dan yang belum, sehingga tidak ada duplikasi pekerjaan dan estimasi Sprint akurat.

#### Acceptance Criteria

1. THE Agile_Planner SHALL mendaftar semua Feature_Existing dengan bukti berupa nama file controller, model, atau route yang relevan.
2. THE Agile_Planner SHALL mendaftar semua Feature_Backlog yaitu fitur yang memiliki migrasi database tetapi belum memiliki Model Eloquent dan Controller fungsional.
3. THE Agile_Planner SHALL mendaftar Feature_Existing yang mencakup: multi-role auth (register, login, logout, forgot password), customer dashboard, service pages (ojek, kuliner, produk, kesehatan, pencetakan, trending, sosial, promosi), driver dashboard (statistik, pending orders, toggle availability), admin panel (dashboard, users, drivers, orders), order booking dengan kalkulasi harga otomatis, GPS tracking via polling, rating multi-dimensi, payment checkout simulasi, dan REST API lengkap.
4. THE Agile_Planner SHALL mendaftar Feature_Backlog yang mencakup: Restaurants (migrasi ada, controller hanya dummy data), Products (migrasi ada, controller hanya dummy data), Promotions (migrasi ada, controller hanya dummy data), Health Services (migrasi ada, controller hanya dummy data), dan Social Posts (migrasi ada, controller hanya dummy data).
5. THE Agile_Planner SHALL mendaftar Feature_Planned yang mencakup: integrasi Google Maps API nyata, integrasi payment gateway Midtrans/Xendit, notifikasi WhatsApp nyata, dan push notification.
6. WHEN fitur berstatus Feature_Backlog, THE Agile_Planner SHALL menampilkan gap analysis: apa yang ada (migrasi/dummy) dan apa yang kurang (Model, Controller, View, API endpoint).

---

### Requirement 4: Dokumen Pertemuan Client — Berita Acara

**User Story:** Sebagai Project Manager, saya ingin memiliki template dan contoh Berita Acara pertemuan client, sehingga setiap komunikasi dengan client terdokumentasi secara formal dan dapat dijadikan acuan.

#### Acceptance Criteria

1. THE Agile_Planner SHALL menyediakan template Berita Acara dengan field wajib: Nomor Dokumen, Tanggal, Waktu, Tempat, Peserta (nama dan peran), Agenda, Hasil Keputusan, Tindak Lanjut (deskripsi, PIC, Tenggat), dan kolom Tanda Tangan (Client dan Product Owner).
2. THE Agile_Planner SHALL menyediakan minimal 3 contoh Berita Acara yang telah dieksekusi (status: Selesai) yang mencerminkan: kickoff meeting, progress review, dan demo fitur MVP — masing-masing dengan field "Hasil Keputusan" terisi minimal 3 keputusan konkret.
3. THE Agile_Planner SHALL menyediakan minimal 2 template Berita Acara yang belum dieksekusi (status: Terjadwal) untuk: demo final dan serah terima proyek.
4. IF Berita Acara berstatus `Selesai`, THEN THE Agile_Planner SHALL memastikan kolom "Hasil Keputusan" berisi minimal 3 keputusan konkret yang disepakati dalam format: nomor urut, deskripsi keputusan, dan penanggung jawab.
5. IF Berita Acara berstatus `Terjadwal`, THEN THE Agile_Planner SHALL mencantumkan: tanggal perkiraan dalam format YYYY-MM-DD, minimal 3 poin agenda yang direncanakan, dan minimal 2 item persiapan yang diperlukan.
6. THE Agile_Planner SHALL menomori setiap Berita Acara dengan format: `BA-JAPLO-[YYYY]-[NNN]`.
7. IF pertemuan client menghasilkan perubahan scope, THEN THE Agile_Planner SHALL mencatat perubahan dalam Berita Acara sebagai "Change Request" dengan: deskripsi perubahan, dampak terhadap Sprint yang terpengaruh (nomor Sprint), dan estimasi penambahan/pengurangan Story Point.
8. THE Agile_Planner SHALL memastikan setiap contoh Berita Acara berstatus Selesai mencantumkan minimal 2 item Tindak Lanjut dengan PIC dan tenggat yang spesifik.

---

### Requirement 5: Dokumen Pertemuan MANPRO — Sprint Ceremonies

**User Story:** Sebagai Scrum_Master, saya ingin memiliki template dan contoh dokumen Sprint ceremonies (Review, Retrospective, Daily Standup), sehingga proses Agile tim terdokumentasi dan dapat dievaluasi secara berkelanjutan.

#### Acceptance Criteria

1. THE Agile_Planner SHALL menyediakan template Sprint Review dengan field wajib: Sprint Number, Sprint Goal, tabel Demo Items (nama fitur, status selesai/tidak), Feedback Stakeholder, dan Keputusan.
2. THE Agile_Planner SHALL menyediakan template Sprint Retrospective dengan empat bagian wajib: What Went Well, What Went Wrong, What to Improve, dan Action Items.
3. THE Agile_Planner SHALL menyediakan template Daily Standup dengan kolom: Tanggal, Nama Anggota Tim, Dikerjakan Kemarin, Dikerjakan Hari Ini, dan Hambatan.
4. THE Agile_Planner SHALL menyediakan minimal 2 contoh Sprint Review yang telah dieksekusi (Sprint 1 dan Sprint 2) yang mencerminkan Feature_Existing yang sudah jadi.
5. THE Agile_Planner SHALL menyediakan minimal 2 contoh Sprint Retrospective yang telah dieksekusi, di mana setiap Action Item mencantumkan: deskripsi tindakan, penanggung jawab, dan tenggat waktu yang spesifik.
6. THE Agile_Planner SHALL menyediakan template Sprint Review yang belum dieksekusi untuk Sprint 4, Sprint 5, dan Sprint 6 dengan checklist demo item yang direncanakan.
7. WHEN Sprint Review menunjukkan bahwa Sprint Goal tidak tercapai penuh, THE Agile_Planner SHALL mencatat item yang tidak selesai beserta alasannya dalam Sprint Review.
8. WHEN item tidak selesai tercatat dalam Sprint Review, THE Agile_Planner SHALL mendokumentasikan pemindahan item tersebut ke Sprint Backlog berikutnya sebagai entri terpisah dengan keterangan "Carried Over dari Sprint [N]".
9. THE Agile_Planner SHALL menyertakan contoh Daily Standup Log untuk minimal 5 hari kerja dalam Sprint 2 sebagai Sprint acuan.

---

### Requirement 6: Definition of Done dan Standar Kualitas

**User Story:** Sebagai Development_Team, saya ingin memiliki Definition of Done yang jelas, sehingga seluruh anggota tim memiliki pemahaman seragam tentang kapan sebuah fitur dinyatakan benar-benar selesai.

#### Acceptance Criteria

1. THE Agile_Planner SHALL mendefinisikan Definition of Done level Story yang mencakup: kode berjalan tanpa error, route terdaftar, controller fungsional, view/blade tersedia, validasi input ada, dan response format konsisten.
2. THE Agile_Planner SHALL mendefinisikan Definition of Done level Sprint yang mencakup: semua story dalam Sprint berstatus Done, tidak ada regresi pada Feature_Existing, Sprint Review telah dilaksanakan, dan Sprint Retrospective telah dilaksanakan.
3. THE Agile_Planner SHALL mendefinisikan standar API response menggunakan format: `{ success: boolean, message: string, data: object|array }` konsisten dengan implementasi yang sudah ada.
4. IF sebuah fitur melibatkan database, THEN THE Agile_Planner SHALL mensyaratkan bahwa migrasi, model Eloquent dengan fillable dan relasi, serta seeder data dummy tersedia sebelum story dinyatakan Done.
5. THE Agile_Planner SHALL menetapkan kriteria keamanan minimum: semua route yang memerlukan autentikasi dilindungi middleware `auth:sanctum` (API) atau `auth` (web), dan input divalidasi menggunakan Laravel Request Validation.

---

### Requirement 7: Estimasi dan Kapasitas Tim

**User Story:** Sebagai Product Owner, saya ingin memiliki estimasi Story Point yang realistis per fitur, sehingga Sprint planning dapat dilakukan secara akurat dan tim tidak overcommit.

#### Acceptance Criteria

1. THE Agile_Planner SHALL menetapkan skala Story Point Fibonacci yang digunakan: 1, 2, 3, 5, 8, 13, 21.
2. THE Agile_Planner SHALL mengestimasi Story Point untuk setiap item Product Backlog berdasarkan kompleksitas: 1–2 (CRUD sederhana), 3–5 (fitur dengan logika bisnis), 8–13 (fitur kompleks dengan integrasi), 21 (epic/fitur sangat kompleks).
3. THE Agile_Planner SHALL menetapkan kapasitas tim awal sebesar 40 Story Point per Sprint untuk tim 3 orang dengan asumsi 80% availability.
4. WHEN kapasitas Sprint tersisa kurang dari Story Point item berikutnya di backlog, THE Agile_Planner SHALL memindahkan item tersebut ke Sprint berikutnya tanpa memecahnya.
5. THE Agile_Planner SHALL mencantumkan total Story Point per Epic untuk memberikan gambaran ukuran relatif setiap area fungsional.

---

### Requirement 8: Manajemen Risiko Agile

**User Story:** Sebagai Scrum_Master, saya ingin daftar risiko yang teridentifikasi beserta mitigasinya, sehingga tim dapat mengantisipasi hambatan sebelum menjadi blocker Sprint.

#### Acceptance Criteria

1. THE Agile_Planner SHALL mendaftar minimal 8 risiko project beserta tingkat dampak (High/Medium/Low), probabilitas (High/Medium/Low), dan rencana mitigasi — di mana setiap rencana mitigasi berisi minimal 1 tindakan pencegahan yang konkret dan dapat diverifikasi.
2. THE Agile_Planner SHALL mendaftar risiko teknis yang mencakup: ketergantungan integrasi payment gateway pihak ketiga, ketergantungan Google Maps API, performa GPS tracking via polling (bukan WebSocket), dan potensi data dummy yang belum diganti data nyata di Feature_Backlog.
3. THE Agile_Planner SHALL mendaftar risiko manajerial yang mencakup: scope creep dari client, keterlambatan feedback client, dan anggota tim tidak tersedia.
4. IF risiko berstatus aktif (terjadi), THEN THE Agile_Planner SHALL mencatat pada kolom "Status Risiko": tanggal kejadian (YYYY-MM-DD), deskripsi dampak aktual, dan tindakan yang telah diambil.
5. THE Agile_Planner SHALL menetapkan threshold bahwa risiko dengan dampak High dan probabilitas High memerlukan notifikasi tertulis kepada Product_Owner dalam 24 jam sejak risiko pertama kali dicatat atau sejak statusnya berubah menjadi aktif.

---

### Requirement 9: Laporan Kemajuan dan Burndown

**User Story:** Sebagai Product Owner, saya ingin laporan kemajuan yang visual dan mudah dipahami, sehingga seluruh stakeholder dapat melihat status proyek secara real-time.

#### Acceptance Criteria

1. THE Agile_Planner SHALL menyediakan tabel Burndown Chart data per Sprint yang menunjukkan Story Point remaining vs hari Sprint berlangsung.
2. THE Agile_Planner SHALL menyediakan ringkasan status fitur dengan persentase: Feature_Existing (jumlah dan persentase dari total backlog), Feature_Backlog (jumlah dan persentase), Feature_Planned (jumlah dan persentase).
3. THE Agile_Planner SHALL menyediakan tabel velocity tracking yang mencatat Story Point committed vs completed untuk setiap Sprint yang telah selesai.
4. WHEN velocity Sprint aktual lebih rendah dari 70% target, THE Agile_Planner SHALL menandai Sprint tersebut dengan status "At Risk" dan mencatat penyebabnya.
5. THE Agile_Planner SHALL menyertakan proyeksi tanggal selesai project berdasarkan rata-rata velocity aktual jika tersedia, atau velocity estimasi awal jika belum ada data historis.

---

## Lampiran A — Sprint Planning Detail

### Sprint 1 (Minggu 1–2): Fondasi & Auth
**Sprint Goal:** Seluruh alur autentikasi berfungsi end-to-end untuk semua role.
**Status:** ✅ SELESAI

| ID | User Story | Story Point | Status |
|----|-----------|-------------|--------|
| SP1-01 | Registrasi Customer | 3 | ✅ Done |
| SP1-02 | Login semua role | 3 | ✅ Done |
| SP1-03 | Forgot & Reset Password | 5 | ✅ Done |
| SP1-04 | Middleware role (customer, driver, admin) | 3 | ✅ Done |
| SP1-05 | Profile management | 3 | ✅ Done |
| SP1-06 | REST API Auth (register, login, profile) | 5 | ✅ Done |
| SP1-07 | Dashboard per role (customer, driver, admin) | 8 | ✅ Done |
**Total: 30 SP | Achieved: 30 SP**

---

### Sprint 2 (Minggu 3–4): Layanan Inti — Ojek & Tracking
**Sprint Goal:** Customer dapat memesan ojek, driver menerima order, dan tracking GPS berfungsi.
**Status:** ✅ SELESAI

| ID | User Story | Story Point | Status |
|----|-----------|-------------|--------|
| SP2-01 | Halaman booking ojek (form + kalkulasi harga) | 8 | ✅ Done |
| SP2-02 | Order management (create, accept, update status) | 8 | ✅ Done |
| SP2-03 | GPS tracking via polling | 5 | ✅ Done |
| SP2-04 | Driver toggle availability | 3 | ✅ Done |
| SP2-05 | Order history customer | 3 | ✅ Done |
| SP2-06 | REST API order & driver | 5 | ✅ Done |
**Total: 32 SP | Achieved: 32 SP**

---

### Sprint 3 (Minggu 5–6): Payment & Rating — MVP Launch
**Sprint Goal:** Payment checkout dan sistem rating berfungsi → MVP siap didemonstrasikan ke Client.
**Status:** ✅ SELESAI

| ID | User Story | Story Point | Status |
|----|-----------|-------------|--------|
| SP3-01 | Payment checkout (simulasi) | 8 | ✅ Done |
| SP3-02 | Payment success/failed page | 3 | ✅ Done |
| SP3-03 | Rating multi-dimensi (driver, layanan) | 8 | ✅ Done |
| SP3-04 | REST API rating | 3 | ✅ Done |
| SP3-05 | Admin panel: users, drivers, orders | 8 | ✅ Done |
**Total: 30 SP | Achieved: 30 SP**

---

### Sprint 4 (Minggu 7–8): Feature Backlog — Kuliner & Produk
**Sprint Goal:** Restaurants dan Products memiliki model, controller, dan view fungsional (bukan dummy).
**Status:** 🔄 IN PROGRESS / BELUM DIKERJAKAN

| ID | User Story | Story Point | Status |
|----|-----------|-------------|--------|
| SP4-01 | Model & Controller Restaurant (CRUD) | 5 | 🔄 To Do |
| SP4-02 | Halaman kuliner dengan data nyata dari DB | 5 | 🔄 To Do |
| SP4-03 | Detail restoran + menu | 5 | 🔄 To Do |
| SP4-04 | Model & Controller Product (CRUD) | 5 | 🔄 To Do |
| SP4-05 | Halaman produk dengan data nyata dari DB | 5 | 🔄 To Do |
| SP4-06 | Detail produk + pemesanan | 5 | 🔄 To Do |
| SP4-07 | Seeder data nyata restaurants & products | 3 | 🔄 To Do |
**Total estimasi: 33 SP**

---

### Sprint 5 (Minggu 9–10): Feature Backlog — Kesehatan, Promosi, Sosial
**Sprint Goal:** Health Services, Promotions, dan Social Posts memiliki model dan controller fungsional.
**Status:** 📋 BELUM DIKERJAKAN

| ID | User Story | Story Point | Status |
|----|-----------|-------------|--------|
| SP5-01 | Model & Controller Health Services | 5 | 📋 To Do |
| SP5-02 | Halaman kesehatan dengan data DB | 5 | 📋 To Do |
| SP5-03 | Model & Controller Promotions | 3 | 📋 To Do |
| SP5-04 | Halaman promosi dengan data DB | 3 | 📋 To Do |
| SP5-05 | Model & Controller Social Posts | 5 | 📋 To Do |
| SP5-06 | Halaman sosial dengan data DB | 5 | 📋 To Do |
| SP5-07 | Pencetakan: upload file & status | 5 | 📋 To Do |
**Total estimasi: 31 SP**

---

### Sprint 6 (Minggu 11–12): Integrasi Nyata & Launch
**Sprint Goal:** Integrasi Google Maps API nyata dan payment gateway nyata (Midtrans/Xendit) terpasang.
**Status:** 📋 BELUM DIKERJAKAN

| ID | User Story | Story Point | Status |
|----|-----------|-------------|--------|
| SP6-01 | Integrasi Google Maps API (koordinat nyata) | 13 | 📋 To Do |
| SP6-02 | Integrasi Midtrans atau Xendit | 13 | 📋 To Do |
| SP6-03 | Notifikasi WhatsApp (via API) | 8 | 📋 To Do |
| SP6-04 | Push notification (FCM) | 8 | 📋 To Do |
| SP6-05 | UAT & Bug fixing final | 5 | 📋 To Do |
**Total estimasi: 47 SP (perlu negosiasi atau pemecahan sprint)**

---

## Lampiran B — Dokumen Pertemuan Client (Berita Acara)

### BA-JAPLO-2026-001 — Kickoff Meeting
**Status:** ✅ Selesai
**Tanggal:** 2 Juli 2026
**Waktu:** 09.00–11.00 WIB
**Tempat:** Google Meet / Lokasi Client
**Peserta:**
- Client: [Nama Perwakilan Client]
- Product Owner: [Nama PO]
- Scrum Master: [Nama SM]
- Lead Developer: [Nama Dev]

**Agenda:**
1. Perkenalan tim dan client
2. Presentasi scope project JAPLO
3. Penjelasan tech stack (Laravel 10, MySQL)
4. Diskusi timeline dan milestone

**Hasil Keputusan:**
1. Project JAPLO disetujui dengan 3 aktor: Customer, Driver, Admin
2. Fitur prioritas pertama: auth, ojek booking, GPS tracking, payment simulasi
3. Timeline disepakati 12 minggu (6 Sprint @2 minggu)
4. Demo MVP dijadwalkan pada akhir Sprint 3 (minggu ke-6)
5. Tech stack disetujui: Laravel 10, PHP 8.1, MySQL, Sanctum

**Tindak Lanjut:**
| Tindak Lanjut | PIC | Tenggat |
|---------------|-----|---------|
| Kirim dokumen requirements awal | Product Owner | 5 Juli 2026 |
| Setup repository dan environment | Lead Developer | 5 Juli 2026 |
| Konfirmasi jadwal Sprint Review | Scrum Master | 7 Juli 2026 |

**Tanda Tangan:**
- Client: ___________________ Tanggal: __________
- Product Owner: ___________________ Tanggal: __________

---

### BA-JAPLO-2026-002 — Progress Review Minggu 4
**Status:** ✅ Selesai
**Tanggal:** 18 Juli 2026
**Waktu:** 14.00–15.30 WIB
**Tempat:** Google Meet
**Peserta:**
- Client: [Nama Perwakilan Client]
- Product Owner: [Nama PO]
- Scrum Master: [Nama SM]
- Lead Developer: [Nama Dev]

**Agenda:**
1. Demo Sprint 1 & Sprint 2 yang telah selesai
2. Review auth, dashboard, booking ojek, GPS tracking
3. Diskusi feedback dan penyesuaian backlog

**Hasil Keputusan:**
1. Client menyetujui tampilan dashboard Customer dan Driver
2. Client meminta tambahan fitur: cancel order oleh customer — **sudah ada** di API (`POST /api/orders/{id}/cancel`)
3. Client meminta riwayat order yang lebih detail — masuk backlog Sprint 3
4. GPS tracking via polling disetujui untuk MVP; upgrade ke WebSocket masuk backlog Sprint 6 sebagai optional
5. Client konfirmasi tidak perlu integrasi payment gateway nyata untuk demo MVP

**Tindak Lanjut:**
| Tindak Lanjut | PIC | Tenggat |
|---------------|-----|---------|
| Perbaiki tampilan tracking map (dummy coordinates) | Lead Developer | 22 Juli 2026 |
| Tambah halaman order history dengan detail | Lead Developer | 25 Juli 2026 |
| Kirim link staging untuk testing client | Scrum Master | 22 Juli 2026 |

**Tanda Tangan:**
- Client: ___________________ Tanggal: __________
- Product Owner: ___________________ Tanggal: __________

---

### BA-JAPLO-2026-003 — Demo MVP (Sprint 3 Review bersama Client)
**Status:** ✅ Selesai
**Tanggal:** 1 Agustus 2026
**Waktu:** 10.00–12.00 WIB
**Tempat:** Google Meet + screen sharing
**Peserta:**
- Client: [Nama Perwakilan Client]
- Seluruh Tim Development

**Agenda:**
1. Demo end-to-end: registrasi → booking ojek → tracking → payment → rating
2. Demo admin panel
3. Demo REST API (via Postman)
4. Diskusi feedback dan scope Sprint 4–6

**Hasil Keputusan:**
1. Client menyatakan MVP diterima dan berfungsi sesuai ekspektasi
2. Client memprioritaskan: Kuliner dan Produk sebagai fitur berikutnya (Sprint 4)
3. Client menyetujui integrasi Midtrans untuk payment nyata di Sprint 6
4. Client meminta notifikasi order via WhatsApp — masuk backlog Sprint 6
5. Fitur social posts diubah prioritas menjadi Low (dapat dikerjakan last)

**Tindak Lanjut:**
| Tindak Lanjut | PIC | Tenggat |
|---------------|-----|---------|
| Finalisasi backlog Sprint 4 | Product Owner | 3 Agustus 2026 |
| Buat akun test Midtrans sandbox | Lead Developer | 7 Agustus 2026 |
| Daftar WhatsApp Business API | Product Owner | 7 Agustus 2026 |

**Tanda Tangan:**
- Client: ___________________ Tanggal: __________
- Product Owner: ___________________ Tanggal: __________

---

### BA-JAPLO-2026-004 — Demo Fitur Kuliner, Produk & Kesehatan (Sprint 5 Review)
**Status:** 📋 Terjadwal
**Tanggal Perkiraan:** 12 September 2026
**Waktu:** 10.00–12.00 WIB
**Tempat:** TBD

**Agenda Direncanakan:**
1. Demo halaman kuliner dengan data DB nyata (bukan dummy)
2. Demo halaman produk dengan data DB nyata
3. Demo halaman kesehatan dengan data DB nyata
4. Demo halaman promosi aktif
5. Diskusi penyesuaian Sprint 6

**Persiapan yang Diperlukan:**
- Sprint 4 dan Sprint 5 harus selesai
- Data seeder restaurants, products, health services harus tersedia
- Environment staging harus diperbarui

---

### BA-JAPLO-2026-005 — Serah Terima Proyek (Final)
**Status:** 📋 Terjadwal
**Tanggal Perkiraan:** 30 September 2026
**Waktu:** 09.00–12.00 WIB
**Tempat:** TBD

**Agenda Direncanakan:**
1. Demo final seluruh fitur
2. Demo integrasi Google Maps nyata
3. Demo integrasi Midtrans payment
4. Demo notifikasi WhatsApp
5. Serah terima dokumentasi teknis
6. Serah terima source code final
7. Penandatanganan Berita Acara Serah Terima

**Persiapan yang Diperlukan:**
- Sprint 6 harus selesai penuh
- Dokumentasi teknis (API docs, ERD, deployment guide) harus siap
- Testing UAT minimal 3 hari sebelum serah terima

---

## Lampiran C — Dokumen Pertemuan MANPRO

### Sprint Review 1 — Internal (Minggu 2)
**Status:** ✅ Selesai
**Tanggal:** 11 Juli 2026
**Sprint:** Sprint 1 — Fondasi & Auth

**Sprint Goal:** ✅ Tercapai (100%)

**Demo Items:**
| Fitur | Status Demo |
|-------|-------------|
| Register Customer/Driver | ✅ Berfungsi |
| Login semua role | ✅ Berfungsi |
| Forgot & Reset Password | ✅ Berfungsi |
| Middleware role | ✅ Berfungsi |
| Dashboard Customer | ✅ Berfungsi |
| Dashboard Driver | ✅ Berfungsi |
| Dashboard Admin | ✅ Berfungsi |
| REST API Auth | ✅ Berfungsi |

**Velocity:** Committed 30 SP → Completed 30 SP (100%)

**Feedback Internal:**
- Forgot password via email memerlukan konfigurasi SMTP yang lebih jelas di .env
- Middleware admin perlu dipisah dari middleware customer untuk kejelasan

**Keputusan:**
- Lanjut ke Sprint 2 sesuai rencana
- Tambahkan dokumentasi environment setup di README

---

### Sprint Retrospective 1
**Status:** ✅ Selesai
**Tanggal:** 11 Juli 2026

| Kategori | Item |
|----------|------|
| ✅ What Went Well | Auth selesai lebih cepat dari estimasi |
| ✅ What Went Well | Struktur folder Laravel bersih dan konsisten |
| ✅ What Went Well | Middleware role bekerja sesuai rencana |
| ⚠️ What Went Wrong | Konfigurasi environment (SMTP) tidak terdokumentasi |
| ⚠️ What Went Wrong | Estimasi forgot password terlalu rendah (awalnya 3 SP, aktual 5 SP) |
| 🔧 What to Improve | Buat checklist setup environment sebelum Sprint dimulai |
| 🔧 What to Improve | Gunakan Story Point yang lebih konservatif untuk fitur email |

**Action Items:**
| Action Item | PIC | Tenggat |
|-------------|-----|---------|
| Buat file `SETUP.md` dengan panduan environment | Lead Developer | Sprint 2 Hari 1 |
| Update estimasi untuk fitur notifikasi di backlog | Scrum Master | Sprint 2 Hari 2 |

---

### Sprint Review 2 — Internal (Minggu 4)
**Status:** ✅ Selesai
**Tanggal:** 25 Juli 2026
**Sprint:** Sprint 2 — Ojek & Tracking

**Sprint Goal:** ✅ Tercapai (100%)

**Demo Items:**
| Fitur | Status Demo |
|-------|-------------|
| Booking ojek + kalkulasi harga | ✅ Berfungsi |
| Accept order oleh driver | ✅ Berfungsi |
| Update status order | ✅ Berfungsi |
| GPS tracking via polling | ✅ Berfungsi |
| Driver toggle availability | ✅ Berfungsi |
| REST API order & driver | ✅ Berfungsi |
| Order history customer | ✅ Berfungsi |

**Velocity:** Committed 32 SP → Completed 32 SP (100%)

**Feedback Internal:**
- GPS polling menggunakan koordinat dummy, perlu diganti dengan koordinat nyata di Sprint 6
- Kalkulasi harga ojek perlu formula yang lebih realistis

---

### Sprint Retrospective 2
**Status:** ✅ Selesai
**Tanggal:** 25 Juli 2026

| Kategori | Item |
|----------|------|
| ✅ What Went Well | GPS tracking via polling berhasil diimplementasi |
| ✅ What Went Well | REST API konsisten dengan format response |
| ✅ What Went Well | Driver dashboard informatif dan responsif |
| ⚠️ What Went Wrong | Koordinat GPS masih dummy, bisa menyesatkan saat demo client |
| ⚠️ What Went Wrong | Tidak ada validasi input yang cukup pada form booking |
| 🔧 What to Improve | Tambah catatan "data dummy" pada fitur yang belum real |
| 🔧 What to Improve | Perkuat validasi form booking di Sprint 3 |

**Action Items:**
| Action Item | PIC | Tenggat |
|-------------|-----|---------|
| Tambah label "Demo Mode" pada GPS tracking | Lead Developer | Sprint 3 Hari 1 |
| Review validasi input seluruh form | Lead Developer | Sprint 3 Hari 3 |

---

### Sprint Review 3 — Internal + Client Demo (MVP)
**Status:** ✅ Selesai
**Tanggal:** 1 Agustus 2026
**Sprint:** Sprint 3 — Payment & Rating

**Sprint Goal:** ✅ Tercapai (100%)

**Demo Items:**
| Fitur | Status Demo |
|-------|-------------|
| Payment checkout (simulasi) | ✅ Berfungsi |
| Payment success/failed page | ✅ Berfungsi |
| Rating multi-dimensi | ✅ Berfungsi |
| Admin panel lengkap | ✅ Berfungsi |
| REST API rating | ✅ Berfungsi |

**Velocity:** Committed 30 SP → Completed 30 SP (100%)

---

### Sprint Review 4 — Internal (Template)
**Status:** 📋 Belum Dikerjakan
**Tanggal Perkiraan:** 22 Agustus 2026
**Sprint:** Sprint 4 — Kuliner & Produk

**Sprint Goal:** Restaurants dan Products memiliki model dan controller fungsional (bukan dummy).

**Checklist Demo yang Direncanakan:**
- [ ] Halaman kuliner tampil data dari DB
- [ ] Halaman detail restoran fungsional
- [ ] Halaman produk tampil data dari DB
- [ ] Model Eloquent Restaurant dan Product tersedia
- [ ] Seeder data nyata berjalan

---

### Sprint Review 5 — Internal (Template)
**Status:** 📋 Belum Dikerjakan
**Tanggal Perkiraan:** 5 September 2026
**Sprint:** Sprint 5 — Kesehatan, Promosi, Sosial

**Sprint Goal:** Health Services, Promotions, dan Social Posts fungsional dari database.

**Checklist Demo yang Direncanakan:**
- [ ] Halaman kesehatan tampil data dari DB
- [ ] Halaman promosi tampil data promosi aktif dari DB
- [ ] Halaman sosial tampil post dari DB
- [ ] Halaman pencetakan dengan upload file

---

### Sprint Review 6 — Final (Template)
**Status:** 📋 Belum Dikerjakan
**Tanggal Perkiraan:** 26 September 2026
**Sprint:** Sprint 6 — Integrasi Nyata & Launch

**Sprint Goal:** Google Maps API nyata, Midtrans payment, notifikasi WhatsApp aktif.

**Checklist Demo yang Direncanakan:**
- [ ] GPS menggunakan koordinat nyata via Google Maps API
- [ ] Payment berhasil via Midtrans sandbox
- [ ] Notifikasi WhatsApp terkirim saat order dibuat
- [ ] Push notification berfungsi di browser/mobile
- [ ] UAT selesai tanpa critical bug

---

### Daily Standup Log — Sprint 4 (Contoh)
**Sprint:** Sprint 4 — Kuliner & Produk

| Tanggal | Anggota | Kemarin | Hari Ini | Hambatan |
|---------|---------|---------|----------|----------|
| 8 Agt 2026 | Dev A | Setup branches Sprint 4 | Buat Model Restaurant + migration fix | Tidak ada |
| 8 Agt 2026 | Dev B | Review backlog Sprint 4 | Buat Controller Restaurant (index, show) | Tidak ada |
| 11 Agt 2026 | Dev A | Model Restaurant selesai | Buat Seeder Restaurant | Butuh contoh data dari client |
| 11 Agt 2026 | Dev B | Controller Restaurant index selesai | Controller Restaurant detail + relasi menu | Relasi menu belum defined di migrasi |
| 12 Agt 2026 | Dev A | Seeder Restaurant dengan 10 data | Integrasi dengan view kuliner | Tidak ada |
| 12 Agt 2026 | Dev B | Fix relasi menu di migrasi | Controller show + view detail restoran | Tidak ada |
| 13 Agt 2026 | Dev A | View kuliner terupdate dengan data DB | Mulai Model Product | Tidak ada |
| 13 Agt 2026 | Dev B | View detail restoran selesai | Controller Product (index, show) | Tidak ada |
| 14 Agt 2026 | Dev A | Model Product selesai | Seeder Product | Tidak ada |
| 14 Agt 2026 | Dev B | Controller Product selesai | View halaman produk | Tidak ada |

---

## Lampiran D — Ringkasan Status Fitur

### Fitur yang SUDAH ADA (Feature_Existing) ✅

| No | Fitur | File/Bukti | Sprint |
|----|-------|------------|--------|
| 1 | Multi-role auth (register, login, logout) | `Web/AuthController.php`, `Api/AuthController.php` | Sprint 1 |
| 2 | Forgot & Reset Password | `Web/AuthController.php` routes password.* | Sprint 1 |
| 3 | Middleware role (customer, driver, admin) | `Middleware/CustomerMiddleware.php`, `DriverMiddleware.php`, `AdminMiddleware.php` | Sprint 1 |
| 4 | Customer Dashboard | `Web/DashboardController.php` | Sprint 1 |
| 5 | Driver Dashboard (statistik, pending, toggle) | `Api/DriverController.php` | Sprint 1–2 |
| 6 | Admin Panel (dashboard, users, drivers, orders) | `Web/AdminController.php` | Sprint 3 |
| 7 | Service pages (ojek, kuliner, produk, kesehatan, pencetakan, trending, sosial, promosi) | `Web/ServiceController.php` | Sprint 2 |
| 8 | Order booking + kalkulasi harga otomatis | `Api/OrderController.php` | Sprint 2 |
| 9 | GPS tracking via polling | `Web/TrackingController.php` | Sprint 2 |
| 10 | Rating multi-dimensi | `Api/RatingController.php` | Sprint 3 |
| 11 | Payment checkout (simulasi) | `Web/PaymentController.php` | Sprint 3 |
| 12 | REST API lengkap (auth, driver, order, rating) | `routes/api.php` | Sprint 1–3 |
| 13 | Sanctum authentication (API) | `composer.json`: `laravel/sanctum` | Sprint 1 |
| 14 | Model: User, Driver, Order, OrderItem, Payment, Rating | `app/Models/` | Sprint 1–3 |

### Fitur yang BELUM LENGKAP (Feature_Backlog) 🔄

| No | Fitur | Gap Analysis | Sprint Target |
|----|-------|-------------|---------------|
| 1 | Restaurants | Migrasi ✅, Model ❌, Controller (dummy) ⚠️, Seeder ❌ | Sprint 4 |
| 2 | Products | Migrasi ✅, Model ❌, Controller (dummy) ⚠️, Seeder ❌ | Sprint 4 |
| 3 | Promotions | Migrasi ✅, Model ❌, Controller (dummy) ⚠️, Seeder ❌ | Sprint 5 |
| 4 | Health Services | Migrasi ✅, Model ❌, Controller (dummy) ⚠️, Seeder ❌ | Sprint 5 |
| 5 | Social Posts | Migrasi ✅, Model ❌, Controller (dummy) ⚠️, Seeder ❌ | Sprint 5 |

### Fitur yang BELUM ADA (Feature_Planned) 📋

| No | Fitur | Sprint Target | Dependensi |
|----|-------|--------------|-----------|
| 1 | Integrasi Google Maps API nyata | Sprint 6 | API Key Google Maps |
| 2 | Payment Gateway Midtrans/Xendit | Sprint 6 | Akun merchant Midtrans |
| 3 | Notifikasi WhatsApp nyata | Sprint 6 | WhatsApp Business API |
| 4 | Push Notification (FCM) | Sprint 6 | Firebase project |
| 5 | Pencetakan: upload & tracking file nyata | Sprint 5 | Storage server |
