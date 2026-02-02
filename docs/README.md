# Wordrift Operational Guide

This guide covers the main operational features of Wordrift, focusing on admin and user management, customization, and advanced options.

## Admin Area Overview

The admin panel provides full control over your Wordrift installation:

- **User Management:**
  - View, edit, and delete users
  - Reset user passwords
  - Assign admin privileges
  - Monitor user activity and game history

- **Wordlist Management:**
  - Upload a custom word list via CSV (bulk import)
  - Add, edit, or delete words individually
  - Ensure your game is 100% customizable to your audience
  - Prevent duplicate words during upload

- **Game Settings:**
  - Configure game modes and rules
  - Set daily/weekly challenges
  - Manage themes and appearance

- **Statistics & Leaderboards:**
  - View player stats and rankings
  - Export data for analysis

## User Area Features

- **Profile Management:**
  - Users can update their profile and password
  - View personal game history and stats

- **Gameplay:**
  - Play daily or custom word games
  - Track progress and compare with others

## Customization Options

- **Themes:**
  - Change the look and feel via the theme settings
  - Upload custom assets (logo, favicon, CSS)

- **Modules:**
  - Enable/disable modules for features like contact forms, user registration, etc.

## Wordlist Upload (CSV)

- Go to the admin panel > Wordlist section
- Use the CSV upload tool to import a list of words
- The system will automatically skip duplicates and invalid entries
- You can manage the word list at any time for full control

**Important notes about daily puzzles and word list length:**

- The daily puzzle uses your uploaded word list in order, one word per day, starting from the date you first install or reset the list.
- The first word in your list becomes the answer for the first available daily puzzle, the second word for the next day, and so on.
- If your word list runs out (e.g., fewer words than days since install), the daily game will break for all users until you upload more words.
- **Recommended:** Upload at least 365 words for a year of daily play, or more for uninterrupted operation. For long-term sites, consider uploading several years' worth (e.g., 1000+ words).
- You can safely add more words at any time; new words will be used for future dates.

Be sure to plan your word list size according to how long you want the daily game to run without interruption.

## Streaks & Statistics

- **Streaks:**
  - Track consecutive days of correct guesses (win streaks)
  - Streaks are shown in user profiles and leaderboards
  - Admins can view and reset user streaks if needed

- **Statistics:**
  - Users can view their total games played, win rate, average guesses, and best streak
  - Admins have access to global stats, user breakdowns, and export options
  - Stats help monitor engagement and identify top players

## Security & Maintenance

- Remove or secure `/app/install.php` after setup
- Regularly update your config and wordlist for best results
- Use the admin panel to monitor and manage users

## Advanced Topics

For developer documentation, API details, and troubleshooting, see other files in this `/docs/` directory.

---
For installation instructions, see the main project README.md.
