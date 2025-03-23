<?php
$files = json_decode(file_get_contents('files/files.json'), true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>File Storage</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9O52fxjLfqnTEwQUANTwmrmc8tJLFO6jFmkpqtkgzg9GU" crossorigin="anonymous">

    <!-- Custom CSS for light blue theme -->
    <style>
      :root {
        --primary-color: #ADD8E6; /* Light Blue */
        --secondary-color: #87CEEB; /* Slightly darker blue */
        --text-color: #333; /* Dark text for light background */
        --bg-color: #F0F8FF; /* Lightest Blue */
        --dark-mode-text-color: #eee; /* Light text for dark background */
        --dark-mode-bg-color: #343a40; /* Dark background */
        --dark-mode-primary-color: #66B2FF; /* Lighter blue for dark mode */
        --dark-mode-secondary-color: #4682B4; /* Slightly lighter blue for dark mode */
      }

      body {
        background-color: var(--bg-color);
        color: var(--text-color);
        transition: background-color 0.3s, color 0.3s;
        overflow: hidden; /* Hide scrollbars */
      }

      .dark-mode body {
          background-color: var(--dark-mode-bg-color);
          color: var(--dark-mode-text-color);
      }

      .btn-primary {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
        color: var(--text-color);
      }

      .btn-primary:hover, .btn-primary:focus {
        background-color: var(--secondary-color);
        border-color: var(--secondary-color);
        color: var(--text-color);
      }

      .dark-mode .btn-primary {
          background-color: var(--dark-mode-primary-color);
          border-color: var(--dark-mode-primary-color);
          color: var(--dark-mode-text-color);
      }

      .dark-mode .btn-primary:hover, .dark-mode .btn-primary:focus {
          background-color: var(--dark-mode-secondary-color);
          border-color: var(--dark-mode-secondary-color);
      }


      .navbar {
        background-color: var(--primary-color);
      }

      .dark-mode .navbar {
          background-color: var(--dark-mode-primary-color);
      }

      .navbar-brand {
        color: var(--text-color);
      }

      .dark-mode .navbar-brand {
          color: var(--dark-mode-text-color);
      }


      .list-group-item {
        background-color: var(--bg-color);
        color: var(--text-color);
        border: 1px solid #eee; /* Light border */
      }

      .dark-mode .list-group-item {
        background-color: var(--dark-mode-bg-color);
        color: var(--dark-mode-text-color);
        border: 1px solid #555;
      }

      a {
        color: var(--secondary-color);
      }

      .dark-mode a {
        color: var(--dark-mode-secondary-color);
      }

      #background-animation {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none; /* Allow interaction with elements below */
        z-index: -1; /* Place behind content */
      }

      .circle {
        position: absolute;
        background-color: rgba(173, 216, 230, 0.3); /* Light blue with opacity */
        border-radius: 50%;
      }

       .dark-mode .circle {
            background-color: rgba(102, 178, 255, 0.3); /* Lighter blue with opacity */
        }


    </style>
</head>
<body>

    <!-- Animated Background -->
    <div id="background-animation"></div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">File Storage</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <button id="darkModeToggle" class="btn btn-outline-secondary">Dark Mode</button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <div class="container mt-5">
        <h1 class="mb-4">File Storage Application</h1>

        <div class="row">
            <div class="col-md-6">
                <h2>Upload File</h2>
                <form action="upload.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="file" class="form-label">Choose File:</label>
                        <input class="form-control" type="file" name="file" id="file" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </form>
            </div>

            <div class="col-md-6">
                <h2>Create Directory</h2>
                <form action="create_directory.php" method="POST">
                    <div class="mb-3">
                        <label for="directory" class="form-label">Directory Name:</label>
                        <input type="text" class="form-control" name="directory" id="directory" placeholder="Directory Name" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>

        <h2 class="mt-4">Uploaded Files</h2>
        <ul class="list-group">
            <?php if ($files): ?>
                <?php foreach ($files as $file): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <a href="<?= 'files/' . $file['name'] ?>" target="_blank"><?= htmlspecialchars($file['name']) ?></a>
                        <form action="delete.php" method="POST" style="display:inline;">
                            <input type="hidden" name="filename" value="<?= htmlspecialchars($file['name']) ?>">
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this file?');">Delete</button>
                        </form>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <li class="list-group-item">No files uploaded.</li>
            <?php endif; ?>
        </ul>
    </div>


    <!-- Bootstrap 5 JS Bundle (Popper included) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- GSAP for animation -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>

    <script>
        // Dark Mode Toggle
        const darkModeToggle = document.getElementById('darkModeToggle');
        const body = document.body;

        darkModeToggle.addEventListener('click', () => {
            body.classList.toggle('dark-mode');
            if (body.classList.contains('dark-mode')) {
                darkModeToggle.textContent = 'Light Mode';
            } else {
                darkModeToggle.textContent = 'Dark Mode';
            }
        });


        // GSAP Background Animation
        gsap.config({
            nullTargetWarn: false
        });

        const animationContainer = document.getElementById('background-animation');

        function createCircle() {
            const circle = document.createElement('div');
            circle.classList.add('circle');

            const size = gsap.utils.random(20, 100);
            circle.style.width = `${size}px`;
            circle.style.height = `${size}px`;

            const x = gsap.utils.random(0, window.innerWidth);
            const y = gsap.utils.random(0, window.innerHeight);

            circle.style.left = `${x}px`;
            circle.style.top = `${y}px`;

            animationContainer.appendChild(circle);

            gsap.to(circle, {
                duration: gsap.utils.random(2, 5),
                x: gsap.utils.random(0, window.innerWidth),
                y: gsap.utils.random(0, window.innerHeight),
                opacity: 0,
                scale: 0,
                rotation: 360,
                onComplete: () => {
                    circle.remove();
                },
                ease: "power1.inOut",
            });
        }


        setInterval(createCircle, 500); // Create a circle every 0.5 seconds.  Adjust for performance.


    </script>
</body>
</html>
