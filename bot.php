<?php
session_start();

include("php/config.php");
if (!isset($_SESSION['valid'])) {
    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tanya AI</title>
    <link rel="icon" href="image/icon64.png" type="image/png">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/marked@3.0.7/marked.min.js"></script>
    <style>
        #loading {
            margin-left: 25px;
            width: 30px;
            height: 30px;
            align-items: center;
        }
        #prompt-input {
            outline: none;
            background: transparent;
            border: none;
            padding: 10px;
            width: 100%;
            box-sizing: border-box;
        }

        #prompt-input:focus {
            outline: none;
        }

        #output {
            margin-left: 10px;
            margin-bottom: 13vh;
            font-size: 15px;
            line-height: 23px;
            overflow-y: auto;
        }

        #about-gemini {
            margin: 0 10px;
            margin-bottom: 20px;
        }

        .prompt-input .signin {
            gap: 20px;
        }

        p {
            font-size: 16px;
            margin: 15px 0;
        }

        p strong{
            font-weight: 600;
        }

        li strong{
            font-weight: 500;
        }

        .card-body {
            margin: 0 0 0;
        }

        .question-options {
            display: flex;
            gap: 10px;
            margin-bottom: 10px;
            flex-wrap: wrap;
            overflow: hidden;
            max-height: 0;
            transition: max-height 0.3s ease-out;
        }
        
        .question-options.show {
            max-height: 21vh;
        }

        .question-options .suggestion {
            background-color: #f8f8f8;
            border: 1px solid #ccc;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            white-space: nowrap;
        }

        .question-options .suggestion:hover {
            background-color: #e0e0e0;
        }

        #image-icon-label {
            cursor: pointer;
            display: flex;
            align-items: center;
            margin-right: 10px;
        }

        .icon-prompt {
            width: 26px;
            height: 22px;
        }
        
        .chat-container {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
        }

        .card {
            padding: 0 30vh 2vh;
        }
        
        .minimal-button {
            padding: 0 0 10px;
            background-color: transparent;
            border: none;
            cursor: pointer;
        }

        @media (max-width: 1600px) {
            .card {
                padding: 0 15vh 2vh;
            }
        }

        @media (max-width: 575px) {
            .icon-prompt {
                width: 32px;
            }
            .suggestion {
                font-size: 14px;
            }
            .card {
                padding: 0 0vh 0vh;
            }
        }

        @media (max-width: 360px) {
            .icon-prompt {
                width: 50px;
            }
        }
    </style>
</head>

<body class="body-fixed">
    <header class="site-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="header-logo">
                        <a href="menu.php">
                            <img src="image/logo_petanipintar.png" width="40" height="40" alt="Logo">
                        </a>
                    </div>
                </div>
                <div class="col-lg-10">
                    <div class="main-navigation">
                        <button class="menu-toggle"><span></span><span></span></button>
                        <nav class="header-menu">
                            <ul class="menu">
                                <li><a href="profile.php">Profil Akun</a></li>
                                <li><a href="notifikasi.php">Notifikasi</a></li>
                                <li><a href="#">Riwayat Panen</a></li>
                                <li><a href="riwayat-pembayaran.php">Riwayat Pembayaran</a></li>
                                <li><a href="bot.php">Gemini</a></li>
                                <li>
                                    <button onclick="window.location.href='menu.php'" class="signup">Kembali</button>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div id="viewport">
        <div id="js-scroll-content">
            <div class="repeat-img" style="background-image: url(image/pattern1_background.png);">
                <section class="main-banner">
                    <div class="sec-wp">
                        <div class="container">
                            <div class="sec-title text-center mb-4">
                                <!-- <p class="sec-sub-title mt-1 mb-0">PetaniPintar</p> -->
                                <!-- <h2 class="h3-title mb-0">Tanya ke</h2> -->
                                <h2 class="h2-title"><span>Gemini</span></h2>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 mb-5">
                                    <div id="about-gemini" class="mt-4">
                                        <p>Selamat datang di Gemini, asisten AI yang siap membantu Anda menjawab pertanyaan seputar pertanian dan budidaya tanaman.<br><br> 
                                            Gemini dikembangkan untuk memberikan informasi yang bermanfaat dan relevan bagi user PetaniPintar.
                                            Bertanyalah pada Gemini tentang pertanian, dan kami akan memberikan informasi yang Anda butuhkan!
                                        </p>
                                    </div>
                                    <div id="output">
                                        <div id="program-output"></div>
                                    </div>
                                    <div id="loading" style="display:none; margin-bottom: 13vh;">
                                        <img src="image/gif/loading.gif" alt="Loading..." />
                                    </div>
                                    <div class="chat-container">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex flex-column mb-2">
                                                <button id="toggle-suggestions" class="minimal-button">Tampilkan Rekomendasi</button>

                                                <div id="question-options" class="question-options">
                                                    <div class="suggestion">Apa saja cara budidaya tanaman padi?</div>
                                                    <div class="suggestion">Bagaimana cara merawat tanaman jagung?</div>
                                                    <div class="suggestion">Apa yang harus dilakukan saat hama menyerang?</div>
                                                    <div class="suggestion">Apa saja pupuk yang baik untuk sayuran?</div>
                                                    <div class="suggestion">Apakah ada program tanam di sekitar saya?</div>
                                                    <!-- Tambahkan lebih banyak pertanyaan jika diperlukan -->
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <input type="text" id="prompt-input" placeholder="Masukkan pertanyaan">
                                                <input type="file" id="image-input" accept="image/*" style="display:none;">
                                                <label for="image-input" class="add-alt" id="image-icon-label">
                                                    <img src="image/icon/upload.png" alt="Upload Image" class="icon-prompt">
                                                </label>
                                                <button id="generate-btn" class="add-alt">
                                                    Kirim
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    
    <script type="importmap">
        {
            "imports": {
                "@google/generative-ai": "https://esm.run/@google/generative-ai"
            }
        }
    </script>
    <script type="module">
        import { GoogleGenerativeAI } from "@google/generative-ai";

        let apiKey;

        async function fetchApiKey() {
            try {
                const response = await fetch('php/gemini-endpoint.php');
                const data = await response.json();
                if (data.apiKey) {
                    apiKey = data.apiKey;
                } else {
                    console.error('Failed to retrieve API key');
                }
            } catch (error) {
                console.error('Error fetching API key:', error);
            }
        }

        fetchApiKey();

        async function run(prompt) {
            if (!apiKey) {
                console.error('API key not loaded');
                return;
            }

            document.getElementById("loading").style.display = "block";
            try {
                const genAI = new GoogleGenerativeAI(apiKey);
                const generationConfig = {
                    maxOutputTokens: 40,
                    temperature: 0.4,
                    topP: 0.4,
                    topK: 16,
                };
                generationConfig.language = "id";

                const model = genAI.getGenerativeModel({ model: "gemini-1.5-flash" });

                const result = await model.generateContent(prompt, generationConfig);
                const response = await result.response;
                const text = await response.text();

                // Format the text
                const formattedText = marked(text);

                // Display the text on the web page
                const outputDiv = document.getElementById("output");
                const userText = `<hr><p><strong>Anda:</strong> ${prompt}</p>`;
                const botText = `<p><strong>Gemini:</strong> ${formattedText}</p>`;

                outputDiv.innerHTML += userText + botText;
                outputDiv.scrollTop = outputDiv.scrollHeight;
            } catch (error) {
                console.error("Error generating content:", error);
                document.getElementById("output").innerText =
                    "Error ketika memproses pertanyaan.";
            } finally {
                document.getElementById("loading").style.display = "none"; 
            }
        }
        function hideSuggestions() {
            const suggestions = document.getElementById("question-options");
            suggestions.classList.remove("show");
        }
        document.getElementById("generate-btn").addEventListener("click", () => {
            const prompt = document.getElementById("prompt-input").value;
            if (prompt.toLowerCase().includes("program tanam di sekitar saya")) {
                fetch('php/userdata.php')
                    .then(response   => response.text())
                    .then(data => {
                        // Tambahkan data dari userdata.php ke outputDiv
                        const outputDiv = document.getElementById("output");
                        outputDiv.innerHTML += data;
                        outputDiv.scrollTop = outputDiv.scrollHeight;
                        
                        const programElements = document.querySelectorAll('#program-output h3'); // Sesuaikan selector
                        programElements.forEach(element => {
                            const namaProgram = element.textContent.trim();
                            tanyakanProgram(namaProgram);
                        });
                        hideSuggestions();
                    })
                    .catch(error => console.error('Error:', error));
                } else {
                    // Logika untuk query ke Gemini AI
                    run(prompt);
                    hideSuggestions();
                }
            // async function tanyakanProgram(namaProgram) {
            //     const ask = `Deskripsi singkat budidaya ${namaProgram}.`;
            //     run(ask);
            // }
            document.getElementById("about-gemini").style.display = "none";
        });

        document.addEventListener('DOMContentLoaded', function () {
            const promptInput = document.getElementById('prompt-input');

            const suggestions = document.querySelectorAll('.suggestion');
            suggestions.forEach(suggestion => {
                suggestion.addEventListener('click', () => {
                    promptInput.value = suggestion.textContent;
                });
            });
        });

        document.getElementById("toggle-suggestions").addEventListener("click", function() {
            const suggestions = document.getElementById("question-options");
            suggestions.classList.toggle("show");
            const buttonText = suggestions.classList.contains("show") ? "Sembunyikan" : "Tampilkan Rekomendasi";
            this.textContent = buttonText;
        });


    </script>


    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/jquery.mixitup.min.js"></script>
    <script src="js/ScrollTrigger.min.js"></script>
    <script src="js/swiper-bundle.min.js"></script>
    <script src="js/gsap.min.js"></script>
    <script src="main.js"></script>
</body>

</html>