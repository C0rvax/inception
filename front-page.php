<!-- filepath: /home/c0rvax/Code/TC/inception/inception.php -->
<?php
$title = "Inception - Docker Infrastructure";
$headerTitle = "Inception";
$headerSubtitle = "A Docker-based infrastructure project from 42 School";
$contactEmail = "aduvilla@student.42.fr";
$year = date("Y");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $title ?></title>
  <style>
    /* ...existing styles from the HTML file... */
    body {
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      padding: 0;
      background: linear-gradient(to bottom, #1a73e8, #f8f9fa);
      color: #333;
      line-height: 1.6;
    }
    header {
      background: linear-gradient(to right, #1a73e8, #0077cc);
      color: white;
      padding: 2rem;
      text-align: center;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    header h1 {
      font-size: 2.5rem;
      margin: 0;
    }
    header p {
      font-size: 1.2rem;
      margin: 0.5rem 0 0;
    }
    main {
      max-width: 900px;
      margin: 2rem auto;
      padding: 2rem;
      background: white;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
      border-radius: 12px;
    }
    h1, h2 {
      color: #1a73e8;
    }
    h2 {
      margin-top: 2rem;
      border-bottom: 2px solid #1a73e8;
      padding-bottom: 0.5rem;
    }
    ul {
      list-style: none;
      padding: 0;
    }
    ul li {
      margin: 0.5rem 0;
      padding-left: 1.5rem;
      position: relative;
    }
    ul li::before {
      content: "✔";
      color: #1a73e8;
      position: absolute;
      left: 0;
      font-size: 1.2rem;
    }
    footer {
      text-align: center;
      padding: 1rem;
      color: #777;
      font-size: 0.9rem;
      background: #f1f1f1;
      margin-top: 2rem;
      border-top: 1px solid #ddd;
    }
    a {
      color: #0077cc;
      text-decoration: none;
      font-weight: bold;
    }
    a:hover {
      text-decoration: underline;
    }
    code {
      background: #f4f4f4;
      padding: 0.2rem 0.4rem;
      border-radius: 4px;
      font-family: "Courier New", Courier, monospace;
      color: #d63384;
    }
    .highlight {
      background: #e8f0fe;
      padding: 1rem;
      border-left: 4px solid #1a73e8;
      margin: 1rem 0;
      border-radius: 8px;
    }
  </style>
</head>
<body>

  <header>
    <h1><?= $headerTitle ?></h1>
    <p><?= $headerSubtitle ?></p>
  </header>

  <main>
    <section>
      <h2>📌 Project Overview</h2>
      <p>
        Inception is a system administration project focused on building a containerized infrastructure entirely with <strong>Docker</strong>. The challenge lies in creating the necessary Docker images from scratch, using Debian or Alpine as a base, and orchestrating them to work together seamlessly.
      </p>
    </section>

    <section>
      <h2>🔧 Core Services Deployed</h2>
      <p>The infrastructure consists of several interconnected services, each running in its own dedicated container:</p>
      <ul>
        <li><strong>NGINX:</strong> Acts as the reverse proxy and entry point, handling web traffic and providing SSL/TLS encryption (TLS v1.3 mandated).</li>
        <li><strong>WordPress:</strong> The content management system, running independently with PHP-FPM (without an internal web server).</li>
        <li><strong>MariaDB:</strong> The relational database server responsible for storing all WordPress data.</li>
        <li><strong>Redis (Bonus):</strong> An in-memory data structure store, used here as a caching layer to enhance WordPress performance.</li>
        <li><strong>FTP Server (Bonus):</strong> Provides File Transfer Protocol access to the WordPress volume for easy file management (using vsftpd).</li>
        <li><strong>Adminer (Bonus):</strong> A lightweight database management tool, providing a web interface for interacting with the MariaDB database.</li>
      </ul>
    </section>

    <section>
      <h2>📂 Architecture Overview</h2>
      <p>The architecture emphasizes isolation and modularity. Key features include:</p>
      <ul>
        <li><strong>Isolated Containers:</strong> Each service (NGINX, WordPress, MariaDB, etc.) runs within its own Docker container.</li>
        <li><strong>Custom Network:</strong> Containers communicate securely over a dedicated Docker bridge network.</li>
        <li><strong>Persistent Storage:</strong> Two Docker volumes are utilized to ensure data persistence:
        <ul>
          <li>One volume for the MariaDB database files.</li>
          <li>One volume for the WordPress website files (themes, plugins, uploads).</li>
        </ul>
        </li>
      </ul>
    </section>

    <section>
      <h2>🔒 Security & Best Practices</h2>
      <ul>
        <li>All services are accessed through <strong>NGINX</strong> on port 443 (HTTPS only)</li>
        <li>Only TLS v1.3 is supported</li>
        <li>No passwords in Dockerfiles</li>
        <li>Environment variables are managed through a <code>.env</code> file and secrets</li>
        <li>No use of <code>:latest</code> tags</li>
      </ul>
    </section>

    <section>
      <h2>📬 Contact</h2>
      <div class="highlight">
        <p>
          You can contact me at: <a href="mailto:<?= $contactEmail ?>"><?= $contactEmail ?></a>
        </p>
      </div>
    </section>
  </main>

  <footer>
    &copy; <?= $year ?> aduvilla - Inception @ 42 School
  </footer>

</body>
</html>
