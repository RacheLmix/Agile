@extends('admin.layout')
@section('content')
    <style>
        .d-none {
            display: none !important;
        }
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
            width: 15%;
            min-height: 100px;
            border: 1px dashed #ddd;
            border-radius: 4px;
            padding: 10px;
            margin-top: 10px;
        }

        .image-preview:hover {
            border-color: #4e73df;
        }

        .img-preview {
            max-width: 100%;
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
        .image{
            width: 15%;
            border-radius: 4px;
            border: 1px dashed #ddd;
            padding: 10px;
        }
    </style>

    <div class="create-container">
        <a href="/admin/rooms" class="back-link">← Quay lại</a>
        <h1>Sửa Phòng</h1>
        @if(isset($_SESSION['error']))
            <div class="error-message">
                {{ $_SESSION['error'] }}
                <button type="button" class="close" onclick="this.parentElement.style.display='none'">×</button>
            </div>
            @unset($_SESSION['error'])
        @endif

        <form action="/admin/rooms/update/{{$room['id']}}" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Tên phòng</label>
                <input type="text" id="name" name="name" value="{{$room['name']}}" required>
            </div>

            <div class="form-group">
                <label for="description">Mô tả</label>
                <textarea id="description" name="description" required>{{$room['description']}}</textarea>
            </div>

            <div class="form-group">
                <label for="homestay_id">Homestay</label>
                <select id="homestay_id" name="homestay_id" required>
                    <option value="">-- Chọn homestay --</option>
                    @foreach($homestays as $homestay)
                        <option value="{{ $homestay['id'] }}" {{$room['homestay_id'] == $homestay['id'] ? 'selected' : '' }}>{{ $homestay['name'] }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="quantity">Số lượng</label>
                <input type="number" id="quantity" name="quantity" value="{{$room['quantity']}}" min="1" value="1">
            </div>

            <div class="form-group">
                <label for="capacity">Sức chứa (người)</label>
                <input type="number" id="capacity" name="capacity" value="{{$room['capacity']}}" min="1" value="1">
            </div>

            <div class="form-group">
                <label for="price">Giá (VNĐ)</label>
                <input type="number" id="price" value="{{$room['price']}}" name="price" min="0" required>
            </div>

            <div class="form-group">
                <label for="status">Trạng thái</label>
                <select id="status" name="status">
                    <option value="available" {{ $room['status'] == 'available' ? 'selected' : '' }}>Có sẵn</option>
                    <option value="unavailable" {{ $room['status'] == 'unavailable' ? 'selected' : '' }}>Đã thuê</option>
                    <option value="maintenance" {{ $room['status'] == 'maintenance' ? 'selected' : '' }}>Bảo trì</option>
                </select>
            </div>

            <div class="form-group">
                <label for="image">Ảnh phòng</label>
                <img src="{{ file_url($room['image1']) }}" class="image" alt="">
                <input type="file" id="image" name="image1" accept="image/*">
                <div class="image-preview" id="imagePreview">
                    <img src="" alt="Ảnh xem trước" class="img-preview d-none">
                </div>
            </div>

            <div class="form-group">
                <label for="image2">Ảnh phụ 1</label>
                <img src="{{ file_url($room['image2']) }}" class="image" alt="">
                <input type="file" id="image2" name="image2" accept="image/*">
                <div class="image-preview" id="preview2">
                    <img src="" alt="Ảnh xem trước" class="img-preview d-none">
                </div>
            </div>

            <div class="form-group">
                <label for="image3">Ảnh phụ 2</label>
                <img src="{{ file_url($room['image3']) }}" class="image" alt="">
                <input type="file" id="image3" name="image3" accept="image/*">
                <div class="image-preview" id="preview3">
                    <img src="" alt="Ảnh xem trước" class="img-preview d-none">
                </div>
            </div>

            <div class="form-group">
                <label for="image4">Ảnh phụ 3</label>
                <img src="{{ file_url($room['image4']) }}" class="image" alt="">
                <input type="file" id="image4" name="image4" accept="image/*">
                <div class="image-preview" id="preview4">
                    <img src="" alt="Ảnh xem trước" class="img-preview d-none">
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn-submit">Sửa Phòng </button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            function previewImage(inputId, previewId) {
                const imageInput = document.getElementById(inputId);
                const previewContainer = document.getElementById(previewId);
                const previewImg = previewContainer.querySelector('.img-preview');

                imageInput.addEventListener('change', function () {
                    if (this.files && this.files[0]) {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            previewImg.src = e.target.result;
                            previewImg.classList.remove('d-none'); // Sử dụng classList.remove thay vì style.display
                        };
                        reader.readAsDataURL(this.files[0]);
                    } else {
                        previewImg.classList.add('d-none'); // Ẩn ảnh nếu không có file
                    }
                });
            }

            // Gọi hàm cho từng input ảnh
            previewImage('image', 'imagePreview');
            previewImage('image2', 'preview2');
            previewImage('image3', 'preview3');
            previewImage('image4', 'preview4');
        });

        if (form) {
            form.addEventListener('submit', function (e) {
                let isValid = true;
                const requiredFields = this.querySelectorAll('[required]');

                requiredFields.forEach(field => {
                    const errorSpan = field.nextElementSibling;
                    if (!field.value.trim()) {
                        isValid = false;
                        field.style.borderColor = '#e74c3c';

                        // Thêm thông báo lỗi nếu chưa có
                        if (!errorSpan || !errorSpan.classList.contains('error-text')) {
                            const errorMessage = document.createElement('span');
                            errorMessage.classList.add('error-text');
                            errorMessage.style.color = '#e74c3c';
                            errorMessage.style.fontSize = '12px';
                            errorMessage.innerText = 'Trường này là bắt buộc!';
                            field.insertAdjacentElement('afterend', errorMessage);
                        }
                    } else {
                        field.style.borderColor = '#ddd';
                        if (errorSpan && errorSpan.classList.contains('error-text')) {
                            errorSpan.remove();
                        }
                    }
                });

                if (!isValid) {
                    e.preventDefault();
                    alert('Vui lòng điền đầy đủ các trường bắt buộc!');
                }
            });
        }
    </script>
@endsection