#!/usr/bin/perl

use strict;
use DBI;

my $driver   = "mysql";
my $database = "Test";
my $dsn      = "DBI:$driver:database=$database";
my $userid   = "Tom";
my $password = "Tom0306";

my $dbh = DBI->connect($dsn, $userid, $password) or die $DBI::errstr;

# Check for duplicate username
my $check_username_query = $dbh->prepare("SELECT username FROM Users WHERE username = ?");
$check_username_query->execute($ARGV[0]) or die $DBI::errstr;
if ($check_username_query->fetchrow_array) {
    die "Error: Username already exists. Please choose a different username.\n" return 1;
}
$check_username_query->finish();

# Insert new user
my $insert_query = $dbh->prepare("INSERT INTO Users (username, password, email, address) VALUES (?, ?, ?, ?)");
$insert_query->execute($ARGV[0], $ARGV[1], $ARGV[2], $ARGV[3]) or die $DBI::errstr return 0;
$insert_query->finish();

print "User inserted successfully.\n";

