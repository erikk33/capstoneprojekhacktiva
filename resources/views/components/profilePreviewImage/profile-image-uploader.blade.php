{{--
    Component ini mandiri dan mengelola semua fungsionalitas terkait
    unggah foto, preview, dan zoom modal. CSS dan JS di-push ke stack.
--}}

@push('styles')
<style>
    /* Styling khusus untuk komponen ini */
    .profile-preview-container {
        display: none;
        text-align: center;
        margin-bottom: 1rem;
    }
    .profile-preview-image {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #e9ecef;
        cursor: pointer;
        transition: transform 0.2s ease-in-out;
    }
    .profile-preview-image:hover {
        transform: scale(1.05);
    }
    .image-zoom-modal {
        position: fixed; top: 0; left: 0; width: 100%; height: 100%;
        background-color: rgba(0, 0, 0, 0.85); display: flex;
        justify-content: center; align-items: center; z-index: 1050;
        opacity: 0; visibility: hidden;
        transition: opacity 0.3s ease, visibility 0.3s ease;
    }
    .image-zoom-modal.active {
        opacity: 1; visibility: visible;
    }
    .image-zoom-modal img {
        width: 90vw;
        height: 90vh;
        object-fit: contain;
        transform: scale(0.8);
        transition: transform 0.3s ease;
    }
    .image-zoom-modal.active img {
        transform: scale(1);
    }
    .close-zoom-btn {
        position: absolute; top: 15px; right: 20px;
        font-size: 40px; font-weight: 300; color: #fff;
        cursor: pointer; line-height: 1;
        transition: transform 0.3s ease, color 0.3s ease;
        text-shadow: 0 0 5px rgba(0,0,0,0.5);
    }
    .close-zoom-btn:hover {
        color: #ddd; transform: rotate(90deg);
    }
    .close-zoom-btn.bubble-effect {
        animation: bubbleClick 0.4s ease-out forwards;
    }
    @keyframes bubbleClick {
        0% { transform: scale(1); opacity: 1; }
        50% { transform: scale(1.3); }
        100% { transform: scale(0); opacity: 0; }
    }
    @media (min-width: 992px) {
        .image-zoom-modal img {
            width: 75vh;
            height: 75vh;
        }
    }
</style>
@endpush

<!-- HTML untuk Uploader dan Preview -->
<div class="mb-3">
    <label for="profile_photo" class="form-label">Foto Profil (Opsional)</label>
    <input class="form-control" type="file" id="profile_photo" name="profile_photo" accept="image/*">
</div>
<div class="profile-preview-container" id="imagePreviewContainer">
    <img src="#" id="imagePreview" alt="Preview Foto Profil" class="profile-preview-image"/>
</div>

<!-- HTML untuk Modal Zoom -->
<div class="image-zoom-modal" id="imageZoomModal">
    <span class="close-zoom-btn" id="closeZoomBtn">&times;</span>
    <img src="#" id="zoomedImage" alt="Zoomed Profile Photo"/>
</div>

@push('scripts')
<script>
    // Pastikan skrip ini berjalan setelah DOM dimuat
    document.addEventListener('DOMContentLoaded', function() {
        // Ambil elemen-elemen yang dibutuhkan dari DOM
        const photoInput = document.getElementById('profile_photo');
        const imagePreviewContainer = document.getElementById('imagePreviewContainer');
        const imagePreview = document.getElementById('imagePreview');
        const imageZoomModal = document.getElementById('imageZoomModal');
        const zoomedImage = document.getElementById('zoomedImage');
        const closeZoomBtn = document.getElementById('closeZoomBtn');

        // Pastikan semua elemen ada sebelum menambahkan event listener
        if (photoInput && imagePreviewContainer && imagePreview && imageZoomModal && zoomedImage && closeZoomBtn) {
            photoInput.addEventListener('change', function (event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    imagePreviewContainer.style.display = 'block';
                    reader.onload = function(e) {
                        imagePreview.setAttribute('src', e.target.result);
                    }
                    reader.readAsDataURL(file);
                } else {
                    imagePreviewContainer.style.display = 'none';
                }
            });

            function openModal() {
                zoomedImage.setAttribute('src', imagePreview.src);
                imageZoomModal.classList.add('active');
            }

            function closeModal() {
                closeZoomBtn.classList.add('bubble-effect');
                imageZoomModal.classList.remove('active');
                setTimeout(() => {
                    closeZoomBtn.classList.remove('bubble-effect');
                }, 400);
            }

            imagePreview.addEventListener('click', openModal);
            closeZoomBtn.addEventListener('click', closeModal);
            imageZoomModal.addEventListener('click', function(event) {
                if (event.target === imageZoomModal) {
                    closeModal();
                }
            });
        }
    });
</script>
@endpush
