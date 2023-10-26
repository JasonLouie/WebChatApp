<?php
    while($row = mysqli_fetch_assoc($data)){
        $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = ?
                OR outgoing_msg_id = ? ) AND (outgoing_msg_id = ? 
                OR incoming_msg_id = ? ) ORDER BY msg_id DESC LIMIT 1";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->bind_param("iiii", $row['unique_id'], $row['unique_id'], $outgoing_id, $outgoing_id);
        $stmt2->execute();
        $query2 = $stmt2->get_result();
        $you = "";
        if(mysqli_num_rows($query2) > 0){
            $row2 = mysqli_fetch_assoc($query2);
            $result = $row2['msg'];
            if ($outgoing_id == $row2['outgoing_msg_id']){
                $you = "You: ";
            }
        }
        else{
            $result = "No message available";
        }
        // Trim message if word length is longer than 28
        (strlen($result) > 28) ? $msg = substr($result, 0, 28).'...' : $msg = $result;
        // Check user's status
        ($row['status'] == "Offline now") ? $offline = "offline" : $offline = "";

        $output .= '<a href="chat.php?user_id='.$row['unique_id'].'">
                        <div class="content">
                            <img src="php/images/'. $row['img'] .'" alt="">
                            <div class="details">
                                <span>'. $row['username'] .'</span>
                                <p>'. $you.$msg .'</p>
                            </div>
                        </div>
                        <div class="status-dot '.$offline.'"><i class="fas fa-circle"></i></div>
                    </a>';
    }
?>