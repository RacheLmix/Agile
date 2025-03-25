@extends('admin.layout')
@section('content')
<div class="create-container">
    <a href="/admin/users" class="back-link">← Back to List</a>
    <h1>Edit User Status</h1>

    <div class="create-form">
        <p>Current Account Status: <strong>{{ ucfirst($users['status']) }}</strong></p>

        <form action="/admin/users/update/{{ $users['id'] }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="user_id" value="{{ $users['id'] }}">

            <div class="form-group">
                <label for="full_name">Full Name</label>
                <input type="text" id="full_name" disabled value="{{ $users['full_name'] }}">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" disabled value="{{ $users['email'] }}">
            </div>

            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" id="phone" disabled value="{{ $users['phone'] }}">
            </div>

            <div class="form-group">
                <label for="status">Select Status</label>
                <select id="status" name="status">
                    @if($users['status'] === 'active')
                        <option value="inactive">Inactive</option>
                    @elseif($users['status'] === 'inactive')
                        <option value="banned">Banned</option>
                    @elseif($users['status'] === 'banned')
                        <option disabled>Account Banned - Contact Administrator</option>
                    @else
                        <option disabled>No Further Changes Allowed</option>
                    @endif
                </select>
            </div>

            <div class="form-group">
                <button type="submit" class="btn-submit" {{ $users['status'] === 'banned' ? 'disabled' : '' }}>Update Status</button>
            </div>
        </form>
    </div>
</div>

<style>
    .create-container {
        margin: 70px 0 0 280px;
        padding: 20px;
    }

    .create-form {
        background: #ffffff;
        border: 1px solid #ddd;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: #333;
        font-weight: bold;
    }

    .form-group input,
    .form-group select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
    }

    .form-group input[disabled] {
        background-color: #f0f0f0;
        color: #888;
    }

    .btn-submit {
        background-color: #4e73df;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s;
    }

    .btn-submit:hover {
        background-color: #4056a1;
    }

    .btn-submit:disabled {
        background-color: #bbb;
        cursor: not-allowed;
    }

    h1 {
        text-align: center;
        margin-bottom: 30px;
        color: #333;
    }

    .back-link {
        display: inline-block;
        margin-bottom: 20px;
        color: #4e73df;
        text-decoration: none;
    }

    .back-link:hover {
        text-decoration: underline;
    }
</style>
@endsection