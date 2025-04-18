@extends('client.profile.layout')

@section('content')
    <style>
        /* Main Container */
        .main-container {
            display: flex;
            max-width: 1200px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            min-height: calc(100vh - 170px); /* Adjust for header and margin */
        }

        /* Sidebar */
        .sidebar {
            width: 280px;
            background-color: #fafafa;
            padding: 30px 20px;
            border-right: 1px solid #e5e7eb;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .sidebar-header {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar-header i {
            color: #f59e0b;
            font-size: 24px;
        }

        .sidebar-header h1 {
            font-size: 20px;
            font-weight: 600;
            color: #1f2937;
        }

        .sidebar .user-info {
            display: flex;
            flex-direction: column;
            gap: 4px;
            padding: 15px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .sidebar .user-name {
            font-size: 16px;
            font-weight: 600;
            color: #1f2937;
        }

        .sidebar .user-email {
            font-size: 13px;
            color: #6b7280;
            word-break: break-all;
        }

        .sidebar-nav {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .sidebar-nav a {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            color: #4b5563;
            text-decoration: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .sidebar-nav a.active {
            background-color: #e3f2fd;
            color: #2563eb;
            font-weight: 600;
        }

        .sidebar-nav a:hover {
            background-color: #f1f5f9;
        }

        .sidebar-nav i {
            margin-right: 10px;
            font-size: 16px;
            width: 20px;
            text-align: center;
        }

        /* Main Content */
        .content {
            flex: 1;
            padding: 40px;
            background-color: #ffffff;
        }

        .profile-card {
            background-color: #ffffff;
            border-radius: 12px;
            padding: 30px;
            max-width: 600px;
            margin: 0 auto;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .profile-card h2 {
            font-size: 24px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 25px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            color: #374151;
            margin-bottom: 8px;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            background-color: #f9fafb;
            color: #1f2937;
            font-size: 15px;
            outline: none;
            transition: border-color 0.2s;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .form-group input[readonly],
        .form-group textarea[readonly] {
            background-color: #e5e7eb;
            cursor: not-allowed;
        }

        .form-group .input-icon {
            position: relative;
        }

        .form-group .input-icon i {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6b7280;
            font-size: 16px;
        }

        .form-group textarea {
            resize: none;
            height: 100px;
        }

        .button-container {
            margin-top: 30px;
            text-align: center;
        }

        .save-button {
            background-color: #2563eb;
            color: #ffffff;
            padding: 12px 30px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 15px;
            font-weight: 500;
            transition: background-color 0.2s;
            display: inline-block;
        }

        .save-button:hover {
            background-color: #1d4ed8;
        }

        /* Responsive Adjustments for Main Content */
        @media (max-width: 992px) {
            .main-container {
                flex-direction: column;
                margin: 15px;
                min-height: auto;
            }

            .sidebar {
                width: 100%;
                border-right: none;
                border-bottom: 1px solid #e5e7eb;
            }

            .content {
                padding: 30px;
            }

            .profile-card {
                max-width: 100%;
            }
        }

        @media (max-width: 576px) {
            .content {
                padding: 20px;
            }

            .profile-card {
                padding: 20px;
            }

            .profile-card h2 {
                font-size: 20px;
            }

            .form-group input,
            .form-group textarea {
                padding: 10px;
                font-size: 14px;
            }

            .save-button {
                padding: 10px 20px;
                font-size: 14px;
            }
        }
    </style>

    <!-- Main Content -->
    <div class="content">
        <div class="profile-card">
            <h2>Thông tin cá nhân</h2>
            <div class="form-group">
                <label>Họ và tên</label>
                <input type="text" value="{{ $user['full_name'] }}" readonly>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" value="{{ $user['email'] }}" readonly>
            </div>
            <div class="form-group">
                <label>Số điện thoại</label>
                <input type="text" value="{{ $user['phone'] }}" readonly>
            </div>
            <div class="form-group">
                <label>Ngày tham gia</label>
                <div class="input-icon">
                    <input type="text" value="{{ date('d/m/Y', strtotime($user['created_at'])) }}" readonly>
                    <i class="fas fa-calendar-alt"></i>
                </div>
            </div>
            <div class="button-container">
                <a href="/profile/edit/{{ $user['id'] }}" class="save-button">Chỉnh sửa thông tin</a>
            </div>
        </div>
    </div>
@endsection