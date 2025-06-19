<?php
include_once "../../db.php";

if (isset($_GET['userType'])) {

    $userType = $_GET['userType'];

    if ($userType == "all") {
        $sql = "SELECT * FROM users"; // You can modify this to select specific fields if needed
    } else {
        $sql = "SELECT * FROM users WHERE roll = '$userType'"; // You can modify this to select specific fields if needed
    }

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

if (count($users) > 0) {
    foreach ($users as $user) {
        echo '
        <tr>
            <td>
                <div class="d-flex align-items-center">
                    <img
                        src="../../assets/img/userProfile/' . htmlspecialchars($user["image"]) . '"
                        alt=""
                        style="width: 45px; height: 45px"
                        class="rounded-circle" />
                    <div class="ms-3">
                        <p class="fw-bold mb-1">' . htmlspecialchars($user["first_name"]) . '</p>
                        <p class="text-muted mb-0">' . htmlspecialchars($user["email"]) . '</p>
                    </div>
                </div>
            </td>
            <td>
                <p class="fw-normal mb-1">' . htmlspecialchars($user["phone_number"]) . '</p>
            </td>
            <td>
                <p class="fw-normal mb-1">' . htmlspecialchars($user["address"]) . '</p>
            </td>
            <td>
                <p class="fw-normal mb-1">' . htmlspecialchars($user["city"]) . '</p>
            </td>
            <td>
                <p class="fw-normal mb-1">' . htmlspecialchars($user["postal_code"]) . '</p>
            </td>
            <td>
                <p class="fw-normal mb-1">' . htmlspecialchars($user["province"]) .
            '</p>
            </td>
            <td>
            <select name="roll" id="roll" onchange="updateUserRoll(event,' . htmlspecialchars($user['user_id']) . ')" class="form-select form-select-sm" style="width: 100px">
                <option value="user" ' . ($user['roll'] == 'user' ? 'selected' : '') . '>User</option>
                <option value="admin" ' . ($user['roll'] == 'admin' ? 'selected' : '') . '>Admin</option>
            </select>
            </td>
            <td>
                <form method="POST" action="../../inc/handlers/admin/update_user_status.php">
                    <input type="hidden" name="user_id" value="' . htmlspecialchars($user["user_id"]) . '">
                    <div>
                        <input type="checkbox" name="account_status" value="1" ' . ($user["account_status"] == 1 ? 'checked' : '') . ' onchange="this.form.submit()" />
                    </div>
                </form>
            </td>
            <td>
                <a href="#" class="btn btn-danger btn-sm rounded-pill" onclick="deleteUser(event, ' . htmlspecialchars($user["user_id"]) . ')">Delete</a>
            </td>
        </tr>';
    }
} else {
    echo '<tr><td colspan="9" class="text-center">No users found.</td></tr>';
}
