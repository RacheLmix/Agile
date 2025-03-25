@extends('admin.layout')
@section('content')
    <style>
        /* Container chính */
        .create-container {
            margin: 50px 0;
            padding: 20px;
        }

        .create-form {
            background: #ffffff;
            border: 1px solid #ddd;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
        }

        /* Tiêu đề */
        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
            font-size: 24px;
        }

        /* Liên kết Quay lại */
        .back-link {
            display: inline-block;
            margin-bottom: 20px;
            color: #4e73df;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        /* Form */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: bold;
            font-size: 14px;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            color: #333;
            box-sizing: border-box;
        }

        .form-group textarea {
            height: 150px;
            resize: vertical;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            border-color: #4e73df;
            outline: none;
            box-shadow: 0 0 5px rgba(78, 115, 223, 0.3);
        }

        /* Image preview */
        .image-preview {
            width: 100%;
            min-height: 100px;
            border: 1px dashed #ddd;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px;
            margin-top: 10px;
        }

        .image-preview:hover {
            border-color: #4e73df;
        }

        .img-preview {
            max-height: 100px;
            width: auto;
            border-radius: 4px;
        }

        /* Nút */
        .btn-submit {
            background-color: #4e73df;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
            width: 100%;
        }

        .btn-submit:hover {
            background-color: #4056a1;
        }

        /* Thông báo lỗi */
        .error-message {
            background-color: #ffebee;
            color: #e74c3c;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
            font-size: 14px;
            position: relative;
        }

        .error-message .close {
            background: none;
            border: none;
            color: #e74c3c;
            font-size: 14px;
            position: absolute;
            right: 10px;
            top: 10px;
            cursor: pointer;
        }
    </style>

    <div class="create-container">
        <a href="/admin/rooms" class="back-link">← Quay lại</a>
        <h1>Thêm Phòng Mới</h1>

        @if(isset($_SESSION['error']))
            <div class="error-message">
                {{ $_SESSION['error'] }}
                <button type="button" class="close" onclick="this.parentElement.style.display='none'">×</button>
                <?php unset($_SESSION['error']); ?>
            </div>
        @endif

        <form action="/admin/rooms/store" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Tên phòng</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="description">Mô tả</label>
                <textarea id="description" name="description" required></textarea>
            </div>

            <div class="form-group">
                <label for="homestay_id">Homestay</label>
                <select id="homestay_id" name="homestay_id" required>
                    <option value="">-- Chọn homestay --</option>
                    @foreach($homestays as $homestay)
                        <option value="{{ $homestay['id'] }}">{{ $homestay['name'] }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="quantity">Số lượng</label>
                <input type="number" id="quantity" name="quantity" min="1" value="1">
            </div>

            <div class="form-group">
                <label for="capacity">Sức chứa (người)</label>
                <input type="number" id="capacity" name="capacity" min="1" value="1">
            </div>

            <div class="form-group">
                <label for="price">Giá (VNĐ)</label>
                <input type="number" id="price" name="price" min="0" required>
            </div>

            <div class="form-group">
                <label for="status">Trạng thái</label>
                <select id="status" name="status">
                    <option value="available">Có sẵn</option>
                    <option value="unavailable">Đã thuê</option>
                    <option value="maintenance">Bảo trì</option>
                </select>
            </div>

            <div class="form-group">
                <label for="image">Ảnh phòng</label>
                <input type="file" id="image" name="image" accept="image/*">
                <div class="image-preview" id="imagePreview">
                    <img src="" alt="Ảnh xem trước" class="img-preview d-none">
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn-submit">Thêm Phòng</button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('image').addEventListener('change', function (e) {
            const previewImg = document.querySelector('.img-preview');
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    previewImg.src = e.target.result;
                    previewImg.classList.remove('d-none');
                }
                reader.readAsDataURL(this.files[0]);
            } else {
                previewImg.classList.add('d-none');
            }
        });

        // Validation đơn giản
        document.querySelector('.create-form').addEventListener('submit', function (e) {
            const requiredFields = this.querySelectorAll('[required]');
            let isValid = true;
            requiredFields.forEach(field => {
                if (!field.value) {
                    isValid = false;
                    field.style.borderColor = '#e74c3c';
                } else {
                    field.style.borderColor = '#ddd';
                }
            });
            if (!isValid) {
                e.preventDefault();
                alert('Vui lòng điền đầy đủ các trường bắt buộc!');
            }
        });
    </script>
@endsection