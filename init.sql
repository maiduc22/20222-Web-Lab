-- Create the database
CREATE DATABASE IF NOT EXISTS business_service;

-- Switch to the database
USE business_service;

-- Create the Categories table
CREATE TABLE IF NOT EXISTS Categories (
  CategoryID INT PRIMARY KEY AUTO_INCREMENT,
  Title VARCHAR(255),
  Description VARCHAR(255)
);

-- Create the Businesses table
CREATE TABLE IF NOT EXISTS Businesses (
  BusinessID INT PRIMARY KEY AUTO_INCREMENT,
  Name VARCHAR(255),
  Address VARCHAR(255),
  City VARCHAR(255),
  Telephone VARCHAR(255),
  URL VARCHAR(255)
);

-- Create the Biz_Categories table
CREATE TABLE IF NOT EXISTS Biz_Categories (
  BusinessID INT,
  CategoryID INT,
  FOREIGN KEY (BusinessID) REFERENCES Businesses(BusinessID),
  FOREIGN KEY (CategoryID) REFERENCES Categories(CategoryID)
);