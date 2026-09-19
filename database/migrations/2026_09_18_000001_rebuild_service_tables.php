<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Rebuild semua service tables yang sebelumnya kosong
 * + tambah tabel baru: menus, tariffs, package_deliveries,
 *   market_orders, market_order_items, articles, notifications,
 *   mitra_registrations, expo_registrations, community_posts
 */
return new class extends Migration
{
    public function up(): void
    {
        // ============================================================
        // 1. RESTAURANTS — Kuliner
        // ============================================================
        Schema::table('restaurants', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete()->comment('Owner/mitra');
            $table->string('name');
            $table->string('category')->default('Makanan'); // Makanan, Minuman, Camilan
            $table->text('description')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('image')->nullable();
            $table->decimal('rating', 3, 2)->default(0);
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->time('open_time')->nullable();
            $table->time('close_time')->nullable();
            $table->decimal('min_order', 10, 2)->default(0);
            $table->integer('delivery_time')->default(30)->comment('menit');
            $table->boolean('is_open')->default(true);
            $table->boolean('is_active')->default(true);
        });

        // ============================================================
        // 2. MENUS — Menu makanan per restoran
        // ============================================================
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('restaurant_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->string('image')->nullable();
            $table->string('category')->nullable(); // Makanan, Minuman, Dessert
            $table->boolean('is_available')->default(true);
            $table->timestamps();

            $table->index('restaurant_id');
        });

        // ============================================================
        // 3. PRODUCTS — Belanja produk
        // ============================================================
        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete()->comment('Seller/mitra');
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->decimal('original_price', 10, 2)->nullable();
            $table->integer('stock')->default(0);
            $table->string('category')->nullable(); // Elektronik, Fashion, dll
            $table->string('image')->nullable();
            $table->decimal('weight', 8, 2)->nullable()->comment('gram');
            $table->decimal('rating', 3, 2)->default(0);
            $table->integer('sold_count')->default(0);
            $table->boolean('is_active')->default(true);
        });

        // ============================================================
        // 4. PROMOTIONS — Iklan & Promosi
        // ============================================================
        Schema::table('promotions', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete()->comment('Pembuat promo');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('category')->nullable(); // Transportasi, Kuliner, Produk, Semua
            $table->enum('type', ['discount', 'cashback', 'free_delivery', 'info'])->default('info');
            $table->decimal('discount_value', 8, 2)->nullable();
            $table->enum('discount_type', ['percent', 'nominal'])->nullable();
            $table->string('promo_code')->nullable()->unique();
            $table->integer('quota')->nullable()->comment('null = unlimited');
            $table->integer('used_count')->default(0);
            $table->decimal('min_purchase', 10, 2)->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->boolean('is_active')->default(true);
        });

        // ============================================================
        // 5. HEALTH SERVICES — Layanan Kesehatan
        // ============================================================
        Schema::table('health_services', function (Blueprint $table) {
            $table->string('name');
            $table->text('description')->nullable();
            $table->text('full_description')->nullable();
            $table->string('icon')->nullable(); // nama icon FA
            $table->string('image')->nullable();
            $table->decimal('price', 10, 2)->default(0);
            $table->string('provider')->nullable(); // nama provider/klinik
            $table->string('phone')->nullable();
            $table->json('benefits')->nullable();
            $table->json('how_it_works')->nullable();
            $table->boolean('is_available')->default(true);
            $table->integer('sort_order')->default(0);
        });

        // ============================================================
        // 6. SOCIAL POSTS — Feed Komunitas Sosial
        // ============================================================
        Schema::table('social_posts', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->text('content');
            $table->string('image')->nullable();
            $table->string('category')->nullable(); // Info, Jual, Cari, Diskusi
            $table->integer('likes_count')->default(0);
            $table->integer('comments_count')->default(0);
            $table->enum('status', ['active', 'reported', 'removed'])->default('active');
        });

        // ============================================================
        // 7. ARTICLES — Trending / Komunitas Info
        // ============================================================
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete()->comment('Penulis/admin');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->longText('content');
            $table->string('image')->nullable();
            $table->string('category')->nullable(); // Berita, Tips, Komunitas, Promo
            $table->integer('views')->default(0);
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->timestamp('published_at')->nullable();
            $table->timestamps();

            $table->index('status');
            $table->index('slug');
        });

        // ============================================================
        // 8. TARIFFS — Tarif layanan (dikelola admin)
        // ============================================================
        Schema::create('tariffs', function (Blueprint $table) {
            $table->id();
            $table->string('service_type'); // ojek_motor, ojek_mobil, paket_motor, paket_mobil
            $table->string('label');        // nama tampilan
            $table->decimal('base_fare', 10, 2)->default(5000)->comment('Biaya dasar (Rp)');
            $table->decimal('per_km', 10, 2)->default(3000)->comment('Biaya per km (Rp)');
            $table->decimal('minimum_fare', 10, 2)->default(8000)->comment('Minimal tarif (Rp)');
            $table->decimal('platform_fee', 10, 2)->default(1000)->comment('Biaya platform (Rp)');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // ============================================================
        // 9. PACKAGE DELIVERIES — Pengiriman Paket
        // ============================================================
        Schema::create('package_deliveries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('driver_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('delivery_number')->unique();

            // Pengirim
            $table->string('sender_name');
            $table->string('sender_phone');
            $table->text('pickup_address');
            $table->decimal('pickup_latitude', 10, 8)->nullable();
            $table->decimal('pickup_longitude', 11, 8)->nullable();

            // Penerima
            $table->string('recipient_name');
            $table->string('recipient_phone');
            $table->text('destination_address');
            $table->decimal('destination_latitude', 10, 8)->nullable();
            $table->decimal('destination_longitude', 11, 8)->nullable();

            // Detail paket
            $table->string('package_type'); // dokumen, paket_kecil, paket_sedang, paket_besar
            $table->text('package_description')->nullable();
            $table->decimal('weight', 8, 2)->nullable()->comment('kg');
            $table->text('special_notes')->nullable();
            $table->boolean('fragile')->default(false);

            // Biaya & Status
            $table->decimal('distance', 8, 2)->nullable();
            $table->decimal('price', 10, 2);
            $table->enum('payment_method', ['cash', 'transfer', 'ewallet'])->default('cash');
            $table->enum('payment_status', ['pending', 'paid', 'failed'])->default('pending');
            $table->enum('status', [
                'pending', 'accepted', 'picked_up', 'in_transit', 'delivered', 'cancelled'
            ])->default('pending');
            $table->text('cancellation_reason')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->timestamps();

            $table->index('status');
            $table->index('delivery_number');
        });

        // ============================================================
        // 10. MARKET ORDERS — Belanja Pasar (titip belanja)
        // ============================================================
        Schema::create('market_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('driver_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('order_number')->unique();
            $table->string('market_name')->nullable()->comment('Nama pasar tujuan');
            $table->text('delivery_address');
            $table->text('notes')->nullable();
            $table->decimal('estimated_price', 10, 2)->nullable()->comment('Estimasi belanja');
            $table->decimal('actual_price', 10, 2)->nullable()->comment('Harga aktual');
            $table->decimal('delivery_fee', 10, 2)->default(0);
            $table->decimal('service_fee', 10, 2)->default(2000);
            $table->decimal('total', 10, 2)->nullable();
            $table->enum('payment_method', ['cash', 'transfer', 'ewallet'])->default('cash');
            $table->enum('payment_status', ['pending', 'paid'])->default('pending');
            $table->enum('status', [
                'pending', 'accepted', 'shopping', 'on_the_way', 'delivered', 'cancelled'
            ])->default('pending');
            $table->timestamp('delivered_at')->nullable();
            $table->timestamps();

            $table->index('status');
        });

        // ============================================================
        // 11. MARKET ORDER ITEMS — Item titipan belanja pasar
        // ============================================================
        Schema::create('market_order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('market_order_id')->constrained()->cascadeOnDelete();
            $table->string('item_name');
            $table->text('description')->nullable()->comment('Spesifikasi: merek, ukuran, dll');
            $table->integer('quantity');
            $table->string('unit')->default('pcs')->comment('pcs, kg, liter, dll');
            $table->decimal('estimated_price', 10, 2)->nullable();
            $table->decimal('actual_price', 10, 2)->nullable();
            $table->timestamps();
        });

        // ============================================================
        // 12. MITRA REGISTRATIONS — Pendaftaran Mitra Usaha
        // ============================================================
        Schema::create('mitra_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('business_name');
            $table->string('owner_name');
            $table->string('phone');
            $table->string('email');
            $table->text('address');
            $table->string('business_type'); // kuliner, produk, jasa, dll
            $table->text('business_description')->nullable();
            $table->string('ktp_photo')->nullable();
            $table->string('business_photo')->nullable();
            $table->enum('membership_tier', ['reguler', 'perunggu', 'perak', 'emas', 'platinum'])->default('reguler');
            $table->enum('status', ['pending', 'approved', 'rejected', 'suspended'])->default('pending');
            $table->text('admin_notes')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();

            $table->index('status');
        });

        // ============================================================
        // 13. EXPO REGISTRATIONS — Pendaftaran Tenant Mini Expo
        // ============================================================
        Schema::create('expo_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('expo_name')->comment('Nama expo/event');
            $table->string('business_name');
            $table->string('owner_name');
            $table->string('phone');
            $table->string('email');
            $table->string('business_type');
            $table->text('product_description');
            $table->integer('booth_size')->nullable()->comment('m2');
            $table->decimal('booth_price', 10, 2)->nullable();
            $table->string('ktp_photo')->nullable();
            $table->string('business_photo')->nullable();
            $table->text('special_request')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected', 'paid', 'cancelled'])->default('pending');
            $table->text('admin_notes')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();

            $table->index('status');
        });

        // ============================================================
        // 14. NOTIFICATIONS — Notifikasi in-app
        // ============================================================
        Schema::create('notifications_japlo', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('type'); // order_created, order_accepted, payment_success, dll
            $table->string('title');
            $table->text('message');
            $table->json('data')->nullable()->comment('payload tambahan');
            $table->string('action_url')->nullable()->comment('link saat notif diklik');
            $table->timestamp('read_at')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'read_at']);
        });

        // ============================================================
        // 15. ORDER STATUS LOGS — Timeline status order
        // ============================================================
        Schema::create('order_status_logs', function (Blueprint $table) {
            $table->id();
            $table->string('orderable_type')->comment('App\\Models\\Order, PackageDelivery, dll');
            $table->unsignedBigInteger('orderable_id');
            $table->string('status');
            $table->string('changed_by_type')->nullable()->comment('user atau driver');
            $table->unsignedBigInteger('changed_by_id')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index(['orderable_type', 'orderable_id']);
        });
    }

    public function down(): void
    {
        Schema::table('restaurants', function (Blueprint $table) {
            $table->dropColumn([
                'user_id','name','category','description','address','phone',
                'image','rating','latitude','longitude','open_time','close_time',
                'min_order','delivery_time','is_open','is_active'
            ]);
        });
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'user_id','name','description','price','original_price','stock',
                'category','image','weight','rating','sold_count','is_active'
            ]);
        });
        Schema::table('promotions', function (Blueprint $table) {
            $table->dropColumn([
                'user_id','title','description','image','category','type',
                'discount_value','discount_type','promo_code','quota','used_count',
                'min_purchase','start_date','end_date','is_active'
            ]);
        });
        Schema::table('health_services', function (Blueprint $table) {
            $table->dropColumn([
                'name','description','full_description','icon','image','price',
                'provider','phone','benefits','how_it_works','is_available','sort_order'
            ]);
        });
        Schema::table('social_posts', function (Blueprint $table) {
            $table->dropColumn([
                'user_id','content','image','category','likes_count','comments_count','status'
            ]);
        });

        Schema::dropIfExists('order_status_logs');
        Schema::dropIfExists('notifications_japlo');
        Schema::dropIfExists('expo_registrations');
        Schema::dropIfExists('mitra_registrations');
        Schema::dropIfExists('market_order_items');
        Schema::dropIfExists('market_orders');
        Schema::dropIfExists('package_deliveries');
        Schema::dropIfExists('tariffs');
        Schema::dropIfExists('articles');
        Schema::dropIfExists('menus');
    }
};
