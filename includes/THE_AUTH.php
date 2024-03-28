<?php

require_once 'THE_MYSQL.php';

class Auth
{
    public $db;

    public function __construct(Mysql $db)
    {
        $this->db = $db;
    }

    public function getUser($user_id)
    {
        $data = $this->db->selectWhere('site_user', 'id', '=', $user_id, 'int');
        return $data[0];
    }

    public function hash_password($password)
    {
        $options = [
            'cost' => 12
        ];
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT, $options);

        return $hashedPassword;
    }

    public function loginAuth($userNameEmail, $password)
    {
        if (filter_var($userNameEmail, FILTER_VALIDATE_EMAIL)) {
            $sqlQuery = "SELECT * FROM site_user WHERE email = BINARY ?";
        } else {
            $sqlQuery = "SELECT * FROM site_user WHERE username = BINARY ?";
        }

        $result = $this->db->select($sqlQuery, [$userNameEmail]);

        if ($result && sizeof($result) > 0) {
            $row = $result[0];

            if (password_verify($password, $row["password"])) {
                $_SESSION['id'] = $row['id'];
                return true;
            } else {
                session_destroy();
                return false;
            }
        } else {
            session_destroy();
            return false;
        }
    }

    public function signUpAuth($fname, $lname, $contact, $username, $email, $password)
    {
        $sqlQuery = "SELECT * FROM site_user WHERE username=? OR email=?";

        $result = $this->db->select($sqlQuery, [$username, $email]);

        if ($result && sizeof($result) > 0) {
            return false;
        }

        $hashedPass = $this->hash_password($password);

        $sqlQuery = "INSERT INTO site_user VALUES (DEFAULT, ?, ?, ?, ?, ?, ?, DEFAULT, DEFAULT)";
        $queryStatus = $this->db->insert($sqlQuery, [$fname, $lname, $contact, $username, $email, $hashedPass]);

        if ($queryStatus) {
            return true;
        } else {
            return false;
        }
    }

    public function updateProfile($fname, $lname, $contact, $username, $email, $password = "", $profile_img = "profile_img")
    {

        try {
            if (isset($_SESSION['id'])) {
                if ($password != "") {
                    $hashedPass = $this->hash_password($password);
                }

                $sqlQuery = "UPDATE site_user SET fname=?, lname=?, contact_number=?";
                $params = [$fname, $lname, $contact];

                $queryStatus = $this->checkUsernameAndEmail($_SESSION['id'], $username, $email);
                if (!$queryStatus) {
                    $sqlQuery .= ", username=?, email=? ";
                    // maybe check username and email again if doesn't exists or implement it to the checkUsernameAndEmail method
                    $params[] = $username;
                    $params[] = $email;
                }
                if ($queryStatus === "ALREADY EXIST") {
                    return "Account already exist.";
                }

                if (isset($hashedPass)) {
                    $sqlQuery .= ", password=? ";
                    $params[] = $hashedPass;
                }

                $img_path = $this->getImageFromInput($profile_img);
                if ($img_path) {
                    $sqlQuery .= ", image_path=? ";
                    $params[] = $img_path;
                }

                $sqlQuery .= " WHERE id = ?";
                $params[] = $_SESSION['id'];

                return $this->db->update($sqlQuery, $params) ? "Profile updated" : "Something went wrong.";
            } else {
                return false;
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function checkUsernameAndEmail($userId, $username, $email)
    {
        $user = $this->getUser($userId);

        if ($user['username'] === $username && $user['email'] === $email) {
            return true;
        } else {
            $sql = "SELECT * FROM site_user WHERE (username = ? OR email = ?) AND username != ? AND email != ?";
            $res =  $this->db->select($sql, [$username, $email, $user['username'], $user['email']]);

            if ($res) {
                return "ALREADY EXIST";
            } else {
                return false;
            }
        }
    }

    public function getImageFromInput($inputName)
    {
        if (isset($_FILES[$inputName]) && $_FILES[$inputName]['size'] > 0) {
            if ($_FILES[$inputName]['error'] === UPLOAD_ERR_OK) {
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                $fileExtension = pathinfo($_FILES[$inputName]['name'], PATHINFO_EXTENSION);

                if (in_array(strtolower($fileExtension), $allowedExtensions)) {
                    $file_name = $_FILES[$inputName]['name'];
                    $file_temp = $_FILES[$inputName]['tmp_name'];
                    $destination = '/nstudio/img/profile/' . $file_name;

                    if (move_uploaded_file($file_temp, "../../img/profile/" . $file_name)) {
                        return $destination;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
