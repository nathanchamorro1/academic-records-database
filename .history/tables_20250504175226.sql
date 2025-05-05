CREATE TABLE Professor (
    SSN int PRIMARY KEY,
    FirstName varchar(255),
    LastName varchar(255),
    TelephoneNumber int(10),
    Sex varchar(1),
    Title varchar(255),
    Salary varchar(255),
    CollegeDegrees varchar(255)

)

CREATE TABLE Department (
    DepartmentID int PRIMARY KEY,
    DeptName varchar(100),
    Telephone int(10),
    Location varchar(200),
    ChairmanSSN char(9),
    FOREIGN KEY (ChairmanSSN) REFERENCES PROFESSOR(SSN)
)