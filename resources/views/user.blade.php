<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT. Lazuard Agritech</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            padding-top: 70px;
            background-size: cover;
            background-position: center;
            height: 100vh;
            margin: 0;
            background-color: #F9F7F7;
        }

        .profile-section,
        .produk-section {
            margin-top: 40px;
            color: #333333;
        }

        .profile-section h2,
        .produk-section h2 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 15px;
            color: #333333;
        }

        .profile-section p,
        .produk-section p {
            font-size: 16px;
            line-height: 1.6;
            color: #333333;
        }

        .profile-section ul,
        .produk-section ul {
            list-style-type: disc;
            padding-left: 20px;
            color: #333333;
        }

        .profile-section ul li,
        .produk-section ul li {
            margin-bottom: 10px;
            color: #333333;
        }

        .profile-section img,
        .produk-section img {
            max-width: 100%;
            height: auto;
            margin-bottom: 20px;
        }

        .profile-section .cta,
        .produk-section .cta {
            margin-top: 20px;
            text-align: center;
        }

        .produk-section .card {
            margin-bottom: 20px;
        }

        .produk-section .card img {
            height: 200px;
            object-fit: cover;
        }

        .produk-section .card-body {
            text-align: center;
        }

        .carousel-inner img {
            height: auto;
            max-height: 400px;
            object-fit: cover;
        }

        .card {
            margin-bottom: 20px;
        }

        .paragraf,
        h2 {
            font-size: 14px;
            font-family: 'Montserrat', sans-serif;
            color: #333333;
        }

        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 10px 10px 0 0;
        }

        .card-body {
            display: flex;
            flex-direction: column;
            align-items: start;
        }

        .card-text {
            display: flex;
            align-items: center;
        }

        .card-text span {
            width: 50px;
            display: inline-block;
        }

        .nav-link:hover {
            cursor: pointer;
        }

        .modal-content {
            transition: transform 0.3s;
        }

        .modal.show .modal-content {
            transform: scale(1.1);
        }

        .btn-primary {
            transition: background-color 0.3s, transform 0.3s;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        .carousel-item {
            transition: transform 0.5s ease-in-out;
        }

        .card {
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .card-gradient {
            display: flex;
            flex-direction: column;
            align-items: start;
            background-color: #EDF1D6;
        }

        footer {
            background-color: #343a40;
            color: white;
            padding: 10px 10px;
            /* Kurangi padding */
            text-align: center;
        }

        footer a {
            color: #f8f9fa;
            text-decoration: none;
        }

        footer a:hover {
            color: #adb5bd;
        }

        .footer-links {
            margin-bottom: 10px;
            /* Kurangi margin */
        }

        .footer-links a {
            margin: 0 5px;
            /* Kurangi margin */
        }

        .social-icons a {
            margin: 0 5px;
            /* Kurangi margin */
            font-size: 18px;
            /* Kurangi ukuran font */
            transition: color 0.3s;
        }

        .social-icons a:hover {
            color: #adb5bd;
            /* Default hover color */
        }

        .social-icons a:hover .fa-facebook-f {
            color: #3b5998;
            /* Facebook color */
        }

        .social-icons a:hover .fa-twitter {
            color: #1da1f2;
            /* Twitter color */
        }

        .social-icons a:hover .fa-instagram {
            color: #e1306c;
            /* Instagram color */
        }

        .social-icons a:hover .fa-linkedin-in {
            color: #0077b5;
            /* LinkedIn color */
        }

        .footer-section {
            margin-bottom: 5px;
            /* Kurangi margin */
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('image/LOGO.png') }}" style="max-width: 4%; height: auto;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-start" id="navbarNav">
                <ul class="navbar-nav ms-5">
                    <li class="nav-item">
                        <a class="nav-link" id="profile-link" href="#profile">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="produk-link" href="#produk">Products</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            More
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#contact">Contact</a></li>
                            <li><a class="dropdown-item" href="#services">Services</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#faq">FAQ</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @if(session('success') || session('error') || $errors->any())
        <div class="modal fade" id="alertModal" tabindex="-1" aria-labelledby="alertModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="alertModalLabel">Notification</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif

                        @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                        @endif

                        @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endif
        <div id="carouselExampleIndicators" class="carousel slide mt-5" data-bs-ride="carousel" data-bs-interval="3000">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('image/1.jpg') }}" class="d-block w-100" alt="Carousel Image 1">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('image/2.jpg') }}" class="d-block w-100" alt="Carousel Image 2">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('image/3.jpg') }}" class="d-block w-100" alt="Carousel Image 3">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>


        <section id="profile" class="profile-section pt-4 ">
            <div class="text-center">

            </div>
            <div class="row flex justify-content-between pt-3">
                <div class="card shadow mt-3 col-7 card-gradient">
                    <div class="card-body">
                        <h2>Company Profile</h2>
                        <img src="{{ asset('image/LOGO.png') }}" style="width: auto;" alt="Company Profile">
                        <p class="paragraf">Kami adalah perusahaan yang berdedikasi untuk memberikan produk dan layanan terbaik kepada pelanggan kami. Dengan pengalaman bertahun-tahun di industri, kami terus berinovasi dan berkembang untuk memenuhi kebutuhan pasar yang dinamis.</p>
                        <div class="cta">
                            <a href="#produk" class="btn btn-primary">Lihat Produk Kami</a>
                        </div>
                    </div>
                </div>
                <div class="card shadow rounded mt-3 col-4 card-gradient">
                    <div class="card-body">
                        <h2>Visi dan Misi</h2>
                        <p class="paragraf">Kami memiliki visi untuk menjadi perusahaan terkemuka di bidang industri dan misi untuk memberikan produk dan layanan terbaik kepada pelanggan kami.</p>
                        <ul>
                            <li><strong>Visi:</strong> Menjadi perusahaan terkemuka di bidang industri.</li>
                            <li><strong>Misi:</strong> Memberikan produk dan layanan terbaik kepada pelanggan.</li>
                        </ul>
                    </div>
                </div>
                <div class="card shadow border rounded mt-3">
                    <div class="card-body">
                        <h2>Sejarah Perusahaan</h2>
                        <img src="{{ asset('images/company-history.jpg') }}" alt="Company History">
                        <p class="paragraf">Sejak didirikan pada tahun 2010, kami telah berkembang pesat dan mencapai berbagai pencapaian penting.</p>
                        <ul>
                            <li><strong>2010:</strong> Perusahaan didirikan.</li>
                            <li><strong>2015:</strong> Memperluas operasi ke luar negeri.</li>
                            <li><strong>2020:</strong> Mencapai pendapatan tertinggi.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section id="produk" class="produk-section pt-4">
            <h2 style="text-align: center;">Produk Kami</h2>
            <div class="row pt-2">
                @foreach($products as $product)
                <div class="col-md-3">
                    <div class="card shadow">
                        <img src="{{ asset('images/'.$product->image) }}" class="card-img-top" alt="Product Picture">
                        <div class="card-body">
                            <h3 class="card-title">{{ $product->name }}</h3>
                            <p class="card-text" style="text-align: left;">
                                Stock : {{ $product->stock }} Kg <br>
                                Price : {{ $product->price }} IDR <br>
                            </p>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#orderModal" data-product-code="{{ $product->code }}" data-product-price="{{ $product->price }}">
                                Order Now
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
                <!-- Modal -->
                <div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="orderModalLabel">Order Form</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="orderForm" action="{{ route('order.place') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_code" id="product_code">
                                    <div class="mb-3">
                                        <label for="customer_name" class="form-label">Nama</label>
                                        <input type="text" class="form-control" id="customer_name" name="customer_name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="customer_email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="customer_email" name="customer_email" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="customer_phone" class="form-label">Phone</label>
                                        <input type="tel" class="form-control" id="customer_phone" name="customer_phone" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="quantity" class="form-label">Quantity</label>
                                        <input type="number" class="form-control" id="quantity" name="quantity" value="1" min="1" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="total" class="form-label">Total</label>
                                        <input type="text" class="form-control" id="total" name="total" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="customer_address" class="form-label">Address</label>
                                        <textarea name="customer_address" id="customer_address" class="form-control" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Send Order</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4 mt-5">
                    <h5>Kontak Kami</h5>
                    <p>Email: info@perusahaan.com</p>
                    <p>Telepon: +62 123 456 789</p>
                </div>
                <div class="col-md-4 mt-2">
                    <h5>Link Terkait</h5>
                    <div class="footer-links">
                        <a href="#profile">Profile</a>
                        <a href="#produk">Produk</a>
                        <a href="#contact">Kontak</a>
                    </div>
                </div>
                <div class="col-md-4 mt-5">
                    <h5>Ikuti Kami</h5>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="https://instagram.com/pt.lazuardagritech" target="_blank"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
            <p class="">&copy; 2023 Perusahaan. All rights reserved.</p>
        </div>
        <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    </footer>
    <script>
        document.querySelectorAll('.btn-primary[data-bs-toggle="modal"]').forEach(button => {
            button.addEventListener('click', function() {
                const productCode = this.getAttribute('data-product-code');
                document.getElementById('product_code').value = productCode;
                document.getElementById('quantity').value = 1; // Default quantity
            });

        });
        document.getElementById('quantity').addEventListener('input', function() {
            const quantity = this.value;
            const productPrice = document.querySelector('.btn-primary[data-bs-toggle="modal"]').getAttribute('data-product-price');
            const total = quantity * productPrice;
            document.getElementById('total').value = total;
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<script>
    const profileLink = document.getElementById('profile-link');
    const produkLink = document.getElementById('produk-link');

    profileLink.addEventListener('click', (e) => {
        e.preventDefault();
        document.getElementById('profile').scrollIntoView({
            behavior: 'smooth'
        });
    });

    produkLink.addEventListener('click', (e) => {
        e.preventDefault();
        document.getElementById('produk').scrollIntoView({
            behavior: 'smooth'
        });
    });
    document.querySelectorAll('.nav-link').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href').substring(1);
            document.getElementById(targetId).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });

    // Tambahkan interaktivitas untuk modal
    document.querySelectorAll('.btn-primary[data-bs-toggle="modal"]').forEach(button => {
        button.addEventListener('click', function() {
            const productCode = this.getAttribute('data-product-code');
            const productPrice = this.getAttribute('data-product-price');
            document.getElementById('product_code').value = productCode;
            document.getElementById('quantity').value = 1; // Default quantity
            document.getElementById('total').value = productPrice; // Default total
        });
    });

    // Update total price dynamically
    document.getElementById('quantity').addEventListener('input', function() {
        const quantity = this.value;
        const productPrice = document.querySelector('.btn-primary[data-bs-toggle="modal"]').getAttribute('data-product-price');
        const total = quantity * productPrice;
        document.getElementById('total').value = total;
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const input = document.querySelector("#customer_phone");
        const iti = window.intlTelInput(input, {
            initialCountry: "auto",
            geoIpLookup: function(callback) {
                fetch('https://ipinfo.io/json', {
                        headers: {
                            'Accept': 'application/json'
                        }
                    })
                    .then((resp) => resp.json())
                    .then((resp) => {
                        const countryCode = (resp && resp.country) ? resp.country : "us";
                        callback(countryCode);
                    });
            },
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
        });

        // Update hidden input with full phone number on form submit
        const form = document.querySelector("#orderForm");
        form.addEventListener('submit', function() {
            const phoneNumber = iti.getNumber();
            input.value = phoneNumber;
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const alertModal = new bootstrap.Modal(document.getElementById('alertModal'));
        if (alertModal) {
            alertModal.show();
            setTimeout(() => {
                alertModal.hide();
            }, 3000);
        }
    });
</script>