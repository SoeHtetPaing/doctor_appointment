<?php 
    //select section
    function selectUserRoleByEmail ($database, $email) { 
        $sql = "select * from page_user where email='$email';";
        $user_role = $database->query($sql)->fetch_assoc();
    
        return $user_role;
    }

    function selectUserRoles ($database) {
        $sql = "select * from page_user;";
        $user_roles = $database->query($sql)->fetch_assoc();
    
        return $user_roles;
    }

    function selectPatientByEmail ($database, $email) {
        $sql = "select * from patient where pemail='$email';";
        $patient = $database->query($sql)->fetch_assoc();

        return $patient;
    }

    function selectDoctorByEmail ($database, $email) {
        $sql = "select * from doctor where demail='$email';";
        $doctor = $database->query($sql)->fetch_assoc();

        return $doctor;
    }

    function selectAdminByEamil ($database, $email) {
        $sql = "select * from admin where aemail='$email';";
        $admin = $database->query($sql)->fetch_assoc();

        return $admin;
    }

    // end select

    //insert section
    
    function insertPatient ($database, $email, $name, $newpassword, $address, $nrc, $dob, $phone){
        $sql = "insert into patient(pemail,pname,ppassword, paddress, pnrc, pdob, pphone) values('$email','$name','$newpassword','$address','$nrc','$dob','$phone');";
        $success = $database->query($sql);

        return $success;
    }

    function insertPageUser ($database, $email, $role) {
        $sql = "insert into page_user values('$email', '$role');";
        $success = $database->query($sql);
        
        return $success;
    }

    function insertSpeciality ($database, $name) { 
        $sql = "insert into specialties (sname) values ('$name');";
        $success = $database->query($sql);

        return $success;
    }

    function insertAdmin ($database, $email, $password) {
        $sql = "insert into admin values ('$email', '$password');";
        $success = $database->query($sql);

        return $success;
    }

    function insertDoctor ($database, $email, $name, $newpassword, $nrc, $phone, $specialty) {
        $sql = "insert into doctor(demail,dname,dpassword, dnrc, dphone, specialties) values('$email','$name','$newpassword','$nrc','$phone', $specialty);";
        $success = $database->query($sql);

        return $success;  
    }

    //insert end