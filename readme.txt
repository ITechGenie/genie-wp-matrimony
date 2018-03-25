=== Genie WP Matrimony ===

Contributors: prakashm88
Donate link: https://itechgenie.com/myblog/genie-wp-matrimony/
Tags: matrimony, India matrimony, marriage, brides, grooms, matrimonial, dating
Requires at least: 4.0
Tested up to: 4.9.4
Stable tag: 0.9.1.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Text Domain: genie-wp-matrimony

Genie WP Matrimony plugin is Wordpress plugin which help in converting your Wordpress blog into a complete matrimonial website.

== Description ==

<strong>Genie WP Matrimony</strong>
<ul>
<li>The Genie WP Matrimony plugin is Wordpress plugin which help in converting your 
Wordpress blog into a complete matrimonial website.</li>
<li>This plugin uses the information 
of the default Wordpress users which makes it very easier and faster integration 
with existing Wordpress setup.</li>
<li>Features Profile management, Gallery, Activity, Messages, Search</li>
</ul>

== Installation ==

1. Download 'genie-wp-matrimony.zip' onto your local computer.
2. Go to your WordPress Dashboard and select <strong>Plugins >> Add New</strong>.
3. Click on the <strong>Upload</strong> option at the top and select the 'genie-wp-matrimony.zip' file you just downloaded.
4. Click on <strong>Install</strong>.
5. Activate the plugin through the 'Plugins' menu in WordPress.
6. There should be an additional 'Genie WP Matrimony' sub-menu under the Settings option of your dashboard to setup the plugin.
7. Clicking on the 'Matrimony' menu in the dashboard helps the user to update the user profile details. 
8. Access the complete Matrimonial options under pages Matrimony, Account, Gallery, Activity, Messages, Search.
9. If you wish to remove certain default fields or modify them, you can use the 'Static to Dynamic Fields options'. Read FAQ for more information.

== Frequently Asked Questions ==

<strong>Frequently Asked Questions</strong>
<ul><li><strong>Q:</strong>Does the plugin support Network Site installation ?<br /><strong>A:</strong>Yes, you can choose for your self in which network site this has to be enabled and restrict other from seeing them.
</li><li><strong>Q:</strong>Do I need separate user registration ?<br /><strong>A:</strong>No, Usual Wordpress registration will be enough. Please read http://wp.me/p2HHtz-86 for more info. 
</li><li><strong>Q:</strong>What themes are compatible for the plugin ?<br /><strong>A:</strong>The plugin is not theme dependable. As it follows the standard guidlines it should be pretty much compatible with most of the themes.
</li><li><strong>Q:</strong>How do I approve the matrimonial users ?<br /><strong>A:</strong>All Administrators will be receiving mails on who to approve a users. Another way is to Login to the Wordpress dashboard -> Matrimony -> Admin Dashboard, click on the "Change Role" and update the users roel to "Matrimonial Role"
</li><li><strong>Q:</strong>Matrimonial pages are not displayed in Menu automatically ?<br /><strong>A:</strong>Different themes might have different Top level parent menus. To add the pages in menu, Login to the Wordpress dashboard -> Appearance -> Menus -> Create a new Menu and add the pages. 
</li><li><strong>Q:</strong>What is the "Static to Dynamic Fields" options in settings ?<br /><strong>A:</strong>Many a times, the default fields provided in user profile are not appropriate for all audiences. These static fields can now be converted to dynamic ones for customization purposes. This options was added to support the backward compatibility.
</li><li><strong>Q:</strong>Can I change the file upload size restrcition ?<br /><strong>A:</strong>File upload size is defaulted to the minimum of these PHP.ini configurations: upload_max_filesize, post_max_size, memory_limit and plugin has no control over these configurations.
</li><li><strong>Q:</strong>Email notifications are not sent to users ?<br /><strong>A:</strong>Plugin uses the wordpress function wp_mail(). Reason for failure of notifications can be with 1. Wordpress configuration, 2. Hosting provider with blacklisted email domains. 
</li></ul>

== Screenshots ==

1. Setup: Go to Settings -> Genie WP Matrimony
2. List of pages in the menu
3. Profile Edit page
4. Gallery Edit page
5. Profile Search page
6. Search Results page with profile pictures
7. Activity list of users
8. Avatar option for GWPM Users
9. Dynamic fields add screen
10. Dynamic fields view screen
11. Dynamic fields in User profile edit page
12. Admin dashboard page
13. Menu Options
14. Staic fields to dynamic field migration - step 1
15. Staic fields to dynamic field migration - step 2
16. Staic fields to dynamic field migration - step 3
17. Staic fields to dynamic field migration - step 4
18. Staic fields to dynamic field migration - step 5
19. Confirmation on migration
20. Staic fields are shown as Dynamic field after migrations
21. New FAQ section in Plugin Admin section


== Upgrade Notice ==

1. Removed Deprecated PHP methods
2. Removed Deprecated Wordpress methods
3. Verified compatibility with latest version
4. Other bug fixes


== Changelog ==

= 0.9.1.1 =

Added Telungana state

= 0.9.1 =

Removed Deprecated PHP methods
Removed Deprecated Wordpress methods
Verified compatibility with latest version
Other bug fixes

= 0.9 =

Move the static fields to Dynamic fields and configure as needed
Workaround to fix content being displayed twice when used with some incompatible plugins and themes
Added restrcition for test pages - only admins can view
Some XSS attach vulnarability fixes
File upload size defaulted to php.ini
Added QR code base files for future support
Lot of bug fixes
UI optimizations
Remove unwanted logs
Updated the text-domain for the plugin and updated POT files
Added customized email method to track email notification failures
New design for Edit profile and Update profile screens - only if static filed are migrated 
Email notifiation on Role change
removed Deprecated PHP methods

= 0.8.1 =

Search optimized to better results
Developer mode is disabled by default

= 0.8 =

Options to enable guest users to search and view registered users
Parent menu item enabling for new themes
Dynamic fields edit and update options added in admin screen
Search optimized to better results
jQuery deprecated APIs updated with new APIs
PHP deprecated APIs updated with new APIs
Contact No field made non mandatory field
Test framework updated with Dynamic field support
Code cleanup
Minor bug fixes

= 0.7 =
Added a functional administrative dashboard with new page to the control panel
Static interests limits of 5 added can be made configurable
Capability fix with DB prefix
Wrong message count on matrimony home page fixed
Dynamic field array validation warnings on search page fixed
Deprecated method clean_page_cache updated with clean_post_cache
More restriction added on deleting pages at plugin deactivation
Activity updated script bug fixed
Typos corrected and debug loggers added

= 0.6 =
Gravatar with profile picture support for GWPM Matrimony users
Controllers, Templates renamed to avoid potential conflicts with other plugins
Dynamic Field support added - customized fields in profile, search pages
Logger implementation done for development purposes
Dashboard admin page updated with Tabs for Dynamic field support
Separate CSS for Admin pages, typo fixed

= 0.5 =
Caste and religion options added to control panel profile edit page
Age range added to profile search page
Born before search option bug fixed
Profile Image type support for image/x-png added

= 0.4 =
New fields - Religion and Caste added to profile page, search page
Index page updated with the Notifications 
Notifications UI updated

= 0.3 =
Minor bugs fixed

= 0.2 =
First release of the plugin

= 0.1 =
Beta release of the plugin
