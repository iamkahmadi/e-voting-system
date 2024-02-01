# e-Voting System

The e-Voting System is a secure and efficient solution for conducting elections electronically. It provides a user-friendly interface for voters to cast their votes online, while ensuring the integrity and confidentiality of the voting process.

## Installation

To use the e-Voting System, follow these steps:

1. Download and install XAMPP from the official website: [https://www.apachefriends.org](https://www.apachefriends.org).

2. Clone this repository into the `htdocs` folder of your XAMPP installation:
   
   git clone https://github.com/iamkahmadi/e-voting-system.git
   

3. Unzip the `bower_components.zip` and `tcpdf.zip` files located inside the project folder.

4. Start the Apache and MySQL services in XAMPP.

5. Open a web browser and go to `http://localhost/phpmyadmin`.

6. Create a new database named `votesystem` and import the `votesystem.sql` file located in the `db` folder of the project.

7. Modify the database connection settings in `conn.php` located in the `includes` folder:
   
php
	$conn = new mysqli('localhost', 'root', '', 'votesystem');

   
8. Open a web browser and go to `http://localhost/e-voting-system` to access the e-Voting System.

## Contributing

Contributions to this project are welcome and encouraged. If you encounter any issues or have suggestions for improvements, please feel free to submit a pull request or open an issue.

## License

This e-Voting System is licensed under the [MIT License](LICENSE).

Please note that this e-Voting System is intended for educational and research purposes only and should not be used for actual elections without proper legal and security considerations.