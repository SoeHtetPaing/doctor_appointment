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

    function selectDoctorById ($database, $id) {
        $sql = "select * from doctor where did='$id';";
        $doctor = $database->query($sql)->fetch_assoc();

        return $doctor;
    }

    function selectDoctor ($database) {
        $sql = "select * from doctor order by dname asc;";
        $doctors = $database->query($sql);

        return $doctors;
    }

    function selectDoctorEmailName ($database) {
        $sql = "select dname, demail from doctor;";
        $doctorEmailName = $database->query($sql);

        return $doctorEmailName;
    }

    function selectPatientEmailName ($database) {
        $sql = "select pname,pemail from patient;";
        $patientEmailName = $database->query($sql);

        return $patientEmailName;
    }

    function searchDoctor ($database, $keyword) {
        $sql = "select * from doctor where demail='$keyword' or dname='$keyword' or dname like '$keyword%' or dname like '%$keyword' or dname like '%$keyword%';";
        $doctors = $database->query($sql);

        return $doctors;
    }

    function selectDoctorIdWithUserRole ($database, $email) {
        $sql = "select doctor.did from doctor inner join page_user on doctor.demail=page_user.email where page_user.email='$email';";
        $did = $database->query($sql)->fetch_assoc();

        return $did;
    }

    function selectAdminByEamil ($database, $email) {
        $sql = "select * from admin where aemail='$email';";
        $admin = $database->query($sql)->fetch_assoc();

        return $admin;
    }

    function selectPatient ($database) {
        $sql = "select * from patient order by pname desc";
        $patients = $database->query($sql);

        return $patients;
    }

    function searchPatient ($database, $keyword) {
        $sql = "select * from patient where pemail='$keyword' or pname='$keyword' or pname like '$keyword%' or pname like '%$keyword' or pname like '%$keyword%';";
        $patients = $database->query($sql);

        return $patients;
    }

    function selectPatientById ($database, $id) {
        $sql = "select * from patient where pid='$id';";
        $patient = $database->query($sql)->fetch_assoc();

        return $patient;
    }

    function selectAppointmentToday ($database, $today) {
        $sql = "select  * from  appointment where appdate >='$today';";
        $appointments = $database->query($sql);

        return $appointments;
    }

    function selectScheduleToday ($database, $today) {
        $sql = "select  * from  schedule where sdate='$today';";
        $schedules = $database->query($sql);

        return $schedules;
    }

    function selectScheduleByDoctor ($database, $id) {
        $sql = "select sid from schedule where did = '$id';";
        $sid = $database->query($sql);

        return $sid;
    }

    function selectScheduleByDoctorId ($database, $id) {
        $sql = "select * from schedule where did = '$id';";
        $schedule = $database->query($sql);

        return $schedule;
    }

    function selectAllSchedule ($database) {
        $sql = "select * from schedule;";
        $schedules = $database->query($sql);

        return $schedules;
    }

    function filterSchedule($database, $sql) {
        $filter = $database->query($sql);

        return $filter;
    }

    function selectScheduleDetail ($database, $today, $nextweek) {
        $sql = "select schedule.sid,schedule.title,doctor.dname,schedule.sdate,schedule.stime,schedule.nop from schedule inner join doctor on schedule.did=doctor.did  where schedule.sdate>='$today' and schedule.sdate<='$nextweek' order by schedule.sdate desc";
        $sche_details = $database->query($sql);

        return $sche_details;
    }

    function selectScheduleDetailById ($database, $id) {
        $sql = "select schedule.sid,schedule.title,doctor.dname,schedule.sdate,schedule.stime,schedule.nop from schedule inner join doctor on schedule.did=doctor.did  where  schedule.sid=$id;";
        $schedule = $database->query($sql)->fetch_assoc();

        return $schedule;
    }

    function selectAllAppointment ($database) {
        $sql = "select * from appointment";
        $appointments = $database->query($sql);

        return $appointments;
    }

    function filterData($database, $sql) {
        $filter = $database->query($sql);

        return $filter;
    }

    function selectAppointmentDetail ($database, $today, $nextweek) {
        $sql = "select appointment.appid,schedule.sid,schedule.title,doctor.dname,patient.pname,schedule.sdate,schedule.stime,appointment.appno,appointment.appdate from schedule inner join appointment on schedule.sid=appointment.sid inner join patient on patient.pid=appointment.pid inner join doctor on schedule.did=doctor.did  where schedule.sdate>='$today'  and schedule.sdate<='$nextweek' order by schedule.sdate desc;";
        $app_details = $database->query($sql);

        return $app_details;
    }

    function selectAppointmentDetailById ($database, $id) {
        $sql = "select * from appointment inner join patient on patient.pid=appointment.pid inner join schedule on schedule.sid=appointment.sid where schedule.sid=$id;";
        $appointment = $database->query($sql);

        return $appointment;
    }

    function selectAppointmentByDoctor ($database, $id) {
        $sql = "select * from schedule inner join appointment on schedule.sid=appointment.sid inner join patient on patient.pid=appointment.pid inner join doctor on schedule.did=doctor.did  where  doctor.did=$id;";
        $appointment = $database->query($sql);

        return $appointment;
    }


    function selectAllSpeciality ($database) {
        $sql = "select  * from  specialties order by sname asc;";
        $speciality = $database->query($sql);

        return $speciality;
    }

    function selectSpecialityName ($database, $id) {
        $sql = "select sname from specialties where id='$id';";
        $speciality_name = $database->query($sql)->fetch_assoc();

        return $speciality_name;
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

    function insertDoctor ($database, $email, $name, $newpassword, $nrc, $phone, $speciality) {
        $sql = "insert into doctor(demail,dname,dpassword, dnrc, dphone, specialties) values('$email','$name','$newpassword','$nrc','$phone', $speciality);";
        $success = $database->query($sql);

        return $success;  
    }

    function insertSchedule ($database, $doctor, $title, $date, $time, $nop) {
        $sql = "insert into schedule(did,title,sdate,stime,nop) values ('$doctor', '$title', '$date', '$time', '$nop');";
        $success = $database->query($sql);

        return $success;
    }

    function insertAppointment ($database, $patient, $appno, $schedule, $appdate) {
        $sql = "insert into appointment(pid, appno, sid, appdate) values ('$patient', '$appno', '$schedule', '$appdate');";
        $success = $database->query($sql);

        return $success;
    }

    //insert end

    //delete section

    function deletePageUser ($database, $email) {
        $sql = "delete from page_user where email='$email';";
        $success = $database->query($sql);

        return $success;
    }

    function deleteSchedule ($database, $id) {
        $sql = "delete from schedule where sid='$id';";
        $success = $database->query($sql);

        return $success;
    }

    function deleteAppointment ($database, $id) {
        $sql = "delete from appointment where appid='$id';";
        $success = $database->query($sql);

        return $success;
    }

    function deleteDoctor ($database, $email) {
        $sql = "delete from doctor where demail='$email';";
        $success = $database->query($sql);

        return $success;
    }

    function deletePatient ($database, $email) {
        $sql = "delete from patient where pemail='$email';";
        $success = $database->query($sql);

        return $success;
    }

    function deleteAppointmentByPatientId ($database, $id) {
        $sql = "delete from appointment where pid='$id';";
        $success = $database->query($sql);

        return $success;
    }

    //delete end

    //update section

    function updateDoctor ($database, $did, $email, $name, $password, $nrc, $phone, $speciality) {
        $sql = "update doctor set demail='$email',dname='$name',dpassword='$password',dnrc='$nrc',dphone='$phone',specialties=$speciality where did=$did ;";
        $success = $database->query($sql);

        return $success;  
    }

    function updatePatient ($database, $pid, $email, $name, $password, $nrc, $phone, $address) {
        $sql = "update patient set pemail='$email',pname='$name',ppassword='$password',pnrc='$nrc',pphone='$phone',paddress='$address' where pid=$pid ;";
        $success = $database->query($sql);

        return $success;  
    }

    function updatePageUser ($database, $oldemail, $email) {
        $sql = "update page_user set email='$email' where email='$oldemail';";
        $success = $database->query($sql);
        
        return $success;
    }

    //update end