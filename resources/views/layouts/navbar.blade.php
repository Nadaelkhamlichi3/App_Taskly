<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./static/bootstrap-5.3.3/css/bootstrap.min.css">
    <script src="./static/bootstrap-5.3.3/js/popper.min.js"></script>
    <script src="./static/bootstrap-5.3.3/js/bootstrap.min.js"></script>
    <link href="./static/styles.css" rel="stylesheet">
    <link rel="icon" href="{{ asset('static/tasklyicon.png') }}" type="image/png">
    <title>NavBar</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg  bg-custom text-custom p-0 shadow-sm">
        <div class="container-fluid ">
            <a href="#" class="navbar-brand">
                <img src="{{ asset('static/taskly.png') }}" alt="Taskly" width="200" height="80">
            </a>    
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="{{ route('welcome') }}" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link">Login</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('signup') }}" class="nav-link">Signup</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#aboutModal">About us</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#contactModal">Contact us</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="modal fade text-custom" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-custom1">
                <div class="modal-header">
                    <h3 class="modal-title"><b>Contact Us</b></h3>
                    <button type="button" class="btn-close p-3" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('contact.submit')}}" method="post" class="form-group">
                        @csrf
                        <div class="mb-2">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Name..." required>
                        </div>
                        <div class="mb-2">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email..." required>
                        </div>
                        <div class="mb-2">
                            <label for="message" class="form-label">Message</label>
                            <textarea name="message" id="message" class="form-control" rows="3" placeholder="Your message..." required></textarea>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <input type="submit" class="btn btn-dark" name="contact" value="Send Message">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade text-custom" id="aboutModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content bg-custom1">
                <div class="modal-header">
                    <h3 class="modal-title"><b>About Taskly</b></h3>
                    <button type="button" class="btn-close p-3" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-center"><b>Taskly</b> is a collaborative task management platform developed using a combination of modern technologies. 
                        The frontend is built with <b>HTML</b>, <b>CSS</b>, and <b>Bootstrap</b>, ensuring a smooth, responsive, and visually appealing user interface. 
                        For dynamic interactions, <b>JavaScript</b> and <b>AJAX</b> are used, allowing for a more interactive user experience without excessive page reloads. 
                        On the backend, the application is powered by <b>PHP</b>, handling request processing and data management, 
                        while <b>MySQL</b> is used to store information related to users, projects, and tasks. The development environment relies on <b>XAMPP</b>, 
                        facilitating local server execution and database management. With this robust architecture, <b>Taskly</b> enables teams to better organize, 
                        track, and collaborate efficiently on their projects. 🚀
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
