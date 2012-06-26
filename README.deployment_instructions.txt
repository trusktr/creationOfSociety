To deploy:
1. Put these files/folders at the root of the domain.
2. Navigate to wp/wp-content/uploads/wple-snapshots/ and locate the most recent database snapshot.
3. If the domain name is different now than it was previously, you'll have to laboriously search and replace the old domain name with the new domain name in the located sql 
file.
4. Import the database snapshot into a database.
5. Navigate to wp/ then edit wp-config.php as necessary so that WordPress reads the proper database.
6. You are now deployed.

Note: The theme editing is done in x.php, located at the root level (not in wp/wp-content/themes/...).