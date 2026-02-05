// leaderboard.js (updated to match home.php)
document.addEventListener('DOMContentLoaded', function() {
    // Use jQuery AJAX to ensure X-Requested-With header is sent
    if (typeof $ === 'undefined') return; // Require jQuery
    function updateLeaderboardDisplay() {
        $.ajax({
            url: '/app/wordle.php?action=leaderboard',
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
                    msg += ' ' + xhr.responseText;
                }
                document.getElementById('wordle-leaderboard').innerHTML = `<div class="text-danger">${msg}</div>`;
            }
        });
    }
    updateLeaderboardDisplay();
});
