<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Aqua Aid</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

  <section class="hero">
    <div class="bg bg1"></div>
    <div class="bg bg2"></div>
    <div class="overlay"></div>

    <header class="header">
  <a href="#" class="account-btn" onclick="openModal()">Account</a>
  <a href="login.php" class="learn-btn" onclick="">Admin Portal</a>
    </header>
<!-- Upper Section -->
    <div class="content">
      <div class="content-box">
        <h1>Aqua Aid</h1>
        <h2>"When the waters rise, hope flows"</h2>
        <div class="line"></div>
        <p>
          A platform for flood-affected individuals to register and request
          essential relief including food, water, medicine and shelter.
        </p>
        <br>
        <a href="#info" class="learn-btn">Learn More</a>
      </div>
    </div>

    <div class="hero-slant"></div>
  </section>

  <!-- Lowe Section -->
  <section id="info" class="info-section">
    <div class="info-container">
      <h3>Essential Relief Support</h3>
      <p>
        Our system helps flood-affected individuals share important
         information and request basic relief services in a simple way. 
      </p>

      <div class="cards">
        <div class="card">
          <h4>Food</h4>
          <p>Request emergency food supplies for individuals and families affected by flood conditions.</p>
        </div>

        <div class="card">
          <h4>Water</h4>
          <p>Submit requests for clean drinking water and other essential daily water needs.</p>
        </div>

        <div class="card">
          <h4>Medicine</h4>
          <p>Ask for medical supplies and urgent health-related support during emergency situations.</p>
        </div>

        <div class="card">
          <h4>Shelter</h4>
          <p>Request temporary shelter and safe accommodation for displaced individuals and families.</p>
        </div>
      </div>
    </div>
  </section>

  <footer class="footer">
    © 2026 Aqua Aid | Flood Relief Management System
  </footer>
<style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: Arial, Helvetica, sans-serif;
    }

    html {
      scroll-behavior: smooth;
    }

    body {
      background: #f5f7fb;
      color: #222;
      overflow-x: hidden;
    }

    /* Hero Section*/
    .hero {
      position: relative;
      width: 100%;
      min-height: 100vh;
      overflow: hidden;
    }

    .bg {
      position: absolute;
      inset: 0;
      background-size: cover;
      background-position: center;
      transition: opacity 1.5s ease-in-out;
      transform: scale(1.05);
    }

    .bg1 {
      opacity: 1;
      z-index: 1;
    }

    .bg2 {
      opacity: 0;
      z-index: 1;
    }

    .overlay {
      position: absolute;
      inset: 0;
      background: rgba(12, 22, 44, 0.55);
      z-index: 2;
    }

    .header{
  position:absolute;
  top:0;
  right:0;
  width:100%;
  padding:20px 40px;
  display:flex;
  justify-content:flex-end;
  z-index:10;
}

.account-btn,.learn-btn{
  text-decoration:none;
  color:white;
  border:2px solid white;
  padding:10px 20px;
  border-radius:6px;
  font-weight:500;
  transition:0.3s;
  margin-right:15px;
}

.account-btn:hover{
  background:white;
  color:#004e92;
}

.learn-btn:hover{
  background:white;
  color:#004e92;
}
    .content {
      position: relative;
      z-index: 3;
      min-height: 100vh;
      display: flex;
      align-items: center;
      padding: 120px 70px 160px;
    }

    .content-box {
      max-width: 760px;
      color: white;
    }

    .content-box h1 {
      font-size: 4.5rem;
      font-weight: 800;
      margin-bottom: 10px;
      letter-spacing: 1px;
    }

    .content-box h2 {
      font-size: 1.4rem;
      font-style: italic;
      font-weight: 400;
      color: rgba(255, 255, 255, 0.88);
      margin-bottom: 28px;
    }

    .line {
      width: 100%;
      max-width: 720px;
      height: 1px;
      background: rgba(255, 255, 255, 0.35);
      margin: 20px 0 28px;
    }

    .content-box p {
      font-size: 1.2rem;
      line-height: 1.9;
      color: rgba(255, 255, 255, 0.86);
      max-width: 900px;
    }

    .btn{
      font-size: 1.4rem;
      
    }
    .hero-slant {
      position: absolute;
      left: 0;
      bottom: -1px;
      width: 100%;
      height: 160px;
      background:linear-gradient(to right, #0a0b0b, #004e92);
      clip-path: polygon(0 78%, 100% 0, 100% 100%, 0 100%);
      z-index: 4;
    }

    /* Info Section */
    .info-section {
      position: relative;
      background: linear-gradient(to right, #0a0b0b, #004e92);
      color: white;
      padding: 90px 70px 100px;
    }

    .info-container {
      max-width: 1200px;
      margin: 0 auto;
    }

    .info-section h3 {
      font-size: 2.2rem;
      margin-bottom: 16px;
      font-weight: 700;
    }

    .info-section p {
      font-size: 1.08rem;
      line-height: 1.9;
      max-width: 800px;
      color: rgba(255,255,255,0.92);
      margin-bottom: 60px;
    }

    .cards {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 22px;
    }

    .card {
      background: rgba(255,255,255,0.12);
      border: 1px solid rgba(255,255,255,0.18);
      border-radius: 16px;
      padding: 28px 22px;
      backdrop-filter: blur(4px);
    }

    .card h4 {
      font-size: 1.4rem;
      margin-bottom: 10px;
      font-weight: 700;
      color: rgba(255,255,255,0.9);
      
    }

    .card p {
      font-size: 0.98rem;
      line-height: 1.7;
      margin: 0;
      color: rgba(255,255,255,0.9);
    }

    .footer {
      background: linear-gradient(to right, #0a0b0b, #004e92);;
      color: white;
      text-align: center;
      padding: 18px 20px;
      font-size: 0.95rem;
    }

    /*Media Responsive*/
    @media (max-width: 992px) {
      .content-box h1 {
        font-size: 3.4rem;
      }

      .cards {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    @media (max-width: 768px) {
      .header {
        padding: 20px 24px;
      }

      .logo {
        font-size: 1.15rem;
      }

      .btn {
        padding: 9px 16px;
        font-size: 0.95rem;
      }

      .content {
        padding: 110px 24px 140px;
      }

      .content-box h1 {
        font-size: 2.6rem;
      }

      .content-box h2 {
        font-size: 1.1rem;
      }

      .content-box p {
        font-size: 1rem;
        line-height: 1.8;
      }

      .hero-slant {
        height: 100px;
      }

      .info-section {
        padding: 70px 24px 80px;
      }

      .cards {
        grid-template-columns: 1fr;
      }
    }
.modal{
  display:none;
  position:fixed;
  inset:0;
  background:rgba(0,0,0,0.4);
  backdrop-filter:blur(8px);
  -webkit-backdrop-filter:blur(8px);
  justify-content:center;
  align-items:center;
  z-index:999;
}

.modal-box{
  position:relative;
  width:90%;
  max-width:700px;
  background:linear-gradient(to right, #000428, #004e92);;
  border-radius:12px;
  overflow:hidden;
}

.close-btn{
  position:absolute;
  top:10px;
  right:15px;
  font-size:28px;
  cursor:pointer;
  color:#333;
  z-index:5;
}

.iframe-box{
  height:70vh;
}

.iframe-box iframe{
  width:100%;
  height:100%;
  border:none;
}
  </style>
  <script>
    const images = [
      "images/bg1.jpg",
      "images/bg2.jpg",
      "images/bg3.jpg"
    ];

    const bg1 = document.querySelector(".bg1");
    const bg2 = document.querySelector(".bg2");

    let current = 0;
    let showingFirst = true;

    bg1.style.backgroundImage = `url('${images[0]}')`;

    setInterval(() => {
      current = (current + 1) % images.length;

      if (showingFirst) {
        bg2.style.backgroundImage = `url('${images[current]}')`;
        bg2.style.opacity = "1";
        bg1.style.opacity = "0";
      } else {
        bg1.style.backgroundImage = `url('${images[current]}')`;
        bg1.style.opacity = "1";
        bg2.style.opacity = "0";
      }

      showingFirst = !showingFirst;
    }, 4000);
  function openModal(){
  document.getElementById("authModal").style.display = "flex";
}

function closeModal(){
  document.getElementById("authModal").style.display = "none";
}


    
  </script>

 <div id="authModal" class="modal">
  <div class="modal-box iframe-box">
    <span class="close-btn" onclick="closeModal()">&times;</span>
    <iframe src="userlogin.php"></iframe>
  </div>
</div>
</body>
</html>