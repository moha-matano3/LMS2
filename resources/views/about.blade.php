<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Hekima Library</title>
    
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }
        body {
            
            background-color: #343a40;
            color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #6c757d;
            padding: 20px;
            text-align: center;
            color: white;
        }
        h1 {
            color: black;
        }
        h2 {
            color: #f8f9fa;
            text-align: center; /* Center align h2 text */
            text-decoration: underline; /* Underline h2 text */
        }
        .content {
            padding: 20px;
            display: flex;
            gap: 20px;
            justify-content: center; /* Center the sections horizontally */
            flex-wrap: wrap; /* Allow the sections to wrap to the next line on smaller screens */
        }
        .section {
            flex: 1;
            min-width: 250px; /* Ensure sections don't get too small */
            max-width: 300px; /* Control the maximum width of sections */
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #6c757d;
        }
        .section h2 {
            margin-bottom: 10px;
        }
        .section p, .section ul {
            font-size: 1.1em;
            line-height: 1.6; /* Increase line spacing */
            margin-bottom: 10px;
        }
        .section ul {
            list-style-type: square;
            padding-left: 20px;
        }
        footer {
            background-color: #3b3b3f;
            color: white;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        .navbar {
            background: #3b3b3f;
            text-align: center;
        }
        .navbar ul {
            display: inline-flex;
            list-style: none;
            padding: 0;
        }
        .navbar ul li {
            margin: 15px;
            padding: 15px;
        }
        .navbar ul li a {
            text-decoration: none;
            color: #faf9f6;
        }
        .navbar ul li:hover {
            background: #000;
            border-radius: 5px;
        }
        .subMenu {
            display: none;
        }
        .navbar ul li:hover .subMenu {
            display: block;
            position: absolute;
            background: #3b3b3f;
            margin-top: 15px;
            margin-left: -15px;
        }
        .navbar ul li:hover .subMenu ul {
            display: block;
            margin: 10px;
        }
        .navbar ul li:hover .subMenu ul li {
            width: 150px;
            padding: 15px;
            border-radius: 5px;
            text-align: left;
        }

        /* Media Queries for responsiveness */
        @media (max-width: 768px) {
            .navbar ul {
                display: block;
                text-align: left;
                padding-left: 0;
            }
            .navbar ul li {
                display: block;
                width: 100%;
                margin: 0;
                padding: 10px 20px;
            }
            .navbar ul li a {
                display: block;
                padding: 10px;
            }
            .navbar ul li:hover .subMenu {
                position: static;
                margin-top: 0;
                margin-left: 0;
            }
            .navbar ul li:hover .subMenu ul li {
                padding: 10px;
                width: 100%;
            }
        }

        @media (max-width: 480px) {
            header {
                padding: 10px;
            }
            h1 {
                font-size: 1.5em;
            }
            .content {
                padding: 10px;
                color: white;
            }
            .section p, .section ul {
                font-size: 1em;
            }
            .section ul {
                padding-left: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="navbar">
        <ul>
            <li><a href="/">Home</a></li>
            <li><a href="{{ route('about') }}">About</a></li>
            <li><a href="#">Profile</a>
                <div class="subMenu">
                    <ul>
                        @if(Route::has('register'))
                            @auth
                            <li><a href="/home">Dashboard</a></li>
                            @else
                                <li><a href="{{ route('register') }}">Register</a></li>
                                @if(Route::has('login'))
                                    <li><a href="{{ route('login') }}">Login</a></li>
                                @endif
                            @endauth
                        @endif
                    </ul>
                </div>
            </li>
        </ul>
    </div><br>
    
    <header>
        <h1>About Hekima Library</h1>
    </header>
    
    <div class="content">
        <section class="section">
            <h2>Welcome to Hekima Library</h2>
            <p>Hekima Library is a sanctuary for book lovers and knowledge seekers. Our extensive collection of books spans various genres, ensuring that every reader finds something to their taste. Whether you're a student, a researcher, or just someone who loves to read, Hekima Library is your go-to destination.</p>
        </section>

        <section class="section">
            <h2>Availability of Books</h2>
            <p>At Hekima Library, we pride ourselves on our wide range of books. Our collection includes fiction, non-fiction, academic textbooks, journals, and much more. Our catalogue is constantly updated to include the latest releases and timeless classics.</p>
            <p>Members can easily check the availability of books through our online catalog or by visiting the library. We also offer a reservation service, so you can reserve a book if it's currently on loan.</p>
        </section>

        <section class="section">
            <h2>Library Rules and Penalties</h2>
            <p>To ensure a pleasant experience for all our patrons, we have a set of rules that must be followed:</p>
            <ul>
                <li>Handle books and other materials with care.</li>
                <li>Return books on or before the due date.</li>
            </ul>
            <p>Failure to adhere to these rules may result in penalties, including:</p>
            <ul>
                <li>Replacement costs for lost or damaged books.</li>
                <li>Temporary suspension of library privileges for repeated offenses.</li>
            </ul>
        </section>

        <section class="section">
            <h2>Contact Us</h2>
            <p>For any inquiries or assistance, feel free to contact us:</p>
            <p><strong>Address:</strong> Ruiru</p>
            <p><strong>Phone:</strong> 0707381528</p>
        </section>
    </div>

    <footer>
        &copy; Hekima Library©, Elimu ni ufunguo wa maisha.
    </footer>
</body>
</html>
