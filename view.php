<?php

    include 'config.php';

    $sql = "SELECT * FROM " . $tablename;

    $result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
    <head>
        <title>View Page</title>
        <link rel = 'stylesheet' href = 'https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css'>
    </head>
    <body>
        <div class = 'container'>
            <h2>Bookings</h2>
            <table>
                <thead>
                    <tr>
                        <th>Customer Number</th>
                        <th>Room Type</th>
                        <th>Number of Guests</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Arrival</th>
                        <th>Departure</th>
                        <th>Free Pickup</th>
                        <th>Flight Number</th>
                        <th>Other Requests</th>
                        <th>Actions</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                    ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['room_type']; ?></td>
                                    <td><?php echo $row['guests']; ?></td>
                                    <td><?php echo $row['firstname']; ?> <?php echo $row['lastname']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo $row['arrival']; ?></td>
                                    <td><?php echo $row['departure']; ?></td>
                                    <td><?php echo $row['pickup']; ?></td>
                                    <td><?php echo $row['flight']; ?></td>
                                    <td><?php echo $row['requests']; ?></td>
                                    <td>
                                        <a class = 'btn btn-info' href = 'update.php?id=<?php echo $row['id']; ?>'>Edit</a> <br>
                                        <a class = 'btn btn-danger' href='delete.php?id=<?php echo $row['id']; ?>'>Delete</a>
                                    </td>
                                </tr>
                    <?php
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <button onclick="location.href='create.php'">Create</a>
    </body>
</html>