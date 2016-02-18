DROP TABLE IF EXISTS shift;
DROP TABLE IF EXISTS request;
DROP TABLE IF EXISTS schedule;
DROP TABLE IF EXISTS user;
DROP TABLE IF EXISTS access;
DROP TABLE IF EXISTS crew;
DROP TABLE IF EXISTS company;


CREATE TABLE company (
	companyId v,
	companyName VARCHAR(128) NOT NULL,
	companyAddress1 VARCHAR(128) NOT NULL,
	companyAddress2 VARCHAR(128),
	companyAttn VARCHAR(128),
	companyState VARCHAR(32) NOT NULL,
	companyCity VARCHAR(32) NOT NULL,
	companyZip VARCHAR(32) NOT NULL,
	companyPhone VARCHAR(32) NOT NULL,
	companyEmail VARCHAR(64) NOT NULL,
	companyUrl VARCHAR(64),
	PRIMARY KEY(companyId)
);

CREATE TABLE crew (
	crewId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	crewCompanyId INT UNSIGNED NOT NULL,
	crewLocation VARCHAR(255),
	INDEX (crewCompanyId),
	FOREIGN KEY(crewCompanyId) REFERENCES company(companyId),
	PRIMARY KEY(crewId)
);

CREATE TABLE access (
	accessId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	accessName VARCHAR(32),
	PRIMARY KEY(accessId)
);

CREATE TABLE user(
	userId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	userCompanyId INT UNSIGNED NOT NULL,
	userCrewId INT UNSIGNED NOT NULL,
	userAccessId INT UNSIGNED NOT NULL,
	userPhone VARCHAR(32),
	userFirstName VARCHAR(32) NOT NULL,
	userLastName VARCHAR(32) NOT NULL,
	userEmail VARCHAR(64) NOT NULL,
	userActivation CHAR(32),
	userHash CHAR(128),
	userSalt CHAR(64),
	INDEX(userCompanyId),
	INDEX(userCrewId),
	INDEX(userAccessId),
	FOREIGN KEY(userCompanyId) REFERENCES company(companyId),
	FOREIGN KEY(userAccessId) REFERENCES access(accessId),
	FOREIGN KEY(userCrewId) REFERENCES crew(crewId),
	PRIMARY KEY(userId)
);

CREATE TABLE schedule (
	scheduleId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	scheduleCrewId INT UNSIGNED NOT NULL,
	scheduleStartDate DATE,
	INDEX(scheduleCrewId),
	FOREIGN KEY(scheduleCrewId) REFERENCES crew(crewId),
	PRIMARY KEY(scheduleId)
);

CREATE TABLE request (
	requestId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	requestRequestorId INT UNSIGNED NOT NULL ,
	requestAdminId INT UNSIGNED NOT NULL,
	requestTimeStamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	requestActionTimeStamp DATETIME,
	requestApprove BOOLEAN NOT NULL ,
	requestRequestorText VARCHAR(255),
	requestAdminText VARCHAR(255),
	INDEX(requestRequestorId),
	INDEX(requestAdminId),
	FOREIGN KEY(requestRequestorId) REFERENCES user(userId),
	FOREIGN KEY(requestAdminId) REFERENCES user(userId),
	PRIMARY KEY(requestId)
);

CREATE TABLE shift (
	shiftId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	shiftUserId INT UNSIGNED NOT NULL,
	shiftCrewId INT UNSIGNED NOT NULL,
	shiftRequestId INT UNSIGNED NOT NULL,
	shiftStartTime TIME,
	shiftDuration INT UNSIGNED NOT NULL,
	shiftDate DATE,
	shiftDelete BOOLEAN DEFAULT 0,
	INDEX(shiftUserId),
	INDEX(shiftCrewId),
	INDEX(shiftRequestId),
	FOREIGN KEY(shiftUserId) REFERENCES user(userId),
	FOREIGN KEY(shiftCrewId) REFERENCES crew(crewId),
	FOREIGN KEY(shiftRequestId) REFERENCES request(requestId),
	PRIMARY KEY(shiftId)
);



