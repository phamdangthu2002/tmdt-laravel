@extends('Users.index')
@section('main')
    <title>Thông Tin</title>
    <style>
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-title {
            font-size: 2rem;
            color: #333;
            margin-bottom: 1rem;
        }

        .info-card {
            background-color: #f8f9fa;
            border-radius: 0.25rem;
            padding: 1.5rem;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }

        .info-card h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: #555;
        }

        .info-card p {
            font-size: 1rem;
            color: #333;
            line-height: 1.5;
        }

        .info-card img {
            max-width: 100%;
            border-radius: 0.25rem;
        }
    </style>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Thông Tin</h1>

        <!-- Giới thiệu -->
        <div class="info-card">
            <h3>Giới thiệu</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent vel risus eu ante pharetra faucibus a eget nulla. Morbi et felis in nisi egestas hendrerit a at libero.</p>
            <img src="https://via.placeholder.com/800x400" alt="Giới thiệu">
        </div>

        <!-- Dịch vụ -->
        <div class="info-card">
            <h3>Dịch vụ của chúng tôi</h3>
            <p>Sed vestibulum quam ut nunc vestibulum, id fermentum felis ultricies. Nam sit amet eros vel lorem dictum cursus sed id arcu.</p>
            <img src="https://via.placeholder.com/800x400" alt="Dịch vụ">
        </div>

        <!-- Liên hệ -->
        <div class="info-card">
            <h3>Liên hệ với chúng tôi</h3>
            <p>Phasellus ac nisi eget nisl viverra malesuada non nec nisi. Integer a arcu vitae eros dapibus auctor sed sit amet libero.</p>
            <img src="https://via.placeholder.com/800x400" alt="Liên hệ">
        </div>
    </div>
@endsection
