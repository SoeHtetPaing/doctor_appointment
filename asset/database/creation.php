<?php
    function createTable ($database) {
        $sql = "create table if not exists admin (aemail varchar(100) primary key, apassword text);";
        if ($database->query($sql) === false) return false;

        $sql = "create table if not exists specialties (id int primary key auto_increment, sname varchar(100));";
        if ($database->query($sql) === false) return false;

        $sql = "create table if not exists doctor (did int primary key auto_increment, demail varchar(100), dname varchar(100), dpassword text, dnrc varchar(15), dphone varchar(15), specialties int not null, foreign key (specialties) references specialties (id));";
        if ($database->query($sql) === false) return false;

        $sql = "create table if not exists schedule (sid int primary key auto_increment, did int not null, title varchar(100), sdate date, stime time, nop int, foreign key (did) references doctor (did));";
        if ($database->query($sql) === false) return false;

        $sql = "create table if not exists patient (pid int primary key auto_increment, pemail varchar(100), pname varchar(100), ppassword text, paddress varchar(100), pnrc varchar(15), pdob date, pphone varchar(15));";
        if ($database->query($sql) === false) return false;

        $sql = "create table if not exists appointment (appid int primary key auto_increment, pid int not null, appno int, sid int not null, appdate date, foreign key (pid) references patient (pid), foreign key (sid) references schedule (sid));";
        if ($database->query($sql) === false) return false;

        $sql = "create table if not exists page_user (email varchar(100) primary key not null, urole char(1));";
        if ($database->query($sql) === false) return false;

    }
    
    createTable($database);