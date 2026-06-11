<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery</title>
    <link rel="stylesheet" href="style.css">
</head>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-8M1V485WJ2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-8M1V485WJ2');
</script>
<body>

    <!-- Overlay -->
    <div id="overlay" class="overlay" onclick="closeModal()"></div>

   <div class="gallery-container">
   <h1>Our Designs</h1>
    <!-- Gallery -->
    <div class="gallery">
        <?php
        $uploads_dir = "Logos";
        $files = array_diff(scandir($uploads_dir), array('.', '..'));
        $mediaFiles = [];

        foreach ($files as $file) {
            $filePath = "$uploads_dir/$file";
            $fileType = mime_content_type($filePath);

            if (strpos($fileType, 'image') !== false) {
                echo "<img src='$filePath' class='gallery-item' data-type='image' onclick='openModal(\"$filePath\", \"image\")'>";
                $mediaFiles[] = $filePath;
            } elseif (strpos($fileType, 'video') !== false) {
                echo "<video class='gallery-item' data-type='video' muted onclick='openModal(\"$filePath\", \"video\")'>
                        <source src='$filePath' type='$fileType'>
                      </video>";
                $mediaFiles[] = $filePath;
            }
        }
        ?>
    </div>
   </div>

    <!-- Modal -->
    <div id="modal" class="modal">
        <span class="close" onclick="closeModal()">&times;</span>
        <button class="prev" onclick="changeMedia(-1)">&#10094;</button>

        <img id="modal-img" class="modal-content">
        <video id="modal-video" class="modal-content" controls></video>

        <button class="next" onclick="changeMedia(1)">&#10095;</button>
    </div>

    <script>
        let mediaList = <?php echo json_encode($mediaFiles); ?>;
        let currentIndex = null;

        function openModal(src, type) {
            currentIndex = mediaList.indexOf(src);
            let modal = document.getElementById('modal');
            let overlay = document.getElementById('overlay');
            let modalImg = document.getElementById('modal-img');
            let modalVideo = document.getElementById('modal-video');

            overlay.classList.add('active');
            modal.style.display = 'block';

            if (type === "image") {
                modalImg.src = src;
                modalImg.style.display = "block";
                modalVideo.style.display = "none";
            } else {
                modalVideo.src = src;
                modalVideo.style.display = "block";
                modalImg.style.display = "none";
            }
        }

        function closeModal() {
            document.getElementById('overlay').classList.remove('active');
            document.getElementById('modal').style.display = 'none';
        }

        function changeMedia(direction) {
            if (currentIndex === null) return;
            
            currentIndex += direction;
            if (currentIndex < 0) currentIndex = mediaList.length - 1;
            if (currentIndex >= mediaList.length) currentIndex = 0;

            let newSrc = mediaList[currentIndex];
            let modalImg = document.getElementById('modal-img');
            let modalVideo = document.getElementById('modal-video');

            if (newSrc.endsWith('.mp4')) {
                modalVideo.src = newSrc;
                modalVideo.style.display = "block";
                modalImg.style.display = "none";
            } else {
                modalImg.src = newSrc;
                modalImg.style.display = "block";
                modalVideo.style.display = "none";
            }
        }
    </script>
</body>
</html>
<style>
    body {
    font-family: Arial, sans-serif;
    text-align: center;
    background:rgb(49, 46, 46);
}
.gallery-container h1{
    font-size: 50px;
    margin-top: 6%;
    color: #ff6738;
}
.gallery {
    display: flex;
    flex-wrap: wrap;
    width: 90%;
    justify-content: center;
    gap: 30px;
    padding: 20px;
    margin-bottom: 50px;
}
.gallery-item{
    width: calc(20.333% - 10px);
    height: calc(20.333% - 10px);
    background: #fff;
    padding: 2px;
    border-radius: 5px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
}

.gallery-item img, .gallery-item video {   
    width: 100%;
    height: auto;
    object-fit: cover;
    cursor: pointer;
    border-radius: 5px;
    transition: transform 0.3s;
}

.gallery img:hover, .gallery video:hover {
    transform: scale(1.1);
}

/* Overlay */
.overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7);
    z-index: 1000;
}

.overlay.active {
    display: block;
}
/* Modal */
.modal {
    display: none;
    position: fixed;
    top: 10%; /* Leaves space for header */
    left: 50%;
    transform: translate(-50%, 0);
    width: 99%;
    height: 100%; /* Leaves space for footer */
    background: rgba(0, 0, 0, 0.9);
    padding: 15px;
    border-radius: 10px;
    text-align: center;
    z-index: 1001;
}

/* Modal Content (Images & Videos) */
.modal-content {
    max-width: 90%;
    max-height: 80%; /* Ensures it doesn't stretch too much */
    margin: auto;
    display: block;
    object-fit: contain; /* Ensures proper scaling */
    border-radius: 5px;
}

/* Video-specific styling */
.modal video {
    max-width: 90%;
    max-height: 60vh;
    object-fit: contain; /* Keeps original aspect ratio */
}

/* Overlay */
.overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7);
    z-index: 1000;
}

.overlay.active {
    display: block;
}

/* Close Button */
.close {
    position: absolute;
    top: 10px;
    right: 20px;
    font-size: 30px;
    color: white;
    cursor: pointer;
}

/* Navigation Buttons */
.modal .prev, .modal .next {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(255, 255, 255, 0.2);
    color: white;
    border: none;
    cursor: pointer;
    padding: 10px;
    font-size: 25px;
}

.prev {
    left: 10px;
}

.next {
    right: 10px;
}
@media (max-width: 992px) {
    .gallery-container{
        margin-top:6vh;
         margin-bottom:3vh
    }
}
@media (max-width: 768px) {
    /* General Container */
    .gallery-container {
        padding: 10px;
        
    }
    /* Gallery */
    .gallery {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
        gap: 8px;
    }

    .gallery img, .gallery video {
        width: 100%;
        height: auto;
        border-radius: 5px;
    }

    /* Modal */
    .modal {
        width: 95%;
        top: 10%; /* Leaves space for header */
        max-height: 75vh;
    }

    .modal-content {
        max-width: 100%;
        max-height: 50vh;
    }

    .modal video {
        max-width: 100%;
        max-height: 50vh;
    }

    /* Navigation Buttons */
    .modal .prev, .modal .next {
        font-size: 16px;
        padding: 8px;
    }

   
}

</style>