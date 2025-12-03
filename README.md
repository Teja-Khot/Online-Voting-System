# Online-Voting-System
Web Application Project
This project is an Online Voting System designed to provide a secure, transparent, and user-friendly platform for conducting elections digitally. It allows registered users to cast their votes online and ensures that results are calculated accurately and efficiently.
🎯 Features
- 🔐 User Authentication – Secure login for voters and administrators
- 🗳️ Vote Casting – Simple interface for submitting votes
- 📊 Real-Time Results – Automatic tallying and display of results 
- 👩‍💼 Admin Panel – Manage candidates and election 
- 🛡️ Data Security – Encryption and validation to prevent fraud
🛠️ Technologies Used
- Frontend: HTML, CSS, JavaScript
- Backend: PHP 
- Database: PhpMyAdmin 
🚀 Installation & Setup
- Clone or download the project files.
- Import the database schema (OnlineVotingSystem_\database\onlinevotingsystem.sql) into PhpMyAdmin.
- Configure database connection in config.php.
- Run the project on a local server (XAMPP).
- Access the system via http://localhost/OnlineVotingSystem.
👥 User Roles
- Voter: Can log in, view candidates, and cast a vote.
- Admin: Can add/remove candidates, manage voters, and view results.
📂 Project Structure
OnlineVotingSystem/
│
├── admin/               → Admin dashboard and election management
│   ├── add_candidates.php
│   ├── add_elections.php
│   ├── config.php       → DB connection setup
│   ├── viewResults.php  → Display election results
│   └── ...              → Header, footer, navigation, homepage
│
├── assets/              → Static resources
│   ├── css/             → Stylesheets
│   ├── js/              → JavaScript (bootstrap, jQuery)
│   └── images/          → UI images
│
├── database/
│   └── onlinevotingsystem.sql → SQL schema for tables (voters, candidates, elections)
│
├── voters/              → Voter interface
│   ├── index.php        → Voter login/homepage
│   └── inc/             → Includes for voter pages

⚖️ Limitations
- Requires stable internet connection.
- Works best on modern browsers.
📌 Future Enhancements
- Blockchain-based vote recording for higher transparency
- Mobile app integration
- Multi-language support
