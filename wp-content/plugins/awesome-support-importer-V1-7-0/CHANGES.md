# 1.7.0
- NEW: Freshdesk Importer. You can now import your tickets from Freshdesk.

# 1.6.0
- Update: Helpscout API updated

# 1.5.0
- [00] Numerous fixes contributed by [nmoinvaz ](https://github.com/nmoinvaz)
- [00] Fix: If first name is blank, set it to "none" so that when inserting a user, WP allows the user creation without throwing an error.
- [00] Tweak: Make sure user name is set to the email address
- [00] Tweak: Make sure that the password for new users is set using wp_generate_password() instead of hardcoding it to 'xyz'.

# 1.0.2
- [00] Check to see if the SAAS Ticket ID field exists before creating it.  Future versions of Awesome support will define this field so no need to define it here if it already exists.

# 0.2.2 / 1.0.1

- [49] Don't load unless Awesome Support is loaded.
- [49] Added an admin notice when Awesome Support is not activated.

# 0.2.1 / 1.0.0

- [48] Disables emails.
- [00] Moved version number to 1.0.0 for initial public release.

# 0.1.2

- [41] Ticksy - reply attachments assigned to Ticket. Ticksy corrected the response JSON packet. This beta release adjusts the Data Mapper and tests to ensure attachments are properly assigned to the respective ticket or reply.

# 0.1.1

- [27] Bug Fix - Fatal Error: Missing `FatalErrorException`
- [28] Bug Fix - REST API Error includes Pressware path - moved the exceptions listener to wait until we're on the right admin screen and logged in
- [36] Documentation - Change Product Name to: `Awesome Support: Importer`
- [38] Documentation - Clarify Subdomain Field in View
- [39] Documentation - Change Menu's Name to "Importer"

# 0.1.0

- Beta - Acceptance Release
