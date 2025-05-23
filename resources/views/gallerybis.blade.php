<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matthieu Cauchy</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }
        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .photo-grid img {
            max-height: 90vh; /* Prevents the image height from exceeding the screen height */
            object-fit: contain;  /* Ensures the image covers the available space while maintaining aspect ratio */
            margin-bottom: 60px;
            border-radius: 1px;
        }
        .photo-grid {
            display: flex;
            flex-direction: column;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1></h1>
        <div class="photo-grid">
        <img src="{{ asset('storage/photos/commissioned-01.jpg') }}" alt="Photo 1">
            <img src="{{ asset('storage/photos/commissioned-02.jpg') }}" alt="Photo 1">
            <img src="{{ asset('storage/photos/commissioned-03.jpg') }}" alt="Photo 1">
            <img src="{{ asset('storage/photos/commissioned-04.jpg') }}" alt="Photo 1">
            <img src="{{ asset('storage/photos/commissioned-05.jpg') }}" alt="Photo 1">
            <img src="{{ asset('storage/photos/commissioned-06.jpg') }}" alt="Photo 1">
            <img src="{{ asset('storage/photos/commissioned-07.jpg') }}" alt="Photo 1">
            <img src="{{ asset('storage/photos/commissioned-08.jpg') }}" alt="Photo 1">
            <img src="{{ asset('storage/photos/commissioned-09.jpg') }}" alt="Photo 1">
            <img src="{{ asset('storage/photos/commissioned-10.jpg') }}" alt="Photo 1">
            <img src="{{ asset('storage/photos/commissioned-11.jpg') }}" alt="Photo 1">
            <img src="{{ asset('storage/photos/commissioned-12.jpg') }}" alt="Photo 1">
            <img src="{{ asset('storage/photos/commissioned-13.jpg') }}" alt="Photo 1">
            <img src="{{ asset('storage/photos/commissioned-14.jpg') }}" alt="Photo 1">
            <img src="{{ asset('storage/photos/commissioned-15.jpg') }}" alt="Photo 1">
            <img src="{{ asset('storage/photos/commissioned-16.jpg') }}" alt="Photo 1">
            <img src="{{ asset('storage/photos/commissioned-17.jpg') }}" alt="Photo 1">
            <img src="{{ asset('storage/photos/commissioned-18.jpg') }}" alt="Photo 1">
            <img src="{{ asset('storage/photos/commissioned-19.jpg') }}" alt="Photo 1">
            <img src="{{ asset('storage/photos/commissioned-20.jpg') }}" alt="Photo 1">
            <img src="{{ asset('storage/photos/commissioned-21.jpg') }}" alt="Photo 1">
            <img src="{{ asset('storage/photos/commissioned-22.jpg') }}" alt="Photo 1">
        </div>
    </div>

</body>
</html>
