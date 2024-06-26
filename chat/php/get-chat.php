<?php 
session_start();
if(isset($_SESSION['id'])){
    require_once("../../connexion/conx.php");
    $outgoing_id = $_SESSION['id'];
    if (isset($_POST['incoming_id'])) {
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $output = "";
        $sql = "SELECT * FROM messages 
                LEFT JOIN user_form ON user_form.id = messages.outgoing_msg_id
                WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
                OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) 
                ORDER BY msg_id";
        $query = mysqli_query($conn, $sql);
        if ($query) {
            if (mysqli_num_rows($query) > 0) {
                while($row = mysqli_fetch_assoc($query)){
                    if($row['outgoing_msg_id'] === $outgoing_id){
                        $output .= '<div class="chat outgoing">
                                    <div class="details">
                                        <p>'. htmlspecialchars($row['msg']) .'</p>
                                    </div>
                                    </div>';
                    } else {
                        $output .= '<div class="chat incoming">
                                    <img src="../login/img/'. htmlspecialchars($row['pp']) .'" alt="">
                                    <div class="details">
                                        <p>'. htmlspecialchars($row['msg']) .'</p>
                                    </div>
                                    </div>';
                    }
                }
            } else {
                $output .= '<div class="text">No messages are available. Once you send a message, they will appear here.</div>';
            }
        } else {
            $output .= '<div class="text">An error occurred while fetching messages.</div>';
        }
        echo $output;
    } else {
        header("location: ../login.php");
        exit;
    }
} else {
    header("location: ../login.php");
    exit;
}
?>
