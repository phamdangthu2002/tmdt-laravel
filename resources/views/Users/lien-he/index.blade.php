@extends('Users.index')
@section('main')
    <title>Thông Tin Liên Hệ</title>
    <style>
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        h1 {
            font-size: 2.5rem;
            color: #333;
            margin-bottom: 1rem;
        }

        h2 {
            font-size: 2rem;
            color: #555;
            margin-bottom: 0.75rem;
        }

        .form-control {
            border-radius: 0.25rem;
            border-color: #ced4da;
            box-shadow: none;
        }

        .form-group label {
            font-weight: bold;
            color: #333;
        }

        .form-group input,
        .form-group textarea {
            border-radius: 0.25rem;
            padding: 0.75rem;
            border: 1px solid #ced4da;
        }

        .form-group textarea {
            resize: vertical;
        }

        .btn-primary {
            background-color: #28a745;
            border-color: #28a745;
            color: #fff;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
        }

        .btn-primary:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        .row {
            margin-bottom: 2rem;
        }

        .map-container {
            position: relative;
            padding-top: 56.25%; /* 16:9 aspect ratio */
            height: 0;
            overflow: hidden;
        }

        .map-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .contact-info {
            background: #f8f9fa;
            padding: 1.5rem;
            border-radius: 0.25rem;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .contact-info p {
            margin-bottom: 0.75rem;
            font-size: 1rem;
            color: #333;
        }
    </style>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Thông Tin Liên Hệ</h1>

        <!-- Thông Tin Liên Hệ -->
        <div class="row">
            <div class="col-md-6 contact-info">
                <h2>Thông Tin Liên Hệ</h2>
                <p><strong>Địa chỉ:</strong> 123 Đường XYZ, Thành phố ABC, Việt Nam</p>
                <p><strong>Điện thoại:</strong> +84 123 456 789</p>
                <p><strong>Email:</strong> contact@example.com</p>
            </div>

            <div class="col-md-6">
                <h2>Vị trí của chúng tôi</h2>
                <!-- Bản đồ -->
                <div class="map-container">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.926813912644!2d106.68391881435545!3d10.790732761999246!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3175297b7904b1c1%3A0xf6f6581d287c86d0!2sSaigon%20Centre%20Building!5e0!3m2!1svi!2s!4v1632132795654!5m2!1svi!2s"
                        allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>

        <!-- Biểu mẫu liên hệ -->
        <div class="row mt-5">
            <div class="col-md-12">
                <h2>Liên hệ với chúng tôi</h2>
                <form action="#" method="post">
                    <div class="form-group">
                        <label for="name">Họ và Tên:</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Tin nhắn:</label>
                        <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Gửi</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
