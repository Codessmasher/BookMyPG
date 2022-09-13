<?php
if (!isset($_SESSION["user_id"])) {
    return;
}
$user_id = $_SESSION['user_id'];
$property_id = $_GET['property_id'];
$booking_id = rand(time(), 1000000000);
$slct = "SELECT `user_id`, `booking_id` FROM `booked` WHERE `property_id`='$property_id' AND `user_id`=$user_id ";
$slctquery = mysqli_query($conn, $slct);
$isBooked = mysqli_num_rows($slctquery);
$fetchBid = mysqli_fetch_assoc($slctquery);
if ($isBooked != 0) {
?>

    <div class="modal fade" id="book-modal" tabindex="-1" role="dialog" aria-labelledby="msg-heading" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="msg-heading"><span class="text-success">You have already booked</span>.Your Booking id is <span class="text-info"><?php echo $fetchBid['booking_id']; ?></span> </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>

        <?php
    } else {
        $ins = " INSERT INTO `booked`(`user_id`, `booking_id`, `property_id`) VALUES ('$user_id','$booking_id','$property_id')";
        $updtQuery = mysqli_query($conn, $ins);
        if ($updtQuery) {
            ?>
            <div class="modal fade" id="book-modal" tabindex="-1" role="dialog" aria-labelledby="msg-heading" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="msg-heading"><span class="text-success">Congratulations!</span> Your Booking id is <span class="text-info"><?php echo $booking_id;?></span> <br>Note it for future reference</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
        
    <?php
    echo "<meta http-equiv='refresh' content='8'>";
        }
    }
    ?>
