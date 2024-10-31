=== Raffle Play Woocommerce ===
Contributors: dan009
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=HH7J3U2U9YYQ2
Tags: raffle, raffle tickets, raffle tickets generator, woocommerce raffle tickets
Requires at least: 5.0.1
Tested up to: 6.6
Stable tag: 2.4.1
Requires PHP: 5.2.4
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Raffle Play Woo is generating raffle tickets for woocommerce products, based on the number defined by the admin. Adds raffle tickets to your woocommerce products. Embeds the raffle ticket numbers in the order email and admin view.
It offers a complete workflow of managing raffle tickets from the admin view to the user experience.  

== Description ==
Raffle Play Woo is the right plugin to manage a raffle tickets generator system. With Unlimited tickets, custom email labels, and view over the orders.
Raffle tickets are emailed to the custemer after checkout, and are visible in the Thank you page. Also in the order admin, and displayed in a view page.
For support or suggestions: developer@tuskcode.com

Demo Video on how to setup Raffle Play woo
[youtube https://youtu.be/IznIClpeBzM]

== Installation ==
1.Upload the plugin
2.Activate it 
3.Go to Raffle Play Woo Installation page and follow the instructions (with steps, and pictures)

== Frequently Asked Questions ==

= What is Raffle Play Woo = 
Raffle Play Woo integrates a raffle ticket system on your woocommerce websites, it allows normal products to be assigned a number of raffle tickets


== Screenshots ==

== Changelog ==

= 2024-10-24
* Fixed generating tickets after the reserved time has expired

= 2024-09-09
* Added Log Tab for Raffle logs, and wordpress default log file (error.log)
* Added tab in General Settings - User Picks tickets at checkout (premium feature)

= 2024-07-20
* Updated languages
* Changed default name for Raffle
* Changed default text for email and thank you page text

= 2024-07-17
* Compatible with wordpress 6.6
* Fixed quantity of raffle products when updated cart is done through ajax 
* Added new premium tab in the General settings called "Custom Search Settings"
* Added new premium tab in the General settings called "Product Raffle Tab"

= 2024-05-26
* Fixed changing customer for order - tickets assigned to new customer (eg: from guest to registered customer)
* Improved insert raffle tickets in bulk - faster insert 
* Added Lucky Numbers Page - Premium

= 2024-04-17
* Fixed error when order is created manually
* Fixed tickets generated when order is created manually
* Added option to select to which order status to generate tickets

= 2024-04-02
* Added Generate and Display raffle tickets at checkout
* Fixed Backround image display for tickets
* Compatible with Woocommerce Checkout blocks
* Tested with 6.5

= 2024-01-29
* Changed email / thank you template into template folder
* Changed how template is loaded (customized through woocommerce template folder)

= 2024-01-23
* Fixed warning in General Settings
* Added warning if tickets not generated

= 2023-12-07
* Added Orders Table view raffle tickets
* Added Switch on/off Order Table view raffle tickets
* Added Tab "Raffle Play Woo Settings" tab in the product page
* Added Info on how to start the raffle.
* Changed Default background image is On, and color is Blue

= 2023-11-10
* Compatible and tested with Wordpress Version 6.4
* Updated - Compatible with new HPOS, and legacy order storage
* Added - Countdown view for the premium version.
* Added - Feedback form when the plugin is uninstalled

= 2023-10-15
* Fixed uninstall.php, error occur, not deleting the plugin

= 2023-10-04
* Added functionality to fix duplicated tickets
* Added namespaces to classes

= 2023-08-09
* Fixed Filter raffle product list
* Fixed Raffle column width product list
* Compatible with 6.3 

= 2023-05-19 
* Added Leading Ticket Zero 
* Custom style blocks settings

= 2023-04-11
* Added Custom Raffle Tab in Woocommerce Account
* Show raffle tickets in the Woocommerce Account grouped by order

= 2023-02-08
* Added translated languages

= 2023-01-28
* Fixed starting number at 0 - issue showing false
* Added custom background image for tickets ( Blue, Gold, Orange )

= 2022-12-02
* Fixed header content issue 
* Extended ticket prefix to 15 alphanumeric characters
* Default starting ticket number set to 0
* Email display tickets changed to row data instead of 2 columns

= 2022-11-08
* Tested with 6.1
* Center text for tickets display on Thank you Page / Email 

= 2022-08-29 =
* Fixed error log for undefined variable

= 2022-07-15 =
* Tested with 6.0.1 

= 2022-02-16 =
* Compatible with 5.9
* Removed Credit text in the email 
* Default text email changed for Raffle and Raffle Tickets

= 2021-12-30
* Fixed error loading order data upon checkout

= 2021-12-29
* Fixed last used ticket, timestamp column, not reliable, might cause duplicated tickets
* Added Product Name in the grid view
* Columns in Grid view will be rememered whenever the page is opened again
* Show duplicated tickets in the View Tickets page

= 2021-11-12 =
* Fixed product grid view

= 2021-10-29 = 
* Added premium PDF Email Attachement tab
* Updated Documentation 
* Test Compatible with 5.8.1

= 2021-05-23 =
* Redesign the template view
* Added brief documentation
* Start ticket number can be changed
* Restrict starting ticket being smaller than any purchased ticket
* Raffle name can be changed
* View Tickets filter by order status

= 2021-01-20 =
* First draft *

== Free Version ==
1. Marks a product as a raffle product
2. Assign unlimited number of tickets to a single product
3. Overview of the raffle products
3. Starting raffle number from 1000
4. Custom labels for email order
5. Custom Prefix for tickets
6. Cancelled, Refunded, and Failed will not be assigned any raffle tickets
7. View all the raffle tickets bought
8. Filter the raffle tickets view based on dates
9. Unlimited ticket raffle
10. Start ticket number can be changed
11. View Tickets filter by order status
12. View order details in the View Tickets page

== Premium Version ==
1. Custom Raffle Name
2. Live / Test tickets
3. Unlimited Number of tickets per raffle
4. Unlimited raffles
5. Multiple raffle running at the same time
6. Unlimited number or raffle tickets per product
6. Multiple products per raffle 
8. Terminate raffle immediately / by date
9. Limited number of tickets per raffle (can be set )
10. Custom ticket start number 
11. Custom ticket prefix
12. Custom Raffle Start Date / Time
13. Custom Raffle End Date / Time
14. Custom Email Header
15. Include Raffle name in Email
16. Custom Email Body (tickets extra info)
17. Email extra line info (eg: Draw takes place on … )
18. Custom Message if raffle is terminated
19. Custom Message if raffle hasn’t started (based on start date)
20. Custom Message if raffle has ended ( based on end date )
21. Custom Message when raffle will end ( if end date is set )
22. Custom Message – Add to Cart check (if no tickets left)
23. Custom Message – Add to Cart check (if tickets in cart exceed stock)
24. Shortcode for message per raffle 
25. Restrict multiple raffle tickets at checkout (enable/disable)
26. Test Info system with custom number tickets
27. View info tickets, customers, orders
28. View tickets sold based on dates 
29. View tickets based on order status
30. Record winners based on the raffle tickets (due to transparency, no random winner generator provided)
31. Reports Per Raffle (all are .csv format)
32. Daily Sale Report
33. Weekly Sale Report (Monday to Sunday)
34. Monthly Sale Report
35. Report by Region/County
36. Report by Country/County (option to include the rest of the countries)
37. Sales by Product
38. Export Custom Colums per order (including custom fields created at checkout)
39. Custom Currency Symbol per report total sale column
40. Filter report by order status
41. Filter report by Date range
42. Filter report by raffle
43.Calculate reports sale based on order sale or product price