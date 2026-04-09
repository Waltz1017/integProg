<?php ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Naruto</title>
  <style>
    html, body {
        font-family: "Poppins", sans-serif;
        background-color: #111;
        color: #f5f5f5;
        margin: 0;
        padding: 0;
    }
    .nav {
        position: sticky;
        top: 0;
        z-index: 1000;
        background: #222;
        padding: 10px 0;
        border-bottom: 2px solid #f9d71c;
    }
    .nav ul {
        display: flex;
        justify-content: center;
        gap: 40px;
        list-style: none;
        margin: 0;
        padding: 0;
    }
    .nav ul li a {
        text-decoration: none;
        color: #f9d71c;
        font-size: 24px;
        padding: 8px 16px;
        border-radius: 8px;
        transition: all 0.3s ease;
    }
        .nav ul li a:hover {
        background: #f9d71c;
        color: #111;
        box-shadow: 0 0 10px #f9d71c;
    }
    .home {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 40vh;
    }
    .form {
        background: #222;
        padding: 20px;
        border-radius: 12px;
        border: 2px solid #f9d71c;
        display: flex;
        flex-direction: column;
        gap: 15px;
    }
    .search {
        width: 90%;
        padding: 12px;
        font-size: 18px;
        border-radius: 8px;
        border: 2px solid #f9d71c;
        background: #111;
        color: #f5f5f5;
    }
    .searchbtn {
        padding: 10px;
        font-size: 18px;
        border-radius: 8px;
        border: none;
        background: #f9d71c;
        color: #111;
        cursor: pointer;
        transition: 0.3s;
    }
    .searchbtn:hover {
        background: #ff9800;
        box-shadow: 0 0 10px #ff9800;
    }
    .about-section {
        display: flex;
        align-items:center;
        justify-content: center;
    }
    .data-section {
        display: flex;
        align-items:center;
        justify-content: center;
    }
    .contact-section {
        display: flex;
        align-items:center;
        justify-content: center;
    }
    .data {
        margin-top: 40px;
        width: 80%;
        background: #222;
        border-radius: 12px;
        border: 2px solid #f9d71c;
        padding: 20px;
        text-align: center;
    }
    .data h2 {
        color: #f9d71c;
    }
    .data img {
        border-radius: 8px;
        border: 2px solid #f9d71c;
        margin: 10px 0;
    }
    .about, .contact {
        margin-top: 40px;
        width: 80%;
        background: #222;
        border-radius: 12px;
        border: 2px solid #f9d71c;
        padding: 20px;
    }
    .about h1, .contact h1 {
        color: #f9d71c;
    }
    .comment {
        width: 99%;
        min-height: 120px;
        padding: 10px;
        border-radius: 8px;
        border: 2px solid #f9d71c;
        background: #111;
        color: #f5f5f5;
    }
    .submit {
        margin-top: 10px;
        padding: 10px 20px;
        font-size: 18px;
        border-radius: 8px;
        border: none;
        background: #f9d71c;
        color: #111;
        cursor: pointer;
        transition: 0.3s;
    }
    .submit:hover {
        background: #ff9800;
        box-shadow: 0 0 10px #ff9800;
    }
  </style>
</head>
<body>
  <nav class="nav">
    <ul>
      <li><a href="#home">Home</a></li>
    </ul>
  </nav>

  <section class="home-section">
    <div class="home" id="home">
    <form method="GET" action="" class="form">
      <input type="text" class="search" name="search" placeholder="search characters..."><br>
      <button type="searchbtn" class="searchbtn">Search</button>
    </form>
  </div>
  </section>

  <section class="data-section">
    <div class="data" id="data">
    <?php
      $url = "https://dattebayo-api.onrender.com/characters";
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($ch);
      if ($response === false) { echo "API error"; exit; }
      $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
      curl_close($ch);
      if ($httpCode != 200) { echo "API returned $httpCode"; exit; }
      $data = json_decode($response, true);

      function displaySection($title, $data) {
        if (!empty($data) && is_array($data)) {
          echo "<p><strong>$title:</strong><br>";
          foreach ($data as $type => $value) {
            if (!empty($value)) {
              if (is_array($value)) $value = implode(", ", $value);
              echo ucfirst($type) . ": " . htmlspecialchars($value) . "<br><br>";
            }
          }
          echo "</p>";
        }
      }

      $search = !empty($_GET['search']) ? strtolower($_GET['search']) : '';
      if (!empty($data['characters']) && is_array($data['characters'])) {
        $found = false;
        foreach ($data['characters'] as $character) {
          if (isset($character['name'])) {
            if ($search !== '' && strpos(strtolower($character['name']), $search) !== false) {
              $found = true;
              echo "<h2>" . htmlspecialchars($character['name']) . "</h2>";
              if (!empty($character['images'][0])) {
                echo "<img src='" . htmlspecialchars($character['images'][0]) . "' width='200'><br>";
              }
              displaySection("Debut", $character['debut']);
              displaySection("Personal", $character['personal']);
              echo "<hr>";
            }
          }
        }
        if (!$found && $search !== '') {
          echo "<p>No character found.</p>";
        }
      }
    ?>
  </div>
  </section>

  <section class="about-section">
        <div class="about" id="about">
            <h1>About Website</h1>
            <p>
            <p>
            This site is a fan‑made project dedicated to exploring the world of <strong>Naruto</strong>. 
            Using the Dattebayo API, it allows you to search for characters and instantly view details 
            about their debut, personal background, and more.
            </p>
            <p>
            The goal is to provide an easy way for fans to discover and learn about their favorite shinobi, 
            from iconic characters like Naruto Uzumaki to legendary figures across the series. 
            Whether you’re revisiting old favorites or discovering new characters, this project brings 
            the Naruto universe closer to you.
            </p>
            <p>
            Built with PHP and styled with HTML/CSS, this project is also a learning exercise in 
            web development, API integration, and user‑friendly design.
            </p>
            </p>
        </div>
    </section>

    <section class="contact-section">
        <div class="contact" id="contact">
            <h1>Comment Here...</h1>
            <textarea name="comment" class="comment" id="comment" placeholder="Your comment here..."></textarea>
            <button type="submit" class="submit">Submit</button>
        </div>
    </section>

  <script>
    window.addEventListener("load", function() {
      const params = new URLSearchParams(window.location.search);
      if (params.has("search") && params.get("search").trim() !== "") {
        const dataSection = document.getElementById("data");
        if (dataSection) {
          dataSection.scrollIntoView({ behavior: "smooth" });
        }
      }
    });
  </script>
</body>
</html>
