@extends('layouts.app')

@section('title', 'Sosial - JAPLO')

@section('content')
<div class="hero-section" style="padding: 40px 0; background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);">
    <div class="container">
        <a href="{{ route('dashboard') }}" class="btn btn-light btn-sm mb-3">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
        <h2 class="fw-bold mb-2 text-white">
            <i class="fas fa-users me-2"></i> Sosial Media Japlo
        </h2>
        <p class="mb-0 text-white">Terhubung dengan komunitas pengguna Japlo</p>
    </div>
</div>

<div class="container py-4">
    <!-- Create Post Card -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center mb-3">
                <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=random" 
                     class="rounded-circle me-3" 
                     style="width: 50px; height: 50px;" 
                     alt="{{ auth()->user()->name }}">
                <input type="text" 
                       class="form-control form-control-lg" 
                       placeholder="Apa yang Anda pikirkan, {{ auth()->user()->name }}?" 
                       onclick="openPostModal()"
                       readonly
                       style="cursor: pointer;">
            </div>
            <div class="d-flex justify-content-between flex-wrap gap-2">
                <button class="btn btn-outline-primary flex-fill" style="min-width: 100px;" onclick="openPostModal('photo')">
                    <i class="fas fa-image me-1 me-sm-2"></i> <span class="d-none d-sm-inline">Foto</span>
                </button>
                <button class="btn btn-outline-success flex-fill" style="min-width: 100px;" onclick="openPostModal('video')">
                    <i class="fas fa-video me-1 me-sm-2"></i> <span class="d-none d-sm-inline">Video</span>
                </button>
                <button class="btn btn-outline-warning flex-fill" style="min-width: 100px;" onclick="openPostModal('poll')">
                    <i class="fas fa-poll me-1 me-sm-2"></i> <span class="d-none d-sm-inline">Polling</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Stories -->
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="fw-bold mb-3">Stories</h5>
            <div class="d-flex overflow-auto pb-2" style="gap: 15px;">
                <!-- Add Story -->
                <div class="text-center" style="min-width: 100px;">
                    <div class="position-relative" style="cursor: pointer;" onclick="addStory()">
                        <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=random" 
                             class="rounded-circle" 
                             style="width: 80px; height: 80px; border: 3px solid #007bff;" 
                             alt="Add Story">
                        <div class="position-absolute" style="bottom: 0; right: 0; background: #007bff; border-radius: 50%; width: 30px; height: 30px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-plus text-white"></i>
                        </div>
                    </div>
                    <small class="d-block mt-2 fw-bold">Tambah Story</small>
                </div>
                
                <!-- User Stories -->
                @for($i = 1; $i <= 10; $i++)
                <div class="text-center" style="min-width: 100px;">
                    <div style="cursor: pointer;" onclick="viewStory({{ $i }})">
                        <img src="https://ui-avatars.com/api/?name=User+{{ $i }}&background=random" 
                             class="rounded-circle" 
                             style="width: 80px; height: 80px; border: 3px solid #28a745;" 
                             alt="User {{ $i }}">
                    </div>
                    <small class="d-block mt-2">User {{ $i }}</small>
                </div>
                @endfor
            </div>
        </div>
    </div>

    <!-- Posts Feed -->
    <h5 class="fw-bold mb-3">Feed</h5>
    
    @foreach($posts as $post)
    <div class="card mb-4 hover-card">
        <div class="card-body">
            <!-- Post Header -->
            <div class="d-flex align-items-center mb-3">
                <img src="{{ $post['user_avatar'] }}" 
                     class="rounded-circle me-3" 
                     style="width: 50px; height: 50px;" 
                     alt="{{ $post['user_name'] }}">
                <div class="flex-grow-1">
                    <h6 class="fw-bold mb-0">{{ $post['user_name'] }}</h6>
                    <small class="text-secondary">{{ $post['time'] }}</small>
                </div>
                <div class="dropdown">
                    <button class="btn btn-link text-secondary" data-bs-toggle="dropdown">
                        <i class="fas fa-ellipsis-h"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#"><i class="fas fa-bookmark me-2"></i> Simpan</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-flag me-2"></i> Laporkan</a></li>
                    </ul>
                </div>
            </div>

            <!-- Post Content -->
            <p class="mb-3">{{ $post['content'] }}</p>

            <!-- Post Image -->
            @if($post['image'])
            <img src="{{ $post['image'] }}" class="img-fluid rounded mb-3" alt="Post Image">
            @endif

            <!-- Post Stats -->
            <div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
                <span class="text-secondary">
                    <i class="fas fa-heart text-danger me-1"></i> {{ $post['likes'] }} Suka
                </span>
                <span class="text-secondary">{{ $post['comments'] }} Komentar</span>
            </div>

            <!-- Post Actions -->
            <div class="d-flex justify-content-around">
                <button class="btn btn-link text-decoration-none" onclick="likePost({{ $post['id'] }})">
                    <i class="far fa-heart me-2"></i> Suka
                </button>
                <button class="btn btn-link text-decoration-none" onclick="commentPost({{ $post['id'] }})">
                    <i class="far fa-comment me-2"></i> Komentar
                </button>
                <button class="btn btn-link text-decoration-none" onclick="sharePost({{ $post['id'] }})">
                    <i class="fas fa-share me-2"></i> Bagikan
                </button>
            </div>

            <!-- Comment Section (collapsed by default) -->
            <div id="comments-{{ $post['id'] }}" class="mt-3" style="display: none;">
                <div class="border-top pt-3">
                    <div class="d-flex mb-3">
                        <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=random" 
                             class="rounded-circle me-2" 
                             style="width: 40px; height: 40px;" 
                             alt="{{ auth()->user()->name }}">
                        <input type="text" class="form-control" placeholder="Tulis komentar...">
                    </div>
                    <!-- Sample Comments -->
                    <div class="d-flex mb-3">
                        <img src="https://ui-avatars.com/api/?name=User+Demo&background=random" 
                             class="rounded-circle me-2" 
                             style="width: 40px; height: 40px;" 
                             alt="User">
                        <div class="flex-grow-1 bg-light rounded p-2">
                            <h6 class="fw-bold mb-1 small">User Demo</h6>
                            <p class="mb-0 small">Keren banget! 👍</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <!-- Load More -->
    <div class="text-center mt-4">
        <button class="btn btn-outline-primary btn-lg px-5">
            <i class="fas fa-sync-alt me-2"></i> Muat Lebih Banyak
        </button>
    </div>

    <!-- Community Groups -->
    <div class="card mt-5">
        <div class="card-body">
            <h5 class="fw-bold mb-3">
                <i class="fas fa-users me-2 text-primary"></i>
                Grup Komunitas
            </h5>
            <div class="row">
                <div class="col-12 col-md-6 mb-3">
                    <div class="card hover-card">
                        <div class="card-body d-flex align-items-center">
                            <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3">
                                <i class="fas fa-motorcycle fa-2x text-primary"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="fw-bold mb-1">Komunitas Driver Japlo</h6>
                                <small class="text-secondary">1.234 anggota</small>
                            </div>
                            <button class="btn btn-sm btn-primary">Gabung</button>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <div class="card hover-card">
                        <div class="card-body d-flex align-items-center">
                            <div class="rounded-circle bg-danger bg-opacity-10 p-3 me-3">
                                <i class="fas fa-utensils fa-2x text-danger"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="fw-bold mb-1">Kuliner Lovers Japlo</h6>
                                <small class="text-secondary">5.678 anggota</small>
                            </div>
                            <button class="btn btn-sm btn-primary">Gabung</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .hover-card {
        transition: all 0.3s ease;
    }
    .hover-card:hover {
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
</style>

<script>
function openPostModal(type = null) {
    let message = 'Fitur posting akan segera hadir!\n\nAnda akan dapat:\n- Membuat status\n- Upload foto & video\n- Membuat polling\n- Berbagi pengalaman';
    if (type) {
        message = 'Fitur upload ' + type + ' akan segera hadir!';
    }
    alert(message);
}

function addStory() {
    alert('Fitur Story akan segera hadir!\n\nBagikan momen Anda dengan komunitas Japlo.');
}

function viewStory(id) {
    alert('Melihat story User ' + id + '\n\nFitur story viewer akan segera hadir!');
}

function likePost(id) {
    alert('Post #' + id + ' telah Anda sukai! ❤️');
}

function commentPost(id) {
    const commentSection = document.getElementById('comments-' + id);
    if (commentSection.style.display === 'none') {
        commentSection.style.display = 'block';
    } else {
        commentSection.style.display = 'none';
    }
}

function sharePost(id) {
    if (navigator.share) {
        navigator.share({
            title: 'Post dari Japlo',
            text: 'Lihat post menarik ini!',
            url: window.location.href
        }).then(() => {
            console.log('Berhasil dibagikan');
        }).catch((error) => {
            console.log('Gagal membagikan', error);
        });
    } else {
        alert('Post #' + id + ' dibagikan!\n\nFitur berbagi akan segera ditingkatkan.');
    }
}
</script>
@endsection
