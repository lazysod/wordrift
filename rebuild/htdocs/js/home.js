// Black out unused boxes if the word is shorter than 5
function blackoutUnusedWordleCells(wordLength) {
	document.querySelectorAll('#wordle-grid .d-flex').forEach(row => {
		const cells = row.querySelectorAll('.wordle-cell');
		for (let i = wordLength; i < 5; i++) {
			cells[i].classList.add('wordle-cell-unused');
		}
		for (let i = 0; i < wordLength; i++) {
			cells[i].classList.remove('wordle-cell-unused');
		}
	});
}

// Example: call this after fetching the word (replace 3 with actual word length)
// blackoutUnusedWordleCells(3);

// If you fetch the word via AJAX, call blackoutUnusedWordleCells(word.length) after loading.
// home.js - example page-specific JS
console.log('Home page JS loaded');
