# Live demo Url

URL: https://xkcd.mggsneemrana.in/

I have used my own hosting server which i had brought earlier a year ago.
I have also used the mailing accounts of this hosting for email purposes.

# Steps for the project.

Firstly, I have created a index.php file, which only contain html data for some user interface. 
( I used ".php" instead of ".html" format to give a better look for php project.)

Then, I wrote javascript and css file to give functionality and styles to html body. (Basic Structure)
I have used Jquery for simplicity and faster code writing.
Used the Ajax in Jquery to send post request to server, it gives functionality to run beforesend and aftersend function.

Then I created a basic registration script in php, which recieves the email address and then stores it into sql database.
It emails a verification link which constitutes "email address" and "verification token", to verify the ownership of email.

The above verification link lands on a "verify script" which checks the token & email, and then register the user for service, by enabling the status of user to "true".

Then I created a cron script ( basically the script which emails a comic image, periodically). 
I have setup a cron job in my server to run this script. 
For the security of the script I used a conditional check of a "pass" key in the get request, whose value is only used in cron job configuration, and in the script itself, which restrict its use to server only.

For the purpose of sending mail ( with or without attachment ), I have created a mail.php file containing two mail functions to use again and again in different scripts.

Also, created a format.php file, which produce a basic html template to send on mail as per the kind of requirement.

Created a helping file named db_conn.php to configure the intial database connection.

Created a comic.php file which programmatically exctract the random image data from the XKCD website and encode it for the attachment to send with email.

Also, created a unsubscribe script to unsubscribe from the service which works by checking the token and the email associated in the get request.
Unsubscribe link is created during the email verification process.

# Problems faced during the project

Most problamatic was creating the mailing functions in the mail.php script to send the email because, before this project I have used only phpMailer library for sending emails, by using smtp (gmail). 
This is the first time I have created mailing function in core.
At one point, I was gettting the emails in promotions, but quikly after some time I figured it out that this is because of the absence of "reply" header in the format.
But I have found solution by reading documentation and google syntax.

Also, faced problem during the fetching of image data and processing it for the attachment.
At a point of time, i was getting only garbage data in place of image, which was because of absence of MIME image type in the attachment header.

Also, faced simple syntax errors, bug errors and misprinting errors during the project, but figured them out quickly.
This is because i have used PHP after a little long time, because recently I am doing a project in "MERN".

