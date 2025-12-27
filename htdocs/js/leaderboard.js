// leaderboard.js
// Fetch and render leaderboard data
console.log('Loading leaderboard data...');
document.addEventListener('DOMContentLoaded', function() {
    fetch('/app/wordle.php?action=leaderboard')
        .then(response => response.json())
        .then(data => {
            const container = document.getElementById('leaderboard-content');
            if (!data.leaderboard || !Array.isArray(data.leaderboard)) {
                container.innerHTML = '<div class="alert alert-danger">No leaderboard data available.</div>';
                return;
            }
            let html = '<ol class="mb-0">';
            data.leaderboard.slice(0, 10).forEach((user, i) => {
                let name = user.display_name || user.user || 'Anonymous';
                html += `<li><b>${name}</b> <span class="text-muted">(${user.wins || 0} win${user.wins===1?'':'s'})</span></li>`;
            });
            html += '</ol>';
            container.innerHTML = html;
        })
        .catch(() => {
            document.getElementById('leaderboard-content').innerHTML = '<div class="alert alert-danger">Could not load leaderboard.</div>';
        });
});
