<style>
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }

      body {
        height: 100vh;
        display: flex;
        flex-direction: column;
      }

      .page-content {
        flex: 1;
        display: flex;
        flex-direction: column;
      }

      main {
        position: relative;
        width: 100%;
        flex: 1;
        display: flex;
        justify-content: center;
        align-items: center;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.3);
        overflow: hidden;
      }

      .slider {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
      }

      .item {
        width: 200px;
        height: 300px;
        list-style-type: none;
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        z-index: 1;
        background-position: center;
        background-size: cover;
        border-radius: 20px;
        box-shadow: 0 20px 30px rgba(255, 255, 255, 0.3) inset;
        transition: transform 0.1s, left 0.75s, top 0.75s, width 0.75s, height 0.75s;
      }

      .item:nth-child(1),
      .item:nth-child(2) {
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        transform: none;
        border-radius: 0;
        box-shadow: none;
        opacity: 1;
      }

      .item:nth-child(3) {
        left: 50%;
      }

      .item:nth-child(4) {
        left: calc(50% + 220px);
      }

      .item:nth-child(5) {
        left: calc(50% + 440px);
      }

      .item:nth-child(6) {
        left: calc(50% + 660px);
        opacity: 0;
      }

      .content {
        width: min(30vw, 400px);
        position: absolute;
        top: 50%;
        left: 3rem;
        transform: translateY(-50%);
        font: 400 0.85rem helvetica, sans-serif;
        color: white;
        text-shadow: 0 3px 8px rgba(0, 0, 0, 0.5);
        opacity: 0;
        display: none;
      }

      .content .title {
        font-family: 'arial-black';
        text-transform: uppercase;
      }

      .content .description {
        line-height: 1.7;
        margin: 1rem 0 1.5rem;
        font-size: 0.8rem;
      }

      .content button {
        width: fit-content;
        background-color: rgba(0, 0, 0, 0.1);
        color: white;
        border: 2px solid white;
        border-radius: 0.25rem;
        padding: 0.75rem;
        cursor: pointer;
      }

      .item:nth-of-type(2) .content {
        display: block;
        animation: show 0.75s ease-in-out 0.3s forwards;
      }

      @keyframes show {
        0% {
          filter: blur(5px);
          transform: translateY(calc(-50% + 75px));
        }
        100% {
          opacity: 1;
          filter: blur(0);
        }
      }

      .nav {
        position: absolute;
        bottom: 2rem;
        left: 50%;
        transform: translateX(-50%);
        z-index: 5;
        user-select: none;
      }

      .nav .btn {
        background-color: rgba(255, 255, 255, 0.5);
        color: rgba(0, 0, 0, 0.7);
        border: 2px solid rgba(0, 0, 0, 0.6);
        margin: 0 0.25rem;
        padding: 0.75rem;
        border-radius: 50%;
        cursor: pointer;
      }

      .nav .btn:hover {
        background-color: rgba(255, 255, 255, 0.3);
      }

      @media (width > 650px) and (width < 900px) {
        .content .title {
          font-size: 1rem;
        }
        .content .description {
          font-size: 0.7rem;
        }
        .content button {
          font-size: 0.7rem;
        }
        .item {
          width: 160px;
          height: 270px;
        }

        .item:nth-child(3) {
          left: 50%;
        }
        .item:nth-child(4) {
          left: calc(50% + 170px);
        }
        .item:nth-child(5) {
          left: calc(50% + 340px);
        }
        .item:nth-child(6) {
          left: calc(50% + 510px);
          opacity: 0;
        }
      }

      @media (width < 650px) {
        .content .title {
          font-size: 0.9rem;
        }
        .content .description {
          font-size: 0.65rem;
        }
        .content button {
          font-size: 0.7rem;
        }
        .item {
          width: 130px;
          height: 220px;
        }

        .item:nth-child(3) {
          left: 50%;
        }
        .item:nth-child(4) {
          left: calc(50% + 140px);
        }
        .item:nth-child(5) {
          left: calc(50% + 280px);
        }
        .item:nth-child(6) {
          left: calc(50% + 420px);
          opacity: 0;
        }
      }
      .new{
        margin: 10px;
      }
</style>

<h2 class="new"> What's New </h2>
<main>
    <ul class="slider">
        @foreach($latestBooks as $book)
            <li class="item" style="background-image: url('{{ asset('book/' . $book->book_img) }}')">
                <div class="content">
                    <h2 class="title">{{ $book->book_title }}</h2>
                    <p class="description">{{$book->desc}}</p>
                </div>
            </li>
        @endforeach
    </ul>
    <nav class="nav">
        <ion-icon class="btn prev" name="arrow-back-outline"></ion-icon>
        <ion-icon class="btn next" name="arrow-forward-outline"></ion-icon>
    </nav>
</main>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script>
      const slider = document.querySelector('.slider');

      function activate(e) {
        const items = document.querySelectorAll('.item');
        if (e.target.matches('.next')) {
          slider.append(items[0]);
        }
        if (e.target.matches('.prev')) {
          slider.prepend(items[items.length - 1]);
        }
      }

      document.addEventListener('click', activate, false);
    </script>