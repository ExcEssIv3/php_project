<?php

    include 'config.php';

    $room_type = $guests = $firstname = $lastname = $email = $arrival = $departure = $pickup = $flight = $requests = new Valid('');

    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $room_type = new Dropdown($_POST['room_type']);
        $guests = new Dropdown($_POST['guests']);
        $firstname = new Name($_POST['firstname']);
        $lastname = new Name($_POST['lastname']);
        $email = new Email($_POST['email']);
        $arrival = new Date($_POST['arrival_date'] . ' ' . $_POST['arrival_time']);
        $departure = new Date($_POST['departure_date'] . ' ' . $_POST['departure_time']);
        $pickup = new Valid($_POST['pickup']);
        $flight = new Valid($_POST['flight']);
        $requests = new Valid($_POST['requests']);

        if (
            !$room_type->get_invalid() and
            !$guests->get_invalid() and
            !$firstname->get_invalid() and
            !$lastname->get_invalid() and
            !$arrival->get_invalid() and
            !$departure->get_invalid() and
            !$room_type->get_invalid()
        ) {

            $sql = "UPDATE $tablename SET
                        room_type = '" . $room_type . "',
                        guests = '" . $guests . "',
                        firstname = '" . $firstname . "',
                        lastname = '" . $lastname . "',
                        email = '" . $email . "',
                        arrival = '" . $arrival . "',
                        departure = '" . $departure. "',
                        pickup = '" . $pickup . "',
                        flight = '" . $flight . "',
                        requests = '" . $requests . "'
                    WHERE
                        id = '$id'";

            $result = $conn->query($sql);

            if (!$result) {
                echo 'Error: ' . $sql . '<br>' . $conn->error;
            }

            $conn->close();

            header("Location: view.php");
        }
    }

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $sql = "SELECT * FROM $tablename WHERE id = '$id'";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $id = $row['id'];
                $room_type = new Dropdown($row['room_type']);
                $guests = new Dropdown($row['guests']);
                $firstname = new Name($row['firstname']);
                $lastname = new Name($row['lastname']);
                $email = new Email($row['email']);
                $arrival = new Date($row['arrival']);
                $departure = new Date($row['departure']);
                $pickup = new Valid($row['pickup']);
                $flight = new Valid($row['flight']);
                $requests = new Valid($row['requests']);
            }
        ?>

            <h2>Booking Update Form</h2>

            <form action = '' method = 'POST'>
            <fieldset>

                <input type = 'hidden' name = 'id' value = '<?php echo $id; ?>'>

                Room Type:
                <select name = 'room_type'>
                    <option value = 'single' <?php if ($room_type->get_data() == 'single'){ echo 'selected'; } ?>>Single
                    <option value = 'double' <?php if ($room_type->get_data() == 'double'){ echo 'selected'; } ?>>Double
                    <option value = 'suite' <?php if ($room_type->get_data() == 'suite'){ echo 'selected'; } ?>>Suite
                </select>
                <p class = 'error' <?php if (!$guests->get_invalid()) { echo 'hidden'; } ?>> <?php echo $guests->get_invalid(); ?> </p>
                <br <?php if ($guests->get_invalid()) { echo 'hidden'; } ?>>

                Number of Guests:
                <select name = 'guests'>
                    <option value = 1 <?php if ($guests->get_data() == '1'){ echo 'selected'; } ?>>1
                    <option value = 2 <?php if ($guests->get_data() == '2'){ echo 'selected'; } ?>>2
                    <option value = 3 <?php if ($guests->get_data() == '3'){ echo 'selected'; } ?>>3
                    <option value = 4 <?php if ($guests->get_data() == '4'){ echo 'selected'; } ?>>4
                    <option value = 5 <?php if ($guests->get_data() == '5'){ echo 'selected'; } ?>>5
                </select>
                <p class = 'error' <?php if (!$guests->get_invalid()) { echo 'hidden'; } ?>> <?php echo $guests->get_invalid(); ?> </p>
                <br <?php if ($guests->get_invalid()) { echo 'hidden'; } ?>>
                
                First Name:
                <input type = 'text' name = 'firstname' value = '<?php echo $firstname->get_data(); ?>'>
                <p class = 'error' <?php if (!$firstname->get_invalid()) { echo 'hidden'; } ?>> <?php echo $lastname->get_invalid(); ?> </p>
                <br <?php if ($firstname->get_invalid()) { echo 'hidden'; } ?>>

                Last Name:
                <input type = 'text' name = 'lastname' value = '<?php echo $lastname->get_data(); ?>'>
                <p class = 'error' <?php if (!$lastname->get_invalid()) { echo 'hidden'; } ?>> <?php echo $lastname->get_invalid(); ?> </p>
                <br <?php if ($lastname->get_invalid()) { echo 'hidden'; } ?>>

                Email:
                <input type = 'email' name = 'email' value = '<?php echo $email->get_data(); ?>'>
                <p class = 'error' <?php if (!$lastname->get_invalid()) { echo 'hidden'; } ?>> <?php echo $lastname->get_invalid(); ?> </p>
                <br <?php if ($lastname->get_invalid()) { echo 'hidden'; } ?>>
                
                Arrival:
                <input type = 'date' name = 'arrival_date' value = '<?php echo date('Y-m-d', strtotime($arrival->get_data())); ?>'>
                <input type = 'time' name = 'arrival_time' value = '<?php echo date('H:i:s', strtotime($arrival->get_data())); ?>'>
                <p class = 'error' <?php if (!$arrival->get_invalid()) { echo 'hidden'; } ?>> <?php echo $arrival->get_invalid(); ?> </p>
                <br <?php if ($arrival->get_invalid()) { echo 'hidden'; } ?>>
                
                Departure:
                <input type = 'date' name = 'departure_date' value = '<?php echo date('Y-m-d', strtotime($departure->get_data())); ?>'>
                <input type = 'time' name = 'departure_time' value = '<?php echo date('H:i:s', strtotime($departure->get_data())); ?>'>
                <p class = 'error' <?php if (!$departure->get_invalid()) { echo 'hidden'; } ?>> <?php echo $departure->get_invalid(); ?> </p>
                <br <?php if ($departure->get_invalid()) { echo 'hidden'; } ?>>
                
                Free Pickup:
                <input type = 'radio' name = 'pickup' value = '1' <?php if ($pickup->get_data() == '1'){ echo 'checked'; } ?>>Yes, Sure!<br>
                <input type = 'radio' name = 'pickup' value = '0' <?php if ($pickup->get_data() == '0'){ echo 'checked'; } ?>>No, I already rented a car
                <br>

                Flight Number:
                <input type = 'text' name = 'flight' value = '<?php echo $flight->get_data(); ?>'>
                <br>

                Other Requests:
                <textarea type = 'text' name = 'requests' rows = '4' cols = '40'><?php echo $requests->get_data(); ?></textarea>
                <br><br>
                <input type = 'submit' name = 'update' value = 'update'>
            </fieldset>
        </form>

        <?php
        } else {
            header('Location: view.php');
        }
    }

?>