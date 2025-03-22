@extends('admin.layout')

@section('content')
    <div class="container-fluid px-4">
        <div class="card my-4 border-0 shadow-sm mx-auto" style="max-width: 900px;">
            <div class="card-header bg-primary text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Thêm Phòng Mới</h4>
                    <a href="/admin/rooms" class="btn btn-light btn-sm">
                        <i class="fas fa-arrow-left me-1"></i>Quay lại
                    </a>
                </div>
            </div>

            <div class="card-body bg-light">
                @if(isset($_SESSION['error']))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ $_SESSION['error'] }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <?php unset($_SESSION['error']); ?>
                    </div>
                @endif

                <form action="/admin/rooms/store" method="POST" enctype="multipart/form-data" class="needs-validation"
                      novalidate>
                    <div class="row justify-content-center">
                        <div class="col-lg-10 col-md-12">
                            <div class="mb-4">
                                <label for="name" class="form-label fw-bold">Tên phòng <span
                                            class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-lg border-primary" id="name"
                                       name="name"
                                       placeholder="Nhập tên phòng" required>
                            </div>

                            <div class="mb-4">
                                <label for="description" class="form-label fw-bold">Mô tả <span
                                            class="text-danger">*</span></label>
                                <textarea class="form-control border-primary" id="description" name="description"
                                          rows="3" placeholder="Mô tả chi tiết về phòng" required></textarea>
                            </div>
                            <div class="mb-4">
                                <label for="homestay_id" class="form-label fw-bold">Homestay <span
                                            class="text-danger">*</span></label>
                                <select class="form-select border-primary" id="homestay_id" name="homestay_id" required>
                                    <option value="">-- Chọn homestay --</option>
                                    @foreach($homestays as $homestay)
                                        <option value="{{ $homestay['id'] }}">{{ $homestay['name'] }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">Vui lòng chọn homestay</div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="quantity" class="form-label fw-bold">Số lượng</label>
                                        <input type="number" class="form-control border-primary" id="quantity"
                                               name="quantity" min="1" value="1">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="capacity" class="form-label fw-bold">Sức chứa (người)</label>
                                        <input type="number" class="form-control border-primary" id="capacity"
                                               name="capacity" min="1" value="1">
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="beds" class="form-label fw-bold">Số giường</label>
                                        <input type="number" class="form-control border-primary" id="beds" name="beds"
                                               min="1" value="1">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="size" class="form-label fw-bold">Kích thước (m²)</label>
                                        <input type="number" class="form-control border-primary" id="size" name="size"
                                               step="0.1" min="0">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="amenities" class="form-label fw-bold">Tiện nghi</label>
                                <input type="text" class="form-control border-primary" id="amenities" name="amenities"
                                       placeholder="TV, Điều hòa, Wifi, Tủ lạnh, ...">
                                <small class="text-muted">Liệt kê các tiện nghi, ngăn cách bằng dấu phẩy</small>
                            </div>

                            <div class="mb-4">
                                <label for="image" class="form-label fw-bold">Ảnh phòng</label>
                                <input type="file" class="form-control border-primary" id="image" name="image"
                                       accept="image/*">
                                <div class="mt-2">
                                    <div class="image-preview" id="imagePreview">
                                        <img src="" alt="Ảnh xem trước" class="img-preview img-fluid rounded d-none">
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="price" class="form-label fw-bold">Giá (VNĐ) <span
                                                    class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="number" class="form-control border-primary" id="price"
                                                   name="price" min="0" required>
                                            <span class="input-group-text bg-primary text-white">VNĐ</span>
                                        </div>
                                        <div class="invalid-feedback">Vui lòng nhập giá phòng</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="status" class="form-label fw-bold">Trạng thái</label>
                                        <select class="form-select border-primary" id="status" name="status">
                                            <option value="available">Có sẵn</option>
                                            <option value="booked">Đã đặt</option>
                                            <option value="maintenance">Bảo trì</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center mt-5">
                                <a href="/admin/rooms" class="btn btn-secondary btn-lg px-4">
                                    <i class="fas fa-times me-1"></i>Hủy
                                </a>
                                <button type="submit" class="btn btn-primary btn-lg ms-3 px-4">
                                    <i class="fas fa-save me-1"></i>Thêm Phòng
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <style>
        .form-label {
            margin-bottom: 0.5rem;
            color: #3a3a3a;
            font-size: 0.95rem;
        }

        .container-fluid {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: calc(100vh - 100px);
        }

        .card {
            width: 100%;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.05) !important;
        }

        .card-body {
            background-color: #f8f9fe;
            padding: 2.5rem;
        }

        form {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
        }

        .card-header {
            background-color: #5578ea !important;
        }

        .btn-primary {
            background-color: #5578ea;
            border-color: #5578ea;
        }

        .btn-primary:hover {
            background-color: #4064d7;
            border-color: #4064d7;
        }

        .border-primary {
            border-color: #d1d9f0 !important;
        }

        .form-control, .form-select {
            padding: 0.6rem 0.85rem;
            border-radius: 8px;
            border-width: 1px;
            transition: all 0.2s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: #5578ea;
            box-shadow: 0 0 0 0.25rem rgba(85, 120, 234, 0.25);
        }

        .form-control::placeholder {
            color: #b0b0b0;
        }

        .form-control-lg {
            font-size: 1.1rem;
        }

        .image-preview {
            width: 100%;
            min-height: 170px;
            border: 2px dashed #d1d9f0;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 15px;
            position: relative;
            background-color: #f8f9fe;
            transition: all 0.2s ease;
        }

        .image-preview:hover {
            border-color: #5578ea;
        }

        .img-preview {
            max-height: 200px;
            width: auto;
        }

        .invalid-feedback {
            font-size: 80%;
        }

        .btn {
            border-radius: 8px;
            padding: 0.5rem 1.5rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .btn-lg {
            padding: 0.7rem 2rem;
            font-size: 1rem;
        }

        .input-group-text {
            border-radius: 0 8px 8px 0;
            padding: 0.6rem 1rem;
            font-weight: 500;
        }

        @media (max-width: 767.98px) {
            .container-fluid {
                padding: 1rem;
                min-height: auto;
            }

            .card-body {
                padding: 1.5rem;
            }

            .btn-lg {
                padding: 0.6rem 1.5rem;
            }
        }
    </style>

    <script>
        document.getElementById('image').addEventListener('change', function (e) {
            const previewImg = document.querySelector('.img-preview');
            const previewText = document.querySelector('.preview-text');

            if (this.files && this.files[0]) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    previewImg.src = e.target.result;
                    previewImg.classList.remove('d-none');
                    previewText.classList.add('d-none');
                }

                reader.readAsDataURL(this.files[0]);
            } else {
                previewImg.classList.add('d-none');
                previewText.classList.remove('d-none');
            }
        });

        (function () {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
@endsection
