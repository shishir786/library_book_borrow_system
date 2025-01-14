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
                                    <th>Actions</th> <!-- New column for Edit button -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Database connection
                                $servername = "localhost";
                                $username = "root";
                                $password = "";
                                $dbname = "bookborrow";

                                // Create connection
                                $conn = new mysqli($servername, $username, $password, $dbname);

                                // Check connection
                                if ($conn->connect_error) {
                                    die("Connection failed: " . $conn->connect_error);
                                }

                                // Query to get data from the books table
                                $sql = "SELECT BookId, Tittle, Author, ISBN, Category, Quantity FROM booklist";
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
            <td>
                <span class='edit-btn' 
                    data-bookid='" . $row["BookId"] . "' 
                    data-tittle='" . $row["Tittle"] . "' 
                    data-author='" . $row["Author"] . "' 
                    data-isbn='" . $row["ISBN"] . "' 
                    data-category='" . $row["Category"] . "' 
                    data-quantity='" . $row["Quantity"] . "'
                    title='Edit'>📝</span>
            </td>
        </tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='7'>No records found</td></tr>";
                                }

                                // Close connection
                                $conn->close();
                                ?>


                                <script src="formH.js"></script>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- ------------------------------------------------ -->
                <div class="box1L">
                    <div class="form-heading">Edit Book Details</div>
                    <form id="edit-form" action="edit_book.php" method="post" class="form-container" style="display: none;">
                        <!-- Hidden field for BookId -->
                        <input type="hidden" name="BookId" id="BookId">

                        <div class="form-group">
                            <label for="Tittle">Title</label>
                            <input type="text" name="Tittle" id="Tittle" required>
                        </div>
                        <div class="form-group">
                            <label for="Author">Author</label>
                            <input type="text" name="Author" id="Author" required>
                        </div>
                        <div class="form-group">
                            <label for="ISBN">ISBN</label>
                            <input type="text" name="ISBN" id="ISBN" required>
                        </div>
                        <div class="form-group">
                            <label for="Category">Category</label>
                            <input type="text" name="Category" id="Category" required>
                        </div>
                        <div class="form-group">
                            <label for="Quantity">Quantity</label>
                            <input type="number" name="Quantity" id="Quantity" required>
                        </div>
                        <div class="form-actions">
                            <button type="submit">Save</button>
                            <button type="button" onclick="hideForm()">Cancel</button>
                        </div>
                    </form>
                </div>


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
                            <input type="submit" name="submit" class="btnSub">

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
            <div class="boxSd2">

                <div class="library-box">
                    <div class="rotating-icon">📚</div>
                    <p class="welcome-text">"A room without books is like a body without a soul."</p>
                    <div class="motivational-text">
                        <p>"Fuel your mind, one page at a time."</p>
                        <p>"Dive into the adventures, knowledge, and wonders waiting within."</p>
                        <p>"The more you read, the more you know, the more you grow."</p>
                    </div>
                </div>





            </div>
        </div>

    </div>
</body>

</html>