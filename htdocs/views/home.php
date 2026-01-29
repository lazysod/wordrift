<?php 
$title = 'New Framework';
$pageJs = 'home';
require __DIR__ . '/partials/header.php';

?>
<!-- Hardcode the data-url to the current folder path for robust JS pathing -->
<?php $basePath = dirname($_SERVER['SCRIPT_NAME']); ?>

<div class="container py-5">
    <?php if (!isset($_SESSION[PREFIX . 'user_id'])): ?>
    <h1 id="logo" class="text-center mb-4" data-url="<?php echo $basePath === '/' ? '' : $basePath; ?>">Wordrift Clone</h1>
    <?php else: ?>
        <h1 id="logo" class="text-center mb-4" data-url="<?php echo $basePath === '/' ? '' : $basePath; ?>">Welcome to Wordrift <?php echo htmlspecialchars($_SESSION[PREFIX . 'display_name']); ?>!</h1>
    <?php endif; ?>
    <div class="text-center mb-3">
        <button id="daily-btn" class="btn btn-success me-2" disabled>Daily Game</button>
        <button id="random-btn" class="btn btn-secondary">Play Random Game</button>
    </div>


    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow border-0 mb-4">
                <div class="card-body">
                    <div id="wordle-grid" class="mb-4">
                        <div class="d-flex flex-column gap-2">
                            <?php for ($i = 0; $i < 6; $i++): ?>
                                <div class="d-flex justify-content-center gap-2">
                                    <?php for ($j = 0; $j < 5; $j++): ?>
                                        <div class="wordle-cell border border-secondary rounded text-center fw-bold">&nbsp;</div>
                                    <?php endfor; ?>
                                </div>
                            <?php endfor; ?>
                        </div>
                    </div>
                    <!-- Wordle-style on-screen keyboard -->
                    <div id="wordle-keyboard">
                        <div class="wordle-key-row">
                            <button type="button" class="wordle-key" data-key="Q">Q</button>
                            <button type="button" class="wordle-key" data-key="W">W</button>
                            <button type="button" class="wordle-key" data-key="E">E</button>
                            <button type="button" class="wordle-key" data-key="R">R</button>
                            <button type="button" class="wordle-key" data-key="T">T</button>
                            <button type="button" class="wordle-key" data-key="Y">Y</button>
                            <button type="button" class="wordle-key" data-key="U">U</button>
                            <button type="button" class="wordle-key" data-key="I">I</button>
                            <button type="button" class="wordle-key" data-key="O">O</button>
                            <button type="button" class="wordle-key" data-key="P">P</button>
                        </div>
                        <div class="wordle-key-row">
                            <button type="button" class="wordle-key" data-key="A">A</button>
                            <button type="button" class="wordle-key" data-key="S">S</button>
                            <button type="button" class="wordle-key" data-key="D">D</button>
                            <button type="button" class="wordle-key" data-key="F">F</button>
                            <button type="button" class="wordle-key" data-key="G">G</button>
                            <button type="button" class="wordle-key" data-key="H">H</button>
                            <button type="button" class="wordle-key" data-key="J">J</button>
                            <button type="button" class="wordle-key" data-key="K">K</button>
                            <button type="button" class="wordle-key" data-key="L">L</button>
                        </div>
                        <div class="wordle-key-row">
                            <button type="button" class="wordle-key" data-key="Z">Z</button>
                            <button type="button" class="wordle-key" data-key="X">X</button>
                            <button type="button" class="wordle-key" data-key="C">C</button>
                            <button type="button" class="wordle-key" data-key="V">V</button>
                            <button type="button" class="wordle-key" data-key="B">B</button>
                            <button type="button" class="wordle-key" data-key="N">N</button>
                            <button type="button" class="wordle-key" data-key="M">M</button>
                            <button type="button" class="wordle-key" data-key="BACK" style="width:56px;">⌫</button>
                        </div>
                        <div class="wordle-key-row text-center mt-2">
                            <button type="button" id="wordle-submit-btn" class="btn btn-primary" style="width:120px;">Submit</button>
                        </div>
                    </div>
                    <?php if (isset($_SESSION[PREFIX . 'user_id'])): ?>
                        <div id="wordle-feedback" class="mt-3 text-center"></div>
                        <div id="wordle-definition" class="mt-3 text-center small"></div>
                    <?php else: ?>
                        <div class="alert alert-info text-center">Please <a href="<?php echo $config['modules']['user']['login_path'] ?? '/user/login'; ?>">log in</a> to play the game.</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm mb-3">
                <div class="card-body">
                    <div class="text-center mb-3">
                        <small class="text-muted">Random Game stats are now <b>separate</b> from daily stats</small>
                    </div>
                    <div id="wordle-stats" class="mb-2"></div>
                    <div class="mb-2">

                    </div>
                </div>
            </div>
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">Leaderboard</h5>
                    <div id="wordle-leaderboard"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Stats and Leaderboard -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var PATH = '';
            const keyboard = document.getElementById('wordle-keyboard');
            const feedback = document.getElementById('wordle-feedback');
            const grid = document.getElementById('wordle-grid').querySelectorAll('.d-flex.justify-content-center');
            const definitionDiv = document.getElementById('wordle-definition');
            let currentRow = 0;
            let gameOver = false;
            let answer = null;
            let mode = 'daily'; // 'daily' or 'random'
            let guessHistory = [];
            let currentGuess = [];

            // --- On-screen keyboard logic ---
            if (keyboard) {
                keyboard.addEventListener('click', function(e) {
                    const keyBtn = e.target.closest('.wordle-key');
                    if (!keyBtn || keyBtn.disabled) return;
                    const key = keyBtn.getAttribute('data-key');
                    if (gameOver) return;
                    if (key === 'BACK') {
                        currentGuess.pop();
                    } else if (/^[A-Z]$/.test(key) && currentGuess.length < 5) {
                        currentGuess.push(key);
                    }
                    updateGridDisplay();
                });
            }

            // --- Submit button logic ---
            const submitBtn = document.getElementById('wordle-submit-btn');
            if (submitBtn) {
                submitBtn.addEventListener('click', function() {
                    if (gameOver) return;
                    if (currentGuess.length === 5) {
                        handleGuess(currentGuess.join(''));
                    } else {
                        feedback.textContent = 'Enter 5 letters to submit.';
                    }
                });
            }

            // --- Update grid display for current guess ---
            function updateGridDisplay() {
                if (currentRow >= grid.length) return;
                const rowCells = grid[currentRow].querySelectorAll('.wordle-cell');
                for (let i = 0; i < 5; i++) {
                    rowCells[i].textContent = currentGuess[i] || '';
                }
            }

            // --- Update keyboard key colors based on feedback ---
            function updateKeyboardColors() {
                // Track best status for each letter
                const keyStatus = {};
                for (let row = 0; row < currentRow + (gameOver ? 1 : 0); row++) {
                    const rowCells = grid[row].querySelectorAll('.wordle-cell');
                    for (let i = 0; i < 5; i++) {
                        const letter = rowCells[i].textContent;
                        const bg = rowCells[i].style.background;
                        if (!letter) continue;
                        if (bg === 'rgb(106, 170, 100)' || bg === '#6aaa64') {
                            keyStatus[letter] = 'green';
                        } else if ((bg === 'rgb(201, 180, 88)' || bg === '#c9b458') && keyStatus[letter] !== 'green') {
                            keyStatus[letter] = 'yellow';
                        } else if ((bg === 'rgb(120, 124, 126)' || bg === '#787c7e') && !keyStatus[letter]) {
                            keyStatus[letter] = 'gray';
                        }
                    }
                }
                // Update keyboard buttons
                document.querySelectorAll('.wordle-key').forEach(btn => {
                    const key = btn.getAttribute('data-key');
                    if (key.length !== 1) return; // Only letter keys
                    btn.textContent = key; // Always show the letter
                    if (keyStatus[key]) {
                        if (keyStatus[key] === 'green') {
                            btn.style.background = '#6aaa64';
                            btn.style.color = '#fff';
                        } else if (keyStatus[key] === 'yellow') {
                            btn.style.background = '#c9b458';
                            btn.style.color = '#fff';
                        } else if (keyStatus[key] === 'gray') {
                            btn.style.background = '#787c7e';
                            btn.style.color = '#fff';
                        }
                    } else {
                        btn.style.background = '';
                        btn.style.color = '';
                    }
                });
            }

            // --- Handle guess submission ---
            async function handleGuess(guess) {
                if (gameOver) return;
                if (!answer) {
                    feedback.textContent = 'Game not ready. Please wait...';
                    return;
                }
                if (mode === 'daily') {
                    const blocked = await blockIfPlayedToday();
                    if (blocked) return;
                }
                if (guess.length !== 5) {
                    feedback.textContent = 'Please enter a 5-letter word.';
                    return;
                }
                // Validate guess with backend using jQuery AJAX
                feedback.textContent = 'Checking word...';
                let validWord = false;
                let ajaxError = false;
                await new Promise((resolve) => {
                    $.ajax({
                        url: `${PATH}/app/wordle.php?action=validate&guess=${guess}`,
                        method: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            if (typeof data.valid !== 'undefined') {
                                if (data.valid) {
                                    validWord = true;
                                } else {
                                    feedback.innerHTML = '<span class="text-danger">Not a valid word!</span>';
                                }
                            } else {
                                feedback.innerHTML = `<span class="text-danger">Error validating word: <b>${guess}</b></span>`;
                                // Do not block further play for unexpected backend response
                            }
                            resolve();
                        },
                        error: function(xhr, status, error) {
                            feedback.innerHTML = `<span class="text-danger">Error validating word: <b>${guess}</b></span>`;
                            ajaxError = true;
                            resolve();
                        }
                    });
                });
                if (!validWord && ajaxError) {
                    // Only block further play if it was a true AJAX/network error
                    return;
                }
                const rowCells = grid[currentRow].querySelectorAll('.wordle-cell');
                let answerArr = answer.split('');
                let guessArr = guess.split('');
                let emojiRow = '';
                // First pass: correct place (green)
                for (let i = 0; i < 5; i++) {
                    if (guessArr[i] === answerArr[i]) {
                        rowCells[i].textContent = guess[i];
                        rowCells[i].style.background = '#6aaa64'; // green
                        rowCells[i].style.color = '#fff';
                        answerArr[i] = null;
                        guessArr[i] = null;
                    } else {
                        rowCells[i].textContent = guess[i];
                        rowCells[i].style.background = '#fff';
                        rowCells[i].style.color = '#222';
                    }
                }
                // Second pass: correct letter, wrong place (yellow)
                for (let i = 0; i < 5; i++) {
                    if (guessArr[i] && answerArr.includes(guessArr[i])) {
                        rowCells[i].style.background = '#c9b458'; // yellow
                        rowCells[i].style.color = '#fff';
                        answerArr[answerArr.indexOf(guessArr[i])] = null;
                    } else if (guessArr[i]) {
                        rowCells[i].style.background = '#787c7e'; // gray
                        rowCells[i].style.color = '#fff';
                    }
                }
                // Build emoji row for sharing
                if (guess === answer) {
                    emojiRow = '🟩🟩🟩🟩🟩';
                } else {
                    let answerArr = answer.split('');
                    let guessArr = guess.split('');
                    let emojiArr = Array(5).fill('');
                    let answerUsed = Array(5).fill(false);
                    // First pass: mark greens
                    for (let i = 0; i < 5; i++) {
                        if (guessArr[i] === answerArr[i]) {
                            emojiArr[i] = '🟩';
                            answerUsed[i] = true;
                            guessArr[i] = null; // Mark as used
                        }
                    }
                    // Second pass: mark yellows
                    for (let i = 0; i < 5; i++) {
                        if (emojiArr[i]) continue; // Already green
                        let found = false;
                        for (let j = 0; j < 5; j++) {
                            if (!answerUsed[j] && guessArr[i] && guessArr[i] === answerArr[j]) {
                                found = true;
                                answerUsed[j] = true;
                                break;
                            }
                        }
                        emojiArr[i] = found ? '🟨' : '⬛';
                    }
                    emojiRow = emojiArr.join('');
                }
                guessHistory.push(emojiRow);
                // Win/Lose feedback
                if (guess === answer) {
                    feedback.innerHTML = '<span style="font-size:1.5em;font-weight:bold;color:#6aaa64">🎉 <b>Congratulations!</b> 🎉<br>You guessed the word! 🏆</span>';
                    gameOver = true;
                    showDefinition(answer);
                    showShareButton('win', currentRow + 1);

                    await recordResult('win', currentRow + 1, answer);

                    setTimeout(async () => { await updateStatsDisplay(); }, 200);
                    if (mode === 'daily') {
                        updateLeaderboardDisplay();
                        // Daily play is now tracked by backend, not localStorage
                    } else if (mode === 'random') {
                        showNewRandomGameButton();
                    }
                } else if (currentRow === 5) {
                    feedback.innerHTML = `<span style="font-size:1.5em;font-weight:bold;color:#d32f2f">😢 <b>Game Over!</b> 😢<br>The word was <b>${answer}</b>.</span>`;
                    gameOver = true;
                    showDefinition(answer);
                    showShareButton('loss', 6);

                    await recordResult('loss', 6, answer);

                    setTimeout(async () => { await updateStatsDisplay(); }, 200);
                    if (mode === 'daily') {
                        updateLeaderboardDisplay();
                        // Daily play is now tracked by backend, not localStorage
                    } else if (mode === 'random') {
                        showNewRandomGameButton();
                    }
                } else {
                    feedback.textContent = '';
                    currentRow++;
                }
                currentGuess = [];
                updateGridDisplay();
                updateKeyboardColors();
                // After coloring cells for win/loss, always set the cell text to the guessed letter and color
                if (gameOver) {
                    setTimeout(() => {
                        for (let i = 0; i < 5; i++) {
                            rowCells[i].textContent = guess[i];
                            if (guess[i] === answer[i]) {
                                rowCells[i].style.background = '#6aaa64';
                                rowCells[i].style.color = '#fff';
                            }
                        }
                    }, 0);
                }
            }

            // --- Share Feature ---
            function hideShareButton() {
                let shareBtn = document.getElementById('wordle-share-btn');
                if (shareBtn) shareBtn.style.display = 'none';
            }

            function showNewRandomGameButton() {
                let newBtn = document.getElementById('wordle-new-random-btn');
                let newBtnContainer = document.getElementById('wordle-new-random-container');
                if (!newBtnContainer) {
                    newBtnContainer = document.createElement('div');
                    newBtnContainer.id = 'wordle-new-random-container';
                    newBtnContainer.className = 'text-center';
                    feedback.parentNode.insertBefore(newBtnContainer, feedback.nextSibling);
                }
                if (!newBtn) {
                    newBtn = document.createElement('button');
                    newBtn.id = 'wordle-new-random-btn';
                    newBtn.className = 'btn btn-outline-primary mt-3';
                    newBtn.textContent = 'New Random Game';
                    newBtn.onclick = async function() {
                        resetGame();
                        await fetchRandomAnswer();
                    };
                    newBtnContainer.appendChild(newBtn);
                } else {
                    newBtn.style.display = '';
                }
            }

            function hideNewRandomGameButton() {
                let newBtn = document.getElementById('wordle-new-random-btn');
                if (newBtn) newBtn.style.display = 'none';
            }

            // --- Stats and Leaderboard ---
            // --- Stats by mode ---
            async function fetchStats(mode) {
                // Use jQuery AJAX to ensure X-Requested-With header is sent
                return new Promise((resolve) => {
                    $.ajax({
                        url: `${PATH}/app/wordle.php?action=get_stats&mode=${mode}`,
                        method: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            if (data.stats) {
                                resolve(data.stats);
                            } else {
                                resolve({ played: 0, wins: 0, streak: 0, maxStreak: 0 });
                            }
                        },
                        error: function(xhr, status, error) {
                            resolve({ played: 0, wins: 0, streak: 0, maxStreak: 0 });
                        }
                    });
                });
            }

            async function updateStatsDisplay() {
                const stats = await fetchStats(mode);
                document.getElementById('wordle-stats').innerHTML = `
                    <div>Games Played: <b>${stats.played}</b></div>
                    <div>Wins: <b>${stats.wins}</b></div>
                    <div>Current Streak: <b>${stats.streak}</b></div>
                    <div>Max Streak: <b>${stats.maxStreak}</b></div>
                    <div class="small text-muted">Mode: <b>${mode.charAt(0).toUpperCase() + mode.slice(1)}</b></div>
                `;
            }
            // --- Real leaderboard ---
            async function updateLeaderboardDisplay() {
                // Use jQuery AJAX to ensure X-Requested-With header is sent
                $.ajax({
                    url: `${PATH}/app/wordle.php?action=leaderboard`,
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        if (!data.leaderboard || !Array.isArray(data.leaderboard) || data.leaderboard.length === 0) {
                            document.getElementById('wordle-leaderboard').innerHTML = '<div class="text-danger">No leaderboard data returned.</div>';
                            return;
                        }
                        // Sort leaderboard by wins field (from backend)
                        const leaderboard = Array.isArray(data.leaderboard) ? [...data.leaderboard] : [];
                        leaderboard.sort((a, b) => ((b.wins || 0) - (a.wins || 0)));
                        const top10 = leaderboard.slice(0, 10);
                        let html = '<ol class="mb-0">';
                        top10.forEach((user) => {
                            let name = user.display_name || user.user || 'Anonymous';
                            // Highlight current user if logged in
                            if (window.currentUserId && (user.user_id == window.currentUserId || user.id == window.currentUserId)) {
                                name = `<span class="text-primary">${name} (You)</span>`;
                            }
                            const dailyWins = user.wins || 0;
                            html += `<li><b>${name}</b> <span class="text-muted">(${dailyWins} daily win${dailyWins===1?'':'s'})</span></li>`;
                        });
                        html += '</ol>';
                        document.getElementById('wordle-leaderboard').innerHTML = html;
                    },
                    error: function(xhr, status, error) {
                        let msg = 'Could not load leaderboard.';
                        if (xhr && xhr.responseText) {
                            msg += '<br>' + xhr.responseText;
                        }
                        document.getElementById('wordle-leaderboard').innerHTML = '<div class="text-danger">' + msg + '</div>';
                    }
                });
            }
            // Set current user id for highlighting
            window.currentUserId = <?php echo isset($_SESSION[PREFIX . 'user_id']) ? json_encode($_SESSION[PREFIX . 'user_id']) : 'null'; ?>;
            updateStatsDisplay();
            updateLeaderboardDisplay();

            // --- Game Mode Buttons ---
            // Only declare these once at the top
            const dailyBtn = document.getElementById('daily-btn');
            const randomBtn = document.getElementById('random-btn');
            dailyBtn.disabled = true;
            randomBtn.disabled = false;

            dailyBtn.addEventListener('click', () => {
                if (mode === 'daily') return;
                mode = 'daily';
                resetGame();
                fetchAnswer().then(blockIfPlayedToday);
                dailyBtn.disabled = true;
                randomBtn.disabled = false;
                updateStatsDisplay();
            });
            randomBtn.addEventListener('click', () => {
                if (mode === 'random') return;
                mode = 'random';
                resetGame();
                randomBtn.disabled = true;
                dailyBtn.disabled = false;
                (async () => {
                    await fetchRandomAnswer();
                    // Now the answer is set and game is ready
                })();
                updateStatsDisplay();
            });

            function resetGame() {
                // Clear grid
                for (let row of grid) {
                    for (let cell of row.querySelectorAll('.wordle-cell')) {
                        cell.textContent = '';
                        cell.style.background = '#fff';
                        cell.style.color = '#222';
                    }
                }
                currentRow = 0;
                gameOver = false;
                answer = null;
                feedback.textContent = '';
                definitionDiv.textContent = '';
                guessHistory = [];
                hideShareButton();
                hideNewRandomGameButton();
                document.querySelectorAll('.wordle-key').forEach(btn => {
                    btn.style.background = '';
                    btn.style.color = '';
                });
            }

            async function showDefinition(word) {
                definitionDiv.textContent = 'Looking up definition...';
                const dictUrl = `https://dictionaryapi.dev/`;
                const wordUrl = `https://www.google.com/search?q=define+${encodeURIComponent(word)}`;
                try {
                    const res = await fetch(`https://api.dictionaryapi.dev/api/v2/entries/en/${word.toLowerCase()}`);
                    if (!res.ok) throw new Error('Not found');
                    const data = await res.json();
                    if (Array.isArray(data) && data[0]?.meanings?.length) {
                        const defs = data[0].meanings[0].definitions;
                        definitionDiv.innerHTML = `<b>${word}</b>: ${defs[0].definition} <br><a href="${wordUrl}" target="_blank" rel="noopener">More about "${word}"</a>`;
                    } else {
                        definitionDiv.innerHTML = `No definition found for <b>${word}</b>. <a href="${wordUrl}" target="_blank" rel="noopener">Search "${word}"</a>`;
                    }
                } catch (e) {
                    definitionDiv.innerHTML = `No definition found for <b>${word}</b>. <a href="${wordUrl}" target="_blank" rel="noopener">Search "${word}"</a>`;
                }
            }
            async function blockIfPlayedToday() {
                // Check with backend if user has played today using jQuery AJAX
                return new Promise((resolve) => {
                    $.ajax({
                        url: `${PATH}/app/wordle.php?action=daily_played_check`,
                        method: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            console.log(data);
                            if (data.played) {
                                feedback.innerHTML = '<div class="alert alert-warning" role="alert">You have already played today! Come back tomorrow.</div>';
                                gameOver = true;
                                resolve(true);
                            } else {
                                resolve(false);
                            }
                        },
                        error: function(xhr, status, error) {
                            // fallback: allow play if error
                            resolve(false);
                        }
                    });
                });
            }
            async function fetchAnswer() {
                return new Promise((resolve) => {
                    const todayStr = getTodayStr(); // Use local time
                    $.ajax({
                        url: `${PATH}/app/wordle.php?action=daily&game_date=${todayStr}`,
                        method: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            if (data.word) {
                                answer = data.word.toUpperCase();
                                resolve();
                            } else {
                                feedback.textContent = 'Could not load word. Try refreshing.';
                                gameOver = true;
                                resolve();
                            }
                        },
                        error: function(xhr, status, err) {
                            feedback.textContent = 'Error connecting to server!';
                            gameOver = true;
                            resolve();
                        }
                    });
                });
            }
            async function fetchRandomAnswer() {
                // Use jQuery AJAX to ensure X-Requested-With header is sent
                return new Promise((resolve) => {
                    $.ajax({
                        url: `${PATH}/app/wordle.php?action=random`,
                        method: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            if (data.word) {
                                answer = data.word.toUpperCase();
                                gameOver = false;
                            } else {
                                feedback.textContent = 'Could not load word. Try refreshing.';
                                gameOver = true;
                            }
                            resolve();
                        },
                        error: function(xhr, status, error) {
                            feedback.textContent = 'Error connecting to server!!';
                            gameOver = true;
                            resolve();
                        }
                    });
                });
            }
            // Start with daily mode
            fetchAnswer().then(blockIfPlayedToday);

            // --- Save result to backend ---
            async function recordResult(result, guesses, answer) {

                // Extra debug: log PATH and request body
                const requestBody = {
                    game_date: getTodayStr(),
                    mode: mode,
                    result: result,
                    guesses: guesses,
                    answer: answer,
                    guess_history: (guessHistory.join('\n').substring(0, 255))
                };
               
                // Validate required fields
                if (!mode || !result || !guesses || !answer) {
                    feedback.innerHTML = '<div class="alert alert-danger">Missing required fields for result.</div>';
                    console.error('Missing required fields:', {mode, result, guesses, answer});
                    return;
                }
                // Use jQuery AJAX to ensure X-Requested-With header is sent
                $.ajax({
                    url: `${PATH}/app/wordle.php?action=record_result`,
                    method: 'POST',
                    contentType: 'application/json',
                    dataType: 'json',
                    data: JSON.stringify(requestBody),
                    success: function(data, textStatus, jqXHR) {
                        if (jqXHR.status === 401) {
                            feedback.innerHTML = '<div class="alert alert-danger">You must be logged in to record your result. <a href="login.php">Log in</a></div>';
                            return;
                        }
                        if (!data.success) {
                            feedback.innerHTML = '<div class="alert alert-danger">Failed to record result: ' + (data.error || 'Unknown error') + '</div>';
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        let responseText = jqXHR.responseText || '';
                        let url = `${PATH}/app/wordle.php?action=record_result`;
                        try {
                            let data = JSON.parse(responseText);
                            if (jqXHR.status === 401) {
                                feedback.innerHTML = '<div class="alert alert-danger">You must be logged in to record your result. <a href="login.php">Log in</a></div>';
                                return;
                            }
                            if (!data.success) {
                                feedback.innerHTML = '<div class="alert alert-danger">Failed to record result: ' + (data.error || 'Unknown error') + '</div>';
                            }
                        } catch (err) {
                            console.error('Invalid JSON from server:', {url, responseText});
                            feedback.innerHTML = '<div class="alert alert-danger">Invalid JSON from server:<br><b>' + url + '</b><br><pre>' + responseText + '</pre></div>';
                        }
                    }
                });
            }

            function showShareButton(result, guesses) {
                let shareBtn = document.getElementById('wordle-share-btn');
                let shareContainer = document.getElementById('wordle-share-container');
                if (!shareContainer) {
                    shareContainer = document.createElement('div');
                    shareContainer.id = 'wordle-share-container';
                    shareContainer.className = 'text-center';
                    feedback.parentNode.insertBefore(shareContainer, feedback.nextSibling);
                }
                if (!shareBtn) {
                    shareBtn = document.createElement('button');
                    shareBtn.id = 'wordle-share-btn';
                    shareBtn.className = 'btn btn-outline-success mt-3';
                    shareBtn.textContent = 'Share your result';
                    shareBtn.onclick = function() {
                        // Word Rift style: header and emoji grid, include game mode
                        const modeLabel = mode === 'daily' ? 'Daily' : (mode === 'random' ? 'Random' : mode.charAt(0).toUpperCase() + mode.slice(1));
                        const title = `Word Rift (${modeLabel}) ${getTodayStr()} ${result === 'win' ? guesses : 'X'}/6`;
                        // Only allow 🟩, 🟨, ⬛ in output, and ensure each row is exactly 5 characters
                        const grid = guessHistory.map(row => {
                            // Replace placeholders, remove any non-emoji, then ensure exactly 5 emoji chars
                            let emojiArr = row.replace(/_/g, '⬛').replace(/[^🟩🟨⬛]/gu, '').match(/./gu) || [];
                            // Always force to exactly 5 emoji squares
                            if (emojiArr.length < 5) {
                                while (emojiArr.length < 5) emojiArr.push('⬛');
                            } else if (emojiArr.length > 5) {
                                emojiArr = emojiArr.slice(0, 5);
                            }
                            return emojiArr.join('');
                        }).join('\n');
                        const text = `${title}\n${grid}`;
                        navigator.clipboard.writeText(text).then(() => {
                            shareBtn.textContent = 'Copied!';
                            setTimeout(() => {
                                shareBtn.textContent = 'Share your result';
                            }, 1500);
                        });
                    };
                    shareContainer.appendChild(shareBtn);
                } else {
                    shareBtn.style.display = '';
                }
            }

            // --- Physical keyboard support ---
            document.addEventListener('keydown', function(e) {
                if (gameOver) return;
                if (document.activeElement && document.activeElement.tagName === 'INPUT') return; // Don't interfere with input fields
                const key = e.key.toUpperCase();
                if (key === 'BACKSPACE') {
                    currentGuess.pop();
                    updateGridDisplay();
                    e.preventDefault();
                } else if (key === 'ENTER') {
                    if (currentGuess.length === 5) {
                        handleGuess(currentGuess.join(''));
                    }
                    e.preventDefault();
                } else if (/^[A-Z]$/.test(key) && currentGuess.length < 5) {
                    currentGuess.push(key);
                    updateGridDisplay();
                    e.preventDefault();
                }
            });

            function getTodayStr() {
                const d = new Date();
                // Use local time, not UTC
                const year = d.getFullYear();
                const month = String(d.getMonth() + 1).padStart(2, '0');
                const day = String(d.getDate()).padStart(2, '0');
                return `${year}-${month}-${day}`;
            }
            // <-- Add missing closing brace for DOMContentLoaded
        });
    </script>
    </body>

    </html>

<?php require __DIR__ . '/partials/footer.php'; ?>
