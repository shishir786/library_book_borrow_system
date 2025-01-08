<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Borrow System</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="id">

        <img src="images/id.jpg" alt="NAme and Id">

    </div>


    <h1>Book Borroing Managemnt</h1>
    <div class="container">


        <div class="side1">
            <div class="boxSd1">

                <h4>Used Token List</h4>
                <ul>
                    <?php
                    $json_data = file_get_contents('usedToken.json');
                    $data = json_decode($json_data, true);
                    foreach ($data['UsedToken'] as $token) {
                        echo "<li>$token</li>";
                    }
                    ?>
                </ul>

            </div>
        </div>


        <div class="middle">
            <div class="first">
                <div class="box1">

                    <h2>Books List</h2>
                    <!-- Table wrapper with scrolling -->
                    <div class="table-wrapper">
                        <!-- Table to display data -->
                        <table>
                            <thead>
                                <tr>
                                    <th>Book ID</th>
                                    <th>Book Title</th>
                                    <th>Author</th>
                                    <th>ISBN</th>
                                    <th>Category</th>
                                    <th>Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Database connection
                                $servername = "localhost"; // Your database server
                                $username = "root";        // Your database username
                                $password = "";            // Your database password
                                $dbname = "bookborrow";          // Your database name

                                // Create connection
                                $conn = new mysqli($servername, $username, $password, $dbname);

                                // Check connection
                                if ($conn->connect_error) {
                                    die("Connection failed: " . $conn->connect_error);
                                }

                                // Query to get data from the books table
                                $sql = "SELECT BookId,Tittle, Author, ISBN, Category, Quantity FROM booklist";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    // Loop through the rows and display them in the table
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>
                      <td>" . $row["BookId"] . "</td>
                      <td>" . $row["Tittle"] . "</td>
                      <td>" . $row["Author"] . "</td>
                      <td>" . $row["ISBN"] . "</td>
                      <td>" . $row["Category"] . "</td>
                      <td>" . $row["Quantity"] . "</td>
                    </tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='6'>No records found</td></tr>";
                                }

                                // Close connection
                                $conn->close();
                                ?>
                            </tbody>
                        </table>

                    </div>






                </div>
                <div class="box1L"></div>
            </div>
            <div class="second">
                <div class="box2">
                    <img src="images/1.jpg" alt="">
                </div>
                <div class="box2">
                    <img src="images/2.jpg" alt="">
                </div>
                <div class="box2">
                    <img src="images/3.jpg" alt="">
                </div>
            </div>

            <div class="third">
                <div class="box3">
                    <!-- ------------------------------------box 3----------------------- -->

                    <div class="form-heading">Add New Book</div>
                    <form class="form-container" id="bookForm" onsubmit="submitForm(event)" action="bookAddProcess.php" method="post">
                        <div class="form-group">
                            <label for="bookTitle">Book Title</label>
                            <input type="text" name="booksssTitle" required>
                        </div>
                        <div class="form-group">
                            <label for="author">Author</label>
                            <input type="text" name="author" required>
                        </div>
                        <div class="form-group">
                            <label for="isbn">ISBN</label>
                            <input type="text" name="isbn" required>
                        </div>
                        <div class="form-group">
                            <label for="category">Category</label>
                            <input type="text" name="category" required>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="number" name="quantity" required>
                        </div>
                        <div class="form-actions">
                            <button type="submit">Submit</button>
                        </div>
                    </form>


                </div>
            </div>
            <div class="forth">
                <div class="box4">

                    <div class="bfrm">

                        <div class="t">
                            <p>Book Borrowing Form</p>
                        </div>

                        <form class="form" action="process.php" method="post">

                            <input type="text" name="Name" placeholder="Full Name">
                            <input type="text" name="Id" placeholder="ID">
                            <input type="email" name="Email" placeholder="Email">
                            <select id="BookTittle" name="BookTittle">
                                <option value="null">Choose a Book</option>
                                <option value="The Night Circus">The Night Circus</option>
                                <option value="To Kill a Mockingbird">To Kill a Mockingbird</option>
                                <option value="Where the Crawdads Sing">Where the Crawdads Sing</option>
                                <option value="Sapiens: A Brief History of Humankind">Sapiens: A Brief History of Humankind</option>
                                <option value="The Great Gatsby">The Great Gatsby</option>
                                <option value="The Catcher in the Rye">The Catcher in the Rye</option>
                                <option value="Circe">Circe</option>
                                <option value="The Silent Patient">The Silent Patient</option>
                                <option value="Educated">Educated</option>
                            </select>
                            <input type="date" name="brDate" placeholder="Borrowing Date">
                            <input type="text" name="Token" placeholder="Token Number">
                            <br>
                            <input type="date" name="RtDate" placeholder="Return Date">
                            <input type="text" name="Fees" placeholder="Fees">
                            <input type="submit" name="submit" class="btn">

                        </form>
                    </div>
                </div>

                <div class="box5">
                    <h4>Token List</h4>
                    <ul>
                        <?php
                        $json_data = file_get_contents('token.json');
                        $data = json_decode($json_data, true);
                        foreach ($data['Token'] as $token) {
                            echo "<li>$token</li>";
                        }
                        ?>
                    </ul>

                </div>
            </div>

        </div>

        <div class="side2">
            <div class="boxSd2"></div>
        </div>

    </div>
</body>

</html>