  WordPress Installation Guide

Install New WordPress Installation on Virtual Machine
=====================================================

**Install new WordPress installation on virtual machine with oldest user credential.**

It's good to use the same `DB_NAME` and `table_prefix`:

*   **DB\_NAME:** `________`
*   **Table Prefix:** `_____`
*   **User Credential:**

*   **User:** `________`
*   **Pass:** `_______`

*   If an email is added in the file, include it as well.

Override Site URL
-----------------

Add the following code to your `wp-config.php` file to override the old site URL:

    define('WP_HOME', 'http://localhost/your-project-folder'); // Replace with your desired site URL
    define('WP_SITEURL', 'http://localhost/your-project-folder'); // Replace with your desired WordPress URL

**Or:** Update the URLs manually in the database when importing the database dump.

Update Permalinks
-----------------

After importing the database, go to **Settings → Permalinks**, select **Post name**, and click **Save Changes**.

Deploy Files
------------

Deploy all files into the correct directories from the repository.

Theme and Plugins
-----------------

This website is built with the **wp-bootstrap-4-pro** theme and requires two mandatory plugins:

1.  **Advanced Custom Fields Pro**
2.  **Kirki**

### Plugin Activation

*   Activate the **mandatory plugins** first:
    *   `advanced-custom-fields-pro`
    *   `kirki`
*   Activate all other plugins, but **exclude** `x-advanced-custom-fields-pro` unless needed.

### ACF Fields Import

The plugin folder contains `acf-export-date-export.json`. These are the fields the website uses.

There are two ways to import the fields:

*   From the WordPress Dashboard → **ACF → Tools → Import**.
*   Directly import them into the database during the database import process.

Activate Theme
--------------

After activating the mandatory plugins, activate the **wp-bootstrap-4-pro** theme.

Final Steps
-----------

1.  Import the database.
2.  Refresh the permalinks again by navigating to **Settings → Permalinks** and clicking **Save Changes**.

Your WordPress installation should now be ready to use!
