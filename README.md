# WebChatApp
The following Web Chat App is based off of a tutorial from CodingNepal with a few revisions. This web app allows users to have one on one conversations with other users through the use of JavaScript, Ajax, PHP, and SQL. The app's appearance is configured with CSS. Users that are not signed in are redirected to the login page if they attempt to access the page with all users or chat. The users and chat page are dynamic and change based on whether the user is searching for a specific user, inclusion of new users, and who the user is interacting with (the latter regards to the chat page). Existing users can also search for other users through the search bar. New accounts must have a unique username, unique email, and provide a profile picture. Messages are not sent and received with sockets and are simply sent to the database and retrieved by the user. Logging in and out automatically changes the status of a user from "Active now" to "Offline now" depending on the action.

## Planned Additions:
Currently, the web chat app provides the basic functionalities of sending and receiving messages, but lacks many important features that most chat apps have. Features that will be implemented include default profile pictures, adding/removing friends, blocking/unblocking users, settings (change username, password, email, and/or profile picture), dark mode, and group chats.

## Database and Tables
Web Chat App was created and ran using XAMPP Control Panel, thus databases can only be accessed through [http://localhost/phpmyadmin/](http://localhost/phpmyadmin/ "Link to phpmyadmin if XAMPP Control Panel is installed")

### users Table
Table Structure: user_id {Primary and Unique int}, unique_id {int(200)}, username {varchar(255)}, email {varchar(255)}, password {varchar(255)}, img {varchar(400)}, status {varchar(255)}

### messages Table
Table Structure: msg_id {Primary and Unique int}, incoming_msg_id {int(255)}, outcoming_msg_id {int(255)}, msg {varchar(1000)}

## Files and Basic Descriptions

### php folder
`images` - Folder that stores user profile pictures

`config.php` - PHP file used to establish a connection to the server and database

`data.php` - PHP file used to dynamically update `users.php` (used for searching and displaying users)

`get-chat.php` - PHP file used to dynamically update `chat.php` and show all messages between two users

`handle-login.php` - PHP file used to handle user login

`handle-users.php` - PHP file used to dynamically update `users.php` (specifcally the list of all existing users)

`insert-chat.php` - PHP file used to append messages between users in the database

`logout.php` - PHP file used to handle user log out

`search.php` - PHP file used to handle searching for other users

`signup.php` - PHP file used to handle the registration of new accounts

### scripts folder
`chat.js` - JavaScript file used to handle one on one chats with Ajax between two users and update chat box by calling `php/insert-chat.php` and `php/get-chat.php`

`login.js` - JavaScript file used to retrieve the data with Ajax provided by the user in the login form and calls `php/handle-login.php`

`pass-show-hide.js` - JavaScript file used to hide/show password in the signup and login form

`signup.js` - JavaScript file used to retrieve the data with Ajax provided by the user in the signup form and calls `php/signup.php`

`users.js` - JavaScript file used to dynamically update the list of searched users and list of all existing users with Ajax. Calls `php/search.php` and `php/handle-users.php` respectively

### Main pages
`chat.php` - PHP file containing the page for a one on one conversation between two users. Uses php session to redirect users that are not logged in

`index.php` - PHP file containing the page for signing up. Uses php session to redirect users that are already logged in

`login.php` - PHP file containing the page for logging in. Uses php session to redirect users that are already logged in

`users.php` - PHP file containing the main page which displays the user's username, icon, and status. Also allows user to search for other users or view a list of existing users. Uses php session to redirect users that are not logged in

### Styling
`style.css` - CSS file containing the styles for the main pages above

## Instructions
1. Install XAMPP Control Panel
2. Clone the repository and place the folder into the following directory: ..\xampp\htdocs
3. Open a web browser and head to [http://localhost/phpmyadmin/](http://localhost/phpmyadmin/ "Link to phpmyadmin if XAMPP Control Panel is installed")  in order to configure the database. Create a database named "chat." If another name is provided, change the database name in `php/config.php`
4. Create a users and messages table as described in the Database and Tables section
5. Open up the web chat app by going to [http://localhost/webchatapp/](http://localhost/webchatapp/ "Link to open Web Chat App if XAMPP Control Panel is installed")
