<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('static/bootstrap-5.3.3/css/bootstrap.min.css') }}">
    <script src="{{ asset('static/bootstrap-5.3.3/js/bootstrap.min.js') }}"></script>
    <link href="{{ asset('static/styles.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('static/tasklyicon.png') }}" type="image/png">
    <title>Taskly</title>
</head>
<body>
    @include('layouts.navbar')

    <section class="container text-center m-5">
        <h1 class="title"><span class="name">Taskly</span> - <em>Simplify Your Team's Workflow</em></h1>
        <p class="info">
            Welcome to <strong>Taskly</strong>, the ultimate collaborative task management solution! 
            Streamline your team's workflow, organize tasks effortlessly, and boost productivity with 
            an intuitive and user-friendly interface. Whether you're managing projects, setting deadlines, 
            or tracking progress, Taskly keeps everyone aligned and focused. Get started today and 
            take your productivity to the next level!
        </p>
    </section>
    
    <div class="container py-4">
    <div id="mediaCarousel" class="carousel slide" data-bs-ride="carousel">
    
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#mediaCarousel" data-bs-slide-to="0" class="active"></button>
      <button type="button" data-bs-target="#mediaCarousel" data-bs-slide-to="1"></button>
      <button type="button" data-bs-target="#mediaCarousel" data-bs-slide-to="2"></button>
      <button type="button" data-bs-target="#mediaCarousel" data-bs-slide-to="3"></button>
      <button type="button" data-bs-target="#mediaCarousel" data-bs-slide-to="4"></button>
    </div>

    
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div class="ratio ratio-16x9 mx-auto" style="height: 650px;">
                <video controls class="rounded">
                <source src="{{ asset('static/WhatsAppVidéo.mp4') }}" type="video/mp4"></video>
            </div>
        </div>
        <div class="carousel-item">
            <img src="{{ asset('static/image1.jpg') }}" 
                class="d-block w-100 img-fluid rounded" 
                style="height: 650px; object-fit: cover;">
        </div>

        <div class="carousel-item">
            <img src="{{ asset('static/image2.jpg') }}" 
                class="d-block w-100 img-fluid rounded" 
                style="height: 650px; object-fit: cover;">
        </div>

        <div class="carousel-item">
            <img src="{{ asset('static/image3.jpg') }}" 
                class="d-block w-100 img-fluid rounded" 
                style="height: 650px; object-fit: cover;">
        </div>

        <div class="carousel-item">
            <img src="{{ asset('static/image4.jpg') }}" 
                class="d-block w-100 img-fluid rounded" 
                style="height: 650px; object-fit: cover;">
        </div>
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#mediaCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#mediaCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
  </div>
</div>

    @include('layouts.footer')
    
</body>
<body class="bg-custom1"></body>
</html>
