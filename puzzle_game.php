<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Stress Relief Puzzle Game</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        #puzzle-container {
            width: 300px;
            height: 300px;
            margin: 20px auto;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-gap: 5px;
        }
        .puzzle-piece {
            width: 100px;
            height: 100px;
            background-size: 300px 300px; /* Full size of the image spread over the pieces */
            cursor: pointer;
            border: 1px solid #ddd;
            user-select: none; /* Prevents selection to improve drag experience */
        }
    </style>
</head>
<body>
    <?php include('nav.php'); ?>
    <div class="container mt-5">
        <h2>Stress Relief Puzzle Game</h2>
        <div id="puzzle-container"></div>
        <button class="btn btn-success mt-3" onclick="shufflePieces()">Shuffle Pieces</button>
    </div>

    <script>
        const puzzleContainer = document.getElementById('puzzle-container');
        const puzzleImage = 'img/puzzle-image.jpg'; // Path to the puzzle image
        const pieces = [];

        function initializePuzzle() {
            for (let i = 0; i < 9; i++) {
                const piece = document.createElement('div');
                piece.className = 'puzzle-piece';
                piece.draggable = true; // Make the piece draggable
                piece.style.backgroundImage = `url('${puzzleImage}')`;
                const x = (i % 3) * 100; // x position of the piece slice
                const y = Math.floor(i / 3) * 100; // y position of the piece slice
                piece.style.backgroundPosition = `-${x}px -${y}px`;
                puzzleContainer.appendChild(piece);
                pieces.push(piece);

                piece.addEventListener('dragstart', (e) => {
                    e.dataTransfer.setData('text/plain', i.toString());
                });
            }

            puzzleContainer.addEventListener('dragover', (e) => {
                e.preventDefault();
            });

            puzzleContainer.addEventListener('drop', (e) => {
                e.preventDefault();
                const fromIndex = parseInt(e.dataTransfer.getData('text/plain'));
                const toPiece = e.target;
                const toIndex = pieces.indexOf(toPiece);
                if (fromIndex !== toIndex && toPiece.classList.contains('puzzle-piece')) {
                    swapPieces(fromIndex, toIndex);
                }
            });
        }

        function swapPieces(fromIndex, toIndex) {
            const fromPiece = pieces[fromIndex];
            const toPiece = pieces[toIndex];
            const fromBackground = fromPiece.style.backgroundPosition;
            const toBackground = toPiece.style.backgroundPosition;

            // Swap positions
            fromPiece.style.backgroundPosition = toBackground;
            toPiece.style.backgroundPosition = fromBackground;

            // Swap in the array
            pieces[fromIndex] = toPiece;
            pieces[toIndex] = fromPiece;
        }

        function shufflePieces() {
            for (let i = pieces.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                swapPieces(i, j);
            }
        }

        window.onload = initializePuzzle;
    </script>
</body>
</html>
